<template>
    <div>
        <nav class="text-sm text-gray-500 w-full">
                    <span class=" mx-auto h-16 w-16 p-4  rounded-full mb-4 flex items-center justify-center text-gray-400 bg-gray-200  "><font-awesome-icon icon="magnifying-glass" class="" size="xl" /></span>
                    <span class=" text-lg block text-center">No results found</span>
                    <span class="mt-1 text-center test-sm  block">Try adjusting your search or filter to find what you want</span>
                    <router-link :to="{ name:'AddDish' }" class=" text-sm block text-center mt-5 text-blue-500 underline">add new dish</router-link>
                </nav>
    </div>
</template>