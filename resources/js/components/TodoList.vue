<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card">
					<div class="card-header text-center">
						<strong>ToDo List - {{ displaydate }}</strong>
					</div>
					<div class="card-body">
						<div class="text-end">
							<button class="btn btn-primary" @click="create">Add Task</button>
						</div>
						<todo-list-item
							v-for="task in tasks"
							:key="task.id"
							:item="task">
						</todo-list-item>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	Vue.component('todo-list-item', require('./TodoListItem.vue').default);
    export default {
    	props: ['displaydate'],
	  	data () {
		    return {
		      tasks: null
		    }
	  	},
		mounted () {
		    axios
		      .get('/api/task')
		      .then(response => (this.tasks = response.data))
	  	},
    	methods: {
			create(event) {
				const newTask = {
					"parent_task_id" : null,
					"task" : "New Task",
					"note" : null,
					"order" : (this.tasks.length + 1),
					"status" : "Incomplete",
					"due" : null,
					"completion" : null,
					"subtasks" : []
				};
				axios
					.post('/api/task', newTask)
					.then(response => this.tasks.unshift(response.data));
			}
		}
	}
</script>
