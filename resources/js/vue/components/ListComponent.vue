<template>

    <o-modal v-model:active="confirmDeleteAction">
        <div class="p-4 bg-gray-100 p-4">
            <p>Seguro que quieres eliminar el registro?</p>
        </div>
        <div class="flex flex-row-reverse gap-2 bg-gray-100 p-4">
            <o-button variant="danger" @click="deletePost">Delete</o-button>
            <o-button @click="confirmDeleteAction = false">Cancel</o-button>
        </div>
    </o-modal>

    <!-- <o-notification
        v-if="showSuccess"
        variant="danger"
        position="bottom-right"
        :duration="4000"
        :infinite="false"
        closeable
        @close="showSuccess = false">
        Delete success
    </o-notification> -->

    <h1>Post List</h1>

    <router-link :to="{ name:'save' }" custom v-slot="{ navigate }">
        <o-button iconLeft="plus" @click="navigate" variant="primary">
            Create
        </o-button>
    </router-link>

    <div class="mb-5"></div>

    <div>
        
        <o-table :data="posts.data" :loading="isLoading">
            <o-table-column field="id" label="ID" v-slot="p">
                {{ p.row.id }}
            </o-table-column>
            <o-table-column field="title" label="Titulo" v-slot="p">
                {{ p.row.title }}
            </o-table-column>
            <o-table-column field="posted" label="Posted" v-slot="p">
                {{ p.row.posted }}
            </o-table-column>
            <o-table-column field="category_id" label="Categoria" v-slot="p">
                {{ p.row.category.title }}
            </o-table-column>
            <o-table-column field="category_id" label="Actions" v-slot="p">
                <router-link :to="{ name:'save', params: { 'slug': p.row.slug } }">Edit</router-link>
                &nbsp;
                <o-button iconLeft="delete" size="small" variant="danger" 
                    @click="deletePostRow = p; confirmDeleteAction = true">Delete</o-button>
            </o-table-column>
        </o-table>

        <o-pagination
            v-if="posts.data && posts.data.length > 0"
            @change="updatePage"
            :total="posts.meta.total"
            v-model:current="currentPage"
            :range-before="2"
            :range-after="2"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="posts.meta.per_page"
        >
        </o-pagination>

        <!-- <o-button @click="clickMe">Click Me</o-button>

        <o-field label="Email" variant="danger">
            <o-input type="Email" value="andres"></o-input>
        </o-field> -->

    </div>
</template>

<script>
    

    export default{

        data() {
            return {
                posts: [],
                isLoading: true,
                currentPage: 1,
                confirmDeleteAction: false,
                deletePostRow: '',
                showSuccess: false
            }
        },

        mounted() {
            this.listPage()
        },

        methods: {
            updatePage(){
                setTimeout(() => {
                    this.listPage()
                }, 100);
            },
            listPage(){
                this.isLoading = true,
                this.$axios.get(this.$root.urls.postIndex+this.currentPage).then((res) => {
                    this.posts = res.data
                    this.isLoading = false
                    // console.log(this.posts)
                })
                
            },
            deletePost(){
                // console.log('test')
                this.confirmDeleteAction = false
                // Gemini Sugerencia
                // this.$axios.delete('/api/post/'+row.row.id).then(res => {
                //     this.listPage()
                // })
                // Sugerencia curso
                // this.$axios.delete('/api/post/'+row.row.id)

                //Actualizado con modal
                this.$axios.delete(this.$root.urls.postDelete+this.deletePostRow.row.id)
                this.posts.data.splice(this.deletePostRow.index, 1)

                //Uso de notificaciones para nueva version o en este caso
                this.$notification.open({
                    message: 'Delete success',
                    position: 'bottom-right',
                    variant: 'danger',
                    duration: 4000,
                    closeable: true,
                })

            }
        }
    }
</script>