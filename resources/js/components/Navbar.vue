<template>
  <div class="header">
      <div class="blackbox" style="float: left;"></div>
      <a class="home" @click="changeSelect('home')" href="/#/">
        Home
        <div class="stripe" v-if="selected === 'home'"></div>
      </a>
      <a v-if="!authenticated" style="margin-left: auto; margin-right: 50px; color: white" v-b-modal.loginModal > log in</a>
      <div v-if="authenticated"> 
          <p style="margin-left: auto; margin-right: 20px; margin-top: 20px; color: white">Welcome {{user.username}}</p>
          <a @click="logout()" class="signout">Sign out</a>
      </div>
     

      
         <LoginModal></LoginModal>


        

      <div class="blackbox" style="float: right;"></div>
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

.stripe {
    height: 1px;
    background: white;
}

.createstripe {
    height: 3px;
    width: 200px;
    background: white;
}

.header {
  width: 100%;
  height: 70px;
  background: rgb(29, 24, 24);
  box-shadow: 3px 3px 3px grey;
  display: flex;
  align-items: center;
}

a {
    text-decoration: none;
    font-size: 20px;
    color: white;
}

.blackbox {
    height: 70px;
    width: 70px;
    background: black;
}

.home {
    margin-right: auto;
    margin-left: 20px;
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