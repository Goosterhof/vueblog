<template>
  <div>
      <div class="header">Recent Articles</div>
       <div class="postListArea">
              <div v-for="article in articles" :key="article.id">
                  <div class="postListArticle">
                  <router-link :to="{ name: 'articles', params: {articleId: article.id}}" style="text-decoration: none"> 
                      <div class="postListTitles">{{article.title}}</div>
                  </router-link>
              </div>
              
              <div class="dateArea">
                  <p class="datePosted">posted on {{article.created_at}}</p>
              </div>
              </div>
          </div>
          
  </div>
</template>

<script>
export default {

    computed: {
        articles(){
            return this.$store.state.articles.slice(0, 10)
        },
    },

}
</script>

<style scoped>

.header {
    width: auto;
    height: 70px;
    border-bottom: 2px solid black;
    margin-bottom: 30px;
    font-size: 30px;
    text-align: center;
    line-height: 80px;
}

.postListArea {
    height: 85.3vh;
    display: flex;
    width: 30vw;
    flex-direction: column;
    justify-content: space-between;
}

.postListArticle {
    background: rgb(19, 18, 18);
    align-content: center;
    height: 60px;
}

.postListTitles {
    text-align: center;
    font-size: 20px;
    line-height: 55px;
    color: white;
}

.dateArea {
    height: 10px;
    background: rgb(19, 18, 18);
}

.datePosted {
    color: grey;
    float: right;
    line-height: 0px;
    font-size: 10px;
    margin-right: 3px;
}

</style>