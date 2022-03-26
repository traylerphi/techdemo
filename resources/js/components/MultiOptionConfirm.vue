<template>
    <popup-modal ref="popup">
        <h2 style="margin-top: 0">{{ title }}</h2>
        <p>{{ message }}</p>
        <div class="btn-group text-center">
        	<span v-for="(callback, text) in buttons">
        		&nbsp;
        		<button class="btn btn-secondary" @click="choose">{{ text }}</button>
        		&nbsp;
        	</span>
        </div>
    </popup-modal>
</template>

<script>
import PopupModal from './PopupModal.vue'

export default {
    name: 'MultiOptionConfirm',

    components: { PopupModal },

    data: () => ({
        title: undefined,
        message: undefined,
        buttons: undefined,
    }),

    methods: {
        show(opts = {}) {
            this.title = opts.title;
            this.message = opts.message;
            this.buttons = opts.buttons;
            this.$refs.popup.open()
        },

        choose(event) {
        	console.log(event.target.textContent);
            this.$refs.popup.close()
            this.buttons[event.target.textContent]();
        },

    },
}
</script>
