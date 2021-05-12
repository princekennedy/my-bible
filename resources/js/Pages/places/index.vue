<template>
    <AppLayout>

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            <Message :message="message"/>
            <div class="w-full ">
                <div class="border-b p-3 bg-white">
                    <h5 class="font-bold uppercase text-gray-600">
                        DEPO LIST
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
                                Description
                                </th>
                               <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Waiting List
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Created At
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="(place, index) in places.data" v-bind:key="index">
                                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2 text-left">
                                        {{ place.name }} 
                                    </th>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ place.description }}
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ place.users.length }}
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                    {{ place.created_at }}
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        <span v-on:click="deletePlace(place.id)" class="hover:bg-gray-100 p-3 text-red-200 hover:text-red-400 hover:font-medium fa fa-trash ml-4 float-right cursor-pointer"> </span>
                                        <span v-on:click="editPlace(place)" class="hover:bg-gray-100 p-3 text-green-400 hover:text-primary hover:font-medium fa fa-edit float-right cursor-pointer"> </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <vue-pagination  :pagination="places" @paginate="getPlaces()" :offset="4"></vue-pagination>
                </div>
            </div>
        </div>


    </AppLayout>
</template>


<script>

import AppLayout from '../layouts/app-layout'
import VuePagination from '../components/vue-pagination'
import Message from '../components/message'

export default{
    components: {
        AppLayout,
        VuePagination,
        Message,
    },
    props:{
        places: Object,
        message: String,
    },
    data(){
        return {  }
    },
    methods: { 
        getPlaces(){
            this.$inertia.visit(`/places?page=${this.places.current_page}`);
        },

    },
    mounted(){
        // console.log(this.$refs)
    }
}

</script>
