<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function createPaymentIntent( Request $request ) {

        $data = $request->validate([
            'total_price'     => 'required',
            'paymentMethodId' => 'required|string',
            'currency'        => 'nullable|string',
        ]);
        $currency = strtolower($data['currency'] ?? env('STRIPE_CURRENCY', 'inr'));

         $secret = env('STRIPE_SECRET_KEY');
        if (!$secret || trim($secret) === '') {
            \Log::error('Stripe secret missing or empty.');
            return response()->json([
                'error' => 'Stripe secret key not configured on server.',
            ], 500);
        }

        $amountMinor = $this->toMinorUnits($data['total_price'], $currency);
        if ($amountMinor <= 0) {
            return response()->json(['error' => 'Invalid amount.'], 422);
        }

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $pi = PaymentIntent::create([
                'amount'   => $amountMinor,
                'currency' => $currency,
                'payment_method' => $data['paymentMethodId'],
                'confirm'  => true,
                'payment_method_types' => ['card'],
                'metadata' => ['source' => 'food-app-checkout'],
            ]);

            return response()->json([
                'success'            => true,
                'payment_intent_id'  => $pi->id,
                'client_secret'      => $pi->client_secret,
                'status'             => $pi->status,
                'amount'             => $pi->amount,
                'currency'           => $pi->currency,
                'next_action'        => $pi->next_action,
            ]);
        }
        catch (\Stripe\Exception\CardException $e) {
            \Log::error('Stripe Card Error', ['msg' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 402);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            \Log::error('Stripe Invalid Request', [
                'msg' => $e->getMessage(),
                'param' => method_exists($e, 'getError') && $e->getError() ? $e->getError()->param : null,
            ]);
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            \Log::error('Stripe API Error', ['msg' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error('Server Error', ['msg' => $e->getMessage()]);
            return response()->json(['error' => 'Server error.'], 500);
        }
    }

    private function toMinorUnits($raw, string $currency): int
    {
        $zeroDecimal = [
            'bif','clp','djf','gnf','jpy','kmf','krw','mga','pyg',
            'rwf','ugx','vnd','vuv','xaf','xof','xpf'
        ];

        if (is_string($raw)) {
            $raw = preg_replace('/[,\s]/', '', $raw);
        }
        if (!is_numeric($raw)) return 0;

        $val = (float)$raw;

        if (in_array($currency, $zeroDecimal, true)) {
            return (int) round($val);
        }
        return (int) round($val * 100);
    }
}
