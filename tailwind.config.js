import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/css/*.css',
        './node_modules/flowbite/**/*.js',
    ],
    safelist: [
        'bg-red-500',
    ],
    plugins: [
        forms,
        typography,
        require('flowbite'),
    ],
};
