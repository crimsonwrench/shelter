<template>
  <div>
    <ThreadCard v-for="thread in allThreads" :key="thread.id" :thread="thread"/>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import ThreadCard from '@/components/layout/ThreadCard.vue';
export default {
  name: 'Threads',
  components: {
    ThreadCard
  },
  methods: {
    ...mapActions(['fetchThreads'])
  },
  computed: mapGetters(['allThreads']),
  created() {
    this.fetchThreads(this.$route.params.board);
  }
};
</script>

<style scoped>

</style>
