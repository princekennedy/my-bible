
<template>
  <div>
    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex m-2">
      <div class="relative w-auto  mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div v-if="title" class=" justify-between border-b p-2 border-solid border-blueGray-200 rounded-t">
            <h3 class="p-2 mt-2 font-semibold w-full">
              {{ title }}
                <button type="button"  v-on:click="toggleModal()" class="close round-lg text-red-500 float-right inset-y-0 p-2  hover:bg-gray-100 hover:text-red a" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h3>
          </div>
          <!--body-->
          <slot></slot>
          <!--footer-->
          <div v-if="cancelBtn || actionBtns" class="flex items-center justify-end p-2 border-t border-solid border-blueGray-200 rounded-b">
    
            <button type="button" v-if="actionBtns" v-for="(btn, index) in actionBtns" v-on:click="emitting(btn)" :key="index" class="text-primary bg-transparent border border-solid border-primary hover:bg-primary hover:text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
              {{ btn }}
            </button>
            <button v-if="cancelBtn" class="text-white border border-solid  bg-red-400  hover:bg-red-500 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
export default {
    name: "modal-layout",
    props:{
        showModal: Boolean,
        title: String,
        cancelBtn: null,
        actionBtns: Array
    },
    data() {
        return {
        }
    },
    methods: {
        toggleModal: function(){
            this.$emit("toggleModal")
        },
        emitting: function(action){
            this.$emit(action)
        },
    }

}
</script>