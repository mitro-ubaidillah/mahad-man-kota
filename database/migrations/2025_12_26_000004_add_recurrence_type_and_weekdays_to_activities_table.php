<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('recurrence_type')->default('single')->after('recurring_daily');
            $table->json('weekdays')->nullable()->after('recurrence_type');
        });

        // migrate existing recurring_daily values to recurrence_type
        DB::table('activities')->where('recurring_daily', true)->update(['recurrence_type' => 'daily']);
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['recurrence_type','weekdays']);
        });
    }
};
