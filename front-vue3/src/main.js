import './assets/main.css'

import { createApp, provide } from 'vue'
import App from './App.vue'
import router from './router'
import 'element-plus/theme-chalk/dark/css-vars.css'
import axios from 'axios'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

const API_URL = 'https://roof-construct.andrii.ro/api'

const post = async function (url, args = {}) {
  try {
    const response = await axios.post(`${API_URL}${url}`, args, {
      headers: {
        'Authorization': 'Bearer ' + window.sessionStorage.getItem('token')
      }
    })
    return response
  } catch (error) {
    console.error('Error while making POST request:', error)
    throw error
  }
}

const app = createApp(App)

app.config.globalProperties.post = post
app.provide('post', post)

app.use(router)
app.use(ElementPlus)

app.mount('#app')
