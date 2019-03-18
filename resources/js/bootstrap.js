window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

import Echo from 'laravel-echo';

window.io = require('socket.io-client');

let bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjUzYTg0NzA4OTM5Nzc0MTc3YzQwNDhjN2RlMmE3NDg3MDA4NDE4ODQ4NTAxNzgzZjRjYmU3NGMzMjM1OTkwZDFlZjIyYTM4MjVjYWJhMWNjIn0.eyJhdWQiOiIxIiwianRpIjoiNTNhODQ3MDg5Mzk3NzQxNzdjNDA0OGM3ZGUyYTc0ODcwMDg0MTg4NDg1MDE3ODNmNGNiZTc0YzMyMzU5OTBkMWVmMjJhMzgyNWNhYmExY2MiLCJpYXQiOjE1NTI5MjQ0NDksIm5iZiI6MTU1MjkyNDQ0OSwiZXhwIjoxNTg0NTQ2ODQ5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.uVP-7mEEr84R8fIs0olKRlVpT0tuBPn1N76fYogmzVBYbSFgj5E4W7hcV7Luy-tYpNyiWy54IuIlk3DlindA12DHW6e2FQIDWTcxKTNEntiXK7Kfnp1du56xS0OwfEu2SQrosbB7C5IB52QA5ulMVP4eqvlJsZhUz4GOUIvrIWzm2XhOKfvORdL30vRmN9MfygdvU_yda2CN9GeWQKfTMutCkqV4oyPCIM04u75awKSvF4tNAS_wzEx-UTcqnEHZ_Rnuz-xa9L4AnKI1xid9r-01phf30f5Bu6E32EtQKIdLwi-iXsFD4xpS7t3m5M9qQH-PH0vrI3cURHBSspcjc0HsLYm25bD1S558XjZiw3_de-Kb7YiEr8daXne0GTVbceh4ZFOtGc5KzULlabo3t8EdRYBn9C9xG3DeRuVxwrSOPxSrCeTmUqx2iq4Mp2xsHyA0mHI3CPRrbROgGSIMDYJRu7garsH3LTfpEJWNsaO_bZZEOlJsh6_QNTtC61p0GTRcaXKo5WDtkopY3gpNTkQ7OOrdejat45O9RU32CI-CwNsMHPBrD5oFe9aU2LUYeyBdPANNpVm3y_GoR5FZ0L1wwhRaz6DCwthZWNUt0xCbV0wDJzn0jx4vYi6l6DW79Fz5YSmy__TGtNSN_M0-o-BX436V0prI2k07W0WU_KM';

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':3000',
    auth: {
        headers: {
            'Authorization': "Bearer " + bearerToken
        }
    }
});

