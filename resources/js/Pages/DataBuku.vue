<template>
	<div>
	<app-layout :title="'Data Buku'">
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary mb-2 me-2" @click.prevent="books = {}">Kosongkan</button>
				<button class="btn btn-primary mb-2" @click.prevent="[modalOpen = true]">Tambah Buku</button>
				<transition class="fade" :duration="2000">
				<modal v-if="modalOpen" :display="modalOpen" @close="modalOpen = false">
					<template #title>Tambah Buku</template>
					<template #body>
						<div class="row">
							<div class="col-md-12 mb-3">
								<label :class="{'text-danger': errors.judul}">Judul</label>
								<input type="text" class="form-control" v-model="form.judul" :class="{'border-danger': errors.judul}">
								<small class="text-danger" v-text="errors.judul" v-if="errors.judul"></small>
							</div>
							<div class="col-md-12 mb-3">
								<label :class="{'text-danger': errors.pengarang}">Pengarang</label>
								<input type="text" class="form-control" v-model="form.pengarang" :class="{'border-danger': errors.pengarang}">
								<small class="text-danger" v-text="errors.pengarang" v-if="errors.pengarang"></small>
							</div>
							<div class="col-md-12 mb-3">
								<label :class="{'text-danger': errors.penerbit}">Penerbit</label>
								<input type="text" class="form-control" v-model="form.penerbit" :class="{'border-danger': errors.penerbit}">
								<small class="text-danger" v-text="errors.penerbit" v-if="errors.penerbit"></small>
							</div>
							<div class="col-md-12 mb-3">
								<label :class="{'text-danger': errors.tahun_terbit}">Tahun Terbit</label>
								<input type="text" class="form-control" v-model="form.tahun_terbit" :class="{'border-danger': errors.tahun_terbit}">
								<small class="text-danger" v-text="errors.tahun_terbit" v-if="errors.tahun_terbit"></small>
							</div>
							<div class="col-md-12 mb-3">
								<label :class="{'text-danger': errors.no_isbn}">No. ISBN</label>
								<input type="text" class="form-control" v-model="form.no_isbn" :class="{'border-danger': errors.no_isbn}">
								<small class="text-danger" v-text="errors.no_isbn" v-if="errors.no_isbn"></small>
							</div>
							<div class="col-md-12 mb-3">
								<label :class="{'text-danger': errors.jumlah_buku}">Jumlah Buku</label>
								<input type="text" class="form-control" v-model="form.jumlah_buku" :class="{'border-danger': errors.jumlah_buku}">
								<small class="text-danger" v-text="errors.jumlah_buku" v-if="errors.jumlah_buku"></small>
							</div>
						</div>
					</template>
					<template #footer>
						<button class="btn btn-success float-end" @click="store">Tambah</button>
					</template>
				</modal>
			</transition>
			</div>
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Judul</th>
								<th>Pengarang</th>
								<th>Penerbit</th>
								<th>Tahun Terbit</th>
								<th>No. ISBN</th>
								<th>Jumlah Buku</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody> 
							<tr v-if="tableLoader">
								<td colspan="7" class="text-center" style="width: 4rem; height: 4rem;">
									<div class="spinner-grow" role="status">
									  <span class="visually-hidden">Loading...</span>
									</div>
								</td>
							</tr>
							<tr v-if="tableError">
								<td colspan="7" class="text-center bg-danger">
									Error!
								</td>
							</tr>
							<tr v-if="books.data < 1">
								<td colspan="7" class="text-center">
									Tidak ada data pada halaman ini.
								</td>
							</tr>
							<tr v-for="book in books.data">
								<td v-text="book.judul"></td>
								<td v-text="book.pengarang"></td>
								<td v-text="book.penerbit"></td>
								<td v-text="book.tahun_terbit"></td>
								<td v-text="book.no_isbn"></td>
								<td v-text="book.jumlah_buku"></td>
								<td>
									<modal2 :caller-element="'a'" :caller-text="`<i class='bi bi-pencil-square'></i> Ubah`" :caller-class="'text-decoration-none me-3'" @clicked="updateForm(book)">
										<template #title>
											Ubah Data
										</template>
										<template #body>
											<div class="row">
												<div class="col-md-12 mb-3">
													<label :class="{'text-danger': errors.judul}">Judul</label>
													<input type="text" class="form-control" v-model="formEdit.judul" :class="{'border-danger': errors.judul}">
													<small class="text-danger" v-text="errors.judul" v-if="errors.judul"></small>
												</div>
												<div class="col-md-12 mb-3">
													<label :class="{'text-danger': errors.pengarang}">Pengarang</label>
													<input type="text" class="form-control" v-model="formEdit.pengarang" :class="{'border-danger': errors.pengarang}">
													<small class="text-danger" v-text="errors.pengarang" v-if="errors.pengarang"></small>
												</div>
												<div class="col-md-12 mb-3">
													<label :class="{'text-danger': errors.penerbit}">Penerbit</label>
													<input type="text" class="form-control" v-model="formEdit.penerbit" :class="{'border-danger': errors.penerbit}">
													<small class="text-danger" v-text="errors.penerbit" v-if="errors.penerbit"></small>
												</div>
												<div class="col-md-12 mb-3">
													<label :class="{'text-danger': errors.tahun_terbit}">Tahun Terbit</label>
													<input type="text" class="form-control" v-model="formEdit.tahun_terbit" :class="{'border-danger': errors.tahun_terbit}">
													<small class="text-danger" v-text="errors.tahun_terbit" v-if="errors.tahun_terbit"></small>
												</div>
												<div class="col-md-12 mb-3">
													<label :class="{'text-danger': errors.no_isbn}">No. ISBN</label>
													<input type="text" class="form-control" v-model="formEdit.no_isbn" :class="{'border-danger': errors.no_isbn}">
													<small class="text-danger" v-text="errors.no_isbn" v-if="errors.no_isbn"></small>
												</div>
												<div class="col-md-12 mb-3">
													<label :class="{'text-danger': errors.jumlah_buku}">Jumlah Buku</label>
													<input type="text" class="form-control" v-model="formEdit.jumlah_buku" :class="{'border-danger': errors.jumlah_buku}">
													<small class="text-danger" v-text="errors.jumlah_buku" v-if="errors.jumlah_buku"></small>
												</div>
											</div>
										</template>
										<template #footer>
											<button class="btn btn-success" @click="update">Simpan</button>
										</template>
									</modal2>
									<a href="#" class="text-decoration-none" @click.prevent="destroy(book.id)"><i class="bi bi-trash"></i> Hapus</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-12">
				<ul class="pagination">
					<li class="page-item" v-for="link in books.links" :class="{active: link.active, disabled: link.url == null}">
						<inertia-link
						class="page-link"
						v-html="link.label"
						:href="paginationPage(link.url)">
						</inertia-link>
					</li>
				</ul>
			</div>
		</div>
	</app-layout>
	</div>
