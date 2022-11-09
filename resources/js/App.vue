<template>
<div class="bg-[#E4DEDA] h-[100%]">
    <main class=" max-w-xl mx-auto h-screen relative bg-white flex flex-col justify-between  ">
        <div class="container mx-auto   flex-1 px-2   " :class="hideoverflow ?'overflow-y-hidden' :'overflow-y-scroll'" id="documentpage">
            <router-view />
        </div>
        <footer class=" end " v-if="!searchResults">
            <Navlinks class="w-full shadow-2xl" />
        </footer>
    </main>
</div>
</template>

<script setup>
import { computed, nextTick, onMounted, ref, watch } from 'vue';
import {useUserStore} from './store/Userstore'
import Api from './api/Api'
import { useRoute } from 'vue-router';
import Navlinks from './views/components/Navlinks.vue';
import getCookie from './api/getCookie'
import {storeToRefs} from 'pinia'
import { useSearchresultsStore } from "./store/searchResultStore";
const searchresultstore = useSearchresultsStore()
const {searchResults} = storeToRefs(searchresultstore)
let hideoverflow = ref(false)


let showNavlinks = ref(true)
let excludedRoutes = ['Login','Register']
let route = useRoute();

const userStore = useUserStore()
const {auth} = storeToRefs(userStore) 
const {getUser} = userStore

const documentPage = computed(()=>document.querySelector('#documentpage'))

watch(()=>route.name, (value)=>{
    if(excludedRoutes.includes(value)){
        showNavlinks.value = false
    }
})

watch(()=>auth.value,(value)=>{
    console.log(value)
})

watch(()=>searchResults.value,(value)=>{
    if(value){
        hideoverflow.value = true
    }else{
        hideoverflow.value = false
    }
})
onMounted(()=>{
    getUser()
})
</script>



<style >

/* .hidescroll{
    scrollbar-width: 0px;
} */
.hidescroll::-webkit-scrollbar{
    width: 1px;
}


</style>