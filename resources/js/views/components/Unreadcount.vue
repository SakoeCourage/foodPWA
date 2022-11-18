<template>
   <span v-if="notifications.unreadNotifications " class="absolute top-[-70%] text-red z-20 right-[-50%] text-white text-xs bg-red-500 h-5 w-5 p-1 flex items-center justify-center  rounded-full">
   {{notifications.unreadNotifications ?? ' '}}
</span>
</template>
<script setup>
    import { useUserStore } from '../../store/Userstore';
    import {storeToRefs} from 'pinia'
    import { onMounted } from '@vue/runtime-core';
    let userstore = useUserStore();
    const {notifications} = storeToRefs(userstore)
</script>