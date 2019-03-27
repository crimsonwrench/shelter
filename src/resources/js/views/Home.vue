<template>
<div id="board-container">
    <ul>
        <li v-for="board in allBoards" :key="board.id">
            <router-link :to="{name: 'board', params: {name: board.name_short}}" :href="'/'+board.name_short">{{board.name}}</router-link>
        </li>
    </ul>
</div>   
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {

    name: 'Home',
    methods: {
        ...mapActions(['fetchBoards'])
    },
    computed: mapGetters(['allBoards']),
    created() {
        this.fetchBoards();
    },
}
</script>
