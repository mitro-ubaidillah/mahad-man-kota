<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;

class WhatsappBroadcastController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $santris = Santri::orderBy('name')->get();
        $templates = WhatsappTemplate::where('is_active', true)->get();
        return view('admin.whatsapp.broadcast.index', compact('kelas', 'santris', 'templates'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'target_type' => 'required|in:all,kelas,santri',
            'target_kelas' => 'required_if:target_type,kelas',
            'target_santri' => 'required_if:target_type,santri',
            'message' => 'required|string',
        ]);

        $query = Santri::whereNotNull('phone')->where('phone', '!=', '');

        if ($request->target_type === 'kelas') {
            $query->where('kelas', $request->target_kelas);
        } elseif ($request->target_type === 'santri') {
            $query->where('id', $request->target_santri);
        }

        $santris = $query->get();
        $messageTemplate = $request->message;
        $count = 0;

        foreach ($santris as $santri) {
            // Replace dynamic variables if any
            $kelasName = $santri->kelas ? $santri->kelas->name : '-';
            $personalMessage = str_replace(
                ['{nama_santri}', '{nis}', '{kelas}'],
                [$santri->name, $santri->nis, $kelasName],
                $messageTemplate
            );

            // Dispatch job
            \App\Jobs\SendWhatsappJob::dispatch($santri->phone, $personalMessage);
            $count++;
        }

        return redirect()->back()->with("success", __("Pesan broadcast sedang diproses dan dikirimkan ke {$count} wali santri."));
    }
}
