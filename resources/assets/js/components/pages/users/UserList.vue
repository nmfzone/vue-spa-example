<template>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <b>User Lists</b>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table user-list">
            <thead>
              <tr>
                <th>User</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users">
                <td>
                  <img :src="user.photo_url" :alt="user.name">
                  <a href="#" class="user-link">{{ user.name }}</a>
                  <span class="user-subhead">Member</span>
                </td>
                <td>{{ user.email }}</td>
                <td style="width: 20%;">
                  Action
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        users: null
      }
    },
    mounted() {
      axios.get(`/api/v1/users`)
        .then(({data}) => {
          this.users = data.data
        }).catch(error => {
          console.log(error)
        })
    }
  }
</script>

<style lang="scss" scoped>
.user-list tbody td .user-subhead {
  font-size: 0.875em;
  font-style: italic;
}
.user-list tbody td .user-link {
  display: block;
  font-size: 1.25em;
  padding-top: 3px;
  margin-left: 60px;
}
.user-list tbody td > img {
  position: relative;
  max-width: 50px;
  float: left;
  margin-right: 15px;
}
.table thead tr th {
  text-transform: uppercase;
  font-size: 0.875em;
}
.table thead tr th {
  border-bottom: 2px solid #e7ebee;
}
.table tbody tr td:first-child {
  font-size: 1.125em;
  font-weight: 300;
}
.table tbody tr td {
  font-size: 0.875em;
  vertical-align: middle;
  border-top: 1px solid #e7ebee;
  padding: 12px 8px;
}
</style>
