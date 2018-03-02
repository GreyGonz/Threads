<template>
  <div>
    <threads-list-container></threads-list-container>
  </div>
</template>

<script>
  export default {
    name: 'App',
    computed: {
      count: function () {
        return this.$store.state.count
      }
    }
  }
</script>