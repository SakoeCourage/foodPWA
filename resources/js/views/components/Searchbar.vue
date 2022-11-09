<template>
    <div class=" flex items-center  p-1 px-3 rounded-md focus-within:shadow-2xl loading " id="searchbar">
    <div class="relative  w-4 h-4">
        <Transition name="zoom-in" class="">
        <div role="status" v-if="isLoading" class="absolute">
        <svg aria-hidden="true" class="mr-1 w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-orange-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Loading...</span>
        </div>
        <font-awesome-icon class=" text-gray-400 w-4 h-4 mr-1 absolute" icon="magnifying-glass" v-else />
    </Transition>
    </div>
        <input   v-model="searchKey" v-debounce:500ms="setSearchKeyword" autocomplete="off"  id="searchInput" class=" bg-inherit py-2 grow px-2 border-none outline-none focus:border-none focus:outline-none " type="search" name=""  placeholder="search"/>
    </div>
</template>
<script>
import { vue3Debounce } from 'vue-debounce'
export default {
  directives: {
    debounce: vue3Debounce({ lock: true })
  }
}
</script>

<script setup>
import { onMounted, ref, watch } from "vue"
import {storeToRefs} from 'pinia'
import {useSearchresultsStore} from '../../store/Searchresultstore'

const searchresultstore = useSearchresultsStore()
const {applyFilters,getSearchItem}  = searchresultstore;
const {filters,dishTypes,searchResults,isLoading,searchKey} = storeToRefs(searchresultstore)

let setSearchKeyword =()=>{
 if(searchKey.value){
    filters.value.search = searchKey.value
    applyFilters()
    getSearchItem()
 }
}

watch(()=>searchKey.value,(value)=>{
    {{ searchResults.value = null && !value }}
  
})

watch(()=>searchKey.value,(v)=>{
    if(v){
        searchresultstore.$state.isLoading = true
    }else{
        searchresultstore.$state.isLoading = false
    }
})

</script>
<style scoped>
    .addshadow{
        box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
    }

    
.zoom-in-enter-active,
.zoom-in-leave-active {
  transition: all 0.25s ease-out;
}

.zoom-in-enter-from {
  opacity: 0;
  transform: scale(0.5);
}

.zoom-in-leave-to {
  opacity: 0;
  transform: scale(0.5);
}

 
</style>