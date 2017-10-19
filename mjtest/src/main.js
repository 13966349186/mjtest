import babelpolyfill from 'babel-polyfill'
import Vue from 'vue'
import App from './App.vue'

import ElementUI from 'element-ui'
Vue.use(ElementUI);
import 'element-ui/lib/theme-default/index.css'

import BootstrapVue from 'bootstrap-vue'

import VueResource from 'vue-resource'
Vue.use(VueResource)

Vue.use(BootstrapVue);
import 'bootstrap/dist/css/bootstrap.css'
import 'font-awesome/css/font-awesome.min.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueRouter from 'vue-router'
import routes from './routes'

// 通用页面加载
import MJ from "./components/MJ/index"
Vue.use(MJ);


import * as common from './common/js/common';  // 公用方法
common.init(Vue);

Vue.use(VueRouter);

const router = new VueRouter({
  routes
})

const app = new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
