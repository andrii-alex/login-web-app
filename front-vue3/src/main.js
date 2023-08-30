import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'element-plus/theme-chalk/dark/css-vars.css'
import store from './store'
import axios from 'axios'

const API_URL = 'https://roof-construct.andrii.ro/api'

const post = async function (url, args = {}) {
  try {
    const response = await axios.post(`${API_URL}${url}`, args)
    return response
  } catch (error) {
    console.error('Error while making POST request:', error)
    throw error
  }
}

const app = createApp(App)

app.config.globalProperties.post = post

app.use(router)
app.use(store)

app.mount('#app')
