<?php if( comments_open() ) : ?>
<div id="comment_area">
            <div class="section_title">
              <h3>Comments</h3>
            </div>
<?php if(have_comments()): ?>
<ol class="commets-list">
<?php wp_list_comments('avatar_size=48'); ?>
</ol>
<?php else: ?>
<p class="none">コメントはありません</p>
<?php endif; ?>
<?php $args = array(
    'title_reply' => 'Leave a Comment',
    'label_submit' => 'コメントを送信する',
    'comment_notes_before' => '<p class="commentNotesBefore"><i>メールアドレスが公開されることはありません。 *が付いている欄は必須項目です</i></p>',
    'fields' => array(
            'author' => '<p class="comment-form-author">' .
                        '<label for="author">名前*</label>'.
                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="your name" /></p>',
            'email'  => '<p class="comment-form-email">' .
                        '<label for="email">メールアドレス</label>'.
                        '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . 'placeholder="your email" /></p>',
            'url'    => '<p class="comment-form-url">'.
                        '<label for="url">ウェブサイト</label>'.
                        '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . 'placeholder="your url" /></p>',
            ),
    'comment_field' => '<p class="comment-form-comment">' . '<label for="comment">コメント*</label>'.'<textarea id="comment" name="comment" cols="50" rows="6" aria-required="true"' . $aria_req . ' placeholder="＊COMMENT" /></textarea></p>',
    );
comment_form( $args ); ?>
</div><!-- comment_area -->
<?php endif; ?>