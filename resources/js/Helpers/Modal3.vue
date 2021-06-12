<template>
	<teleport to="body">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="target">
		  Launch demo modal
		</button>

		<!-- Modal -->
		<div class="modal fade" :id="modalKey" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        <div v-text="target"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
	</teleport>
</template>

<script>
	export default {
		props: ['modalKey'],
		data() {
			return {
				target: String
			}
		},
		mounted() {
			this.target = CSS.escape('#' + this.$props.modalKey)
		}
	}
</script>