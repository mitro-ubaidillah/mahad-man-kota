<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Tambah Santri') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('santris.store') }}">
                @csrf

                {{-- client-side flash area --}}
                <div id="form-flash" class="hidden max-w-4xl mx-auto mb-4 px-4">
                    <div id="form-flash-message" class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded" role="alert"></div>
                </div>

                <div class="mb-4">
                    <x-input-label for="nis" :value="__('NIS')" />
                    <x-text-input id="nis" class="block mt-1 w-full" type="text" name="nis" />
                </div>

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                    @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    <p id="error-name" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" />
                    @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    <p id="error-email" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <div class="mb-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" />
                </div>

                <div class="mb-4">
                    <x-input-label for="kelas" :value="__('Kelas')" />
                    <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas" />
                </div>

                <div class="mb-4">
                    <x-input-label for="birth_date" :value="__('Birth date')" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" />
                </div>

                <div>
                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(){
            const form = document.querySelector('form[action="{{ route('santris.store') }}"]');
            if(!form) return;

            function showFieldError(id, message){
                const el = document.getElementById(id);
                if(!el) return;
                el.textContent = message;
                el.classList.remove('hidden');
            }
            function clearFieldError(id){
                const el = document.getElementById(id);
                if(!el) return;
                el.textContent = '';
                el.classList.add('hidden');
            }
            function showFormFlash(msg){
                const container = document.getElementById('form-flash');
                const message = document.getElementById('form-flash-message');
                if(!container || !message) return;
                message.textContent = msg;
                container.classList.remove('hidden');
                setTimeout(()=> container.classList.add('hidden'), 5000);
            }

            form.addEventListener('submit', function(e){
                // clear previous
                clearFieldError('error-name');
                clearFieldError('error-email');

                const name = document.getElementById('name');
                const email = document.getElementById('email');

                let hasError = false;
                if(!name || !name.value.trim()){
                    showFieldError('error-name', 'Name is required');
                    hasError = true;
                }
                if(email && email.value.trim()){
                    // basic email regex
                    const re = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                    if(!re.test(email.value.trim())){
                        showFieldError('error-email', 'Please enter a valid email address');
                        hasError = true;
                    }
                }

                if(hasError){
                    e.preventDefault();
                    showFormFlash('Please correct the highlighted errors and try again.');
                }
            });
        })();
    </script>
</x-app-layout>
