<?php
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>
<?php get_header(); ?>

<div class="main-title">
  <span class="main-title__text">BLOG</span>
  <span class="main-title__text_sub">ブログ・記事</span>
</div>

<?php $s = -1; ?>


<?php
  $args = array(
    'post_type' => 'blog', //投稿一覧を表示
    'posts_per_page' => $s //投稿の表示数
  );
  $my_query = new WP_Query( $args );
?>

<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
 
<p><a href="<?php the_permalink(); ?>">
  <?php the_date( get_option( 'blog' ) ); ?>
  <?php the_title(); ?></a></p>
 
<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
