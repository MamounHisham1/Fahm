<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    /**
     * Handle subscription checkout.
     */
    public function checkout(Request $request, string $product, string $plan)
    {
        // Map Stripe product IDs to subscription type names
        $subscriptionTypes = [
            'prod_StQZW1xtmLhfIH' => 'pro',
            'prod_StQb8sdDEmJM48' => 'enterprise',
        ];
        
        $subscriptionType = $subscriptionTypes[$product] ?? 'default';
        $user = $request->user();
        
        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('message', 'Please login to subscribe to a plan.');
        }
        
        // Check if user has an existing active subscription
        $existingSubscription = $user->subscriptions()
            ->whereIn('stripe_status', ['active', 'trialing'])
            ->first();
        
        if ($existingSubscription) {
            // If they're trying to subscribe to the same plan, redirect to pricing
            if ($existingSubscription->stripe_price === $plan) {
                return redirect()->route('pricing')->with('message', 'You are already subscribed to this plan.');
            }
            
            // For plan changes, create checkout session (customer will pay through Stripe)
            return $user->newSubscription($subscriptionType, $plan)
                ->checkout([
                    'success_url' => route('home') . '?plan_changed=true',
                    'cancel_url' => route('pricing'),
                    'metadata' => [
                        'action' => 'plan_change',
                        'old_subscription_id' => $existingSubscription->stripe_id,
                        'user_id' => $user->id,
                    ],
                ]);
        }
        
        // Create new subscription if no existing subscription
        return $user->newSubscription($subscriptionType, $plan)
            ->checkout([
                'success_url' => route('home'),
                'cancel_url' => route('pricing'),
            ]);
    }
}