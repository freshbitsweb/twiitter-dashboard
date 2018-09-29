
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
        tweet: {
            text: 'હજી કય મડુ નથિ ભુરા.',
            created_at: Date.now(),
            from_created_at: '',
            userName: '',
            fontSize: 100,
        }
    },

    methods : {
        updateCreatedTime : function() {
            var application = this;
            setInterval(function() {
                application.tweet.from_created_at = moment(application.tweet.created_at).fromNow();
            }, 3000);
        }
    },

    watch: {
        'tweet.text': function (text) {
            if (text.length > 200) {
                this.tweet.fontSize = 40;
            } else if (text.length > 80) {
                this.tweet.fontSize = 70;
            } else {
                this.tweet.fontSize = 100;
            }
        }
    },

    created: function () {
        window.Echo.channel('new-tweet-channel').listen('NewTweetRecived', (e) => {
            this.tweet.text = e.tweet.text;
            this.tweet.created_at = e.tweet.created_at;
            this.tweet.userName = e.tweet.user_name;
        });

        this.updateCreatedTime();
    }
});
