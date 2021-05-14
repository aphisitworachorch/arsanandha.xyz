<template>
  <div>
    <div class="uk-container-large uk-align-center">
      <h3 style="text-align: center">Sippanondha Camp</h3>
        <kinesis-container :active="true">
            <kinesis-element :strength="5" type="depth">
                <img class="uk-align-center" width="65%" :src="spnImage"/>
            </kinesis-element>
        </kinesis-container>
      <p style="text-align: center">I'm Public Relations / Graphic Designer / Video Editor / Volunteer 💘💘</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "Sippanondha",
  metaInfo:{
    title:"Sippanondha"
  },
  data:()=>{
    return{
      spnImage: require('../../../../img/activities/SIPPANONDHA.jpg').default,
    }
  }
}
</script>

<style scoped>

</style>
