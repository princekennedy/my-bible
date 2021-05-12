<template>
    <AppLayout>

        <ModalLayout :actionBtns="['Save']"  title="Company" @Save="Save" :showModal="showModal" @toggleModal="toggleModal">
            <div class="relative p-6 flex-auto">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input v-model="form.name" id="name" type="text" placeholder="Company Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <Error :simple="true" :message="errors.name" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea v-model="form.description" id="description" placeholder="Comment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    </textarea>
                    <Error :simple="true" :message="errors.description" />
                </div>
            </div>
        </ModalLayout>

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            <Message :message="message"/>
            <div class="w-full ">
                <div class="border-b p-3 bg-white">
                    <h5 class="font-bold uppercase text-gray-600">
                        company LIST
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
                                Desscription
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                               
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                     Created At
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(company, index) in companies.data" v-bind:key="index">
                                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2 text-left">
                                    {{ company.name }} 
                                </th>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                    {{ company.description }} 
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
 
                                    <div class="flex items-center mr-4 mb-4">
                                        <input :id="index" type="radio" :checked="check(company.id)" v-on:change="activeCompany(company.id)" name="radio" class="hidden" />
                                        <label :for="index" class="flex items-center cursor-pointer">
                                            <span class="w-8 h-8 inline-block mr-2 rounded-full border border-grey flex-no-shrink"></span>
                                        </label>
                                    </div>

                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                    {{ company.created_at }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                    <span v-on:click="deleteCompany(company.id)" class="hover:bg-gray-100 p-3 text-red-200 hover:text-red-400 hover:font-medium fa fa-trash ml-4 float-right cursor-pointer"> </span>
                                    <span v-on:click="editCompany(company)" class="hover:bg-gray-100 p-3 text-green-400 hover:text-primary hover:font-medium fa fa-edit float-right cursor-pointer"> </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <vue-pagination  :pagination="companies" @paginate="getCompanies()" :offset="4"></vue-pagination>
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
    computed: {

        active_business() {
            return this.$page.props.active_company
        }
    },
    props:{
        companies: Object,
        errors: Object,
        message: String,
    },
    data(){
        return { 
            showModal: false,
            company:Object,
            form: Object,
            checked: false,
        }
    },
    methods: {
        getCompanies(){
            this.$inertia.visit(`/company?page=${this.companies.current_page}`);
        },

        toggleModal(){
            this.company = null
            this.form = {
                name: null,
                description: null,
            };
            this.showModal = !this.showModal;
        },

        editCompany(company){
            this.company = company;
            this.form = this.company;
            this.showModal = !this.showModal;
        },

        deleteCompany(company_id){
            this.$inertia.post('/delete-company/'+ company_id)
        },

        activeCompany(company_id){
            this.$inertia.post('/change-company/'+ company_id)
        },

        check(company_id){
            if(this.active_business) return (this.active_business.id == company_id);
        },

        Save(){
            var link = (this.company) ? '/update-company/' + this.company.id : '/company';
            this.$inertia.post( link, this.form, {
                onSuccess: (res) => {
                    if(Object.keys(this.errors).length <= 0) this.toggleModal();            
                }
            })
        },
    },

    mounted(){
        
        
    }
}

</script>
