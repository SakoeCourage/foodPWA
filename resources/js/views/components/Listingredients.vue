<template>
    <div>
        
<div class="bg-white max-w-2xl h-full">
   
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Marks
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center gap-5">
                  <span class="flex items-center gap-1"><span class="h-2 w-2 bg-green-500 inline-block">&nbsp;</span> <abbr class=" text-sm tracking-tight border-none " title="items with this label is very key to this dish">major ingredient</abbr> </span>
                  <span class="flex items-center gap-1"><span class="h-2 w-2 bg-blue-500 inline-block">&nbsp;</span> <abbr class=" text-sm tracking-tight border-none " title="items with this label is not very key ingredient to this dish">minor ingredient</abbr> </span>
                  
                 
                </dd>
            </div>
            <div class="bg-white px-4 py-5 ">
                <ul class="flex flex-wrap gap-2 w-full  " v-if="ingredients">
                    <li v-for="ingredient in ingredients" :key="ingredient.id" 
                    class=" py-1 px-2 border-gray-200 text-sm rounded-lg shadow"
                    :class="ingredient.important ?'majoringredient': 'minoringredient' ">
                    {{ ingredient.name }}
                    </li>
                    
                </ul>
            </div>
            
        </dl>
    
</div>
     
    </div>
</template>
<script setup>
import { defineProps } from "vue";  
    let props = defineProps({
        ingredients: Array
    })
</script>
<style scoped>
abbr:where([title]) {
  -webkit-text-decoration: none;
  text-decoration: none;
}

.majoringredient{
    @apply bg-green-50 text-green-800
}

.minoringredient{
    @apply bg-blue-50 text-blue-800
}

</style>
