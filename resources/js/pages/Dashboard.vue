<template>
  <div class="space">
      
  </div>
</template>

<script>
import {mapGetters} from "vuex"
import Sidebar from '../components/Sidebar.vue'


export default {
  components: {
    Sidebar
  },
  computed: {
    ...mapGetters({
         userArticles: "userArticles",
         user: "user"
    })
  },
  mounted(){
    this.$store.dispatch("getUserArticles", this.user)
  }
}
</script>

<style>

</style>