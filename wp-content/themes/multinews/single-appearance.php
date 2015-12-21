<?php
/*
Single Post Template:Appearance Post
*/
?>

<?php get_header(); ?>

<?php
    global $post;
    //page layout
    $layout = get_post_meta(get_the_ID(), 'mom_page_layout', true);
    if ($layout == '') { $layout = mom_option('post_page_layout'); }
    if ($layout == '') {
    	$layout = mom_option('main_layout');
    }
    //post settings
    $HFI = get_post_meta(get_the_ID(), 'mom_hide_feature', true);
    $DPS = get_post_meta(get_the_ID(), 'mom_blog_ps', true);
    $DPN = get_post_meta(get_the_ID(), 'mom_blog_np', true);
    $DAB = get_post_meta(get_the_ID(), 'mom_blog_ab', true);
    $DRP = get_post_meta(get_the_ID(), 'mom_blog_rp', true);
    $DPC = get_post_meta(get_the_ID(), 'mom_blog_pc', true);
    $PTS = get_post_meta(get_the_ID(), 'mom_blog_tags', true);
    $PCT = get_post_meta(get_the_ID(), 'mom_photo_credit', true);
    $PSC = get_post_meta(get_the_ID(), 'mom_post_source', true);
    $disable_ads = get_post_meta(get_the_ID(), 'mom_disable_post_ads', true);
    $site_width = mom_option('site_width');
    // story_higlight
    $SHE = get_post_meta($post->ID, 'mom_hide_highlights', true);
    $SH = get_post_meta($post->ID, 'mom_post_highlights', true);
    $mom_post_layout = get_post_meta($post->ID, 'mom_post_layout', true);
    if ($mom_post_layout == '') {
	$mom_post_layout = mom_option('post_layout');
    }
    $default_image_click = get_post_meta($post->ID, 'mom_default_image_click', true);
    if ($default_image_click == '') {
	$default_image_click = mom_option('post_layout_default_img');
    }

		$cat_msidebar = '';
		$cat_ssidebar = '';
			$cat_icon = '';
    if (has_category('',$post->ID)) {
    $catid = get_the_category( $post->ID );
    $cat_data = get_option("category_".$catid[0]->term_id);
	$cat_icon = '';
	if($cat_data != '') {
		$cat_icon = isset($cat_data['icon']) ? $cat_data['icon'] : '' ;
		$cat_msidebar = isset($cat_data['sidebar']) ? $cat_data['sidebar'] : '' ;
		$cat_ssidebar = isset($cat_data['ssidebar']) ? $cat_data['ssidebar'] : '' ;
	} else {
		$cat_icon = '';
		$cat_msidebar = '';
		$cat_ssidebar = '';
	}
	if (mom_option('post_cat_sidebar') == false) {
		$cat_msidebar = '';
		$cat_ssidebar = '';
	}
	}
	$postbreadcrumb = mom_option('post_bread');
    $posticon = mom_option('post_icon');

                                    while ( have_posts() ) :
									the_post();
                                setPostViews(get_the_ID());

