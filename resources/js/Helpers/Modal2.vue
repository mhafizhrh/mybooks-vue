<template>
	<teleport to="body">
		<div class="modal-backdrop fade show" v-if="display"></div>
		<transition enter-active-class="animate__animated animate__fadeIn animate__fadeInDown animate__fast" leave-active-class="animate__animated animate__fadeOut animate__fadeOutUp animate__fast">
				<div class="modal d-block" tabindex="-1" v-if="display">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">
									<slot name="title"></slot>
								</h5>
								<button type="button" class="btn-close" @click="[display = false, $emit('close')]"></button>
							</div>
							<div class="modal-body">
								<slot name="body"></slot>
							</div>
							<div class="modal-footer">
								<slot name="footer"></slot>
							</div>
						</div>
					</div>
				</div>
		</transition>
	</teleport>
	<button @click="[display = true, $emit('clicked')]" v-text="callerText" :class="callerClass" v-if="callerElement == 'button'"></button>
	<a href="#" @click="[display = true, $emit('clicked')]" v-html="callerText" :class="callerClass" v-if="callerElement == 'a'"></a>
</template>
<style scoped>
	.animate__faster {
		--animate-duration: 0.3s;
	}
</style>
<script>
	import { onMounted, onUnmounted } from 'vue';

	export default {
		props: ['callerElement', 'callerText', 'callerClass'],
		data() {
			return {
				display: false
			}
		}
	}
</script>