<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('Edit User') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password (leave blank to keep)')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_admin" class="form-checkbox" {{ $user->is_admin ? 'checked' : '' }}>
                        <span class="ml-2">Is Admin</span>
                    </label>
                </div>

                <div>
                    <x-primary-button id="submit-btn">{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script>
        (function(){
            const checkUrl = '{{ route('admin.users.check-email') }}';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let debounceTimer;
            const currentUserId = '{{ $user->id }}';

            const form = document.querySelector('form');
            const submit = document.getElementById('submit-btn');
            if(!form) return;

            function showError(input, message){
                let next = input.nextElementSibling;
                if(!next || !next.classList || !next.classList.contains('input-error-msg')){
                    next = document.createElement('div');
                    next.className = 'input-error-msg text-sm text-red-600 mt-1';
                    input.parentNode.appendChild(next);
                }
                next.textContent = message;
                input.classList.add('border-red-500');
            }

            function clearErrors(){
                document.querySelectorAll('.input-error-msg').forEach(el=>el.remove());
                document.querySelectorAll('.border-red-500').forEach(el=>el.classList.remove('border-red-500'));
            }

            form.addEventListener('submit', function(e){
                clearErrors();
                let ok = true;
                const name = form.querySelector('[name="name"]');
                const email = form.querySelector('[name="email"]');
                const password = form.querySelector('[name="password"]');
                const passwordConfirmation = form.querySelector('[name="password_confirmation"]');

                if(!name.value.trim()){
                    showError(name, 'Name is required'); ok = false;
                }
                if(!email.value.trim()){
                    showError(email, 'Email is required'); ok = false;
                } else if(!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email.value)){
                    showError(email, 'Email is invalid'); ok = false;
                }
                if(password.value){
                    if(password.value.length < 6){
                        showError(password, 'Password must be at least 6 characters'); ok = false;
                    }
                    if(passwordConfirmation.value !== password.value){
                        showError(passwordConfirmation, 'Passwords do not match'); ok = false;
                    }
                }

                if(!ok){
                    e.preventDefault();
                    submit.blur();
                }
            });

            // Real-time check (edit) — include user_id to ignore own email
            const emailInput = document.querySelector('[name="email"]');
            function showAvailability(input, available){
                let next = input.nextElementSibling;
                if(next && next.classList && next.classList.contains('input-error-msg') && next.textContent.trim() !== ''){
                    return;
                }
                const existing = input.parentNode.querySelector('.input-available-msg');
                if(existing) existing.remove();
                const el = document.createElement('div');
                el.className = 'input-available-msg text-sm mt-1';
                if(available){
                    el.classList.add('text-green-600');
                    el.textContent = 'Email is available';
                } else {
                    el.classList.add('text-red-600');
                    el.textContent = 'Email is already taken';
                }
                input.parentNode.appendChild(el);
            }

            if(emailInput){
                emailInput.addEventListener('input', function(){
                    clearTimeout(debounceTimer);
                    const val = this.value.trim();
                    if(!val || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(val)){
                        const existing = this.parentNode.querySelector('.input-available-msg'); if(existing) existing.remove();
                        return;
                    }
                    debounceTimer = setTimeout(()=>{
                        fetch(checkUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ email: val, user_id: currentUserId })
                        }).then(r=>r.json()).then(data=>{
                            showAvailability(emailInput, !!data.available);
                        }).catch(()=>{});
                    }, 500);
                });
            }
        })();
    </script>
</x-app-layout>
