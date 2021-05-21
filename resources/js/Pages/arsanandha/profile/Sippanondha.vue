<template>
    <div v-bind:style="{ 'background-image': 'url(' + spnImage + ')',backgroundPosition:'center',backgroundSize:'cover' }">
        <Main>
            <div class="uk-container uk-padding-large uk-text-center">
                <vk-card class="glass">
                    <ActivityPhoto
                        v-bind:photolink="spnImage"
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
  name: "Sippanondha",
    components: {ActivityPhoto, Main},
    metaInfo:{
    title:"Sippanondha"
  },
  data:()=>{
    return{
        spnImage: require('../../../../img/activities/SIPPANONDHA.jpg').default,
        description: "Sippanondha Camp",
        role: "I'm Public Relations / Graphic Designer / Video Editor / Volunteer 💘💘"
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
