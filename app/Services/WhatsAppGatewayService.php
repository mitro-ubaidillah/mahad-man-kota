<?php

namespace App\Services;

use App\Models\WaDevice;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppGatewayService
{
    protected $device;

    public function __construct()
    {
        // Secara default ambil device yang aktif / is_default = true
        $this->device = WaDevice::where('is_default', true)->first() ?? WaDevice::first();
    }

    /**
     * Set device secara manual jika dibutuhkan
     */
    public function setDevice(WaDevice $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * Dapatkan status device saat ini
     */
    public function infoDevice()
    {
        if (!$this->device) return ['status' => false, 'msg' => 'Device belum dikonfigurasi.'];

        $response = Http::post($this->device->base_url . '/info-device', [
            'api_key' => $this->device->api_key,
            'number' => $this->device->sender,
        ]);

        return $response->json();
    }

    /**
     * Generate QR Code untuk pairing device
     */
    public function generateQr()
    {
        if (!$this->device) return ['status' => false, 'msg' => 'Device belum dikonfigurasi.'];

        $response = Http::post($this->device->base_url . '/generate-qr', [
            'api_key' => $this->device->api_key,
            'device' => $this->device->sender,
            'force' => true,
        ]);

        return $response->json();
    }

    /**
     * Logout device / disconnect
     */
    public function logoutDevice()
    {
        if (!$this->device) return ['status' => false, 'msg' => 'Device belum dikonfigurasi.'];

        $response = Http::post($this->device->base_url . '/logout-device', [
            'api_key' => $this->device->api_key,
            'sender' => $this->device->sender,
        ]);

        return $response->json();
    }

    /**
     * Mengirim pesan teks
     */
    public function sendMessage($number, $message)
    {
        if (!$this->device) {
            Log::error('WA Gateway Error: Device tidak ditemukan saat mencoba mengirim pesan ke ' . $number);
            return false;
        }

        try {
            $formattedNumber = $this->formatNumber($number);

            $response = Http::timeout(30)->post($this->device->base_url . '/send-message', [
                'api_key' => $this->device->api_key,
                'sender' => $this->device->sender,
                'number' => $formattedNumber,
                'message' => $message
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['status']) && $data['status'] === true) {
                    return ['success' => true, 'data' => $data];
                }
                Log::warning('WA Gateway Response Failed: ', $data);
                return ['success' => false, 'message' => $data['msg'] ?? 'Unknown error'];
            }

            Log::error('WA Gateway HTTP Error: ' . $response->status());
            return ['success' => false, 'message' => 'HTTP Error: ' . $response->status()];
        } catch (\Exception $e) {
            Log::error('WA Gateway Exception: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Exception: ' . $e->getMessage()];
        }
    }

    /**
     * Format number: Pastikan berawalan 62
     */
    private function formatNumber($number)
    {
        // Hapus karakter selain angka
        $number = preg_replace('/[^0-9]/', '', $number);

        // Jika mulai dengan 0, ubah jadi 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        return $number;
    }
}
