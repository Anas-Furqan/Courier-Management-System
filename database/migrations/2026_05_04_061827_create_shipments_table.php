<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->foreignId('sender_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('customers')->onDelete('cascade');
            $table->string('from_city');
            $table->string('to_city');
            $table->enum('courier_type', ['standard', 'express', 'overnight'])->default('standard');
            $table->decimal('weight', 10, 2);
            $table->decimal('price', 10, 2);
            $table->enum('status', ['pending', 'in_transit', 'delivered', 'cancelled'])->default('pending');
            $table->date('booking_date');
            $table->date('expected_delivery_date');
            $table->date('actual_delivery_date')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->index('tracking_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
