<template>
  <show-thread :thread="thread"></show-thread>
</template>

<script>
 import axios from 'axios'

 export default {
   name: 'ShowThreadContainer',
   props: ['thread']
 }
</script>