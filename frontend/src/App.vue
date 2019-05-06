<template>
  <div id="app">
    <login-modal />
    <Navbar />
    <b-container>
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
import LoginModal from '@/components/modals/LoginModal.vue';
export default {
  components: {
    Navbar,
    LoginModal
  }
};
</script>

<style lang="scss">

</style>
