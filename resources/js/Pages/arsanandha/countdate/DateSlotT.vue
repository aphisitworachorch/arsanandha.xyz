<template>
    <div v-on:click="clickToMilitary()">
        <div class="grid grid-flow-col grid-cols-1 auto-cols-max md:auto-cols-min">
            <div v-if="remainPractice == 'NOT_IN_TIME'" class="col-span-1">
                <h2 :style="{ color: color }">
                    Remaining
                    {{ remainDate }}
                    Days for Military Enlistment
                </h2>
            </div>
            <div v-if="remainPractice != 'NOT_IN_TIME'" class="col-span-1">
                <h2 :style="{ color: color }">
                    Remaining
                    {{ remainPractice }}
                    Days for Ending Practicing
                </h2>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DateSlotT",
    props:['remainDate','remainPractice','color'],
    methods:{
        clickToMilitary: function(){
            window.location.href = 'https://military.arsanandha.xyz';
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
