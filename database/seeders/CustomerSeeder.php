<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerUser = \App\Models\User::where('email', 'customer@example.com')->first();

        if ($customerUser) {
            \App\Models\Customer::create([
                'user_id' => $customerUser->id,
                'company_name' => 'Test Company',
                'address' => '123 Test Street, Mumbai',
                'phone' => '9876543211',
                'email' => 'customer@test.com',
                'city' => 'Mumbai',
                'gst_number' => 'GST123456789',
            ]);
        }
    }
}
