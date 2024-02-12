<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages" :key="message.id">
            <div class="clearfix">
                <div class="header">
                    <strong>
                        {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
                <button @click="deleteMessage(message.id)">Supprimer</button>
            </div>
        </li>
    </ul>
</template>
<script>
import axios from 'axios';
export default {
    props: ["messages"],

    methods: {
    deleteMessage(messageId) {
      axios.delete('/messages/' + messageId)
        .then(response => {
          console.log('Message supprimé avec succès');
        })
        .catch(error => {
          console.error('Erreur lors de la suppression du message :', error);
        });
    }
  },

};

</script>
