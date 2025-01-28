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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->string('pickup_address');
            $table->string('delivery_address');
            $table->string('cargo_type');
            $table->string('cargo_weight');
            $table->string('truck_type');
            $table->integer('truck_qty')->default(1);
            $table->date('pickup_date');
            $table->date('delivery_date');
            $table->string('message', 500)->nullable();
            $table->enum('status', ['pending', 'in_progress', 'delivered', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
