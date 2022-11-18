import { defineStore } from 'pinia'
import Api from '../api/Api'
import User from '../api/User'
import getCookie from '../api/getCookie'


export const useUserStore = defineStore('user', {
    state: () => ({
        auth: {
            user: null,

        },
        isLoadingNotifications: false,
        notifications: {
            unreadNotifications: null,
            usernotifications: null,
            nextPageUrl: ''
        },
        fullScreen: false,
    }),

    actions: {
        async getUser() {
            let cookie = await getCookie.getCookie()
            User.auth().then((res) => {
                this.$state.auth.user = res.data
                console.log(this.$state.auth)

            }).catch(error => {
                console.log(error.response.data)
            })

        },

        async getnotificationsCount() {
            Api.get('/notifications/unread').then(res => {

                this.$state.notifications.unreadNotifications = res.data.unreadnotifications
            }).catch(err => console.log(err))
        },
        async getUsernotifications() {
            this.$state.isLoadingNotifications = true
            Api.get('/notifications/all').then(res => {
                this.$state.notifications.nextPageUrl = res.data.notifications.next_page_url
                this.$state.notifications.usernotifications = res.data.notifications.data
                this.$state.isLoadingNotifications = false
                console.log(this.$state.notifications.usernotifications)
            }).catch(err => console.log(err))
        },
        LoadmoreNotifications() {
            this.$state.isLoadingNotifications = true
            Api.get(this.$state.notifications.nextPageUrl).then(res => {

                let data = res.data.notifications.data
                this.$state.notifications.usernotifications = [...this.$state.notifications.usernotifications, ...data]
                this.$state.notifications.nextPageUrl = res.data.notifications.next_page_url
                this.$state.isLoadingNotifications = false
            }).catch(error => {
                console.log(error)
            })
        },
    }
})