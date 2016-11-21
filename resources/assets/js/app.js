// 启动文件
require('./bootstrap');
import VueRouter from 'vue-router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
Vue.use(VueRouter)
Vue.use(ElementUI)

import routes from './router/router'

// 全局资源文件
require('./assets');

import App from './components/App'


const router = new VueRouter({
  // mode: 'history',
  routes,
  base: __dirname,
})

const app = new Vue({
  router,
  components: {
  	App
  }
}).$mount('#app')