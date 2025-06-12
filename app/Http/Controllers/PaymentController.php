<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        // Handle the successful payment logic
        // For example, you can mark the order as completed and redirect to the myOrders page
        // You might also want to validate the response from eSewa

        // Redirect to myOrders with a success message
        return redirect()->route('myOrders')->with('message', 'Payment successful!');
    }

    public function failure(Request $request)
    {
        // Handle the failed payment logic
        // For example, you can log the failure and redirect to an error page

        // Redirect to an error page or index with a failure message
        return redirect()->route('index')->with('error', 'Payment failed!');
    }
}
