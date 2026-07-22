<template>

    <h1 v-if="post">Update Post <span class="font-bold">{{ post.title }}</span></h1>
    <h1 v-else>Create Post</h1>

    <router-link :to="{ name:'list' }" custom v-slot="{ navigate }">
        <o-button iconLeft="arrow-left" @click="navigate" variant="primary">
            Back
        </o-button>
    </router-link>

    <div class="mb-5"></div>

    <div class="grid grid-cols-2 gap-3">

        <o-field label="Title" :variant="errors.title ? 'danger' : 'primary'" :message="errors.title">
            <o-input v-model="form.title"></o-input>
        </o-field>
        <o-field label="Slug" :variant="errors.slug ? 'danger' : 'primary'" :message="errors.slug">
            <o-input v-model="form.slug"></o-input>
        </o-field>
        <o-field label="Descripcion" :variant="errors.descripcion ? 'danger' : 'primary'" :message="errors.descripcion">
            <o-input v-model="form.descripcion" type="textarea"></o-input>
        </o-field>
        <o-field label="Contenido" :variant="errors.contenido ? 'danger' : 'primary'" :message="errors.contenido">
            <o-input v-model="form.contenido" type="textarea"></o-input>
        </o-field>
        <o-field label="Posted" :variant="errors.posted ? 'danger' : 'primary'" :message="errors.posted">
            <o-select v-model="form.posted" placeholder="Selected a option">
                <option value="yes">Yes</option>
                <option value="not">No</option>
            </o-select>
        </o-field>
        <o-field label="Category" :variant="errors.category_id ? 'danger' : 'primary'" :message="errors.category_id">
            <o-select v-model="form.category_id" placeholder="Selected a option">
                <option value=""></option>
                <option v-for="c in categories.data" v-bind:key="c.id" :value="c.id">{{ c.title }}</option>
            </o-select>
        </o-field>
        
        <div class="flex gap-2 w-full" v-if="post">
            <o-field :message="fileError" :variant="fileError ? 'danger' : 'primary'">
                <o-upload v-model="file" class="flex-1 flex">
                    <o-button tag="upload-tag" variant="primary">
                        <o-icon icon="upload"></o-icon>
                        <span>Click to upload</span>  
                    </o-button>
                </o-upload>
            </o-field>

            <o-button icon-left="upload" @click="upload" class="flex-1 justify-center">
                Upload
            </o-button>
        </div>
        

        <o-button variant="info" @click="send">Send</o-button>

        <div class="grid grid-cols-1 gap-3 ">

            <h2>Drag and Drop</h2>

            <o-field :message="fileError" :variant="fileError ? 'danger' : 'primary'">
                <o-upload v-model="filesDaD" multiple drag-drop class="flex-1 flex">
                    <section class="text-center">
                        <o-icon icon="upload"></o-icon>
                        <span>Drag and Drop area</span>
                    </section>
                </o-upload>
            </o-field>

            <span v-for="(file, index) in filesDaD" :key="index">
                {{ file.name }}
            </span>

        </div>
        

        <!-- <div class="w-full" v-if="post">
            <img src="../../../../public/image/1784741910.jpg" :src="form.image" class="w-100 object-cover rounded mt-2" />
        </div> -->

    </div>
</template>
<script>
    export default{
        async mounted() {

            if(this.$route.params.slug){
                this.post = await this.$axios.get(this.$root.urls.postSlug+this.$route.params.slug)
                this.post = this.post.data
                this.initPost()
            }

            this.getCategory()
        },

        data() {
            return {
                post:'',
                form:{
                    title: '',
                    slug: '',
                    descripcion: '',
                    contenido: '',
                    posted: '',
                    category_id: '',
                },
                errors:{
                    title: '',
                    slug: '',
                    descripcion: '',
                    contenido: '',
                    posted: '',
                    category_id: '',
                },
                file: null,
                fileError: '',
                filesDaD: [],
                categories: []      
            }
        },

        methods:{
            initPost(){
                this.form.slug = this.post.slug
                this.form.descripcion = this.post.descripcion
                this.form.contenido = this.post.contenido
                this.form.posted = this.post.posted
                this.form.category_id = this.post.category_id
                this.form.title = this.post.title
            },

            upload(){
                this.fileError = ''
                const formData = new FormData()
                console.log(this.file)
                formData.append('image',this.file)
                this.$axios.post(this.$root.urls.postUpload+this.post.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((res) => {
                    console.log(res);
                }).catch((error) => {
                    this.fileError = error.response.data.message
                    console.log(error);
                });
            },

            cleanErrorsForm(){
                this.errors.title = ''
                this.errors.slug = ''
                this.errors.descripcion = ''
                this.errors.contenido = ''
                this.errors.posted = '' 
                this.errors.category_id = ''
            },
            getCategory(){
                this.$axios.get(this.$root.urls.catSelect).then((res) => {
                    // console.log(res.data)
                    this.categories = res.data
                })
            },
            send(){
                this.cleanErrorsForm()

                if(this.post == ''){
                    // Crear
                    this.$axios.post(this.$root.urls.postCreate, this.form).then(res => {
                        console.log(res)

                        this.$notification.open({
                            message: 'Record created success',
                            position: 'bottom-right',
                            duration: 4000,
                            closeable: true,
                        })

                    }).catch(error => {
                        // console.log('catch')
                        // console.log(error)
                        if(error.response.data.errors.title){
                            this.errors.title = error.response.data.errors.title[0]
                        }
                        if(error.response.data.errors.slug){
                            this.errors.slug = error.response.data.errors.slug[0]
                        }
                        if(error.response.data.errors.descripcion){
                            this.errors.descripcion = error.response.data.errors.descripcion[0]
                        }
                        if(error.response.data.errors.contenido){
                            this.errors.contenido = error.response.data.errors.contenido[0]
                        }
                        if(error.response.data.errors.posted){
                            this.errors.posted = error.response.data.errors.posted[0]
                        }
                        if(error.response.data.errors.category_id){
                            this.errors.category_id = error.response.data.errors.category_id[0]
                        }
                    })
                }else{
                    // Actualizar
                    this.$axios.patch(this.$root.urls.postPost+this.post.id, this.form).then(res => {

                        this.$notification.open({
                            message: 'Record Updated success',
                            position: 'bottom-right',
                            duration: 4000,
                            closeable: true,
                        })

                        console.log(res)
                    }).catch(error => {
                        // console.log('catch')
                        // console.log(error)
                        if(error.response.data.errors.title){
                            this.errors.title = error.response.data.errors.title[0]
                        }
                        if(error.response.data.errors.slug){
                            this.errors.slug = error.response.data.errors.slug[0]
                        }
                        if(error.response.data.errors.descripcion){
                            this.errors.descripcion = error.response.data.errors.descripcion[0]
                        }
                        if(error.response.data.errors.contenido){
                            this.errors.contenido = error.response.data.errors.contenido[0]
                        }
                        if(error.response.data.errors.posted){
                            this.errors.posted = error.response.data.errors.posted[0]
                        }
                        if(error.response.data.errors.category_id){
                            this.errors.category_id = error.response.data.errors.category_id[0]
                        }
                    })
                }
            }
        },

        watch: {
            filesDaD: {
                handler(val) {
                    // return console.log(val[val.length-1])

                    this.fileError = ''
                    const formData = new FormData()

                    formData.append('image', val[val.length-1])
                    this.$axios.post(this.$root.urls.postUpload+this.post.id, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((res) => {
                        console.log(res);
                    }).catch((error) => {
                        this.fileError = error.response.data.message
                        console.log(error);
                    });
                },
                deep: true
            }
        }
    }
</script>