<template>
  <router-link
    :to="{ name: 'board', params: { board: board.name } }"
    tag="div"
    class="main-item select"
  >
    <div class="board-header">
      <h4>{{ board.name }}</h4>
    </div>
    <div class="board-body">
      {{ board.description }}
    </div>
  </router-link>
</template>

<script>
export default {
  name: 'BoardCard',
  props: ['board']
};
</script>

<style lang="scss" scoped>
</style>
