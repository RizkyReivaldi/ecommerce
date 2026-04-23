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

            // Primary key
            $table->id();

            // Relasi ke tabel categories
            $table->foreignId('category_id')
                ->constrained()
                ->index()
                ->cascadeOnDelete();

            // Informasi dasar produk
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->text('description')->nullable();

            // Harga produk (decimal aman untuk uang)
            $table->decimal('price', 12, 2)->index();
            $table->decimal('discount_price', 12, 2)->nullable();

            // Stok barang
            $table->integer('stock')->default(0);

            // Berat barang dalam gram
            $table->integer('weight')
                ->default(0)
                ->comment('dalam gram');

            // Status produk
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // Timestamp
            $table->timestamps();

            // Index untuk optimasi query
            $table->index(['category_id', 'is_active']);
            $table->index('is_featured');
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
