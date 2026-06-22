<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'payment_slip')) {
                // Use ->after() only when the reference column exists
                if (Schema::hasColumn('orders', 'attachments')) {
                    $table->string('payment_slip')->nullable()->after('attachments');
                } else {
                    $table->string('payment_slip')->nullable();
                }
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_slip');
        });
    }
};
