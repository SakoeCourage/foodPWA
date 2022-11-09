<template>
    <div class="relative bg-gray-100 h-screen">
        <button @click="$router.go(-1)" class="cursor-pointer sticky shadow-lg top-5 left-5 h-9 w-9 bg-orange-400/20 border-gray-100 border  grid place-items-center   rounded-full text-gray-50" >
         <font-awesome-icon icon="arrow-left" size="xs" /></button>
        <div class=" flex items-center justify-center  h-full   relative">
            
            <section class="w-full px-4  md:px-8 ">
                <div class="text-gray-600 mb-8 flex flex-col items-center w-full space-y-4">  <nav class="font-semibold text-2xl">Hello</nav>
                    <nav>Welcome Back</nav>
                </div>
                <form @submit.prevent="fxnLogin">

               
                <div class="  bg-white p-5 my-3 rounded-md transition-all duration-500 ease-linear focus-within:ring-1 ring-orange-600/30 relative flex items-center ">
                    <input class="w-full outline-none focus:outline-none focus:border-none" type="email" placeholder="email" v-model="formData.email"/>
                    <nav v-if="formErrors?.email" class="cursor-pointer font-awesome">
                        <font-awesome-icon icon="warning" class="text-red-400 " />
                        <span class="  text-sm text-red-400  error "> {{ formErrors?.email[0] }}</span>
                    </nav>
                </div> 
                <div class="bg-white p-5 my-3 rounded-md flex items-center transition-all duration-500 ease-linear focus-within:ring-1 ring-orange-600/30 relative">
                    <input class="w-full outline-none focus:outline-none focus:border-none" :type="showpassword ? 'text':'password'" placeholder="Password" v-model="formData.password"/>
                    <font-awesome-icon class="text-gray-300 hover:text-gray-400" :icon="showpassword ? 'eye-slash':'eye'" @click="showpassword=!showpassword"/>
                    <nav class="cursor-pointer font-awesome" v-if="formErrors?.password">
                        <font-awesome-icon icon="warning" class="text-red-400 " />
                        <span class="  text-sm text-red-400  error "> {{ formErrors?.password[0] }}</span>
                    </nav>
                </div> 
                
                <div class="mt-10" >
                    
                    <button class="py-4 flex items-center justify-center w-full bg-orange-500 rounded-lg text-white" :class="isLoading &&'bg-transparent select-none pointer-events-none '"  @click.prevent="fxnLogin">
                        <loadingellipses class="text-orange-100" v-if="isLoading"  />
                        <nav v-else >Sign In</nav>
                    </button>
                </div >
                <div class="mt-10 w-full">
                    <nav class=" text-center relative h-full isolate " >
                        <hr class="border-1 border-gray-300 shadow-md absolute top-[55%] inset-x-0 -z-10 ">
                        <span class="z-[10] bg-gray-100 px-5 text-gray-400">or</span></nav>
                        <nav class="text-center  mt-5 text-sky-500 font-semibold"><router-link :to="{name:'Register'}" >Create an account</router-link></nav>
                
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
import { onMounted, reactive, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useUserStore } from "../store/Userstore";
import {storeToRefs} from 'pinia'
import Api from '../api/Api'
import getCookie from '../api/getCookie'
import User from '../api/User'
import Loadingellipses from './components/Loadingellipses.vue'
const route = useRouter()
const userstore = useUserStore()
const {auth} = storeToRefs(userstore)
const {getUser} = userstore
let showpassword = ref(false)
let formData = reactive({
    email: null,
    password: null
})
let authenticated = ref(false)
let formErrors = ref({})
let isLoading = ref(false)

let fxnLogin = ()=>{
isLoading.value=true 
formErrors.value = {} 


User.login(formData).then((res)=>{
       getUser()
       route.push({name:'AddDish'})
}).catch(error=>{
    if(error.response){
        formErrors.value = error.response.data.errors
        console.log(error.response)
    }
   
}).finally(()=>{
    isLoading.value=false
})
    

}

watch(()=>authenticated.value ,(value)=>{
    if(value === true){
      
    }
})

onMounted(()=>{
    // useRouter().push({name:'AddDish'})
})


</script>
