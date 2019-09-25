<template>
  <div>
    <button @click="loadCreateModal" class="btn btn-primary btn-block">Add New Task</button>
    <table class="table">
      <tr>
        <td>No.</td>
        <td>Title</td>
        <td>Description</td>
        <td>Action</td>
      </tr>
      <tr v-for="(task, index) in tasks" :key="task.id">
        <td>{{index+1}}</td>
        <td>{{task.title}}</td>
        <td>{{task.Description}}</td>
        <td></td>
      </tr>
    </table>

    <!-- Create Modal -->
    <div
      class="modal fade"
      id="create-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create New Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Title = {{task.title}} -->
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors" :key="error">{{error}}</li>
              </ul>
            </div>
            <div class="form-group">
              <label for="title">Title</label>
              <input v-model="task.title" type="text" name="title" id="title" class="form-control" />
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input
                v-model="task.description"
                type="text"
                name="description"
                id="description"
                class="form-control"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="createTask" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tasks: [],
      task: {
        title: "",
        description: ""
      },
      errors: []
    };
  },
  methods: {
    loadTasks() {
      axios.get("api/vue/getdata").then(response => {
        this.tasks = response.data.tasks;
      });
    },
    loadCreateModal() {
      $("#create-modal").modal("show");
    },
    createTask() {
      axios
        .post("/vue", {
          title: this.task.title,
          description: this.task.description
        })
        .then(response => {
          // console.log(response.data);
          this.tasks.push(response.data.task);
          $("#create-modal").modal("hide");
          this.rrors = [];
          this.task.title = '';
          this.task.description = '';
        })
        .catch(error => {
            this.errors = [];
          if (error.response.data.errors.title) {
            this.errors.push(error.response.data.errors.title[0]);
          }

          if (error.response.data.errors.description) {
            this.errors.push(error.response.data.errors.description[0]);
          }
        });
    }
  },
  mounted() {
    this.loadTasks();
  }
};
</script>

<style>
</style>
