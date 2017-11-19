var vm = new Vue({
    el: "#app",
    data: {
        loginStatus: true,
        timelines: []
    },
    /*
        components: {
            componentHeader: componentHeader
        },
    */
    created: function() {
        console.log('created');
    },
    mounted: function() {


        var vm = this;
        axios({
            method: 'get',
            url: '/',
        }).then(function(res) {
            for (var i = 0; i < 2; i++) {
                vm.timelines.push(i);
            }
        }).catch(function(error) {
            console.error(error);
        });

        $(".outer_container").scroll(function(event) {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                for (var i = 0; i < 4; i++) {
                    vm.timelines.push(i);
                }
            }
        });
    }
});