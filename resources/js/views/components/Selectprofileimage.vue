<template>
    <div class="flex flex-col gap-5 items-center justify-center bg-white h-full">
        <span class="text-sm tracking-wide text-gray-400 mb-5 ">profile image</span>

        <div
            :class="['inline-block   relative aspect-square h-32 w-32  overflow-hidden rounded-md ', inactive && 'pointer-events-none opacity-60 ']">
            <img :class="[' aspect-square h-32 w-32 object-cover  rounded-full', !file && 'bg-gray-200 img_file object-cover']"
                :src="file ?? setDefualtImage()" alt="Image Upload" :id="name" />
        </div>
        <label class="cursor-pointer flex flex-col self-center w-max my-2  ">

            <span
                class="max-w-max py-2  self-center focus:outline-none text-center text-yellow-700 text-sm px-4 rounded-full bg-yellow-100 hover:bg-yellow-400 hover:text-white hover:shadow-lg">
                <span>Choose profile</span>
            </span>
            <input v-on:change="getimage($event, name)" type="file" class="hidden" accept=".jpg, .jpeg, .png .tiff"
                :name="name" :id="name" />
        </label>
    </div>
</template>
    
      
<script>
import { nextTick } from 'vue'
import imgUrl from '../../../../public/propimages/profile.svg'
import Api from '../../api/Api';

export default {

    props: ["name", "setimage", "inactive", "removable", "source", "upload", "currIndex"],
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
        },
        upload() {
            this.$emit('isLoading',true)
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData()
            data.append('profileimage',this.file)
             Api.post('/profile/createorupdate',data,config).then(res=>{
                console.log(res.data)
                this.$emit('isLoading',false)
                this.$emit('next')
             }).catch(err=>{
                this.$emit('isLoading',false)
                console.log(err.response)
             })
       
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
                this.$emit('set-movable', true)
            })

        },
        resetImage() {
            this.file = '';
            this.fileisvalid = true
            this.filename = 'no file choosen'
            this.filetype = null
            this.prev_file = null
            this.$emit('set-movable', true)
        },

    },
    mounted() {
        this.$emit('set-movable', false)
    }

}
</script>
    
    
<style scopted>

</style>
    