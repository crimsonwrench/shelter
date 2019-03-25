<template>
    <div>
        <h1>{{ thread.title }}</h1>
        <h3>{{ thread.text }}</h3>
        <div v-for="post in thread.posts" :key="post.num">
            <Post :post="post" />
        </div>
    </div>
</template>

<script>
import Post from '../components/Post';
import axios from 'axios';

export default {

    name: 'Thread',
    components: {
        Post,
    },

    data() {
        return {
            thread: [],
        }
    },

    created() {
        this.fetchPosts();
    },

    methods: {
        fetchPosts() {
            axios.get('/api/board/' + this.$route.params.name + '/thread/' + this.$route.params.num)
                .then(res => this.thread = res.data.data)
                .catch(err => console.log(err));
        },
    }
}
</script>
