# Dokumentasi API Duta WA Gateway

> **Version:** 1.2  
> **Base URL:** `https://mpwa.dutacorpora.co.id` (default)  
> **Last Updated:** 7 Maret 2026  
> **Author:** Duta Corpora Indonesia
> **Catatan Penting:** Base URL bersifat **DINAMIS per device** - setiap sender bisa menggunakan server/domain yang berbeda. Simpan `gateway_base_url` dan `gateway_api_key` di tabel `wa_devices` per device.

---

## Daftar Isi

1. [Autentikasi](#1-autentikasi)
2. [Send Message API](#2-send-message-api)
3. [Send Media API](#3-send-media-api)
4. [Send Sticker API](#4-send-sticker-api)
5. [Send Button API](#5-send-button-api)
6. [Send List API](#6-send-list-api)
7. [Send Poll API](#7-send-poll-api)
8. [Send Location API](#8-send-location-api)
9. [Send VCard API](#9-send-vcard-api)
10. [Generate QR API (Pairing Device)](#10-generate-qr-api-pairing-device)
11. [Logout Device API](#11-logout-device-api)
12. [Create Device API](#12-create-device-api)
13. [Info User API](#13-info-user-api)
14. [Info Device API](#14-info-device-api)
15. [Check Number API](#15-check-number-api)
16. [Get Groups API](#16-get-groups-api)
17. [Profile Picture API](#17-profile-picture-api)
18. [Fitur yang Belum Terekspose](#18-fitur-yang-belum-terekspose)
19. [Saran Fitur Baru](#19-saran-fitur-baru)
20. [Error Handling](#20-error-handling)
21. [Best Practices](#21-best-practices)

---

## 1. Autentikasi

Semua request ke API Duta WA Gateway memerlukan **API Key** sebagai parameter autentikasi.

### Format Autentikasi

```php
// Parameter dalam request body (POST) atau query string (GET)
'api_key' => 'your_api_key_here'
```

### Header yang Direkomendasikan

```php
$headers = [
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
];
```

---

## 2. Send Message API

Mengirim pesan teks melalui WhatsApp.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-message` |
| GET    | `/send-message` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key untuk autentikasi |
| `sender` | string | Yes | Nomor device pengirim (contoh: `62888xxxx`) |
| `number` | string | Yes | Nomor penerima (contoh: `62888xxxx` atau `72888xxxx`) |
| `message` | string | Yes | Isi pesan yang akan dikirim |

### Contoh Request

#### POST (JSON)

```php
use Illuminate\Support\Facades\Http;

$response = Http::post('https://mpwa.dutacorpora.co.id/send-message', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432',
    'message' => 'Assalamualaikum, ini pesan dari SIMZIS'
]);
```

```json
{
    "api_key": "1234567890",
    "sender": "6288812345678",
    "number": "6288898765432",
    "message": "Assalamualaikum, ini pesan dari SIMZIS"
}
```

#### GET (URL)

```
https://mpwa.dutacorpora.co.id/send-message?api_key=1234567890&sender=6288812345678&number=6288898765432&message=Assalamualaikum
```

### Contoh Response

```json
{
    "status": true,
    "message": "Message sent successfully",
    "data": {
        "message_id": "3EB0xxxxx",
        "to": "6288898765432",
        "timestamp": "1704067200"
    }
}
```

---

## 3. Send Media API

Mengirim media (gambar, video, audio, dokumen) melalui WhatsApp.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-media` |
| GET    | `/send-media` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key untuk autentikasi |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor penerima |
| `media_type` | string | Yes | Tipe media: `image`, `video`, `audio`, `document` |
| `url` | string | Yes | URL langsung ke file media (bukan Google Drive/dll) |
| `caption` | string | No | Caption atau keterangan media |

### Catatan Penting

> **URL harus direct link**, bukan link dari Google Drive atau cloud storage lainnya. Pastikan file dapat diakses secara publik.

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/send-media', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432',
    'media_type' => 'image',
    'url' => 'https://example.com/kwitansi-zakat.jpg',
    'caption' => 'Bukti Kwitansi Zakat Fitrah Anda'
]);
```

```json
{
    "api_key": "1234567890",
    "sender": "6288812345678",
    "number": "6288898765432",
    "media_type": "image",
    "url": "https://example.com/kwitansi-zakat.jpg",
    "caption": "Bukti Kwitansi Zakat Fitrah Anda"
}
```

### Media Types yang Didukung

| media_type | Deskripsi | Format yang Didukung |
|------------|-----------|---------------------|
| `image` | Gambar | JPG, PNG, GIF, WEBP |
| `video` | Video | MP4, 3GP, MOV |
| `audio` | Audio | MP3, OGG, AAC |
| `document` | Dokumen | PDF, DOC, DOCX, XLS, XLSX |

---

## 4. Send Sticker API

Mengirim sticker (WebP format) melalui WhatsApp.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-sticker` |
| GET    | `/send-sticker` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor penerima |
| `url` | string | Yes | URL ke file sticker (WebP) |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/send-sticker', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432',
    'url' => 'https://example.com/sticker.webp'
]);
```

---

## 5. Send Button API

Mengirim pesan dengan tombol interaktif.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-button` |
| GET    | `/send-button` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor penerima |
| `message` | string | Yes | Isi pesan |
| `buttons` | array | Yes | Array tombol (format JSON) |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/send-button', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432',
    'message' => 'Pilih salah satu:',
    'buttons' => json_encode([
        ['buttonId' => 'btn1', 'buttonText' => 'Ya'],
        ['buttonId' => 'btn2', 'buttonText' => 'Tidak']
    ])
]);
```

---

## 6. Send List API

Mengirim pesan dengan list menu interaktif.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-list` |
| GET    | `/send-list` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor penerima |
| `title` | string | Yes | Judul list |
| `description` | string | Yes | Deskripsi |
| `buttonText` | string | Yes | Teks tombol |
| `sections` | array | Yes | Array section dengan items |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/send-list', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432',
    'title' => 'Menu Layanan',
    'description' => 'Pilih layanan yang Anda butuhkan',
    'buttonText' => 'Pilih Layanan',
    'sections' => json_encode([
        [
            'title' => 'Zakat',
            'rows' => [
                ['rowId' => 'zakat_fitrah', 'title' => 'Zakat Fitrah', 'description' => 'Rp 40.000/jiwa'],
                ['rowId' => 'zakat_maal', 'title' => 'Zakat Maal', 'description' => 'Zakat harta']
            ]
        ]
    ])
]);
```

---

## 7. Send Poll API

Mengirim polling message.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-poll` |
| GET    | `/send-poll` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor penerima atau Group ID |
| `name` | string | Yes | Judul poll |
| `options` | array | Yes | Array pilihan poll |
| `selectableCount` | int | No | Jumlah pilihan yang bisa dipilih |

---

## 8. Send Location API

Mengirim lokasi (GPS coordinates).

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-location` |
| GET    | `/send-location` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor penerima |
| `latitude` | float | Yes | Koordinat latitude |
| `longitude` | float | Yes | Koordinat longitude |
| `address` | string | No | Alamat lokasi |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/send-location', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432',
    'latitude' => -6.200000,
    'longitude' => 106.816666,
    'address' => 'Jakarta, Indonesia'
]);
```

---

## 9. Send VCard API

Mengirim kartu kontak (contact card).

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/send-vcard` |
| GET    | `/send-vcard` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor penerima |
| `contact_name` | string | Yes | Nama kontak |
| `contact_number` | string | Yes | Nomor telepon kontak |

---

## 10. Generate QR API (Pairing Device)

Generate QR Code untuk memasangkan device WhatsApp baru ke sistem.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/generate-qr` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `device` | string | Yes | Nomor device yang akan dipasangkan |
| `force` | boolean | No | Jika `true`, device akan dibuat jika belum ada |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/generate-qr', [
    'api_key' => '1234567890',
    'device' => '6288812345678',
    'force' => true
]);
```

### Response Variations

#### 1. Processing (Perlu Polling)

```json
{
    "status": "processing",
    "message": "Processing"
}
```
> Lanjutkan polling hingga mendapat QR code atau device terhubung.

#### 2. QR Code Ready

```json
{
    "status": false,
    "qrcode": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgUAAARQAAAEUC...",
    "message": "Please scan qrcode"
}
```
> Tampilkan QR code ini untuk di-scan via WhatsApp di HP.

#### 3. Device Already Connected

```json
{
    "status": false,
    "msg": "Device already connected!"
}
```

#### 4. Failed Response

```json
{
    "status": false,
    "msg": "Invalid data!",
    "errors": {
        "device": ["The device field is required."]
    }
}
```

---

## 5. Logout Device API

Disconnect atau logout device WhatsApp dari sistem.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/logout-device` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device yang akan di-logout |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/logout-device', [
    'api_key' => '1234567890',
    'sender' => '6288812345678'
]);
```

### Response

```json
{
    "status": true,
    "message": "device disconnected"
}
```

---

## 6. Create Device API

Membuat device baru dalam sistem (tanpa pairing).

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/create-device` |
| GET    | `/create-device` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Sender ID (minimal 8 karakter, harus unik) |
| `urlwebhook` | string | No | URL webhook untuk callback incoming message |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/create-device', [
    'api_key' => '1234567890',
    'sender' => 'SIMZIS_PCNU_01',
    'urlwebhook' => 'https://simzis.dutacorpora.co.id/api/whatsapp/webhook'
]);
```

### Response

```json
{
    "status": true,
    "message": "Device created successfully",
    "data": {
        "id": 1,
        "sender": "SIMZIS_PCNU_01"
    }
}
```

---

## 7. Info User API

Mendapatkan informasi akun user.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/info-user` |
| GET    | `/info-user` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `username` | string | Yes | Username (tanpa simbol) |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/info-user', [
    'api_key' => '1234567890',
    'username' => 'dutacorpora'
]);
```

### Response

```json
{
    "status": true,
    "info": {
        "id": 1,
        "username": "dutacorpora",
        "email": "admin@dutacorpora.co.id",
        "email_verified_at": "2024-01-01T00:00:00.000000Z",
        "api_key": "1234567890",
        "chunk_blast": 100,
        "level": "premium",
        "status": "active",
        "limit_device": 10,
        "active_subscription": true,
        "subscription_expired": "2025-12-31",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-06-01T00:00:00.000000Z"
    }
}
```

---

## 8. Info Device API

Mendapatkan informasi status device WhatsApp.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/info-device` |
| GET    | `/info-device` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `number` | string | Yes | Nomor device yang dicek |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/info-device', [
    'api_key' => '1234567890',
    'number' => '6288812345678'
]);
```

### Response

```json
{
    "status": true,
    "info": [
        {
            "id": 1,
            "user_id": 1,
            "body": "6288812345678",
            "webhook": "https://example.com/webhook",
            "status": "Connected",
            "created_at": "2024-08-16T11:07:27.000000Z",
            "updated_at": "2024-08-16T11:07:27.000000Z",
            "message_sent": 150,
            "reply_when": "Personal",
            "wh_read": 1,
            "reject_call": 0,
            "wh_typing": 0
        }
    ]
}
```

### Device Status Values

| Status | Deskripsi |
|--------|-----------|
| `Connected` | Device terhubung dan siap mengirim pesan |
| `Disconnect` | Device terputus, perlu reconnect |
| `Loading` | Device sedang dalam proses pairing |
| `qr` | Menunggu scan QR code |

---

## 15. Check Number API

Mengecek apakah nomor terdaftar di WhatsApp.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/check-number` |
| GET    | `/check-number` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim |
| `number` | string | Yes | Nomor yang akan dicek |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/check-number', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432'
]);
```

### Response

```json
{
    "status": true,
    "registered": true,
    "jid": "6288898765432@s.whatsapp.net"
}
```

---

## 16. Get Groups API

Mengambil daftar semua group WhatsApp yang diikuti device.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/backend-getgroups` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `token` | string | Yes | Device token/sender |

