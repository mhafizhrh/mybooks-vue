<template>
	<teleport to="body">
		<transition enter-active-class="fade">
			<div class="modal-backdrop fade show" v-if="display"></div>
		</transition>
		<div class="modal fade" tabindex="-1" :class="{'show d-block': display}">
			<div class="modal-dialog modal-dialog-centered">
				<transition name="fade" enter-active-class="animate__animated animate__fadeInDown animate__faster">
					<div class="modal-content" v-if="display">
						<div class="modal-header">
							<h5 class="modal-title">Modal title</h5>
							<button type="button" class="btn-close" @click="[closeModal, $emit('close')]"></button>
						</div>
						<div class="modal-body">
							<p>Modal body text goes here.</p>
							<slot></slot>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" @click="[closeModal, $emit('close')]">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</transition>
			</div>
		</div>
	</teleport>
</template>

<script>
	export default {
		props: ['show'],
		data() {
			return {
				display: false
			}
		},
		watch: {
			show: function(newVal, oldVal) {
				this.display = newVal
				console.log(`Changed from ${oldVal} to ${newVal}`)
			}
		},
		methods: {
			closeModal() {
				this.display = false
			}
		},
		created() {
			console.log('Modal created.')
		},
		mounted() {
			// document
		}
	}
</script>