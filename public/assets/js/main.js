var map;
$(function() {
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


      /**
       * google Mapのマーカーを押した時の処理
       * @param team idやチーム名など、チームの情報
       */
      function touchAddMarker(team) {
        $(".js-teamName").text(team.name);
        $(".js-teamInfoId").val(team.id);
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
    }
);