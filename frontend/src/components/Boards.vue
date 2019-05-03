<template>
  <div>
      <BoardCard v-for="board in allBoards" :key="board.id" :board="board"/>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import BoardCard from '@/components/layout/BoardCard.vue';

export default {
  name: 'Boards',
  components: {
    BoardCard
  },
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
