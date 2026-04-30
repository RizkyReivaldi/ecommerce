<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            if (!Schema::hasColumn('products', 'start_date')) {
                $table->timestamp('start_date')->nullable()->after('price');
            }

            if (!Schema::hasColumn('products', 'end_date')) {
                $table->timestamp('end_date')->nullable()->after('start_date');
            }

            if (!Schema::hasColumn('products', 'location')) {
                $table->string('location')->nullable()->after('end_date');
            }

            if (!Schema::hasColumn('products', 'tickets')) {
                $table->json('tickets')->nullable()->after('location');
            }

            if (!Schema::hasColumn('products', 'banner')) {
                $table->string('banner')->nullable()->after('tickets');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'start_date',
                'end_date',
                'location',
                'tickets',
                'banner',
            ]);
        });
    }
};