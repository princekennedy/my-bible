<template>
    <AppLayout>
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <div class="w-full p-3">
                <!--Table Card-->
                <div class="bg-white border rounded shadow">
                    <div class="border-b p-3">
                        <h5 class="font-bold uppercase text-gray-600">WAITING LIST</h5>
                    </div>
                    <div class="p-2">
                        <ul>
                            <li v-for="(user, index) in users" v-bind:key="index" class="bg-gray-100 p-2 m-1 cursor-pointer"> 
                                Name: <a>  {{ user.firstname + " " + user.lastname }} </a> 
                                Place: <a> {{ user.name }} </a> 
                                <span class="fa fa-trash ml-4 float-right"> </span>
                                <span class="fa fa-edit float-right"> </span>
                            </li>
                        </ul>

                    </div>
                </div>
                <!--/table Card-->
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
    methods: { }
}

</script>
