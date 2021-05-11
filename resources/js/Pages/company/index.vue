<template>
    <AppLayout>
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <div class="w-full p-3">
                <div class="bg-white border rounded shadow">
                    <div class="border-b p-3">
                        <h5 class="font-bold uppercase text-gray-600">
                            COMPANY LIST
                            <span class=" p-3 text-green-400 hover:text-primary hover:font-medium fa fa-plus float-right cursor-pointer"> Add </span>
                        </h5>
                    </div>
                    <div class="p-2">

                        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded overflow-hidden sm:shadow-lg my-5">
                            <thead class="text-white">
                                <tr  v-for="(company, index) in companies.data" v-bind:key="index" class="text-primary flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                    <th class="p-3 text-left"> Name </th>
                                    <th class="p-3 text-left"> Desscription</th>
                                    <th class="p-3 text-left"> Created At </th>
                                    <th class="p-3 text-left" width="110px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="flex-1 sm:flex-none">
                                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0" v-for="(company, index) in companies.data" v-bind:key="index" >
                                    <td class="border-grey-light border hover:bg-gray-100 p-3"> {{ company.name }} </td>
                                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ company.description }} </td>
                                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"> {{ company.created_at }} </td>
                                    <td class="border-grey-light border">
                                        <span class="hover:bg-gray-100 p-3 text-red-200 hover:text-red-400 hover:font-medium fa fa-trash ml-4 float-right cursor-pointer"> </span>
                                        <span class="hover:bg-gray-100 p-3 text-green-400 hover:text-primary hover:font-medium fa fa-edit float-right cursor-pointer"> </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <vue-pagination  :pagination="companies" @paginate="getCompanys()" :offset="4"></vue-pagination>
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

export default{
    components: {
        AppLayout,
        VuePagination
    },
    props:{
        companies: Object
    },
    data(){
        return { }
    },
    methods: {
        getCompanys(){
            this.$inertia.visit(`/company?page=${this.companys.current_page}`);
        }
    }
}

</script>
