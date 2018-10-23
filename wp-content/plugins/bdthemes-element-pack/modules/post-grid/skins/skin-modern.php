<?php
namespace ElementPack\Modules\PostGrid\Skins;

use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Modern extends Elementor_Skin_Base {

	public function get_id() {
		return 'bdt-modern';
	}

	public function get_title() {
		return __( 'Modern', 'bdthemes-element-pack' );
	}

	public function render() {
		$settings = $this->parent->get_settings();
		
		global $post;
		$id      = $this->parent->get_id();
		$classes = ['bdt-post-grid', 'bdt-post-grid-skin-modern'];

		$args = array(
			'posts_per_page' => 5,
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'post_status'    => 'publish'
		);
		
		if ( 'by_name' === $settings['source'] ) :
			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $settings['post_categories'],
			);
		endif;

		$wp_query = new \WP_Query($args);

		if( $wp_query->have_posts() ) :

			add_filter( 'excerpt_more', [ $this, 'filter_excerpt_more' ], 20 );
			add_filter( 'excerpt_length', [ $this, 'filter_excerpt_length' ], 20 );

			?> 
			<div id="bdt-post-grid-<?php echo esc_attr($id); ?>" class="<?php echo \element_pack_helper::acssc($classes); ?>">
		  		<div class="bdt-grid bdt-grid-<?php echo esc_attr($settings['column_gap']); ?>" bdt-grid>

					<?php 
					$bdt_count = 0;
				
					while ($wp_query->have_posts()) :
						$wp_query->the_post();
						$bdt_count++;
			  			?>


						<?php if ( 1 == $bdt_count ) : ?>
						    <div class="bdt-width-2-5@m bdt-primary">
						        <?php $this->parent->render_post_grid_item( $post->ID, $image_size = 'full' ); ?>
						    </div>

						    <div class="bdt-width-2-5@m bdt-secondary">
						        <div class="bdt-grid bdt-grid-<?php echo esc_attr($settings['column_gap']); ?>" bdt-grid>

						<?php endif; ?>
						            <?php if ( 2 == $bdt_count ) : ?>
							            <div class="bdt-width-1-1@m">
							                <?php $this->parent->render_post_grid_item( $post->ID, $image_size = 'medium' ); ?>
							            </div>
						            <?php endif; ?>

									<?php if ( 3 == $bdt_count or 4 == $bdt_count ) : ?>
							            <div class="bdt-width-1-2@m">
							                <?php $this->parent->render_post_grid_item( $post->ID, $image_size = 'medium' ); ?>
							            </div>
						            <?php endif; ?>

						<?php if ( 5 == $bdt_count ) : ?>
						        </div>
						    </div>

						    <div class="bdt-width-1-5@m bdt-primary bdt-tertiary">
						        <?php $this->parent->render_post_grid_item( $post->ID, $image_size = 'medium' ); ?>
						    </div>

						<?php endif; ?>

					<?php endwhile; ?>
				</div>
			</div>
		
	 		<?php 
			remove_filter( 'excerpt_length', [ $this, 'filter_excerpt_length' ], 20 );
			remove_filter( 'excerpt_more', [ $this, 'filter_excerpt_more' ], 20 );
			wp_reset_postdata();
		endif;
	}
}

