<template>
    <div class="relative bg-gray-100 h-screen">
        <button @click="$router.go(-1)" class="cursor-pointer sticky shadow-lg top-5 left-5 h-9 w-9 bg-orange-400/20 border-gray-100 border  grid place-items-center   rounded-full text-gray-50" >
         <font-awesome-icon icon="arrow-left" size="xs" /></button>
        <div class=" flex items-center justify-center  h-full   relative">
            
            <section class="w-full px-4  md:px-8 ">
                <form @submit.prevent="fxnSubmitForm">
                <div class="text-gray-600 mb-8 flex flex-col items-center w-full space-y-4">  <nav class="font-semibold text-2xl">Hello</nav>
                    <nav>create account below</nav>
                </div>
                <div class=" input-group  bg-white p-5 my-3 rounded-md transition-all duration-500 ease-linear focus-within:ring-1 ring-orange-600/30 relative flex items-center ">
                    <input class="w-full outline-none focus:outline-none focus:border-none" type="text" placeholder="username" v-model="formData.name" />
                    <nav class="cursor-pointer font-awesome" v-if="errors.name">
                        <font-awesome-icon icon="warning" class="text-red-400 " />
                        <span class="  text-sm text-red-400  error "> {{ errors.name[0] }}</span>
                    </nav>
                    
                    
                </div>
                <div class=" input-group  bg-white p-5 my-3 rounded-md transition-all duration-500 ease-linear focus-within:ring-1 ring-orange-600/30 relative flex items-center ">
                    <input class="w-full outline-none focus:outline-none focus:border-none" type="text" placeholder="email" v-model="formData.email" />
                    <nav class="cursor-pointer font-awesome" v-if="errors.email">
                        <font-awesome-icon icon="warning" class="text-red-400 " />
                        <span class="  text-sm text-red-400  error ">{{ errors.email[0] }}</span>
                    </nav>
                    
                    
                </div> 
                <div class="bg-white p-5 my-3 rounded-md flex items-center transition-all duration-500 ease-linear focus-within:ring-1 ring-orange-600/30 relative">
                    <input class="w-full outline-none focus:outline-none focus:border-none" type="password" placeholder="Password" v-model="formData.password"/>
                    <nav class="cursor-pointer font-awesome" v-if="errors.password">
                        <font-awesome-icon icon="warning" class="text-red-400 " />
                        <span class="  text-sm text-red-400  error "> {{ errors.password[0] }}</span>
                    </nav>      
                </div> 
                <div class="bg-white p-5 my-3 rounded-md flex items-center transition-all duration-500 ease-linear focus-within:ring-1 ring-orange-600/30">
                    <input class="w-full outline-none focus:outline-none focus:border-none" type="password" placeholder="confirm password" v-model="formData.password_confirmation" />
                         
                </div> 
                
                <div class="mt-10" >
                    <button class="py-4 flex items-center justify-center w-full bg-orange-500 rounded-lg text-white" :class="isLoading && 'bg-transparent'">
                        <nav v-if="!isLoading">Create my account</nav>
                         <Loadingellipses v-else />

                    </button>
                </div >
                <div class="mt-10 w-full">
                    <nav class=" text-center relative h-full isolate " >
                        <hr class="border-1 border-gray-300 shadow-md absolute top-[55%] inset-x-0 -z-10 ">
                        <span class="z-[10] bg-gray-100 px-5 text-gray-400">or</span></nav>
                        <nav class="text-center  mt-5 text-sky-500 font-semibold"><span class="text-gray-400">Already a member?</span> 
                            <router-link :to="{name:'Login'}" >Login</router-link>

                        </nav>
                
                        <div class="flex w-full justify-center mt-5">
                         <router-link to="/" class="p-1 border-2 border-white px-3 text-white bg-orange-500/20 rounded-md"> <font-awesome-icon icon="home" /></router-link>
                        </div> 
                 </div>

                </form>
                </section>  
              
                
            </div>
           
            
    </div>
        </template>
<script setup>
import { reactive,ref } from "vue";
import {useRouter} from 'vue-router'
import User from '../api/User'
import Loadingellipses from "./components/Loadingellipses.vue";
const route = useRouter()
let formData = reactive({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
})
let isLoading = ref(false)
let errors=ref({})
let fxnSubmitForm = async () =>{
try {
    isLoading.value=true
    let data = await User.register(formData)
    route.push({name:'Login'})
} catch (error) {
    if(error){
        errors.value = error.response.data.errors
    }
   isLoading.value = false
}

}

</script>

<style >

.font-awesome .error{
    @apply hidden
}
.font-awesome:hover .error{
   @apply inline right-10 absolute backdrop-blur-sm bg-white/30
}
</style>
