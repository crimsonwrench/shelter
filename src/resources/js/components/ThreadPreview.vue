<template>
    <div>
        <h1>{{ thread.title }}</h1>
        <p>{{ thread.text }}</p>
        <div v-for="post in thread.posts" :key="post.num">
            <Post :post="post"/>
        </div>
    </div>
</template>

<script>
import Post from './Post';

export default {
    name: 'ThreadPreview',
    props: ['thread'],
    components: { Post }
}
</script>
