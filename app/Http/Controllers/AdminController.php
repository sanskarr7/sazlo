<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderIteam;
use App\Models\OrderItem;
use App\Models\Teacher;
use App\Models\LiveClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   public function index()
{
    if (session()->get('type') == 'Admin') {
        $totalProducts = Product::count();
        $totalReviews = DB::table('reviews')->count();
        $totalOrders = Order::count();
        $totalUsers = User::where('type', 'Customer')->count();

        return view('Dashboard.index', compact('totalProducts', 'totalReviews', 'totalOrders', 'totalUsers'));
    }
    return redirect()->back();
}

    public function profile()
    {
        if (session()->get('type') == 'Admin') {
            $user = User::find(session()->get('id'));
            return view('Dashboard.profile', compact('user'));
        }

        return redirect()->back();
    }

    public function products()
    {
        if (session()->get('type') == 'Admin') {
            $products = Product::all();
            $categories = Category::all(); // Fetch all categories
            return view('Dashboard.products', compact('products', 'categories')); // Pass categories to the view
        }
        return redirect()->back();
    }
    public function customers()
    {
        if (session()->get('type') == 'Admin') {
            $customers = User::where('type', 'Customer')->get();

            return view('Dashboard.customers', compact('customers'));
        }
        return redirect()->back();
    }
    public function orders()
    {
        if (session()->get('type') == 'Admin') {

            $orderIteams = DB::table('order_iteams')
                ->join('products', 'order_iteams.productId', 'products.id')
                ->select('products.title', 'products.picture','order_iteams.*')
                ->get();

            $orders = DB::table('users')
                ->join('orders', 'orders.customerId', 'users.id')
                ->select('orders.*', 'users.fullname', 'users.email', 'users.status as userStatus')
                ->get();
            return view('Dashboard.orders', compact('orders','orderIteams'));
        }
        return redirect()->back();
    }
    public function deleteProduct($id)
    {
        if (session()->get('type') == 'Admin') {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        }

        return redirect()->back();
    }

    public function changeUserStatus($status, $id)
    {
        if (session()->get('type') == 'Admin') {
            $user = User::find($id);
            $user->status = $status;
            $user->save();
            return redirect()->back()->with('sucess', 'Conguratulation User Status Update Sucessfully');
        }
        return redirect()->back();
    }
    public function changeOrderStatus($status, $id)
    {
        if (session()->get('type') == 'Admin') {
            if ($status == 'Rejected') {
                // Delete order items
                DB::table('order_iteams')->where('orderId', $id)->delete();

                // Delete the order
                $order = Order::find($id);
                if ($order) {
                    $order->delete();
                }

                return redirect()->back()->with('success', 'Order has been rejected and removed from the database.');
            } else {
                // Update the order status for other statuses
                $order = Order::find($id);
                if ($order) {
                    $order->status = $status;
                    $order->save();
                }

                return redirect()->back()->with('success', 'Order status updated successfully.');
            }
        }
        return redirect()->back();
    }

   public function teacher()
    {
        if (session()->get('type') == 'Admin') {
            $teachers = Teacher::with('liveClasses')->get();
            return view('Dashboard.teachers', compact('teachers'));
        }
        return redirect()->back();
    }

    public function storeTeacher(Request $request)
    {
        if (session()->get('type') == 'Admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'number' => 'required|string|max:255',
                'course' => 'required|string|max:255',
                'price' => 'required|numeric',
                'total_seats' => 'required|integer|min:0', // Added validation for total_seats
                'description' => 'nullable|string',
                'more_info' => 'nullable|string',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $teacher = new Teacher();
            $teacher->name = $request->name;
            $teacher->number = $request->number;
            $teacher->course = $request->course;
            $teacher->price = $request->price;
            $teacher->total_seats = $request->total_seats; // Save total_seats
            $teacher->description = $request->description;
            $teacher->more_info = $request->more_info;

            if ($request->hasFile('picture')) {
                $image = $request->file('picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/teachers'), $imageName);
                $teacher->picture = 'uploads/teachers/' . $imageName;
            }

            $teacher->save();
            return redirect()->back()->with('success', 'Teacher added successfully!');
        }
        return redirect()->back();
    }

    public function updateTeacher(Request $request, $id)
    {
        if (session()->get('type') == 'Admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'number' => 'required|string|max:255',
                'course' => 'required|string|max:255',
                'price' => 'required|numeric',
                'total_seats' => 'required|integer|min:0', // Added validation for total_seats
                'description' => 'nullable|string',
                'more_info' => 'nullable|string',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $teacher = Teacher::find($id);
            if (!$teacher) {
                return redirect()->back()->with('error', 'Teacher not found.');
            }

            $teacher->name = $request->name;
            $teacher->number = $request->number;
            $teacher->course = $request->course;
            $teacher->price = $request->price;
            $teacher->total_seats = $request->total_seats; // Update total_seats
            $teacher->description = $request->description;
            $teacher->more_info = $request->more_info;

            if ($request->hasFile('picture')) {
                if ($teacher->picture && File::exists(public_path($teacher->picture))) {
                    File::delete(public_path($teacher->picture));
                }
                $image = $request->file('picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/teachers'), $imageName);
                $teacher->picture = 'uploads/teachers/' . $imageName;
            }

            $teacher->save();
            return redirect()->back()->with('success', 'Teacher updated successfully!');
        }
        return redirect()->back();
    }

    public function deleteTeacher($id)
    {
        if (session()->get('type') == 'Admin') {
            $teacher = Teacher::find($id);
            if ($teacher) {
                if ($teacher->picture && File::exists(public_path($teacher->picture))) {
                    File::delete(public_path($teacher->picture));
                }
                // Delete associated live classes
                $teacher->liveClasses()->delete();
                $teacher->delete();
                return redirect()->back()->with('success', 'Teacher and associated live classes deleted successfully!');
            }
            return redirect()->back()->with('error', 'Teacher not found.');
        }
        return redirect()->back();
    }


    // NEW: Function to display live classes for a specific teacher (or all)
    // You might create a dedicated 'live_classes' page for this.
    // For now, we'll fetch them within the teacher view.
    // The previous `addLiveClass` will now become `storeLiveClass`.

    // NEW: Store a new Live Class for a teacher
    public function storeLiveClass(Request $request, Teacher $teacher)
    {
        if (session()->get('type') == 'Admin') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'link' => 'required|url',
                'start_time' => 'required|date',
                'end_time' => 'nullable|date|after_or_equal:start_time',
                'description' => 'nullable|string',
                'status' => 'nullable|in:scheduled,active,completed,cancelled' // Allow status to be set, default is handled by model
            ]);

            $teacher->liveClasses()->create($validated);

            return back()->with('success', 'Live class scheduled successfully!');
        }
        return redirect()->back();
    }

    // NEW: Update an existing Live Class
    public function updateLiveClass(Request $request, LiveClass $liveClass)
    {
        if (session()->get('type') == 'Admin') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'link' => 'required|url',
                'start_time' => 'required|date',
                'end_time' => 'nullable|date|after_or_equal:start_time',
                'description' => 'nullable|string',
                'status' => 'required|in:scheduled,active,completed,cancelled'
            ]);

            $liveClass->update($validated);

            return back()->with('success', 'Live class updated successfully!');
        }
        return redirect()->back();
    }

    // NEW: Delete a Live Class
    public function deleteLiveClass($id)
    {
        if (session()->get('type') == 'Admin') {
            $liveClass = LiveClass::findOrFail($id);
            $liveClass->delete();
            return back()->with('success', 'Live class deleted successfully!');
        }
        return redirect()->back();
    }

  public function createCategory()
    {
        if (session()->get('type') == 'Admin') {
            $categories = Category::all(); // Fetch all categories
            return view('Dashboard.add_category', compact('categories')); // Pass categories to the view
        }
        return redirect()->back();
    }


    public function storeCategory(Request $request)
    {
        if (session()->get('type') == 'Admin') {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = new Category;
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('success', 'Category added successfully.');
        }
        return redirect()->back();
    }
    // Add these new methods to your AdminController
