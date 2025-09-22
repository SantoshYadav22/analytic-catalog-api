<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Restaurant;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Restaurant::class)
                  ->constrained()
                  ->cascadeOnDelete();

            $table->decimal('order_amount', 10, 2);
            $table->dateTime('order_time');
            $table->timestamps();

            $table->index(['restaurant_id', 'order_time']);
            $table->index('order_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
