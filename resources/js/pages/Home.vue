<template>
  <div>
      
    <div style="background: gray; display: flex; justify-content: center;" v-if="filteredBy">
        {{filteredBy}}
        <button @click="removeTag()" style="margin-left: 5px; margin-bottom: 3px" class="close">
           ×
        </button>
        
    </div>
    <div v-if="displayType === 'mobile'">

          <div v-for="(article, index) in filteredArticles" :key="article.id" :style="articleBackgrounds[index]" style="margin-bottom: 20px;">
                <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                    <div class="mobileImage"><img :src="article.imageUrl"></div>
                </router-link>
                <div class="article"> 
                    <div class="absolute">
                            <div @click="displayArticlesWithThisSubject(tag.subject)" v-for="tag in article.tags" :key="tag.id" class="tags">
                                {{tag.subject}}
                            </div>
                        </div>
                        <div class="text-gray-600 text-sm" style="height: 20px; display: flex; justify-content: end;">by {{article.author}}</div>
                    <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                        <p class="title">{{article.title}}</p>
                        <p class="description">{{article.description}}</p>
                    </router-link>
                    <div class="text-gray-600 text-sm" style="height: 20px; display: flex; justify-content: end;">{{article.created_at}}</div>
                </div>
                
            </div>
        </div>
            
    <div v-if="displayType === 'tablet'">
           
         
        <div id="hide-small" class="header">
            Most Viewed
        </div>
        <div id="" class="wrap">
            <div v-for="(article, index) in filteredArticles" :key="article.id" style="margin-bottom: 10px; margin-top: 30px;">
                <div :class="{pushFooter: index === filteredArticles.length-1}" class="highlightedArticles" :style="articleBackgrounds[index]">
                    <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                        <img :src="article.imageUrl" alt="">
                    </router-link>
                    <div class="article">
                        <div class="absolute">
                            <div @click="displayArticlesWithThisSubject(tag.subject)" v-for="tag in article.tags" :key="tag.id" class="tags">
                                {{tag.subject}}
                            </div>
                        </div>
                        <div class="text-gray-600 text-sm" style="height: 20px; display: flex; justify-content: end;">by {{article.author}}</div>
                        <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                            <p class="title">{{article.title}}</p>
                            <p class="description">{{article.description}}</p>
                        </router-link>
                    </div>
                    <div class="text-gray-600 text-sm" style="height: 15px; display: flex; justify-content: end;">{{article.created_at}}</div>
                </div>
                
             </div>
          </div>
    </div>

    <div v-if="displayType === 'desktop'">
       <div class="desktopWrap">
           <div class="postListArea hide-postlist">
               <PostList></PostList>
           </div>
        <div class="desktopArticleContainer">
            <div v-for="(article, index) in filteredArticles" :key="article.id">
                <div :class="{pushFooter: index === filteredArticles.length-1}" class="desktopArticle" :style="articleBackgrounds[index]">
                    <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                        <img :src="article.imageUrl" alt="">
                    </router-link>
                    <div class="article">
                        <div class="absolute">
                            <div @click="displayArticlesWithThisSubject(tag.subject)" v-for="tag in article.tags" :key="tag.id" class="tags">
                                {{tag.subject}}
                            </div>
                        </div>
                        <div class="text-gray-600 text-sm" style="height: 20px; display: flex; justify-content: end;">by {{article.author}}</div>
                        <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                            <p class="title mt-2">{{article.title}}</p>
                            <p class="description">{{article.description}}</p>
                        </router-link>
                    </div>
                    <div class="text-gray-600 text-sm" style="height: 15px; display: flex; justify-content: end;">{{article.created_at}}</div>
                </div>
            </div>
            </div>
            
        </div>
        
        
    </div>


  
         
    
  </div>
</template>

<script>
import {mapGetters} from "vuex"
import PostList from "../components/PostList.vue"

export default {
    data() {
        return {
            displayType: null,
            articleBackgrounds: [],
            filteredBy: null 
        }
    },
    components: {
        PostList
    },
    methods: {
         handleResize() {
            // this.displayType = window.matchMedia('(max-width: 650px)').matches
            // ? 'mobile' : 'desktop'
            let width = window.innerWidth
            if(width < 650) this.displayType = 'mobile'
            if(width > 650 && width < 1170) this.displayType = 'tablet'
            if(width > 1170) this.displayType = 'desktop'

        
         },
         displayArticlesWithThisSubject(subject){
             this.$store.commit("FILTER_ARTICLES", subject);
             this.filteredBy = subject
         },
         removeTag(){
             this.$store.commit("REMOVE_ARTICLE_FILTER")
             this.filteredBy = null
         }
    },
    computed: {
        ...mapGetters({
         articles: "articles",
         filteredArticles: "filteredArticles"
     })
    },
    async mounted(){
        await this.$store.dispatch("getArticles")
        .then(() => {
            for(let i = 0; i < this.filteredArticles.length; i++){
                this.articleBackgrounds.push({
                    background: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.10)`
                })
            }
        })
        this.handleResize()
        window.addEventListener('resize', this.handleResize)

        
        
    },
    destroyed() {
        window.removeEventListener('resize', this.handleResize)
    }
}
</script>

<style scoped>

@media only screen and (max-width: 1180px) {
  #hide-small {display: none}
}


@media only screen and (max-width: 1475px){
    .hide-postlist{display: none}
}


.wrap {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
}

.desktopWrap {
    width: 1440px;
    display: flex;
    margin-left: 30px;
    margin-top: 30px;
    flex-direction: column;
}

.postListArea {
    align-self: flex-end;
    position: absolute;
}


.desktopArticleContainer {
    width: 1120px;
    display: flex;
    flex-wrap: wrap;
    gap: 45px;
    justify-content: space-between;
}

.desktopArticle {
    width: 535px; 
    padding: 10px;
}

.desktopImage {
    width: 400px;
}

.highlightedArticles {
    margin-left: 15px;
    margin-right: 15px;
    width: 45vw;
    padding: 10px;
    border-radius: 8px;
   background: rgba(153, 14, 14, 0.082);
}

.article {
    margin-left: 10px;
    margin-right: 10px;
    padding: 5px;

}

.tags {
    height: 20px;
    width: auto;
    border-radius: 8px;
    border: 1px solid black;
    display: inline-block;
    margin-top: 5px;
    line-height: 10px;
    padding: 3px;
    background: rgb(241, 241, 241);
    font-size: 15px;
    cursor: pointer;
    margin-right: 5px;
}

.title {
    font-weight: bold;
}



.header {
    font-size: 30px;
    margin-left: 100px;
    top: 10px;
    position: relative;
    border-bottom: 1px solid black;
    display: inline-block;
}

img {
    max-width: 100%;
    max-height: auto;
}

.mobileImage {
    width: auto;        
    border: 5px solid black;
    max-width: 650px;
}



p {
    color: black;
}

p:hover {
    color: rgb(10, 113, 231);
}

a:link { text-decoration: none; }




</style>
