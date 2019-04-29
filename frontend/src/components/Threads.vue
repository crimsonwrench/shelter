<template>
    <div>
      <h3>{{ this.$route.params.boardName }}</h3>
      <div class="threads">
        <div class="thread" v-for="thread in allThreads" :key="thread.id">
          {{ thread.title }}
        </div>
      </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
export default {
  name: 'Threads',
  methods: {
    ...mapActions(['fetchThreads'])
  },
  computed: mapGetters(['allThreads']),
  created() {
    this.fetchThreads(this.$route.params.boardName);
  }
};
</script>

<style scoped>
.threads {
  display: grid;
  grid-gap: 1rem;
}

.thread {
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 2px;
  text-align: center;
  position: relative;
  cursor: pointer;
}
</style>
