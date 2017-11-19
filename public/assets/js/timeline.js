var vm = new Vue({
    el: "#vueApp",
    data: {
        loginStatus: true,
        timelines: [],
        today: {
            text: '',
            categary: ''
        },
        choseList: [
            'type1', 'type2', 'type3', 'type4', 'type5', 'type6'
        ],
        tagList: [],
    },
    created: function() {
        console.log('created');
    },
    methods: {
        tagEnter: function(input) {
            this.tagList.push({
                text: this.today.text,
                class: this.today.categary
            });
            this.today.text = '';
            console.log('user type enter');
        }
    },
    watch: {
        'today.tag': function(input) {
            console.log(input);
        }
    },
    mounted: function() {
        var vm = this;

        $('.ui.dropdown')
            .dropdown({
                allowAdditions: true
            }).on('click', function(input) {
                console.log(input);
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