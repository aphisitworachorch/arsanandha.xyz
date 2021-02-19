<template>
  <div>
    <div class="uk-container-large uk-align-center">
      <h3 style="text-align: center">KATAKORN OF SUT #3 - #6</h3>
        <kinesis-container :active="true">
            <kinesis-element :strength="5" type="depth">
                <img class="uk-align-center" width="65%" :src="ktkImage"/>
            </kinesis-element>
        </kinesis-container>
      <p style="text-align: center">I'm Graphic Designer / Video Editor / Programmer at SUTKTK</p>
    </div>
  </div>
</template>

<script>
    export default {
        name: "Katakorn",
        metaInfo:{
            title:"Katakorn"
        },
        data:()=>{
            return{
                ktkImage: require('../../../../img/activities/SUTKTK.jpg'),
            }
        }
    }
</script>

<style scoped>

</style>
