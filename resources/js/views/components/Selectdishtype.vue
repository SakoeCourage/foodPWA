<template>
    <div>
         <button v-show="dishtypes" v-for="dishtype in dishtypes" :key="dishtype.id" 
         :class="selectedDishType == Number(dishtype.id) ? 'active': ' inactive '"
         class="min-w-[5rem] rounded-lg my-1 mx-[0.15rem]  p-1 px-2 text-sm  "
               
         @click="$emit('setDishById', dishtype.id)"
         >{{ dishtype.dishtype }}</button>
       </div>
</template>

<script setup>
import {onMounted, ref, defineProps} from 'vue'
import Api from '../../api/Api'
let dishtypes = ref(null)
let props = defineProps({
    selectedDishType: Number
})
onMounted(()=>{
    Api.get('/dish/getdishtypes').then(res=>{
        dishtypes.value = res.data
    }).catch(error=>{
        console.log(error.response)
    })
})



</script>

<style scoped>

.active{
@apply border  border-orange-200/80 bg-orange-300/80 text-white
}
.inactive{
@apply bg-gray-100 text-gray-500
}
</style>