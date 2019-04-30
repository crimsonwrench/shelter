<template>
    <div>
      <h3>{{ this.$route.params.boardName }}</h3>
      <b-card
        v-for="thread in allThreads"
        :key="thread.id"
        :header="thread.title"
        :footer="`created at ${thread.created_at}`"
        class="mb-3"
      >
          <b-card-text>{{ thread.text}}</b-card-text>
      </b-card>
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

</style>
