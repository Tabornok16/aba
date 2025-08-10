<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('registration_date')->nullable();
            $table->timestamp('account_expiry')->nullable();
            $table->boolean('is_temporary')->default(false);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['registration_date', 'account_expiry', 'is_temporary']);
        });
    }
};
