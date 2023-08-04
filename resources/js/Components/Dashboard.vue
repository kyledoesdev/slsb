<template>
    <div id="post-maker">
        <createpost :storeroute="this.storeroute"></createpost>
    </div>
</template>

<script>
    import Toast from './Global/Toast.vue';

    export default {
        components: { Toast },
        name: 'Dashboard',
        props: ['storeroute'],

        data: function() {
            
        },
    };
</script>
