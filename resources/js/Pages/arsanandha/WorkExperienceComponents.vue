<template>
    <div>
        <div>
            <vk-card :class="backDropDraw(backdrop)" :style="{ width: fixCard}">
                <img :src="logo" width="160px"/>
            </vk-card>
        </div>
        <vk-card :style="{ backgroundColor:colorProfile, color:'white', width: fixCard }">
            <vk-card-title>
                <h3 style="color:white;">{{ company_name }}</h3>
            </vk-card-title>
            <br/>
            <p>Position : {{ position }}</p>
            <p>From {{ work_experience.start }} To {{
                    work_experience.to
                }}</p>
            <div>
                Duration
                <span v-if="work_experience.duration.years > 0">{{ work_experience.duration.years }} Years /</span>
                <span v-if="work_experience.duration.months > 0">{{ work_experience.duration.months }} Months / </span>
                <span v-if="work_experience.duration.days > 0">{{ work_experience.duration.days }} Days</span>
            </div>

        </vk-card>
    </div>
</template>

<script>
import { DateTime } from 'luxon';
import moment from "moment";

export default {
    name: "WorkExperienceComponents",
    data(){
        return {
            work_experience: {
                start: this.workExperienceData().start.setLocale('en').toLocaleString(DateTime.DATE_FULL),
                to: this.endDate == null ? "Present" : this.workExperienceData().end.setLocale('en').toLocaleString(DateTime.DATE_FULL),
                duration: {
                    years: parseInt(this.workExperienceDataDiff().years),
                    months: parseInt(this.workExperienceDataDiff().months),
                    days: parseInt(this.workExperienceDataDiff().days)
                }
            },
            fixCard:'100%'
        }
    },
    props:["startDate","endDate","logo","colorProfile","company_name","position","backdrop"],
    methods:{
        workExperienceData(){
            return {
                start: DateTime.fromSQL(this.startDate),
                end: this.endDate == null ? DateTime.now() : DateTime.fromSQL(this.endDate)
            }
        },
        workExperienceDataDiff() {
            return this.workExperienceData().end.diff(this.workExperienceData().start, ["years", "months", "days"]).toObject()
        },
        backDropDraw(boolean){
            return boolean === true ? 'backdrop' : 'backdrop-white';
        }
    }
}
</script>

<style lang="sass" scoped>
    @import "resources/sass/app"

    .colorful.uk-card-title
        color: white

    .backdrop.uk-card.uk-card-default
        background-color: black

    .backdrop-white.uk-card.uk-card-default
        background-color: white
</style>
