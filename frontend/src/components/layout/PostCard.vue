<template>
  <div class="main-item">
    <div class="main-header">
      <h4>{{ post.title }}</h4>
    </div>
    <div class="main-body">
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
