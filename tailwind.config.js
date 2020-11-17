module.exports = {
    purge: {
        // enabled: true,
        content: [
          "app/**/*.php",
          "resources/**/*.html",
          "resources/**/*.js",
          "resources/**/*.jsx",
          "resources/**/*.ts",
          "resources/**/*.tsx",
          "resources/**/*.php",
          "resources/**/*.vue",
          "resources/**/*.twig",
        ],
        options: {
          // defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
          whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    theme: {
        extend: {
            screens: {
            xl: "1140px",
            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
                '128': '32rem',
            },
            colors: {
                primary: '#fe5971',
                darkprimary: '#f95367',
                secondary: '#66ddbd',
                darksecondary: '#52d2b3',
                recaudardarkblue: '#212939',
            },
            margin: {
                '96': '24rem',
                '128': '32rem',
            }
        },
        container: {
          center: true,
          padding: "1rem",
        },
        fontFamily: {
            display: ['montserrat', 'sans-serif'],
            body: ['coolvetica', 'sans-serif']
        },
        fontSize: {
            'xs': '.75rem',
            'sm': '.875rem',
            'tiny': '.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
            '8xl': '6rem',
            '9xl': '7rem',
            '10xl': '8rem',
        },
    },
    variants: {
        opacity: ['responsive', 'hover'],
        boxShadow: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'active', 'focus-within'],
    },
    plugins: [
        require('@tailwindcss/custom-forms')
    ]
};
