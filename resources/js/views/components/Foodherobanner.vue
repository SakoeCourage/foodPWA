<template>
    <div>
        <nav class=" ">
          <nav class="flex items-center justify-between mb-2 ">
            <span class=" flex items-center gap-2">
              <span class="h-6 w-6 aspect-square ">
                <img class="object-cover rounded-full w-full h-full" src="../../../../public/foodimages/profile.jpg" alt="">
              </span>
            <span class="flex flex-col text-sm gap-0 leading-none">
              <span class="text-gray-800 font-semibold">{{ author_name }}</span>
              <span class="text-xs text-gray-400">{{ diffForHumans(created_at) }}</span>
            </span>
          </span>
            <span class=" cursor-pointer" @click="showMenu=!showMenu">
              <font-awesome-icon icon="ellipsis-v" :class="showMenu && 'text-primaryorange'"/>
            
            </span>
           

          </nav>
         <nav class=" aspect-[4/2] overflow-hidden  rounded-md block relative">
        
            <Transition name="fade">
            <nav class="absolute  z-20 grid place-items-center inset-0 rounded-md bg-gray-50/50  " v-if="showMenu">
                <ul class="text-sm text-gray-500 p-4 bg-gray-50 rounded-md w-max px-4 ">
                  <li class="flex mb-1 items-center gap-2 border-b"><font-awesome-icon class="text-red-300" icon="heart"/><span>add to favourites</span></li>
                  <li class="flex mb-1 items-center gap-2 border-b"><font-awesome-icon class="text-red-300" icon="heart-circle-xmark" /><span>remove from favourites</span></li>
                  <li class="flex mb-1 items-center gap-2"><font-awesome-icon class="text-red-300" icon="trash" /><span>remove dish</span></li>
                  
                </ul>
            </nav>
          </Transition>
          
           <img class=" object-cover transform w-full h-full  " :src="setImage(created_at,thumbnail)" alt="">
           <router-link :to="'/viewdish/'+slug" >
            
             <nav class="absolute inset-0  bg-gray-400/10 z-10">
               <nav class="w-full h-full relative">
                 <span class="absolute top-5 right-5 px-2 rounded-md bg-orange-100 text-orange-600">{{ difficulty }}</span>
                 <nav class="absolute bottom-0 h-[30%] w-full bg-gradient-to-b from-gray-400/10 to-gray-400/50 flex items-end pl-5 pb-5 ">
                   <router-link :to="'/viewdish/'+slug" class=" text-blue-50 underline  font-semibold">{{ dish_name }} </router-link>
                  </nav>
                </nav>
              </nav>
            </router-link>
         </nav>
        </nav>
    </div>
</template>

<script setup>
import { ref,defineProps, onMounted } from "vue";
import {setImage,diffForHumans} from '../../api/Util'
;
  let props = defineProps(['created_at','author_name','thumbnail','dish_name','difficulty','slug'])
  let showMenu = ref(false)

</script>


<style scoped>

.fade-enter-active{
  transition: all 0.5s ease;
}
.fade-leave-active {
  transition: all 0.5s ease;
}

.fade-enter-from{
  transform: scale(1.1);
  opacity: 0;
}
.fade-leave-to {
  opacity: 0;
  transform: scale(1.1);

 
}


</style>