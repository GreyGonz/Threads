<template>
  <show-thread
    :thread="thread"
    :user="user"
    @updateThread="updateThread"></show-thread>
</template>

<script>
 import axios from 'axios'

 export default {
   name: 'ShowThreadContainer',
   data () {
     return {
       thread: {}
     }
   },
   props: ['thread_id', 'user'],
   methods: {
     fetchThread: function () {
       axios.get('/api/threads/' + this.thread_id).then((response) => {
         this.thread = response.data
       }).catch((error) => {
         console.log(error.message)
       })
     },
     updateThread: function (thread) {
       axios.put('/api/threads/' + thread.id, thread).then((response) => {
         this.reload()
       }).catch((error) => {
         console.log(error.message)
       })
     },
     reload: function () {
        axios.get('/api/threads/' + this.thread_id).then((response) => {
          this.thread = response.data
        }).catch((error) => {
          console.log(error.message)
        })
     }
   },
   mounted () {
     console.log('Hello ' + this.thread_id)
     this.fetchThread()
   }
 }
</script>