public function updateCategory(Request $request, $id)
{
    if (session()->get('type') == 'Admin') {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }
    return redirect()->back();
}

public function deleteCategory($id)
{
    if (session()->get('type') == 'Admin') {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
    return redirect()->back();
}

    public function storeProduct(Request $request)
    {
        // Your product storing logic here
    }
    public function AddNewProduct(Request $data)
    {
        if (session()->get('type') == 'Admin') {
            $products = new Product();

            $products->title = $data->input('title');

            // Handle first picture upload
            if ($data->hasFile('file')) {
                $products->picture = $data->file('file')->getClientOriginalName();
                $data->file('file')->move('uploads/profile/products/', $products->picture);
            }

            // Handle second picture upload
            if ($data->hasFile('file2')) {
                $products->picture2 = $data->file('file2')->getClientOriginalName();
                $data->file('file2')->move('uploads/profile/products/', $products->picture2);
            }

            // Handle PDF upload
            if ($data->hasFile('pdf')) {
                $pdfName = time() . '_' . $data->file('pdf')->getClientOriginalName();
                $data->file('pdf')->move('uploads/pdf/', $pdfName);
                $products->pdf = $pdfName;
            }

            // Handle first video upload
            if ($data->hasFile('video')) {
                $videoName = time() . '_' . $data->file('video')->getClientOriginalName();
                $data->file('video')->move('uploads/videos/', $videoName);
                $products->video = $videoName;
            }

            // Handle second video upload
            if ($data->hasFile('video2')) {
                $videoName2 = time() . '_' . $data->file('video2')->getClientOriginalName();
                $data->file('video2')->move('uploads/videos/', $videoName2);
                $products->video2 = $videoName2;
            }

            $products->description = $data->input('description');
            $products->ex_description = $data->input('ex_description');
            $products->price = $data->input('price');
            $products->quantity = $data->input('quantity');
            $products->category = $data->input('category');
            $products->type = $data->input('type');
            $products->save();

            return redirect()->back()->with('success', 'Congratulations, New Product Listed Successfully');
        }
        return redirect()->back();
    }



    public function UpdateProduct(Request $data)
{
    if (session()->get('type') == 'Admin') {
        $products = Product::find($data->input('id'));
        $products->title = $data->input('title');

        // Handle first picture upload
        if ($data->hasFile('file')) {
            $products->picture = $data->file('file')->getClientOriginalName();
            $data->file('file')->move('uploads/profile/products/', $products->picture);
        }

        // Handle second picture upload
        if ($data->hasFile('file2')) {
            $products->picture2 = $data->file('file2')->getClientOriginalName();
            $data->file('file2')->move('uploads/profile/products/', $products->picture2);
        }

        // Handle PDF upload
        if ($data->hasFile('pdf')) {
            $pdfName = time() . '_' . $data->file('pdf')->getClientOriginalName();
            $data->file('pdf')->move('uploads/pdf/', $pdfName);
            $products->pdf = $pdfName;
        }

        // Handle first video upload
        if ($data->hasFile('video')) {
            $videoName = time() . '_' . $data->file('video')->getClientOriginalName();
            $data->file('video')->move('uploads/videos/', $videoName);
            $products->video = $videoName;
        }

        // Handle second video upload
        if ($data->hasFile('video2')) {
            $videoName2 = time() . '_' . $data->file('video2')->getClientOriginalName();
            $data->file('video2')->move('uploads/videos/', $videoName2);
            $products->video2 = $videoName2;
        }

        $products->description = $data->input('description');
        $products->ex_description = $data->input('ex_description');
        $products->price = $data->input('price');
        $products->quantity = $data->input('quantity');
        $products->category = $data->input('category');
        $products->type = $data->input('type');
        $products->save();

        return redirect()->back()->with('success', 'Congratulations, Product Updated Successfully');
    }
    return redirect()->back();
}

    public function reviews()
    {
        if (session()->get('type') == 'Admin') {
            // Fetch all reviews
            $reviews = DB::table('reviews')
                ->join('products', 'reviews.product_id', '=', 'products.id')
                ->select('reviews.*', 'products.title as product_title')
                ->get();

            return view('Dashboard.reviews', compact('reviews'));
        }
        return redirect()->back();
    }
    public function approveReview($id)
    {
        if (session()->get('type') == 'Admin') {
            $review = DB::table('reviews')->where('id', $id)->first();

            if (!$review) {
                return redirect()->back()->with('error', 'Review not found.');
            }

            DB::table('reviews')->where('id', $id)->update(['status' => 1]);

            return redirect()->back()->with('success', 'Review approved successfully.');
        }
        return redirect()->back();
    }

    public function rejectReview($id)
    {
        if (session()->get('type') == 'Admin') {
            $review = DB::table('reviews')->where('id', $id)->first();

            if (!$review) {
                return redirect()->back()->with('error', 'Review not found.');
            }

            DB::table('reviews')->where('id', $id)->update(['status' => 2]);

            return redirect()->back()->with('success', 'Review rejected successfully.');
        }
        return redirect()->back();
    }
    public function deleteReview($id)
    {
        if (session()->get('type') == 'Admin') {
            $review = DB::table('reviews')->where('id', $id)->first();

            if (!$review) {
                return redirect()->back()->with('error', 'Review not found.');
            }

            DB::table('reviews')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Review deleted successfully.');
        }
        return redirect()->back();
    }
}

