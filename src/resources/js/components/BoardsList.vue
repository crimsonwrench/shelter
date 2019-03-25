<template>
    <div id="board-container">
        <ul>
            <li v-for="board in boards" :key="board.id">
                <router-link :to="{name: 'board', params: {name: board.name_short}}" :href="'/'+board.name_short">{{board.name}}</router-link>
            </li>
        </ul>
    </div>    
</template>
<script>
export default {
    name: 'BoardsList',
    props: ["boards"]
}
</script>

