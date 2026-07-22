<template lang="">
    <div class="container mx-auto mt-3">
        <router-view></router-view>
    </div>    
</template>

<script>
    export default{
        data(){
            return{
                urls: {
                    postIndex: '/api/post?page=',
                    //Usado para delete en List
                    postPost: '/api/post/',
                    postDelete: '/api/post/',
                    postCreate: '/api/post',
                    postSlug: '/api/post/slug/',

                    catSelect: '/api/category/all',

                    postUpload: '/api/post/upload/',
                    postPatch: '/api/post/patch/',
                }
            }
        }
    }
</script>