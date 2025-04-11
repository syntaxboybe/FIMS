import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Catppuccin Frappé colors
                frappe: {
                    rosewater: '#f2d5cf',
                    flamingo: '#eebebe',
                    pink: '#f4b8e4',
                    mauve: '#ca9ee6',
                    red: '#e78284',
                    maroon: '#ea999c',
                    peach: '#ef9f76',
                    yellow: '#e5c890',
                    green: '#a6d189',
                    teal: '#81c8be',
                    sky: '#99d1db',
                    sapphire: '#85c1dc',
                    blue: '#8caaee',
                    lavender: '#babbf1',
                    text: '#c6d0f5',
                    subtext1: '#b5bfe2',
                    subtext0: '#a5adce',
                    overlay2: '#949cbb',
                    overlay1: '#838ba7',
                    overlay0: '#737994',
                    surface2: '#626880',
                    surface1: '#51576d',
                    surface0: '#414559',
                    base: '#303446',
                    mantle: '#292c3c',
                    crust: '#232634',
                },
            },
            screens: {
                'xs': '480px',
            },
            backgroundColor: {
                'modal': 'rgba(0, 0, 0, 0.5)',
            },
            transitionProperty: {
                'colors': 'color, background-color, border-color, text-decoration-color, fill, stroke',
            },
            touchAction: {
                'manipulation': 'manipulation',
            },
        },
    },

    plugins: [
        forms,
        function({ addUtilities }) {
            const newUtilities = {
                '.tap-highlight-transparent': {
                    '-webkit-tap-highlight-color': 'transparent',
                },
                '.dark-mode-transition': {
                    'transition': 'background-color 0.2s ease-in-out, color 0.2s ease-in-out, border-color 0.2s ease-in-out',
                },
                '.no-scrollbar': {
                    '-ms-overflow-style': 'none',
                    'scrollbar-width': 'none',
                },
                '.no-scrollbar::-webkit-scrollbar': {
                    'display': 'none',
                },
                '.touch-manipulation': {
                    'touch-action': 'manipulation',
                },
                '.touch-pan-y': {
                    'touch-action': 'pan-y',
                },
                '.touch-pan-x': {
                    'touch-action': 'pan-x',
                },
            };
            addUtilities(newUtilities);
        },
    ],

    future: {
        hoverOnlyWhenSupported: true,
    },
};
