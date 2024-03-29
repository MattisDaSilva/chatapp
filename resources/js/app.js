import { createApp } from 'vue';
import axios from 'axios'; // Importez axios pour pouvoir effectuer des requêtes HTTP
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Importez vos composants Vue
import ExampleComponent from './components/ExampleComponent.vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const currentUserElement = document.getElementById('userIdMessage');
const currentUserId = currentUserElement.dataset.userId;
// Créez une application Vue
const app = createApp({
    // Initialisation de l'état de l'application
    data() {
        return {
            messages: [] // Initialisez le tableau de messages
        };
    },
    // Méthodes de l'application
    created() {
        this.fetchMessages(); // Appelez fetchMessages lors de la création de l'application
        window.Echo.private('chat')
            .listen('MessageSent', (e) => {
                if (e.user.id != currentUserId) {
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                }
            })
            .listen('MessageDeleted', (e) => {
                // Retirer le message supprimé de la liste des messages
                this.messages = this.messages.filter(message => message.id !== e.message.id);
            });
    },
    methods: {
        fetchMessages() {
            // Effectuez une requête GET pour récupérer les messages depuis le serveur
            axios.get('/messages').then(response => {
                this.messages = response.data; // Mettez à jour le tableau de messages avec les données récupérées
            }).catch(error => {
                console.error('Erreur lors de la récupération des messages:', error);
            });
        },
        addMessage(message) {
            // Ajoutez un message au tableau de messages
            this.messages.push(message);
            // Effectuez une requête POST pour envoyer le message au serveur
            axios.post('/messages', message).then(response => {
                console.log('Message envoyé avec succès:', response.data);
            }).catch(error => {
                console.error('Erreur lors de l\'envoi du message:', error);
            });
        }
    }

});

// Enregistrez les composants Vue
app.component('example-component', ExampleComponent);
app.component('chat-messages', ChatMessages);
app.component('chat-form', ChatForm);

// Montez l'application Vue sur l'élément avec l'id "app"
app.mount('#app');
