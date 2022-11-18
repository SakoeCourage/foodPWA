<template>
    <div>
        <nav class="flex flex-col items-center h-full gap-2">
                <span class="text-sm tracking-wide text-gray-400 mb-5 ">preference</span>
                <button @click="emitandsetpreference(1)" class="px-5 border border-gray-300 rounded-md py-2 w-full flex items-center justify-center" :class="preference == 1 && 'active'"> I'm a chef or cook  
                    <font-awesome-icon v-if="preference == 1" icon="check" class="ml-3"/>  
                 </button>
                <button @click="emitandsetpreference(2)" class="px-5 border border-gray-300 rounded-md py-2 w-full flex items-center justify-center " :class="preference == 2 && 'active'"> I'm here to view dishes  
                    <font-awesome-icon v-if="preference == 2" icon="check" class="ml-3"/>    
                </button>
                <button @click="emitandsetpreference(3)" class="px-5 border border-gray-300 rounded-md py-2 w-full flex items-center justify-center " :class="preference == 3 && 'active'">I do both  
                    <font-awesome-icon v-if="preference == 3" icon="check" class="ml-3"/>    
                </button>
            </nav>
    </div>
</template>
<script setup>
import { onMounted, ref,defineEmits, watch,defineProps } from 'vue';
import Api from "../../api/Api"
let preference = ref(null)
let emits = defineEmits(['set-movable','set-preference','next','isLoading'])
let props = defineProps(["upload","currIndex"])
watch(()=>preference.value,(value)=>{
    value && emits('set-movable',true)
})
watch(()=>props.upload,()=>{
       emits('isLoading',true)   
      Api.post('/profile/createorupdate',{'preference': preference.value}).then(res=>{
                console.log(res.data)
                emits('isLoading',false)
                emits('next')
             }).catch(err=>{
                emits('isLoading',false)
                console.log(err.response)
             })
  
})
let emitandsetpreference = (i) =>{
    preference.value = i
    emits('set-preference',preference.value)
}
onMounted(()=>{
     emits('set-movable',false)
})
</script>
<style scoped>
.active{
    @apply bg-orange-50 text-orange-500 border-none
}
</style>