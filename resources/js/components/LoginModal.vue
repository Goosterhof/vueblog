<template>
  <div>
    
  <b-modal id="loginModal" size="sm">
      <div class="crd" >
          <b-form @submit.prevent="submit()">
              <b-form-group class="input" label="username" label-for="input-username">
                <b-form-input style="margin-top: 5px;" id="input-username" v-model="form.username" required></b-form-input>
              </b-form-group>
              <b-form-group class="input" label="password" label-for="input-password">
                <b-form-input type="password" style="margin-top: 5px;" id="input-password" v-model="form.password" required></b-form-input>
              </b-form-group>
              <b-button style="align-self: center;" type="submit" variant="primary">Log in</b-button>
              <p v-if="error" class="error">Incorrect Credentials</p>
             <p style="position: relative; left: 70px; color: white;"> No account?  — <a @click="changeToRegister" class="register">Register</a></p>
          </b-form>
      </div>
      <template #modal-header="{}">
          <div></div>
    </template>
      <template #modal-footer="{}">
          <div></div>
      
    </template>
  </b-modal>
  
  <b-modal id="registerModal" size="sm">
      <div class="crd" >
          <b-form @submit.prevent="submit()">
              <b-form-group class="input" label="username" label-for="input-username">
                <b-form-input style="margin-top: 5px;" id="input-username" v-model="form.username" required></b-form-input>
              </b-form-group>
              <b-form-group class="input" label="password" label-for="input-password">
                <b-form-input type="password" style="margin-top: 5px;" id="input-password" v-model="form.password" required></b-form-input>
              </b-form-group>
              <b-form-group class="input" label="confirm password" label-for="input-password">
                <b-form-input type="password" style="margin-top: 5px;" id="input-password" v-model="form.confirmPassword" required></b-form-input>
              </b-form-group>
              <b-button style="align-self: center;" type="submit" variant="primary">Register</b-button>
              <p v-if="error === 'passwordsDontMatch'" class="error">Passwords do not match</p>
              <p v-if="error === 'usernameTaken'" class="error">Username is not available</p>
             <p style="position: relative; left: 50px; color: white;"> Have an account?  — <a @click="changeToLogin" class="register">Login</a></p>
          </b-form>
      </div>
      <template #modal-header="{}">
          <div></div>
    </template>
      <template #modal-footer="{}">
          <div></div>
      
    </template>
  </b-modal>
  </div>
</template>

<script>

export default {
    data(){
    return {
      register: false,

      error: null, 

      form: {
        username: "",
        password: "",
        confirmPassword: ""
      }
    }
  },
  methods: {
    async submit(){
      this.error = null
      if(this.register){
        if(this.form.password !== this.form.confirmPassword){
          this.error = "passwordsDontMatch"
           this.form.password = ""
           this.form.confirmPassword = ""
        } else {
          try {
            await this.$store.dispatch("register", {username: this.form.username, password: this.form.password})
            this.changeToLogin()
          } catch (error) {
             console.log(error)
            
          }
        }
      } else {
        try {
          await this.$store.dispatch("login", {username: this.form.username, password: this.form.password})
          this.$bvModal.hide('loginModal')
          this.clearForm()
        } catch (error) {
          this.error = error
          this.clearForm()
        }
      }
      
    },
    changeToRegister(){
      this.error = null
      this.register = true
      this.clearForm()
      this.$bvModal.hide('loginModal')
      this.$bvModal.show('registerModal')
    },
    changeToLogin(){
      this.error = null
      this.register = false
      this.clearForm()
      this.$bvModal.hide('registerModal')
      this.$bvModal.show('loginModal')
    },
    clearForm(){
      for(const key of Object.keys(this.form)){
        this.form[key] = ""
      }
    }
  },

}
</script>

<style>
.crd {
    padding-top: 30px;
    width: 270px;
    background: rgb(29, 24, 24);
    display: flex;
    justify-content: center;
    flex-direction: row;
    border-radius: 3px;
}

.input {
    margin-bottom: 10px;
    color: white;
}

.register {
  text-decoration: underline; 
  color: rgb(0, 174, 255); 
}

.error {
  position: absolute; 
  left: 120px; 
  bottom: 50px;
  color: rgb(189, 0, 0);
}

</style>