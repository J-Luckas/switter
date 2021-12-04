@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-yellow-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
