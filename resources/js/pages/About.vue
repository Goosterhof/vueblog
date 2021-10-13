<template>
  <div class="parent">
    <div v-for="index in rectangleAmount-1" :key="index"> 
      <section :style="rectangleColours[index]" class="child rectangle"></section>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      rectangleAmount: 10,
      rectangleColours: [],
    }
  },
  mounted(){
    let n1 = 40
    let n2 = 40
    let n3 = 40

    for(let i = 0; i < this.rectangleAmount; i++){
      this.rectangleColours.push({background: `rgba(${n1}, ${n2}, ${n3})`})
      n1 += 5,
      n2 += 5,
      n3 += 5
    }
  }
}
</script>

<style>

.parent {

  scroll-snap-type: y mandatory;
}

.child {
  scroll-snap-align: start;
  height: 50vh;
}

</style>