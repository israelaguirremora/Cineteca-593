import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'bb-blue': '#002F6C',
                'bb-yellow': '#FFCC00',
                'bb-dark': '#0B132B',
            },
            fontFamily: {
                'blockbuster': ['"Impact"', 'sans-serif'],
            },
        },
    },
    plugins: [],
};