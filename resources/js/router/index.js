import { createWebHistory, createRouter } from 'vue-router'
import { computed, ref, nextTick } from 'vue'
import routes from './routes'



const router = createRouter({
    history: createWebHistory(),
    routes
})


let documentPage = computed(() => document.querySelector('#documentpage'))
let scrollTop = ref(null)
router.afterEach((to, from) => {
    if ((to.name == 'Viewdish') && (from.name = "Home")) {
        scrollTop.value = documentPage.value.scrollTop
    } else if ((from.name = 'Viewdish') && (to.name = "Home")) {
        nextTick().then(() => {
            documentPage.value.scrollTop = scrollTop.value
        })

    }
})

export default router;