### Response

```json
{
    "status": true,
    "groups": [
        {
            "id": "120363xxx@g.us",
            "name": "Group Zakat NU",
            "participants": 150
        }
    ]
}
```

---

## 17. Profile Picture API

Mendapatkan foto profil WhatsApp berdasarkan nomor.

### Endpoint

| Method | Endpoint |
|--------|----------|
| POST   | `/get-profile-picture` |

### Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `api_key` | string | Yes | API Key |
| `sender` | string | Yes | Nomor device pengirim (yang sudah connect) |
| `number` | string | Yes | Nomor yang akan diambil fotonya |

### Contoh Request

```php
$response = Http::post('https://mpwa.dutacorpora.co.id/get-profile-picture', [
    'api_key' => '1234567890',
    'sender' => '6288812345678',
    'number' => '6288898765432'
]);
```

### Response Success

```json
{
    "status": true,
    "ppUrl": "https://pps.whatsapp.net/v/t61.29650-8/xxx.jpg"
}
```

### Response No Profile Picture

Jika nomor tidak memiliki foto profil, akan mengembalikan default avatar:

```json
{
    "status": true,
    "ppUrl": "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1200px-WhatsApp.svg.png"
}
```

### Use Cases

1. **Device Avatar** - Simpan avatar device saat berhasil connect
2. **Contact Photo** - Tampilkan foto kontak di phonebook
3. **Incoming Message** - Tampilkan foto pengirim di webhook

