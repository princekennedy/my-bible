<template>

    <div class="max-w-md mx-auto mt-4 bg-white shadow-xl rounded my-8">
        <form method="POST" @submit.prevent="login">
            <div class="text-center text-gray-600 py-4"><b>Sign in with</b></div>
            <!--
            <div class="flex justify-center mb-10">
                <button class="flex items-center bg-gray-100 shadow-md border border-gray-200 rounded px-4 py-2 mr-2">
                <svg class="fill-current text-gray-600 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                <div class="text-indigo-700">Facebook</div>
                </button>
                <button class="flex items-center bg-gray-100 shadow-md border border-gray-200 rounded px-4 py-2 mr-2">
                <svg class="fill-current text-gray-600 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                <div class="text-indigo-700">GitHub</div>
                </button>
            </div> 
            -->
            <div class="bg-gray-200 pt-8 pb-16">
                <div class="text-center text-gray-600 mb-6">Or sign in with Email & Password</div>
                <div class="text-center text-red-400 mb-6" v-if="error">{{ error }} </div>
                <div class="w-4/5 mx-auto">
                <div class="flex items-center bg-white rounded shadow-md mb-4">
                    <span class="px-3">
                    <svg class="fill-current text-primary w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/></svg>
                    </span>
                    <input class="w-full h-12 focus:outline-none" type="email" v-model="form.email" placeholder="Email">
                </div>
                <p v-if="errors.email" class="text-red-300">{{ errors.email }} </p>

                <div class="flex items-center bg-white rounded shadow-md mb-4">
                    <span class="px-3">
                    <svg class="fill-current text-primary w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8V6a6 6 0 1 1 12 0h-3v2h4a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/></svg>
                    </span>
                    <input class="w-full h-12 focus:outline-none" type="password" v-model="form.password" placeholder="Password">
                </div>
                <p v-if="errors.password" class="text-red-300">{{ errors.password }} </p>

                <div class="mb-4">
                    <input type="checkbox" name="remember" class="mr-1">
                    <label for="remember" class="text-sm text-gray-600">Remember me</label>
                </div>
                <div class="mb-4">
                    <label for="remember" class="text-sm text-gray-600">Don`t have accout?. 
                        <inertia-link href="/register" class="text-sm text-blue-300 hover:text-blue-400">Click here</inertia-link > 
                    </label>
                </div>
                <button class="bg-primary hover:bg-yellow-400 block mx-auto text-white text-sm uppercase rounded shadow-md px-6 py-2">Sign in</button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>

    export default{
        props: {
            error: null,
            errors: {},
        },
        data(){
            return {
                form: {
                    email: null,
                    password: null,
                }
            }
        },
        methods: {
            login(){
                this.$inertia.post('/login', this.form)
            }
        }
    }

</script>