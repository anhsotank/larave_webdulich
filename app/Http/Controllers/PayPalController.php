<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Str;
class PayPalController extends Controller
{
    public function createTransaction(Request $request)
    {


        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => str($request->vnd)
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['status'] == "CREATED") {
            // Redirect to PayPal Checkout page
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->back()->with('error', 'Something went wrong.');
    }

    public function captureTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == "COMPLETED") {
            return redirect()->route('paypal.success')->with('success', 'Payment completed successfully.');
        }

        return redirect()->route('paypal.cancel')->with('error', 'Payment failed.');
    }

    public function successTransaction()
    {
        return "Payment completed successfully!";
    }

    public function cancelTransaction()
    {
        return "Payment canceled!";
    }
}
