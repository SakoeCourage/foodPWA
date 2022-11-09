<template>
    <div  class="h-full overflow-hidden flex flex-col ">
       <div class=" mt-2 hidescroll  overflow-x-scroll py-3">
        <Searchresultfilter /> 
       </div> 
       <div class="  space-y-2 flex flex-col overflow-y-scroll grow pb-20 " id="searchResultPane" >
            <Searchcard v-for="result in searchResults" 
            :key="result.id"
            :image="result.image"
            :created_at="result.created_at"
            :difficulty="result.difficulty"
            :dishname="result.dishname"
            :dishType="result.dishtype.dishtype"
            :slug ="result.slug"
            /> 
            <div v-if="searchResults.length==0" class="w-full h-full  grid place-items-center">
                <Emptyresult />
            </div>    
       </div>

    </div>
</template>

<script setup>
import Searchresultfilter from './Searchresultfilter.vue';
import Searchcard from './Searchcard.vue';
import Emptyresult from './Emptyresult.vue';
import {storeToRefs} from 'pinia'
import {useSearchresultsStore} from '../../store/Searchresultstore'
import {useRoute} from 'vue-router'
import { computed, nextTick, onMounted,onUnmounted,ref, watch, } from 'vue';
const searchresultstore = useSearchresultsStore()
const {searchResults,isLoading,nextPageUrl,scrollTop} = storeToRefs(searchresultstore)
const {LoadmoreDish} = searchresultstore
const route = useRoute()

let searchResultPane = computed(()=>document.querySelector('#searchResultPane'))

let infinityScroll = () =>{
    let scrolltop = searchResultPane.value.scrollTop
    let outof = searchResultPane.value.scrollHeight - searchResultPane.value.offsetHeight
    let percentagescrolled = (scrolltop/outof) * 100
    if((percentagescrolled === 100) && (!isLoading.value)){
      if(nextPageUrl.value){
        LoadmoreDish()   
      }
    }
}

watch(route,(to,from)=>{
    if(to){
       scrollTop.value = searchResultPane.value.scrollTop
    }
})

onMounted(()=>{
    if(scrollTop.value){
        nextTick().then(()=>{
         searchResultPane.value.scrollTo({
            top: scrollTop.value
        })
        })
    }
    searchResultPane.value.addEventListener('scroll',infinityScroll,true)

})


onUnmounted(()=>{
    searchResultPane.value.removeEventListener('scroll',infinityScroll,true)
})
</script>