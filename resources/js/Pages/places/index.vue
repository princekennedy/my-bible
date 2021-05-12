<template>
    <AppLayout>

        <ModalLayout :actionBtns="['Save']"  title=" Depo" @Save="Save" :showModal="showModal" @toggleModal="toggleModal">
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

                <p class="border-b p-2 border-primary border:opacity"> 
                    Default is your current location. 
                    <button v-on:click="setDefault()" class="text-white border border-solid p-2 bg-green-300 hover:bg-green-500  font-bold uppercase text-sm rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">set</button>
                </p>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lat">
                        Latitude
                    </label>
                    <input v-model="form.lat" id="lat" type="text" placeholder="Latitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <Error :simple="true" :message="errors.lat" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="long">
                        Longtude
                    </label>
                    <input v-model="form.long" id="long" type="text" placeholder="Longtude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <Error :simple="true" :message="errors.long" />
                </div>
            </div>
        </ModalLayout>

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
                                    Position
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
                                        {{ place.lat }}, {{ place.long }}
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
import ModalLayout from '../layouts/modal-layout'
import Error from '../components/error'

export default{
    components: {
        AppLayout,
        VuePagination,
        Message,
        ModalLayout,
        Error,
    },
    props:{
        places: Object,
        message: String,
        errors: Object,
    },
    
    computed: {
        inRange() {
        const coords = this.$geolocation.coords
        if (!coords) return '?'
        return distanceFrom(coords, this.destination) > 150
        }
    },

    data(){
        return {
            showModal: false,
            place:Object,
            form: Object,
        }
    },
    methods: { 
        getPlaces(){
            this.$inertia.visit(`/places?page=${this.places.current_page}`);
        },

        toggleModal(){
            this.place = null
            this.form = {
                name: null,
                description: null,
                lat: null,
                long: null,
            };
            this.showModal = !this.showModal;
        },

        setDefault(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position)=>{
                    this.form.lat = position.coords.latitude;
                    this.form.long = position.coords.longitude;
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        },
        
        editPlace(place){
            this.place = place;
            this.form = this.place;
            this.showModal = !this.showModal;
        },

        deletePlace(place_id){
            this.$inertia.post('/delete-place/'+ place_id)
        },

        Save(){
            var link = (this.place) ? '/places/' + this.place.id : '/places';
            this.$inertia.post( link, this.form, {
                onSuccess: (res) => {
                    if(Object.keys(this.errors).length <= 0) this.toggleModal();            
                }
            })
        },
    },

}

</script>
