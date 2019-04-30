<template>
  <div id="app">
    <Navbar />
    <b-container>
      <b-row>
        <b-col md="8" offset-md="2" class="mt-3">
          <router-view />
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
export default {
  components: {
    Navbar
  }
};
</script>

<style lang="scss">

</style>
