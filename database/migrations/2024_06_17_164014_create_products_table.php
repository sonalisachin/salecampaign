<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(0);
            // Add a placeholder for the ENUM type
            $table->timestamps();
        });

        // Add the ENUM type using a raw SQL statement
        DB::statement("ALTER TABLE products ADD COLUMN status ENUM('available', 'unavailable', 'pre-order') NOT NULL DEFAULT 'available'");
        DB::statement("ALTER TABLE products ADD COLUMN offer_available ENUM('0', '1') NOT NULL DEFAULT '0'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
