<template>
  <div>
      <div class="contain">
          <div class="bigArea">

              <div class="bigAreaContent">
                  <div v-for="article in articles" :key="article.id"><div class="highlightedPostArea">
                      <div class="titleArea">
                          <span style="align-self: flex end;">{{article.title}}</span>
                      </div>
                      <img :src="article.imageUrl" class="imageArea">
                      <div class="description">{{article.description }}</div>
                  </div>
                  </div>
                  
              </div>

          </div>
          <PostList></PostList>
      </div>
  </div>
</template>

<script>
import PostList from "../components/PostList.vue"

export default {
    data() {
        return {
            
        }
    },
    components: {
        PostList
    },
    methods: {

    },
    computed: {
        articles(){
            return this.$store.state.articles
        }
    },
    created(){
        this.$store.dispatch("getArticles")
    }
}
</script>

<style scoped>



.contain {
    display: flex;
    flex-direction: row;
}

.bigArea {
    width: 70%;
    height: 85.3vh;
}



.bigAreaContent {
  width: 100%;
  column-gap: 3vw;
  display: flex;
  flex-wrap: wrap;
}

.highlightedPostArea {
    margin-top: 30px;
    width: 28vw;
    height: 49vh;
    margin-left: 3vw;
    display: flex;
    justify-content: center;
}

.titleArea {
    border-bottom: 1px solid black;
    height: auto;
    width: 28vw;
    height: 8vh;
    position: absolute;
    display: flex;
    justify-content: center;
}

.titleArea span {

    font-size: 25px;
    font-weight: bold;
    align-self: flex-end;
}

.imageArea {
    width: 25vw;
    height: 32vh;
    align-self: flex-end;
    margin-bottom: 80px;
}

.description {
    width: 28vw;
    height: 8vh;
    align-self: flex-end;
    position: absolute;
    font-size: 15px;
    font-weight: 500;
    border-top: 1px solid black;
    text-align: center;
}

</style>
