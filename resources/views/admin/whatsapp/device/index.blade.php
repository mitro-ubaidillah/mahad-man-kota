<x-app-layout>
    <x-slot name="header">
        {{ __('WhatsApp Device Configuration') }}
    </x-slot>

    <div class="space-y-6">
            
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-emerald-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Setup Device -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Informasi Gateway') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Masukkan kredensial API Duta WA Gateway di sini.') }}
                    </p>
                </header>

                <form method="post" action="{{ route('admin.wa-device.store') }}" class="mt-6 space-y-6">
                    @csrf
                    
                    <div>
                        <label for="sender" class="block font-medium text-sm text-gray-700">Device Number (Sender)</label>
                        <input id="sender" name="sender" type="text" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" value="{{ old('sender', $device->sender ?? '') }}" required />
                        <p class="text-sm text-gray-500 mt-1">Misal: 628123456789</p>
                    </div>

                    <div>
                        <label for="api_key" class="block font-medium text-sm text-gray-700">API Key</label>
                        <input id="api_key" name="api_key" type="text" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" value="{{ old('api_key', $device->api_key ?? '') }}" required />
                    </div>

                    <div>
                        <label for="base_url" class="block font-medium text-sm text-gray-700">Base URL</label>
                        <input id="base_url" name="base_url" type="url" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" value="{{ old('base_url', $device->base_url ?? 'https://mpwa.dutacorpora.co.id') }}" required />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition">
                            {{ __('Simpan Konfigurasi') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Area Scan QR -->
            @if($device)
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <header class="flex justify-between items-center w-full">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Status & Koneksi WA') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">Status saat ini: 
                            <span id="device-status-badge" class="font-bold {{ strtolower($device->status) === 'connected' ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $device->status ?? 'Unknown' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        @if(strtolower($device->status) === 'connected')
                            <form action="{{ route('admin.wa-device.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition" onclick="return confirm('Yakin ingin log out?')">Logout Device</button>
                            </form>
                        @endif
                    </div>
                </header>

                @if(strtolower($device->status) !== 'connected')
                <div class="mt-6 text-center border-t pt-6" id="qr-container">
                    <button id="btn-generate-qr" class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl transition mb-4">
                        Generate QR Code
                    </button>
                    <!-- Modal Konfirmasi/QR -->
                    <div id="qr-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Background overlay -->
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" id="modal-backdrop"></div>
                            
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 text-center">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Scan QR Code WhatsApp</h3>
                                    <div id="qr-loading" class="hidden text-gray-500 my-8 py-4">Requesting QR Code... Please wait.</div>
                                    <img id="qr-image" src="" alt="QR Code" class="mx-auto hidden max-w-xs border p-2 mb-4" />
                                    <p id="qr-message" class="text-sm mt-2 text-gray-600 hidden">Silakan buka WhatsApp di HP Anda, pilih <b>Perangkat Taut/Linked Devices</b>, dan scan QR Code di atas.</p>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" id="btn-close-modal" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 px-4 py-2 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif

    </div>

    @if($device)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnGenerateQr = document.getElementById('btn-generate-qr');
            const qrModal = document.getElementById('qr-modal');
            const btnCloseModal = document.getElementById('btn-close-modal');
            const modalBackdrop = document.getElementById('modal-backdrop');
            
            const qrLoading = document.getElementById('qr-loading');
            const qrImage = document.getElementById('qr-image');
            const qrMessage = document.getElementById('qr-message');
            const statusBadge = document.getElementById('device-status-badge');
            
            let statusInterval = null;

            function openModal() {
                if (qrModal) qrModal.classList.remove('hidden');
            }

            function closeModal() {
                if (qrModal) qrModal.classList.add('hidden');
                if (statusInterval) {
                    clearInterval(statusInterval);
                    statusInterval = null;
                }
            }

            if (btnCloseModal) btnCloseModal.addEventListener('click', closeModal);
            if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);

            if (btnGenerateQr) {
                btnGenerateQr.addEventListener('click', function() {
                    openModal();
                    
                    qrLoading.classList.remove('hidden');
                    qrImage.classList.add('hidden');
                    qrMessage.classList.add('hidden');
                    btnGenerateQr.disabled = true;

                    fetch('{{ route('admin.wa-device.generate-qr') }}')
                        .then(response => response.json())
                        .then(data => {
                            qrLoading.classList.add('hidden');
                            btnGenerateQr.disabled = false;

                            if (data.qrcode) {
                                qrImage.src = data.qrcode;
                                qrImage.classList.remove('hidden');
                                qrMessage.classList.remove('hidden');
                                
                                // Mulai polling cek status jika QR muncul
                                if(!statusInterval) {
                                    statusInterval = setInterval(checkStatus, 3000);
                                }
                            } else if (data.status === 'processing' || data.message === 'Processing') {
                                alert('Sistem sedang memproses, silakan klik Generate QR lagi 5 detik.');
                                closeModal();
                            } else {
                                alert(data.msg || data.message || 'Gagal mengambil QR Code.');
                                closeModal();
                            }
                        })
                        .catch(err => {
                            qrLoading.classList.add('hidden');
                            btnGenerateQr.disabled = false;
                            alert('Terjadi kesalahan koneksi.');
                            closeModal();
                        });
                });
            }

            function checkStatus() {
                fetch('{{ route('admin.wa-device.check-status') }}')
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === true && data.info && data.info.length > 0) {
                            let currentStatus = data.info[0].status;
                            statusBadge.textContent = currentStatus;
                            
                            if (currentStatus.toLowerCase() === 'connected') {
                                statusBadge.className = 'font-bold text-emerald-600';
                                clearInterval(statusInterval);
                                alert('WhatsApp berhasil terkoneksi! Halaman akan dimuat ulang.');
                                window.location.reload();
                            }
                        }
                    });
            }

            // Jika status belum connected, otomatis cek status setiap 10 detik di background
            @if(strtolower($device->status) !== 'connected')
                setInterval(function() {
                    // Hanya polling background jika modal tidak sedang terbuka (modal punya polling 3 detik lebih cepat)
                    if (!qrModal || qrModal.classList.contains('hidden')) {
                        checkStatus();
                    }
                }, 10000);
            @endif
        });
    </script>
    @endif
</x-app-layout>
