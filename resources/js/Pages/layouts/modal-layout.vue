
<template>
  <div>
    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex m-2">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-3 border-b border-solid border-blueGray-200 rounded-t">
            <h3 class=" font-semibold w-full">
              Modal Title
                <button type="button"  v-on:click="toggleModal()" class="close round-lg p-2 text-red-500 float-right inset-y-0 right-0 w-16 hover:bg-gray-100 hover:text-red a" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h3>
          </div>
          <!--body-->
          <slot></slot>
          <!--footer-->
          <div class="flex items-center justify-end p-3 border-t border-solid border-blueGray-200 rounded-b">

            <button class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
              Save Changes
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
        showModal: Boolean
    },
    data() {
        return {
        }
    },
    methods: {
        toggleModal: function(){
            this.$emit("toggleModal")
        }
    }

}
</script>