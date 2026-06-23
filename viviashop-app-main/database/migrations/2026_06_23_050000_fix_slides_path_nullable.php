<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->text('path')->nullable()->change();
            $table->text('body')->nullable()->change();
            $table->string('url')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->text('path')->nullable(false)->change();
            $table->text('body')->nullable(false)->change();
            $table->string('url')->nullable(false)->change();
        });
    }
};