?>
				<?php if($mom_post_layout == 'layout1') {
				$img = mom_post_image('full');
				$cover = get_post_meta(get_the_ID(), 'mom_post_cover_image', true);
				if ($cover) {
					$img = $cover;
				}
				?>
				<div class="post-layout1" style="background: url('<?php echo $img; ?>') no-repeat center;"><?php if($PCT != '') { ?><div class="photo-credit"><i class="momizat-icon-camera"></i><?php _e('Photo Credit To ', 'framework'); ?><?php echo $PCT; ?></div><?php } ?><div class="pl2-shadow"></div></div>

				<?php } else if($mom_post_layout == 'layout2') {
				$img = mom_post_image('full');
				$cover = get_post_meta(get_the_ID(), 'mom_post_cover_image', true);
				if ($cover) {
					$img = $cover;
				}
				?>

				<div class="post-layout2" style="background: url('<?php echo $img; ?>') no-repeat center;">
					<?php if($PCT != '') { ?><div class="photo-credit"><i class="momizat-icon-camera"></i><?php _e('Photo Credit To ', 'framework'); ?><?php echo $PCT; ?></div><?php } ?>
					<div class="pl2-shadow">
						<div class="pl2-tab-wrap">
							<div class="inner">
								<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
								<?php if (class_exists('WPSubtitle')) { ?><h2 class="mom-sub-title"><?php the_subtitle(); ?></h2><?php } ?>
			                    <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' ); } ?>
							</div>
						</div>
					</div>
				</div>

				<?php } else if($mom_post_layout == 'layout3') {
				$img = mom_post_image('full');
				$cover = get_post_meta(get_the_ID(), 'mom_post_cover_image', true);
				if ($cover) {
					$img = $cover;
				}

				?>

				<div class="post-layout3" style="background: url('<?php echo $img; ?>') no-repeat center;">
					<?php if($PCT != '') { ?><div class="photo-credit"><i class="momizat-icon-camera"></i><?php _e('Photo Credit To ', 'framework'); ?><?php echo $PCT; ?></div><?php } ?>
					<div class="pl3-shadow">
							<div class="inner">
								<div class="pl2-bottom">
									<?php if(mom_option('breadcrumb') != 0) { ?>
				                    <?php if($postbreadcrumb) { ?>
				                    <div class="post-crumbs entry-crumbs">
							<?php if ($cat_icon != '') {
								if (0 === strpos($cat_icon, 'http')) {
									echo '<div class="crumb-icon"><i class="img_icon" style="background-image: url('.$cat_icon.')"></i></div>';
								} else {
									echo '<div class="crumb-icon"><i class="'.$cat_icon.'"></i></div>';
								}
							} ?>
				                        <?php mom_breadcrumb(); ?>
				                    </div>
				                    <?php } ?>
				                    <?php } ?>
									<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
									<?php if (class_exists('WPSubtitle')) { ?><h2 class="mom-sub-title"><?php the_subtitle(); ?></h2><?php } ?>
				                    <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' ); } ?>
								</div>
							</div>
					</div>
				</div>

				<?php } else if($mom_post_layout == 'layout4') {
				$img = mom_post_image('full');
				$cover = get_post_meta(get_the_ID(), 'mom_post_cover_image', true);
				if ($cover) {
					$img = $cover;
				}
				?>

					<div class="inner pl4">
					<section class="section">
						<div class="post-layout4">
							<?php if($PCT != '') { ?><div class="photo-credit"><i class="momizat-icon-camera"></i><?php _e('Photo Credit To ', 'framework'); ?><?php echo $PCT; ?></div><?php } ?>
						    <img src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
							<div class="pl3-shadow">
										<div class="pl2-bottom pl4-content">
											<?php if(mom_option('breadcrumb') != 0) { ?>
						                    <?php if($postbreadcrumb) { ?>
						                    <div class="post-crumbs entry-crumbs">
							<?php if ($cat_icon != '') {
								if (0 === strpos($cat_icon, 'http')) {
									echo '<div class="crumb-icon"><i class="img_icon" style="background-image: url('.$cat_icon.')"></i></div>';
								} else {
									echo '<div class="crumb-icon"><i class="'.$cat_icon.'"></i></div>';
								}
							} ?>
						                <?php mom_breadcrumb(); ?>
						                    </div>
						                    <?php } ?>
						                    <?php } ?>
											<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
											<?php if (class_exists('WPSubtitle')) { ?><h2 class="mom-sub-title"><?php the_subtitle(); ?></h2><?php } ?>
						                    <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' ); } ?>
										</div>
							</div>
						</div>
					</section>
					</div>

				<?php } ?>
                <div class="main-container"><!--container-->

                    <?php if($mom_post_layout != 'layout3' && $mom_post_layout != 'layout4') { ?>
                    <?php if(mom_option('breadcrumb') != 0) { ?>
                    <?php if($postbreadcrumb) { ?>
                    <div class="post-crumbs entry-crumbs">
							<?php if ($cat_icon != '') {
								if (0 === strpos($cat_icon, 'http')) {
									echo '<div class="crumb-icon"><i class="img_icon" style="background-image: url('.$cat_icon.')"></i></div>';
								} else {
									echo '<div class="crumb-icon"><i class="'.$cat_icon.'"></i></div>';
								}
							} ?>
                        <?php mom_breadcrumb(); ?>
                    </div>
                    <?php } ?>
                    <?php } } ?>

					<?php if ($layout != 'fullwidth') { ?>
                    <div class="main-left"><!--Main Left-->
                    	<div class="main-content" role="main"><!--Main Content-->
                    <?php } ?>
                            <div class="site-content page-wrap">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
                                    <?php if($mom_post_layout != 'layout2' && $mom_post_layout != 'layout3' && $mom_post_layout != 'layout4') { ?>
                                    <header>
                                        <h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
                                        <?php if (class_exists('WPSubtitle')) { ?><h2 class="mom-sub-title"><?php the_subtitle(); ?></h2><?php } ?>
                                        <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' );} ?>

                                    </header>
                                    <?php } ?>

                                    <div class="entry-content clearfix">

                                        <?php get_template_part('framework/includes/post-formats'); ?>

										<!-- JWOOL remove featured image from page -->
                                        <?php if(mom_option('post_fimage') && 1==2) {

					    				if($mom_post_layout == 'none') {
					    					if( $HFI == 1 && has_post_thumbnail() ) { $has_image = 'has_f_image';} else { $has_image = '';}
					    				} else {
					    					if( $HFI != 1 && has_post_thumbnail() ) { $has_image = 'has_f_image';} else { $has_image = '';}
					    				}
										if($mom_post_layout != 'default') {$has_image = '';}
										if( mom_option('post_feaimage') == 0 ) {$has_image = '';}
									    ?>
                                        <div class="entry-content-data <?php echo $has_image; ?>">
										<?php if($mom_post_layout == 'default') { ?>
                                        <?php if( $HFI != 1 && has_post_thumbnail() ) { ?>
                                        	<?php if ($HFI != 1) {
	                                        if(mom_option('post_feaimage') != 0) {
										    $img_class = '';
										    $pt_zoom_start = '';
										    $pt_zoom_end = '';
										    if ($default_image_click == 'zoom') {
											$img_class = 'pt-zoom';
											$pt_zoom_start = '<a href="'.mom_post_image('full').'" class="lightbox_link">';
											$pt_zoom_end = '</a>';
										    }
                                        	?>

                                        	<?php if ( has_post_thumbnail()) { ?>
                                            <figure class="post-thumbnail <?php echo $img_class; ?>" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
											<?php echo $pt_zoom_start; ?>
                                                <?php the_post_thumbnail('big-thumb-hd'); ?>
											<?php echo $pt_zoom_end; ?>
                                                <?php if ($default_image_click != 'zoom') { ?><span class="img-toggle"><i class="<?php if ( is_rtl() ) { ?>momizat-icon-arrow-down-left2<?php } else { ?>momizat-icon-arrow-down-right2<?php }  ?>"></i></span><?php } ?>
                                            </figure>
                                            <?php if($PCT != '') { ?><div class="photo-credit img-pct"><i class="momizat-icon-camera"></i><?php _e('Photo Credit To ', 'framework'); ?><?php echo $PCT; ?></div><?php } ?>
                                            <?php }
	                                             } } }
											} //post layout
											if($mom_post_layout == 'none') {
												if( $HFI == 1 && has_post_thumbnail() ) {
	                                        	if ($HFI == 1) {
		                                        if(mom_option('post_feaimage') != 0) {
											    $img_class = '';
											    $pt_zoom_start = '';
											    $pt_zoom_end = '';
											    if ($default_image_click == 'zoom') {
												$img_class = 'pt-zoom';
												$pt_zoom_start = '<a href="'.mom_post_image('full').'" class="lightbox_link">';
												$pt_zoom_end = '</a>';
											    }
	                                        	?>

	                                        	<?php if ( has_post_thumbnail()) { ?>
	                                            <figure class="post-thumbnail <?php echo $img_class; ?>" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
												<?php echo $pt_zoom_start; ?>
	                                                <?php the_post_thumbnail('big-thumb-hd'); ?>
												<?php echo $pt_zoom_end; ?>
	                                                <?php if ($default_image_click != 'zoom') { ?><span class="img-toggle"><i class="<?php if ( is_rtl() ) { ?>momizat-icon-arrow-down-left2<?php } else { ?>momizat-icon-arrow-down-right2<?php }  ?>"></i></span><?php } ?>
	                                            </figure>
	                                            <?php if($PCT != '') { ?><div class="photo-credit img-pct"><i class="momizat-icon-camera"></i><?php _e('Photo Credit To ', 'framework'); ?><?php echo $PCT; ?></div><?php } ?>
	                                            <?php }
		                                             } } }
											}
                                            ?>
                                            <?php if ($SHE != 0) {
	                                            if(mom_option('post_story') != 0) {
                                            ?>
                                            <?php if ($SH != '') { ?>
											<div class="story-highlights">
											    <h4><?php _e('Story Highlights', 'framework'); ?></h4>
											    <ul>
													<?php
													$SH = '<li>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</li>\n<li>"),trim($SH,"\n\r")).'</li>';
													echo $SH;
													?>
											    </ul>
											</div>
										    <?php } } } ?>
                                        </div>
                                        <?php } ?>




