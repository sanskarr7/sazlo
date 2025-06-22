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
        User::where('type', 'Customer')->delete(); // Only deletes customers
        // Note: Admin users are not deleted by the line above,
        // but migrate:fresh will clear them anyway.
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create distinct categories
        $categories = ['Mobile', 'Clothing', 'Skin Care', 'Stationery', 'Groceries'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // --- Create Admin User ---
        User::create([
            'fullname' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'admin', // Simple password for testing
            'type' => 'Admin',
            'status' => 'Active',
            'picture' => 'default.jpg'
        ]);

        // Create test users with simple passwords
        $users = [];
        foreach (range(1, 3) as $i) {
            $users[] = User::create([
                'fullname' => 'User '.$i,
                'email' => 'user'.$i.'@test.com',
                'password' => 'user'.$i, // Simple password
                'type' => 'Customer',
                'status' => 'Active',
                'picture' => 'default.jpg'
            ]);
        }

        // Create diverse test products
        $products = [
            // Mobile category
            ['iPhone 13', 'Mobile', 80000, 'new-arrivals'],
            ['Samsung Case', 'Mobile', 500, 'regular'],
            ['Wireless Earbuds', 'Mobile', 2000, 'sale'],

            // Clothing
            ['Cotton T-Shirt', 'Clothing', 800, 'regular'],
            ['Denim Jeans', 'Clothing', 1500, 'sale'],

            // Skin Care (popular category)
            ['Face Wash', 'Skin Care', 300, 'regular'],
            ['Moisturizer', 'Skin Care', 450, 'regular'],

            // Stationery
            ['Notebook Set', 'Stationery', 250, 'new-arrivals'],

            // Groceries
            ['Organic Tea', 'Groceries', 350, 'regular'],
        ];

        foreach ($products as $product) {
            Product::create([
                'title' => $product[0],
                'description' => 'Description for '.$product[0],
                'ex_description' => 'Detailed info about '.$product[0],
                'price' => $product[2],
                'quantity' => 100,
                'category' => $product[1],
                'type' => $product[3],
                'picture' => 'product.jpg',
                'picture2' => 'product.jpg',
                'created_at' => Carbon::now()->subDays(rand(0, 30))
            ]);
        }

        $allProducts = Product::all();

        /* Purchase History Setup */

        // User 1 buys Mobile products
        $order1 = Order::create([
            'customerId' => $users[0]->id,
            'status' => 'Completed',
            'bill' => 80500,
            'address' => '123 Mobile Lane',
            'fullname' => 'Mobile User',
            'phone' => '1111111111'
        ]);
        OrderIteam::create(['orderID' => $order1->id, 'productID' => $allProducts[0]->id, 'quantity' => 1, 'price' => 80000]); // iPhone
        OrderIteam::create(['orderID' => $order1->id, 'productID' => $allProducts[1]->id, 'quantity' => 1, 'price' => 500]); // Case

        // User 2 buys Skin Care products
        $order2 = Order::create([
            'customerId' => $users[1]->id,
            'status' => 'Completed',
            'bill' => 750,
            'address' => '456 Skin Care Ave',
            'fullname' => 'Skin Care User',
            'phone' => '2222222222'
        ]);
        OrderIteam::create(['orderID' => $order2->id, 'productID' => $allProducts[5]->id, 'quantity' => 1, 'price' => 300]); // Face Wash
        OrderIteam::create(['orderID' => $order2->id, 'productID' => $allProducts[6]->id, 'quantity' => 1, 'price' => 450]); // Moisturizer

        // User 3 makes popular purchases (multiple users buy these)
        $order3 = Order::create([
            'customerId' => $users[2]->id,
            'status' => 'Completed',
            'bill' => 3500, // Corrected bill amount
            'address' => '789 Popular St',
            'fullname' => 'Popular User',
            'phone' => '3333333333'
        ]);
        OrderIteam::create(['orderID' => $order3->id, 'productID' => $allProducts[2]->id, 'quantity' => 1, 'price' => 2000]); // Earbuds
        OrderIteam::create(['orderID' => $order3->id, 'productID' => $allProducts[4]->id, 'quantity' => 1, 'price' => 1500]); // Jeans

        // User 1 has Wireless Earbuds in cart
        Cart::create(['customerId' => $users[0]->id, 'productId' => $allProducts[2]->id, 'quantity' => 1]);

        // Add reviews to popular items
        Review::create(['product_id' => $allProducts[2]->id, 'name' => 'Audio Buyer', 'email' => 'audio@test.com', 'rating' => 5, 'comment' => 'Great sound!', 'status' => 1]);
        Review::create(['product_id' => $allProducts[4]->id, 'name' => 'Fashion Buyer', 'email' => 'fashion@test.com', 'rating' => 4, 'comment' => 'Good quality', 'status' => 1]);
    }
}
