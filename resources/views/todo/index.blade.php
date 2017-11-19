@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/timeline.css">
<div id="vueApp">
    <div class="outer_container">
        <div class="_container">


            <div class="timeline_item today">
                <span class="timeline_date">11/19</span>
                <div class="top_part">
                    <div class="left_part">
                        <div class="ui fluid selection dropdown create">
                            <div class="text"></div>
                            <i class="dropdown icon"></i>
                        </div>
                    </div>
                    <div class="right_part">
                        <div class="ui left icon input">
                            <input type="text" placeholder="Write some info!" v-model='today.name'
                            @keyup.enter="tagEnter">
                            <i class="users icon"></i>
                        </div>
                    </div>
                </div>

                <div class="button_part">
                    <template v-for="tag in tagList">
                        <div class="left_part">
                            <div class="ui fluid selection dropdown" :id='tag.id'>
                                <div class="text"></div>
                                <i class="dropdown icon"></i>
                            </div>
                        </div>
                        <div class="right_part">
                            <div class="ui left icon input">
                                <input type="text" placeholder="Write some info!" v-model='tag.name' @keyup.enter="tagModified"><i class="users icon"></i>
                            </div>
                        </div>
                    </template>
                </div>
            </div>




            <div class="timeline_item" v-for='timeline in timelines'>
                <span class="timeline_date">11/19</span>
                <div class="button_part">
                    <li v-for="tag in passList" v-text="tag.name"></li>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    var typeArray = [{
        name: 'type1',
        value: 'type1',
        selected: true
    }, {
        name: 'type2',
        value: 'type2'
    }, {
        name: 'type3',
        value: 'type3'
    }, {
        name: 'type4',
        value: 'type4'
    }, {
        name: 'type5',
        value: 'type5'
    }, {
        name: 'type6',
        value: 'type6'
    }];

    var vm = new Vue({
        el: "#vueApp",
        data: {
            loginStatus: true,
            timelines: [],
            today: {
                name: '',
                category: ''
            },
            tagList: [],
            passList: [{
                date: '11/879',
                tagList: [{
                    type: 'something',
                    name: 'hello'
                }]
            }]
        },
        created: function() {
            console.log('created');
        },
        methods: {
            tagEnter: function(input) {
                var vm = this;
                vm.today.category = vm.today.category ? vm.today.category : 'type1';

                var data = {};
                var tempId = 'id_' + Date.now();
                data.items = {
                    id: tempId,
                    category: 'type1',
                    name: vm.today.name
                };

                vm.tagList.push(data.items);
                vm.today.name = '';

                setTimeout(function() {
                    var eachArray = [];
                    console.log(typeArray);
                    for (var i = 0; i < typeArray.length; i++) {
                        eachArray.push(typeArray[i]);
                    }
                    console.log($('#' + tempId));
                    $('#' + tempId)
                        .dropdown({
                            values: eachArray.slice()
                        });
                }, 0);

                return;

                axios({
                    method: 'post',
                    url: 'http://d673eff8.ngrok.io/todo',
                    data: {
                        category: vm.today.category,
                        name: vm.today.name
                    }
                }).then(function(res) {}).catch(function(error) {
                    console.error(error);
                });
            },
            tagModified: function(input) {
                // body...
            }
        },
        watch: {
            'today.tag': function(input) {
                console.log(input);
            }
        },
        mounted: function() {
            var vm = this;

            $('.ui.dropdown.create')
                .dropdown({
                    values: typeArray.slice()
                }).on('click', function(input) {
                    var obj = input.target,
                    chosed = obj.classList.contains('item');
                    if (chosed) {
                        vm.today.category = obj.innerHTML;
                    }
                });

            axios({
                method: 'get',
                url: '/',
            }).then(function(res) {
                for (var i = 0; i < 1; i++) {
                    vm.timelines.push(i);
                }
            }).catch(function(error) {
                console.error(error);
            });


            return;

            $(".outer_container").scroll(function(event) {
                if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                    for (var i = 0; i < 4; i++) {
                        vm.timelines.push(i);
                    }
                }
            });
        }
    });
</script>
@endsection