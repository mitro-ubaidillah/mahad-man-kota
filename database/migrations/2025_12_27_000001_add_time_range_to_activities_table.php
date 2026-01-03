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
            $table->time('start_time')->nullable()->after('end_date');
            $table->time('end_time')->nullable()->after('start_time');
            $table->boolean('until_finished')->default(false)->after('end_time');
        });

        // Migrate existing `time` values into `start_time` when present
        try {
            DB::table('activities')->whereNotNull('time')->update(['start_time' => DB::raw('time')]);
        } catch (\Exception $e) {
            // ignore - some DB engines or empty tables may cause issues; safe to continue
        }
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['start_time','end_time','until_finished']);
        });
    }
};
