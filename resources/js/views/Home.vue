<template>
    <div class="px-5 ">
      <section class="mb-2 sticky top-0 bg-white z-20 backdrop-blur-sm  ">
        <div class="relative">
         <Searchbar />
         <transition name="zoom-in">
           <Searchresults v-if="searchResults" class="absolute min-h-screen   bg-gray-50/90 backdrop-blur-sm w-full z-50  overflow-x-hidden " />
          </transition>
        </div>
      </section>
        <section  >
          <nav class="bg-primaryorange/10 p-5 rounded-md tipsbanner relative mx-5" data-tipscount="3">
            <span class="text-orange-500/80 font-bold block ">Daily Tips</span>
            <button class="flex gap-2 items-center rounded-md px-2 text-sm text-[#B3A094] mt-2 outline-[#B3A094] outline-dashed outline-1 hover:bg-orange-100 hover:outline-white hover:outine-2 "><span>view</span><font-awesome-icon icon="arrow-circle-right" size="sm" /> </button>
          </nav>
        </section>
        <section class="mt-5 ">
         <nav class="mb-5 font-bold text-gray-800/80 text-2xl "> {{ auth.user?.name  }}</nav>
          <Foodherobanner v-if="featureddish"
            :created_at="featureddish.created_at"
            :author_name="featureddish.user.name"
            :thumbnail="featureddish.image"
            :dish_name="featureddish.dishname"
            :difficulty="featureddish.difficulty"
            :slug="featureddish.slug"
          />
          <Dishfeaturedskeleton v-if="!featureddish" />
        </section>
            <Filter class="my-4 pb-2 rounded-md bg-orange-50/50" />
        <section class="mt-5">
          <div class="grid grid-cols-2 gap-4" >
            <Minifoodbanner  v-show="alldish" v-for="dish in alldish" :key="dish.id"
            :created_at="dish.created_at"
            :author_name="dish.user.name"
            :thumbnail="dish.image"
            :dish_name="dish.dishname"
            :difficulty="dish.difficulty"
            :slug="dish.slug"
            />
            <Dishloadingskeleton v-show="loadingAllDish"  v-for="(x,i) in 4" :key="i" />
            
          </div>
          <div v-if="alldish?.length == 0">
              <Emptyresult />
          </div>

        </section>
    </div>
</template>
 <script setup>
  import {computed, nextTick, onBeforeUnmount, onMounted, onUnmounted, ref, watch} from 'vue'
  import { useFoodStore } from '../store/Foodstore';
  import {useSearchresultsStore} from '../store/Searchresultstore' 
  import {useRoute,useRouter} from 'vue-router'
  import Api from '../api/Api';
  import Foodherobanner from './components/Foodherobanner.vue';
  import Minifoodbanner from './components/Minifoodbanner.vue';
  import Searchbar from './components/Searchbar.vue'
  import Searchresults from './components/Searchresults.vue'
  import Dishfeaturedskeleton from './components/Dishfeaturedskeleton.vue';
  import Emptyresult from './components/Emptyresult.vue';
  import Filter from './components/Filter.vue';
  import { useUserStore } from "../store/Userstore";
  import Dishloadingskeleton from './components/Dishloadingskeleton.vue';
  import {storeToRefs} from 'pinia'
  let fooditem = ref(null)
  const userstore = useUserStore()
  const {auth} = storeToRefs(userstore)
  const foodstore = useFoodStore()
  const searchresultstore = useSearchresultsStore()
  const {searchResults} = storeToRefs(searchresultstore)
  const {getAllDish,getfeaturedDish,LoadmoreDish} = foodstore
  const {featureddish,alldish, loadingAllDish,nextPageUrl } = storeToRefs(foodstore)
 
  let documentPage = computed(() => document.querySelector('#documentpage'))
  
  let infinityScroll = ()=>{
    let scrolled = documentPage.value.scrollTop +  documentPage.value.getBoundingClientRect().height
    let offsetY =  documentPage.value.firstElementChild.offsetHeight
    let percentagescrolled = (scrolled/offsetY) * 100 
    if((percentagescrolled === 100) && (!loadingAllDish.value)){
      if(nextPageUrl.value){
        LoadmoreDish()   
      }
    }

  }

  onMounted(()=>{
    !alldish.value && getAllDish()
    !featureddish.value && getfeaturedDish()
    documentPage.value.addEventListener('scroll',infinityScroll,true)
  })

  onUnmounted(()=>{
    documentPage.value.removeEventListener('scroll',infinityScroll,true)
  })


 </script>

<style scoped>

@font-face {
    font-family: Poppins-Medium;
    src: url('../fonts/poppins/Poppins-Medium.ttf');
}

#app {
  font-family: Poppins-Medium;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

.Poppins-Medium{
      font-family: Poppins-Medium;
}
  .tipsbanner::before{
    content: attr(data-tipscount);
    position: absolute;
    background-color:white ;
    top: 30%;
  
    height: 30%;
    width: max-content;
   
    @apply rounded-full p-3 aspect-square flex items-center justify-center border-4 border-white  bg-orange-500/80 text-white -left-5

  }

    
.zoom-in-enter-active,
.zoom-in-leave-active {
  transition: all 0.25s ease-out;
}

.zoom-in-enter-from {
  opacity: 0;
  transform: translateY(5px);
}

.zoom-in-leave-to {
  opacity: 0;
  transform: translateY(5px);
}
</style>