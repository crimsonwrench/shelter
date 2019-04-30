<template>
  <div>
    <b-card
      v-for="board in allBoards"
      :key="board.id"
      class="mb-3"
    >
      <b-link :to="{ name: 'board', params: { boardName: board.name} }">
        <b-card-text>{{ board.description }}</b-card-text>
      </b-link>
    </b-card>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'Boards',
  methods: {
    ...mapActions(['fetchBoards'])
  },
  computed: mapGetters(['allBoards']),
  created() {
    this.fetchBoards();
  }
};
</script>

<style scoped>

</style>
