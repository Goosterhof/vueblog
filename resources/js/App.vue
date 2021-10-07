<template>
    <div class="pageContainer">
        <Navbar></Navbar>
        <router-view/>
        <Footer></Footer>
    </div>
</template>

<script>
import Navbar from "./components/Navbar.vue"
import Footer from "./components/Footer.vue"


export default {
    components: {
        Navbar,
        Footer
    },
    data() {
        return {
            
        };
    },
};

</script>


<style>

html, body {
    max-width: 100%;
    overflow-x: hidden;
}

.pageContainer {
  position: relative;
  min-height: 100vh;
}

.space {
    height: 81.2vh;
    width: 100%;
}

.pushFooter {
    margin-bottom: 150px;
}


</style>