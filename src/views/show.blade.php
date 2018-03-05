@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Threads
@endsection

@section('main-content')
  <show-thread-container :thread_id="{{ $thread_id }}" :user="{{ $user }}"></show-thread-container>
@endsection