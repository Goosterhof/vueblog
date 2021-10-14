<template>
  <div>
    
    <div class="container">
        <div class="header">Recent Articles</div>
        <div v-for="article in articles" :key="article.id">
           <div class="article">
            <div class="subject">{{article.tags[0].subject.toUpperCase()}}</div>
            <router-link :to="{ name: 'articles', params: {articleId: article.id}}">
                <div class="title">{{ article.title }}</div>
            </router-link>
            <div class="timestamp">{{article.created_at}}</div>
           </div>
        </div>
    </div>

  </div>
</template>

<script>
export default {

    computed: {
        articles(){
            return this.$store.state.articles.slice(0, 9)
        },
    },

}
</script>

<style scoped>

.container {
    margin-top: 30px;
    width: 300px;
    height: 100%;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
}

.article {
    border-bottom: 1px solid rgba(0, 0, 0, 0.582);
    margin-bottom: 5px;
}

.header {
    font-size: 20px;
    color: rgb(255, 0, 0);
    font-weight: 600;
    border-bottom: 1px solid black;
    margin-bottom: 10px;
    line-height: 50px;
}

.title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
    text-decoration: none;
    color: black;
}

.title:hover {
    color: rgb(151, 5, 5);
}

.subject {
    color: rgba(0, 0, 0, 0.479);
    font-size: 14px;
}

.timestamp {
    color: gray;
    font-size: 12px;

}

a:link { text-decoration: none; }


</style>