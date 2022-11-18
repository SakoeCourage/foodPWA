<template>
<div>
    <div >

 
    <section>
        <Imageframe name="foodImage" @foodImage="getFoodImage" class="w-full bg-gray-50" />
    </section>
    <section class="pt-4">
        <div class="text-xl text-gray-500 tracking-wide px-2 "><span>Dish Details</span></div>
        
        <hr class="border border-gray-50 shadow-md mt-2">
        <div class="mt-2 px-2">
            <nav class="text-gray-400 text-md px-2">dish name</nav>
            <input v-model="foodData.dishname" class="bg-yellow-50/60 w-full p-2 focus:outline-none focus:border-none rounded-md  text-gray-400 text-sm  ring-orange-200 ring-offset-1 focus:ring-2 transition-all ease-out duration-150" type="text" name="" id="" placeholder="">
        </div>
        <hr class="border border-gray-50 shadow-md my-6">
        <div class="mt-4 px-2">
            <!-- Making ingredients List -->
            <nav class="text-gray-400 text-md px-2">ingredients </nav>
            <Ingredients @get-ingredients="getIngredient" />
            <hr class="border border-gray-50 shadow-md my-6">
            <nav class="text-gray-400 text-md px-2 procedure ">Precedures</nav>
            <!-- Making multistep procedure -->
            <Multistepprocedure @get-procedures="getProcedure" />
        </div>
        <hr class="border border-gray-50 shadow-md my-6">
        <div class="mt-4 px-2 pb-10">
            <nav class="text-gray-400 text-md px-2 pb-2 ">difficulty level </nav>
           <nav class="flex gap-4 text-sm ">
            <Selectdifficultlevel @setdifficultyLevel="setdifficultyLevel" :selectedLevel="foodData.difficultyLevel"/>
            </nav>
        </div>
        <div class="mt-4 px-2 pb-10">
            <nav class="text-gray-400 text-md px-2 pb-2 ">type of dish </nav>
           <nav class="flex gap-4 text-sm flex-wrap w-full">
                <Selectdishtype @setDishById="setDishById" :selectedDishType = "foodData.selectedDishTypeId"/>
            </nav>
        </div>
        <hr class="border border-gray-50 shadow-md mt-2">
        <div class="mt-4 px-2 pb-10 flex justify-center gap-2 ">
            <button v-if="isLoading" class="bg-orange-300/90 w-2 h-10 rounded-full px-2 py-2 " :class="isLoading &&'animate-bounce opacity-70 delay-100  '">
            </button>
            <button @click.prevent="postdish" class="bg-orange-300/90  text-white w-full px-2 py-2 tracking-wider  text-sm transition-all addtimingfunction  " 
                :class="isLoading ? 'w-5 h-10 rounded-full animate-bounce opacity-70 delay-150': 'w-full h-10 rounded-lg '">
                <span v-if="!isLoading"> submit dish</span>
            </button>
            <button v-if="isLoading" class="bg-orange-300/90 w-2 h-10 rounded-full px-2 py-2" :class="isLoading && 'animate-bounce opacity-70'">
            </button>

        </div>
     
    </section>
</div>
</div>
</template>

<script setup>

import Imageframe from './components/Imageframe.vue';
import {computed, reactive, ref, watch} from 'vue';
import Ingredients from './components/Ingredients.vue';
import Multistepprocedure from './components/Multistepprocedure.vue';
import Selectdifficultlevel from './components/Selectdifficultlevel.vue';
import Selectdishtype from './components/Selectdishtype.vue';
import Api from '../api/Api';

let isLoading = ref(false)
let foodData = reactive({
    difficultyLevel: "Easy",
    procedures: [],
    image: null,
    ingredients: [],
    dishname: null,
    selectedDishTypeId:1,
})      

let setdifficultyLevel = (level) =>{
    foodData.difficultyLevel = level   
}

let setDishById = (id)=>{
    foodData.selectedDishTypeId = id
}

let getProcedure = (procedures) =>{
    foodData.procedures = procedures
}

let getFoodImage = (image) =>{
    foodData.image = image
}

let getIngredient = (ingredient)=>{
    foodData.ingredients = ingredient
}

let postdish = () =>{
    isLoading.value = true
    const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
      }
      let data = new FormData();
      data.append('difficultyLevel',foodData.difficultyLevel)
      data.append('procedures',foodData.procedures)
      data.append('image',foodData.image)
      data.append('ingredients',JSON.stringify(foodData.ingredients))
      data.append('dishname',foodData.dishname)
      data.append('dishtypeid',foodData.selectedDishTypeId)

    Api.post('/adddish',data,config).then(res=>{
        console.log(res.data)
        isLoading.value = false
    }).catch(error=>{
        isLoading.value = false
        console.log(error.response)
    })
    }





</script>


<style scoped>
.addtimingfunction{
    transition-timing-function: cubic-bezier(.05,.78,.38,1.09);
    transition-duration: 300ms;
}

.delay-100{
    animation-delay: 100ms;
}
.delay-150{
    animation-delay: 150ms;
}



</style>


