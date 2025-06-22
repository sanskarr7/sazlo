<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Teacher;
use App\Models\LiveClass; // Import LiveClass model
use App\Models\BookingClass;
use App\Models\Order;
use App\Models\OrderIteam;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class MainController extends Controller
{

    public function index()
    {
       $allProducts=Product::all();
       $newArrival=Product::where('type','new-arrivals')->get();
       $hotSale=Product::where('type','sale')->get();
       return view('index',compact('allProducts','newArrival','hotSale'));
    }
    public function cart()
    {
        $cartItems = DB::table('products')
            ->join('carts', 'carts.productId', '=', 'products.id')
            ->select('products.title','products.quantity as pQuantity', 'products.price', 'products.picture', 'carts.*')
            ->where('carts.customerId', session()->get('id'))
            ->get();

        return view('cart', compact('cartItems'));
    }

    public function checkout(Request $data)
{
    if (session()->has('id')) {
        $order = new Order();
        $order->status = "Pending";
        $order->customerID = session()->get('id');
        $order->bill = $data->input('bill');
        $order->address = $data->input('address');
        $order->fullname = $data->input('fullname');
        $order->phone = $data->input('phone');

        if ($order->save()) {
            $cart = Cart::where('customerId', session()->get('id'))->get();
            $total = 0;

            foreach ($cart as $item) {
                $product = Product::find($item->productId);
                $orderItem = new OrderIteam();
                $orderItem->productID = $item->productId;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $product->price;
                $orderItem->orderID = $order->id;
                $orderItem->save();
                $total += $product->price * $item->quantity;
                $item->delete();
            }

            // Redirect to 'your-page' with total amount
            return view('your-page', ['total' => $total]);
        } else {
            return redirect('login')->with('Error', 'Info ! Please Login Your Account');
        }
    }

    return view('checkout');
}

public function shop(Request $request)
{
    // At the beginning of the shop method
$recommendedProducts = collect();

// For non-logged-in users
if (!session()->has('id')) {
    // Popular products (based on orders)
    $popularProductIds = OrderIteam::groupBy('productId')
        ->orderByRaw('COUNT(*) DESC')
        ->take(4)
        ->pluck('productId');

    if ($popularProductIds->count() > 0) {
        $recommendedProducts = Product::whereIn('id', $popularProductIds)
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    // If still not enough, fill with random products
    if ($recommendedProducts->count() < 4) {
        $randomProducts = Product::whereNotIn('id', $popularProductIds)
            ->inRandomOrder()
            ->take(4 - $recommendedProducts->count())
            ->get();

        $recommendedProducts = $recommendedProducts->merge($randomProducts);
    }
}
    $search = $request->input('search', '');
    $minPrice = $request->input('min_price', 0);
    $maxPrice = $request->input('max_price', PHP_INT_MAX);
    $category = $request->input('category', '');

    // Base query
    $query = Product::query();

    if ($category) {
        $query->where('category', $category);
    }

    if ($search) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    if ($minPrice || $maxPrice < PHP_INT_MAX) {
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    $filteredProducts = $query->paginate(8);

    // Calculate ratings for filtered products
    foreach ($filteredProducts as $product) {
        $product->averageRating = Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
        $product->totalReviews = Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->count();
    }

    // Hybrid Recommendation Logic
    $recommendedProducts = collect();

    // If user is logged in, use collaborative filtering
    if (session()->has('id')) {
        $userId = session()->get('id');

        // Get products user has purchased/ordered
       // Get products user has purchased/ordered
$userOrderedProducts = OrderIteam::whereHas('order', function($q) use ($userId) {
    $q->where('customerId', $userId);
})->pluck('productId')->unique()->toArray();

// Get products in user's cart
$userCartProducts = Cart::where('customerId', $userId)
                      ->pluck('productId')
                      ->toArray();

// Combine all user-interacted products
$userProductIds = array_unique(array_merge($userOrderedProducts, $userCartProducts));

if (!empty($userProductIds)) {
    // Find users who bought similar products (collaborative filtering)
    $similarUserIds = OrderIteam::whereIn('productId', $userProductIds)
        ->whereHas('order', function($q) use ($userId) {
            $q->where('customerId', '!=', $userId);
        })
        ->with('order') // Eager load the order relationship
        ->get()
        ->pluck('order.customerId') // Now correctly references the relationship
        ->unique()
        ->toArray();

    // Get products bought by similar users (excluding what current user already has)
    if (!empty($similarUserIds)) {
        $collabProducts = OrderIteam::whereHas('order', function($q) use ($similarUserIds) {
                $q->whereIn('customerId', $similarUserIds);
            })
            ->whereNotIn('productId', $userProductIds)
            ->groupBy('productId')
            ->orderByRaw('COUNT(*) DESC')
            ->take(4)
            ->pluck('productId');

        if ($collabProducts->count() > 0) {
            $recommendedProducts = Product::whereIn('id', $collabProducts)
                ->where('id', '!=', $request->input('product_id', 0))
                ->get();
        }
    }
}
    }

    // If not enough recommendations from collaborative filtering, use content-based
    if ($recommendedProducts->count() < 4) {
        $contentBasedProducts = Product::whereNotIn('id', $userProductIds ?? [])
            ->inRandomOrder()
            ->take(4 - $recommendedProducts->count())
            ->get();

        $recommendedProducts = $recommendedProducts->merge($contentBasedProducts);
    }

    // Calculate ratings for recommended products
    foreach ($recommendedProducts as $product) {
        $product->averageRating = Review::where('product_id', $product->id)
                                      ->where('status', 1)
                                      ->avg('rating');
        $product->totalReviews = Review::where('product_id', $product->id)
                                     ->where('status', 1)
                                     ->count();
    }

    $noResults = $filteredProducts->isEmpty();

    return view('shop', compact(
        'filteredProducts',
        'search',
        'minPrice',
        'maxPrice',
        'noResults',
        'category',
        'recommendedProducts'
    ));
    $recommendedProducts = Cache::remember('recommendations_'.(session()->get('id') ?? 'guest'), now()->addHours(1), function() use ($request) {
    // Your recommendation logic here
    return $recommendedProducts;
});
}

    public function profile()
    {
      if(session()->has('id'))
      {
        $user=User::find(session()->get('id'));
        return view('profile',compact('user'));
      }
        return redirect('login');

    }
    public function myOrders()
    {
      if(session()->has('id'))
      {
        $orders=Order::where('customerId',session()->get('id'))->get();
       $items=DB::table('products')
       ->join('order_iteams','order_iteams.productId','products.id')
       ->select('products.title','products.picture','products.pdf','products.video','order_iteams.*')
      ->get();
       return view('orders',compact('orders','items'));
      }
        return redirect('login');

    }
      public function onlineclass()
    {
        // Ensure user is logged in using session directly
        if (!session()->has('id')) { // Check if 'id' (user ID) exists in session
            return redirect()->route('login')->with('error', 'Please log in to view your online classes.');
        }

        $userId = session()->get('id'); // Get the user ID from session directly

        // Fetch accepted bookings for the logged-in user, selecting required teacher and class details
        $onlineClasses = DB::table('booking_classes')
            ->join('live_classes', 'booking_classes.live_class_id', '=', 'live_classes.id')
            ->join('teachers', 'live_classes.teacher_id', '=', 'teachers.id')
            ->select(
                'teachers.name as teacher_name',
                'teachers.course',
                'live_classes.title as live_class_title',
                'live_classes.link as class_link', // The actual link to join the class
                'live_classes.start_time'
            )
            ->where('booking_classes.user_id', $userId) // Filter by logged-in user
            ->where('booking_classes.status', 'accepted') // Only accepted bookings
            ->orderBy('live_classes.start_time', 'asc') // Order classes by their start time
            ->get();

        // Pass the data to the view located directly in 'resources/views/'
        return view('onlineclass', compact('onlineClasses'));
    }

  public function singleProduct($id)
{
    $product = Product::findOrFail($id);

    // Track view if user is logged in
    if (session()->has('id')) {
        try {
            DB::table('product_views')->updateOrInsert(
                ['user_id' => session()->get('id'), 'product_id' => $id],
                ['viewed_at' => now()]
            );
        } catch (\Exception $e) {
            // Log error but don't break the page
            \Log::error("Failed to track product view: " . $e->getMessage());
        }
    }

    $reviews = Review::where('product_id', $id)
                   ->where('status', 1)
                   ->get();

    $averageRating = Review::where('product_id', $id)
                         ->where('status', 1)
                         ->avg('rating');

    $totalReviews = $reviews->count();

    return view('singleProduct', compact('product', 'reviews', 'averageRating', 'totalReviews'));
}

    public function deleteCartItem($id)
    {
        $item=Cart::find($id);
        $item->delete();
        return redirect()->back()->with('success','1 Iteam has been deleted from Cart');;
        return view ('singleProduct',compact('product'));
    }
    public function register()
    {
        return view ('register');
    }
    public function login()
    {
        return view ('login');
    }
    public function logout()
    {
       session()->forget('id');
       session()->forget('type');
       return redirect('/login');
    }
    public function loginUser(Request $data)
    {
       $user = User::where('email', $data->input('email'))->where('password',$data->input('password'))-> first();
       if($user){
        if($user->status=="Blocked"){
            return redirect('login')->with('error','Your Status Is Blocked');
        }
        session()->put('id',$user->id);
        session()->put('type',$user->type);
        session()->put('fullname',$user->fullname);
        if($user->type=='Customer')
        {
            return redirect('/');
        }
        else if($user->type=='Admin')
        {
            return redirect('/admin');
        }
       }
       else{
        return redirect('login')->with('error','Email/Password is incorrect');
       }
    }
    public function registerUser(Request $data)
    {
        $newUser= new User();
        $newUser->fullname=$data->input('fullname');
        $newUser->email=$data->input('email');
        $newUser->password=$data->input('password');
        $newUser->picture=$data->file('file')->getClientOriginalName();
        $data->file('file')->move('uploads/profile/',$newUser->picture);
        $newUser->type='Customer';
        if($newUser->save())
        {
            return redirect('login')->with('success','Congratulation ! Your Account is Ready');
        }
        return view ('register');
}
public function updateUser(Request $data)
    {
        $user=User::find(session()->get('id'));
        $user->fullname=$data->input('fullname');
        // $user->email=$data->input('email');
        $user->password=$data->input('password');
        if($data->file('file')!=null)
     {
        $user->picture=$data->file('file')->getClientOriginalName();
        $data->file('file')->move('uploads/profile/',$user->picture);
     }

        if($user->save())
        {
            return redirect()->back()->with('success','Congratulation ! Your Account is Updated');
        }
        return view ('register');
}
// public function addToCart(Request $data)
// {
//  if(session()->has('id'))
//  {
//     $iteam=new Cart();
//     $iteam->productId=$data->input('id');
//     $iteam->quantity=$data->input('quantity');
//     $iteam->customerId=session()->get('id');
//     $iteam->save();
//     return redirect()->back()->with('success','Congratulations ! Iteam Added Into Cart');
// }
// else{
//     return redirect('login')->with('Error','Info ! Please Login Your Account');
// }
// }

public function addToCart(Request $data)
{
    $validatedData = $data->validate([
        'id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    if (!session()->has('id')) {
        return redirect('login')->with('error', 'Info! Please login to your account.');
    }

    // Check if the product is already in the user's cart
    $existingCartItem = Cart::where('customerId', session()->get('id'))
        ->where('productId', $validatedData['id'])
        ->first();

    if ($existingCartItem) {
        return redirect()->back()->with('error', 'This product is already in your cart.');
    }

    // Add new product to the cart
    $item = new Cart();
    $item->productId = $validatedData['id'];
    $item->quantity = $validatedData['quantity'];
    $item->customerId = session()->get('id');
    $item->save();

    return redirect()->back()->with('success', 'Congratulations! Item added to the cart.');
}


public function updateCart(Request $data)
{
 if(session()->has('id'))
 {
    $iteam=Cart::find($data->input('id'));

    $iteam->quantity=$data->input('quantity');

    $iteam->save();
    return redirect()->back()->with('success','Success ! Iteam Quantity Update.');
}
else{
    return redirect('login')->with('Error','Info ! Please Login Your Account');
}
}
public function saveRating(Request $request, $productId)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'rating' => 'required|integer|between:1,5',
        'comment' => 'required|string|max:1000',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $existingReview = Review::where('product_id', $productId)
        ->where('email', $request->input('email'))
        ->first();

    if ($existingReview) {
        return redirect()->back()->with('error', 'You have already submitted a review for this product.');
    }

    $review = new Review();
    $review->product_id = $productId;
    $review->name = $request->input('name');
    $review->email = $request->input('email');
    $review->rating = $request->input('rating');
    $review->comment = $request->input('comment');
    $review->status = 0;
    $review->save();

    return redirect()->back()->with('success', 'Thank you for your review!');
}
      public function liveteacher()
    {
        // Add authentication check using session()->has('id')
        if (!session()->has('id')) {
            return redirect('login')->with('error', 'Please log in to view live classes.');
        }

        // Fetch all teachers with their associated live classes
        $teachers = Teacher::with('liveClasses')->get();
        return view('liveteacher', compact('teachers'));
    }

    public function singleLiveTeacher($id)
    {
        // Load the teacher with their live classes and their bookings counts
        $teacher = Teacher::with(['liveClasses' => function($query) {
            $query->withCount('bookings'); // Count bookings for each live class
        }])->find($id);

        if (!$teacher) {
            abort(404, 'Teacher not found.');
        }

        return view('singleliveteacher', compact('teacher'));
    }

    // Handle booking a live class
   public function bookLiveClass(Request $request)
    {
        // Redirect to login if user is not authenticated using session()->has('id')
        if (!session()->has('id')) {
            return redirect('login')->with('error', 'Please log in to book a live class.');
        }

        // Get authenticated user's details using session()->get('id')
        $user = User::find(session()->get('id'));

        // Check to ensure the user was found in the database
        if (!$user) {
            session()->forget('id');
            return redirect('login')->with('error', 'Your user session is invalid. Please log in again to book a class.');
        }

        // 1. Validate incoming request data
        $validator = Validator::make($request->all(), [
            'live_class_id' => 'required|exists:live_classes,id', // Ensures the live_class_id is valid
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Booking failed: Please check your input.');
        }

        $liveClass = LiveClass::find($request->input('live_class_id'));

        if (!$liveClass) {
            return redirect()->back()->with('error', 'Live class not found.');
        }

        // Get the associated teacher to check total seats
        $teacher = $liveClass->teacher;

        if (!$teacher) {
            return redirect()->back()->with('error', 'Associated teacher not found for this class.');
        }

        // 2. Check if the user (by user_id) has already booked this specific live class
        //    AND if the booking is currently 'pending' or 'accepted'.
        $existingBooking = BookingClass::where('live_class_id', $liveClass->id)
                                         ->where('user_id', $user->id) // Use $user->id for consistency
                                         ->whereIn('status', ['pending', 'accepted']) // Only consider pending or accepted bookings
                                         ->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'You have already booked this specific class, and your booking is ' . $existingBooking->status . '.');
        }

        // 3. Check seat availability for the teacher
        if ($teacher->booked_seats >= $teacher->total_seats) {
            return redirect()->back()->with('error', 'Sorry, all seats for this teacher\'s sessions are fully booked.');
        }

        // 4. Book the session: Increment teacher's booked_seats and create a booking record
        DB::beginTransaction();
        try {
            // Increment booked_seats on the Teacher model immediately when a new booking is created
            $teacher->increment('booked_seats');

            // Create a new booking record
            BookingClass::create([
                'live_class_id' => $liveClass->id,
                'user_id' => $user->id,
                'student_name' => $user->fullname,
                'student_email' => $user->email,
                'booking_date' => now(),
                'status' => 'pending', // Set status to pending by default
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Class booked successfully! Your booking is pending approval.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Live Class Booking Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to book session. An internal error occurred.');
        }
    }}

