@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-600 bg-gray-700 placeholder-gray-400 text-gray-100 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm']) !!}>
