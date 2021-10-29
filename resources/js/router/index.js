import Vue from "vue";
import VueRouter from "vue-router";

import store from "../store"

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
            component: Dashboard,
            // TODO :: same beforeEnter as below, you could make this a function so you dont repeat yourself
            beforeEnter: (to, from, next) => {
                if(store.getters["authenticated"]){
                    next()
                } else {
                    next({name: "home"})
                }
            }
        },
        {
            path: "/create",
            name: "create",
            component: Create,
            beforeEnter: (to, from, next) => {
                if(store.getters["authenticated"]){
                    next()
                } else {
                    next({name: "home"})
                }
            }
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
