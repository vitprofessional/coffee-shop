<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // define columns explicitly to avoid duplicate FK-name issues on some MySQL setups
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('menu_item_id')->nullable();
            $table->string('item_name');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->timestamps();

            // indexes
            $table->index('order_id');
            $table->index('menu_item_id');

            // explicit foreign key names to avoid errno 121 (duplicate key name)
            $table->foreign('order_id', 'fk_order_items_order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('menu_item_id', 'fk_order_items_menu_item_id')
                ->references('id')
                ->on('menu_items')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
