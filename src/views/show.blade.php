@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Threads
@endsection

@section('main-content')
  <show-thread-container :thread="{{ $thread }}"></show-thread-container>
@endsection