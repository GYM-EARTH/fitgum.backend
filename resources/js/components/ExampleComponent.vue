<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">Chat</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea placeholder="Token" class="form-control" id="token"
                                          v-model="token"></textarea>
                            </div>
                            <div class="form-group">
                                <input placeholder="Receiver ID" class="form-control" id="userId" v-model="userId"/>
                            </div>
                            <button @click="addToken" class="btn btn-success">Set token</button>
                            <button @click="getToken" class="btn btn-primary">Get token</button>
                        </div>
                    </div>

                </div>
                <div class="card card-default">
                    <div class="card-header">Chat</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input placeholder="Receiver ID" class="form-control" id="receiver" v-model="receiver"/>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Message" class="form-control" id="message"
                                          v-model="message"></textarea>
                            </div>
                            <button @click="sendMessage" class="btn btn-success">Send</button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea placeholder="Messages" readonly class="form-control" id="messages">{{messages.join('\n')}}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messages: [],
                message: '',
                receiver: '',
                token: '',
                userId: '',
            }
        },
        mounted() {
            window.Echo.private('chat.' + window.getCookie('userId'))
                .listen('TestMessage', ({message}) => {
                    console.log(message);
                });
        },
        methods: {
            sendMessage() {
                axios.post('/messages',
                    {
                        message: this.message,
                        receiver: this.receiver,
                    },
                    {
                        headers: {'Authorization': "Bearer "}
                    }
                );

            },
            addToken() {
                document.cookie = "token=" + this.token;
                document.cookie = "userId=" + this.userId;
                alert('Token was set');
            },
            getToken() {
                this.token = window.getCookie('token');
                this.userId = window.getCookie('userId');
            }
        }
    }
</script>
