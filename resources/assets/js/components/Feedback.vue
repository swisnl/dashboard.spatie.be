<template>
    <tile :position="position" modifiers="overflow">
        <section class="statistics">
            <h1>Service</h1>
            <ul>
                <li class="statistic">
                    <span class="statistic__label">Tevreden</span>
                    <span class="statistic__count">{{ feedback.tevreden}}</span>
                </li>
                <li class="statistic">
                    <span class="statistic__label">Neutraal</span>
                    <span class="statistic__count">{{ feedback.neutraal}}</span>
                </li>
                <li class="statistic">
                    <span class="statistic__label">Ontevreden</span>
                    <span class="statistic__count">{{ feedback.ontevreden}}</span>
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
