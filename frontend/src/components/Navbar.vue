<template>
<b-navbar sticky toggleable="lg" type="light" variant="light">
    <b-navbar-brand :to="{name: 'home'}">
      <v-icon scale=1.4 name="brands/vuejs" class="mr-1"/>Shelter
    </b-navbar-brand>

    <b-nav class="mr-auto">
      <b-nav-item href="#"><v-icon color="orange" scale=1.2 name="burn" class="mr-2"/>Popular</b-nav-item>
      <b-nav-item href="#"><v-icon color="gold" scale=1.2 name="star" class="mr-2"/>Best</b-nav-item>
    </b-nav>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav class="ml-auto">
        <b-button size="sm" variant="outline-primary" class="mr-3 navbar-button">Log In</b-button>
        <b-button size="sm" variant="primary" class="mr-3 navbar-button">Sign Up</b-button>
      </b-navbar-nav>
    </b-collapse>

    <b-dropdown size="sm" variant="light" right>
          <template slot="button-content">
            <v-icon scale=1 name="tools"/>
          </template>
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
  margin-top: -5px;
}
</style>
