<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderIteam;
use App\Models\Cart;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecommendationTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Review::truncate();
        Cart::truncate();
        OrderIteam::truncate();
        Order::truncate();
        Product::truncate();
        User::where('type', 'Customer')->delete();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create distinct categories for digital courses
        $categories = ['Programming', 'Design', 'Marketing', 'Business', 'Photography', 'Music Production'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // --- Create Admin User ---
        User::create([
            'fullname' => 'Admin User',
            'email' => 'admin',
            'password' => 'admin', 
            'type' => 'Admin',
            'status' => 'Active',
            'picture' => 'default_admin.png'
        ]);

        // Create test users with simple passwords
        $users = [];
        foreach (range(1, 3) as $i) {
            $users[] = User::create([
                'fullname' => 'Student User '.$i,
                'email' => 'student'.$i.'@test.com',
                'password' => 'student'.$i, // Simple password
                'type' => 'Customer', // Assuming students are customers
                'status' => 'Active',
                'picture' => 'user1.jpg'
            ]);
        }

        // Create diverse test digital courses (using Product model as an example)
        $digitalCoursesData = [
            // Programming category
            ['Complete Python Bootcamp', 'Programming', 99.99, 'new-arrivals', 'python_intro.pdf', 'python_course.mp4', 'python_thumb.jpg'],
            ['JavaScript Deep Dive', 'Programming', 129.99, 'regular', 'js_handbook.pdf', 'js_course.mp4', 'js_thumb.jpg'],
            ['React.js for Beginners', 'Programming', 79.99, 'sale', 'react_cheatsheet.pdf', 'react_course.mp4', 'react_thumb.jpg'],

            // Design
            ['UI/UX Design Masterclass', 'Design', 149.99, 'regular', 'uiux_notes.pdf', 'uiux_course.mp4', 'uiux_thumb.jpg'],
            ['Adobe Photoshop Pro', 'Design', 89.99, 'sale', null, 'photoshop_course.mp4', 'ps_thumb.jpg'],

            // Marketing (popular category)
            ['SEO for Small Businesses', 'Marketing', 59.99, 'regular', 'seo_checklist.pdf', 'seo_course.mp4', 'seo_thumb.jpg'],
            ['Social Media Marketing 2025', 'Marketing', 69.99, 'regular', 'smm_strategy.pdf', 'smm_course.mp4', 'smm_thumb.jpg'],

            // Business
            ['Financial Modeling & Valuation', 'Business', 199.99, 'new-arrivals', 'financial_template.xlsx', 'finance_course.mp4', 'finance_thumb.jpg'],

            // Photography
            ['Portrait Photography Guide', 'Photography', 49.99, 'regular', 'portrait_tips.pdf', 'portrait_course.mp4', 'portrait_thumb.jpg'],
        ];

        foreach ($digitalCoursesData as $course) {
            Product::create([ // Using Product model to store digital course data
                'title' => $course[0],
                'description' => 'Comprehensive course on ' . $course[0],
                'ex_description' => 'Detailed modules and practical exercises for ' . $course[0],
                'price' => $course[2],
                'quantity' => 9999, // High quantity for digital products (unlimited access)
                'category' => $course[1],
                'type' => $course[3],
                'pdf' => 'assets/pdfs/' . $course[4], // Assuming a storage path
                'video' => 'assets/videos/' . $course[5], // Assuming a storage path
                'picture' => 'assets/thumbnails/' . $course[6], // Assuming a storage path
                'picture2' => 'assets/thumbnails/' . $course[6], // Same as picture for simplicity
                'created_at' => Carbon::now()->subDays(rand(0, 60)),
                'updated_at' => Carbon::now(),
            ]);
        }

        $allCourses = Product::all(); // Now contains digital courses

        /* Purchase History Setup for Digital Courses */

        // Student 1 buys Programming courses
        $order1 = Order::create([
            'customerId' => $users[0]->id,
            'status' => 'Completed',
            'bill' => $allCourses[0]->price + $allCourses[1]->price, // Python + JavaScript
            'address' => 'Kapan, Kathmandu',
            'fullname' => 'Ram Sharma',
            'phone' => '1112223333',
            'created_at' => Carbon::now()->subDays(rand(10, 20))
        ]);
        OrderIteam::create(['orderID' => $order1->id, 'productID' => $allCourses[0]->id, 'quantity' => 1, 'price' => $allCourses[0]->price]); // Complete Python Bootcamp
        OrderIteam::create(['orderID' => $order1->id, 'productID' => $allCourses[1]->id, 'quantity' => 1, 'price' => $allCourses[1]->price]); // JavaScript Deep Dive

        // Student 2 buys Marketing courses
        $order2 = Order::create([
            'customerId' => $users[1]->id,
            'status' => 'Completed',
            'bill' => $allCourses[5]->price + $allCourses[6]->price, // SEO + Social Media Marketing
            'address' => 'Rangali, Morang',
            'fullname' => 'Hiri Thapa',
            'phone' => '4445556666',
            'created_at' => Carbon::now()->subDays(rand(5, 15))
        ]);
        OrderIteam::create(['orderID' => $order2->id, 'productID' => $allCourses[5]->id, 'quantity' => 1, 'price' => $allCourses[5]->price]); // SEO for Small Businesses
        OrderIteam::create(['orderID' => $order2->id, 'productID' => $allCourses[6]->id, 'quantity' => 1, 'price' => $allCourses[6]->price]); // Social Media Marketing 2025

        // Student 3 buys popular courses (multiple users might be interested)
        $order3 = Order::create([
            'customerId' => $users[2]->id,
            'status' => 'Completed',
            'bill' => $allCourses[2]->price + $allCourses[3]->price, // React.js + UI/UX Design
            'address' => 'Chabhail, Kathmandu',
            'fullname' => 'Ayush Karki',
            'phone' => '7778889999',
            'created_at' => Carbon::now()->subDays(rand(1, 10))
        ]);
        OrderIteam::create(['orderID' => $order3->id, 'productID' => $allCourses[2]->id, 'quantity' => 1, 'price' => $allCourses[2]->price]); // React.js for Beginners
        OrderIteam::create(['orderID' => $order3->id, 'productID' => $allCourses[3]->id, 'quantity' => 1, 'price' => $allCourses[3]->price]); // UI/UX Design Masterclass

        // Student 1 has React.js for Beginners in cart
        Cart::create(['customerId' => $users[0]->id, 'productId' => $allCourses[2]->id, 'quantity' => 1]);

        // Add reviews to popular items
        Review::create(['product_id' => $allCourses[2]->id, 'name' => 'Tech Enthusiast', 'email' => 'techenthusiast@test.com', 'rating' => 5, 'comment' => 'Fantastic React course, very clear!', 'status' => 1]);
        Review::create(['product_id' => $allCourses[3]->id, 'name' => 'Aspiring Designer', 'email' => 'designer@test.com', 'rating' => 4, 'comment' => 'Great insights into UI/UX.', 'status' => 1]);
        Review::create(['product_id' => $allCourses[5]->id, 'name' => 'Business Owner', 'email' => 'bizowner@test.com', 'rating' => 5, 'comment' => 'Helped my SEO immensely!', 'status' => 1]);
    }
}
