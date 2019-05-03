<template>
  <b-container>
    <b-row>
      <b-col md="8">
        <Threads />
      </b-col>
      <b-col md="4">
        <div class="side-item">
          <div class="side-item-header">BOARD DETAILS</div>
          <div class="side-item-body">
            <p>/b/{{ currentBoard.name }}</p>
            <b-row class="mt-2">
              <b-col style="border-right: 1px solid #ccc">
                <p class="mb-0">99k</p>
                <p style="font-size: 0.75rem">Members</p>
              </b-col>
              <b-col>
                <p class="mb-0">9k</p>
                <p style="font-size: 0.75rem">Online</p>
              </b-col>
            </b-row>
            <p>{{ currentBoard.description }}</p>
            <b-button size="sm" variant="primary" style="width: 100%" class="mb-2">JOIN</b-button>
            <b-button size="sm" variant="primary" style="width: 100%">CREATE POST</b-button>
          </div>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Threads from '@/components/Threads.vue';
import { mapActions, mapGetters } from 'vuex';
export default {
  name: 'board',
  components: {
    Threads
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
