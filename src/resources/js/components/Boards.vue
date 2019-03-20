<template>
    <div id="board-container">
        <ul>
            <li v-for="board in boards" v-bind:key="board.id">
                <a v-bind:href="'/'+board.name_short" v-show="loaded">{{board.name}}</a>
            </li>
        </ul>
    </div>    
</template>

<script>
    export default {
        data() {
            return {
                loaded: false,
                boards: [],
                board: {
                    id: '',
                    name_short: '',
                    name: ''
                },

            }
        },

        created() {
            this.fetchBoards();
            this.loaded = true;
        },

        methods: {
            fetchBoards() {
                fetch('api/boards')
                  .then(res => res.json())
                  .then(res => {
                      this.boards = res.data;
                  })
            },
        }
    }
</script>
