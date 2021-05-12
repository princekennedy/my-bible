<template>

    <div class="max-w-md mx-auto mt-4 bg-white shadow rounded my-8">
        <form  method="POST" @submit.prevent="save">
            <div class="text-center text-gray-600 py-4"><b>Create Account</b></div>
            <p v-if="message" class="p-1 m-1 text-white text-center"> <span class="p-1">{{ message }} </span></p>
            <div class="bg-gray-200 pt-8 pb-16">
                <div class="w-4/5 mx-auto">
                    <div class="flex items-center bg-white rounded shadow-md mb-4">
                        <input class="w-full h-12 ml-2 focus:outline-none" type="text" v-model="form.firstname" placeholder="Firstname">
                    </div>
                    <p v-if="errors.firstname" class="text-red-300">{{ errors.firstname }} </p>

                    <div class="flex items-center bg-white rounded shadow-md mb-4">
                        <input class="w-full h-12 ml-2 focus:outline-none" type="text" v-model="form.lastname" placeholder="Lastname">
                    </div>
                    <p v-if="errors.lastname" class="text-red-300">{{ errors.lastname }} </p>

                    <div class="flex items-center bg-white rounded shadow-md mb-4">
                        <input class="w-full h-12 ml-2 focus:outline-none" type="email" v-model="form.email" placeholder="Email">
                    </div>
                    <p v-if="errors.email" class="text-red-300">{{ errors.email }} </p>

                    <div class="flex items-center bg-white rounded shadow-md mb-4">
                        <input class="w-full h-12  ml-2 focus:outline-none" type="password" v-model="form.password" placeholder="Password">
                    </div>
                    <p v-if="errors.password" class="text-red-300">{{ errors.password }} </p>

                    <div class="mb-4">
                        <label for="remember" class="text-sm text-gray-600">Already have an account?. 
                            <inertia-link href="/login" class="text-sm ">Click here</inertia-link> 
                        </label>
                    </div>
                    <button type="save" class="bg-primary block mx-auto text-white text-sm uppercase rounded shadow-md px-6 py-2">Sign up</button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>

    export default{
        components: { },
        props: {
            message: String,
            errors: String,
        },
        data(){
            return {
                form: {
                    firstname: null,
                    lastname: null,
                    email: null,
                    password: null,
                }
            }
        },
        methods: {
            save(){
                console.log(this.form)
                this.$inertia.post('/register', this.form)
                // {
                //     onSuccess: (res) => {
                //         console.log(res)
                //     }
                // }
            }
        }
    }

</script>