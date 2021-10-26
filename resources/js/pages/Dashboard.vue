
<template>
  <div class="flex flex-col h-screen flex-wrap bg-gray-500">
    <div class="w-64 h-12 bg-gray-900 absolute"></div>
      <div class="w-64 bg-gray-700 h-full">
        <div @click="button('articles')" id="button">
          <p id="button-text">My Articles</p>
        </div>
        <div @click="button('test')" id="button">
          <p id="button-text">Test</p>
        </div>
      </div>
      <div v-if="selected === 'articles'" class="flex flex-column flex-wrap w-full   h-full">
        <div id="article-background" v-for="article in articles" :key="article.id">
          <div  class="w-screen h-36"> 
    
          </div>
        </div>
      </div>
      

      
  </div>
</template>

<script>
import {mapGetters} from "vuex"
import Sidebar from '../components/Sidebar.vue'


export default {
  components: {
    Sidebar
  },
  data() {
    return {
      images: this.$store.getters.articles.map(a => a.imageUrl),
      selected: "articles",
    }
  },
  computed: {
    articles(){
      return this.$store.getters.articles.slice(0, 4)
    },
    ...mapGetters({
         userArticles: "userArticles",
         user: "user",
    }),
    articleImages(){
      return 
    }
  },
  methods: {
    button(type) {
      switch (type) {
        case "articles":
          this.selected = "articles"
          break;
        case "test":
          this.selected = "test"
          break;
        default:
          break;
      }
    }
  },
  async mounted(){
    await this.$store.dispatch("getArticles")
    .then(() => {
    })
  //   this.$store.dispatch("getUserArticles", this.user)
  }
}
</script>

<style scoped>

#button {
  width: 100%;
  height: 50px;
  margin-top: 70px;
  display: flex;
  justify-content: center;
  cursor: pointer;
}

#button:hover {
  background: rgb(236, 236, 236);
}

#button-text {
  font-size: 25px;
  line-height: 45px;
  color: white;
}

#article-background:nth-child(even) {
  background: rgb(209, 209, 209);
}

#article-background:nth-child(odd) {
  background: white;
}

#image-gradient {
  background: linear-gradient(45deg, black, grey);
}

</style>