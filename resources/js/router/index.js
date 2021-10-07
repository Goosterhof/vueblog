import Vue from "vue";
import VueRouter from "vue-router";

import Home from '../pages/Home.vue'
import Article from '../pages/Article.vue'
import Dashboard from "../pages/Dashboard.vue"
import Create from "../pages/Create.vue"
import About from "../pages/About.vue"

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: Dashboard
        },
        {
            path: "/create",
            name: "create",
            component: Create
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/articles/:articleId",
            name: "articles",
            component: Article,
            props: true
        }
    ]
});
