<!-- resources/views/chat.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container col-6 mt-5">
    <div class="card">
        <div class="card-header">Chats</div>
        <div class="card-body scroll">
            <chat-room v-on:chooseroom="getchosenroom" :rooms="rooms"></chat-room>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>
<div class="container col-6 mt-5">
    <div class="card">
        <div class="card-header">Chats</div>
        <div class="card-body scroll">
            <chat-messages :messages="messages"></chat-messages>
        </div>
        <div class="card-footer">
            <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}" :roomchosen="roomchosen"></chat-form>
        </div>
    </div>
</div>
@endsection