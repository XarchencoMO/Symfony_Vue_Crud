import Vue from "vue";
import VueRouter from "vue-router";
import MainPage from "@/pages/MainPage";
import ProductsPage from "@/pages/ProductsPage";
import CategoriesPage from "@/pages/CategoriesPage";


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
    {
        path: '/categories',
        component: CategoriesPage,
    },
]

export default new VueRouter({
    mode: 'history',
    routes
})