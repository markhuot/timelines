import plugin from "tailwindcss";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        {pattern: /(bg|text)-./, variants: ['dark']}
    ],
    theme: {
        extend: {
            backgroundImage: {
                'gradient-dash': "linear-gradient(to bottom, transparent var(--tw-gradient-to-position), var(--tw-gradient-to) var(--tw-gradient-to-position));",
            },
            textShadow: {
                inset: '0 -1px 1px var(--tw-shadow-color)',
                sm: '0 1px 2px var(--tw-shadow-color)',
                DEFAULT: '0 2px 4px var(--tw-shadow-color)',
                lg: '0 8px 16px var(--tw-shadow-color)',
            },
        },
    },
    plugins: [
        plugin(function ({ matchUtilities, theme }) {
            matchUtilities(
                {
                    'text-shadow': (value) => ({
                        textShadow: value,
                    }),
                },
                { values: theme('textShadow') }
            )
        }),
    ],
}

