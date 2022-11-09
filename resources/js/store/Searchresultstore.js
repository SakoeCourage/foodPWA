import { defineStore } from 'pinia'
import Api from '../api/Api'

export const useSearchresultsStore = defineStore('searchresultstore', {
    state: () => ({
        nextPageUrl: '',
        urlString: '/dish/all',
        scrollTop: null,
        searchResults: null,
        searchKey: null,
        dishTypes: ['All'],
        isLoading: false,
        filters: {
            search: null,
            dishType: 'All',
            sort: 'new',
            difficulty: 'All',
        }
    }),
    actions: {
        getAllDishTypes() {
            Api.get('/dish/getdishtypes').then(res => {
                let dishTypes = res.data
                dishTypes.forEach(type => {
                    this.$state.dishTypes.push(type.dishtype)
                });
            }).catch(error => {
                console.log(error.response)
            })
        },
        resetUrlString() {
            this.$state.urlString = '/dish/all'
        },

        getSearchItem() {
            this.$state.isLoading = true
            Api.get(this.$state.urlString).then(res => {
                this.$state.searchResults = res.data.data;
                this.$state.nextPageUrl = res.data.next_page_url
                this.$state.isLoading = false
            }).catch(error => {
                console.log(error.response)
            })
        },
        LoadmoreDish() {
            this.$state.isLoading = true
            Api.get(this.$state.nextPageUrl).then(res => {
                let data = res.data.data
                this.$state.searchResults = [...this.$state.searchResults, ...data]
                this.$state.nextPageUrl = res.data.next_page_url
                this.$state.isLoading = false
            }).catch(error => {
                console.log(error)
            })
        },

        applyFilters() {
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