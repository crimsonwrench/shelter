<template>
  <b-navbar sticky type="light" variant="light">
    <b-navbar-brand :to="{name: 'home'}">
      <v-icon name="brands/vuejs" class="mr-1"/>
        <b-navbar-brand class="d-none d-md-inline mr-0">Shelter</b-navbar-brand>
    </b-navbar-brand>

    <b-dropdown size="sm" variant="light" class="mr-auto" left>
      <template v-slot:button-content>
        <v-icon color="orange" name="burn"/>
        <p class="d-none d-sm-inline ml-2">Popular</p>
      </template>
      <b-dropdown-item>
        <v-icon color="orange" name="burn" class="mr-3"/>Popular
      </b-dropdown-item>
      <b-dropdown-item>
        <v-icon color="gold" name="star" class="mr-3"/>Best
      </b-dropdown-item>
    </b-dropdown>

    <b-input-group size="sm" class="mx-3">
      <b-form-input placeholder="Search..."></b-form-input>
    </b-input-group>

    <b-navbar-nav class="d-none d-md-flex ml-auto">
      <b-button
        size="sm"
        variant="outline-primary"
        class="mr-3 navbar-button"
        @click="$modal.show('login-modal')"
        v-if="!loggedIn"
      >
        Log In
      </b-button>
      <b-button size="sm" variant="primary" class="mr-3 navbar-button" v-if="!loggedIn">Sign Up</b-button>
    </b-navbar-nav>

    <b-dropdown size="sm" variant="light" right>
      <template v-slot:button-content>
        <span v-if="loggedIn" class="mr-3">{{ user.name }}</span>
        <v-icon v-if="!loggedIn" name="cog"/>
      </template>
      <b-dropdown-item @click="$modal.show('login-modal')" v-if="!loggedIn">Log In</b-dropdown-item>
      <b-dropdown-item v-if="!loggedIn">Sign Up</b-dropdown-item>
      <b-dropdown-item @click="logOut" v-if="loggedIn">Log Out</b-dropdown-item>
    </b-dropdown>

  </b-navbar>
</template>

<script>
import Icon from 'vue-awesome/components/Icon';

import 'vue-awesome/icons/cog';
import 'vue-awesome/icons/burn';
import 'vue-awesome/icons/star';
import 'vue-awesome/icons/brands/vuejs';

export default {
  name: 'Navbar',
  components: {
    'v-icon': Icon
  },
  methods: {
    logOut() {
      this.$store.dispatch('destroyToken')
        .then(response => {
          this.$store.dispatch('destroyUser');
          this.$router.push({ name: 'home' });
        });
    }
  },
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    },
    user() {
      return this.$store.getters.user;
    }
  }
};
</script>

<style lang="scss" scoped>
.navbar {
  border-bottom: 1px solid #ccc;
}
.navbar-button {
  width: 120px;
}
.fa-icon {
  height: 20px;
  width: 20px;
  margin-top: -5px;
}
</style>
