@extends('layouts.app')

@section('content')
    <h1>the id: {{$id}}</h1>
    <h1>the name: {{$name}}</h1>
    <h1>the pass: {{$pass}}</h1>
@endsection
@section('footer')

<script>alert('hello visitor');</script>
    
@endsection

