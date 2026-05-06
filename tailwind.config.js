/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans:    ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        display: ['Space Grotesk', 'Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        'neo-sm':  '3px 3px 0 0 #000',
        'neo':     '4px 4px 0 0 #000',
        'neo-md':  '6px 6px 0 0 #000',
        'neo-lg':  '8px 8px 0 0 #000',
        'neo-xl':  '10px 10px 0 0 #000',
        'neo-hover': '6px 6px 0 0 #000',
      },
      colors: {
        brand: {
          yellow: '#FCD34D',
          cyan:   '#22D3EE',
          green:  '#4ADE80',
          red:    '#F87171',
          orange: '#FB923C',
          purple: '#A78BFA',
          blue:   '#60A5FA',
        },
      },
    },
  },
  plugins: [],
};
