<template>
  <div class="main-item">
    <div class="main-item-header">
      <h4>{{ post.title }}</h4>
    </div>
    <div class="main-item-body">
      {{ post.text }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'PostCard',
  props: ['post']
};
</script>

<style>

</style>
