<template>
    <div>
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
          <a href="#" class="relative inline-flex items-center px-4 py-2 border border-secondary text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500">
            Previous
          </a>
          <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-secondary text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500">
            Next
          </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing
              <span class="font-medium"> 
                {{ pagination.current_page * pagination.per_page - pagination.per_page }}
              </span>
              to
              <span class="font-medium">
                {{ (pagination.current_page * pagination.per_page > pagination.total ) ? pagination.total : pagination.current_page * pagination.per_page }}
              </span>
              of
              <span class="font-medium">
                {{ pagination.total }}
              </span>
              results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <inertia-link v-if="pagination.current_page > 1" href="javascript:void(0)" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-secondary bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <span aria-hidden="true">«</span>
              </inertia-link>
              <inertia-link href="javascript:void(0)" v-on:click.prevent="changePage(page)" v-for="(page, index) in pagesNumber" :key="index" 
              :class=" isActive( page ) + ' relative inline-flex items-center px-4 py-2 border border-secondary bg-white text-sm font-medium text-gray-700 hover:text-primary'">
                {{ page }}
              </inertia-link>
              <inertia-link v-if="pagination.current_page < pagination.last_page" href="javascript:void(0)" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-secondary bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <span aria-hidden="true">»</span>
              </inertia-link>
            </nav>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
  export default{
      props: {
      pagination: {
          type: Object,
          required: true
      },
      offset: {
          type: Number,
          default: 4
      }
    },
    computed: {
      pagesNumber() {
        if (!this.pagination.to) {
          return [];
        }
        let from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        let to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        let pagesArray = [];
        for (let page = from; page <= to; page++) {
          pagesArray.push(page);
        }
          return pagesArray;
      }
    },
    methods : {
      changePage(page) {
        this.pagination.current_page = page;
        this.$emit('paginate');
      },
      isActive(page){
        if(page == this.pagination.current_page) return " bg-red ";
      }
    },
    mounted(){
    }
  }
</script>