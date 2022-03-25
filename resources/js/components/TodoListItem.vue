<template>
	<span>
		{{ item }}
	</span>
</template>

<script>
    export default {

       props: {
           item: {
               type: Object,
               default: () => ({}),
           }
       }
  }
</script>
