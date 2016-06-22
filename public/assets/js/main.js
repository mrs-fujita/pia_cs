$(function() {
  var map;
  map = new GMaps({
    el: '#map',
    zoom: 5,
    lat: 38.6575244,
    lng: 139.3349708
  });

  // mapに表示するleague
  var leagues = [j1, j2];
  // mapにマーカーに表示する
  displayMarker();

  // チーム情報を非表示にする
  teamInfo.hideTeamInfo();


  /**
   * google Mapのマーカーを押した時の処理
   * @param team idやチーム名など、チームの情報
   */
  function touchAddMarker(team) {
    $(".js-teamName").text(team.name);
    $(".js-teamInfoId").val(team.id);

    // チーム情報を表示する
    teamInfo.activeTeamInfo();

    clubImg.changeLeagueIcon(team.id);
  }

  /**
   * 大域変数のleagues配列（j1,j2といったリーグの配列〉をmapに表示する
   */
  function displayMarker() {
    $.each(leagues, function() {

      $.each(this, function() {
        map.addMarker({
          lat: this.lat,
          lng: this.lng,
          title: this.name,
          click: (function(e) { //Markerをクリックされた時の処理
            return function() {
              touchAddMarker(e);
            }
          })(this)
        })
      });

    });
  }

  /**
   * リーグを選択するセレクトボックスが変更された時の処理
   */
  $($(".js-teamSelect").change(function() {
    var str = "";
    $(".js-teamSelect option:selected").each(function() {
      str += $(this).text();
      // console.log("str: " + str);

      // selectboxの値によって大域変数のleagues配列の値を変更する
      switch (str) {
        case "全リーグ":
          leagues = [j1, j2];
          break;

        case "J1":
          leagues = [j1];
          break;

        case "J2":
          leagues = [j2];
          break;
      }
    });
    // mapのマーカーを削除
    map.removeMarkers();
    // マーカーを表示し直す
    displayMarker();
  }))
});

/**
 * キャンセルボタンがクリックされた時の処理
 */
$(".js-teamInfoCancelButton").click(function(e) {
  console.log("押された");
  e.preventDefault();

  // チーム情報を非表示にする
  teamInfo.hideTeamInfo();
})


/**
 * チームの情報を表示する領域に関する関数
 */
var teamInfo = {

  $infoView: $(".js-teamInfo"),

  /**
   * チーム情報を非表示にする
   */
  hideTeamInfo: function() {this.$infoView.hide()},

  /**
   * チーム情報を表示する
   */
  activeTeamInfo: function() {this.$infoView.show()}
}


var clubImg = {

  /*
   アイコンの基本URL："http://localhost/pia_cs/public/assets/img/club/{{id}}/icon.png"
   チームの基本URL："http://localhost/pia_cs/public/assets/img/club/{{id}}/1.png"
   最後の1.pngの部分は連番
   */

  basicImgPath: "http://localhost/pia_cs/public/assets/img/club/",

  $icon: $(".js-teamIcon"),
  $mainImg: $(".js-teamMainImg"),

  changeLeagueIcon: function(id) {
    var url = this.basicImgPath + id + "/icon.png";
    var url2 = this.basicImgPath + id + "/1.png";
    this.$icon.attr("src",url);
    this.$mainImg.attr("src",url2);
  }
}