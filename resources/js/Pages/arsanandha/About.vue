<template>
    <app-layout>
    <div class="uk-container uk-padding-large">
        <h1>Asanan Aphisitworachorch</h1>
        <div class="uk-container uk-padding-large">
            <h4>Full-Stack Developer in Python / PHP (Laravel) with (Vue,jQuery,Vanilla) + (SCSS,SASS) / Graphic
                Designer</h4>
            <h4><b>Unaccepted for Gray / Black Programming & Businesses or Black-box Activity</b></h4>
        </div>
        <div class="uk-container">
            <main>
                <vk-card id="born">
                    <vk-card-title>Birth Info 🏥</vk-card-title>
                    <p>Age : {{ yearBd }} Years , {{ monthBd }} Months , {{ dayBd }} Days , {{ hrBd }} Hours , {{
                            minBd
                        }} Minutes , {{ secBd }} Seconds , {{ milsecBd }} Milliseconds</p>
                    <p @click="hosp">Born in {{ bData }} , at Siriraj Hospital , Operation Room , Pediatrics</p>
                </vk-card>
                <br/>
                <vk-card id="info">
                    <vk-card-title>Basic Info 💁‍♀️</vk-card-title>
                    <vk-grid>
                        <div>
                            <p>Address : 234/647 Suranaree ville</p>
                        </div>
                        <div>
                            <p>Sub-district : Talat (ZIP CODE 30310)</p>
                        </div>
                        <div>
                            <p>District : Mueng Nakhon Ratchasima</p>
                        </div>
                        <div>
                            <p>Province : Nakhon Ratchasima</p>
                        </div>
                    </vk-grid>
                </vk-card>
                <br/>
                <vk-card id="edu">
                    <vk-card-title>Educational Background</vk-card-title>
                    <vk-grid>
                        <div>
                            <vk-card>
                                <vk-card-title>Primary 1️⃣</vk-card-title>
                                <p>Primary 1 : Study at Sarasas Witaed Bang Bua Thong</p>
                                <p>Primary 2 - 6 : Study at Assumption College Samutprakarn</p>
                            </vk-card>
                        </div>
                        <div>
                            <vk-card>
                                <vk-card-title>Secondary 2️⃣</vk-card-title>
                                <p>Secondary 1 (Term 1) : Study at Assumption College Samutprakarn</p>
                                <p>Secondary 1 (Term 2) - 3 : Study at Kiettikun Witthaya</p>
                                <p>Secondary 4 - Secondary 6 : Study at Assumption College Nakhon Ratchasima (Art-Math
                                    Plan)</p>
                            </vk-card>
                        </div>
                        <div>
                            <vk-card>
                                <vk-card-title>Bachelor 3️⃣</vk-card-title>
                                <p>Year 1 - 4 : Study at Suranaree University of Technology (Enterprise Software)</p>
                            </vk-card>
                        </div>
                    </vk-grid>
                </vk-card>
                <br/>
                <vk-card id="experiences">
                    <vk-card-title>Experiences 🏢⚒</vk-card-title>
                    <vk-grid>
                        <div>
                            <div>
                                <vk-card class="backdrop">
                                    <img src="https://www.bizpotential.com/images/logo.png" width="160px"/>
                                </vk-card>
                            </div>
                            <vk-card class="bizpotential">
                                <vk-card-title class="colorful">BizPotential</vk-card-title>
                                <p>From {{ work_experience.bizpotential.start }} To {{
                                        work_experience.bizpotential.to
                                    }}</p>
                                <p>Duration {{ work_experience.bizpotential.duration.months }} Months /
                                    {{ work_experience.bizpotential.duration.days }} Days</p>
                            </vk-card>
                        </div>
                        <div>
                            <div>
                                <vk-card>
                                    <img
                                        src="https://s4745.pcdn.co/wp-content/uploads/2017/11/Benchmark-electronics-logo.jpg"
                                        width="160px"/>
                                </vk-card>
                            </div>
                            <vk-card class="benchmark">
                                <vk-card-title class="colorful">Benchmark</vk-card-title>
                                <p>From {{ work_experience.benchmark.start }} To {{ work_experience.benchmark.to }}</p>
                                <p>Duration {{ work_experience.benchmark.duration.months }} Months /
                                    {{ work_experience.benchmark.duration.days }} Days</p>
                            </vk-card>
                        </div>
                    </vk-grid>
                </vk-card>
                <br/>
                <vk-card id="extra_curricular">
                    <vk-card-title>Extracurricular Activities 🏫</vk-card-title>
                    <vk-grid>
                        <div>
                            <router-link to="/profile/ktk"><h4>Katakorn of SUT ✨</h4></router-link>
                        </div>
                        <div>
                            <router-link to="/profile/s7"><h4>Suranivet 7 Dormitory (Graphics Creator) 🏢</h4>
                            </router-link>
                        </div>
                        <div>
                            <router-link to="/profile/sutsc"><h4>Student Council of SUT 👨‍🎓</h4></router-link>
                        </div>
                        <div>
                            <router-link to="/profile/sippanondha"><h4>Sippanondha Science Camp ⛺</h4></router-link>
                        </div>
                    </vk-grid>
                </vk-card>
                <br/>
                <vk-card id="aptitude">
                    <vk-card-title>Aptitude</vk-card-title>
                    <vk-grid>
                        <div>
                            <h5 @click="modalEng">English Language</h5>
                        </div>
                        <div>
                            <h5 @click="esanDialects">Local Dialects (E-SAN)</h5>
                        </div>
                        <div>
                            <h5 @click="programmingSkills">Programming</h5>
                        </div>
                        <div>
                            <h5 @click="graphicDesign">Graphic Design</h5>
                        </div>
                        <div>
                            <h5 @click="infraMgmt">Infrastructure Management</h5>
                        </div>
                        <div>
                            <h5 @click="operatingSys">Operating System</h5>
                        </div>
                    </vk-grid>
                </vk-card>
                <br/>
                <vk-card id="motto">
                    <vk-card-title>Motto / Verse</vk-card-title>
                    <vk-grid>
                        <div>
                            <span><h4>Hebrews 11:1 NIV</h4></span>
                            <span><h5>Now faith is confidence in what we hope for and assurance about what we do not see.</h5></span>
                        </div>
                    </vk-grid>
                </vk-card>
            </main>
        </div>
    </div>
    </app-layout>
