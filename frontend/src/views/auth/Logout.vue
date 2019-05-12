<script>
export default {
  name: 'Logout',
  created() {
    this.$store.dispatch('destroyToken');
    this.$store.dispatch('destroyUser')
      .then(response => {
        this.$router.push({ name: 'home' });
      });
  }
};
</script>
