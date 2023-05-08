const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: ["./src/**/*.{html,js,vue}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      boxShadow: {
        'zilka': '0px 8px 64px rgba(19, 10, 46, 0.07), 0px 3px 28px rgba(19, 10, 46, 0.03), 0px 1px 6px rgba(19, 10, 46, 0.08)'
      },
      colors: {
        modra: '#009EE0',
        modradark: '#006caa'
      }
    },
  },
  plugins: [],
}



//pro fungovani tailwindu musime spustit npm install -D tailwindcss, pak pridat tento soubor(tailwind.config.js) s nasledujicim obsahem:
// module.exports = {
//   content: ["./src/**/*.{html,js,vue}"],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }
//
// do theme pak muzeme pridavat sve vlastni fonty, barvy atd viz vyse
//
//
//dale pridat postcss.config.js s obsahem:
// module.exports = {
//   plugins: [
//       require('tailwindcss')('./tailwind.config.js'),
//       require('autoprefixer'),
//   ],
// }
//
// pridat css soubor a nalinkovat ho v main.js: import './style/tailwind.css';
// obsah css souboru:
// @tailwind base;
// @tailwind components;
// @tailwind utilities;