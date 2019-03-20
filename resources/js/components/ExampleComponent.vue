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
                                <input placeholder="User ID" class="form-control" id="userId" v-model="userId"/>
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
                                <input placeholder="Receivers ID (через запятую)" class="form-control"  v-model="receivers"/>
                            </div>
                            <div class="form-group">
                                <input placeholder="Chat ID" class="form-control" v-model="chatId"/>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Message" class="form-control" id="message"
                                          v-model="message"></textarea>
                            </div>
                            <button @click="sendMessage" class="btn btn-success">Send</button>
                            <button @click="getMessages" class="btn btn-success">Get history</button>
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
                chatId: '',
                receivers: '',
                token: '',
                userId: '',
            }
        },
        mounted() {
            window.Echo.private('chat.' + window.getCookie('userId'))
                .listen('Message', ({message}) => {
                    this.messages.push(message.from + ' - ' +message.message);
                });
        },
        methods: {
            sendMessage() {
                axios.post('/api/messages/send',
                    {
                        message: this.message,
                        chatId: this.chatId,
                        receivers: this.receivers,
                    },
                    {
                        headers: {'Authorization': "Bearer " + window.getCookie('token')}
                    }
                );

                this.messages.push(this.userId + ' - ' + this.message);
                this.message = '';
            },
            getMessages() {
                if (this.chatId.trim() === '') {
                    alert('Chat ID is empty');
                }
                axios.get('/api/messages/get/' + this.chatId,
                    {
                        headers: {'Authorization': "Bearer " + window.getCookie('token')}
                    }
                )
                    .then(response => {
                        console.log(response);
                        let data = response.data;
                        for (let index in data) {
                            let item = data[index];
                            this.messages.push(item.user_id + ' - ' + item.message);
                        };
                    });
            },
            addToken() {
                document.cookie = "token=" + this.token;
                document.cookie = "userId=" + this.userId;
                alert('Token was set. Please refresh the page.');
            },
            getToken() {
                this.token = window.getCookie('token');
                this.userId = window.getCookie('userId');
            }
        }
    }
</script>
