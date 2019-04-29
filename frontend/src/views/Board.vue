<template>
  <div class="main-container">
    <div class="board-container">
      <Threads />
    </div>
    <div class="info">
      <h3>Mods</h3>
      <div></div>
      <h3>Stats</h3>
      <div></div>
    </div>
  </div>
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

<style lang="scss" scoped>
.main-container {
  display: grid;
  grid-template-columns: 2.5fr 1fr;
  grid-template-rows: auto;
  grid-template-areas: "board info" "board .";
  grid-column-gap: 40px;
}

.board-container { padding: 10px 10px; border: 2px dashed #ccc; grid-area: board; }

.info {
  padding: 10px;
  border: 2px dashed #ccc;
  grid-area: info;
  div {
    border: 1px solid #ccc;
    padding: 5rem;
    border-radius: 2px;
    margin: 2rem 0;
  }
}
</style>
