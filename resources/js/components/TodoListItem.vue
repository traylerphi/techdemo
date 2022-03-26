<template>
	<div class="card">
		<div class="card-header text-light" :class="item.completion ? 'bg-success' : 'bg-secondary'">
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

			<strong>Due Date:</strong>
			<input v-show="editmode" v-model.lazy="item.due" type="datetime-local"/>
			<span v-show="!editmode">{{ displayDate(item.due) }}</span>

			<br/>

			<div v-if="item.completion">
				<strong>Completed:</strong> {{ displayDate(item.completion) }}
			</div>

			<strong v-if="item.note || editmode">Note:</strong>
			<pre v-show="!editmode">{{ item.note }}</pre>
			<div v-show="editmode">
				<textarea  class="form-control" rows="3" v-model="item.note"></textarea>
			</div>

			<div class="row">
				<div class="col-6">
					<span v-if="item.subtasks.length" class="align-bottom">
						<strong class="float-start">Subtasks ({{ item.subtasks.length }}):</strong>
						<i role="button" alt="Edit" class="bi bi-eye" v-show="!showsubs" @click="showsubs = 1"></i>
						<i role="button" alt="Lock" class="bi bi-eye-slash" v-show="showsubs" @click="showsubs = 0"></i>
					</span>
				</div>
				<div class="col-6 text-end">
					<button v-if="!item.completion" class="btn btn-primary" @click="create">Add Subtask</button>
				</div>
			</div>
			<div v-if="item.subtasks.length">
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
    		displayDate(datestring) {
    			if (!datestring) return '';
    			const datetime = new Date(datestring);
    			var meridian = "AM";
    			var hours = datetime.getHours();
    			if (hours > 12) {
    				hours -= 12;
    				meridian = "PM";
    			}
    			if (hours == 0) {
    				hours = 12;
    				meridian = "AM";
    			}
    			var minutes = datetime.getMinutes();
    			if (minutes < 10) minutes = "0" + minutes;
    			return datetime.toDateString() + " " + hours + ":" + minutes + " " + meridian;
    		},
    		create(event) {
				const newTask = {
					"parent_task_id" : this.item.id,
					"task" : "New Subtask",
					"note" : null,
					"order" : (this.item.subtasks.length + 1),
					"status" : "Incomplete",
					"due" : null,
					"completion" : null,
					"subtasks" : []
				};
				axios
					.post('/api/task', newTask)
					.then(response => this.item.subtasks.push(response.data));
    		},
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
    			this.editmode = 0
			    axios.put('/api/task/'+this.item.id, this.item);
            }
    	}

  	}
</script>
