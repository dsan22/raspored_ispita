@props(['disabled' => false])

<input type="time" step="60" {{ $disabled ? 'disabled' : '' }} 
{!! $attributes->merge(['class' => ' timePicker border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
>
