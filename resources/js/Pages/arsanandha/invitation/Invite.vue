<template>
    <div class="uk-container uk-padding-large">
        <h1>Asanan Aphisitworachorch</h1>
        <div class="uk-container">
            <main>
                <vk-card padding="medium">
                    <h3>
                        You're Invited to Graduation Celebrating ! <br/>
                        Remaining
                        {{ yearBd }} Years , {{ monthBd }} Months ,
                        {{ dayBd }} Days ,
                        {{ hrBd }} Hours ,
                        {{ minBd }} Minutes ,
                        {{ secBd }} Seconds ,
                        {{ milsecBd }} Milliseconds
                    </h3>
                    <p>{{ place }}</p>
                </vk-card>
                <vk-card padding="medium">
                    <vk-grid>
                        <div>
                            <vk-card>
                                <div class="uk-container">
                                    <h2>6 Nov</h2>
                                    <br/>
                                    <span>Pre-Graduation Celebrating</span>
                                    <br/>
                                    <vk-label slot="badge"><span>Availability 08:00-22:00</span></vk-label>
                                </div>
                            </vk-card>
                        </div>
                        <div>
                            <vk-card>
                                <div class="uk-container">
                                    <h2>7 Nov</h2>
                                    <br/>
                                    <span>Pre-Graduation Celebrating</span>
                                    <br/>
                                    <vk-label slot="badge"><span>Availability 08:00-22:00</span></vk-label>
                                </div>
                            </vk-card>
                        </div>
                        <div>
                            <vk-card>
                                <div class="uk-container">
                                    <h2>8 Nov</h2>
                                    <br/>
                                    <span>Pre-Graduation Celebrating</span>
                                    <br/>
                                    <vk-label slot="badge"><span>Availability 08:00-22:00</span></vk-label>
                                </div>
                            </vk-card>
                        </div>
                        <div>
                            <vk-card>
                                <div class="uk-container">
                                    <h2>9 Nov</h2>
                                    <br/>
                                    <span>Pre-Graduation Celebrating</span>
                                    <br/>
                                    <vk-label slot="badge"><span>Availability 14:00-22:00</span></vk-label>
                                </div>
                            </vk-card>
                        </div>
                    </vk-grid>
                </vk-card>
            </main>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

moment.locale('en');
let birthDayData = moment(new Date(2020, 10, 6, 9, 0, 0));
export default {
    name: "About",
    metaInfo: {
        title: "About"
    },
    data: () => {
        return {
            yearBd: "",
            monthBd: "",
            dayBd: "",
            hrBd: "",
            minBd: "",
            secBd: "",
            milsecBd: "",
            bData: birthDayData.format('LLLL'),
            place: "at Anywhere 📌"
        }
    },
    /* birthday() use for birthday data */
    methods: {
        birthDay() {
            this.diffDate = moment.duration(moment(birthDayData).diff(new Date()));
            this.yearBd = this.diffDate.years();
            this.monthBd = this.diffDate.months();
            this.dayBd = this.diffDate.days();
            this.hrBd = this.diffDate.hours();
            this.minBd = this.diffDate.minutes();
            this.secBd = this.diffDate.seconds();
            this.milsecBd = this.diffDate.milliseconds();
        }
    },
    /* mounted() -> interval var will be refreshed every 1 sec */
    mounted() {
        this.interval = setInterval(this.birthDay, 1000)
    },
    beforeDestroy() {
        clearInterval(this.interval)
    }
}
</script>

<style lang="sass" scoped>
@import url('https://fonts.googleapis.com/css?family=K2D&display=swap&subset=thai')

body
    font-family: 'K2D', sans-serif

h1, h2, h3, h4, h5, p
    font-family: 'K2D', sans-serif

.soon
    position: absolute
    top: 50%
    left: 50%
    margin-right: -50%
    transform: translate(-50%, -50%)
</style>
