/**
 * 分析画面でサイドバーのメニューを選択した時の処理
 */
$(function() {

  var $parents = $(".js-selectBoxParent");
  var $children = $(".js-selectBoxChildren");

  var $parentLink = $(".js-selectBoxParent > a");

  // サイドバーのメニューの大きなカテゴリをクリックされた時の処理
  $parentLink.click(function(e) {
    // クリックされたサイドバーの要素の番号
    var num = $parentLink.index(this);

    // 子要素を表示する
    $children.eq(num).toggle();

    // リンク先へ飛ぶのを無効化
    e.preventDefault();
  });
});