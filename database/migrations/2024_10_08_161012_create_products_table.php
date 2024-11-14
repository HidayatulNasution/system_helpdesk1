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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //$table->string('title');
            //$table->string('category');
            //$table->integer('price');
            //$table->timestamp('tgl_entry')->nullable();
            $table->string('user');
            $table->bigInteger('no_hp');
            $table->string('bidang_system');
            $table->string('kategori');
            $table->string('sub_kategori');
            $table->text('problem');
            $table->text('result')->nullable();
            $table->string('menu');
            $table->boolean('prioritas')->default(false);
            $table->boolean('status')->default(false);
            $table->string('handle_by')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
