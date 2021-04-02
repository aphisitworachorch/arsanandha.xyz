<template>
    <app-layout>
        <div>
            <div class="uk-container uk-padding-large uk-text-center">
                <div class="container">
                    <vk-card>
                        <PhotoMobile v-if="$isMobile()"
                                     v-bind:photolink="photoLink"
                                     v-bind:verse="verse"
                                     v-bind:infoUnsplash="infoUnsplash"
                                     v-bind:infoUnsplashUsername="infoUnsplashUsername"
                                     v-bind:references="references"
                                     ></PhotoMobile>
                        <Photo
                               v-bind:photolink="photoLink"
                               v-bind:verse="verse"
                               v-bind:infoUnsplash="infoUnsplash"
                               v-bind:infoUnsplashUsername="infoUnsplashUsername"
                               v-bind:references="references"></Photo>
                    </vk-card>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/Main";
import Photo from "../arsanandha/photolayout/Photo";
import PhotoMobile from "../arsanandha/photolayout/PhotoMobile";
    export default {
        name: "IndexT",
        metaInfo:{
            title:"ARSANANDHA"
        },
        props:['verse','references','photoLink','infoUnsplashUsername','infoUnsplash'],
        data: () => {
            return{
                myself: "https://avatars.githubusercontent.com/aphisitworachorch"
            }
        },
        components:{
            PhotoMobile,
            Photo,
            AppLayout
        }
    }
</script>

<style lang="sass" scoped>
    body
        font-family: 'Poppins', sans-serif

    h1, h2, h3, h4, h5, p
        font-family: 'Poppins', sans-serif

    .center
        text-align: center
</style>
