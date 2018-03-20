<template>
    <tile :position="position" modifiers="overflow">
        <section class="github-events">
            <h1 class="github-events__title">GitHub Activity</h1>
            <ul class="github-events__events">
                <template v-for="event in events">
                    <li class="github-events__event" v-if="event.action !== false">
                        <img class="github-events__event__avatar" :src=event.avatar_url>
                        <div class="github-events__event__row">
                            <span class="github-events__event__actor">{{ event.actor }}</span> {{ event.action }}
                        </div>
                        <div class="github-events__event__repo">{{ event.repo }}</div>
                    </li>
                </template>
            </ul>
        </section>
    </tile>
</template>

<script>
    import {formatNumber} from '../helpers';
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
                events: []
            };
        },

        methods: {
            formatNumber,

            getEventHandlers() {
                return {
                    'GitHub.EventsFetched': response => {
                        this.events = response.events;
                    },
                };
            },

            getSaveStateConfig() {
                return {
                    cacheKey: 'github',
                };
            },
        },
    };
</script>