$(function() {

  // 選択されているチームのid
  var teamId = $(".js-teamId").text();

  // 勝敗一覧ボタン
  var $resultBtn = $(".js-resultList");
  // 勝敗一覧を表示するテーブルの要素
  var $tbody = $(".js-tbody");


  $resultBtn.click(function(e) {

    $.ajax({
      url: "getData/matchResult.json",
      type: "POST",
      dataType: 'json',
      data: {id: teamId}
    }).done(function(json) {

      //console.log(json);

      $.each(json, function() {

        var score = this.score + " - " + this.lost;
        var defeat = "";
        console.log(this.defeat);
        switch (this.defeat) {
          case "-1":
            defeat = "負け";
            break;
          case "0":
            defeat = "引き分け";
            break;
          case "1":
            defeat = "勝ち";
            break;
        }
        var place = this.home_club == "1" ? "ホーム" : "アウェイ";

        var $tr = $("<tr>");

        $tr.append($("<td>").html(this.event_day));  //試合日
        $tr.append($("<td>").html(this.start_time)); //試合開始時間
        $tr.append($("<td>").html(score));  //スコア
        $tr.append($("<td>").html(this.opponent_club_name)); //対戦チーム
        $tr.append($("<td>").html(this.stadium_name));  //スタジアム名
        $tr.append($("<td>").html(defeat)); //勝ち・負け
        $tr.append($("<td>").html("?"));  //順位
        $tr.append($("<td>").html(this.audience_sum + "人"));  //観客数
        $tr.append($("<td>").html(this.weather));  //天候
        $tr.append($("<td>").html(place));  //ホーム・アウェイ

        // テーブルにして表示
        $tbody.append($tr);
      });


    }).fail(function(jqXHR, textStatus) {
      alert('ajax get error');
    });

    e.preventDefault();
  });
});