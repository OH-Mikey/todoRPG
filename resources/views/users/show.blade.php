@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>
            <div class="ui card" v-show='gaming'>
                <i :class="gaming"></i> 遊戲大師
                <p>玩了 10 次遊戲</p>
            </div>
            <div class="ui card" v-show='working'>
                <i :class="working"></i> 瘋狂工作人
                <p>專注工作 10 次</p>
            </div>
            <div class="ui card" v-show='thinking' style="padding-bottom: 20px">
                <i :class="thinking"></i> 蘇格拉底
                <p>我思故我在 10 次</p>
            </div>
            <div class="ui card" v-show='eating'>
                <i :class="eating"></i> 吃貨
                <p>好好吃了 10 頓飯</p>
            </div>
            <div class="ui card" v-show='reading'>
                <i :class="reading"></i> 書蟲
                <p>讀了 10 本書</p>
            </div>
            <div class="ui card" v-show='drinking'>
                <i :class="drinking"></i> 天天喝醉
                <p>喝了 10 杯水</p>
            </div>
        </div>
@endsection

@section('script')
    <script>
        new Vue({
            el: "#app",
            data: {
                gaming: '',
                working: '',
                thinking: '',
                eating: '',
                reading: '',
                drinking: ''
            },
            mounted: function () {
                var vm = this;
                axios.get('{{ auth()->id() }}' + '/achievements')
                    .then(function (res) {
                        console.log(res.data.items);
                        vm.gaming = res.data.items.gaming ? 'icon game huge' : false;
                        vm.working = res.data.items.working ? 'icon desktop huge' : false;
                        vm.thinking = res.data.items.thinking ? 'icon comment huge' : false;
                        vm.eating = res.data.items.eating ? 'icon food huge' : false;
                        vm.reading = res.data.items.reading ? 'icon book huge' : false;
                        vm.drinking = res.data.items.drinking ? 'icon coffee huge' : false;
                    });
            }
        });
    </script>
@endsection