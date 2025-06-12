<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Models\Teacher;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/adminProducts', [AdminController::class, 'products']);
Route::get('/adminProfile', [AdminController::class, 'profile']);
Route::get('/ourCustomers', [AdminController::class, 'customers']);
Route::get('/ourOrders', [AdminController::class, 'orders']);

Route::get('/teachers', [AdminController::class, 'teacher'])->name('teachers');
Route::post('/teachers/store', [AdminController::class, 'storeTeacher'])->name('teachers.store');
Route::put('/teachers/update/{id}', [AdminController::class, 'updateTeacher'])->name('teachers.update');
Route::get('/teachers/delete/{id}', [AdminController::class, 'deleteTeacher'])->name('teachers.delete');

// NEW: Routes for Live Class management
// Changed from teachers.addLiveClass to teachers.storeLiveClass and updated parameters
Route::post('/teachers/{teacher}/live-classes', [AdminController::class, 'storeLiveClass'])->name('teachers.storeLiveClass');
Route::put('/live-classes/{liveClass}', [AdminController::class, 'updateLiveClass'])->name('live-classes.update');
Route::delete('/live-classes/{id}', [AdminController::class, 'deleteLiveClass'])->name('live-classes.delete');

// Update these routes for category management
Route::get('/adminCategoriesC', [AdminController::class, 'createCategory'])->name('admin.categories.create');
Route::post('/adminCategoriesStore', [AdminController::class, 'storeCategory'])->name('admin.categories.store');

// Update and delete routes for categories
Route::put('/admin/categories/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
Route::delete('/admin/categories/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');


Route::get('/reviews', [AdminController::class, 'reviews']);
Route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct']);
Route::get('/changeOrderStatus/{status}/{id}', [AdminController::class, 'changeOrderStatus']);
Route::get('/changeUserStatus/{status}/{id}', [AdminController::class, 'changeUserStatus']);
Route::post('/adminProductStore', [AdminController::class, 'storeProduct']);
Route::post('/AddNewProduct', [AdminController::class, 'AddNewProduct']);
Route::post('/UpdateProduct', [AdminController::class, 'UpdateProduct']);

// Admin review management routes
Route::get('/approve-review/{id}', [AdminController::class, 'approveReview']);
Route::get('/reject-review/{id}', [AdminController::class, 'rejectReview']);
Route::get('/delete-review/{id}', [AdminController::class, 'deleteReview'])->name('admin.deleteReview');

//Liveteacher
Route::get('/liveteacher', [MainController::class, 'liveteacher'])->name('liveteacher');
Route::get('/singleliveteacher/{id}', [MainController::class, 'singleLiveTeacher'])->name('singleliveteacher'); // NEW: Added route for single live teacher

// NEW: Single Teacher Profile Page
Route::get('/teacher/{id}', [MainController::class, 'singleTeacherProfile'])->name('teacher.profile');

// NEW: Book Live Class Session (POST route)
// Route::post('/book-live-session', [MainController::class, 'bookLiveSession'])->name('book.live.session'); // New booking route
Route::post('/book-class', [MainController::class, 'bookLiveClass'])->name('book.live.class'); // Changed method name

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/cart', [MainController::class, 'cart']);
Route::get('/checkout', [MainController::class, 'checkout']);
Route::get('/shop', [MainController::class, 'shop']);
Route::get('/single/{id}', [MainController::class, 'singleProduct']);
Route::get('/register', [MainController::class, 'register']);
Route::get('/login', [MainController::class, 'login']);
Route::get('/profile', [MainController::class, 'profile']);
Route::get('/myOrders', [MainController::class, 'myOrders'])->name('myOrders');
Route::get('/deleteCartItem/{id}', [MainController::class, 'deleteCartItem']);
Route::get('/logout', [MainController::class, 'logout']);
Route::post('/registerUser', [MainController::class, 'registerUser']);
Route::post('/loginUser', [MainController::class, 'loginUser']);
Route::post('/addToCart', [MainController::class, 'addToCart']);
Route::post('/updateCart', [MainController::class, 'updateCart']);
Route::post('/save-rating/{productId}', [MainController::class, 'saveRating'])->name('front.saveRating');
Route::post('/updateUser', [MainController::class, 'updateUser']);

// Contact Us Route
Route::get('/contactus', function() {
    return view('contactus');
});

// Payment Routes
Route::get('/payment-success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment-failure', [PaymentController::class, 'failure'])->name('payment.failure');
