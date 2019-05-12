<template>
  <b-container>
    <b-row align-h="center">
      <b-col cols=12 sm=12 md=6 class="main-item">
        <div class="modal-header">
          Login
        </div>
        <div class="modal-body">
          <b-form @submit.prevent="login">
            <b-form-group
              id="username-group"
              label="Username:"
              label-for="username-field"
            >
              <b-form-input
                id="username-field"
                v-model="form.username"
                type="text"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="password-group"
              label="Password:"
              label-for="password-field"
            >
              <b-form-input
                id="password-field"
                v-model="form.password"
                type="password"
                required
              ></b-form-input>
            </b-form-group>

            <b-button block variant="success" type="submit" class="mt-4">Login</b-button>
          </b-form>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  name: 'Login',
  data() {
    return {
      form: {
        username: '',
        password: ''
      }
    };
  },
  methods: {
    ...mapActions(['retrieveToken', 'retrieveUser']),
    login() {
      this.retrieveToken({
        username: this.form.username,
        password: this.form.password
      })
        .then(response => {
          this.retrieveUser();
          this.$router.go(-1);
        });
    }
  }
};
</script>

<style>

</style>
