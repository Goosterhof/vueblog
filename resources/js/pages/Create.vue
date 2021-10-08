<template>
  <div class="space">
      
      <b-form @submit.prevent="submitArticle()">
        <b-form-group label="title" label-for="input-title">
          <b-form-input id="input-title" v-model="newArticle.title"></b-form-input>
        </b-form-group>
        <b-form-group label="description" label-for="input-description">
          <b-form-textarea id="input-description" v-model="newArticle.description"></b-form-textarea>
        </b-form-group>
        <b-form-group label="body" label-for="input-body">
          <b-form-textarea id="input-body" v-model="newArticle.body"></b-form-textarea>
        </b-form-group>
        <b-form-group label="image" label-for="input-image">
          <b-form-input id="input-image" v-model="newArticle.imageUrl"></b-form-input>
        </b-form-group>
        <b-form-select v-model="newArticle.tags" :options="subjects" multiple></b-form-select>
          <div>{{newArticle.tags}}</div>
         <b-button type="submit" variant="primary">Submit</b-button>
      </b-form>


  </div>
</template>

<script>
export default {
  data() {
    return {
      newArticle: {
        title: null,
        description: null,
        body: null,
        imageUrl: "https://images.nrc.nl/J6kNiS4X-JnVV4IeMoeDnIdnpFY=/1920x/filters:no_upscale():format(webp)/s3/static.nrc.nl/images/gn4/stripped/data77158419-8cf3a6.jpg",
        tags: []
      },
      subjects: [
        "Lifestyle",
        "International",
        "Sports",
        "Science",
        "History",
        "Economy",
        "Celebrity",
        "Infrastructure",
        "Mythology",
        "Finance",
        "Travel",
        "Politics",
        "Technology",
      ],
    }
  },
  methods: {
    submitArticle(){
      this.$store.dispatch("submitArticle", this.newArticle)
    }
  }
}
</script>

<style>

</style>