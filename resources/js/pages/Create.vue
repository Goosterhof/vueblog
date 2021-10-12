<template>
  <div>
      <div class="container">
      <b-form @submit.prevent="submitArticle()">
        <b-form-group class="mt-4" label="title" label-for="input-title">
          <b-form-input  id="input-title" v-model="newArticle.title"></b-form-input>
        </b-form-group>
        <b-form-group label="description" label-for="input-description">
          <b-form-textarea id="input-description" v-model="newArticle.description"></b-form-textarea>
        </b-form-group>
        <b-form-group  label="body" label-for="input-body">
          <b-form-textarea style="height: 300px;" id="input-body" v-model="newArticle.body"></b-form-textarea>
        </b-form-group>
        <b-form-group label="image" label-for="input-image">
          <b-form-input id="input-image" v-model="newArticle.imageUrl"></b-form-input>
        </b-form-group>
          <b-form-select v-model="newArticle.tags" :options="tags.map(t => t.subject)" multiple></b-form-select>
         <b-button class="pushFooter mt-2" type="submit" variant="primary">Submit</b-button>
      </b-form>
      </div>


  </div>
</template>

<script>
export default {
  data() {
    return {
      newArticle: {
        // author
        title: null,
        description: null,
        body: null,
        imageUrl: "https://images.nrc.nl/J6kNiS4X-JnVV4IeMoeDnIdnpFY=/1920x/filters:no_upscale():format(webp)/s3/static.nrc.nl/images/gn4/stripped/data77158419-8cf3a6.jpg",
        tags: []
      },
    }
  },
  computed: {
    tags(){
      return this.$store.getters.tags
    }
  },
  methods: {
    submitArticle(){
      this.$store.dispatch("submitArticle", this.newArticle)
    }
  },
  mounted(){
    this.$store.dispatch("getTags")
  }
}
</script>

<style>

</style>