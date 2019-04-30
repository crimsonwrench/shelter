<template>
  <b-container>
    <b-row>
      <b-col md="8">
        <Threads />
      </b-col>
      <b-col md="4">
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Threads from '@/components/Threads.vue';
export default {
  name: 'board',
  components: {
    Threads
  }
};
</script>
