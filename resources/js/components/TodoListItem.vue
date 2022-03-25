<template>
	<div class="card">
		<div class="card-header" :class="item.completion ? 'bg-success' : ''">
			<input v-show="editmode" v-model.lazy="item.task" class="col-md-10"/>
			<strong v-show="!editmode">{{ item.task }}</strong>

			<div v-if="!item.completion" class="col-md-1 float-end text-right">
				<i role="button" alt="Edit" class="bi bi-lock" v-show="!editmode" @click="editmode = 1"></i>
				<i role="button" alt="Lock" class="bi bi-unlock-fill" v-show="editmode" @click="save"></i>
			</div>
		</div>
		<div class="card-body">

			<button v-show="!item.completion" class="float-end btn btn-success" @click="complete">Mark Complete</button>
			<button v-show="item.completion" class="float-end btn btn-secondary" @click="reopen">Re-Open Task</button>

			<strong>Due Date:</strong> {{ item.due }}<br/>

			<div v-if="item.completion">
				<strong>Completed:</strong> {{ item.completion }}
			</div>

			<strong>Note:</strong>
			{{ item.note }}
			<br/>

			<div v-if="item.subtasks.length">
				<strong>Subtasks ({{ item.subtasks.length }}):</strong>
				<i role="button" alt="Edit" class="bi bi-eye" v-show="!showsubs" @click="showsubs = 1"></i>
				<i role="button" alt="Lock" class="bi bi-eye-slash" v-show="showsubs" @click="showsubs = 0"></i>
				<todo-list-item
					v-show="showsubs"
					v-for="task in item.subtasks"
					:key="task.id"
					:item="task">
				</todo-list-item>
			</div>
		</div>
	</div>
</template>

<script>
    export default {

    	props: ['item'],
	  	data () {
		    return {
		      editmode: 0,
		      showsubs: 0
		    }
	  	},
    	methods: {
    		complete(event) {
    			// Build now timestamp
                const today = new Date();
                const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                const dateTime = date +' '+ time;

                // Update item
    			this.item.status = "Complete";
    			this.item.completion = dateTime;
    			this.showsubs = 0;
    			this.save(event);
            },
            reopen(event) {

                // Update item
    			this.item.status = "Incomplete";
    			this.item.completion = null;
    			this.showsubs = 1;
    			this.save(event);
            },
            save(event) {
    			this.editmode = 0;

			    axios.put('/api/task/'+this.item.id, this.item);
            }
    	}

  	}
</script>
