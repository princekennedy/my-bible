<template>
    <AppLayout>

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            <Message :message="message"/>
            <div class="w-full ">
                <div class="border-b p-3 bg-white">
                    <h5 class="font-bold uppercase text-gray-600">
                        WAITING LIST
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
                                Place
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Registered Date
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
                                        {{ user.name }} 
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ user.created_at }}
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        <span class="hover:bg-gray-100 p-3 text-green-400 hover:text-primary hover:font-medium fa fa-edit float-right cursor-pointer"> </span>
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

export default{
    components: {
        AppLayout,
        VuePagination
    },
    props:{
        users: null
    },
    data(){
        return { }
    },
    methods: {
        getUsers(){
            this.$inertia.visit(`/waiting-list?page=${this.users.current_page}`);
        },
     }
}

</script>
