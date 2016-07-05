$(function() {

  console.log(json);

  var columns = [];

  $.each(json, function(key, value) {
    // 年齢が未入力ではない人以外のデータをグラフに表示出来るようにする
    if(key != "") {
      columns.push([((key * 10) + "代"), parseInt(value)]);
    }
  });


  var chart = c3.generate({
    bindto: '#pie-chart',
    data: {
      columns: columns,
      type : 'pie',
      onclick: function (d, i) { console.log("onclick", d, i); },
      onmouseover: function (d, i) { console.log("onmouseover", d, i); },
      onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    }
  });

});


