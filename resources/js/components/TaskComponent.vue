<template>
  <div>
    <button @click="loadCreateModal" class="btn btn-primary btn-block">Add New Task</button>
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Title</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(task, index) in tasks" :key="task.id">
          <td>{{index+1}}</td>
          <td>{{task.title}}</td>
          <td>{{task.Description}}</td>
          <td>
            <button
              @click="loadUpdateModal(index)"
              type="button"
              class="btn btn-primary btn-sm"
            >Edit</button>
            <button @click="deleteTask(index)" type="button" class="btn btn-danger btn-sm">Delete</button>
            <button-component name="Delete" class="btn btn-danger btn-sm"></button-component>
          </td>
        </tr>
      </tbody>
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

    <div
      class="modal fade"
      id="update-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Task</h5>
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
              <input
                v-model="new_update_task.title"
                type="text"
                name="title"
                id="title"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input
                v-model="new_update_task.Description"
                type="text"
                name="description"
                id="description"
                class="form-control"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="updateTask" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ButtonComponent from "./ButtonComponent";

export default {
  data() {
    return {
      tasks: [],
      task: {
        title: "",
        description: ""
      },
      errors: [],
      new_update_task: [],
      toastr: (toastr.options = { positionClass: "toast-top-full-width" })
    };
  },
  components: {
    ButtonComponent
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
    loadUpdateModal(index) {
      this.errors = [];
      $("#update-modal").modal("show");
      this.new_update_task.title = this.tasks[index].title;
      this.new_update_task.Description = this.tasks[index].Description;
      this.new_update_task.id = this.tasks[index].id;
      this.new_update_task.index = index;
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
          this.errors = [];
          this.task.title = "";
          this.task.description = "";
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
    },
    updateTask() {
      axios
        .patch("/vue/" + this.new_update_task.id, {
          title: this.new_update_task.title,
          Description: this.new_update_task.Description
        })
        .then(response => {
          $("#update-modal").modal("hide");
          // alert(response.data.message);
          // this.loadTasks();
          this.tasks[
            this.new_update_task.index
          ].title = this.new_update_task.title;
          this.tasks[
            this.new_update_task.index
          ].Description = this.new_update_task.Description;
          toastr.success(response.data.message);
        });
    },
    deleteTask(index) {
      let confirmBox = confirm("Are you sure you want to delete this.");

      if (confirmBox == true) {
        axios
          .delete("/vue/" + this.tasks[index].id)
          .then(response => {
            this.$delete(this.tasks, index);
            toastr.success(response.data.message);
          })
          .catch(error => {
            console.log("Could not delete for some reason");
          });
      }
    }
  },
  mounted() {
    this.loadTasks();
  }
};
</script>

<style>
</style>
