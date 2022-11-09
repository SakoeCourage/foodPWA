import { defineStore } from 'pinia'
import Api from '../api/Api'
import User from '../api/User'
import getCookie from '../api/getCookie'


export const useUserStore = defineStore('user', {
    state: () => ({
        auth: {
            user: null
        }
    }),

    actions: {
        async getUser() {
            let cookie = await getCookie.getCookie()
            User.auth().then((res) => {
                this.$state.auth.user = res.data
                console.log(this.$state.auth)

            }).catch(error => {
                // console.log(error.response)
            })

        }
    }
})