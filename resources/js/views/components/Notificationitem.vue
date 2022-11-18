<template>
  <router-link :to="'/viewdish/'+slug" class="">
    <div class="flex items-center p-4 bg-white shadow-md  w-full relative shadow-pr ">
    <!-- <span v-if="!read_at" class="text-xs  uppercase px-2 mt-2 mr-2 text-red-500 bg-red-100 border rounded-full absolute top-0 right-0">New</span> -->
    <span class="text-xs font-semibold  m-1 py-1 mr-3 text-gray-500 absolute bottom-0 right-0 flex items-center gap-2"> 
      <font-awesome-icon icon="clock" />
      {{ diffForHumans(favorited_at) }}</span>

    <img class="h-12 w-12 rounded-full" alt="John Doe's avatar"
        :src="setImage(created_at,thumbnail)" />

    <div class="ml-5">
        <p class="text-sm text-gray-600"><b>{{ favoriter }}</b> added your food <i><u>{{ dishname }} </u></i> as a favorite</p>
   </div>
  </div>
</router-link >
</template>
<script setup>
import {defineProps} from 'vue'
import {setImage,diffForHumans} from '../../api/Util'
let props = defineProps({
    favoriter:String,type:String, favorited_at:String,dishname:String,thumbnail:String,read_at:String,
    slug:String,created_at:String
})
</script>

<style scoped>
.shadow-pr{
  box-shadow: rgba(0, 0, 0, 0.005) 0px 1px 0px 0px, rgb(209, 213, 219) 0px 1px 0px 0px inset;
}
</style>