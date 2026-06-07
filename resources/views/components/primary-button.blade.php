<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-emerald-800 border border-transparent rounded-full font-bold text-xs text-white uppercase tracking-widest hover:bg-emerald-900 focus:bg-emerald-900 active:bg-emerald-950 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-[0_12px_28px_rgba(20,83,45,0.22)]']) }}>
    {{ $slot }}
</button>
