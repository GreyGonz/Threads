<template>
 <threads-list
   :threads="threads"
   :form="form"
   @create="create"
   @deleteThread="deleteThread">
 </threads-list>
</template>

<script>
 import Form from 'acacha-forms'
 import axios from 'axios'

 export default {
   name: 'ThreadsListContainer',
   data () {
     return {
       threads: [],
       form: new Form({ title: '', description: '', body: '', user_id: '' }),
       user: null
     }
   },
   methods: {
     create: function (form) {
       let url = '/api/threads'
       // POST
       this.form.user_id = this.user.id
       this.form = form
       this.form.post(url).then((response) => {
         // Emmagatzema a fitxer JSO
         this.threads.push({
           title: this.form.title,
           description: this.form.description,
           body: this.form.body,
           user_id: this.form.user_id
         })
         this.form.title = ''
         this.form.description = ''
         this.form.body = ''
       }).catch((error) => {
         console.log(error.message);
       }).then(() => {
         this.fetchThreads()
       });
     },
     getUser: function () {
       axios.get('api/user').then((response) => {
         this.user = response.data
       }).catch((error) => {
         console.log(error.message)
       })
     },
     deleteThread: function (id) {
       axios.delete('api/threads/' + id).then((response) => {
         console.log('thread deleted')
       }).catch((error) => {
         console.log(error.message)
       }).then(() => {
         this.fetchThreads()
       })
     },
     fetchThreads: function () {
       axios.get('api/threads').then((response) => {
         this.threads = response.data
       }).catch((error) => {
         console.log(error)
       })
     }
   },
   mounted () {
     this.fetchThreads()
     this.getUser()
   }
 }
</script>