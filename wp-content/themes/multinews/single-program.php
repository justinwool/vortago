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

                                        <?php if(mom_option('post_fimage')) {

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


<!-- JW -->
											<div class="story-highlights">
													<h4>Categories</h4>
													<ul>
														<li><a href="#h">First Recorded Event:  2010</a></li>
														<li><a href="#h">Still Ongoing</a></li>
														<li><a href="#h">Takes Place in Burbank, California</a></li>
													</ul>
											</div>
<!-- end JW -->



                                        </div>





                                        <?php } ?>




<!-- JW -->

<?php

$postid = $post->ID;

require_once("_connect.php");

$q = <<<MOUT
SELECT *
FROM shows
LEFT JOIN show_notes n ON n.show_fk = show_pk
LEFT JOIN show_description d ON d.show_fk = show_pk
LEFT JOIN taxonomy_presets ON tax_fk = tax_pk
WHERE show_post = $postid
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$showDetails = $row;
}

$showDetails["map"] = str_replace(" ","+",$showDetails["location"]);

?>

<p>
<span itemscope itemtype="http://schema.org/TVSeries"><span itemprop="name"><?=$showDetails["show_nm"];?></span>
<?php if ($showDetails["show_wiki"]<>"") { ?>
	<link itemprop="sameAs" href="<?=$showDetails["show_wiki"];?>"/>
<?php } ?>
</span>
</p>

<p>
<?=$showDetails["show_desc"];?>
</p>

<?php if ($showDetails["year_start"]) { ?>

	<div class="clearfix"></div>

	<div class="mom_hr mom_hr_square mom_hr_ mom_hr_medium" style=""><span class="mom_inner_hr" style=""><i style=""></i></span></div>

	<h3>Timeline for <?=$showDetails["show_nm"];?></h3>

	<?php if ($showDetails["year_end"]) { ?>
	
		<?php if ($showDetails["year_end"]==$showDetails["year_start"]) { ?>
			<?=$showDetails["show_nm"];?> ran during <?=$showDetails["year_start"];?>. 
		<?php } else {?>
			<?=$showDetails["show_nm"];?> ran from <?=$showDetails["year_start"];?> until <?=$showDetails["year_end"];?>. 
		<?php } ?>

	<?php } else {?>
		<?=$showDetails["show_nm"];?> started in <?=$showDetails["year_start"];?> and is still an ongoing program. 
	<?php } ?>

	<?php if ($showDetails["dt_start"]) { ?>

		<?php if ($showDetails["dt_end"]) { ?>
			The first episode of <?=$showDetails["show_nm"];?> was on <?=$showDetails["dt_start"];?>, with the last episode occurring on <?=$showDetails["dt_end"];?>.
		<?php } else {?>
			The first episode of <?=$showDetails["show_nm"];?> was on <?=$showDetails["dt_start"];?>. 
		<?php } ?>

	<?php } ?>

<?php } ?>



<div class="clearfix"></div>

<?php if ($showDetails["location"]) { ?>

<div class="mom_hr mom_hr_square mom_hr_ mom_hr_medium" style=""><span class="mom_inner_hr" style=""><i style=""></i></span></div>


<h3>Location of <?=$showDetails["show_nm"];?></h3>

<?=$showDetails["show_nm"];?> takes place at <?=$showDetails["location"];?>, shown in the map below:

<div style="margin:10px auto;">
<?=$showDetails["location"];?><br>
<?=$showDetails["address"];?>
</div>

<?php if ($showDetails["show_lat"] && $showDetails["show_long"]) { ?>

<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>

<style>
#map_wrapper {
    height: 400px;
    margin-top:15px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>

<script>
jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    // Multiple Markers
    var markers = [
        ['London Eye, London', <?=$showDetails["show_lat"];?>,<?=$showDetails["show_long"];?>]
    ];
                        
    // Info Window Content
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<h3>London Eye</h3>' +
        '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
        ['<div class="info_content">' +
        '<h3>Palace of Westminster</h3>' +
        '<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
        '</div>']
    ];
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}
</script>

<?php } ?>
<?php } ?>


<div class="clearfix"></div>

<div class="mom_hr mom_hr_square mom_hr_ mom_hr_medium" style=""><span class="mom_inner_hr" style=""><i style=""></i></span></div>

<div class="main_tabs base-box tabs_h1" style="margin-top:20px;">
   <ul class="tabs">
      <li><a href="#" class="current">Appearance History</a></li>
      <li><a href="#" class="">Watch Content</a></li>
   </ul>
   <div class="tabs-content-wrap">
      <div class="tab-content" style="display: block;">
		<?php //get_template_part( 'jw_postTable' );?>
      </div>
      <div class="tab-content" style="display: none;">
		<?php get_template_part( 'page_jw' );?>
      </div>
   </div>
   <div class="clear"></div>
</div>

<style>
.tab-content .mom-related-posts li {height:201px; overflow:hidden; margin-right:9px!important;}
.mom-related-posts li a {line-height:12px;}
.mom-related-posts .post-thumbnail {margin-bottom:0px!important;}
.tab-content .mom-related-posts {border:none;}
.entry-content-data .story-highlights ul li a {
    display: inline-block;
    font-size: 15px;
    color: #7e7e7e;
    padding: 10px 0 10px 15px;
    }
</style>

<link rel='stylesheet' id='js_composer_front-css'  href='http://vortago.com/wp-content/plugins/js_composer/assets/css/js_composer.css?ver=4.6.2' type='text/css' media='all' />
<script type='text/javascript' src='http://vortago.com/wp-content/plugins/js_composer/assets/js/js_composer_front.js?ver=4.6.2'></script>
<script type='text/javascript' src='http://vortago.com/wp-content/plugins/js_composer/assets/lib/vc_accordion/vc-accordion.js?ver=4.6.2'></script>
<script type='text/javascript' src='http://vortago.com/wp-content/plugins/js_composer/assets/lib/vc-tta-autoplay/vc-tta-autoplay.js?ver=4.6.2'></script>
<script type='text/javascript' src='http://vortago.com/wp-content/plugins/js_composer/assets/lib/vc_tabs/vc-tabs.js?ver=4.6.2'></script>
<style>
.vc_tta-panel-body .mom-related-posts li {height:201px; overflow:hidden; margin-right:9px!important;}
.mom-related-posts li a {line-height:12px;}
.mom-related-posts .post-thumbnail {margin-bottom:0px!important;}
.vc_tta-panel-body .mom-related-posts {border:none;}
.entry-content-data .story-highlights ul li a {
    display: inline-block;
    font-size: 15px;
    color: #7e7e7e;
    padding: 10px 0 10px 15px;
    }
</style>






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