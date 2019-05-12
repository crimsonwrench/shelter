<template>
  <div id="app">
    <Navbar />
    <b-container class="mt-3">
      <b-row>
        <b-col md="12" class="mt-3">
          <router-view />
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Navbar from '@/components/layout/Navbar.vue';
export default {
  components: {
    Navbar
  }
};
</script>

<style lang="scss">

</style>
