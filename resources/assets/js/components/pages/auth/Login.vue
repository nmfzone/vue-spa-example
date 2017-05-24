<template>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <b>Login</b>
      </div>
      <div class="panel-body">
        <form-alert :show="showAlert" :state="results.type">
            {{ results.message }}
        </form-alert>
        <form v-on:submit.prevent="handleLogin">
          <div class="form-group" v-bind:class="{ 'has-error': errors.email }">
            <label for="email">Email</label>
            <input class="form-control" type="email" v-model="email" required />

            <form-error v-if="errors.email">
                {{ errors.email }}
            </form-error>
          </div>

          <div class="form-group" v-bind:class="{ 'has-error': errors.password }">
            <label for="password">Password</label>
            <input class="form-control" type="password" v-model="password" required />

            <form-error v-if="errors.password">
                {{ errors.password }}
            </form-error>
          </div>

          <button class="btn btn-primary btn-login">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import FormAlert from '@shared/FormAlert.vue'
  import FormError from '@shared/FormError.vue'
  import Form from '@common-form'
  import helpers from '@common-functions/helpers'

  export default {
    components: {
      FormAlert,
      FormError,
    },
    data() {
      return {
        form: new Form([
          'email', 'password'
        ]),
        showAlert: false,
        results: {},
        email: '',
        password: ''
      }
    },
    computed: {
      errors() {
        return this.form.getErrors()
      }
    },
    methods: {
      handleLogin() {
        this.showAlert = false
        this.form.emptyErrors()
        this.results = {}
        helpers.disableBtn('.btn-login')

        this.$auth.login(this).then(response => {
          if (response.data.access_token) {
            if (this.$route.query.redirect) {
              return this.$router.push(this.$route.query.redirect)
            }

            return this.$router.push({ name: 'home' })
          }
        }).catch(error => {
          helpers.enableBtn('.btn-login')
          if (error.response) {
            if (error.response.data.message) {
              this.showAlert = true
              this.$set(this.results, 'type', 'danger')
              this.$set(this.results, 'message', error.response.data.message)
            } else {
              this.form.setErrors(error.response.data, 0)
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