</template>

<script>
import moment from 'moment';
import AppLayout from "../../Layouts/Main";

moment.locale('en');
let birthDayData = moment(new Date(1998, 0, 7, 15, 18, 30));
let workExperienceData = {
    bizpotential: {
        start: moment(new Date(2020, 7, 10, 10, 10, 10)),
        end: moment(new Date())
    },
    benchmark: {
        start: moment(new Date(2020, 2, 2, 9, 0, 0)),
        end: moment(new Date(2020, 5, 30, 17, 0, 0))
    }
}
let workExperienceDataDiff = {
    bizpotential: moment.duration(workExperienceData.bizpotential.end.diff(workExperienceData.bizpotential.start)),
    benchmark: moment.duration(workExperienceData.benchmark.end.diff(workExperienceData.benchmark.start))
}

export default {
    name: "About",
    metaInfo: {
        title: "About",
        meta: [
            { property: 'og:title', content: "About ARSANANDHA", vmid: 'og:title'},
            { property: 'og:site_name', content: 'ARSANANDHA',vmid: 'og:site_name'},
        ]
    },
    components: {
        AppLayout
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
            work_experience: {
                bizpotential: {
                    start: moment(workExperienceData.bizpotential.start).format('LLLL'),
                    to: moment(workExperienceData.bizpotential.end).format('LLLL'),
                    duration: {
                        months: workExperienceDataDiff.bizpotential.months(),
                        days: workExperienceDataDiff.bizpotential.days()
                    }
                },
                benchmark: {
                    start: moment(workExperienceData.benchmark.start).format('LLLL'),
                    to: moment(workExperienceData.benchmark.end).format('LLLL'),
                    duration: {
                        months: workExperienceDataDiff.benchmark.months(),
                        days: workExperienceDataDiff.benchmark.days()
                    }
                }
            }
        }
    },
    /* birthday() use for birthday data */
    methods: {
        birthDay() {
            this.diffDate = moment.duration(moment(new Date()).diff(birthDayData));
            this.yearBd = this.diffDate.years();
            this.monthBd = this.diffDate.months();
            this.dayBd = this.diffDate.days();
            this.hrBd = this.diffDate.hours();
            this.minBd = this.diffDate.minutes();
            this.secBd = this.diffDate.seconds();
            this.milsecBd = this.diffDate.milliseconds();
        },
        hosp() {
            window.location.replace('https://goo.gl/maps/FKf8aBayPY8qEdCX7');
        },
        modalEng() {
            this.$swal({
                "title": "Popup 🎉",
                "html": "<div class='uk-container'>" +
                    "<h4>English Skills</h4><p>Conversation Skills (Good - Very Good)</p>" +
                    "<progress class='uk-progress' value='75' max='100'></progress>" +
                    "<p>Grammar & Typo-Correction Skill (Fair - Good)</p>" +
                    "<progress class='uk-progress' value='34' max='100'></progress>" +
                    "</div>"
            })
        },
        esanDialects() {
            this.$swal({
                "title": "Popup 🎉",
                "html": "<div class='uk-container'>" +
                    "<h4>ความสามารถในภาษาเจ้าของจ้า</h4><p>เว้าและสื่อสารกับหมู่เจ้าของ (ดีมาก ฮอด ผู้เชี่ยวชาญ)</p>" +
                    "<progress class='uk-progress' value='94' max='100'></progress>" +
                    "<p>การแก้ไขแกรมม่าเมื่อหมู่เว้าพื้นเจ้าของ (ดีมาก ฮอด ผู้เชี่ยวชาญ)</p>" +
                    "<progress class='uk-progress' value='80' max='100'></progress>" +
                    "</div>"
            })
        },
        programmingSkills() {
            this.$swal({
                "title": "this.popup() 🎉",
                "html": "<div class='uk-container'>" +
                    "<h4>Programming Skills</h4>" +
                    "<p>C# (Fair - Good)</p>" +
                    "<progress class='uk-progress' value='35' max='100'></progress>" +
                    "<p>JavaScript [Vue,React.JS,React-Native,jQuery,Vanilla] (Very Good - Excellent)</p>" +
                    "<progress class='uk-progress' value='65' max='100'></progress>" +
                    "<p>Java (Fair)</p>" +
                    "<progress class='uk-progress' value='29' max='100'></progress>" +
                    "<p>PHP (Laravel [Lumens,Laravel]) (Very Good - Excellent)</p>" +
                    "<progress class='uk-progress' value='80' max='100'></progress>" +
                    "<p>Query (DDL,DML,Structured) Languages (GraphQL,JSON,PL/SQL,SQL,T-SQL) (Very Good - Excellent)</p>" +
                    "<progress class='uk-progress' value='70' max='100'></progress>" +
                    "<p><b>Need to Practicing in Rust,Spring Framework</b></p>" +
                    "</div>"
            })
        },
        graphicDesign() {
            this.$swal({
                "title": "Popup 🎉",
                "html": "<div class='uk-container'>" +
                    "<h4>Graphic Skills</h4>" +
                    "<p>Adobe After Effects (Good - Very Good)</p>" +
                    "<progress class='uk-progress' value='50' max='100'></progress>" +
                    "<p>Adobe Illustrator (Very Good - Excellent)</p>" +
                    "<progress class='uk-progress' value='85' max='100'></progress>" +
                    "<p>Adobe Photoshop (Very Good - Excellent)</p>" +
                    "<progress class='uk-progress' value='85' max='100'></progress>" +
                    "<p>DaVinci Resolve (Fair - Good)</p>" +
                    "<progress class='uk-progress' value='45' max='100'></progress>" +
                    "</div>"
            })
        },
        infraMgmt() {
            this.$swal({
                "title": "Popup 🎉",
                "html": "<div class='uk-container'>" +
                    "<h4>Infrastructure Management</h4>" +
                    "<p>Docker (Fair - Good)</p>" +
                    "<progress class='uk-progress' value='35' max='100'></progress>" +
                    "<p>VMWare ESXi (vSphere) (Fair - Good)</p>" +
                    "<progress class='uk-progress' value='35' max='100'></progress>" +
                    "</div>"
            })
        },
        operatingSys() {
            this.$swal({
                "title": "Popup 🎉",
                "html": "<div class='uk-container'>" +
                    "<h4>Operating System</h4>" +
                    "<p>Windows™ (10,Server 2019,Server 2016) (Very Good - Excellent)</p>" +
                    "<progress class='uk-progress' value='75' max='100'></progress>" +
                    "<p>Apple macOS (Fair - Good)</p>" +
                    "<progress class='uk-progress' value='60' max='100'></progress>" +
                    "<p>Linux (Ubuntu/Mint/CentOS) (Very Good - Excellent)</p>" +
                    "<progress class='uk-progress' value='80' max='100'></progress>" +
                    "</div>"
            })
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
@import "resources/sass/app"

.bizpotential
    background-color: pantone("bright-orange-u")
    color: white

.benchmark
    background-color: pantone("2756-c")
    color: white

.colorful.uk-card-title
    color: white

.backdrop.uk-card.uk-card-default
    background-color: black
</style>
