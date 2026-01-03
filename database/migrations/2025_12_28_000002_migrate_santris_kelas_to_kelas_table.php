<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // collect distinct non-empty kelas names from santris
        $names = DB::table('santris')
            ->select('kelas')
            ->whereNotNull('kelas')
            ->where('kelas', '<>', '')
            ->distinct()
            ->pluck('kelas')
            ->map(function($v){ return trim($v); })
            ->filter(function($v){ return $v !== ''; })
            ->unique()
            ->values();

        foreach ($names as $name) {
            // create kelas record if not exists
            $exists = DB::table('kelas')->where('name', $name)->first();
            if (!$exists) {
                DB::table('kelas')->insert(['name' => $name, 'created_at' => now(), 'updated_at' => now()]);
            }
        }

        // update santris.kelas_id based on matching name
        $rows = DB::table('santris')
            ->select('id','kelas')
            ->whereNotNull('kelas')
            ->where('kelas','<>','')
            ->get();

        foreach ($rows as $r) {
            $name = trim($r->kelas);
            if ($name === '') {
                continue;
            }
            $k = DB::table('kelas')->where('name', $name)->first();
            if ($k) {
                DB::table('santris')->where('id', $r->id)->update(['kelas_id' => $k->id]);
            }
        }

        // finally drop the legacy kelas column
        if (Schema::hasColumn('santris', 'kelas')) {
            Schema::table('santris', function (Blueprint $table) {
                $table->dropColumn('kelas');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // add back the kelas column
        if (!Schema::hasColumn('santris', 'kelas')) {
            Schema::table('santris', function (Blueprint $table) {
                $table->string('kelas')->nullable()->after('phone');
            });
        }

        // populate kelas from kelas_id if present
        $rows = DB::table('santris')
            ->select('id','kelas_id')
            ->get();

        foreach ($rows as $r) {
            if ($r->kelas_id) {
                $k = DB::table('kelas')->where('id', $r->kelas_id)->first();
                if ($k) {
                    DB::table('santris')->where('id', $r->id)->update(['kelas' => $k->name]);
                }
            }
        }
    }
};
