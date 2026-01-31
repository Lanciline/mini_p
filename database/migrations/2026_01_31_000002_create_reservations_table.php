<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending','confirmed','cancelled'])->default('pending');
            $table->enum('payment_status', ['pending','paid','cancelled'])->default('pending');
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->timestamps();
            $table->index(['property_id','start_date','end_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
