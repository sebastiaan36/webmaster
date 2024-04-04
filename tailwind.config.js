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
                sans: ['Epilogue', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "theme": {
                    "dark" : "#013941",
                    "light" : "#fbfbfb",
                    "jade" : "#00d47e",
                    "evergreen" : "#009156",
                    "teal" : "#06606b",
                    "lemon" : "#f8ed92",
                    "mint" : "#d2fee1",
                    "lavender" : "#d4c4fc",
                    "amethyst" : "#e3d8fe",
                    "arctic" : "#e3f7fa",
                    "pearl" : "#fcf8da",


                },
            },
        },
    },



    plugins: [forms],
};
