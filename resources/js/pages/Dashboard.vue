<template>
  <div class="space">
      <div v-for="(index, article) in userArticles" :key="article.id">
        <div class="bg-contain ml-12 mt-12 w-64 h-36 border-2  xd" :style="{ 'background-image': 'url(' + articleImages[index] + ')' }"> 
          {{article.title}}
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
      image: "http://1.bp.blogspot.com/-8PfnHfgrH4I/TylX2v8pTMI/AAAAAAAAJJ4/TICBoSEI57o/s1600/search_by_image_image.png"
    }
  },
  computed: {
    ...mapGetters({
         userArticles: "userArticles",
         user: "user"
    }),
    articleImages(){
      console.log(this.userArticles.map(a => a.imageUrl))
    }
  },
  mounted(){
    this.$store.dispatch("getUserArticles", this.user)
  }
}
</script>

<style>


</style>