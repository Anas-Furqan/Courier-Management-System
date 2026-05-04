<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\Shipment;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalShipments = Shipment::count();
        $deliveredCount = Shipment::where('status', 'delivered')->count();
        $inTransitCount = Shipment::where('status', 'in_transit')->count();
        $pendingCount = Shipment::where('status', 'pending')->count();
        $totalAgents = Agent::count();
        $totalCustomers = Customer::count();
        
        $recentShipments = Shipment::with('sender', 'receiver')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalShipments',
            'deliveredCount',
            'inTransitCount',
            'pendingCount',
            'totalAgents',
            'totalCustomers',
            'recentShipments'
        ));
    }

    public function statistics()
    {
        return response()->json([
            'total_shipments' => Shipment::count(),
            'delivered' => Shipment::where('status', 'delivered')->count(),
            'in_transit' => Shipment::where('status', 'in_transit')->count(),
            'pending' => Shipment::where('status', 'pending')->count(),
            'agents' => Agent::count(),
            'customers' => Customer::count(),
        ]);
    }

    // Agents Management
    /**
     * Display a listing of agents.
     */
    public function index()
    {
        $agents = Agent::with('user')->paginate(10);
        return view('admin.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new agent.
     */
    public function create()
    {
        return view('admin.agents.create');
    }

    /**
     * Store a newly created agent.
     */
    public function store(StoreAgentRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'agent',
            'status' => 'active',
        ]);

        Agent::create([
            'user_id' => $user->id,
            'branch_city' => $request->branch_city,
            'agent_code' => $request->agent_code,
            'status' => 'active',
        ]);

        return redirect('/admin/agents')->with('success', 'Agent created successfully');
    }

    /**
     * Display the specified agent.
     */
    public function show(string $id)
    {
        $agent = Agent::with('user')->findOrFail($id);
        return view('admin.agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified agent.
     */
    public function edit(string $id)
    {
        $agent = Agent::with('user')->findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }

    /**
     * Update the specified agent.
     */
    public function update(UpdateAgentRequest $request, string $id)
    {
        $agent = Agent::findOrFail($id);
        $user = $agent->user;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $agent->update([
            'branch_city' => $request->branch_city,
            'agent_code' => $request->agent_code,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Agent updated successfully');
    }

    /**
     * Remove the specified agent.
     */
    public function destroy(string $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->user()->delete();
        $agent->delete();

        return redirect('/admin/agents')->with('success', 'Agent deleted successfully');
    }

    // Customers Management
    public function customers()
    {
        $customers = Customer::with('user')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function searchCustomer(Request $request)
    {
        $query = $request->input('q');
        $customers = Customer::where('company_name', 'like', "%{$query}%")
                              ->orWhere('email', 'like', "%{$query}%")
                              ->orWhere('phone', 'like', "%{$query}%")
                              ->with('user')
                              ->paginate(10);
        
        return view('admin.customers.index', compact('customers'));
    }

    public function showCustomer($id)
    {
        $customer = Customer::with('user', 'sentShipments', 'receivedShipments')->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }
}
