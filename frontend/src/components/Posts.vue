<template>
  <div>
    <PostCard v-for="post in allPosts" :key="post.id" :post="post"/>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import PostCard from '@/components/layout/PostCard.vue';
export default {
  name: 'posts',
  components: {
    PostCard
  },
  methods: {
    ...mapActions(['fetchPosts'])
  },
  computed: mapGetters(['allPosts']),
  created() {
    this.fetchPosts({ board: this.$route.params.board, thread: this.$route.params.thread });
  }
};
</script>

<style lang="scss">

</style>
