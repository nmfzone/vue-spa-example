<template>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <b>Signup</b>
      </div>
      <div class="panel-body">
        <form-alert :show="showAlert" :state="results.type">
            {{ results.message }}
        </form-alert>
        <form v-on:submit.prevent="handleLogin">
          <div class="form-group" v-bind:class="{ 'has-error': errors.email }">
            <label for="email">Email</label>
            <input class="form-control" type="email" v-model="email" required />

            <form-error v-if="errors.email" :errors="errors">
                {{ errors.email }}
            </form-error>
          </div>

          <div class="form-group" v-bind:class="{ 'has-error': errors.name }">
            <label for="name">Name</label>
            <input class="form-control" type="text" v-model="name" required />

            <form-error v-if="errors.name" :errors="errors">
                {{ errors.name }}
            </form-error>
          </div>


          <div class="form-group" v-bind:class="{ 'has-error': errors.password }">
            <label for="password">Password</label>
            <input class="form-control" type="password" v-model="password" required />

            <form-error v-if="errors.password" :errors="errors">
                {{ errors.password }}
            </form-error>
          </div>

          <div class="form-group" v-bind:class="{ 'has-error': errors.password }">
            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control" type="password" v-model="password_confirmation" required />
          </div>

          <button class="btn btn-primary">Signup</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import FormAlert from '@shared/FormAlert.vue'
  import FormError from '@shared/FormError.vue'

  export default {
    components: {
      FormAlert,
      FormError,
    },
    data() {
      return {
        showAlert: false,
        results: {},
        errors: {},
        email: '',
        name: '',
        password: '',
        password_confirmation: '',
      }
    },
    methods: {
      handleLogin() {
        const self = this

        this.$auth.register(this).then(response => {
          if (response.data.email) {
            return self.$auth.login(this).then(response => {
              if (response.data.access_token) {
                if (self.$route.query.redirect) {
                  return self.$router.push(self.$route.query.redirect)
                }

                return self.$router.push({ name: 'home' })
              }
            })
          }
        }).catch(error => {
          this.showAlert = false
          this.errors = {}

          if (error.response) {
            if (error.response.data.message) {
              this.showAlert = true
              this.results.type = 'danger'
              this.results.message = error.response.data.message
            } else {
              if (error.response.data.email) {
                this.$set(this.errors, 'email', error.response.data.email[0])
              }
              if (error.response.data.name) {
                this.$set(this.errors, 'name', error.response.data.name[0])
              }
              if (error.response.data.password) {
                this.$set(this.errors, 'password', error.response.data.password[0])
              }
            }
          } else {
            console.log(error)
          }
        })
      }
    }
  }
</script>

<style lang="scss">
  //
</style>
