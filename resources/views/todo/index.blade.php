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
                        <input type="checkbox" class="checkcheck" @click='checkboxClick(tag.id)'>
                        <div class="chosed_cat">
                            <i :class="tag.class"></i> <span v-text='tag.name'></span>
                        </div>
                        <br>
                    </template>
                </div>
            </div>

            <div class="timeline_item" v-for='(timeline, i) in timelines' @click='timelineClick(i)'>
                <span class="timeline_date" v-text='timeline.showDate'></span>
                <div class="button_part">
                    <div v-for='item in timeline.info.tags'>
                        <i :class="item.class"></i> <span v-text='item.name'></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    var classMaps = {
        gaming: 'icon game',
        working: 'icon desktop',
        thinking: 'icon comment',
        eating: 'icon food',
        reading: 'icon book',
        drinking: 'icon coffee'
    };

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
            timelines: [{
                input: '2017-11-18',
                showDate: '11/18',
                info: {}
            }, {
                input: '2017-11-17',
                showDate: '11/17',
                info: {}
            }, {
                input: '2017-11-16',
                showDate: '11/16',
                info: {}
            }],
            today: {
                name: '',
                category: ''
            },
            tagList: [],
            passList: []
        },
        methods: {
            checkboxClick: function(id) {
                axios({
                    method: 'put',
                    url: '/todo/' + id,
                }).then(function(res) {
                    console.log(res);
                }).catch(function(error) {
                    console.error(error);
                });
            },
            tagEnter: function(input) {

                var vm = this;
                vm.today.category = vm.today.category ? vm.today.category : 'gaming';

                axios.post('todo', {
                    category: vm.today.category,
                    name: vm.today.name
                })
                    .then(function(res) {
                        res.data.items.class = classMaps[res.data.items.category] ;
                        var data = {};
                        data.items = res.data.items;

                        vm.tagList.push(data.items);
                        vm.today.name = '';
                    })
            },
            tagModified: function(input) {
                // body...
            },
            timelineClick: function(input) {
                var vm = this;
                res = {};
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
                vm.timelines[input].info = {
                    tags: res.data.items.todos
                };
                for (var i = 0; i < vm.timelines[input].info.tags.length; i++) {
                    vm.timelines[input].info.tags[i].class = classMaps[vm.timelines[input].info.tags[i].category];
                }
                console.log(vm.timelines[input]);
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
        }
    });
</script>
@endsection