<template>
    <div v-bind:style="{ 'background-image': 'url(' + s7Image + ')',backgroundPosition:'center',backgroundSize:'cover' }">
        <Main>
            <div class="uk-container uk-padding-large uk-text-center">
                <vk-card class="glass">
                    <ActivityPhoto
                        v-bind:photolink="s7Image"
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
        name: "Suranivet7",
        components: {ActivityPhoto, Main},
        methods: {
            listFriends: () => {
                console.table(this.friendList)
            }
        },
        metaInfo:{
            title:"Suranivet 7 Friends"
        },
        data: () => {
            return{
                s7Image : require('../../../../img/s7/suranivet7sharp8.jpg').default,
                description: "S U R A N I V E T | S E 7 E N",
                role: "Took on 5 March 2017 , 06:51 AM at Center of Library and Educational Media",
                friendList: {
                    "nameOfFriends":[
                        "Por Chainarin" ,
                        "Kanomjeen Sawapa" ,
                        "Tom Wuttichai" ,
                        "Bori Boripat" ,
                        "Off Kachanon" ,
                        "C-Tose Narongsak" ,
                        "Group Jirattiti" ,
                        "Ta Ronnarit" ,
                        "Som Methathorn" ,
                        "Champ Worawich" ,
                        "Tin Tin" ,
                        "Kao Nidhisin" ,
                        "Ping Aekkasit" ,
                        "Pu Natthasit" ,
                        "Boy Apichet" ,
                        "Pleum Nawapat" ,
                        "P' Supphakorn" ,
                        "Frame Thanapat" ,
                        "Jab Namchai" ,
                        "Men Nakkarin" ,
                        "Nutcha Surasak" ,
                        "Benz Thammanun" ,
                        "Bomb Natthawut" ,
                        "Brand Paramet" ,
                        "Tan Rames" ,
                        "Ton Jirawat" ,
                        "Oat Chatuphon" ,
                        "Art Pratchaya"
                    ]
                }
            }
        },
        computed: {
            listFriends(){
                return this.friendList.nameOfFriends;
            }
        },
        mounted() {
            console.table(this.listFriends);
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
