<template>
    <button @click="toggleLike" class=" px-2 py-2 text-white bg-orange-500/50 rounded-md   text-xl">
        <nav class="flex items-center gap-1">
            <span class="text-sm">{{ favoritesCount }}</span>
            <font-awesome-icon icon="heart" class=""/>
        </nav>
    </button>
</template>
<script setup>
import {defineProps, onMounted} from 'vue'
import Api from '../../api/Api';
let props = defineProps({id:Number,favoritesCount:Number})
onMounted(()=>{
    console.log(props.id)
})
let toggleLike=()=>{
    Api.get(`/dish/togglefavorites/${props.id}`).then((res)=>{
        console.log(res.data)
    }).catch(err=>{
        console.log(err.response.data)
    })
}
</script>