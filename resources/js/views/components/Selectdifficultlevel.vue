<template>
         <nav>
         <button v-for="(level,i) in difficultyLevels" :key="i"  
               :class="selectedLevel==level ? 'active': ' inactive '"
               class="min-w-[5rem] rounded-lg  p-1 px-2 text-sm mx-1  "
                @click="$emit('setdifficultyLevel', level)"
               >{{ level }}</button>
            </nav>
</template>

<script setup>
import { defineProps } from 'vue';

let difficultyLevels = ['Easy','intermediate','Expert']

let props = defineProps({
    selectedLevel: String
})

</script>

<style scoped>
.active{
@apply border  border-orange-200/80 bg-orange-300/80 text-white
}
.inactive{
@apply bg-gray-100 text-gray-500
}
</style>