<template>
	<teleport to="body">
		<div class="modal-backdrop fade" :class="{show: display}"></div>
		<div class="modal fade" :class="{'d-block': display, show: display}" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">
							<slot name="title"></slot>
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="[display = false, $emit('close')]"></button>
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
	</teleport>
</template>

<script>
	export default {
		props: {
			display: false
		},
		emits: ['close']
	}
</script>