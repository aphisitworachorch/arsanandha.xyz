<template>
    <app-layout>
        <div>
            <div class="uk-container uk-padding-large uk-text-center">
                <div class="container">
                    <vk-card :style="{ backgroundImage: `url(${this.img}), linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5))`,backgroundRepeat: 'no-repeat',backgroundAttachment: 'fixed',backgroundPosition: 'center' }">
                        <DateSlotT v-bind:remainDate="remainDay" v-bind:remainPractice="remainPractices" v-bind:color="colorist">

                        </DateSlotT>
                    </vk-card>
                    <br/>
                    <vk-card>
                        <PhotoMobile v-if="$isMobile()"
                                     v-bind:photolink="photoLink"
                                     v-bind:verse="verse"
                                     v-bind:infoUnsplash="infoUnsplash"
                                     v-bind:infoUnsplashUsername="infoUnsplashUsername"
                                     v-bind:references="references"
                                     ></PhotoMobile>
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
import DateSlotT from "../arsanandha/countdate/DateSlotT";
    export default {
        name: "IndexTMobile",
        metaInfo:{
            title:"ARSANANDHA"
        },
        props:['verse','references','photoLink','infoUnsplashUsername','infoUnsplash','remainDay','remainPractices'],
        data: () => {
            return{
                myself: "https://avatars.githubusercontent.com/aphisitworachorch",
                img: require('../../../img/conscript.jpg'),
                colorist: 'white'
            }
        },
        components:{
            DateSlotT,
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
