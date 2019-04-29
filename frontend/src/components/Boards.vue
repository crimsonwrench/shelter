<template>
  <div>
    <h3>Boards</h3>
    <div class="boards">
      <div class="board" v-for="board in allBoards" :key="board.id">
        <router-link :to="{ name: 'board', params: { boardName: board.name} }">{{ board.name }}</router-link>
      </div>
    </div>
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
.boards {
  display: grid;
  grid-gap: 1rem;
}

.board {
  border: 1px solid #ccc;
  padding: 1rem;
  border-radius: 2px;
  text-align: center;
  position: relative;
  cursor: pointer;
}
</style>
