@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => '
            border border-gray-300 
            rounded-lg 
            shadow-sm 
            px-4 py-2 
            font-anton
            text-xl
            text-gray-800 
            dark:border-gray-700 
            dark:bg-gray-100
            dark:text-gray-900 
            dark:focus:ring-brown-700 
            transition duration-200
        '
    ]) }}
>
