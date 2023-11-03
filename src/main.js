import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import  i18n  from './i18n'
import '../node_modules/bootstrap-icons/font/bootstrap-icons.css'

createApp(App).use(router).use(i18n).mount('#app')
