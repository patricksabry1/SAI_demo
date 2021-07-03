export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'SAI Global Technical Demo',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
  ],

  router: {
    middleware: ['auth'],
  },

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~plugins/mixins/user.js'
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    'bootstrap-vue/nuxt',
    '@nuxtjs/axios',
    '@nuxtjs/style-resources',
    ['cookie-universal-nuxt', { alias: 'cookiz' }],
    '@nuxtjs/auth-next'
  ],

  axios: {
    baseURL: 'http://sai-backend.test/api/v1'
  },

  auth: {
    strategies: {
      local: {
        token: {
          property: 'access_token'
        },
        user: {
          property: false 
        },
        endpoints: {
          login: {
             url: 'auth/login', 
             method: 'POST', 
          },
          user: { 
            url: 'auth/user', 
            method: 'GET' 
          },
          logout: { 
            url: 'logout', 
            method: 'POST' 
          }
        }
      }
    }
  },

  styleResources: {
    scss: [
        'bootstrap/scss/_functions.scss',
        'bootstrap/scss/_variables.scss',
        'bootstrap/scss/_mixins.scss',
    ],
  },
  
  bootstrapVue: {
    bootstrapCSS: true,
    bootstrapVueCSS: true,
    components: [],
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
