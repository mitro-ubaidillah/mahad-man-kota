<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->string('guardian_name')->nullable()->after('birth_date');
            $table->string('guardian_relation')->nullable()->after('guardian_name');
            $table->string('guardian_phone')->nullable()->after('guardian_relation');
            $table->text('guardian_address')->nullable()->after('guardian_phone');
            $table->string('status')->default('active')->after('guardian_address');
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE santris MODIFY name VARCHAR(255) NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::table('santris')
                ->whereNull('name')
                ->update(['name' => 'Draft Santri']);

            DB::statement('ALTER TABLE santris MODIFY name VARCHAR(255) NOT NULL');
        }

        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn([
                'guardian_name',
                'guardian_relation',
                'guardian_phone',
                'guardian_address',
                'status',
            ]);
        });
    }
};
