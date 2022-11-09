<template>
    <div>
        
<div class="bg-white ">
    
        
            <dl v-if="procedures">
            <div v-for="procedure in procedures" :key="procedure.id" class="bg-blue-100/30 shadow  px-4 py-2  sm:gap-4 sm:px-6 my-4 rounded-lg relative overflow-hidden ">
                <dt class="absolute top-0 left-0 text-xs bg-primaryorange w-4 grid place-items-center text-white font-medium ">
                  {{ procedure.index }}
                </dt>
                <dd class="text-xs mt-1   text-gray-600 sm:mt-0 ">
                    {{ procedure.procedure }}
                </dd>
            </div>
            
        </dl>
       
    </div>


    </div>
</template>
<script setup>
import {defineProps } from "vue";
import Api from "../../api/Api";
    let props = defineProps({
        procedures: Array
    })

</script>