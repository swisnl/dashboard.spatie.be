<template>
    <tile :position="position" modifiers="overflow">
        <transition name="fade">
            <section v-if="state === 'totals'" class="statistics statistics--absolute" key="totals">
                <h1>GoT - Totals</h1>
                <ul>
                    <li class="statistic" v-for="total in totals" :key="total.author_slug">
                        <span class="statistic__label">{{ total.author }}</span>
                        <span class="statistic__count">{{ formatNumber(total.score) }}</span>
                    </li>
                </ul>
            </section>
            <section v-if="state === 'month'" class="statistics statistics--absolute" key="month">
                <h1>GoT - Last month</h1>
                <ul>
                    <li class="statistic" v-for="total in month" :key="total.author_slug">
                        <span class="statistic__label">{{ total.author }}</span>
                        <span class="statistic__count">{{ formatNumber(total.score) }}</span>
                    </li>
                </ul>
            </section>
            <section v-if="state === 'teams'" class="statistics statistics--absolute" key="teams">
                <h1>GoT - Teams</h1>
                <ul>
                    <li class="statistic" v-for="(team, index) in teams" :key="team.author_slug">
                        <span class="statistic__label">{{ team.author }}</span>
                        <span v-if="index === 0" class="statistic__crown h-icon"></span>
                        <span class="statistic__count">{{ formatNumber(team.score) }}</span>
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
                totals: [],
                month: [],
                teams: [],
            };
        },

        computed: {
            state() {
                return this.states[this.stateIndex];
            },

            states() {
                return [
                    'totals',
                    'month',
                    'teams',
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
                    'GameOfTests.TotalsFetched': response => {
                        this.totals = response.totals;
                    },
                    'GameOfTests.LastMonthFetched': response => {
                        this.month = response.month;
                    },
                    'GameOfTests.TeamsFetched': response => {
                        this.teams = response.teams;
                    },
                };
            },

            getSaveStateConfig() {
                return {
                    cacheKey: 'gameOfTests',
                    saveProperties: [
                        'totals',
                        'month',
                        'teams',
                    ],
                };
            },

            nextState() {
                this.stateIndex = (this.stateIndex + 1) % this.states.length;
            },
        },
    };

</script>