<!-- JW -->

<?php

$postid = $post->ID;

require_once("_connect.php");

$q = <<<MOUT
SELECT *, DATE_FORMAT(appear_dt,"%W, %M %D, %Y") dt2
FROM appearances
INNER JOIN people ON person_fk = person_pk
INNER JOIN shows ON show_fk = show_pk
LEFT JOIN media m ON m.appear_fk = appear_pk
LEFT JOIN taxonomy_presets ON tax_fk = tax_pk
WHERE appear_post = $postid
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$aD = $row;
	$mediaDetails[] = $row;
}

$q = sprintf("SELECT * FROM vortago_counts WHERE show_fk IN (0,%d) AND person_fk IN (0,%d)",
	$aD["show_pk"],
	$aD["person_pk"]
);

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	if ($row["show_fk"]==0)
		$person_count = $row["vcount"];
	else if ($row["person_fk"]==0)
		$show_count = $row["vcount"];
	else
		$person_show_count = $row["vcount"];
}

?>


<div class="clearfix"></div>

<p><span itemprop="person" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?=$aD["person_nm"];?></span></span> <?=$aD["tax_verb_past"];?> <?=$aD["tax_preposition"];?> <span itemscope itemtype="http://schema.org/TVSeries"><span itemprop="name"><?=$aD["show_nm"];?></span>.  This <?=$aD["tax_noun"];?> <?=$aD["tax_verb_media"];?> on <span itemprop="episode" itemscope itemtype="http://schema.org/TVEpisode"><meta itemprop="datePublished" content="<?=$aD["appear_dt"];?>"><?=$aD["dt2"];?></span></span>.</p>

