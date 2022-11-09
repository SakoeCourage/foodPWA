<template>
    <div>
        <div v-for="(index,i) in procedures" :key="i" class="inputholder relative   py-2 flex items-center overflow-hidden">
                
                <div class=" w-5   px-2 h-max  rounded-full bg-orange-300/80 text-white text-sm flex items-center justify-center stepindex transiton-all duration-700  " :class="(i == 0 && (currentProcedureIndex) > 1) && 'first' 

            || (i > 0 && (currentProcedureIndex) - i != 1) && ' visited active' 
            || (i > 0 && (currentProcedureIndex) > 1) && 'active' 
            "><span>{{ i + 1 }}</span></div>
           
            <input ref="lastInputitem" @keypress.enter="increaseIndex" v-model="procedures[i]" @input="updateprocedures(i,$event)" class="bg-yellow-50/60  w-full pl-4  p-2 focus:outline-none focus:border-none rounded-md text-gray-400 text-sm ring-orange-200 ring-offset-1 focus:ring-2 transition-all ease-out duration-150" type="text" name="" id="" placeholder="">
            <button v-if="(currentProcedureIndex)>1" class="deletebtn hidden "><font-awesome-icon @click="removeItemat(i)" icon="trash" class="text-yellow-600" /></button>
            </div>
            <div class="flex justify-center gap-2">

                <button  @click.enter.prevent="increaseIndex" class="py-3 px-6 text-gray-300 bg-gray-50/20  border border-gray-300 w-max text-xs rounded-md border-dashed ">
                    
                    <font-awesome-icon icon="plus-circle" size="lg" />
                </button>
            </div>  
    </div>
</template>
<script setup>
import {ref, computed,defineEmits,nextTick} from 'vue'
let procedures = ref([""])
let lastInputitem = ref(null)
let emits = defineEmits(["get-procedures"])

let currentProcedureIndex = computed(()=>procedures.value.length)
let increaseIndex = () => {
        if(procedures.value[currentProcedureIndex.value - 1] != ""){
            procedures.value.push(
                ""
        )
        nextTick(()=>lastInputitem.value[currentProcedureIndex.value - 1].focus())
        }
         
}

let updateprocedures=(i,e)=>{
    let currentItem = procedures.value[i]
    currentItem = e.target.value
    emits('get-procedures',procedures.value)    
}

let removeItemat= (i) =>{
    procedures.value = procedures.value.filter((item,index)=> index != i )
    emits('get-procedures',procedures.value)  
}


</script>


<style scoped>

.inputholder:hover .deletebtn{
    display: inline;
}
.stepindex {

    z-index: 10;
}

.stepindex.first::before {
    content: '';
    position: absolute;
    height: 100%;
    z-index: 10;

    width: 2px;
    @apply bg-inherit top-[65%]
}

.stepindex.active::before {
    content: '';
    position: absolute;
    height: 40%;
    z-index: 0;

    width: 2px;
    @apply bg-inherit -top-[1%]
}

.stepindex.visited::before {
    content: '';
    position: absolute;
    height: 40%;
    z-index: 1;

    width: 2px;
    @apply bg-inherit top-0
}

.stepindex.visited::after {
    content: '';
    position: absolute;
    height: 40%;
    z-index: 1;

    width: 2px;
    @apply bg-inherit bottom-0
}
</style>