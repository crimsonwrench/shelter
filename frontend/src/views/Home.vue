<template>
  <b-container>
    <b-row>
      <b-col md="8">
        <Boards />
      </b-col>
      <b-col md="4">
        <SideCard>
          <template v-slot:header>Info</template>
          <template v-slot:body>
            <h4>Welcome to the Shelter!</h4>
            <p>Here you will find a list of all available boards.</p>
            <p>Feel free to pick a board and create some posts inside!</p>
            <p align="right"><em>--crimsonwrench</em></p>
          </template>
        </SideCard>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Boards from '@/components/Boards.vue';
import SideCard from '@/components/layout/SideCard.vue';

export default {
  name: 'home',
  components: {
    Boards,
    SideCard
  }
};
</script>
