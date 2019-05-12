<template>
  <b-container>
    <b-row align-h="center">
      <b-col cols=12 sm=12 md=6 class="main-item">
        <div class="modal-header">
          Sign Up
        </div>
        <div class="modal-body">
          <b-form @submit.prevent="register">
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
                :state="validateUsername"
              ></b-form-input>

              <div class="mt-3">
                <b-alert variant="danger" v-for="error in errors.login" :key="error.id" :show="error">{{ error }}</b-alert>
                <b-alert variant="danger" :show="!validateUsernameLength">
                  Username should be between 3 and 20 characters.
                </b-alert>
                <b-alert variant="danger" :show="validateUsernameSymbols">
                  Username should contain only letters, numbers, dashes and underscores.
                </b-alert>
              </div>
            </b-form-group>

            <b-form-group
              id="email-group"
              label="Email:"
              label-for="email-field"
            >
              <b-form-input
                id="email-field"
                v-model="form.email"
                type="email"
                :state="validateEmail"
                required
              ></b-form-input>

              <div class="mt-3">
                <b-alert variant="danger" v-for="error in errors.email" :key="error.id" :show="error">{{ error }}</b-alert>
                <b-alert variant="danger" :show="!validateEmailFormat">
                  You should enter a valid email address.
                </b-alert>
              </div>
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
                :state="validatePassword"
                required
              ></b-form-input>

              <div class="mt-3">
                <b-alert variant="danger" :show="!validatePassword">
                  Password should be 6 characters long or greater.
                </b-alert>
              </div>
            </b-form-group>

            <b-form-group
              id="confirm-password-group"
              label="Confirm password:"
              label-for="confirm-password-field"
            >
              <b-form-input
                id="confirm-password-field"
                v-model="form.password_confirmation"
                type="password"
                :state="validatePasswordConfirm"
                required
              ></b-form-input>
            </b-form-group>

            <b-button :disabled="!validateForm" block variant="success" type="submit" class="mt-4">Sign Up</b-button>
          </b-form>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import axios from 'axios';
import { debounce } from 'lodash';
export default {
  name: 'Register',
  data() {
    return {
      errors: {
        login: [],
        email: []
      },
      result: '',
      form: {
        username: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    };
  },
  watch: {
    username() {
      this.debouncedCheckUser();
    },
    email() {
      this.debouncedCheckEmail();
    }
  },
  created() {
    this.debouncedCheckUser = debounce(this.usernameTaken, 500);
    this.debouncedCheckEmail = debounce(this.emailTaken, 500);
  },
  methods: {
    async usernameTaken() {
      this.errors.login = [];

      if (!this.validateUernameLength || !this.validateUsernameSymbols) {
        return;
      }

      let query = await axios.get(`/user_exists?username=${this.form.username}`);
      let taken = await query.data;

      if (taken) {
        this.errors.login.push('This username is taken. Please choose another one.');
      }

      return taken;
    },
    async emailTaken() {
      this.errors.email = [];

      if (!this.validateEmailFormat) {
        return;
      }

      let query = await axios.get(`/user_exists?email=${this.form.email}`);
      let taken = await query.data;

      if (taken) {
        this.errors.email.push('This email is taken. Please choose another one.');
      }

      return taken;
    },
    register() {
      this.result = '';
      this.$store.dispatch('registerUser', this.form)
        .then(response => {
          this.$router.push({ name: 'home' });
        })
        .catch(error => {
          this.result = error.response;
        });
    }
  },
  computed: {
    username() {
      return this.form.username;
    },
    email() {
      return this.form.email;
    },
    validateUsernameLength() {
      return this.form.username.length <= 20 && this.form.username.length >= 3;
    },
    validateUsernameSymbols() {
      return /[^A-Za-z0-9_-]/.test(this.form.username);
    },
    validateUsername() {
      return this.errors.login.length === 0 && this.validateUsernameLength && !this.validateUsernameSymbols;
    },
    validateEmailFormat() {
      return /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email);
    },
    validateEmail() {
      return this.errors.email.length === 0 && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email);
    },
    validatePassword() {
      return this.form.password.length >= 6;
    },
    validatePasswordConfirm() {
      return this.form.password === this.form.password_confirmation;
    },
    validateForm() {
      return this.validateUsername && this.validateEmail && this.validatePassword && this.validatePasswordConfirm;
    }
  }
};
</script>

<style>

</style>
