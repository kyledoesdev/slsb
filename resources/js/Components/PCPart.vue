<template>
    <div>
        <img :src="this.src" alt="" style="max-width: 75px; max-height: 75px;">
        <br>
        <span>{{ this.name }}</span>
    </div>
</template>

<script>
    export default {
        name: 'PCPart',
        props: ['img', 'name'],

        data() {
            return {
                src: this.img,
                name: this.name
            }
        }
    }
</script>