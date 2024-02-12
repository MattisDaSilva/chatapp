<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages" :key="message.id">
            <div class="clearfix">
                <div class="header">
                    <strong>
                        {{ message.user.name }}
                    </strong>
                </div>
                <p v-html="formatMessage(message.message)"></p>
                <button v-if="permission" @click="deleteMessage(message.id)">Supprimer</button>
            </div>
        </li>
    </ul>
</template>
<script>
import axios from 'axios';
export default {
    props: ["messages", "permission"],

    methods: {
        deleteMessage(messageId) {
            axios.delete('/messages/' + messageId)
                .then(response => {
                    console.log('Message supprimé avec succès :', response.data);
                })
                .catch(error => {
                    console.error('Erreur lors de la suppression du message :', error);
                });
        },
        validateURL(url) {
            var regex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s<>]*$/i;
            var isValidURL = regex.test(url);
            var isSafeURL = !url.includes('javascript:');
            return isValidURL && isSafeURL;
        },
        formatMessage(message) {
            message = message.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            message = message.replace(/\*(.*?)\*/g, '<em>$1</em>');
            message = message.replace(/~(.*?)~/g, '<u>$1</u>');
            message = message.replace(/~~(.*?)~~/g, '<del>$1</del>');
            message = message.replace(/\[color=(.*?)\](.*?)\[\/color\]/g, '<span style="color: $1">$2</span>');
            let self = this;
            message = message.replace(/\b(https?:\/\/\S+(?:png|jpe?g|gif)\S*)\b/gim, function (match) {
                if (self.validateURL(match)) {
                    return '<img src="' + match + '" alt="image" style="max-width: 100%;">';
                } else {
                    return match; // Lien non valide, le renvoyer tel quel
                }
            });
            message = message.replace(/<script.*?<\/script>/gi, '[Script removed]');
            return message;
        },
        hasPermission(permission) {
            if (this.user && this.user.permissions) {
                return this.user.permissions.includes(permission);
            } else {
                return false;
            }
        }
    },

};

</script>
