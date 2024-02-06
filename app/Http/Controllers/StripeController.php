<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;

class StripeController extends Controller
{
    public function getCustomerDetails($customerId)
    {
        Stripe::setApiKey('sk_test_51OgmYFJtZ5BpZMH17e6QxCiMAGDiwJ6IJdK85tSaT2f8jbWsTh73r9jMUtBaSQ8Umx2UVDDkClrZvZZlT8ZNCFeG00F7nb6LGM');

        try {
            // Retrieve the customer
            $customer = Customer::retrieve($customerId);

            // Now you can access customer details
            return response()->json($customer);

        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
