<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Shipment;

class CheckAgentCity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply this middleware to agents
        if (auth()->check() && auth()->user()->isAgent()) {
            $agent = auth()->user()->agent;
            
            // If trying to access a specific shipment
            if ($request->route('courier')) {
                $shipment = Shipment::find($request->route('courier'));
                
                // Check if shipment belongs to agent's branch
                if ($shipment && $shipment->from_city !== $agent->branch_city && $shipment->to_city !== $agent->branch_city) {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}
