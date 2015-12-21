<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require_once("_connect.php");

$showId = $_GET["show"];

$q = <<<MOUT
SELECT *
FROM shows
LEFT JOIN show_notes n ON n.show_fk = show_pk
LEFT JOIN show_description d ON d.show_fk = show_pk
LEFT JOIN taxonomy_presets ON tax_fk = tax_pk
WHERE show_pk = $showId
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$sd = $row;
}

$sd["stat" . $sd["show_status"]] = "checked='checked'";


/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Shows";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["shows"]["sub"]["Show Profile"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Misc"] = "";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">


		<!-- widget grid -->
		<section id="widget-grid" class="">

			<!-- row -->
			<div class="row">

				<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2><?=$sd["show_nm"];?></h2>

							<div class="widget-toolbar" role="menu">
								<a href="shows.php" class="btn btn-primary">Back to Show Listing</a>
							</div>
						</header>

						<!-- widget div-->
						<div role="content">

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body no-padding">

								<form id="order-form" class="smart-form" novalidate="novalidate">

									<fieldset>

										<div class="row">
											<section class="col col-6">
												<label class="label">Vortago ID</label>
												<label class="input state-disabled">
													<input type="text" class="input-sm" id=inId value="<?=$sd["show_pk"];?>" disabled="disabled">
												</label>
											</section>

											<section class="col col-6">
												<label class="label">Wordpress ID</label>
												<label class="input state-disabled">
													<?php if ($sd["show_post"]) { ?>
														<input type="text" class="input-sm" value="<?=$sd["show_post"];?>" disabled="disabled">
													<?php } else { ?>
														<a id=btnCreatePost href="javascript:void(0);" class="btn btn-primary btn-sm">Create WP Post</a>
													<?php } ?>
												</label>
											</section>
										</div>
									</fieldset>

									<fieldset>

										<section>
											<label class="label">Full (Official) Name of Show or Event</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName value="<?=$sd["show_nm"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> The Late Show with David Letterman
											</div>
										</section>

										<section>
											<label class="label">Sorting Name (ie without leading "The...")</label>
											<label class="input">
												<input type="text" class="input-sm" id=inSort value="<?=$sd["sort_by"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> Late Show with David Letterman
											</div>
										</section>

										<section>
											<label class="label">Show or Event Alias #1</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName2 value="<?=$sd["show_nm2"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> David Letterman
											</div>
										</section>

										<section>
											<label class="label">Show or Event Alias #2</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName3 value="<?=$sd["show_nm3"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> The Late Show
											</div>
										</section>

										<section>
											<label class="label">Show or Event Alias #3</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName4 value="<?=$sd["show_nm4"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> Letterman
											</div>
										</section>

										<section>
											<label class="label">Thumbnail Image</label>
											<label class="input">
												<input type="text" class="input-sm" id=inImgUrl value="<?=$sd["img_url"];?>">
											</label>
											<div class="note">
												Use an image that is relatively small and horizontal.  No bigger than 500px by 400px
											</div>
											<div class="note">
												<strong>Example:</strong> https://s0.wp.com/wp-content/themes/vip/99u/assets/img/logo-og.png
											</div>
										</section>


										<section>
											<label class="label">Show or Event Wikipedia Page</label>
											<label class="input">
												<input type="text" class="input-sm" id=inWiki value="<?=$sd["show_wiki"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> https://en.wikipedia.org/wiki/Late_Show_with_David_Letterman
											</div>
										</section>
									</fieldset>

									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="label">Start Year</label>
												<label class="input">
													<input type="text" class="input-sm" id=inYear1 value="<?=$sd["year_start"];?>">
												</label>
												<div class="note">
													<strong>Example:</strong> 2007
												</div>
											</section>

											<section class="col col-6">
												<label class="label">End Year</label>
												<label class="input">
													<input type="text" class="input-sm" id=inYear2 value="<?=$sd["year_end"];?>">
												</label>
												<div class="note">
													<strong>Example:</strong> 2013
												</div>
											</section>
										</div>

										<div class="row">
											<section class="col col-6">
												<label class="label">Start Date (YYYY-MM-DD)</label>
												<label class="input">
													<input type="text" class="input-sm" id=inDate1 value="<?=$sd["dt_start"];?>">
												</label>
												<div class="note">
													<strong>Example:</strong> 2009-02-20
												</div>
											</section>

											<section class="col col-6">
												<label class="label">End Date (YYYY-MM-DD)</label>
												<label class="input">
													<input type="text" class="input-sm" id=inDate2 value="<?=$sd["dt_end"];?>">
												</label>
												<div class="note">
													<strong>Example:</strong> 2013-11-01
												</div>
											</section>
										</div>
										<section>
											<label class="label">Event Status</label>
											<div class="row">
												<div class="col" id="myStatus">
													<label class="radio">
														<input type="radio" name="radioStatus" <?=$sd["stat1"];?> value=1>
														<i></i>Still running</label>
													<label class="radio">
														<input type="radio" name="radioStatus" <?=$sd["stat0"];?> value=0>
														<i></i>No longer running</label>
												</div>
											</div>
										</section>

									</fieldset>

									<fieldset>

										<section>
											<label class="label">Location Name</label>
											<label class="input">
												<input type="text" class="input-sm" id=inLocation value="<?=$sd["location"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Mirimax Studios"
											</div>
										</section>

										<section>
											<label class="label">Location Address</label>
											<label class="input">
												<input type="text" class="input-sm" id=inAddress value="<?=$sd["address"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Los Angeles, CA" or "2450 Colorado Ave, Santa Monica, CA 90401"
											</div>
										</section>

										<section>
											<label class="label">Latitude</label>
											<label class="input">
												<input type="text" class="input-sm" id=inLat value="<?=$sd["show_lat"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "-40.1943292"
											</div>
										</section>

										<section>
											<label class="label">Longitude</label>
											<label class="input">
												<input type="text" class="input-sm" id=inLong value="<?=$sd["show_long"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "75.2349291"
											</div>
										</section>

										<section>
											<label class="label">Coordinates</label>
											<label class="input state-disabled">
													<a id=btnGetCoord href="javascript:void(0);" class="btn btn-primary btn-sm">Fetch Coordinates</a>
											</label>
										</section>

									</fieldset>

									<fieldset>

										<h2 style="margin-bottom:10px;"> Taxonomies </h2>

										<section>
											<label class="label">Taxonomy Preset</label>
											<label class="select">
												<select class="input-sm" id=inTaxPreset>
													<option value="0">None</option>
													<option value="1" <?php echo ($sd["tax_pk"]==1) ? " SELECTED " : "";?>>Talk Show</option>
													<option value="2" <?php echo ($sd["tax_pk"]==2) ? " SELECTED " : "";?>>Lecture/Conference</option>
													<option value="3" <?php echo ($sd["tax_pk"]==3) ? " SELECTED " : "";?>>Debate/Panel Discussion</option>
												</select> <i></i>
											</label>
										</section>

										<section>
											<label class="label">Verb for Person (present tense)</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Tom Cruise <b>appears</b> on the Tonight Show..."<br>
												<strong>Example:</strong> "Bill Clinton <b>is interviewed</b> on Larry King Live..."
											</div>
										</section>

										<section>
											<label class="label">Verb for Person (past tense)</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Tom Cruise <b>appeared on</b> the Tonight Show..."<br>
												<strong>Example:</strong> "Bill Clinton <b>was interviewed on</b> Larry King Live..."
											</div>
										</section>

										<section>
											<label class="label">Verb for Person (passive)</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Tom Cruise <b>has appeared on</b> the Tonight Show..."<br>
												<strong>Example:</strong> "Bill Clinton <b>has given lectures at</b> TED Talks..."
											</div>
										</section>

										<section>
											<label class="label">Verb for Media</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "This interview <b>took place</b> on..."<br>
												<strong>Example:</strong> "This speech <b>was delivered</b> on..."
											</div>
										</section>

										<section>
											<label class="label">Noun for Appearance</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "This <b>appearance</b>..."<br>
												<strong>Example:</strong> "This <b>interview</b>..."
											</div>
										</section>

										<section>
											<label class="label">Noun for Appearance (Plural)</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Bill Clinton has 25 <b>speeches</b>..."<br>
												<strong>Example:</strong> "Tom Cruise has 15 <b>interviews</b>..."
											</div>
										</section>

										<section>
											<label class="label">Noun for Person</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Bill Clinton was a <b>guest</b> on..."<br>
												<strong>Example:</strong> "Tom Cruise was a <b>panelist</b> on..."
											</div>
										</section>

										<section>
											<label class="label">Preposition ("on", "at", etc.)</label>
											<label class="input">
												<input type="text" class="input-sm" id=inTax1 value="<?=$sd["tax1"];?>">
											</label>
											<div class="note">
												<strong>Example:</strong> "Bill Clinton gives a speech <b>at</b> TED Talks..."<br>
												<strong>Example:</strong> "Tom Cruise has been a guest <b>on</b> Conan..."
											</div>
										</section>


									</fieldset>

									<fieldset>

										<section>
											<label class="label">Official Description for Show Page</label>
											<label class="textarea">
												<textarea rows="8" class="custom-scroll" id=inDesc><?=$sd["show_desc"];?></textarea>
											</label>
										</section>

										<section>
											<label class="label">Notes</label>
											<label class="textarea">
												<textarea rows="6" class="custom-scroll" id=inNotes><?=$sd["show_notes"];?></textarea>
											</label>
										</section>
									</fieldset>
									<footer>
										<a id=btnAdd href="javascript:void(0);" class="btn btn-primary">
											Save Changes
										</a>
									</footer>
								</form>

							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->

				</article>

			</div>

			<!-- end row -->

		</section>
		<!-- end widget grid -->

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	// include page footer
	include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
	//include required scripts
	include("inc/scripts.php");
