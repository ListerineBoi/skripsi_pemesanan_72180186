/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('chat-room', require('./components/ChatRoom.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
const app = new Vue({
    el: '#app',
    //Store chat messages for display in this array.
    data: {
        messages: [],
        rooms: [],
        jasas: [],
        roomchosen:''
    },
    //Upon initialisation, run fetchMessages(). 
    created() {
        //console.log(this.$userId);
        this.fetchRoom();
        this.fetchjasa()
        window.Echo.channel('chat')
        .listen('MessageSent', (e) => {
            console.log(e.message.room_id);
            if(e.message.room_id==this.roomchosen.room){
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });

                
            }
            this.fetchRoom();
        });
        
    },
    methods: {
        fetchMessages() {
            //GET request to the messages route in our Laravel server to fetch all the messages
            axios.get('/messagesfetch/'+this.roomchosen.room).then(response => {
                //Save the response in the messages array to display on the chat view
                this.messages = response.data;
                // var wow= JSON.stringify(this.messages);
                // console.log(wow);
            });
            //console.log('/messagesfetch/'+this.roomchosen.room);
        },
        fetchRoom() {
            axios.get('/room/'+this.$userId).then(response => {
                this.rooms = response.data;
                
            });
        },
        fetchjasa() {
            axios.get('/jasa/'+this.$userId).then(response => {
                this.jasas = response.data;
                var wow= JSON.stringify(response.data);
            });
        },
        //Receives the message that was emitted from the ChatForm Vue component
        addMessage(message) {
            //Pushes it to the messages array
            this.messages.push(message);
            //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
            axios.post('/messages', message).then(response => {
                //console.log(response.data);
            });
            this.fetchRoom();
        },
        getchosenroom(room) {
                this.roomchosen = room;
                this.fetchMessages();
            
        },
        createroom(jenis,tipejasa,jasa_id) {
            axios.get('/createroom/'+jenis.jenis+'/'+jenis.tipejasa+'/'+jenis.jasa_id).then(response => {
                //Save the response in the messages array to display on the chat view
                //console.log(response.data);
                
            });
            this.fetchRoom();
            //console.log(this.$userId)
            //console.log('/createroom/'+this.$userId+'/'+jenis.jenis+'/'+jenis.tipejasa+'/'+jenis.jasa_id);
        },
        delroom(rm_id) {
            axios.get('room/del/'+rm_id.rm_id).then(response => {
                //console.log(response.data);
                
            });
            this.fetchRoom();
            
            //console.log('/createroom/'+this.$userId+'/'+jenis.jenis+'/'+jenis.tipejasa+'/'+jenis.jasa_id);
        },
        
    }
});
