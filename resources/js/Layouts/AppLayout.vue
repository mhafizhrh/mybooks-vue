<template>
	<nav class="navbar navbar-expand-sm navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <inertia-link :href="route('/')" class="navbar-brand">MyBooks-Vue</inertia-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <inertia-link :href="route('dashboard')" class="nav-link" :class="{active: route().current('dashboard')}">Dashboard</inertia-link>
                    <inertia-link :href="route('books.index')" class="nav-link" :class="{active: route().current('books.index')}">Data Buku</inertia-link>
                </div>
            </div>
        </div>
    </nav>
	<div class="container mt-3">
        <transition enter-active-class="animate__animated animate__tada" leave-active-class="animate__animated animate__zoomOutLeft">
            <h1 v-if="hello">Hello World</h1>
        </transition>
        <button class="btn btn-outline-success mb-3" @click="hello = !hello">Hello</button>
        <div v-cloak>
		  <slot></slot>
        </div>
	</div>
</template>

<script>
	export default {
		props: ['title'],
        data() {
            return {
                head: {
                	title: process.env.VUE_APP_NAME
                },
                mounting: true,
                hello: false
            }
        },
       	created(props) {
       		document.title = this.$props.title == undefined ? 'MyBooks' : 'MyBooks - ' + this.$props.title
       	}
    }
</script>