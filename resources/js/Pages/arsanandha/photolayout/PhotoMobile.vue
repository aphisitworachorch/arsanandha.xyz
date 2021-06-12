<template>
    <div>
        <div>
            <img :src="photolink" class="col-span-1 animate__animated animate__fadeIn animate__delay-1s" alt="photo" v-bind:style="{ objectFit: 'cover' }"/>
        </div>
        <div>
            <div style="margin-top: 10%;margin-bottom: 10%">
                <img :src="imgX" v-bind:style="{ width: '50%'}" class="animate__animated animate__fadeInRight animate__delay-2s"/>
                <h3 style="text-align: left" class="animate__animated animate__fadeIn animate__delay-2s">" {{ verse }} "</h3>
                <p style="text-align: left" class="animate__animated animate__fadeIn animate__delay-2s" @click="getBibleTNCVLink(references)">{{ references }} (Click for Thai TNCV Bible)</p>
                <img :src="unsplash" v-bind:style="{ width: '20%'}" class="animate__animated animate__fadeIn animate__delay-3s"/>
                <p style="text-align: left" class="animate__animated animate__fadeIn animate__delay-3s">Photo by : (C) {{ infoUnsplash }} / UNSPLASH : {{ infoUnsplashUsername }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import {default as abbr} from "bible-book-name-abbreviator";

export default {
    name: "PhotoMobile",
    props:['photolink','verse','references','infoUnsplash','infoUnsplashUsername'],
    data: () => {
        return {
            imgX: require('../../../../img/ARSANANDHA-AE-LOGO-02.png').default,
            unsplash: require('../../../../img/Unsplash_Logo_Full-02.png').default
        }
    },
    methods:{
        getBibleTNCVLink:function (ref){
            let abbreviation = abbr.reference(ref);
            let bibleLink = "https://my.bible.com/bible/179/";
            window.location.href = bibleLink + abbreviation.toUpperCase().replace(':', '.').replace(' ', '.');
        }
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
