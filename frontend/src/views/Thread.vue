<template>
  <b-container>
    <b-row>
      <b-col md="10">
        <Posts />
      </b-col>
      <b-col md="2">
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Posts from '@/components/Posts.vue';
export default {
  name: 'thread',
  components: {
    Posts
  }
};
</script>
