<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Todo List</div>
					<div class="card-body">
						<li v-for="task in tasks">
							<todo-list-item :item="task" />
						</li>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	Vue.component('todo-list-item', require('./TodoListItem.vue').default);
    export default {
	  	data () {
		    return {
		      tasks: null
		    }
	  	},
		mounted () {
		    axios
		      .get('/api/task')
		      .then(response => (this.tasks = response.data))
	  	}
	}
</script>
