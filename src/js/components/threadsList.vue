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
            <th>actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="thread in threads">
            <th>{{ thread.id }}</th>
            <th>{{ thread.title }}</th>
            <th>{{ thread.description }}</th>
            <th>
              <div class="btn-group">
                <button class="btn btn-primary" @click="window.location.href = '/threads/' + threads.id">Show</button>
                <button class="btn btn-danger" @click="sendEmit('deleteThread', thread.id)">Delete</button>
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
        <input @input="form.errors.clear('title')" type="text" name="title" class="form-control" id="title" v-model="form.title" @keydown.enter="sendEmit('create', form)">
      </div>

      <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('description') }">
        <label for="description">Thread description:</label>
        <transition name="fade">
          <span v-text="form.errors.get('description')" v-if="form.errors.has('description')" class="help-block"></span>
        </transition>
        <input @input="form.errors.clear('description')" type="text" name="description" class="form-control" id="description" v-model="form.description" @keydown.enter="sendEmit('create', form)">
      </div>

      <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('body') }">
        <label for="body">Thread body:</label>
        <transition name="fade">
          <span v-text="form.errors.get('body')" v-if="form.errors.has('body')" class="help-block"></span>
        </transition>
        <input @input="form.errors.clear('body')" type="text" name="body" class="form-control" id="body" v-model="form.body" @keydown.enter="sendEmit('create', form)">
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary" @click="sendEmit('create', form)">Submit</button>
    </div>
  </div>
</div>
</template>

<script>

  export default {
    name: 'ThreadsList',
    props: ['threads', 'form'],
    methods: {
      sendEmit: function (name, message) {
        this.$emit(name, message)
      },
    }
  }
</script>