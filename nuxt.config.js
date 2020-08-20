require("dotenv").config({
  silent: process.env.NODE_ENV === "production"
});

const pkg = require("./package");

module.exports = {
  mode: "universal",

  /*
   ** Headers of the page
   */
  head: {
    title: pkg.name,
    meta: [{
        charset: "utf-8"
      },
      {
        name: "viewport",
        content: "width=device-width, initial-scale=1"
      },
      {
        hid: "description",
        name: "description",
        content: pkg.description
      }
    ],
    link: [{
      rel: "icon",
      type: "image/x-icon",
      href: "/favicon.ico"
    }]
  },

  /*
   ** Customize the progress-bar color
   */
  loading: {
    color: "#2B7FCB"
  },

  /*
   ** Global CSS
   */
  css: [{
      src: "~assets/sass/themes/_theme.scss",
      lang: "scss"
    }
    //{ src: '~assets/css/main.sass', lang: 'scss' },
  ],

  /*
   ** Plugins to load before mounting the App
   */
  plugins: [{
      src: "~/plugins/vue-agile",
      ssr: false
    },
    {
      src: "~/plugins/hotjar.js",
      ssr: false
    },
    {
      src: "~/plugins/aos.js",
      ssr: false
    },
    {
      src: "~/plugins/infiniteScroll.js",
      ssr: false
    },
    {
      src: "~plugins/vee-validate.js",
      ssr: false
    },
    "plugins/vue-mq.js"
  ],
  buefy: {
    css: false
  },

  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://github.com/nuxt-community/axios-module#usage
    "@nuxtjs/axios",
    "@nuxtjs/auth",

    [
      "@nuxtjs/dotenv",
      {
        silent: process.env.NODE_ENV === "production"
      }
    ],
    [
      "nuxt-env",
      {
        keys: [
          "AUTH_CLIENT_ID",
          "AUTH_CLIENT_SECRET",
          "AUTH_SCOPE",
          "AUTH_GRANT_TYPE"
        ]
      }
    ],
    // Doc: https://buefy.github.io/#/documentation
    "nuxt-buefy",
    ["@nuxtjs/moment", ["pt-br"]],
    [
      "@nuxtjs/google-tag-manager",
      {
        id: process.env.GOOGLE_TAG_MANAGER_ID
      }
    ],
    "@nuxtjs/recaptcha",
    [
      "@nuxtjs/moment",
      {
        defaultLocale: "pt-br",
        locales: ["pt-br"],
        timezone: true,
        defaultTimezone: "America/Sao_Paulo"
      }
    ]
  ],

  recaptcha: {
    hideBadge: false, // Hide badge element (v3 & v2 via size=invisible)
    siteKey: process.env.GOOGLE_RECAPTCHA_PUBLIC_KEY, // Site key for requests
    version: 2, // Version
    size: "invisible" // Size: 'compact', 'normal', 'invisible' (v2)
  },
  /*
   ** Axios module configuration
   */
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
    baseURL: process.env.API_URL,
    proxyHeaders: false,
    credentials: false,
    progress: false
  },

  /*
   ** Auth module configuration
   */
  auth: {
    strategies: {
      local: {
        endpoints: {
          login: {
            url: process.env.AUTH_URL,
            method: "post",
            propertyName: "access_token"
          },
          logout: false,
          user: {
            url: "user",
            method: "get",
            propertyName: ""
          },
          tokenRequired: true,
          tokenType: process.env.AUTH_TYPE
        }
      },
      redirect: {
        login: "/login",
        logout: "/login",
        home: "/"
      },
      watchLoggedIn: true,
      rewriteRedirects: true
    }
  },

  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {}
  }
};
