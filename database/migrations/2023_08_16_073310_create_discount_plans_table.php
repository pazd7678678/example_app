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
        Schema::create('discount_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('percent');
            $table->enum('payment_type',['cash','ghesti']);
            $table->timestamp('start_at');
            $table->timestamp('expired_at');
            $table->timestamps();
        });

        Schema::create('discount_plan_product', function (Blueprint $table) {
          $table->unsignedBigInteger('discount_plan_id');
          $table->foreign('discount_plan_id')->references('id')->on('discount_plans')->onDelete('cascade');
          $table->unsignedBigInteger('product_id');
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          $table->primary(['discount_plan_id','product_id']);
        });



        Schema::create('discount_plan_user', function (Blueprint $table) {
            $table->unsignedBigInteger('discount_plan_id');
            $table->foreign('discount_plan_id')->references('id')->on('discount_plans')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['discount_plan_id','user_id']);
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_plans');
        Schema::dropIfExists('discount_plan_product');
        Schema::dropIfExists('discount_plan_user');
    }
};
