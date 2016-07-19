$(function() {

  var audience = "audience";
  var winPercent = "winingPercents";
  var event_day = "event_day";
  var visitors_num = "visitors_num";
  var dating = "dating";

  var audiences = [];
  var winPercents = [];
  var event_days = [];
  var visitors_nums = [];
  var datings = [];

  audiences.push(audience);
  winPercents.push(winPercent);
  event_days.push(event_day);
  visitors_nums.push(visitors_num);
  datings.push(dating);

  $.each(json0, function(key, value) {

    console.log(key + "v: " + value);
    console.log(this.audience_sum);
    console.log(this.winning_percentage);
    console.log(this.event_day);

    audiences.push(this.audience_sum);
    winPercents.push(this.winning_percentage);
    event_days.push(this.event_day);
  });

  $.each(json1, function(key, value) {

    console.log(key + "v: " + value);
    console.log(this.visitors_num);
    console.log(this.dating);

    visitors_nums.push(this.visitors_num);
    datings.push(this.dating);
  });




  var graphVal = {
    bindto: '#combine-chart',
    data: {
      x : event_day,
      columns: [
        audiences,
        winPercents,
        visitors_nums,
        event_days
        // venues,
        // datings
      ],
      axes: {
         winingPercents: 'y2'
      },
      types: {
        audience: 'bar',
        visitors_num: 'bar',
        //winPercents: 'bar',
        //data3: 'spline',
        //data4: 'line',
        //data5: 'bar'
      },
      colors: {
        audience: '#ebc142',
        winPercents: '#03a9f4',
        visitors_num: '#009688',
        // datings: '#E67A77'
        //data5: '#95D7BB'
      },
    groups: [
        //['data1','data2']
      ]
    },
    axis: {
      x: {
        type : 'timeseries',
        tick: {
            format: "%m/%e"
        }
      },
      y: {
        max: 24000,
        min: 5000,
      },
      y2: {
        max: 90,
        min: 10,
        show: true,
      },
      padding: {
        left: 1,
        right: 1,
      }
    }
  }

  console.log(graphVal);

  var chart = c3.generate(graphVal);

});
