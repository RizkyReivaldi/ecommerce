<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackProductView
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {

            // 👉 PUT IT RIGHT HERE
            $product = \App\Models\Product::where('slug', $request->route('slug'))->first();

            if ($product) {
                DB::table('user_activities')->insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'type' => 'view',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return $response;
    }
}