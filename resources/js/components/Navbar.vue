<template>
  <div class="header">
     
      <a v-if="!authenticated" style="color: white; margin-left: 20px" v-b-modal.loginModal > log in</a>
      <router-link v-if="authenticated" :to="{name: 'home'}" style="margin-left: 20px" >Home</router-link>
      <router-link v-if="authenticated" :to="{name: 'dashboard'}" style="margin-left: 10px;">Dashboard</router-link>

      
      <div v-if="authenticated" style="margin-left: auto; margin-right: 10px; margin-top: 20px;"> 
          <p style="color: white">Welcome {{user.username}}</p>
          <a @click="logout()" class="signout">Sign out</a>
      </div>
     

      
         <LoginModal></LoginModal>


        

    
  </div>
</template>

<script>
import {mapGetters} from "vuex"
import LoginModal from "./LoginModal.vue"

export default {
    data(){
        return {
            
        }
    },
    components: {
        LoginModal
    },
    methods: {
        changeSelect(string){
            this.$store.commit("changeSelected", string)
        },
        logout(){
            this.$store.dispatch("logout");
        }
    },
    computed: {
       
     ...mapGetters({
         authenticated: "authenticated",
         user: "user",
         selected: "selected"
     })
    }

}
</script>

<style scoped>


.header {
  width: 100%;
  height: 70px;
  background: rgb(29, 24, 24);
  box-shadow: 3px 3px 3px grey;
  display: flex;
  align-items: center;
}

a {
    
    font-size: 20px;
    color: white;
}

.router-link-exact-active {
    text-decoration: underline;
}

.login {
    margin-left: auto;
    margin-right: 50px;
}

.signout {
    text-decoration: underline;
    color: gray;
    font-size: 14px;
    position: relative;
    left: 50px;
    bottom: 15px;
    cursor: pointer;
}

</style>