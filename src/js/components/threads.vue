<template>
<div>
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Threads</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>id</th>
            <th>title</th>
            <th>description</th>
            <th>body</th>
            <th>actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="thread in threads">
            <th>{{ thread.id }}</th>
            <th>{{ thread.title }}</th>
            <th>{{ thread.description }}</th>
            <th>{{ thread.body }}</th>
            <th>
              <div class="btn-group">
                <button class="btn btn-primary">Show</button>
                <button class="btn btn-danger">Delete</button>
              </div>
            </th>
          </tr>
        </tbody>

      </table>

      <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('title') }">
        <label for="title">Thread title:</label>
        <transition name="fade">
          <span v-text="form.errors.get('title')" v-if="form.errors.has('title')" class="help-block"></span>
        </transition>
        <input @input="form.errors.clear('title')" type="text" name="title" class="form-control" id="title" v-model="form.title" @keydown.enter="create">
      </div>

      <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('description') }">
        <label for="description">Thread description:</label>
        <transition name="fade">
          <span v-text="form.errors.get('description')" v-if="form.errors.has('description')" class="help-block"></span>
        </transition>
        <input @input="form.errors.clear('description')" type="text" name="description" class="form-control" id="description" v-model="form.description" @keydown.enter="create">
      </div>

      <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('body') }">
        <label for="body">Thread body:</label>
        <transition name="fade">
          <span v-text="form.errors.get('body')" v-if="form.errors.has('body')" class="help-block"></span>
        </transition>
        <input @input="form.errors.clear('body')" type="text" name="body" class="form-control" id="body" v-model="form.body" @keydown.enter="create">
      </div>

      <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('user_id') }">
        <label for="user_id">Thread user_id:</label>
        <transition name="fade">
          <span v-text="form.errors.get('user_id')" v-if="form.errors.has('user_id')" class="help-block"></span>
        </transition>
        <input @input="form.errors.clear('user_id')" type="text" name="user_id" class="form-control" id="user_id" v-model="form.user_id" @keydown.enter="create">
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary" @click="create">Submit</button>
    </div>
  </div>
</div>
</template>

<script>
  import { mapGetters } from 'vuex';
  import Form from 'acacha-forms'

  export default {
    name: 'Threads',
    data () {
      return {
        form: new Form({ title: 'pova', description: 'prova', body: 'prova', user_id: '1' }),
        formName: new Form({ name: '' })
      }
    },
    computed: {
      ...mapGetters(['count']),
      threads: {
        get () {
          return this.$store.state.threads
        },
        set (value) {
          this.$store.commit('threads', value)
        }
      }
    },
    methods: {
      create: function (form) {
        let url = '/api/threads'
        // POST
        form.post(url).then((response) => {
          // Emmagatzema a fitxer JSON
          this.threads.push({
            name: form.name,
            description: form.description,
            user_id: form.user_id,
            completed: form.completed
          })
          form.name = ''
          form.description = ''
        }).catch((error) => {
          console.log(error.message);
        });
      }
    },
    mounted () {
      this.$store.dispatch('fetchThreads')
      console.log(this.$store.state.threads)
    }
  }
</script>