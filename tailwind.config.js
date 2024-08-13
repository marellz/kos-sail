import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        bodyColor: "#1B2F33",
        fontFamily: {
            sans: ["Rubik", ...defaultTheme.fontFamily.sans],
        },
        extend: {
            colors: {
                dark: "#1B2F33", // gunmetal
                "light-alt": "#CBEEF3", // light-cyan
                "light-primary": "#EEC6CA", // tea-rose
                "light-alt-primary": "#EF305424",
                primary: "#EF3054", // crayola
                "dark-primary": "#A41623", // madder
                grey: "#707070",
                "light-grey": "#D2D2D2",

                //
                "lighter-grey": "#F6F8FF",
                "lighter-alt": "#D9E1FF3B",
                "light-alt-2": "#EAECF3",

                //
                success: "#11D52B",
                error: "#FE0C0C",
                warning: "#F97D01",
            },
        },
    },

    plugins: [forms],
};
