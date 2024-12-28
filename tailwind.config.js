import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
           
            colors: {
                brown: {
                    600: '#A0522D',
                    700: '#6B4F4F',
                    800: '#8B4513',
                    900: '#402911',
                },
                whitechoc: '#FFF6D6', // Custom white
                darkchoc: '#84563C', // Dark Chocolate
                milkchoc: '#BB886C', 
                strawberrychoc: '#E91E63',
                fruitnnutchoc: '#DA7A24', // Fruit and Nut
                caramelchoc: '#DA7A24', // Caramel
                veganchoc: '#385F05', // Vegan
            },
        },
    },
    mode: 'jit',  
    // Optionally, include a safelist to prevent purging  
    safelist: [  
      'text-whitechoc',  
      'text-milkchoc',  
      'text-darkchoc',  
      'text-fruitnnutchoc',  
      'text-caramelchoc',  
      'text-veganchoc',  
      // Add all possible text-<category>choc classes  
    ], 

    plugins: [forms],
};