<p>Including this <?=$aD["tax_noun"];?>, Vortago has a total of <?=$person_count;?> <?php echo ($person_count>1) ? "appearances" : "appearance";?> for <?=$aD["person_nm"];?>.  To see the full list of <?=$aD["person_nm"];?> appearances, please click the button below. <br>

<span class="mom_button_wrap"><a class="button mom_button blue_bt " href="<?php echo get_permalink($aD["person_post"]);?>" style="margin-top:8px;" data-bg="" data-hoverbg="" data-text="" data-texthover="">All <?=$aD["person_nm"];?> <?=$aD["tax_noun_pl"];?></a></span>
</p>

<p>In addition to this <?=$aD["tax_noun"];?>, Vortago has a total of <?=$show_count;?> <?php echo ($show_count>1) ? $aD["tax_noun_pl"] : $aD["tax_noun"];?> for <?=$aD["show_nm"];?>.  To see the full list of <?=$aD["show_nm"];?> <?=$aD["tax_noun_pl"];?>, please click the button below. <br>

<span class="mom_button_wrap" style="margin-top:5px;"><a class="button mom_button blue_bt " href="<?php echo get_permalink($aD["show_post"]);?>" style="margin-top:8px;" data-bg="" data-hoverbg="" data-text="" data-texthover="">All <?=$aD["show_nm"];?> <?=$aD["tax_noun_pl"];?></a></span>

</p>


<div class="clearfix"></div>

<?php foreach ($mediaDetails as $a) {?>

	<?php if ($a["media_type"]==2) { ?>
		<?php if ($a["media_title"]) { ?>
			<h2><?php echo iconv("ISO-8859-1//TRANSLIT","UTF-8",$a["media_title"]);?></h2>
		<?php } else { ?>
			<h2><?php the_title(); ?></h2>
		<?php } ?>

		<iframe src="https://player.vimeo.com/video/<?=$a["media_code"];?>?color=ffffff&title=0&byline=0&portrait=0" width="100%" height="400px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

	<?php } ?>
	<?php if ($a["media_type"]==5) { ?>


		<?php if ($a["media_title"]) { ?>
			<h2><?php echo iconv("ISO-8859-1//TRANSLIT","UTF-8",$a["media_title"]);?></h2>
		<?php } else { ?>
			<h2><?php the_title(); ?></h2>
		<?php } ?>

		<div class="audio_frame">
		<audio class="wp-audio-shortcode" id="audio-327-1" preload="none" style="width: 100%;" controls="controls"><source type="audio/mpeg" src="<?=$a["media_url"];?>" /><a href="<?=$a["media_code"];?>"><?=$a["media_code"];?></a></audio>
		</div>


	<?php } ?>

<?php } ?>


<br>NPR:<br>
		<div class="audio_frame">
		<audio class="wp-audio-shortcode" id="audio-327-1" preload="none" style="width: 100%;" controls="controls"><source type="audio/mpeg" src="http://pd.npr.org/anon.npr-mp3/npr/fa/2015/12/20151210_fa_02.mp3?dl=1" /><a href="<?=$a["media_code"];?>">http://pd.npr.org/anon.npr-mp3/npr/fa/2015/12/20151210_fa_02.mp3?dl=1</a></audio>
		</div>

<br>ROGAN:<br>
		<div class="audio_frame">
		<audio class="wp-audio-shortcode" id="audio-327-1" preload="none" style="width: 100%;" controls="controls"><source type="audio/mpeg" src="http://traffic.libsyn.com/joeroganexp/p733.mp3" /><a href="<?=$a["media_code"];?>">http://traffic.libsyn.com/joeroganexp/p733.mp3</a></audio>
		</div>










					        <?php
						    if (mom_option('post_top_ad') != '' && $disable_ads == 0) {
							echo do_shortcode('[ad id="'.mom_option('post_top_ad').'"]');
							echo do_shortcode('[gap height="20"]');
						    }

						    $format = get_post_format();
						    $chat_top_content = '';
					        $chat_bottom_content = '';
					                if ($format == 'chat') {
					                        global $posts_st;
					                        $extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
					                        $chat_top_content = isset($extra['chat_post_top_content']) ? $extra['chat_post_top_content'] : '';
					                        $chat_bottom_content = isset($extra['chat_post_bottom_content']) ? $extra['chat_post_bottom_content'] : '';
					                }
						?>
                                        <?php
                                        echo $chat_top_content;
                                        the_content();

                                       echo $chat_bottom_content;
                                        ?>
                                        <?php wp_link_pages( array( 'before' => '<div class="my-paginated-posts">' . __( 'Pages:', 'framework' ), 'after' => '</div>' ) ); ?>
					        <?php
						    if (mom_option('post_bottom_content_ad') != '' && $disable_ads == 0) {

							echo do_shortcode('[gap height="20"]');
							echo do_shortcode('[ad id="'.mom_option('post_bottom_content_ad').'"]');
							echo do_shortcode('[gap height="20"]');
						    }
						?>
                                    <div class="clearfix"></div>
                                    </div>
                                </article>
                                <div class="clear"></div>

                                <?php if($PSC != '') { ?>
                                <div class="post_source">
	                                <p><span><?php _e( 'Post source : ', 'framework'); ?></span><?php echo $PSC; ?></p>
                                </div>

                                <div class="clear"></div>
                                <?php } ?>

                                <?php
                                if(mom_option('post_tags')) {
                                if($PTS != 1) { the_tags( '<div class="entry-tag-links"><span>' . __( 'Tags:', 'framework' ) . '</span>', '', '</div>' ); }
                                }
                                ?>


                                <?php
                                if(mom_option('share_position') == 'bottom' || mom_option('share_position') == 'both') {
                                if(mom_option('post_sharee')) {
                                if ($DPS != 1) { mom_posts_share(get_the_ID(),get_permalink()); }
                                } } else {
                                ?>
                                <div class="mom-share-post-free"></div>
                                <?php } ?>

                                <?php
                                if(mom_option('post_nav')) {
                                if ($DPN != 1) { ?>
                                <div class="post-nav-links">
                                    <div class="post-nav-prev">
                                        <?php previous_post_link( '%link','<span>'. __( 'Previous :', 'framework' ).'</span> %title' ); ?>
                                    </div>
                                    <div class="post-nav-next">
                                        <?php next_post_link( '%link', '<span>'. __( 'Next :', 'framework' ).'</span> %title' ); ?>
                                    </div>
                                </div>
                                <?php
                                	}
                                }
                                ?>

                                <?php
                                if(mom_option('post_author')) {
                                if ($DAB != 1) { get_template_part( 'framework/includes/post-author' ); }
                                }
                                ?>

                                <?php
                                if(mom_option('post_related')) {
                                if ($DRP != 1) { get_template_part( 'framework/includes/post-related' ); }
                                }
                                ?>

                                <?php
                                if(mom_option('post_comments')) {
                                if ($DPC != 1) { comments_template(); }
                                }
                                ?>
                                					        <?php
						    if (mom_option('post_bottom_ad') != '' && $disable_ads == 0) {
							echo do_shortcode('[ad id="'.mom_option('post_bottom_ad').'"]');
							echo do_shortcode('[gap height="20"]');
						    }
						?>

                            </div>

                    <?php if ($layout != 'fullwidth') { ?>
                        </div><!--Main Content-->
                    	<?php
                    	$swstyle = mom_option('swstyle');
				          if( $swstyle == 'style2' ){
				            $swclass = ' sws2';
				          } else {
				            $swclass = '';
				          }
                    	if ($site_width != 'wide' || strpos($layout,'both') !== false) {
                    	if($cat_ssidebar != ''){ ?>
	                    <aside class="secondary-sidebar<?php echo $swclass; ?>" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><!--secondary sidebar-->
	                    	<?php dynamic_sidebar($cat_ssidebar); ?>
	                    </aside>
						<?php
						} else {
                    		get_sidebar('left');
                    	}
                    	}
                    	?>
                    </div><!--Main left-->
                    <?php
                    if($cat_msidebar != ''){ ?>
                    <aside class="sidebar<?php echo $swclass; ?>" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><!--sidebar-->
	                    <?php dynamic_sidebar($cat_msidebar); ?>
                    </aside>
                    <?php
                    } else {
                    	get_sidebar();
                    }
                    ?>
                    <?php } ?>
                </div><!--container-->

            </div><!--wrap-->
                                            <?php
								endwhile;
								wp_reset_query();
								?>

<?php get_footer(); ?>