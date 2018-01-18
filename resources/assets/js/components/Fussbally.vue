<template>
    <tile :position="position" modifiers="overflow">
        <transition name="fade">
            <section v-if="state === 'trueskill'" class="statistics statistics--absolute" key="totals">
                <h1 class="fussbally__header">Fussbally<span>.</span></h1>
                <ul>
                    <li class="statistic" v-for="(user, id) in stats">
                        <span class="statistic__label">{{ user.name }}</span>
                        <span class="statistic__count">{{ user.trueskill }}</span>
                    </li>
                </ul>
            </section>
            <section v-if="state === 'changed'" class="statistics statistics--absolute" key="month">
                <h1 class="fussbally__header">Fussbally<span>.</span></h1>
                <ul>
                    <li class="statistic" v-for="(user, id) in stats">
                        <span class="statistic__label">{{ user.name }}</span>
                        <span v-bind:class="[user.trueskill_difference > 0 ? 'fussbally__up' : 'fussbally__down', 'statistic__count']">{{ user.trueskill_difference }}</span>
                    </li>
                </ul>
            </section>
        </transition>
    </tile>
</template>

<script>
    import { formatNumber } from '../helpers';
    import echo from '../mixins/echo';
    import Tile from './atoms/Tile';
    import saveState from 'vue-save-state';

    const STATE_TIMER = 10000;

    export default {

        components: {
            Tile,
        },

        mixins: [echo, saveState],

        props: ['position'],

        data() {
            return {
                interval: null,
                stateIndex: 0,
                stats: [],
            };
        },

        computed: {
            state() {
                return this.states[this.stateIndex];
            },

            states() {
                return [
                    'changed',
                    'trueskill',
                ];
            },
        },

        created() {
            this.interval = setInterval(() => {
                this.nextState();
            }, STATE_TIMER);
        },

        beforeDestroy() {
            clearInterval(this.interval);
            this.interval = null;
        },

        methods: {
            formatNumber,

            getEventHandlers() {
                return {
                    'Fussbally.StatsFetched': response => {
                        this.stats = response.stats;
                    },
                };
            },

            getSaveStateConfig() {
                return {
                    cacheKey: 'fussbally',
                    saveProperties: [
                        'stats',
                    ],
                };
            },

            nextState() {
                this.stateIndex = (this.stateIndex + 1) % this.states.length;
            },
        },
    };

</script>