---

## 18. Fitur yang Belum Terekspose (Internal Only)

Fitur-fitur berikut sudah ada di codebase WA Gateway namun belum ada endpoint API publik:

| Fitur | Lokasi | Deskripsi |
|-------|--------|-----------|
| **Pairing Code Login** | `server/whatsapp.js:101-120` | Login via OTP/pairing code (bukan QR) |
| **Reject Call Auto** | `server/whatsapp.js` | Otomatis menolak panggilan masuk |
| **Presence Update** | `server/router/index.js` | Set status online/available |
| **History Sync** | `server/whatsapp.js` | Sync chat history dari WhatsApp |
| **AI Plugins** | `server/plugins/` | ChatGPT, Gemini, Claude, Zai AI integrations |
| **Sticker Bot** | `server/plugins/botsticker.js` | Auto-generate sticker dari gambar |
| **Clear Cache** | `server/router/index.js` | Hapus cache device |
| **Set Available** | `backend-send-available` | Set status online/typing |

### AI Plugins yang Tersedia

| Plugin | File | Deskripsi |
|--------|------|-----------|
| ChatGPT | `plugins/chatgpt.js` | Integrasi OpenAI ChatGPT |
| Gemini AI | `plugins/geminiAi.js` | Integrasi Google Gemini |
| Claude AI | `plugins/claudeai.js` | Integrasi Anthropic Claude |
| Zai AI | `plugins/zaiAi.js` | Integrasi Zai AI |
| Spreadsheet | `plugins/spreadsheet.js` | Integrasi Google Sheets |

