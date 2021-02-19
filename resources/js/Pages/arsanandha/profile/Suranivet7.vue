<template>
    <div>
        <div class="uk-container-large uk-align-center">
            <h3 style="text-align: center">S U R A N I V E T | S E 7 E N</h3>
            <kinesis-container :active="true">
                <kinesis-element :strength="5" type="depth">
                    <img class="uk-align-center" width="65%" :src="s7Image"/>
                </kinesis-element>
            </kinesis-container>
            <p style="text-align: center">Took on 5 March 2017 , 06:51 AM at Center of Library and Educational Media</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Suranivet7",
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
                s7Image : require('../../../../img/s7/suranivet7sharp8.jpg'),
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

</style>
