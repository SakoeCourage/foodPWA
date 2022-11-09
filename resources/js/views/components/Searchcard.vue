<template>
    <router-link :to="`/viewdish/${slug}`">
    <nav class=" px-4 py-2 text-sm flex items-center gap-2 justify-center bg-white rounded-lg border shadow-md   hover:bg-gray-50/20 ">
        <img class="object-cover aspect-square h-auto w-1/5  rounded-lg " :src="setImage(created_at,image)" alt="">
        <div class="flex flex-col justify-between p-2 leading-normal grow py-2 ">
            <h5 class="text-xs text-orange-400/80 ">{{ dishType }}</h5>
            <h5 class="my-1 text-sm text-gray-900 font-semibold  ">{{ dishname }}</h5>
            <nav class="flex items-center gap-1 text-xs justify-self-end mt-4 ">
                <span class="bg-gray-200/80 px-2 py-1 rounded-sm flex items-center justify-center gap-1">
                    <font-awesome-icon icon="object-group" class="text-gray-400" /> <nav>{{ difficulty }}</nav>
                </span>
                <span class="bg-gray-200/80 px-2 py-1 rounded-sm flex items-center justify-center gap-1">
                    <font-awesome-icon icon="clock" class="text-gray-400" /> <nav>{{ diffForHumans(created_at) }}</nav>
                </span>
                <span class="bg-gray-200/80 px-2 py-1 rounded-sm flex items-center justify-center gap-1">
                    <font-awesome-icon icon="heart" class="text-gray-400" /> <nav>5 favourites</nav>
                </span>
            </nav>
        </div>
    </nav> 
    </router-link>
</template>
<script setup>
import { defineProps } from 'vue';
import {setImage,diffForHumans} from '../../api/Util'
let props = defineProps({dishType:String,dishname:String,difficulty:String,created_at:String,image:String,slug:String})
</script>