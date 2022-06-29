<template>
<div class="row" style="width: 100%;">
    <div class="col-md-6" id="tickets-card">

        <div class="dispTickets" v-if="hasTickets">
            <ul class="tickets-list row">
                <li class="" transition="expand" v-for="(ticket, index) in tickets">
                    <div class="item-holder details-box">
                        <div class="item-details">
                            <div class="ticketHeader">
                                <h5>{{ticket.name}}</h5>
                                <div class="ticket-status" v-if="!ticket.seen">
                                    <i class="fas fa-circle" style="color:#0087ff;"></i>New Ticket
                                </div>

                                <div class="ticket-status" v-else>
                                    <i class="fas fa-circle" style="color:lime;"></i>Seen
                                </div>

                                <!--<span id="show-modal" @click="showModal(ticket)"><i class="fas fa-paper-plane"></i></span>-->
                                <a v-bind:href="'mailto:'+ticket.email" title="Reply"><i class="fas fa-paper-plane"></i></a>
                                <a href="" title="Mark as Seen" @click.prevent="markRead(index)"><i class="fas fa-eye"></i></a>
                            </div>
                            <p> Email: {{ticket.email}}</p>
                            <div>{{ticket.message}}</div>
                        </div>
                        <hr></hr>
                    </div>
                </li>
            </ul>

<!--                <modal v-if="modalVisible" @close="modalVisible = false">
                //you can use custom content here to overwrite default content

                    <div slot="body">                                    
                        <div class="form-group">
                            <label for="reply">Reply</label>
                            <textarea class="form-control" id="reply" v-model="reply" placeholder="Type your reply" rows="3"></textarea>
                            <span class="error" v-if="replyError"> <small>Message reply cannot be empty!</small> </span>
                        </div>
                    </div>
            </modal>

                <b-modal
            id="modal-prevent-closing"
            ref="modal"
            title="Reply Ticket"
            @show="resetModal"
            @hidden="hideModal"
            @ok="handleOk"
            >
            <form ref="form" @submit.stop.prevent="handleSubmit">
            
                <div class="ticket-text-modal" v-if="modalVisible">
                    <h4>{{selectedTicket.name}}</h4>
                    <p> Email: {{selectedTicket.email}}</p>
                    <p>{{selectedTicket.message}}</p>
                </div>
                <b-form-group
                class="mb-0"
                label="Reply"
                label-for="reply"
                description="your reply will be sent via mail"
                >
                    <b-form-textarea
                        id="reply"
                        v-model="reply"
                        placeholder="Enter your reply"
                        lazy-formatter
                    ></b-form-textarea>
                </b-form-group>
            </form>
            </b-modal>
            -->
        </div>

        <div class="row empty-ticket justify-content-center" v-else>
            <img src="/images/norecords.png">
            <p>Hoorayy. No Tickets Here!! </p>

        </div>
    </div>
    <div class="col-md-6"> 
        <chart v-if="chartLoaded" v-bind:chartdata="chartData"></chart>
    </div>       
</div>
</template>

<script>
    const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3, SHOW_MODAL = 4;

    export default {
        mounted() {
            console.log('Component mounted.');
            this.getTicketItems();
            this.getStats();
        },
        computed: {
            chartLoaded(){
                return this.chartData !== null;
            },
            hasTickets(){
                return this.tickets.length > 0;
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
                tickets: [],
                currentStatus: STATUS_INITIAL,
                modalVisible: false,
                reply: '',
                replyError: false,
                selectedTicket: null,
                chartData: null,
                chartOptions: null,
            }
        },
        methods: {
            async getTicketItems() {
                var _this = this;
                console.log("Getting items");

                axios.get('/api/gettickets').then(function (response) {
                    console.log("Tickets", response.data.data);
                    _this.tickets = response.data.data;
                });

            },
            async getStats() {
                var _this = this;
                console.log("Getting items");

                axios.get('/api/getstats').then(function (response) {
                    console.log("Tickets", response.data);
                    let data = {
                        labels: response.data.labels,
                        datasets: [{
                                label: 'Site Visits',
                                fill: false,
                                borderColor: 'rgb(255, 99, 132)',
                                data: response.data.dataset.site
                            },
                            {
                                label: 'Article Visits',
                                fill: false,
                                borderColor: 'rgb(69, 106, 200)',
                                data: response.data.dataset.article
                            },
                            {
                                label: 'Blog Visits',
                                fill: false,
                                borderColor: 'rgb(52, 144, 220)',
                                data: response.data.dataset.blog
                            },
                            {
                                label: 'Analysis Visits',
                                fill: false,
                                borderColor: 'rgb(58, 181, 122)',
                                data: response.data.dataset.analysis
                            }
                        ]
                    }
                    _this.chartData = data;
                });

            },
            showModal(ticket){
                this.modalVisible = true;
                this.selectedTicket = ticket;
                this.$bvModal.show('modal-prevent-closing');
            },
            checkFormValidity() {
                const valid = this.$refs.form.checkValidity()
                this.replyState = valid
                return valid
            },
            resetModal() {
                this.modalVisible = true,
                this.reply = ''
                this.replyState = null
            },
            hideModal() {
                this.modalVisible = false,
                this.reply = ''
                this.replyState = null
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit()
            },
            handleSubmit() {
                // Exit when the form isn't valid
                if (!this.checkFormValidity()) {
                    return
                }
                // Push the name to submitted names
                this.submittedNames.push(this.name)
                // Hide the modal manually
                this.$nextTick(() => {
                this.$bvModal.hide('modal-prevent-closing')
                })
            },
            markRead(index) {
                let ticket = this.tickets[index];
                console.log("Mark read", index, ticket);

                var _this = this;
                console.log("Getting items");

                axios.get('/api/ticketread/' + ticket.uid).then(function (response) {
                    console.log("Tickets", response.data.data);
                    _this.tickets.splice(index, 1);
                }).catch(err => {
                    console.log(err);
                });

            },
            
        }
    }
</script>
