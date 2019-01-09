/**
* Theme: Codefox Dashboard
* Author: Coderthemes
* Chartist chart
*/


//SVG Path animation


var chart = new Chartist.Line('#dashboard-chart-one', {
        labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb','Mar'],
        series: [
                [500, 200, 120, 280, 150, 300, 350, 200, 350, 250, 350, 200],
                [80, 150, 100, 180, 80, 250, 150, 280, 170, 300, 210, 170],
                [30, 80, 40, 90, 50, 100, 70, 160, 90, 200, 240, 120]
        ]
    }, {
        low: 0,
        showArea: true,
        showPoint: true,
        fullWidth: true,
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });
chart.on('draw', function(data) {
  if(data.type === 'line' || data.type === 'area') {
    data.element.animate({
      d: {
        begin: 2000 * data.index,
        dur: 2000,
        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
        to: data.path.clone().stringify(),
        easing: Chartist.Svg.Easing.easeOutQuint
      }
    });
  }
});


//Pie chart with custom labels

var data = {
  labels: ['Mail Order', 'Online Order', 'In-store Order'],
  series: [20, 15, 30]
};

var options = {
  labelInterpolationFnc: function(value) {
    return value[0]
  }
};

var responsiveOptions = [
  ['screen and (min-width: 640px)', {
    chartPadding: 30,
    labelOffset: 100,
    labelDirection: 'explode',
    labelInterpolationFnc: function(value) {
      return value;
    }
  }],
  ['screen and (min-width: 1024px)', {
    labelOffset: 80,
    chartPadding: 20
  }]
];

new Chartist.Pie('#pie-chart', data, options, responsiveOptions);


//Stacked bar chart
/*
 new Chartist.Bar('#stacked-bar-chart', {
 labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
 series: [
 [100, 200, 120, 280, 150, 300, 350, 200, 180, 350, 420, 500 ],
 [80, 150, 100, 180, 80, 250, 150, 280, 360, 450, 520, 650],
 [30, 80, 40, 90, 50, 100, 70, 160, 220, 240, 280, 350],

 ]
 }, {
 stackBars: true,
 plugins: [
 Chartist.plugins.tooltip()
 ]
 }).on('draw', function(data) {
 if(data.type === 'bar') {
 data.element.attr({
 style: 'stroke-width: 30px'
 });
 }
 });*/
