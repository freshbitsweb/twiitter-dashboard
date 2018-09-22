
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#application',

    data: {
        twit: {
            text: 'હજી કય મડુ નથિ ભુરા.',
            created_at: '',
            fontSize: 100,
        }
    },

    watch: {
        'twit.text': function (text) {
            if (text.length > 200) {
                this.twit.fontSize = 40;
            } else if (text.length > 80) {
                this.twit.fontSize = 70;
            } else {
                this.twit.fontSize = 100;
            }
        }
    },

    created: function () {
        window.Echo.channel('new-twit-channel').listen('NewTwitRecived', (e) => {
            this.twit.text = e.twit.text;
            this.twit.created_at = e.twit.created_at;
        });
    }
});
