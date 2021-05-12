<template>
    <AppLayout>



        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">


            <div class="flex flex-wrap">
                <div  v-for="(card, index) in cards" v-bind:key="index" class="w-full  cursor-pointer md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2" @click="callLink(card.link)">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 text-primary bg-opacity-20">
                                <i :class=" card.icon + 'fa-2x fa-fw fa-inverse text-primary'"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">
                                     {{ card.name }}
                                </h5>
                                <h3 class="font-bold text-3xl">  {{ card.total }} 
                                    <!-- <span class="text-primary"><i class="fas fa-caret-up"></i></span> -->
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>

            <!--Divider-->
            <!-- <hr class="border-b-2 border-gray-400 my-8 mx-4"> -->
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
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users.data" v-bind:key="index">
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                            {{ user.firstname  + ' ' + user.lastname }} 
                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                            {{ user.name }} 
                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                            {{ user.created_at }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <vue-pagination  :pagination="users" @paginate="getUsers()" :offset="4"></vue-pagination>
                    </div>
                </div>
            </div>

        </div>

    </AppLayout>
</template>


<script>

import AppLayout from './layouts/app-layout.vue';
import VuePagination from './components/vue-pagination'
import style from '../../css/responsive-table.css'
import Message from './components/message'
import Error from './components/error'

export default{
    components: {
        AppLayout,
        VuePagination,
        Message,
        Error,
    },
    props:{
        cards: Array,
        users: Object,
        message: String,
    },
    data(){
        return { }
    },
    methods: {
        callLink(link){
            this.$inertia.visit(link);
        },
        getUsers(){
            this.$inertia.visit(`/?page=${this.users.current_page}`);
        }
    },

    mounted(){
        
        // $("#nav-toggle").click( function(){
        //     $("#nav-content").toggle();
        // });
        // console.log($)
        // console.log(90)
        // Echo.channel("home").listen("NewMessage", (e) =>{
        //     console.log("prince");
        //     console.log(e.message);
        // })
        // Echo.channel("homkke").listen("NewMessage", (e) =>{
        //     console.log("prince");
        //     console.log(e.message);
        // })
    }
}

</script>
