import { createWebHistory, createRouter } from 'vue-router'
import { computed, ref, nextTick } from 'vue'
import routes from './routes'
import { useUserStore } from '../store/Userstore'
import { storeToRefs } from 'pinia'




const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const userStore = useUserStore()
    const { fullScreen } = storeToRefs(userStore)
    if (to.matched.some(record => record.meta.fullScreen)) {
        fullScreen.value = true
    } else {
        next()
    }
    if (to.matched.some(record => !record.meta.fullScreen)) {
        fullScreen.value = false
    } else {
        next()
    }
})

let documentPage = computed(() => document.querySelector('#documentpage'))
let scrollTop = ref(null)
router.afterEach((to, from) => {
    if (to.name == 'Viewdish') {
        scrollTop.value = documentPage.value.scrollTop
    } else if (from.name = 'Viewdish') {
        nextTick().then(() => {
            documentPage.value.scrollTop = scrollTop.value
        })

    }
})

export default router;