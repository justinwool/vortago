<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

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
$page_nav["shows"]["sub"]["showsAdd"]["active"] = true;
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
					<div class="jarviswidget jarviswidget-sortable" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
						<!-- widget options:
							usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

							data-widget-colorbutton="false"
							data-widget-editbutton="false"
							data-widget-togglebutton="false"
							data-widget-deletebutton="false"
							data-widget-fullscreenbutton="false"
							data-widget-custombutton="false"
							data-widget-collapsed="true"
							data-widget-sortable="false"

						-->
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Add a New Show or Event</h2>
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
									<header>
										Fill out the form below.
									</header>

									<fieldset>

										<section>
											<label class="label">Full (Official) Name of Show or Event</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName>
											</label>
											<div class="note">
												<strong>Example:</strong> The Late Show with David Letterman
											</div>
										</section>

										<section>
											<label class="label">Show or Event Alias #1</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName2>
											</label>
											<div class="note">
												<strong>Example:</strong> David Letterman
											</div>
										</section>

										<section>
											<label class="label">Show or Event Alias #2</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName3>
											</label>
											<div class="note">
												<strong>Example:</strong> The Late Show
											</div>
										</section>

										<section>
											<label class="label">Show or Event Alias #3</label>
											<label class="input">
												<input type="text" class="input-sm" id=inName4>
											</label>
											<div class="note">
												<strong>Example:</strong> Letterman
											</div>
										</section>


										<section>
											<label class="label">Show or Event Wikipedia Page</label>
											<label class="input">
												<input type="text" class="input-sm" id=inWiki>
											</label>
											<div class="note">
												<strong>Example:</strong> https://en.wikipedia.org/wiki/Late_Show_with_David_Letterman
											</div>
										</section>
									</fieldset>
									<fieldset>

										<section>
											<label class="label">Event Status</label>
											<div class="row">
												<div class="col">
													<label class="radio">
														<input type="radio" name="radioStatus" checked="checked" value=1>
														<i></i>Still running</label>
													<label class="radio">
														<input type="radio" name="radioStatus" value=0>
														<i></i>No longer running</label>
												</div>
											</div>
										</section>

										<section>
											<label class="label">Notes</label>
											<label class="textarea">
												<textarea rows="6" class="custom-scroll" id=inNotes></textarea>
											</label>
										</section>
									</fieldset>
									<footer>
										<a id=btnAdd href="javascript:void(0);" class="btn btn-primary">
											Create Show
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

		$("#btnAdd").click(function(){

			console.log($("#inName").val());

			$.ajax({
				type: "POST",
				url: "ajax_showsAdd.php",
				data: {
					myNotes: $("#inNotes").val(),
					myName: $("#inName").val(),
					myName2: $("#inName2").val(),
					myName3: $("#inName3").val(),
					myName4: $("#inName4").val(),
					myWiki: $("#inWiki").val(),
					myStatus: $('input[name=radioStatus]:checked', '#myForm').val()
				},
				dataType: "json",
				success: function(json){
					if (json.err)
						alert(json.msg);
					else
						alert("Your show has been added.");
				}
			});
		});
	});

</script>

<?php
	//include footer
	include("inc/google-analytics.php");
?>