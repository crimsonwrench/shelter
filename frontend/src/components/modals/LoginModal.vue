<template>
  <modal name="login-modal">
      <div class="modal-box">
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
                placeholder="Enter Username"
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

            <b-button variant="outline-primary" type="submit">Submit</b-button>
          </b-form>
        </div>
      </div>
  </modal>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  name: 'LoginModal',
  data() {
    return {
      form: {
        username: '',
        password: ''
      }
    };
  },
  methods: {
    ...mapActions(['retrieveToken']),
    login() {
      this.retrieveToken({
        username: this.form.username,
        password: this.form.password
      })
        .then(response => {
          this.$modal.hide('login-modal');
          this.$router.push({ name: 'home' });
        });
    }
  }
};
</script>

<style>

</style>
