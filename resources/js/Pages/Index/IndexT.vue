<template>
    <div v-bind:style="{ 'background-image': 'url(' + photoLink + ')',backgroundPosition:'center',paddingBottom:'38px',height:'100%',backgroundRepeat:'no-repeat',backgroundSize:'cover' }" class="blackwhite">
        <Main>
            <div>
                <div class="uk-container uk-text-center" style="padding-top:65px;padding-bottom:31px;">
                    <div class="container">
                        <vk-card class="glass" style="height:70%;">
                            <Photo v-if="!$isMobile()"
                                   v-bind:photolink="photoLink"
                                   v-bind:verse="verse"
                                   v-bind:infoUnsplash="infoUnsplash"
                                   v-bind:infoUnsplashUsername="infoUnsplashUsername"
                                   v-bind:references="references"></Photo>
                        </vk-card>
                    </div>
                </div>
            </div>
        </Main>
    </div>
</template>

<script>
import Photo from "../arsanandha/photolayout/Photo";
import PhotoMobile from "../arsanandha/photolayout/PhotoMobile";
import Main from "../../Layouts/Main";
    export default {
        name: "IndexT",
        metaInfo:{
            title:"ARSANANDHA"
        },
        props:['verse','references','photoLink','infoUnsplashUsername','infoUnsplash'],
        data: () => {
            return{
                colorist: 'white'
            }
        },
        components:{
            Main,
            PhotoMobile,
            Photo
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

    .glass
        background: rgba( 255, 255, 255, 0.65 )
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 )
        backdrop-filter: blur( 10px )
        -webkit-backdrop-filter: blur( 10px )
        border-radius: 10px
        border: 1px solid rgba( 255, 255, 255, 0.18 )

    @keyframes blackwhiteToColor
        from
            -webkit-filter: grayscale(100%)
            filter: grayscale(100%)
        to
            -webkit-filter: grayscale(0%)
            filter: grayscale(0%)

    .blackwhite
        -webkit-animation: ease-out blackwhiteToColor 5s both
        -moz-animation: ease-out blackwhiteToColor 5s both
        animation: ease-out blackwhiteToColor 5s both
</style>
