<template>
    <tile :position="position" modifiers="overflow">
        <section class="feedback-section">
            <h1 class="feedback-section__header">Service feedback</h1>
            <ul class="feedback-list">
                <li class="feedback">
                    <img class="feedback__image" src="../../../../node_modules/twemoji/2/svg/1f600.svg">
                    <span class="feedback__count">{{ feedback.tevreden}}</span>
                </li>
                <li class="feedback">
                    <img class="feedback__image" src="../../../../node_modules/twemoji/2/svg/1f610.svg">
                    <span class="feedback__count">{{ feedback.neutraal}}</span>
                </li>
                <li class="feedback">
                    <img class="feedback__image" src="../../../../node_modules/twemoji/2/svg/1f625.svg">
                    <span class="feedback__count">{{ feedback.ontevreden}}</span>
                </li>
            </ul>
        </section>
    </tile>
</template>

<script>
    import echo from '../mixins/echo';
    import Tile from './atoms/Tile';
    import saveState from 'vue-save-state';

    export default {

        components: {
            Tile,
        },

        mixins: [echo, saveState],

        props: ['position'],

        data() {
            return {
                feedback: [],
            };
        },

        methods: {
            getEventHandlers() {
                return {
                    'Service.FeedbackFetched': response => {
                        this.feedback = response;
                    },
                };
            },

            getSaveStateConfig() {
                return {
                    cacheKey: 'feedback',
                };
            },
        },
    };
</script>
