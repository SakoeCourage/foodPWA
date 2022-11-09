<template>
        <nav class="flex items-center gap-4  w-max px-2 pt-1  h-full  mx-auto " id="searchfilter">
            <span class="rounded-md px-2 bg-orange-200/80 py-1 space-x-2 text-sm ">
                <label class="text-xs text-gray-800" for="">sort</label>
                <select @change="applyNewFilters"  v-model="filters.sort" name="" id="" class=" bg-orange-50 focus:outline focus:border-none border-none outline-none px-2 rounded-md ">
                    <option  class="" >new</option>
                    <option class=" rounded-md " >old</option>
                </select>
            </span>
            <span class="rounded-md px-2 bg-orange-200/80 py-1 space-x-2 text-sm ">
                <label class="text-xs text-gray-800" for="">difficulty</label>
                <select  @change="applyNewFilters" v-model="filters.difficulty" name="" id="" class=" bg-orange-50 focus:outline focus:border-none border-none outline-none px-2 rounded-md ">
                    <option> All</option>
                    <option class="" >Easy</option>
                    <option  class="" >intermediate</option>
                    <option  class="" >Expert</option>
                </select>
            </span>
            <span class="rounded-md px-2 bg-orange-200/80 py-1 space-x-2 text-sm ">
                <label class="text-xs text-gray-800" for="">dishType</label>
                <select @change="applyNewFilters" v-model="filters.dishType"  name="" id="" class=" bg-orange-50 focus:outline focus:border-none border-none outline-none px-2 rounded-md truncate">
                    <option v-for="(dishType,i) in dishTypes" :key="i" class="truncate" :value="dishType" >{{ dishType }}</option>
               
                </select>
            </span>
        </nav>
</template>


<script setup>
import { computed, onMounted, watch } from '@vue/runtime-core';
import {storeToRefs} from 'pinia'
import {useSearchresultsStore} from '../../store/Searchresultstore'
const searchresultstore = useSearchresultsStore()
const {getAllDishTypes,getSearchItem,applyFilters}  = searchresultstore;
const {filters,dishTypes} = storeToRefs(searchresultstore)
onMounted(()=>{
    getAllDishTypes()
})

let applyNewFilters = ()=>{
    applyFilters()
    getSearchItem()
}


</script>