---

## 19. Saran Fitur Baru

Fitur yang bisa ditambahkan untuk pengembangan WA Gateway:

| Prioritas | Fitur | Deskripsi |
|-----------|-------|-----------|
| **TINGGI** | **Get Profile Picture API** | Endpoint untuk mendapatkan avatar berdasarkan nomor |
| **TINGGI** | **Get Profile Info** | Mendapatkan info profil (nama, about, status) |
| **SEDANG** | **Download Media** | Download media dari pesan masuk |
| **SEDANG** | **Group Management** | Add/remove member, set admin, dll |
| **SEDANG** | **Read Message Status** | Cek status read/delivered |
| **SEDANG** | **Block/Unblock Contact** | Blokir kontak |
| **RENDAH** | **Set Status/About** | Ubah status/about WhatsApp |
| **RENDAH** | **Change Profile Picture** | Ubah foto profil device |
| **RENDAH** | **Reaction Message** | React ke pesan dengan emoji |

---

## 20. Error Handling

### Format Error Response

```json
{
    "status": false,
    "msg": "Error message here",
    "errors": {
        "field_name": ["Validation error message"]
    }
}
```

### Common Error Codes

| HTTP Code | Deskripsi |
|-----------|-----------|
| 200 | Request berhasil |
| 400 | Bad Request - Parameter tidak valid |
| 401 | Unauthorized - API Key tidak valid |
| 403 | Forbidden - Tidak memiliki akses |
| 404 | Not Found - Resource tidak ditemukan |
| 429 | Too Many Requests - Rate limit exceeded |
| 500 | Internal Server Error |

### Error Handling di Laravel

```php
use Illuminate\Support\Facades\Http;

try {
    $response = Http::timeout(30)->post('https://mpwa.dutacorpora.co.id/send-message', [
        'api_key' => config('services.wa_gateway.api_key'),
        'sender' => $sender,
        'number' => $number,
        'message' => $message
    ]);

    if ($response->successful()) {
        $data = $response->json();
        if ($data['status'] === true) {
            return ['success' => true, 'data' => $data];
        }
        return ['success' => false, 'message' => $data['msg'] ?? 'Unknown error'];
    }

    return ['success' => false, 'message' => 'HTTP Error: ' . $response->status()];
} catch (\Exception $e) {
    return ['success' => false, 'message' => 'Exception: ' . $e->getMessage()];
}
```

