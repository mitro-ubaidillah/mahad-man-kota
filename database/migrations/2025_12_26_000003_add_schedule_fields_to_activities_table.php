<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('activity_date');
            $table->date('end_date')->nullable()->after('start_date');
            $table->time('time')->nullable()->after('end_date');
            $table->boolean('recurring_daily')->default(false)->after('time');
        });
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['start_date','end_date','time','recurring_daily']);
        });
    }
};
