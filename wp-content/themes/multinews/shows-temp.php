<?php
/*
Template Name: Shows List
*/
?>
<?php get_header(); 
	global $post;
	$pagebreadcrumb = get_post_meta($post->ID, 'mom_hide_breadcrumb', true);
	$icon = get_post_meta($post->ID, 'mom_page_icon', true);
	$layout = get_post_meta(get_the_ID(), 'mom_page_layout', true);
	$PS = get_post_meta(get_the_ID(), 'mom_page_share', true);
	$PC = get_post_meta(get_the_ID(), 'mom_page_comments', true);
?>


<div class="main-container"><!--container-->                  
     
    <?php if(mom_option('breadcrumb') != 0) { ?>
    <?php if ($pagebreadcrumb != true) { ?>    
    <div class="post-crumbs archive-page entry-crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    	<?php if($icon != '') { 
				if (0 === strpos($icon, 'http')) {
					echo '<div class="crumb-icon"><i class="img_icon" style="background-image: url('.$icon.')"></i></div>';
				} else {
					echo '<div class="crumb-icon"><i class="'.$icon.'"></i></div>';
				}
				 } else { ?>
        <div class="crumb-icon"><i class="momizat-icon-user3"></i></div>
        <?php } ?>
        <span>
            <?php the_title(); ?>
        </span>
    </div>
    <?php } ?> 
    <?php } else { ?>
		<span class="mom-page-title"><h1><?php the_title(); ?></h1></span>
	<?php } ?>

	<?php if ($layout != 'fullwidth') { ?>
	<div class="main-left"><!--Main Left-->	 
	<div class="main-content" role="main"><!--Main Content-->
	<?php } ?>
	<div class="site-content page-wrap">

<!-- JW -->

<?php

$postid = $post->ID;

require_once("_connect.php");

$q = <<<MOUT
SELECT *
FROM shows, wp_posts
WHERE show_post = id
ORDER BY sort_by
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$shows[] = $row;
}

$showct = count($shows);
for ($i=1;$i<=$showct;$i++){
	$colct[$i%3]++;
}

//echo "total count: " . count($shows) . "<br>";
//echo 'ceil(count($shows)/2)' . " = " . ceil(count($shows)/2) . "<br>";
//echo 'ceil(count($shows)/2)+1' . " = " . ceil(count($shows)/2)+1 . "<br>";
?>

<div class="entry-content clearfix">

<style>
.showList a {display:block;}
</style>

	<div class="one_half showList">
	<?php for ($i=0;$i<ceil(count($shows)/2);$i++) { ?>
		<a href="<?=$shows[$i]["guid"];?>"><?=$shows[$i]["show_nm"];?></a>	
	<?php } ?>
	</div>
	<div class="one_half last showList">
	<?php for ($i=ceil(count($shows)/2)+1;$i<count($shows);$i++) { ?>
		<a href="<?=$shows[$i]["guid"];?>"><?=$shows[$i]["show_nm"];?></a>	
	<?php } ?>
	</div>

			<?php if ($PS == true) mom_posts_share(get_the_ID(), get_permalink()); ?>
					<?php if ($PC == true) comments_template(); ?>
        </div>

		<?php if ($layout != 'fullwidth') { ?>
</div><!-- Entry Content-->
    	</div><!--Main Content-->
		<?php get_sidebar('left'); ?>
	</div><!--Main left-->
	<?php get_sidebar(); ?>
	<?php } ?>
</div><!--container-->

</div><!--wrap-->
<?php get_footer(); ?>