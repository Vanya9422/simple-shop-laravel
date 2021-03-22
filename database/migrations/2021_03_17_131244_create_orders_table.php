<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->text('message')->nullable();
            $table->string('region');
            $table->string('city');
            $table->string('address');
            $table->string('zip');
            $table->integer('quantity');
            $table->boolean('is_confirmed')->default(False);
            $table->boolean('is_approved')->default(False);
            $table->boolean('arrival_confirmed')->default(False);
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
