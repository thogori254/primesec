<template>
    <div class="container">
        <ul class="tickets-list subs-list row" v-if="hasSubscriptions">
            <li class="col-md-6" transition="expand" v-for="(sub, index) in subscriptions">
    
                <div class="ticketHeader subs-header">
                    <h5>{{sub.email}}</h5>
                    <div class="ticket-status" v-if="sub.active">
                        <i class="fas fa-circle" title="active" style="color:#green;"></i>
                    </div>

                    <div class="ticket-status" v-else>
                        <i class="fas fa-circle"  title="opted out" style="color:lime;"></i>
                    </div>

                    <!--<span id="show-modal" @click="showModal(ticket)"><i class="fas fa-paper-plane"></i></span>-->
                    <a v-bind:href="'mailto:'+sub.email" title="Mail"><i class="fas fa-paper-plane"></i></a>
                </div>
                <hr></hr>
            </li>
        </ul>

    </div>
</template>

<script>
    const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3, SHOW_MODAL = 4;

    export default {
        mounted() {
            console.log('Component mounted.')
            this.getSubscriptions();
        },
        computed: {
            hasSubscriptions(){
                return this.subscriptions.length > 0;
            },
            isInitial() {
                return this.currentStatus === STATUS_INITIAL;
            },
            isSaving() {
                return this.currentStatus === STATUS_SAVING;
            },
            isSuccess() {
                return this.currentStatus === STATUS_SUCCESS;
            },
            isFailed() {
                return this.currentStatus === STATUS_FAILED;
            }
        },
        data(){
            return {
                subscriptions: [],
                currentStatus: STATUS_INITIAL,
            }
        },
        methods: {
            async getSubscriptions() {
                var _this = this;
                console.log("Getting items");

                axios.get('/api/getsubscriptions').then(function (response) {
                    console.log("Subscriptions", response.data.data);
                    _this.subscriptions = response.data.data;
                });

            },
        }

    }
</script>