?>

<script>

	$(document).ready(function() {

		$('form input').keydown(function (e){
			if(e.keyCode == 13){
				$("#btnAdd").click();
			}
		})


		$("#btnGetCoord").click(function(){
			console.log("Fetching coordinates...");
			$.ajax({
				type: "GET",
				url: "ajax_getCoords.php",
				data: {
					myId: $("#inId").val()
				},
				dataType: "json",
				success: function(json){
					console.log(json);
					if (json.err)
						alert (json.msg);
					else{
						alert ("Success!");
						location.reload();
					}
				}
			});
		});

		$("#btnCreatePost").click(function(){
			console.log("Creating WP post...");
			$.ajax({
				type: "POST",
				url: "ajax_createShowPost.php",
				data: {
					myId: $("#inId").val()
				},
				dataType: "json",
				success: function(json){
					console.log(json);
					if (json.err)
						alert (json.msg);
					else{
						alert ("Success!");
						location.reload();
					}
				}
			});
		});


		$("#btnAdd").click(function(){
			console.log("Updating show....");
			$.ajax({
				type: "POST",
				url: "ajax_showsAdd.php",
				data: {
					myId: $("#inId").val(),
					myNotes: $("#inNotes").val(),
					myName: $("#inName").val(),
					myName2: $("#inName2").val(),
					myName3: $("#inName3").val(),
					myName4: $("#inName4").val(),
					myWiki: $("#inWiki").val(),
					myYear1: $("#inYear1").val(),
					myYear2: $("#inYear2").val(),
					myDate1: $("#inDate1").val(),
					myDate2: $("#inDate2").val(),
					myLocation: $("#inLocation").val(),
					myAddress: $("#inAddress").val(),
					myDesc: $("#inDesc").val(),
					myLat: $("#inLat").val(),
					myLong: $("#inLong").val(),
					myStatus: $('#myStatus input:checked').val(),
					myImgUrl: $("#inImgUrl").val(),
					mySort: $("#inSort").val(),
					myTaxPreset: $("#inTaxPreset").val()
				},
				dataType: "json",
				success: function(json){
					console.log(json);
					if (json.err)
						alert (json.msg);
					else
						alert ("Success!");
						location.reload();
				}
			});
		});
	});

</script>

<?php
	//include footer
	include("inc/google-analytics.php");
?>