<template>
    <AppLayout>



        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">


            <div class="flex flex-wrap">
                <div  v-for="(card, index) in cards" v-bind:key="index" class="w-full  cursor-pointer md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric Card-->
                    <div class="bg-white border rounded shadow p-2" @click="callLink(card.link)">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-primary bg-opacity-20"><i :class=" card.icon + 'fa-2x fa-fw fa-inverse'"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">
                                     {{ card.name }}
                                </h5>
                                <h3 class="font-bold text-3xl">  {{ card.total }} <span class="text-primary"><i class="fas fa-caret-up"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
            </div>

            <!--Divider-->
            <!-- <hr class="border-b-2 border-gray-400 my-8 mx-4"> -->

            <div class="w-full p-3">
                <!--Table Card-->
                <div class="bg-white border rounded shadow">
                    <div class="border-b p-3">
                        <h5 class="font-bold uppercase text-gray-600">WAITING LIST</h5>
                    </div>
                    <div class="p-2">

                        
                        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded overflow-hidden sm:shadow-lg my-5">
                            <thead class="text-white">
                                <tr  v-for="(user, index) in users.data" v-bind:key="index" class="bg-primary flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                    <th class="p-3 text-left w-10"> Position </th>
                                    <th class="p-3 text-left"> Name </th>
                                    <th class="p-3 text-left"> Place</th>
                                    <!-- <th class="p-3 text-left" width="110px">Action</th> -->
                                </tr>
                            </thead>
                            <tbody class="flex-1 sm:flex-none">
                                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0" v-for="(user, index) in users.data" v-bind:key="index" >
                                    <td class="border-grey-light border hover:bg-gray-100 p-3"> <span class="badge"> {{ index + 1 }} </span> </td>
                                    <td class="border-grey-light border hover:bg-gray-100 p-3">  {{ user.firstname + " " + user.lastname }}  </td>
                                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ user.name }} </td>
                                    <!-- <td class="border-grey-light border">
                                        <span class="hover:bg-gray-100 p-3 text-red-200 hover:text-red-400 hover:font-medium fa fa-trash ml-4 float-right cursor-pointer"> </span>
                                        <span class="hover:bg-gray-100 p-3 text-green-400 hover:text-green-600 hover:font-medium fa fa-edit float-right cursor-pointer"> </span>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                        <vue-pagination  :pagination="users" @paginate="getUsers()" :offset="4"></vue-pagination>
                    </div>
                </div>
                <!--/table Card-->
            </div>
        </div>

    </AppLayout>
</template>


<script>

import AppLayout from './layouts/app-layout.vue';
import VuePagination from './components/vue-pagination'
import style from '../../css/responsive-table.css'

export default{
    components: {
        AppLayout,
        VuePagination
    },
    props:{
        cards: null,
        users: null,
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
