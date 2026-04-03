<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhatsappTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Absensi - Hadir (Tepat Waktu)',
                'type' => 'attendance_present',
                'message' => "Assalamualaikum Bpk/Ibu.\n\nKami informasikan bahwa ananda *{nama_santri}* (Kelas: {kelas}) telah tercatat *HADIR* pada: {waktu}.\n\nTerima kasih.",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Absensi - Terlambat',
                'type' => 'attendance_late',
                'message' => "Assalamualaikum Bpk/Ibu.\n\nKami informasikan bahwa ananda *{nama_santri}* (Kelas: {kelas}) telah tercatat *TERLAMBAT* datang pada: {waktu}.\nCatatan: {note}\n\nMohon kerjasamanya agar ananda bisa datang lebih awal. Terima kasih.",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Absensi - Alpa',
                'type' => 'attendance_absent',
                'message' => "Assalamualaikum Bpk/Ibu.\n\nKami informasikan bahwa ananda *{nama_santri}* (Kelas: {kelas}) tercatat *TIDAK HADIR (ALPA)* pada: {waktu} tanpa keterangan.\n\nMohon konfirmasinya kepada pihak sekolah. Terima kasih.",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($templates as $template) {
             \App\Models\WhatsappTemplate::updateOrCreate(
                ['type' => $template['type']],
                $template
             );
        }
    }
}
