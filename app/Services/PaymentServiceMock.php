<?php

namespace App\Services;

use App\Models\Payment;

class PaymentServiceMock
{
    /**
     * Simulate payment processing. Returns array with result and gateway id.
     */
    public function charge(Payment $payment, array $payload = []): array
    {
        // This is a mock. Integrate Stripe/PayPal SDK here.
        $payment->update(["status" => 'paid', 'gateway_payment_id' => 'mock_'.uniqid()]);

        return ['status' => 'paid', 'gateway_payment_id' => $payment->gateway_payment_id];
    }
}
