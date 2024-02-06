<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Stripe\Customer as StripeCustomer;

class CustomerController extends Controller
{
    public function showAddCustomerForm()
    {
        return view('add-customer');
    }

    public function addCustomer(Request $request)
    {
        try {
            // Create a new Stripe customer
            $stripeCustomer = StripeCustomer::create([
                'name' => $request->name,
                'email' => $request->email,
                // You can add more customer information as needed
            ]);

            // Store the customer in your database
            Customer::create([
                'stripe_customer_id' => $stripeCustomer->id,
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Redirect or return a response
            return redirect('/')->with('success', 'Customer added successfully');
        } catch (\Exception $e) {
            // Handle any errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function getAllCustomer()
    {
        $customers = Customer::getAllCustomers();
        // return view('customers.index', ['customers' => $customers]);
        return response()->json(['customers' => $customers]);
    }
}
