<template>
  <div v-bind:style="{ 'background-image': 'url(' + ktkImage + ')',backgroundPosition:'center',backgroundSize:'cover' }">
    <Main>
        <div class="uk-container uk-padding-large uk-text-center">
            <vk-card class="glass">
                <ActivityPhoto
                    v-bind:photolink="ktkImage"
                    v-bind:word="description"
                    v-bind:role="role"
                ></ActivityPhoto>
            </vk-card>
        </div>
    </Main>
  </div>
</template>

<script>
    import Main from "../../../Layouts/Main";
    import ActivityPhoto from "../activitylayout/ActivityPhoto";
    export default {
        name: "Katakorn",
        components: {ActivityPhoto, Main},
        metaInfo:{
            title:"Katakorn"
        },
        data:()=>{
            return{
                ktkImage: require('../../../../img/activities/SUTKTK.jpg').default,
                description: "KATAKORN OF SUT #3 - #6",
                role: "I'm Graphic Designer / Video Editor / Programmer at SUTKTK"
            }
        }
    }
</script>

<style scoped>
    .glass {
        background: rgba( 255, 255, 255, 0.65 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 10px );
        -webkit-backdrop-filter: blur( 10px );
        border-radius: 10px;
        border: 1px solid rgba( 255, 255, 255, 0.18 );
    }
</style>
