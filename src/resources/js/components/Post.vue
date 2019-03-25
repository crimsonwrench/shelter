<template>
    <div class="post">
        <h4>{{ post.title }}</h4>
        <p>{{ post.text }}</p>
    </div>
</template>
<script>
export default {
    name: 'Post',
    props: ['post']
}
</script>
