@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm hover:border-emerald-400 transition-colors duration-200 px-4 py-2 bg-gray-50 focus:bg-white']) !!}>
