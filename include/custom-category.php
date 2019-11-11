<?php

add_action ( 'edit_category_form_fields', 'cps_custom_category');
function cps_custom_category( $tag ) {
  $category_metas = get_category_metas( $tag->term_id );
  $yhei_category_image = ( ! isset( $category_metas['yhei_category_image'] ) || $category_metas['yhei_category_image'] == '') ? "" :  $category_metas['yhei_category_image'];
  $yhei_category_image_pickup = ( ! isset( $category_metas['yhei_category_image_pickup'] ) || $category_metas['yhei_category_image_pickup'] == '') ? "" :  $category_metas['yhei_category_image_pickup'];
  
  wp_enqueue_media(); // メディアアップローダー用のスクリプトをロードする

  // カスタムメディアアップローダー用のJavaScript
  wp_enqueue_script(
    'my-media-uploader', get_stylesheet_directory_uri() . '/js/cps-media-uploader.js', array('jquery'), false, false
  );

?>
  <style type="text/css">
    #media{
      margin-top: 10px;
    }
    #media-cat img{
      width: 100%;
      max-width: 640px;
      height: auto;
      display: block;
    }
    input, button, textarea, select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      cursor: pointer;
    }
    input[type="button"]{
      padding: 10px;
      font-size: 12px;
      background: #eee;
      border: 3px #aaa solid;
    }
  </style>

  <input class="cps-image-cat" id="yhei_category_image" type="hidden" name="yhei_category_metas[yhei_category_image]" value="<?php echo esc_attr($yhei_category_image); ?>" />
  <input class="cps-image-cat-pickup" id="yhei_category_image_pickup" type="hidden" name="yhei_category_metas[yhei_category_image_pickup]" value="<?php echo esc_attr($yhei_category_image_pickup); ?>" />
  <tr style="margin-top: 10px">
    <th><label for="cagetory_color">カテゴリーのアイキャッチ画像</label></th>
    <td style="padding-bottom: 0; padding-left: 11px;"><div id="media-cat"><img src="<?php echo $yhei_category_image; ?>" /></div></td>
  </tr>
  <tr style="margin-top: 0px">
    <th><label for="cagetory_color"></label></th>
    <td style="padding-top: 5px;"><input type="button" name="media-cat" value="画像を選択" /><input type="button" name="media-cat-clear" value="画像をクリア" /></td>
  </tr>

<?php
}


add_action ( 'edited_term', 'cps_save_custom_category');
function cps_save_custom_category( $term_id ) {
  if ( isset( $_POST['yhei_category_metas'] ) ) {
    // $ctm_id = preg_replace('/[\x00-\x1f\x7f]/', '', $term_id);
    $category_metas = get_category_metas( $term_id );
    $category_keys = array_keys($_POST['yhei_category_metas']);

    foreach ( $category_keys as $key ){
      if ( isset($_POST['yhei_category_metas'][$key]) ){
        $category_metas[$key] = $_POST['yhei_category_metas'][$key];
      }
    }
    update_term_meta( $term_id, 'yhei_category_metas', $category_metas );
  }
}

/**
 * カテゴリーのmeta情報を取得
 * @param $term_id カテゴリーID
 * @return array $category_metas // keyは yhei_category_image, yhei_category_image_pickup
 */
function get_category_metas( $term_id ) {
  $category_metas = get_term_meta( $term_id, 'yhei_category_metas' );
  if( !$category_metas ) {
    return [];
  }
  return $category_metas[0];
}

/**
 * カテゴリーのアイキャッチ画像を取得
 * @param $term_id カテゴリーID
 * @return string $eyecatch_path
 */
function get_category_eyecatch( $term_id ) {
  $eyecatch_path = '';
  $category_metas = get_category_metas( $term_id );
  if( !$category_metas ) {
    return $eyecatch_path;
  }
  if( isset( $category_metas['yhei_category_image'] ) ) {
    $eyecatch_path = $category_metas['yhei_category_image'];
  }
  return $eyecatch_path;
}

/**
 * カテゴリーのピックアップ画像を取得
 * @param $term_id カテゴリーID
 * @return string $eyecatch_path
 */
function get_category_pickup_image( $term_id ) {
  $eyecatch_path = '';
  $category_metas = get_category_metas( $term_id );
  if( !$category_metas ) {
    return $eyecatch_path;
  }
  if( isset( $category_metas['yhei_category_image_pickup'] ) ) {
    $eyecatch_path = $category_metas['yhei_category_image_pickup'];
  }
  return $eyecatch_path;
}

/**
 * メディアアップローダーで画像選択した際のサムネイルのサイズを追加
 */
function add_image_size_wp_enqueue_media_js( $response, $attachment, $meta ){
  $size_array = array( 'draft-portfolio-thumbnail' ) ;
  foreach ( $size_array as $size ) {
    if ( isset( $meta['sizes'][ $size ] ) ) {
      $attachment_url = wp_get_attachment_url( $attachment->ID );
      $base_url = str_replace( wp_basename( $attachment_url ), '', $attachment_url );
      $size_meta = $meta['sizes'][ $size ];
      $response['sizes'][ $size ] = array(
        'height'        => $size_meta['height'],
        'width'         => $size_meta['width'],
        'url'           => $base_url . $size_meta['file'],
        'orientation'   => $size_meta['height'] > $size_meta['width'] ? 'portrait' : 'landscape',
      );
    }
  }
  return $response;
}
add_filter ( 'wp_prepare_attachment_for_js',  'add_image_size_wp_enqueue_media_js' , 10, 3  );


?>