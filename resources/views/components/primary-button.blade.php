<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'inline-flex items-center font-anton 
               px-3 py-2 sm:px-4 sm:py-2 
               bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md  
               text-sm sm:text-xl text-white dark:text-gray-800 uppercase tracking-widest 
               focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 
               dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
