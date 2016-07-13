$(function() {

  var audience = "audience";
  var winPercent = "winingPercents";
  var event_day = "event_day";
  var dating = "dating";

  var audiences = [];
  var winPercents = [];
  var event_days = [];
  var datings = [];

  audiences.push(audience);
  winPercents.push(winPercent);
  event_days.push(event_day);
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
    console.log(this.dating);

    datings.push(this.dating);
  });




  var graphVal = {
    bindto: '#combine-chart',
    data: {
      x : event_day,
      columns: [
        audiences,
        winPercents,
        event_days
        // venues,
        // datings
      ],
      axes: {
        audiences: 'y',
        winingPercents: 'y2',
        s: 'y3',
        event_days:'x'
      },
      types: {
        audience: 'bar',
        winPercents: 'line',
        //data3: 'spline',
        //data4: 'line',
        //data5: 'bar'
      },
      colors: {
        audience: '#ebc142',
        winPercents: '#03a9f4',
        venues: '#009688',
        datings: '#E67A77'
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
