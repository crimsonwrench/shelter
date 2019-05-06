<template>
  <router-link
    :to="{ name: 'thread', params: { board: this.$route.params.board, thread: thread.link_id } }"
    tag="div"
    class="main-item select"
  >
    <b-row>
      <b-col class="d-flex flex-column">
        <div class="main-item-header">
          {{ thread.user.name }}
        </div>
        <div class="main-item-body">
          {{ thread.title}}
        </div>
      </b-col>
    </b-row>
  </router-link>
</template>

<script>
export default {
  name: 'ThreadCard',
  props: ['thread']
};
</script>

<style>

</style>
