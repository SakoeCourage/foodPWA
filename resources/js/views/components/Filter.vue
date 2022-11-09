<template>
<div >
   <nav class="flex items-center">
    <Selectoptions
        :currentSelection="filters.dishType"
        @setNewDishTypeselection="setNewDishTypeselection" 
        name="Dish Type"
        icon="utensils"  :options="dishType" 
    />
    <Selectoptions 
        :currentSelection="filters.sort" 
        @setNewSortselection="setNewSortselection " 
        name="Sort" 
        icon="layer-group" 
        :options="['old','new']" 
    />
    
</nav>
    <button @click="applyNewFilters" v-if="applyfilter" class=" text-green-600 mt-2 mx-auto flex justify-center items-center gap-2 px-2 py-1 bg-green-50 rounded-lg text-xs">
        <span>apply filters</span> 
        <font-awesome-icon icon="circle-check" class="text-green-600"/>
    </button>
</div>
</template>

<script setup>
import Selectoptions from './Selectoptions.vue'
import { useFoodStore } from '../../store/Foodstore';
import {onMounted, watch,ref} from 'vue'
import {storeToRefs} from 'pinia'
const foodstore = useFoodStore()
const {getAllDishTypes,applySearchFilters,getAllDish} = foodstore;
const {dishType,filters} = storeToRefs(foodstore)

let applyfilter = ref(false)
const setNewDishTypeselection = (value)=>{   
    foodstore.$state.filters.dishType=value  

}

const setNewSortselection = (value)=>{
    foodstore.$state.filters.sort =value
}

let applyNewFilters = () =>{
    applySearchFilters()
        getAllDish()
        applyfilter.value = false

}
watch(filters.value,(value)=>{
    applyfilter.value = true
})
onMounted(()=>{
    dishType.value.length == 1 && getAllDishTypes()
})
</script>
