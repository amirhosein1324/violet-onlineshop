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
                brand: {
                    50: '#f5f3ff',
                    100: '#ede9fe',
                    500: '#8b5cf6',
                    600: '#7c3aed', // Primary Accent Purple
                    700: '#6d28d9',
                    800: '#5b21b6',
                    slate: '#0f172a', // Slate Dark Background
                    dark: '#0a0e17',  // Midnight Background
                }
            },
            boxShadow: {
                'purple-glow': '0 10px 30px -5px rgba(124, 58, 237, 0.3)',
                'purple-glow-lg': '0 20px 40px -10px rgba(124, 58, 237, 0.4)',
            }
        },
    },

    plugins: [forms],
};