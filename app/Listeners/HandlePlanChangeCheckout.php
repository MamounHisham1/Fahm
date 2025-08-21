<?php

namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class HandlePlanChangeCheckout
{
    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'checkout.session.completed') {
            $this->handleCheckoutCompleted($event->payload);
        }
    }

    /**
     * Handle completed checkout sessions.
     */
    protected function handleCheckoutCompleted(array $payload): void
    {
        $session = $payload['data']['object'];
        
        // Check if this is a plan change checkout
        if (isset($session['metadata']['action']) && $session['metadata']['action'] === 'plan_change') {
            $this->handlePlanChange($session);
        }
    }

    /**
     * Handle plan change after successful checkout.
     */
    protected function handlePlanChange(array $session): void
    {
        try {
            $userId = $session['metadata']['user_id'] ?? null;
            $oldSubscriptionId = $session['metadata']['old_subscription_id'] ?? null;
            
            if (!$userId || !$oldSubscriptionId) {
                Log::warning('Plan change webhook missing required metadata', [
                    'session_id' => $session['id'],
                    'metadata' => $session['metadata'] ?? 'None',
                ]);
                return;
            }
            
            $user = User::find($userId);
            if (!$user) {
                Log::error('User not found for plan change', ['user_id' => $userId]);
                return;
            }
            
            // Find the old subscription and cancel it
            $oldSubscription = $user->subscriptions()
                ->where('stripe_id', $oldSubscriptionId)
                ->first();
                
            if ($oldSubscription) {
                $oldSubscription->cancel();
                Log::info('Old subscription canceled after plan change', [
                    'user_id' => $userId,
                    'old_subscription_id' => $oldSubscriptionId,
                    'session_id' => $session['id'],
                ]);
            }
            
        } catch (\Exception $e) {
            Log::error('Error handling plan change checkout', [
                'error' => $e->getMessage(),
                'session_id' => $session['id'] ?? 'Unknown',
            ]);
        }
    }
}
