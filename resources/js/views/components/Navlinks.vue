<template>
    <div>
        <nav class="flex items-center justify-evenly gap-5 text-[#B6BAC1] py-1  ">
            <router-link to="/">
                <font-awesome-icon icon="home" size="lg" />
                <!-- home -->
            </router-link>
            <router-link to="/meetup">
                <font-awesome-icon icon="user" size="lg" />
            </router-link>
            <router-link to="/add" class="bg-primaryorange shadow-lg shadow-gray-400 addfood p-1 px-3 grid place-items-center aspect-square rounded-full  text-white ">
                <font-awesome-icon icon="plus" size="xl" />
            </router-link>
            <router-link to="/notifications" class="relative">
                    <Unreadcount />
                    <font-awesome-icon icon="bell" size="lg" />
            </router-link>
            <router-link to="/settings">
                <font-awesome-icon icon="gear" size="lg"/>
            </router-link>
        </nav>
    </div>
</template>
<script setup>
import Unreadcount from './Unreadcount.vue';
    
</script>


<style scoped>
.router-link-active.router-link-exact-active{
    @apply text-primaryorange/50 transition-transform duration-500 transform scale-105
}
.router-link-active.router-link-exact-active.addfood{
    @apply text-white  ring-primaryorange ring-1 ring-offset-1 transform scale-100
}

.addfood{

}

</style>