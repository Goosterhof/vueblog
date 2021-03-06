import Vue from "vue";
import Vuex from "vuex";
import repository from "../api/repository"
// TODO :: should be import api from '../api/api', cause there you made an axios instance which uses specific stuff
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        selected: "home",
        articles: [],
        filteredArticles: [],
        userArticles: [],
        article: [],
        comments: [],
        newComments: [],
        tags: [],
        user: sessionStorage.user ? JSON.parse(sessionStorage.getItem("user")) : null
        // authenticated: false
    },
    mutations: {
        SET_ARTICLES(state, articles){
            for(const article of articles){
                // TODO :: when using resources on the backend it's cleaner to clean this up there
                article.created_at = article.created_at.slice(0, 10)
            }
            state.articles = articles
            state.filteredArticles = articles
        },
        FILTER_ARTICLES(state, subject){
            state.filteredArticles = []

            for(const article of state.articles){
                for(const tag of article.tags){
                    if(tag.subject === subject){
                        state.filteredArticles.push(article)
                    }
                }
            }
        },
        REMOVE_ARTICLE_FILTER(state){
            state.filteredArticles = state.articles
        },
        SET_USER_ARTICLES(state, userArticles){
            // TODO :: const
            let articleArray = []

            Object.keys(userArticles).forEach(e => articleArray.push(userArticles[e]))
            console.log(articleArray)
            state.userArticles = articleArray

        },
        SET_ARTICLE_INFO(state, payload){
            state.article = payload.article
            state.comments = payload.comments
        },
        SET_NEW_COMMENT(state, payload){
            state.newComments.push(payload)
        },
        SET_NEW_REPLY(state, payload){

            for(const [key, value] of Object.entries(state.comments)){
                if(payload.comment_id === state.comments[key].id){
                    state.comments[key].replies.push(payload)
                }
            }

            for(const [key, value] of Object.entries(state.newComments)){
                if(payload.comment_id === state.newComments[key].id){
                    state.newComments[key].replies.push(payload)
                }
            }
        },
        SET_TAGS(state, payload){
            state.tags = payload
        },
        SET_USER(state, payload){
            state.user = payload
        },
        // SET_AUTHENTICATED(state, boolean){
        //     state.authenticated = boolean
        // },
        CLEAR_STATE(state, payload){
            state.newComments = []
        }



    },
    getters: {
        user: state => state.user,
        userArticles: state => state.userArticles,
        authenticated: state => state.user !== null,
        comments: state => state.comments,
        filteredArticles: state => state.filteredArticles,
        articles: state => state.articles,
        tags: state => state.tags
    },
    actions: {
        // TODO :: async without an await in it, either remove async or use an await
        async getArticles({ commit }){
            return axios.get("/api/getArticles")
            .then(response => {
                const articles = response.data.reverse()
                commit("SET_ARTICLES", articles)
            })
        },
        getArticle({ commit }, payload){
            axios.get(`/api/getArticleInfo/${payload.id}`)
            .then(response => {
                commit("SET_ARTICLE_INFO", response.data)
            })
        },
        getUserArticles({commit}, user){
            axios.get(`/api/getUserArticles/${user.id}`)
            .then(response => {
                commit("SET_USER_ARTICLES", response.data)
            })
        },
        getTags({commit}) {
            axios.get("/api/getTags")
            .then(response => {
                commit("SET_TAGS", response.data)
            })
        },
        submitArticle({commit}, article){
            axios.post("/api/createArticle", article)
        },
        submitComment({ commit }, payload){
            axios.post("api/postComment", payload)
            .then(response => {
                commit("SET_NEW_COMMENT", response.data)
            })
        },
        submitReply({ commit }, payload){
            axios.post("api/postReply", payload)
            .then(response => {
                commit("SET_NEW_REPLY", response.data)
            })
        },
        async login({commit}, payload){
            await repository.createSession()
            const { data } = await repository.login(payload)
            commit("SET_USER", data)

            sessionStorage.user = JSON.stringify(data);
        },

        async logout({commit}){
            await repository.logout()
            commit("SET_USER", null)
            sessionStorage.removeItem('user');
        },

        register({commit}, payload){
           axios.post("api/register", payload)
        },



        // async me({commit}){
        //     return axios.get("api/me")
        //     .then(response => {
        //         console.log(response)
        //         commit("SET_AUTHENTICATED", response.data)
        //     })
        // }

    },

});
