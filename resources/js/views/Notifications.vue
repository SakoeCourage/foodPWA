<template>
  <div class="">
    <div class="h-16 overflow-hidden flex justify-between py-4 sticky top-0 z-20 px-5 bg-white items-center ">
      <nav class="text-lg font-semibold text-gray-600">Notifications</nav>
      <nav class=" text-xs text-gray-500 relative flex items-center  min-w-[20%] ">
      <Transition name="slide-up">
      <span class="flex items-center gap-1 absolute" v-if="notifications.unreadNotifications && !isLoadingNotifications">
      <span  class="h-1 w-1 bg-red-400 rounded-full">&nbsp;</span>
         <span class="text-red-300">{{ notifications.unreadNotifications }} new unread</span>
      </span>
      <span class="flex items-center gap-1 absolute" v-else-if="!notifications.unreadNotifications && !isLoadingNotifications">
          <font-awesome-icon icon="check-double" size="sm"/>
         <span>all read</span>
      </span>
      <span v-else class="absolute">Loading . . .</span>
    </Transition>
        </nav>
    </div>
    <div class="py-1 flex flex-col  px-1 min-h-screen">
     <Notificationitem v-show="notifications.usernotifications" v-for="notification in notifications.usernotifications" :key="notification.id"
    :favoriter="notification.data.user"
    :dishname="notification.data.dish.dishname"
    :type="notification.type"
    :favorited_at="notification.created_at"
    :read_at="notification.read_at"
    :thumbnail="notification.data.dish.image"
    :slug = "notification.data.dish.slug"
    :created_at="notification.data.dish.created_at"
    />
      </div>
  </div>
</template>
<script setup>
import Notificationitem from "./components/Notificationitem.vue";
import { useUserStore } from "../store/Userstore";
import { onMounted,onUnmounted,computed } from "@vue/runtime-core";
import { storeToRefs } from "pinia";
let userstore = useUserStore()
const {getUsernotifications,LoadmoreNotifications} = userstore
const {notifications,isLoadingNotifications} = storeToRefs(userstore)

let documentPage = computed(() => document.querySelector('#documentpage'))
let infinityScroll = () =>{
    let scrolled = documentPage.value.scrollTop +  documentPage.value.getBoundingClientRect().height
    let offsetY =  documentPage.value.firstElementChild.offsetHeight
    let percentagescrolled = (scrolled/offsetY) * 100 
    if((percentagescrolled === 100) && (!isLoadingNotifications.value)){
      if(notifications.value.nextPageUrl){
        LoadmoreNotifications()   
      }
    }

  }

  onMounted(()=>{
    !notifications.value.usernotifications && getUsernotifications()
    documentPage.value.addEventListener('scroll',infinityScroll,true)
  })

  onUnmounted(()=>{
    documentPage.value.removeEventListener('scroll',infinityScroll,true)
  })
</script>

<style scoped>

.slide-up-enter-active,
.slide-up-leave-active {
  transition: all 0.25s ease-out;
}

.slide-up-enter-from {
  opacity: 0;
  transform: translateY(30px);
}

.slide-up-leave-to {
  opacity: 0;
  transform: translateY(-30px);
}
</style>