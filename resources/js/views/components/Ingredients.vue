<template>
    <div>
        <div class="text-gray-400 grid grid-cols-3 pt-2 rounded-md  bg-yellow-50/50 ring-orange-200 ring-offset-1 focus-within:ring-2 transition-all ease-out duration-150" @click="$refs.inputaddIngredient.focus()">
                <TransitionGroup tag="ul" name="list" class="  col-span-3  px-1 min-h-[8rem]   flex  py-1 gap-2 flex-wrap">
                    <li v-for="(item,i) in foodIngredient" :key="i" @dblclick="removeIngredient(i)" class="border-gray-300 user-select-none cursor-pointer border shadow-sm min-h-min leading-tight flex items-center bg-transparent text-red-400 p-1 px-3 rounded-md h-min text-sm relative hover:shadow-md">{{ item.ingredient }}
                        <font-awesome-icon @click="removeIngredient(i)" icon="close" class=" pl-1 cursor-pointer text-red-200 p-1  ml-1 hover:text-red-300" size="sm"/>
                    </li>
                    <div class="self-end flex items-center w-full  gap-2  " :key="100">
                        <input  ref="inputaddIngredient" @keypress.enter.prevent="addIngredient" v-model="currentingredient" type="text" class=" h-max flex-grow  mt-1 p-1 text-sm placeholder:opacity-50 inline focus:border-none focus:outline-none  bg-inherit text-gray-400 placeholder:text-gray-400 " placeholder="Enter ingredient name and hit Enter">
                        <nav class="text-xs text-gray-400 flex items-center gap-2 justify-self-end   w-max">
                            <label for="important" >Mark as important ingredient</label>
                            <input name="important" type="checkbox" v-model="markasImportant" class="  accent-primaryorange rounded-full border-gray-100"  id="">
                        </nav>
                    </div>    
                </TransitionGroup>
                <span></span>
                <span class="col-span-3">
                    <div>
                </div>
                 
                </span>

            </div>
    </div>
</template>

<script setup>
import {ref, defineEmits } from 'vue'
let emits = defineEmits(["get-ingredients"])
let foodIngredient = ref([])
let currentingredient = ref()
let markasImportant = ref(true)
let addIngredient = () =>{
    if(currentingredient.value){
        foodIngredient.value.push({
            ingredient: currentingredient.value,
            majoringredient: markasImportant.value
        })  
        currentingredient.value = ""  
        markasImportant.value = true

    }
    emits('get-ingredients',foodIngredient.value)
}

let removeIngredient =(index)=>{
    let newItems =  foodIngredient.value.filter((item,i)=>{
        return i !=index
    })
    foodIngredient.value = newItems
    emits('get-ingredients',foodIngredient.value)

}

</script>
<style>
.user-select-none{
    user-select: none;
}


.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}


.list-leave-to{
 
}
.list-enter-from {
  opacity: 0;
  transform: scale(0.5);
}


.list-leave-active {
  opacity: 0;
  transform: scale(0);
  position: absolute;
}
</style>