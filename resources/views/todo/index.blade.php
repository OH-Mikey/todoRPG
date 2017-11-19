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
                        <div :class="tag.category">
                            <i :class="tag.class"></i> <span v-text='tag.name'></span>
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
        name: 'gaming',
        value: 'gaming'
    }, {
        name: 'working',
        value: 'working'
    }, {
        name: 'thinking',
        value: 'thinking'
    }, {
        name: 'eating',
        value: 'eating'
    }, {
        name: 'reading',
        value: 'reading'
    }, {
        name: 'drinking',
        value: 'drinking'
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
        methods: {
            tagEnter: function(input) {

                var vm = this;
                vm.today.category = vm.today.category ? vm.today.category : 'gaming';

                res = {};
                res.data = {
                    items:{
                        id: 'id_adsf',
                        category: vm.today.category,
                        name: vm.today.name
                    }
                };
                var classMaps = {
                    gaming: 'icon game',
                    working: 'icon desktop',
                    thinking: 'icon comment',
                    eating: 'icon food',
                    reading: 'icon book',
                    drinking: 'icon coffee'
                };

                res.data.items.class = classMaps[res.data.items.category] ;
                /*
                res.data = {
                    "status": 200,
                    "items": {
                        "todos": [{
                            "id": 11,
                            "user_id": 1,
                            "name": "Anjali Veum DDS",
                            "category": "thinking",
                            "status": 1,
                            "created_at": "2017-11-19 05:42:16",
                            "updated_at": "2017-11-19 05:42:16"
                        }, {
                            "id": 12,
                            "user_id": 1,
                            "name": "Doyle Dibbert III",
                            "category": "eating",
                            "status": 1,
                            "created_at": "2017-11-19 05:42:16",
                            "updated_at": "2017-11-19 05:42:16"
                        }]
                    }
                };
                */

                console.log(res);
                var data = {};
                data.items = res.data.items;

                vm.tagList.push(data.items);
                vm.today.name = '';

                /*
                                        data.items = {id: tempId, category: vm.today.category, name: vm.today.name };
                    */

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

            var tempArray = [];
            s = typeArray.slice(0);

            for (var i = 0; i < s.length; i++) {
                tempArray.push({
                    name: s[i].name,
                    value: s[i].value
                });
                if (i===0) {
                    tempArray[i].selected = true;
                }
            }

            $('.ui.dropdown.create')
                .dropdown({
                    values: tempArray.slice()
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