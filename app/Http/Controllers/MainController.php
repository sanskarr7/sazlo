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
    $search = $request->input('search', '');
    $minPrice = $request->input('min_price', 0);
    $maxPrice = $request->input('max_price', PHP_INT_MAX);
    $category = $request->input('category', ''); // Get category from request

    // Start with a base query
    $query = Product::query();

    // Apply category filter if specified
    if ($category) {
        $query->whereHas('category', function($q) use ($category) {
            $q->where('name', $category);
        });
    }

    // Apply search filter if specified
    if ($search) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    // Apply price filter
    if ($minPrice || $maxPrice < PHP_INT_MAX) {
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    // Fetch filtered products with reviews and average ratings
    $filteredProducts = $query->paginate(8);

    foreach ($filteredProducts as $product) {
        $product->averageRating = Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
        $product->totalReviews = Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->count();
    }

    $noResults = $filteredProducts->isEmpty(); // Check if no products are found

    // Return the view with filtered products, search terms, price, ratings, and no results flag
    return view('shop', compact('filteredProducts', 'search', 'minPrice', 'maxPrice', 'noResults', 'category'));
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
   public function singleProduct($id)
{
    $product = Product::find($id);
    $reviews = Review::where('product_id', $id)->where('status', 1)->get(); // Fetch approved reviews
    $averageRating = Review::where('product_id', $id)->where('status', 1)->avg('rating'); // Calculate average rating

    $totalReviews = $reviews->count();
    return view('singleProduct', compact('product', 'reviews', 'averageRating','totalReviews'));
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
public function addToCart(Request $data)
{
 if(session()->has('id'))
 {
    $iteam=new Cart();
    $iteam->productId=$data->input('id');
    $iteam->quantity=$data->input('quantity');
    $iteam->customerId=session()->get('id');
    $iteam->save();
    return redirect()->back()->with('success','Congratulations ! Iteam Added Into Cart');
}
else{
    return redirect('login')->with('Error','Info ! Please Login Your Account');
}
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

    // NEW: Handle booking a live class
public function bookLiveClass(Request $request, LiveClass $liveClass)
    {
        // 1. Validate incoming request data
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
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

        // 2. Check seat availability for the teacher
        if ($teacher->booked_seats >= $teacher->total_seats) {
            return redirect()->back()->with('error', 'Sorry, all seats for this teacher\'s sessions are fully booked.');
        }

        // 3. Check if the user (by email) has already booked this specific live class
        $existingBooking = BookingClass::where('live_class_id', $liveClass->id)
                                        ->where('student_email', $request->input('student_email'))
                                        ->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'You have already booked this specific class.');
        }

        // 4. Book the session: Increment teacher's booked_seats and create a booking record
        DB::beginTransaction();
        try {
            // Increment booked_seats on the Teacher model
            $teacher->increment('booked_seats');

            // Create a new booking record
            BookingClass::create([
                'live_class_id' => $liveClass->id,
                'user_id' => Auth::id(), // Will be null if guest, otherwise logged-in user's ID
                'student_name' => $request->input('student_name'),
                'student_email' => $request->input('student_email'),
                'booking_date' => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Class booked successfully! Check your email for details.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            \Log::error("Live Class Booking Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to book session. An internal error occurred.');
        }
    }
}

