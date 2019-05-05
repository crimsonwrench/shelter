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
      <b-button size="sm" variant="outline-primary" class="mr-3 navbar-button">Log In</b-button>
      <b-button size="sm" variant="primary" class="mr-3 navbar-button">Sign Up</b-button>
    </b-navbar-nav>

    <b-dropdown size="sm" variant="light" right>
      <template v-slot:button-content>
        <v-icon name="tools"/>
      </template>
      <b-dropdown-item>Log In</b-dropdown-item>
      <b-dropdown-item>Sign Up</b-dropdown-item>
    </b-dropdown>

  </b-navbar>
</template>

<script>
import Icon from 'vue-awesome/components/Icon';

import 'vue-awesome/icons/tools';
import 'vue-awesome/icons/burn';
import 'vue-awesome/icons/star';
import 'vue-awesome/icons/brands/vuejs';

export default {
  name: 'Navbar',
  components: {
    'v-icon': Icon
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
