import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/css/*.css',
    ],
    safelist: [
        'bg-red-500',
        'bg-red-700',
        'bg-emerald-700',
        'bg-indigo-500',
        'bg-sky-500',
        'bg-teal-700',
        'bg-pink-700',
    ],
    plugins: [
        forms,
        typography,
    ],
};
