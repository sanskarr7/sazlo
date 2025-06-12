<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripePaymentController extends Controller
{
    public function stripcheckout(Request $request)
    {
        // Get the form data
        $fullname = $request->input('fullname');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $bill = $request->input('bill');

        // Validate the form data
        $request->validate([
            'fullname' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'bill' => 'required|numeric',
        ]);

        // Initialize the line items array
        $lineItems = [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => "🏨 Booking: {$fullname}\n📍 Address: {$address}\n💵 Total: \${$bill}",
                ],
                'unit_amount' => $bill * 100, // Convert dollars to cents
            ],
            'quantity' => 1,
        ]];

        try {
            // Set your Stripe secret key from the environment variable
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a new Stripe Checkout session
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => url('/success'),
                'cancel_url' => url('/cancel'),
            ]);

            // Redirect the user to the Stripe Checkout page
            return redirect()->away($session->url);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        // Display success page
        return view('success');
    }

    public function cancel()
    {
        return "Payment was cancelled.";
    }
}
