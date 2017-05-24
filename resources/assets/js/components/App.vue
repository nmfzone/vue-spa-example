<template>
  <div>
    <header class="header">
      <div class="container no-padding">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <router-link to="/" class="navbar-brand">
                RameIn SPA
              </router-link>
            </div>

            <div class="collapse navbar-collapse" id="navbarCollapse">
              <!-- Logged in -->
              <template v-if="auth.isLoggedIn">
                <ul class="nav navbar-nav">
                  <li class="active">
                    <router-link to="/contact">Contact <span class="sr-only">(current)</span></router-link>
                  </li>
                  <li>
                    <router-link to="/users">Users</router-link>
                  </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#">Hello, {{ user.name }}</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#" @click="logout()">Logout</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </template>

              <!-- Not logged in -->
              <template v-else>
                <ul class="nav navbar-nav">
                  <!--  -->
                </ul>

                <ul class="nav navbar-nav navbar-right">
                  <li>
                    <router-link to="/login">Login <span class="sr-only">(current)</span></router-link>
                  </li>
                  <li>
                    <router-link to="/register">Signup</router-link>
                  </li>
                </ul>
              </template>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <main>
      <div class="container">
        <router-view
          class="view"
          keep-alive
          transition
          transition-mode="out-in">
        </router-view>
      </div>
    </main>
  </div>
</template>

<script>
  import Auth from '@common-auth'

  export default {
    data() {
      return {
        auth: this.$store.state.auth,
      }
    },
    computed: {
      user() {
        return this.$store.getters.user
      }
    },
    methods: {
      logout() {
        if (confirm('Are you sure want to logout?')) {
          Auth.logout()
        }
      },
    }
  }
</script>

<style lang="scss">
  .header {
    margin-top: 30px;
    margin-bottom: 50px;

    > div {
      border-bottom: 1px solid #000;
    }
  }
</style>
