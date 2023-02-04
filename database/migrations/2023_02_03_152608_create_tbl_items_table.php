<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_items', function (Blueprint $table) {
            $table->id('ItemID');
            $table->string('ItemName');
            $table->decimal('ItemPrice')->default(0.00);
            $table->string('ItemUOM')->default('Pc');
            $table->unsignedBigInteger('BrandID');
            $table->foreign('BrandID')->references('BrandID')->on('tbl_brands')->onDelete('restrict');
            $table->integer('MinStock')->default(0);
            $table->integer('ReorderQty')->default(0);
            $table->string('IsActive')->default('Yes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_items');
    }
};
