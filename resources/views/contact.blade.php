@extends('layouts.app')

@section('content')
    @if (count($people))
        <ul>Hello to my friends:</ul>
        @foreach ($people as $person)
        
            <li>{{$person}}</li>
            
        @endforeach
        
    @endif
    
@endsection

@section('footer')
    
@endsection