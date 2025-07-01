import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    mode: 'jit',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

                    colors: {
                      navy: '#1E3A8A',
                      gold: '#D4AF37',
                      teal: '#5EEAD4',
                      'navy-dark': '#0F2B5B',
                      'gold-dark': '#B38C25',
                    },

        },
    },

    plugins: [forms],
};
