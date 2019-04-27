<template>
  <div>
    <h3>Boards</h3>
    <div class="boards">
      <div class="board" v-for="board in allBoards" :key="board.id">
        {{ board.name }}
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Boards',
  methods: {
    ...mapActions(['fetchBoards'])
  },
  computed: mapGetters(['allBoards']),
  created() {
    this.fetchBoards()
  }
}
</script>

<style scoped>
.boards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 1rem;
}

.board {
  border: 1px solid #ccc;
  background: #41b883;
  padding: 1rem;
  border-radius: 5px;
  text-align: center;
  position: relative;
  cursor: pointer;
}
</style>
