<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agentUser = \App\Models\User::where('email', 'agent@example.com')->first();

        if ($agentUser) {
            \App\Models\Agent::create([
                'user_id' => $agentUser->id,
                'branch_city' => 'Mumbai',
                'agent_code' => 'AG-001',
                'status' => 'active',
            ]);
        }
    }
}
