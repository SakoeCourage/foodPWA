<template>
<div :class="['inline-block w-full  relative aspect-[4/2]  overflow-hidden rounded-md ', inactive && 'pointer-events-none opacity-60 ']">

    
        <img :class="['w-full h-full aspect-[4/2] object-cover   ', !file && 'opacity-50  bg-gray-200 img_file object-cover']" :src="file ?? setDefualtImage()" alt="Image Upload" :id="name" />
          
 
        <label class="cursor-pointer flex flex-col self-center w-max my-2 absolute bottom-0 right-1 ">
          
            <span class="max-w-min  self-center focus:outline-none text-center text-yellow-700 text-sm px-4 rounded-full bg-yellow-100 hover:bg-yellow-400 hover:text-white hover:shadow-lg">
                <font-awesome-icon icon="edit"  />
            </span>
            <input v-on:change="getimage($event, name)" type="file" class="hidden" accept=".jpg, .jpeg, .png .tiff" :name="name" :id="name" />
        </label>
    </div>

</template>

  
<script>
import {nextTick} from 'vue'
import imgUrl from '../../../../public/propimages/uploads.svg'

export default {

    props: ["name", "setimage", "inactive", "removable", "source"],
    data() {
        return {
            fileisvalid: true,
            filename: 'no file choosen',
            filetype: null,
            file: null,
            prev_file: null,
            image: '../../public/avatar.svg',
            accepted_types: ['image/jpeg', 'image/jpg', 'image/png', 'image/tiff']

        }
    },

    computed: {
        getif_file() {
            return this.file
        }

    },
    watch: {
        file() {
            if (this.file) {
                this.prev_file = this.file
            } else {
                this.file = this.prev_file
            }

        },
        source() {
            if (this.source) {
                this.file = this.source

                this.getfileinfo();

            }
        }
    },
    methods: {

        setDefualtImage() {

            return imgUrl;
        },
        getfileinfo() {

            this.filename = this.file.name;
            this.filetype = this.file.type;

        },

        checkvalidfile() {

            if (this.accepted_types.includes(this.filetype)) {

                this.fileisvalid = true;
            } else {

                this.fileisvalid = false;
            }

        },

        getimage(e, img) {

            this.file = e.target.files[0]

            const [file] = e.target.files

            this.$nextTick(() => {

                if (file) {
                    document.querySelector(`#${img}`).src = URL.createObjectURL(file);

                }
                this.getfileinfo();
                this.checkvalidfile();

                this.$emit(`${this.name}`, this.file)
            })

        },
        resetImage() {
            this.file = '';
            this.fileisvalid = true
            this.filename = 'no file choosen'
            this.filetype = null
            this.prev_file = null

            this.$emit(`${this.name}`, this.file)

        },

    },
    mounted() {

    }

}
</script>


<style scopted>


</style>
