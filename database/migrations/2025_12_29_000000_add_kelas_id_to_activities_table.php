<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->foreignId('kelas_id')->nullable()->after('id')->constrained('kelas')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kelas_id');
        });
    }
};
