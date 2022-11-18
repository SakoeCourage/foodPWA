import { defineStore } from 'pinia'
import Api from '../api/Api'

export const useFoodStore = defineStore('foodstore', {
    state: () => ({

        featureddish: null,
        alldish: null,
        loadingAllDish: true,
        nextPageUrl: '',
        urlString: '/dish/all',
        dishType: ['All'],
        filters: {
            dishType: 'All',
            sort: 'new'
        },


    }),

    actions: {
        getfeaturedDish() {
            Api.get('/dish/featured').then(res => {
                this.$state.featureddish = res.data


            }).catch(error => console.log(error.response.data))
        },
        getAllDish() {
            this.$state.loadingAllDish = true
            this.$state.alldish = null
            Api.get(this.$state.urlString).then(res => {
                let data = res.data.data
                console.log(res.data)
                this.$state.alldish = [...data]

                this.$state.nextPageUrl = res.data.next_page_url
                this.$state.loadingAllDish = false
            }).catch(error => {
                console.log(error)
            })
        },
        LoadmoreDish() {
            this.$state.loadingAllDish = true
            Api.get(this.$state.nextPageUrl).then(res => {

                let data = res.data.data
                this.$state.alldish = [...this.$state.alldish, ...data]
                this.$state.nextPageUrl = res.data.next_page_url
                this.$state.loadingAllDish = false

            }).catch(error => {
                console.log(error)
            })
        },
        resetUrlString() {
            this.$state.urlString = '/dish/all'
        },
        getAllDishTypes() {
            Api.get('/dish/getdishtypes').then(res => {
                let dishTypes = res.data
                dishTypes.forEach(type => {
                    this.$state.dishType.push(type.dishtype)
                });
            }).catch(error => {
                console.log(error.response)
            })
        },
        applySearchFilters() {
            this.resetUrlString()
            Object.entries(this.$state.filters).forEach((item, i) => {
                const [key, value] = item
                if (i === 0) {
                    this.$state.urlString = `${this.$state.urlString}?${key}=${value}`
                } else {
                    this.$state.urlString = `${this.$state.urlString}&${key}=${value}`
                }
            })


        }


    }
})