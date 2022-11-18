<template>
    <div>
        <section>
            <nav class=" w-full aspect-[3/2] bg-gray-100 relative">
                <img v-if="!isLoading" class="absolute inset-0  aspect-[3/2] w-full h-full "
                    :src="setImage(created_at, thumbnail)" alt="">
                <nav class="absolute inset-0 bg-gray-100/30"></nav>

                <span v-if="!isLoading" class="absolute  text-white bottom-5 left-5    text-xs   ">
                    <nav class=" py-2 text-sm font-semibold">{{ dishname }}</nav>
                    <nav
                        class="border w-max  border-orange-500/60 rounded-md bg-orange-500/50 px-2 grid place-items-center py-1">
                        {{ difficulty }}</nav>
                </span>
                <span v-if="!isLoading" class="absolute   bottom-5 right-5     ">
                    <Togglefavorites :id="id" :favoritesCount="favoritesCount" />
                </span>
            </nav>
            <button @click="$router.back()"
                class="absolute top-5 left-5 h-9 w-9  grid place-items-center  bg-orange-400/60 border-gray-100 border z-20  rounded-full text-gray-50">
                <font-awesome-icon icon="arrow-left" size="xs" />
            </button>
            <button
                class="absolute top-5 right-10 h-9 w-9  grid place-items-center  bg-orange-400/60 border-gray-100 border z-20  rounded-full text-gray-50">
                <font-awesome-icon icon="share-alt" size="xs" />
            </button>
        </section>
        <section class="mt-2">
            <div class="flex justify-center">
                <nav class="text-xs text-gray-400 bg-gray-100/50 rounded-t-md p-1">
                    <button class="px-3 border-x py-1 inline-block"
                        :class="activeComponent == 'Listingredients' && 'active'"
                        @click="activeComponent = 'Listingredients'">ingredient</button>
                    <button class="px-3 border-x py-1 inline-block"
                        :class="activeComponent == 'Listprocedures' && 'active'"
                        @click="activeComponent = 'Listprocedures'">procedure</button>
                    <button class="px-3 border-x py-1 inline-block"
                        :class="activeComponent == 'Foodhistory' && 'active'"
                        @click="activeComponent = 'Foodhistory'">food history</button>
                </nav>
            </div>
        </section>
        <section class="text-gray-500 text-sm  bg-white max-w-2xl  h-full overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200 h-full">
                <KeepAlive>
                    <component :is="activeComponent" :slug="slug" :ingredients="ingredients" :procedures="procedures" />
                </KeepAlive>
            </div>
        </section>

    </div>
</template>

<script >

import Listingredients from './components/Listingredients.vue';
import Listprocedures from './components/Listprocedures.vue';
import Foodhistory from './components/Foodhistory.vue';
import Togglefavorites from './components/Togglefavorites.vue';
import Api from '../api/Api';
import { setImage } from '../api/Util'

export default {
    components: { Listingredients, Listprocedures, Foodhistory, Togglefavorites },
    data() {
        return {
            activeComponent: "Listingredients",
            ingredients: null,
            procedures: null,
            dishname: null,
            difficulty: null,
            thumbnail: null,
            created_at: null,
            isLoading: true,
            id: null,
            favoritesCount: null,
        }
    },
    computed: {
        slug() {
            return this.$route.params.slug
        }
    },
    methods: {
        setImage
    },
    mounted() {
        this.isLoading = true
        Api.get('/dish/getdish/' + this.slug).then(res => {
            console.log(res.data)
            this.ingredients = res.data.post.ingredient
            this.procedures = res.data.post.procedure
            this.difficulty = res.data.post.difficulty
            this.thumbnail = res.data.post.image
            this.dishname = res.data.post.dishname
            this.created_at = res.data.post.created_at
            this.isLoading = false
            this.id = res.data.post.id,
                this.favoritesCount = res.data.favoritesCount

        }).catch(error => {
            console.log(error.response)
            // this.isLoading = false
        })

    }
}

</script>

<style scoped>
.active {
    @apply bg-white text-orange-500/80 rounded-md shadow-md border-none
}
</style>
