(function ($) {
  var custom_uploader;
  $("input:button[name=media-cat]").live('click', 'button', function(e) {
    e.preventDefault();
    custom_uploader = wp.media({
    title: "画像を選んでください",
    library: {
      type: "image"
    },
    button: {
      text: "この画像を選択する"
    },
    multiple: false,
    });
    custom_uploader.on("select", function() {
      var images = custom_uploader.state().get("selection");
      // ボタン押下時に取得したwidgetid内の各要素を取得する
      $("input.cps-image-cat").val("");
      $("#media-cat").empty();

      /* file の中に選択された画像の各種情報が入っている */
      images.each(function(file){
        /* テキストフォームと表示されたサムネイル画像があればクリア */
        console.log(file.attributes.sizes);
        $("#media-cat").append('<img src="'+file.attributes.sizes.medium.url+'" />');
        $("input.cps-image-cat").val(file.attributes.sizes['draft-portfolio-thumbnail'].url);
        $("input.cps-image-cat-pickup").val(file.attributes.sizes['draft-portfolio-thumbnail'].url);// ピックアップ用
      });
    });
    custom_uploader.open();
  });

  /* クリアボタンを押した時の処理 */
  $("input:button[name=media-cat-clear]").live('click', 'button', function() {
    // ボタン押下時に取得したwidgetid内の各要素を取得するように修正
    $("#media-cat").empty();
    $("input.cps-image-cat").val("");
    $("input.cps-image-cat-pickup").val("");
  });

})(jQuery);