<?php

namespace App\Observers;

use App\Models\Attendance;

class AttendanceObserver
{
    /**
     * Handle the Attendance "created" event.
     */
    public function created(Attendance $attendance): void
    {
        $this->sendWhatsAppNotification($attendance);
    }

    /**
     * Handle the Attendance "updated" event.
     */
    public function updated(Attendance $attendance): void
    {
        // Hanya kirim ulang jika status berubah? Atau biarkan saja untuk created.
        // Untuk sekarang kita hanya implement di created (saat abesen di tap)
    }

    protected function sendWhatsAppNotification(Attendance $attendance)
    {
        $santri = $attendance->santri;
        
        // Pastikan santri memiliki nomor telepon
        if (empty($santri->phone)) {
            return;
        }

        // Cari template berdasarkan status (contoh type: attendance_present, attendance_absent, dst)
        $templateType = 'attendance_' . strtolower($attendance->status);
        $template = \App\Models\WhatsappTemplate::where('type', $templateType)
                        ->where('is_active', true)
                        ->first();

        if (!$template) {
            return;
        }

        // Parse Variabel
        $kelasName = $santri->kelas ? $santri->kelas->name : '-';
        
        $message = str_replace(
            ['{nama_santri}', '{nis}', '{kelas}', '{status}', '{waktu}', '{note}'],
            [
                $santri->name, 
                $santri->nis, 
                $kelasName, 
                strtoupper($attendance->status), 
                $attendance->created_at->format('d/m/Y H:i'), 
                $attendance->note ?? '-'
            ],
            $template->message
        );

        // Dispatch Job
        \App\Jobs\SendWhatsappJob::dispatch($santri->phone, $message);
    }

    /**
     * Handle the Attendance "deleted" event.
     */
    public function deleted(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "restored" event.
     */
    public function restored(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "force deleted" event.
     */
    public function forceDeleted(Attendance $attendance): void
    {
        //
    }
}
