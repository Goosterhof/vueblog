<template>
  <div class="header">

      <router-link :to="{name: 'home'}">
        <img id="hide-logo" style="margin-left: 10px;" :src="logo">
      </router-link>
      <a v-if="!authenticated" style="margin-left: auto; margin-right: 50px;" class='button' v-b-modal.loginModal > log in</a>

<!--
    TODO :: you could wrap these router links in a template, so you only need to check authenticated once
    the template can even be an else, because of the if statement above
-->
      <router-link id="small-font" v-if="authenticated" :to="{name: 'home'}" class="button" style="margin-left: 20px" >Home</router-link>
      <router-link id="small-font" v-if="authenticated" :to="{name: 'dashboard'}" class="button" style="margin-left: 10px;">Dashboard</router-link>
      <router-link id="small-font" v-if="authenticated" :to="{name: 'create'}" class="button" style="margin-left: 10px;">New Article</router-link>

      <div v-if="authenticated" style="margin-left: auto; margin-right: 10px; margin-top: 20px;">
          <p v-if="user" id="small-font" style="color: white">Welcome {{user.username}}</p>
          <a @click="logout()" class="signout">Sign out</a>
      </div>



         <LoginModal></LoginModal>





  </div>
</template>

<script>
import {mapGetters} from "vuex"
import LoginModal from "./LoginModal.vue"
import logo from "../../../public/images/logo.svg"

export default {
    data(){
        return {
            logo: logo
        }
    },
    components: {
        LoginModal
    },
    methods: {
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

@media only screen and (max-width: 480px) {
  #hide-logo {display: none}
}

@media only screen and (max-width: 425px) {
  #small-font {font-size: 14px}
}


.header {
  width: 100%;
  height: 70px;
  background: linear-gradient(45deg, black, grey);
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

.button {

    color: lightgrey;
}

.button:hover {
    color: white;
}

.signout {
    text-decoration: underline;
    color: rgb(43, 42, 42);
    font-size: 14px;
    position: relative;
    left: 50px;
    bottom: 15px;
    cursor: pointer;
}

</style>
