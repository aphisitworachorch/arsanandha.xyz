<template>
    <div v-bind:style="{ 'background-image': 'url(' + sapaImage + ')',backgroundPosition:'center',backgroundSize:'cover' }">
        <Main>
            <div class="uk-container uk-padding-large uk-text-center">
                <vk-card class="glass">
                    <ActivityPhoto
                        v-bind:photolink="sapaImage"
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
        name: "StudentCouncil",
        components: {ActivityPhoto, Main},
        metaInfo:{
            title:"SUT Student Council"
        },
        data:()=>{
          return{
                sapaImage: require('../../../../img/activities/SUTSAPA.jpg').default,
                description: "Student Council of SUT 62",
                role: "I'm Public Relations / Graphic Designer / Web Programmer"
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
