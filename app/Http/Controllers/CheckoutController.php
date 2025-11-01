<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle subscription checkout.
     */
    private array $subscriptionTypes;

    public function __construct()
    {
        $this->subscriptionTypes = [
            config('fahm.pro_subscription') => 'pro',
            config('fahm.enterprise_subscription') => 'enterprise',
        ];
    }
    
    public function checkout(Request $request, string $product, string $plan)
    {
        $user = $request?->user();

        if (! $user) {
            return redirect()->route('login')->with('message', 'Please login to subscribe to a plan.');
        }

        return $this->subscribeOrUpdatePlan($user, $product, $plan);
    }

    private function subscribeOrUpdatePlan($user, $product, $plan)
    {
        $subscriptionType = $this->subscriptionTypes[$product] ?? 'default';
        
        $existingSubscription = $user->subscriptions()
            ->whereIn('stripe_status', ['active', 'trialing'])
            ->first();

        if ($existingSubscription) {
            $this->updatePlan($user, $subscriptionType, $plan, $existingSubscription);
        }

        return $user->newSubscription($subscriptionType, $plan)
            ->checkout([
                'success_url' => route('home'),
                'cancel_url' => route('pricing'),
            ]);
    }

    private function updatePlan($user, $subscriptionType, $plan, $existingSubscription)
    {
        if ($existingSubscription->stripe_price === $plan) {
            return redirect()->route('pricing')->with('message', 'You are already subscribed to this plan.');
        }

        return $user->newSubscription($subscriptionType, $plan)
            ->checkout([
                'success_url' => route('home').'?plan_changed=true',
                'cancel_url' => route('pricing'),
                'metadata' => [
                    'action' => 'plan_change',
                    'old_subscription_id' => $existingSubscription->stripe_id,
                    'user_id' => $user->id,
                ],
            ]);
    }
}
