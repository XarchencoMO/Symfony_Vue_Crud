import Vue from "vue";
import VueRouter from "vue-router";
import MainPage from "@/pages/MainPage";
import ProductsPage from "@/pages/ProductsPage";


Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: MainPage,
    },
    {
        path: '/products',
        component: ProductsPage,
    },
]

export default new VueRouter({
    mode: 'history',
    routes
})