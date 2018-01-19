<template>
    <tile :position="position" modifiers="overflow swis-color swis-background above"></tile>
</template>

<script>
    import Tile from './atoms/Tile';

    export default {

        components: {
            Tile,
        },

        props: ['position'],
    };
</script>
