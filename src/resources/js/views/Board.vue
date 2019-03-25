<template>
    <div>
        <div v-for="thread in threads" :key="thread.num">
            <ThreadPreview :thread="thread" />
        </div>
    </div>
</template>

<script>
import ThreadPreview from '../components/ThreadPreview';
import axios from 'axios';

export default {

    name: 'Board',
    components: {
        ThreadPreview
    },

    data() {
        return {
            threads: []
        }
    },

    created() {
        this.fetchThreads();
    },

    methods: {
        fetchThreads() {
            axios.get('/api/board/' + this.$route.params.name)
                .then(res => this.threads = res.data.data)
                .catch(err => console.log(err));
        },
    }
}
</script>

<style lang="scss">

</style>
