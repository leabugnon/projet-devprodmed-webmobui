import { createApp } from 'vue'
import App from './App.vue'
import router from './router' // <-- on importe ton router
import './assets/style.css'

const app = createApp(App)

app.use(router) // <-- on dit à Vue d'utiliser ton router
app.mount('#app')
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000'
axios.defaults.withCredentials = true
