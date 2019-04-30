<template>
  <b-container>
    <b-row>
      <b-col md="8">
        <Boards />
      </b-col>
      <b-col md="4">
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Boards from '@/components/Boards.vue';
export default {
  name: 'home',
  components: {
    Boards
  }
};
</script>

<style lang="scss" scoped>

</style>
