<template>
  <Transition appear name="slide">
    <div class="h-screen relative">
        <font-awesome-icon class="absolute top-5 right-5 text-gray-500 bg-gray-100 p-2 px-3 rounded-full" icon="close" />
        <div class=" grid place-items-center h-full">
        <!-- remove bg-gray-later -->
        <nav class=" h-[50%] w-[70%] relative  ">
            <Transition name="slide-x">
            <Selectprofileimage class="absolute inset-0"
             :currIndex="currIndex"
             :upload="uploadatcurrIndex"
             v-if="currIndex ==1" @set-movable='setMovable' @next="next" 
             @isLoading = 'setisLoading'
             name="profileimage" /> 
            <Profilepreference
            :currIndex="currIndex"
            :upload="uploadatcurrIndex"
            class="absolute inset-0" v-else-if="currIndex == 2" @set-movable='setMovable' @next="next" 
            @isLoading = 'setisLoading'
            />
            <Profilerestaurant
            :upload="uploadatcurrIndex"
            :currIndex="currIndex"
            class="absolute inset-0" v-else  @set-movable='setMovable' @next="finish" 
            @isLoading = 'setisLoading'
            />
          </Transition>
        </nav>
        <div role="status" v-if="isLoading" class="absolute bottom-10">
        <svg aria-hidden="true" class="mr-1 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Loading...</span>
        </div>
        <button v-if="movable && !isLoading" @click="uploadCurrentData" class="absolute bottom-10 bg-blue-600 text-white px-4 py-1 rounded-2xl  shadow-xl shadow-gray-500">next</button>
    </div>
    </div>
  </Transition>
</template>
<script setup>
import Selectprofileimage from './components/Selectprofileimage.vue';
import Profilepreference from './components/Profilepreference.vue';
import Profilerestaurant from './components/Profilerestaurant.vue';
import{ref,reactive} from 'vue'
import {useRouter} from 'vue-router'
const router = useRouter()
let movable = ref(false)
let currIndex = ref(1)
let uploadatcurrIndex = ref(false)
let isLoading = ref(false)

let uploadCurrentData = () =>{  
    uploadatcurrIndex.value = !uploadatcurrIndex.value
}
let setisLoading =(value)=>{
    isLoading.value = value
}
let next =() =>{
     currIndex.value++ 
}
let finish = () => {
  router.push({name:'Home'})
}
let setMovable = (value) =>{
    movable.value = value
}
let moveToPrevious = () =>{
    currIndex.value -- 
}


</script>

<style scoped>

.slide-x-enter-active,
.slide-x-leave-active {
  transition: all 0.25s ease-out;
}

.slide-x-enter-from {
  opacity: 0;
  transform: translateX(30px);
}

.slide-x-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}

.slide-enter-active {
	animation: slide 0.4s;
}

.slide-leave-active {
	animation: slide 0.4s reverse;
}
@keyframes slide {
	0% {
		transform: translate3d(0, 100%, 0);
	}
	100% {
		transform: none;
	}
}

</style>
