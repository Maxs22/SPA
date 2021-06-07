import Vue from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';

// importamos VueRouter
import VueRouter from 'vue-router';

// importmos nuestro componentes

import inicio from "./components/Inicio";
import listarArticulos from "./components/ListarArticulos";
import crearArticulo from "./components/CrearArticulo";
import editarArticulo from "./components/EditarArticulo";
import contacto from "./components/Contacto";

// creamos los componentes
Vue.component('inicio', inicio);
Vue.component('listararticulos', listarArticulos);
Vue.component('creararticulo', crearArticulo);
Vue.component('editararticulo', editarArticulo);
Vue.component('contacto', contacto);

// uso de VueRouter
Vue.use(VueRouter);

// definimos las rutas
const routes = [
  {path:'/', component:inicio},
  {path:'/inicio',component:inicio},
  {path:'/articulos',component:listarArticulos},
  {path:'/crear',component:crearArticulo, name:'crearArticulo'},
  {path:'/editar/:id',component:editarArticulo, name:'editarArticulo'},
  {path:'/contacto',component:contacto},
] 
// creamos el objeto Router

const router = new VueRouter ({
  routes,
  mode:'history'
})

Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')
