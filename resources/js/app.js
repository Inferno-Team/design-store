
require('./bootstrap');
import VueRouter from 'vue-router'
import { routes } from './routes'
import App from './views/App';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import specific icons */
import { faUserSecret, faCirclePlus,faCircleMinus } from '@fortawesome/free-solid-svg-icons'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* add icons to the library */
library.add(faUserSecret);
library.add(faCirclePlus);
library.add(faCircleMinus);

window.Vue = require('vue').default;

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false


Vue.use(IconsPlugin)
Vue.use(BootstrapVue)
Vue.use(VueRouter)
// Vue.component('jw-pagination', JwPagination);
const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
