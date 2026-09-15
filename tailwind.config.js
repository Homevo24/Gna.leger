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
            colors: {
                paper: 'rgb(var(--color-paper) / <alpha-value>)',
                ink: 'rgb(var(--color-ink) / <alpha-value>)',
                accent: 'rgb(var(--color-accent) / <alpha-value>)',
            },
            borderRadius: {
                panel: '32px',
                card: '16px',
            },
            fontFamily: {
                sans: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
                display: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
                brand: ['"Black Ops One"', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
