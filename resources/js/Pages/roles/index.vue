<template>
    <AppLayout>
        <ModalLayout :actionBtns="['Save']"  title="Role" @Save="Save" :showModal="showModal" @toggleModal="toggleModal">
            <div class="relative p-6 flex-auto">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input v-model="form.name" id="name" type="text" placeholder="Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <Error :simple="true" :message="errors.name" />
                </div>
                <div class="relative z-0 w-full mb-5">
                   <select v-model="form.permissions" multiple class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                       <option disabled value="">Select Permissions</option>
                       <option v-for="(permission, index) in permissions" :key="index" :value="permission.id"> {{ permission.name }} </option>
                   </select>
                </div>
            </div>
        </ModalLayout>
        <div class="w-full md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <Message :message="message"/>
            <div class="w-full p-3">
                <div class="bg-white border rounded shadow">
                    <div class="border-b p-3">
                        <h5 class="font-bold uppercase text-gray-600">
                            ROLE LIST
                            <span v-on:click="toggleModal()" class=" p-3 text-green-400 hover:text-primary hover:font-medium fa fa-plus float-right cursor-pointer"> Add </span>
                        </h5>
                    </div>
                    <div class="p-2">

                        <table class="shadow-md rounded m-auto w-full sm:shadow-lg">
                            <thead class="sticky block top-0" scope="col">
                                <tr class="flex text-left text-primary ">
                                    <th scope="col" class="w-full p-2 border border-r-0 rounded-tl border-gray-100">Name</th>
                                    <th scope="col" class="w-full  p-2 border bg-white border-r-0 border-gray-100 font-normal">
                                        <h5 class="u-slab">Permissions</h5>
                                    </th>
                                    <th scope="row" class="hidden sm:block w-full  p-2 border bg-white border-r-0 border-gray-100 font-normal">
                                        <h4 class="u-slab">Created At</h4>
                                    </th>
                                    <th scope="row" class="hidden sm:block w-full  p-2 border bg-white rounded-tr border-gray-100 font-normal ">
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="flex text-left"  v-for="(role, index) in roles.data" v-bind:key="index" >
                                    <th scope="col" class="w-full text-sm p-2 border border-r-0 border-t-0 border-gray-100">
                                        {{ role.name }}
                                    </th>
                                    <th scope="col" class="w-full p-2 border border-r-0 border-t-0 border-gray-100 flex flex-col">
                                        <ul class="text-sm font-normal mb-1">
                                            <li class="mb-2 tick"  v-for="(permission, index) in role.permissions" :key="index"> 
                                                <div class="bg-green-100 border border-green-400 text-green-700 p-1 rounded relative" role="alert"> 
                                                    {{ permission.name.toUpperCase().replaceAll("_", " ") }} 
                                                </div>
                                            </li>
                                        </ul>
                                    </th>
                                    <th scope="row" class="hidden sm:block text-sm w-full p-2 border border-r-0 border-t-0 border-gray-100  ">
                                        <span class="text-sm"> {{ role.created_at }} </span>
                                    </th>
                                    <th scope="row" class="hidden sm:block w-full text-sm p-2 border border-t-0 border-gray-100 ">
                                        <span v-on:click="deleterole(role.id)" class="hover:bg-gray-100 p-2 text-red-300 hover:text-red-500 hover:font-small fa fa-trash ml-4 float-right cursor-pointer"> </span>
                                        <span v-on:click="editrole(role)" class="hover:bg-gray-100 p-2 text-gray-400 hover:text-primary hover:font-small fa fa-edit float-right cursor-pointer"> </span>
                                    </th>
                                </tr>

                            </tbody>
                            <!--
                            <tfoot>
                                <tr class="flex text-left text-sm">
                                <td class="w-1/4 hidden sm:block p-4 border-gray-100 border border-t-0 text-center bg-gray-100 border-r-0"></td>
                                <td class="w-1/3 sm:w-1/4 p-4 border-gray-100 border border-t-0 text-center border-r-0"><a href="" class=" mt-auto block text-white bg-indigo-500 text-xs py-2 text-center rounded font-normal" title="">Get Started</a></td>
                                <td class="w-1/3 sm:w-1/4 p-4 border-gray-100 border border-t-0 text-center border-r-0"><a href="" class=" mt-auto block text-white bg-indigo-500 text-xs py-2 text-center rounded font-normal" title="">Request a demo</a></td>
                                <td class="w-1/3 sm:w-1/4 p-4 border-gray-100 border border-t-0 text-center"><a href="" class=" mt-auto block text-white bg-indigo-500 text-xs py-2 text-center rounded font-normal rounded-bt" title="">Request a demo</a></td>
                                </tr>
                            </tfoot>
                            -->
                        </table>
                        <vue-pagination  :pagination="roles" @paginate="getRoles()" :offset="4"></vue-pagination>
                    </div>
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
        roles: Object,
        errors: Object,
        message: String,
        permissions: Array,
    },
    data(){
        return { 
            showModal: false,
            role:Object,
            form: Object,
        }
    },
    methods: {
        getRoles(){
            this.$inertia.visit(`/roles?page=${this.roles.current_page}`);
        },

        toggleModal(){
            this.role = null
            this.form = {
                name: null,
                permissions: []
            };
            this.showModal = !this.showModal;
        },

        editRole(role){
            this.role = role;
            this.form = this.role;
            this.form.permissions = [];
            this.role.roles.map( role => { this.form.permissions.push(role.id) });
            this.showModal = !this.showModal;
        },

        deleteRole(role_id){
            this.$inertia.post('/delete-role/'+ role_id)
        },

        Save(){
            var link = (this.role) ? '/update-role/' + this.role.id : '/roles';
            this.$inertia.post( link, this.form, {
                onSuccess: (res) => {
                    if(Object.keys(this.errors).length <= 0) this.toggleModal();            
                }
            })
        },
    },

    mounted(){ }
}

</script>

