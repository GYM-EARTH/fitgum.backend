<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
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
                message: [],
                textMessage: ''
            }
        },
        mounted() {
            window.Echo.private('chat.1')
                .listen('TestMessage', ({message}) => {
                    console.log(message);
                });

            console.log('Component mounted.')
        }
    }
</script>
