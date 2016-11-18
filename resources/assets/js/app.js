// 启动文件
require('./bootstrap');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import routes from './router/router'

// 全局资源文件
require('./assets');

import App from './components/App'


const router = new VueRouter({
  mode: 'history',
  routes
})

const app = new Vue({
  router,
  components: {
  	App
  }
}).$mount('#app')