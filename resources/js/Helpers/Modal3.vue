<template>
	<teleport to="body">
		<div class="modal fade" tabindex="-1" :id="modalId">
			<slot>
			<div class="modal-dialog" :class="{'modal-dialog-scrollable': scrollable, 'modal-dialog-centered': centered}">
				<div class="modal-content">
					<div class="modal-header" v-if="hasSlot('header') || (closeable && closeButtonHeader)">
						<slot name="header"></slot>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" v-if="closeable && closeButtonHeader"></button>
					</div>
					<div class="modal-body" v-if="hasSlot('body')">
						<slot name="body"></slot>
					</div>
					<div class="modal-footer" v-if="hasSlot('footer') || (closeable && closeButtonFooter)">
						<slot name="footer"></slot>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-if="closeable && closeButtonFooter">Close</button>
					</div>
				</div>
			</div>
			</slot>
		</div>
	</teleport>
	<!-- <button type="button" class="btn btn-outline-primary" @click="openModal">My Modal</button> -->
</template>

<script>
	export default {
		props: {
			show: {
				default: false
			},
			modalId: {
				default: null
			},
			closeable: {
				default: true
			},
			closeButtonHeader: {
				default: true
			},
			closeButtonFooter: {
				default: false
			},
			scrollable: false,
			centered: false
		},
		data() {
			return {
				
			}
		},
		methods: {
			hasSlot(slot) {
				return !!this.$slots[slot]
			},
			modal(options = {}) {
				return new bootstrap.Modal(document.getElementById(this.modalId), options)
			},
			openModal() {
				this.modal({
					backdrop: this.closeable ? true : 'static',
					keyboard: this.closeable
				}).show()
			},
		},
		watch: {
			show: function(newVal, oldVal) {
				if (newVal == true) {
					this.openModal()
					this.$emit('opened')
				}
			}
		},
		created() {
			console.log(this.$props)
		}
	}
</script>