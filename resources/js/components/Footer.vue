<template>
  <div>
      <div class="footer">
          <router-link :to="{name: 'about'}">
             <div class="link">About us</div> 
          </router-link>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

.footer {
     
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 70px;
  background: linear-gradient(45deg, lightgrey, grey);
  display: flex;
}

a {
    color: black;
    font-size: 20px;
    align-self: flex-end;
}

a:link {
    text-decoration: none;
}
</style>