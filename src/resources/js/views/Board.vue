<template>
    <div>
        <div v-for="thread in allThreads" :key="thread.num">
            <ThreadPreview :thread="thread" />
        </div>
    </div>
</template>

<script>
import ThreadPreview from '../components/ThreadPreview';
import { mapGetters, mapActions } from 'vuex';

export default {

    name: 'Board',
    props: ['name'],
    components: {
        ThreadPreview
    },
    methods: {
        ...mapActions(['fetchThreads'])
    },
    computed: mapGetters(['allThreads']),
    created() {
        this.fetchThreads(this.name);
    },
}
</script>

<style lang="scss">

</style>
