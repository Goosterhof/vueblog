<template>
  <div>
      
      <div v-if="displayType === 'mobile'">

          <div v-for="article in articles" :key="article.id" style="margin-bottom: 20px;">
                <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                    <div class="mobileImage"><img :src="article.imageUrl"></div>
                </router-link>
                <div class="article">
                    <div class="tags">Lifestyle</div>
                    <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                        <p class="title">{{article.title}}</p>
                        <p class="description">{{article.description}}</p>
                    </router-link>
                </div>
            </div>
        </div>
            
       <div v-if="displayType === 'desktop'">
           
          <div class="postListWrap">
            <div id="hide-small"><PostList></PostList></div>
        </div>
        <div id="hide-small" class="header">
            Most Viewed
        </div>
        <div id="fix-wrapper-size" class="wrap">
            <div v-for="article in articles" :key="article.id" style="margin-bottom: 10px; margin-top: 30px;">
                <div id="fix-article-size" class="highlightedArticles">
                    <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                        <img :src="article.imageUrl" alt="">
                    </router-link>
                        <div class="article">
                        <div class="tags">Lifestyle</div>
                    <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                        <p class="title">{{article.title}}</p>
                        <p class="description">{{article.description}}</p>
                    </router-link>
                </div>
                
            </div>
            
            </div>
          
           
           
        </div>
                    
        </div>



  
         
    
  </div>
</template>

<script>
import PostList from "../components/PostList.vue"

export default {
    data() {
        return {
            displayType: null,
        }
    },
    components: {
        PostList
    },
    methods: {
         handleResize() {
            this.displayType = window.matchMedia('(max-width: 650px)').matches
            ? 'mobile' : 'desktop'
         }
    },
    computed: {
        articles(){
            return this.$store.state.articles
        }
    },
    created(){
        this.$store.dispatch("getArticles")
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

@media only screen and (min-width: 1181px){
    #fix-article-size {width: 25vw}
    #fix-wrapper-size {width: 70vw}
}

.wrap {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
}

.postListWrap {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: flex-end;
}

.highlightedArticles {
    margin-left: 15px;
    margin-right: 15px;
    width: 45vw;

}

.article {
    margin-left: 10px;
    margin-right: 10px;
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
}

.title {
    font-weight: bold;
}

.description {
    border-bottom:  1px solid black;
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

.desktopImage {
    width: auto;
    border: 3px solid black;
    max-width: 50%;
}

p {
    color: black;
}

p:hover {
    color: rgb(10, 113, 231);
}

a:link { text-decoration: none; }




</style>
