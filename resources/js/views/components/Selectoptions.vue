<template>
    <div class=" w-1/2 px-3 py-2  rounded-md hover:bg-gray-100/70 hover:cursor-pointer" >
            <div class="  mx-auto flex items-center justify-center">
                    <div class="relative flex items-center  gap-2 ">
                       <span class="h-12 w-12 p-2 px-4 mr-2 rounded-full bg-orange-100 text-orange-400 grid place-items-center" @click="onButtonClick()">
                        <font-awesome-icon :icon="icon" />
                       </span>
                        <span class="w-full rounded-md  flex items-start flex-col  " @click="onButtonClick()">
                            <label for="" class="text-xs uppercase flex items-center gap-2 text-orange-400">
                                <span>{{ name }}</span>
                                <font-awesome-icon icon="chevron-down" size='xs'/>
                            </label>
                            <button ref="button"  type="button" aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="assigned-to-label"
                             class=" max-w-fit cursor-default relative w-full rounded-md  py-2 text-left focus:outline-none text-gray-500  transition ease-in-out duration-15  sm:leading-5">
                                <div class="flex items-center ">
                                    <span v-text="[...options][value - 1]" class="block truncate w-32"></span>
                                </div>
                            </button>
                        </span>
                        <Transition name="slide-fade">
                            <div v-show="open" @focusout="onEscape()" class="absolute z-20 mt-1  rounded-md bg-white shadow-lg" style="display: none;">
                                <ul @keydown.enter.prevent="onOptionSelect()" @keydown.space.stop.prevent="onOptionSelect()" @keydown.escape="onEscape()" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()" ref="listbox" tabindex="-1" role="listbox" aria-labelledby="assigned-to-label" :aria-activedescendant="activeDescendant" 
                                class="max-h-56 min-w-[12rem] rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5">
                                <li v-for="(option,i) in options" :key="i" id="assigned-to-option-1" role="option" @click="choose(i +1 )" @mouseenter="selected = i+1" @mouseleave="selected = null" :class="{ 'text-white ': selected === i +1, 'text-gray-900': !(selected === i +1) }" 
                                class="text-gray-900  select-none relative py-2 pl-4 pr-9 hover:bg-orange-200 cursor-pointer">
                                    <div class="flex items-center space-x-3">
                                        <span :class="{ 'font-semibold': value === i+1, 'font-normal': !(value === i +1) }" class="font-normal block truncate">
                                         {{ option }}
                                        </span>
                                    </div>
                                    <span v-show="value === i +1" :class="{ 'text-white': selected === i +1, 'text-orange-400': !(selected === i +1) }" class="absolute inset-y-0 right-0 flex items-center pr-4 text-orange-400" style="display: none;">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </li>
                            
                            </ul>
                        </div>
                    </Transition>
                    </div>
                </div>
    </div>
    </template>
    
    <script>
    export default {
        props: ['options','name','accentColor','icon','currentSelection'],
        data() {
            return {
                activeDescendant: null,
                optionCount: null,
                open: false,
                selected: null,
                value: 1,
    
            }
        },
        methods: {
            choose(option) {
                this.value = option
                this.$emit(`setNew${this.name.replace(/\s+/g,'')}selection`,this.options[this.value-1])
                this.open = false
            },
            onButtonClick() {
                if (this.open) return
                this.selected = this.value
                
                this.open = true
                this.$nextTick(() => {
                    this.$refs.listbox.focus()
                    this.$refs.listbox.children[this.selected - 1].scrollIntoView({
                        block: 'nearest'
                    })
                })
            },
            onOptionSelect() {
                if (this.selected !== null) {
                    this.value = this.selected
                }
                this.open = false
                this.$refs.button.focus()
            },
            onEscape() {
                this.open = false
                this.$refs.button.focus()
            },
            onArrowUp() {
                this.selected = this.selected - 1 < 1 ? this.optionCount : this.selected - 1
                this.$refs.listbox.children[this.selected - 1].scrollIntoView({
                    block: 'nearest'
                })
            },
            onArrowDown() {
                this.selected = this.selected + 1 > this.optionCount ? 1 : this.selected + 1
                this.$refs.listbox.children[this.selected - 1].scrollIntoView({
                    block: 'nearest'
                })
            },
    
        },
        watch: {
            selected() {
                if (!this.open) return
    
                if (this.selected === null) {
                    this.activeDescendant = ''
                    return
                }
    
                this.activeDescendant = this.$refs.listbox.children[this.selected -1 ].id
            },
           
        },
        mounted() {
            this.$refs.listbox.focus()
            this.optionCount = this.$refs.listbox.children.length
           
            this.selected = this.options.indexOf(this.currentSelection) + 1
            this.value = this.selected
           
        }
    
    }
    </script>
    

    <style scoped>
    
    .slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: Scale(1.2);
  opacity: 0;
}
    </style>