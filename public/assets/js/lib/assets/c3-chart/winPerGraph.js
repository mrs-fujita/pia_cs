$(function() {

  var audience = "audience";
  var winPercent = "winingPercents";

  var audiences = [];
  var winPercents = [];

  audiences.push(audience);
  winPercents.push(winPercent);

  $.each(json, function(key, value) {

    console.log(key + "v: " + value);
    console.log(this.audience_sum);
    console.log(this.winning_percentage);

    audiences.push(this.audience_sum);
    winPercents.push(parseInt(this.winning_percentage) * 100);
  });

  var graphVal = {
    bindto: '#combine-chart',
    data: {
      columns: [
        audiences,
        winPercents
      ],
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
        //data3: '#009688',
        //data4: '#E67A77',
        //data5: '#95D7BB'
      },
      groups: [
        //['data1','data2']
      ]
    },
    axis: {
      x: {
        type: 'categorized'
      }
    }
  }

  console.log(graphVal);

  var chart = c3.generate(graphVal);

});