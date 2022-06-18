<!-- resources/views/chat.blade.php -->
@extends('layouts.appadmin')
@section('content')
<meta name="user-id" content="{{ Auth::guard('admin')->user()->id }}">
<div class='row'>
    <div class="container col-6 mt-5">
        <div class="card">
            <div class="card-header">Chats</div>
            <div class="card-body scroll">
                <chat-room v-on:chooseroom="getchosenroom" v-on:newroom="createroom" v-on:dlroom="delroom" :admin ="1" :rooms="rooms" :jasas="jasas"></chat-room>
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
                <chat-form v-on:messagesent="addMessage" :user="{{ Auth::guard('admin')->user() }}" :roomchosen="roomchosen"></chat-form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection