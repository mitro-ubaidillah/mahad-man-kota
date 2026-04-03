<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaDevice;
use App\Services\WhatsAppGatewayService;
use Illuminate\Http\Request;

class WaDeviceController extends Controller
{
    public function index()
    {
        $device = WaDevice::first();
        return view('admin.whatsapp.device.index', compact('device'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender' => 'required|string',
            'api_key' => 'required|string',
            'base_url' => 'required|url',
        ]);

        $device = WaDevice::first();
        if ($device) {
            $device->update($request->all());
        } else {
            WaDevice::create(array_merge($request->all(), ['is_default' => true]));
        }

        return redirect()->back()->with("success", __("Konfigurasi device WA berhasil disimpan."));
    }

    public function generateQr(WhatsAppGatewayService $waService)
    {
        $response = $waService->generateQr();
        return response()->json($response);
    }

    public function checkStatus(WhatsAppGatewayService $waService)
    {
        $response = $waService->infoDevice();

        if (isset($response['status']) && $response['status'] === true && isset($response['info'][0]['status'])) {
            $device = WaDevice::first();
            if ($device) {
                $status = $response['info'][0]['status']; // Connected, Disconnect, dll
                $device->update(['status' => $status]);
            }
        }

        return response()->json($response);
    }

    public function logout(WhatsAppGatewayService $waService)
    {
        $waService->logoutDevice();
        $device = WaDevice::first();
        if ($device) {
            $device->update(['status' => 'Disconnect']);
        }

        return redirect()->back()->with("success", __("Berhasil disconnect device WA."));
    }
}
