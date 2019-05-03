<template>
  <router-link
    :to="{ name: 'thread', params: { board: this.$route.params.board, thread: thread.link_id } }"
    tag="div"
    class="main-item select"
  >
    <div class="thread-header">
      <p><b>{{ thread.user.name }}</b> on {{ thread.created_at }}</p>
      <p><b>{{ thread.title }}</b></p>
    </div>
    <div class="thread-body">
      {{ thread.text }}
    </div>
  </router-link>
</template>

<script>
export default {
  name: 'ThreadCard',
  props: ['thread']
};
</script>

<style lang="scss" scoped>
</style>
