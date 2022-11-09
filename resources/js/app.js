import './bootstrap';
import { createApp } from 'vue'
import router from './router';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faHome, faChevronDown, faCircleCheck, faObjectGroup, faLayerGroup, faUtensils, faPlus, faMessage, faBell, faGear, faArrowRight, faArrowCircleRight, faEllipsisV, faClock, faHeart, faHeartCircleXmark, faTrash, faArrowDown, faMagnifyingGlass, faEdit, faImage, faPlusCircle, faMinusCircle, faClose, faArrowLeft, faShareAlt, faEye, faEyeSlash, faTimes, faWarning } from '@fortawesome/free-solid-svg-icons'
library.add(faHome, faChevronDown, faCircleCheck, faObjectGroup, faLayerGroup, faUtensils, faPlus, faMessage, faBell, faGear, faArrowRight, faArrowCircleRight, faEllipsisV, faClock, faHeart, faHeartCircleXmark, faTrash, faArrowDown, faMagnifyingGlass, faEdit, faImage, faPlusCircle, faMinusCircle, faClose, faArrowLeft, faShareAlt, faEye, faEyeSlash, faTimes, faWarning)
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import App from './App.vue'
import { createPinia } from 'pinia'
const pinia = createPinia()

const app = createApp(App)
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router)
app.use(pinia)
app.mount("#app")