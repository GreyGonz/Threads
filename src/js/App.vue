<template>
  <div>
    <threads-container></threads-container>
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