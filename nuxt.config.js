require('dotenv').config({ silent: process.env.NODE_ENV === 'production' })

const pkg = require('./package')

module.exports = {
  mode: 'universal',

  /*
  ** Headers of the page
  */
  head: {
    title: pkg.name,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: pkg.description }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#fff' },

  /*
  ** Global CSS
  */
  css: [
  ],

  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    { src: '~/plugins/vue-agile', ssr: false },
    'plugins/vue-mq.js'
  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://github.com/nuxt-community/axios-module#usage
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    ['@nuxtjs/dotenv',{ silent: process.env.NODE_ENV === 'production' }],
    ['nuxt-env', {
      keys: [
        'AUTH_CLIENT_ID',
        'AUTH_CLIENT_SECRET',
        'AUTH_SCOPE',
        'AUTH_GRANT_TYPE',
      ]
    }],
    // Doc: https://buefy.github.io/#/documentation
    'nuxt-buefy',
    ['@nuxtjs/moment',['pt-br']],
    ['@nuxtjs/google-tag-manager', { id: process.env.GOOGLE_TAG_MANAGER_ID }]
  ],
  /*
  ** Axios module configuration
  */
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
    baseURL: process.env.API_URL,
    proxyHeaders: false,
    credentials: false
  },

  /*
  ** Auth module configuration
  */
  auth: {
    strategies: {
      local: {
        endpoints: {
          login: { url: process.env.AUTH_URL, method: 'post', propertyName: 'access_token' },
          user: { url: 'user', method: 'get', propertyName: '' },
          tokenRequired: true,
          tokenType: process.env.AUTH_TYPE
        }
      },
      redirect: {
        login: '/login',
        logout: '/',
        callback: '/login',
        user: '/'
      }
    },
  },

  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {

    }
  }
}
