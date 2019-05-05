<template>
  <b-container>
    <b-row>
      <b-col md="9">
        <Threads />
      </b-col>
      <b-col md="3">

        <SideCard>
          <template v-slot:header>
            Board details
          </template>
          <template v-slot:body>
            <h5>/b/{{ currentBoard.name }}</h5>
            <b-row class="mt-2">
              <b-col class="d-flex flex-column stats">
                <h5>99k</h5>
                <p class="small">Members</p>
              </b-col>
              <b-col class="d-flex flex-column">
                <h5>99k</h5>
                <p class="small">Online</p>
              </b-col>
            </b-row>
              <p class="my-2">{{ currentBoard.description }}</p>
              <b-button size="sm" variant="primary" class="mb-2">JOIN</b-button>
              <b-button size="sm" variant="primary">CREATE POST</b-button>
          </template>
        </SideCard>

        <SideCard>
          <template v-slot:header>
            /b/{{currentBoard.name}} rules
          </template>
          <template v-slot:body>
            <ol>
              <li>Rule 1 - You do not talk about Shelter.</li>
              <li>Rule 2 - <em>You do not talk about Shelter.</em></li>
              <li>Rule 3 - Someone posts "Stop!", goes mad, gets frustrated, the posting is over.</li>
              <li>Rule 4 - Unlimited users to a discussion.</li>
              <li>Rule 5 - One subject at time, fellas.</li>
              <li>Rule 6 - No insult, no swear.</li>
              <li>Rule 7 - Discussions will go on as long as they have to.</li>
              <li>Rule 8 and final rule - If this is your first night at Shelter. you <em>have</em> to create a thread</li>
            </ol>
          </template>
        </SideCard>

      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Threads from '@/components/Threads.vue';
import SideCard from '@/components/layout/SideCard.vue';
import { mapActions, mapGetters } from 'vuex';
export default {
  name: 'board',
  components: {
    Threads,
    SideCard
  },
  methods: {
    ...mapActions(['fetchCurrentBoard'])
  },
  computed: mapGetters(['currentBoard']),
  created() {
    this.fetchCurrentBoard(this.$route.params.board);
  }
};
</script>
