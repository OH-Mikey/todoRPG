new Vue({
    el: "#app",
    data: {
        loginStatus: true
    },
    components: {
        componentHeader: componentHeader
    },
    mounted: function() {
        getChart().then(function(data) {

            var width = window.innerWidth * 0.8,
                height = window.innerHeight * 0.8;

            var minX = d3.min(data, function(d) {
                return d.x.number;
            });
            var maxX = d3.max(data, function(d) {
                return d.x.number;
            });
            var minY = d3.min(data, function(d) {
                return d.y;
            });
            var maxY = d3.max(data, function(d) {
                return d.y;
            });

            var scaleX = d3.scale.linear()
                .range([0, width])
                .domain([minX, maxX]); //x 的最大值與最小值

            var scaleY = d3.scale.linear()
                .range([height, 0]) //反過來才會上下顛倒
                .domain([minY, maxY]); //y 的最大值與最小值

            var axisX = d3.svg.axis()
                .scale(scaleX)
                .orient("bottom")
                .ticks(20)
                .tickFormat(function(d) {
                    return data[d].x.words;
                });


            var axisY = d3.svg.axis()
                .scale(scaleY)
                .orient("left")
                .ticks(10);


            var svg = d3.select('.analysis_content')
                .append('svg')
                .attr({
                    'width': '100%',
                    'height': '100%'
                });

            var line = d3.svg.line()
                .x(function(d) {
                    return scaleX(d.x.number);
                })
                .y(function(d) {
                    return scaleY(d.y);
                })
                .interpolate('step');
            svg.append('path')
                .attr({
                    'id': 'offsetId',
                    'd': line(data),
                    'y': 0,
                    'stroke': '#000',
                    'stroke-width': '1px',
                    'fill': 'none',
                    'transform': 'translate(35,20)' //折線圖也要套用 translate

                });

            svg.append('g')
                .call(axisX)
                .attr({
                    'fill': 'none',
                    'stroke': '#000',
                    'transform': 'translate(35,' + (height + 20) + ')'
                });

            svg.append('g')
                .call(axisY)
                .attr({
                    'fill': 'none',
                    'stroke': '#000',
                    'transform': 'translate(35,20)'
                });

            var path = document.querySelector('#offsetId');
            var length = path.getTotalLength();
            path.style['stroke-dasharray'] = Math.ceil(length);
            path.style['stroke-dashoffset'] = Math.ceil(length);
            path.classList.add('run');

        }).catch(function(output) {
            console.log(output);
        });
    }
});


function getChart(input) {
    return new Promise(function(resolve, reject) {
        axios({
            method: 'get',
            url: '/',
            // url: 'http://localhost:3000/chart'
        }).then(function(res) {
            // resolve(res.data);
            resolve(array)

        }).catch(function(error) {
            reject(error);
        });
    });
}

var array = [];
for (var i = 0; i < 25; i++) {
    array.push({
        x: {
            number: i,
            words: '11/12'
        },
        y: Math.round(Math.random() * 100)
    });
    array.push({
        x: {
            number: i,
            words: ''
        },
        y: 0
    });
}
console.log(array);