<template>
    <app-layout>
        <div class="uk-container uk-padding-small">
            <vk-card>
                <vk-card-title>🤝🤝 ขอขอบคุณนะครับ</vk-card-title>
                <p>
                    " There are two ways to live your life. <br/>
                    One is as though nothing is a miracle. <br/>
                    The other is as though everything is a miracle " <br/>
                    Albert Einstein
                </p>
                <h2>คุณคือคนที่ {{ last_number }} ที่มาแสดงความยินดีกับผมนะครับ</h2>
                <h4>ขอให้คุณมีความสุขมากๆนะครับ หลังจากนี้คุณจะได้รับการ์ดทั้งดิจิทัลและการ์ดจริง หลังจากที่ผมติดต่อกลับไปตามที่ให้ไว้นะครับ ขอบคุณมากๆนะครับ</h4>
            </vk-card>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../../Layouts/Main";

export default {
    name: "ThanksEnd",
    components: {AppLayout},
    props: [
        'last_number'
    ]
}
</script>

<style lang="sass" scoped>
</style>
