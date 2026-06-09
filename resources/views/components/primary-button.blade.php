<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-emerald-700 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-emerald-800 focus:bg-emerald-800 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-[0_12px_28px_rgba(20,83,45,0.18)]']) }}>
    {{ $slot }}
</button>
