<template>
    <div>
        <Navbar></Navbar>
        <div>
            <router-view/>
        </div>
    </div>
</template>

<script>
import Navbar from "./components/Navbar.vue"


export default {
    components: {
        Navbar,
    },
    data() {
        return {
            
        };
    },
};

</script>


<style scoped>

</style>