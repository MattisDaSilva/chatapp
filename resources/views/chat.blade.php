 @extends('layouts.app')
 @section('content')
 <div class="container" id="app">
    <div id='userIdMessage' data-user-id="{{ auth()->id() }}" display='hidden'></div>
     <div class="card">
         <div class="card-header">Chats</div>
         <div class="card-body">
             <chat-messages :messages="messages">
                @csrf
                @method('DELETE')</chat-messages>
         </div>
         <div class="card-footer">
             <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
         </div>
     </div>
 </div>
 @endsection
