import { createApp } from 'vue';
import axios from 'axios'; // Importez axios pour pouvoir effectuer des requêtes HTTP

// Importez vos composants Vue
import ExampleComponent from './components/ExampleComponent.vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';

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
