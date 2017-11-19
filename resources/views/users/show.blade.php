@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>
        <div id="vueApp">
            <i v-show='gaming' :class="gaming"></i>
            <i v-show='working' :class="working"></i>
            <i v-show='thinking' :class="thinking"></i>
            <i v-show='eating' :class="eating"></i>
            <i v-show='reading' :class="reading"></i>
            <i v-show='drinking' :class="drinking"></i>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" src="https://vuejs.org/js/vue.js"></script>
    <script>
        new Vue({
            el:"#app",
            data:{
                gaming: '',
                working: '',
                thinking: '',
                eating: '',
                reading: '',
                drinking: ''
            },
            mounted: function() {
                var vm = this;
                axios.get('users/'+ '{{ auth()->id() }}' +'/achievements')
                    .then(function(res) {
                        vm.gaming = res.data.gaming ? 'icon game' : false;
                        vm.working = res.data.working ? 'icon desktop' : false;
                        vm.thinking = res.data.thinking ? 'icon comment' : false;
                        vm.eating = res.data.eating ? 'icon food' : false;
                        vm.reading = res.data.reading ? 'icon book' : false;
                        vm.drinking = res.data.drinking ? 'icon coffee' : false;
                    });
            }
        });
    </script>
@endsection