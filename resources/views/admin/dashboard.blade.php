@extends('adminlte::page')

@section('title', 'لوحة التحكم')

@section('content_header')
    <h1>لوحة القيادة</h1>
@stop

@section('content')
    <p>مرحباً بك في لوحة الإدارة الجديدة.</p>
    {{-- هنا تضع محتوى الصفحة --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop