<?php
global $personPosts;
$dateformat = mom_option('date_format');
?>

<?php
?>

        <ul class="mom-related-posts clearfix">
                <?php
                if (1==1) :
//				$query = new WP_Query( array( 'post_type' => 'appearance', 'post__in' => array( 4,6,7,8,9,10 ) ) );
				$query = new WP_Query( array( 'post_type' => 'appearance', 'post__in' => $personPosts ) );

            update_post_thumbnail_cache($query);

                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                ?>
                <li itemscope="" itemtype="http://schema.org/Article">
                		<?php if( mom_post_image() != false ) { ?>
                        <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                        <?php mom_post_image_full('related-thumb'); ?>
                        </a></figure>
                        <?php } ?>
                        <h2 itemprop="name"><a href="<?php the_permalink(); ?>" itemprop="url" rel="bookmark"><?php the_title(); ?></a></h2>
                </li>
                <?php
                endwhile;
                else:
                endif;
                wp_reset_postdata();
                endif;
                ?>
        </ul>
