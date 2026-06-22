<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_tool_calls', function (Blueprint $table) {
            $table->id();
            $table->string('tool_name', 100)->index();
            $table->text('args')->nullable();          // JSON-encoded args
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('request_id', 64)->nullable()->index();
            $table->boolean('success')->default(true);
            $table->text('message')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_tool_calls');
    }
};