</template>

<style scoped>
    .fade-enter-active,
    .fade-leave-active {
      transition: opacity .3s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
      opacity: 0;
    }
</style>

<script>
	import { Inertia } from '@inertiajs/inertia'
	import { reactive } from 'vue'
	import { useForm } from '@inertiajs/inertia-vue3'

	import AppLayout from '@/Layouts/AppLayout'
	import Modal from '@/Helpers/Modal'
	import Modal2 from '@/Helpers/Modal2'
	import Modal3 from '@/Helpers/Modal3'

	export default {
		data() {
			return {
				modalOpen: false,
				form: useForm({
					id: null,
					judul: null,
					pengarang: null,
					penerbit: null,
					tahun_terbit: null,
					no_isbn: null,
					jumlah_buku: null
				}),
				formEdit: useForm({
					id: null,
					judul: null,
					pengarang: null,
					penerbit: null,
					tahun_terbit: null,
					no_isbn: null,
					jumlah_buku: null
				}),
				books: reactive({}),
				tableLoader: false,
				tableError: false
			}
		},
		props: {
			errors: null
		},
		methods: {
			paginationPage(url) {
				if (url != null) {
					const path = window.location.protocol + '//' + window.location.host + window.location.pathname
					const params = url.substr(url.indexOf('?'))
					return path + params
				}
			},
			async loadBooks() {
				let page = 1
				const params = window.location.search
				const searchParams = new URLSearchParams(params)
				if (searchParams.get('page') == null || isNaN(searchParams.get('page'))) {
					page = 1
				} else {
					page = searchParams.get('page')
				}
				this.tableLoader = true
				await axios.get(route('api.books') + '?page=' + page)
				.then(res => {
					this.books = res.data
				})
				.catch(error => {
					this.tableLoader = false
					this.tableError = true
				})
				.finally(() => {
					this.tableLoader = false
				})
			},
			store() {
				this.form.post(route('api.books.store'), {
					onBefore: () => {
						Swal.fire({
							title: 'Loading',
							html: `<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"  style="width: 5rem; height: 5rem;"><span class="visually-hidden">Loading...</span></div></div>`,
							showConfirmButton: false,
							showCancelButton: false,
							showCloseButton: false
						})
					},
					onSuccess: () => {
						Swal.fire('Berhasil', 'Buku baru telah ditambahkan.', 'success')
						this.form.reset()
						this.modalOpen = false
					},
					onError: () => {
						Swal.fire('Gagal', 'Lengkapi semua form!', 'error')
					}
				})
			},
			destroy(id) {
				Swal.fire({
					title: 'Hapus data?',
					text: 'Data yang dihapus tidak dapat dikembalikan lagi!',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Hapus',
					cancelButtonText: 'Batal'
				}).then((result) => {
					if (result.isConfirmed) {
						this.form.id = id
						this.form.delete(route('api.books.destroy'), {
							onBefore: () => {
								Swal.fire({
									title: 'Loading',
									html: `<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"  style="width: 5rem; height: 5rem;"><span class="visually-hidden">Loading...</span></div></div>`,
									showConfirmButton: false,
									showCancelButton: false,
									showCloseButton: false
								})
							},
							onSuccess: () => {
								Swal.fire('Berhasil', 'Buku telah dihapus.', 'success')
							}
						})
					}
				})
			},
			update() {
				this.formEdit.put(route('api.books.update'), {
					onBefore: () => {
						Swal.fire({
							title: 'Loading',
							html: `<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"  style="width: 5rem; height: 5rem;"><span class="visually-hidden">Loading...</span></div></div>`,
							showConfirmButton: false,
							showCancelButton: false,
							showCloseButton: false
						})
					},
					onSuccess: () => {
						Swal.fire('Berhasil', 'Data buku telah diubah.', 'success')
					},
					onError: () => {
						Swal.fire('Gagal', 'Lengkapi semua form!', 'error')
					}
				})
			},
			updateForm(data) {
				console.log('updateForm triggered')
				this.formEdit.id = data.id
				this.formEdit.judul = data.judul
				this.formEdit.pengarang = data.pengarang
				this.formEdit.penerbit = data.penerbit
				this.formEdit.tahun_terbit = data.tahun_terbit
				this.formEdit.no_isbn = data.no_isbn
				this.formEdit.jumlah_buku = data.jumlah_buku
			}
		},
		created() {
			this.loadBooks()
		},
		updated() {
			console.log('Something updated')
			this.loadBooks()
			console.log(this.books)
		},
		components: {
			AppLayout,
			Modal,
			Modal2,
			Modal3
		}
	}
</script>