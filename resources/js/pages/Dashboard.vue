
<template>
  <div  class="flex flex-col h-screen flex-wrap bg-gray-500">
    <div class="w-full h-12 bg-gray-900 absolute">
      <p class="text-center text-2xl text-white mt-1">{{ selected }}</p>
    </div>
      <div class="w-64 bg-gray-700 h-full">
        <div @click="button('My Articles')" id="button">
          <p id="button-text">My Articles</p>
        </div>
        <div @click="button('test')" id="button">
          <p id="button-text">Test</p>
        </div>
      </div>
      <div v-if="selected === 'My Articles'" class="flex flex-column flex-wrap w-full  mt-12">
        <div id="article-background" v-for="article in userArticles" :key="article.id">
          <div   class="w-screen h-36 flex flex-column">
            <div class="h-1/4"></div>
            <div class="h-2/4 bg-gray-100 max-w-3xl  ml-4 mb-2">
              <p class="font-serif">{{article.description}}</p>
            </div>
            <div id="gradient" class="h-1/4 ">
              <router-link :to="{name: 'articles', params: {articleId: article.id}}">
                <p class="text-2xl text-black ml-2">{{article.title}}</p>
              </router-link>
            </div>              
          </div>
        </div>
         <button v-if="articleAmount > 4 && !allArticles" class="bg-white w-48 rounded h-8 mt-3 ml-1">
           <p @click="viewAll()" class="text-xl">view all your articles</p>
         </button>
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
      selected: "My Articles",
      allArticles: false
    }
  },
  computed: {
    articleAmount(){
      return this.$store.getters.userArticles.length
    },
    userArticles(){
      if(this.allArticles){
        return this.$store.getters.userArticles
      } else {
        return this.$store.getters.userArticles.slice(0, 4)
      }
      
    },
    ...mapGetters({
         user: "user",
    }),
  },
  methods: {
    button(type) {
      switch (type) {
        case "My Articles":
          this.selected = "My Articles"
          break;
        case "test":
          this.selected = "test"
          break;
        default:
          break;
      }
    },
    viewAll(){
      this.allArticles = true
    }
  },
  async mounted(){
    await this.$store.dispatch("getArticles")
    .then(() => {
      this.$store.dispatch("getUserArticles", this.user)
    })
    
   
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


#article-background {
  background: white;
}

#gradient {
  background: linear-gradient( white, rgb(187, 185, 185));
}

a:link { text-decoration: none; }

</style>