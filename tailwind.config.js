const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                blue: {
                    100: '#E6F1F5',
                    200: '#C0DDE6',
                    300: '#9AC8D7',
                    400: '#4E9EB9',
                    500: '#02759B',
                    600: '#02698C',
                    700: '#01465D',
                    800: '#013546',
                    900: '#01232F',
                },
                grey: {
                    100: '#F3F4F5',
                    200: '#E1E4E6',
                    300: '#CFD3D7',
                    400: '#ABB2BA',
                    500: '#87919C',
                    600: '#7A838C',
                    700: '#51575E',
                    800: '#3D4146',
                    900: '#292C2F',
                },
                orange: {
                    100: '#FFF9EE',
                    200: '#FFF0D4',
                    300: '#FFE6BB',
                    400: '#FFD487',
                    500: '#FFC154',
                    600: '#E6AE4C',
                    700: '#997432',
                    800: '#735726',
                    900: '#4D3A19',
                },

            },
        },
    },
  variants: {},
  plugins: [
      require('@tailwindcss/ui'),
  ],
}