---

## 21. Best Practices

### 1. Keamanan API Key

```php
// Simpan di .env
WA_GATEWAY_API_KEY=your_api_key_here
WA_GATEWAY_BASE_URL=https://mpwa.dutacorpora.co.id

// Akses di config
'wa_gateway' => [
    'api_key' => env('WA_GATEWAY_API_KEY'),
    'base_url' => env('WA_GATEWAY_BASE_URL'),
],
```

### 2. Queue untuk Pengiriman Massal

```php
// Job untuk mengirim WA
class SendWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Http::post(config('services.wa_gateway.base_url') . '/send-message', [
            'api_key' => config('services.wa_gateway.api_key'),
            'sender' => $this->sender,
            'number' => $this->number,
            'message' => $this->message
        ]);
    }
}
```

### 3. Rate Limiting

```php
// Rate limit untuk menghindari spam
RateLimiter::for('whatsapp', function (Request $request) {
    return Limit::perMinute(30)->by($request->user()->id);
});
```

### 4. Retry Logic

```php
$response = Http::retry(3, 1000)->post(...);
```

### 5. Logging

```php
Log::channel('whatsapp')->info('WA Sent', [
    'to' => $number,
    'message' => $message,
    'response' => $response->json()
]);
```

---

## Appendix: Ringkasan Endpoint

### A. Endpoint Publik (Laravel API)

| Endpoint | Method | Fungsi |
|----------|--------|--------|
| `/send-message` | POST/GET | Kirim pesan teks |
| `/send-media` | POST/GET | Kirim media (gambar/video/audio/doc) |
| `/send-sticker` | POST/GET | Kirim sticker (WebP) |
| `/send-button` | POST/GET | Kirim pesan dengan tombol interaktif |
| `/send-list` | POST/GET | Kirim pesan dengan list menu |
| `/send-poll` | POST/GET | Kirim polling message |
| `/send-location` | POST/GET | Kirim lokasi (GPS) |
| `/send-vcard` | POST/GET | Kirim contact card |
| `/check-number` | POST/GET | Cek nomor terdaftar WA |
| `/get-profile-picture` | POST | Ambil foto profil WhatsApp |
| `/generate-qr` | POST | Generate QR untuk pairing device |
| `/logout-device` | POST | Disconnect device |
| `/create-device` | POST/GET | Buat device baru |
| `/delete-device` | POST | Hapus device |
| `/info-user` | POST/GET | Info akun user |
| `/info-device` | POST/GET | Info status device |

### B. Endpoint Backend (Node.js Internal)

| Endpoint | Fungsi |
|----------|--------|
| `/backend-generate-qr` | Generate QR untuk scan |
| `/backend-initialize` | Inisialisasi koneksi WA |
| `/backend-send-text` | Kirim teks |
| `/backend-send-media` | Kirim media |
| `/backend-send-sticker` | Kirim sticker |
| `/backend-send-button` | Kirim button message |
| `/backend-send-list` | Kirim list message |
| `/backend-send-template` | Kirim template message |
| `/backend-send-poll` | Kirim polling |
| `/backend-send-location` | Kirim lokasi |
| `/backend-send-vcard` | Kirim contact card |
| `/backend-send-available` | Set status online |
| `/backend-getgroups` | Ambil semua group |
| `/backend-blast` | Kirim blast message |
| `/backend-logout-device` | Logout device |
| `/backend-check-number` | Cek nomor WA |
| `/backend-clearCache` | Hapus cache |
| `/backend-logout` | Hapus session |

### C. Endpoint yang Perlu Ditambahkan

| Endpoint | Fungsi | Prioritas |
|----------|--------|-----------|
| `/get-profile-picture` | Ambil foto profil | TINGGI |
| `/get-profile-info` | Info profil (nama, about) | TINGGI |
| `/download-media` | Download media dari pesan | SEDANG |
| `/group-add-member` | Tambah member group | SEDANG |
| `/group-remove-member` | Hapus member group | SEDANG |
| `/block-contact` | Blokir kontak | SEDANG |
| `/reaction` | React ke pesan | RENDAH |

---

*Dokumentasi ini dibuat untuk integrasi SIMZIS dengan Duta WA Gateway.*
*Versi: 1.2 | Last Updated: 7 Maret 2026*
*© 2026 Duta Corpora Indonesia*
