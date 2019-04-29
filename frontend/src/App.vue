<template>
  <div id="app">
    <div class="container">
      <div class="header"></div>
      <div class="main">
        <router-view/>
      </div>
      <div class="footer"></div>
    </div>
  </div>
</template>

<script>

export default {
};
</script>

<style lang="scss">
.container {
  display: grid;
  grid-template-rows: 100px 2.7fr 100px;
  grid-template-areas: "header header header" ". main ." "footer footer footer";
  align-items: stretch;
}

.header { grid-area: header; }

.main { grid-area: main; }

.footer { grid-area: footer; }

</style>
