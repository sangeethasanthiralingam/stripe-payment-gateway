<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Exception\CardException;
use Stripe\PaymentMethod;

class PaymentController extends Controller
{
    public function showChargeForm()
    {
        return view('process.charge');
    }

    // public function processCharge(Request $request)
    // {
    //     // Set your Stripe API key.
    //     Stripe::setApiKey('sk_test_51OgmYFJtZ5BpZMH17e6QxCiMAGDiwJ6IJdK85tSaT2f8jbWsTh73r9jMUtBaSQ8Umx2UVDDkClrZvZZlT8ZNCFeG00F7nb6LGM');

    //     // Get the payment amount, name, and email address from the form.
    //     $amount = $request->input('amount') * 100;
    //     $name = $request->input('name');
    //     $email = $request->input('email');

    //     try {
    //         // Create a new Stripe customer.
    //         $customer = Customer::create([
    //             'email' => $email,
    //             'name' => $name,
    //             'source' => $request->input('stripeToken'),
    //         ]);

    //         // Create a new Stripe charge.
    //         $charge = Charge::create([
    //             'customer' => $customer->id,
    //             'amount' => $amount,
    //             'currency' => 'usd',
    //         ]);

    //         // Display a success message to the user.
    //         return 'Payment successful!';
    //     } catch (\Exception $e) {
    //         // Handle any errors
    //         return $e->getMessage();
    //     }
    // }
    public function processCharge(Request $request)
    {
        // Set your Stripe API key.
        Stripe::setApiKey('sk_test_51OgmYFJtZ5BpZMH17e6QxCiMAGDiwJ6IJdK85tSaT2f8jbWsTh73r9jMUtBaSQ8Umx2UVDDkClrZvZZlT8ZNCFeG00F7nb6LGM');
    
        // Get the payment amount, name, and email address from the form.
        $amount = $request->input('amount') * 100;
        $name = $request->input('name');
        $email = $request->input('email');
        $stripeToken = $request->input('stripeToken');
    
        try {
            // Check if the customer already exists
            $existingCustomer = Customer::all(['email' => $email])->first();
        
            if ($existingCustomer) {
                // If customer exists, use the existing customer ID to make the charge
                $customerId = $existingCustomer->id;
            } else {
                // If customer does not exist, create a new customer
                $customer = Customer::create([
                    'email' => $email,
                    'name' => $name,
                ]);
        
                $customerId = $customer->id;
            }
        
            // Attach the PaymentMethod to the customer
            if ($stripeToken) {
                // This assumes $stripeToken is the PaymentMethod ID received from Stripe
                $paymentMethod = PaymentMethod::retrieve($stripeToken);
                $paymentMethod->attach(['customer' => $customerId]);
            }
        
            // Create a new Stripe charge using the customer ID.
            $charge = Charge::create([
                'customer' => $customerId,
                'amount' => $amount,
                'currency' => 'usd',
                'payment_method' => $stripeToken, // Use the PaymentMethod for the charge
                'confirm' => true, // Confirm the PaymentIntent immediately
            ]);
        
            // Display a success message to the user.
            return 'Payment successful!';
        } catch (\Exception $e) {
            // Handle any errors
            return $e->getMessage();
        }
        
    }
    

    public function processPayment(Request $request)
    {
        // Set your Stripe API key
        Stripe::setApiKey('sk_test_51OgmYFJtZ5BpZMH17e6QxCiMAGDiwJ6IJdK85tSaT2f8jbWsTh73r9jMUtBaSQ8Umx2UVDDkClrZvZZlT8ZNCFeG00F7nb6LGM');

        // Retrieve form data from the request
        $cardNumber = $request->input('card_number');
        $expMonth = $request->input('exp_month');
        $expYear = $request->input('exp_year');
        $cvc = $request->input('cvc');
        $amount = $request->input('amount');

        try {
            // Create a charge
            $charge = Charge::create([
                'amount' => $amount, // Amount in cents
                'currency' => 'usd',
                'source' => [
                    'object' => 'card',
                    'number' => $cardNumber,
                    'exp_month' => $expMonth,
                    'exp_year' => $expYear,
                    'cvc' => $cvc,
                ],
                'description' => 'Example charge',
            ]);

            // Handle successful charge
            return 'Charge successful!';
        } catch (CardException $e) {
            // If the card is declined, display an error message
            return 'Card declined: ' . $e->getMessage();
        } catch (\Exception $e) {
            // Catch other exceptions
            return 'Error: ' . $e->getMessage();
        }
    }
}
