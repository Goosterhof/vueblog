<template>
  <div class="container" style="max-width: 700px;">
      <div class="title">{{article.title}}</div>
      <div class="description">{{ article.description }}</div>
      <div class="body">{{article.body}}</div>
       <Comments :articleId="parseInt(this.id)"></Comments>
  </div>
</template>

<script>
import Comments from "../components/Comments.vue"

export default {

    data(){
      return {
        id: this.$attrs["articleId"]
      }
    },
    components: {
      Comments
    },
    computed: {
      article(){
        return this.$store.state.article
      }
    },
    mounted() {
      this.$store.dispatch("getArticle", {id: this.$attrs["articleId"]})

    }
}

</script>

<style scoped>


.title {
  font-size: 50px;
  text-align: center;
  border-bottom: 1px solid black;
}

.description {
  margin-top: 20px;
  font-size: 20px;
  font-weight: 600;
}

.body {
  margin-top: 15px;
  font-size: 17px;
}

</style>