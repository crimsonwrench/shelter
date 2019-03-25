<template>
    <div>
        <BoardsList v-bind:boards="boards" />
    </div>
</template>

<script>
import BoardsList from '../components/BoardsList';
import axios from 'axios';

export default {

    name: 'Home',
    components: {
        BoardsList,
    },

    data() {
        return {
            boards: [],
        }
    },

    created() {
        this.fetchBoards();
    },

    methods: {
        fetchBoards() {
            axios.get('/api/boards')
                .then(res => this.boards = res.data.data)
                .catch(err => console.log(err));
        },
    }
}
</script>
