<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header text-center">
						<strong>Todo List - {{ displaydate }}</strong>
					</div>
					<div class="card-body">
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
	  	}
	}
</script>
