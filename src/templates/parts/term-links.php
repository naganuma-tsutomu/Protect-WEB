<?php
/**
 * タクソノミーリンク表示パーツ
 *
 * Taxonomy_Helper が返した配列を受け取り、リンク or スパンとして出力する。
 * echo によるHTML文字列の組み立ては行わない。
 *
 * get_template_part() の第3引数 ($args) でオプションを渡す:
 *   terms       array   Taxonomy_Helper から取得したリンク情報の配列 (必須)
 *   prefix      string  各タームの表示前に付けるテキスト (例: '#')  デフォルト: ''
 *   link_class  string  <a> タグの class 属性                        デフォルト: ''
 *   span_class  string  アクティブ時 <span> タグの class 属性        デフォルト: ''
 *   tag         string  各タームを包む親要素タグ名 (例: 'li')        デフォルト: '' (ラップなし)
 *   tag_class   string  親要素タグの class 属性                      デフォルト: ''
 */

$terms      = $args['terms']      ?? [];
$prefix     = $args['prefix']     ?? '';
$link_class = $args['link_class'] ?? '';
$span_class = $args['span_class'] ?? '';
$tag        = $args['tag']        ?? '';
$tag_class  = $args['tag_class']  ?? '';

// tag が指定されている場合のみ使用する安全なタグ名に絞る
$allowed_tags = [ 'li', 'div', 'span', 'p' ];
$wrap_tag = ( $tag && in_array( $tag, $allowed_tags, true ) ) ? $tag : '';

if ( empty( $terms ) ) {
    return;
}

foreach ( $terms as $term ) :
    $label      = $prefix . $term['name'];
    $open_tag   = $wrap_tag ? '<' . $wrap_tag . ( $tag_class ? ' class="' . esc_attr( $tag_class ) . '"' : '' ) . '>' : '';
    $close_tag  = $wrap_tag ? '</' . $wrap_tag . '>' : '';
    $span_attr  = $span_class ? ' class="' . esc_attr( $span_class ) . '"' : '';
    $link_attr  = $link_class ? ' class="' . esc_attr( $link_class ) . '"' : '';
?>
    <?php echo $open_tag; ?>
    <?php if ( ! empty( $term['is_active'] ) ) : ?>
        <span<?php echo $span_attr; ?>>
            <?php echo esc_html( $label ); ?>
        </span>
    <?php else : ?>
        <a<?php echo $link_attr; ?> href="<?php echo esc_url( $term['url'] ); ?>">
            <?php echo esc_html( $label ); ?>
        </a>
    <?php endif; ?>
    <?php echo $close_tag; ?>
<?php endforeach; ?>
