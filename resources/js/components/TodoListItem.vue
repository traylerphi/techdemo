<template>
	<span>
		<strong>{{ item.task }}</strong>
		<ul>
			<li v-for="task in item.subtasks">
				<todo-list-item :item="task" />
			</li>
		</ul>
	</span>
</template>

<script>
    export default {

    	props: ['item']

  	}
</script>
