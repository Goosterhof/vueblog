<template>
  <div>
      <div class="footer">
        <div class="buttonContainer">
            <a  @click="a()" class="link">About us</a> 
        </div>
      </div>
  </div>
</template>

<script>
export default {
  methods: {
    async a(){
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
      })
      if(this.$route.name !== 'about'){
        this.$router.push({name: 'about'})
      }
      }
  }
}
</script>

<style scoped>

.footer {
     
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 30px;
  background: linear-gradient(45deg, lightgrey, grey);
  display: flex;
}

.buttonContainer {
  display: flex;
  margin-bottom: 5px;
  margin-left: 10px;
  flex-direction: row;
  column-gap: 20px;
}

a {
    color: black;
    font-size: 15px;
    align-self: flex-end;
    cursor: pointer;
}


a:hover {
    text-decoration: none;
}
</style>