<template>
    <div class=" h-full px-2 w-full ">
        <div class="text-sm tracking-wide text-gray-400 mb-5 text-center w-full  ">restaurant</div>
        <nav class="flex flex-col items-center p-2 bg-yellow-50/60">
        <label for="" class="mt-5">
            do you owned a restaurant or eatery?
        </label>
        <nav class="flex items-center gap-2">
            <label  for="">Yes</label>
            <input v-model="restaurant" type="radio" value="1" name="restaurant" id="">
        </nav>
        <nav class="flex items-center gap-2">
            <label for="">No</label>
            <input v-model="restaurant" type="radio" value="0" name="restaurant" id="">
        </nav>
        </nav>
        <nav class="w-full" v-if="restaurant=='1'">
            <input @input="checkIfNo" type="text" v-model="restaurant_name" class=" bg-yellow-50/60 w-full my-4  border border-orange-100  p-2 focus:outline-none focus:border-none rounded-md  text-gray-400 text-sm  ring-orange-200 ring-offset-1 focus:ring-2 transition-all ease-out duration-150" placeholder="name of restaurant or eatery">
            <input @input="checkIfNo" type="text" v-model="restaurant_location" class="bg-yellow-50/60 w-full  border border-orange-100 p-2 focus:outline-none focus:border-none rounded-md  text-gray-400 text-sm  ring-orange-200 ring-offset-1 focus:ring-2 transition-all ease-out duration-150" placeholder="location or address">
        </nav>
    </div>
</template>
<script setup>
import {ref, watch,defineEmits, onMounted,defineProps} from 'vue'
import Api from '../../api/Api'
let restaurant = ref()
let restaurant_name = ref()
let restaurant_location = ref()
let props = defineProps(["upload","currIndex"])
let emits = defineEmits(['set-movable','set-restaurant','set-restaurant-location','set-restaurant-name','next','isLoading'])


let checkIfNo = () =>{
    if(restaurant.value && restaurant_name.value && restaurant_location.value){
        emits('set-movable', true)
    }else{
        emits('set-movable', false)
    }
}
watch(()=>props.upload,()=>{
    emits('isLoading',true)
     Api.post('/profile/createorupdate',{
        'ownsrestaurant': restaurant.value,
        'restaurant_name': restaurant_name.value,
        'restaurant_location': restaurant_location.value
     }).then(res=>{
                console.log(res.data)
                emits('isLoading',false)
                emits('next')
             }).catch(err=>{
                emits('isLoading',false)
                console.log(err.response)
             })
})

watch(()=>restaurant.value,(value)=>{
    if(value=='0'){
        emits('set-movable',true)
        emits('set-restaurant',restaurant.value)
    }else{
        restaurant_name.value = null
        restaurant_location.value = null
        checkIfNo()

    }
})
onMounted(()=>{
    emits('set-movable', false)
})


</script>