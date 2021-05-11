<template>
    <AppLayout>
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <div class="bread-crump shadow m-3 bg-white">
                <div class="rounded m-3 p-2">
                    <h5 class="font-bold uppercase text-gray-600  p-2">
                        DEPO LIST
                        <span class=" text-primary hover:text-primary hover:font-medium fa fa-plus float-right cursor-pointer"> Add </span>
                    </h5>
                </div>
            </div>
            <!--Console Content-->
            <div class="flex flex-wrap">
                <div  v-for="(place, index) in places.data" v-bind:key="index" class="w-full  cursor-pointer md:w-1/2 xl:w-1/3 p-3">
                    <!--Metric place-->
                    <div class="bg-white border rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3">
                                <i class="text-primary fa fa-wallet fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-500">
                                     {{ place.name }}
                                </h5>
                                <h5 class="font-bold text-3xl">  
                                    {{ place.users.length }} 
                                    <!-- <span class="text-primary"><i class="fas fa-caret-up"></i></span> -->
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!--/Metric place-->
                </div>
            </div>
            <div class="bread-crump m-3">
                <vue-pagination  :pagination="places" @paginate="getPlaces()" :offset="4"></vue-pagination>
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
        places: Object
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
