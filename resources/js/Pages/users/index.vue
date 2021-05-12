<template>
    <AppLayout>
        <ModalLayout :actionBtns="['Save']"  title="Add User" @Save="Save" :showModal="showModal" @toggleModal="toggleModal">
            <div class="relative p-6 flex-auto">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                        Firstname
                    </label>
                    <input v-model="form.firstname" id="firstname" type="text" placeholder="Firstname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <Error :simple="true" :message="errors.firstname" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                        Lastname
                    </label>
                    <input v-model="form.lastname" id="lastname" type="text" placeholder="lastname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <Error :simple="true" :message="errors.lastname" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input  v-model="form.email" id="email" type="text" placeholder="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <Error :simple="true" :message="errors.email" />
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input  v-model="form.password" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                    <Error :simple="true" :message="errors.password" />
                </div>

                
                <div class="relative z-0 w-full mb-5">
                   <select v-model="form.roles" multiple class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                       <option disabled value="">Select Roles</option>
                       <option v-for="(role, index) in roles" :key="index" :value="role.id"> {{ role.name }} </option>
                   </select>
                </div>
            </div>
        </ModalLayout>

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            <Message :message="message"/>
            <div class="w-full ">
                <div class="border-b p-3 bg-white">
                    <h5 class="font-bold uppercase text-gray-600">
                        USER LIST
                        <span v-on:click="toggleModal()" class="mt-1 text-green-400 hover:text-primary hover:font-medium fa fa-plus float-right cursor-pointer"> Add </span>
                    </h5>
                </div>
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="block w-full overflow-x-auto">
                    <!-- Projects table -->
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                            <tr>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Name
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Email
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Created At
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                
                                </th>
                            </tr>
                            </thead>
                            <tbody class="p-1">
                                <tr class="border hover:bg-gray-100"  v-for="(user, index) in users.data" v-bind:key="index">
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ user.firstname  + ' ' + user.lastname }} 
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ user.email }} 
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ user.created_at }}
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        <span v-on:click="deleteUser(user.id)" class="hover:bg-gray-100 p-3 text-red-200 hover:text-red-400 hover:font-medium fa fa-trash ml-4 float-right cursor-pointer"> </span>
                                        <span v-on:click="editUser(user)" class="hover:bg-gray-100 p-3 text-green-400 hover:text-primary hover:font-medium fa fa-edit float-right cursor-pointer"> </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <vue-pagination  :pagination="users" @paginate="getUsers()" :offset="4"></vue-pagination>
                </div>
            </div>
        </div>

    </AppLayout>
</template>


<script>

import AppLayout from '../layouts/app-layout';
import VuePagination from '../components/vue-pagination'
import style from '../../../css/responsive-table.css'
import ModalLayout from '../layouts/modal-layout'
import Message from '../components/message'
import Error from '../components/error'

export default{
    components: {
        AppLayout,
        VuePagination,
        ModalLayout,
        Message,
        Error
    },
    props:{
        users: Object,
        errors: Object,
        message: String,
        roles: Array,
    },
    data(){
        return { 
            showModal: false,
            user:Object,
            form: Object,
        }
    },
    methods: {
        getUsers(){
            this.$inertia.visit(`/users?page=${this.users.current_page}`);
        },

        toggleModal(){
            this.user = null
            this.form = {
                firsname: null,
                lastname: null,
                email: null,
                password: null,
                roles: []
            };
            this.showModal = !this.showModal;
        },

        editUser(user){
            this.user = user;
            this.form = this.user;
            this.form.roles = [];
            this.user.roles.map( role => { this.form.roles.push(role.id) });
            this.showModal = !this.showModal;
        },

        deleteUser(user_id){
            this.$inertia.post('/delete-user/'+ user_id)
        },

        Save(){
            var link = (this.user) ? '/update-user/' + this.user.id : '/users';
            this.$inertia.post( link, this.form, {
                onSuccess: (res) => {
                    if(Object.keys(this.errors).length <= 0) this.toggleModal();            
                }
            })
        },
    },

    mounted(){ }
}

// <div class="relative z-0 w-full mb-5">
//     <select name="select" multiple class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
//         <option value="">Gender</option>
//         <option value="2">Option 2</option>
//         <option value="3">Option 3</option>
//         <option value="4">Option 4</option>
//         <option value="5">Option 5</option>
//     </select>
// </div>

</script>

