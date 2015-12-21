<?php
/*
Template Name: People List
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

require_once("_connect.php");

$inlet = ($_GET["l"]);

if (!$inlet) $inlet = "A";
$where = ($inlet) ? " AND person_nm LIKE '$inlet" . "%" . "' " : "";

$q = <<<MOUT
SELECT *
FROM people, wp_posts
WHERE person_post = id
$where
ORDER BY person_nm
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$people[] = $row;
}



//echo "total count: " . count($shows) . "<br>";
//echo 'ceil(count($shows)/2)' . " = " . ceil(count($shows)/2) . "<br>";
//echo 'ceil(count($shows)/2)+1' . " = " . ceil(count($shows)/2)+1 . "<br>";
?>

<div class="entry-content clearfix">

<div class="adv-search-form" style="margin-top:25px; color:black;">
	<span class="adv-s-cat">
	<label for="adv-cat">Jump to Letter:</label>
	<div class="select-wrap">
	<select id="adv-cat" name="myletter" style="color:#777">
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="D">D</option>
	<option value="E">E</option>
	<option value="F">F</option>
	<option value="G">G</option>
	<option value="H">H</option>
	<option value="I">I</option>
	<option value="J">J</option>
	<option value="K">K</option>
	<option value="L">L</option>
	<option value="M">M</option>
	<option value="N">N</option>
	<option value="O">O</option>
	<option value="P">P</option>
	<option value="Q">Q</option>
	<option value="R">R</option>
	<option value="S">S</option>
	<option value="T">T</option>
	<option value="U">U</option>
	<option value="V">V</option>
	<option value="W">W</option>
	<option value="X">X</option>
	<option value="Y">Y</option>
	<option value="Z">Z</option>
	</select>
	<div class="sort-arrow"></div>
	</div>
	</span>
</div>

<script>

jQuery(function($) {
	$('[name=myletter]').val("<?=$inlet;?>");
	$("#adv-cat").change(function(){
		window.location = "/people/?l=" + $(this).val();
	});
});

</script>

<div class="clearfix" style="margin-bottom:25px;"></div>

<style>
.showList a {display:block;}
</style>


	<div class="one_half showList">
	<?php for ($i=0;$i<ceil(count($people)/2);$i++) { ?>
		<a href="<?=$people[$i]["guid"];?>"><?=$people[$i]["person_nm"];?></a>	
	<?php } ?>
	</div>
	<div class="one_half last showList">
	<?php for ($i=ceil(count($people)/2)+1;$i<count($people);$i++) { ?>
		<a href="<?=$people[$i]["guid"];?>"><?=$people[$i]["person_nm"];?></a>	
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