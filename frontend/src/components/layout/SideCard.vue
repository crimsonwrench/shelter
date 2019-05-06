<template>
  <div class="side-item">
     <div class="side-item-header">
       <slot name="header"></slot>
     </div>
     <div class="side-item-body">
       <slot name="body"></slot>
     </div>
  </div>
</template>

<script>
export default {
  name: 'SideCard'
};
</script>

<style>

</style>
