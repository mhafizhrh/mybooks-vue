<template>
	<app-layout :title="'Dashboard'">
		<!-- <teleport to="body">Hello World</teleport>
		<modal3 :show="modal31" :closeable="true" :close-button-footer="true" :modal-id="1" :centered="true" @opened="modal31 = false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Modal3 1</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</modal3>
		<modal3 :show="modal32" :closeable="true" :close-button-footer="true" :modal-id="2" :centered="true" @opened="modal32 = false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Modal3 2</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</modal3>
		<button class="btn btn-outline-primary me-2" @click="modal31 = true">Modal31</button>
		<button class="btn btn-outline-primary" @click="modal32 = true">Modal32</button> -->
		<hr>
		<modal4 :show="modal1" @close="modal1 = false"><button class="btn btn-outline-primary me-2" @click="modal2 = true">Modal 2</button></modal4>
		<modal4 :show="modal2" @close="modal2 = false"></modal4>
		<button class="btn btn-outline-primary me-2" @click="modal1 = true">Modal 1</button>
		<button class="btn btn-outline-primary me-2" @click="modal1 = true">Modal 1</button>
		<button class="btn btn-outline-primary me-2" @click="modal2 = true">Modal 2</button>
	</app-layout>
</template>

<script>
	import AppLayout from '@/Layouts/AppLayout'
	import Modal3 from '@/Helpers/Modal3'
	import Modal4 from '@/Helpers/Modal4'
	import { useForm } from '@inertiajs/inertia-vue3'

	export default {
		components: {
			AppLayout,
			Modal3,
			Modal4
		},
		data() {
			return {
				form: useForm({
					nama: null,
					kelas: null
				}),
				modal1: false,
				modal2: false,
				modal31: false,
				modal32: false
			}
		},
		methods: {
			submit() {
				this.form.post(route('api.books.store'))
			}
		},
		props: ['errors']
	}
</script>