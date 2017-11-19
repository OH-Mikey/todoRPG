@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>
    </div>
@endsection

@section('script')
    <script>
        axios.get('users/'+ '{{ auth()->id() }}' +'/achievements')
            .then(function(res) {

            });
    </script>
@endsection