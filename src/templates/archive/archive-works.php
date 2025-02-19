<?php /* Template Name: archive works Page */ ?>

<div class="container">
	<div id="works" class="works">
		<div class="contents_title">WORKS</div>
		<div class="contents_subtitle">制作実績</div>
		<div class="contents_text01">
			ホームページ制作実績一覧です。<br>
			テンプレートを使用したシンプルなデザインからオリジナルデザインのプランまで、お客様のご要望に沿ったサイトを制作します。
		</div>

		<div class="works__list">
			<ul>
				<?php
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$args = [
					'post_type' => 'works',
					'post_status' => 'publish',
					'order'  => 'ASC',
					'orderby' => 'date',
					'posts_per_page' => 6,
					'paged' => $paged
				];

				$query = new WP_Query($args);
				$max_num_pages = $query->max_num_pages;
				if ($query->have_posts()):
					while ($query->have_posts()): $query->the_post();

						/* SCF各フィールド配列取り出し */
						$product_all = get_field('works_product');
						$cate_all = get_field('works_category');
						$plan_all = get_field('works_plan');
						if ($product_all && $cate_all && $plan_all) {
							$product_label = $product_all['label'];
							$product_value = $product_all['value'];
							$cate_label = $cate_all['label'];
							$cate_value = $cate_all['value'];
							$plan_label = $plan_all['label'];
							$plan_value = $plan_all['value'];
						}
				?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="works__list_img"><img src="<?php the_field('works_topimg_pc'); ?>" alt="<?php the_field('works_client'); ?>"></div>
								<div class="works__list_name"><?php the_field('works_client'); ?> 様</div>
								<div class="works__list_url"><?php the_field('works_url'); ?></div>
								<div class="works__list_product"><?php echo $product_label; ?></div>
								<div class="works__list_spec">
									<div><span class="works__list_spec_cate">CATEGORY</span><span><?php echo $cate_label; ?></span></div>
									<div><span class="works__list_spec_plan">PLAN</span><span><?php echo $plan_label; ?></span></div>
								</div>
							</a>
						</li>
				<?php
					endwhile;
				endif;
				?>
			</ul>
			<div class="pagination">
				<?php
				if ($query->max_num_pages > 1) {
					echo paginate_links(array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => '?paged=%#%',
						'current' => max(1, $paged),
						'total' => $query->max_num_pages,
						'end_size' => 2,
						'prev_text' => '< Prev',
						'next_text' => 'Next >'
					));
				}
				?>
			</div>

			<div class="works__linkbox">
				<div class="works__linkbox_info">
					<div class="works__linkbox_info_caption">ホームページ制作のご相談はお気軽に</div>
					<div class="works__linkbox_info_text">
						見積りは無料で承っておりますので、まずはお気軽にお問い合わせください。<br>
						お客様のイメージやご予算に応じた最適なご提案をさせていただきます。
					</div>
				</div>
				<div class="works__linkbox_link">
					<div class="works__linkbox_link_estimate">
						<a href="<?php echo esc_url(home_url('/order/')); ?>">
							<div class="works__linkbox_link_estimate_button">
								<div><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/order/order_01.webp')); ?>" alt="お見積りフォーム">お見積りフォーム</div>
							</div>
						</a>
					</div>
					<div class="works__linkbox_link_contact">
						<a href="<?php echo esc_url(home_url('/contact/')); ?>">
							<div class="works__linkbox_link_contact_button">
								<div><img src="<?php echo esc_url(get_theme_file_uri('/assets/images/contact/contact_mail.webp')); ?>" alt="お問い合わせ">お問い合わせ</div>
							</div>
						</a>
					</div>
				</div>
			</div>

		</div>
		<?php
		wp_reset_postdata();
		?>
	</div>