<template>
  <div>
      <p class="header">Latest Articles</p>
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
    font-size: 30px;
    border-bottom: 1px solid black;
    right: 100px;
    position: absolute;
}

.postListArea {
    right: 10px;
    top: 130px;
    align-self: flex-end;
    display: flex;
    flex-direction: column;
    row-gap: 5px;
    position: absolute;
}

.postListArticle {
    background: rgb(19, 18, 18);
    min-height: 50px;
    width: 400px;
    text-align: center;
}

.postListTitles {
    font-size: 20px;
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
}

</style>