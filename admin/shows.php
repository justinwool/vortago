<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require_once("_connect.php");

$q = <<<MOUT
SELECT *
FROM shows
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$shows[] = $row;
}



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
$page_nav["shows"]["sub"]["shows"]["active"] = true;
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

				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Existing Vortago Shows and Events</h2>

						</header>

						<!-- widget div-->
						<div>

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body no-padding">

<style>
#mytable tr {cursor:pointer;}
</style>
								<table id="mytable" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Show Name</th>
											<th>Show Alias(es)</th>
											<th>Image</th>
											<th>Wiki?</th>
											<th>Map?</th>
											<th>WP?</th>
										</tr>
									</thead>
									<tbody id="mytablebody">
<? foreach ($shows as $s) { ?>
	<tr id="row<?=$s["show_pk"];?>">
		<td><?=$s["show_pk"];?></td>
		<td><?=$s["show_nm"];?></td>
		<td>
			<?=$s["show_nm2"];?>, 
			<?=$s["show_nm3"];?>, 
			<?=$s["show_nm4"];?>
		</td>
		<td><? echo ($s["img_url"]=="") ? "" : "Yes"; ?></td>
		<td><? echo ($s["show_wiki"]) ? "Yes" : ""; ?></td>
		<td><? echo ($s["show_lat"] && $s["show_long"]) ? "Yes" : ""; ?></td>
		<td><? echo ($s["show_post"]=="") ? "" : "Yes"; ?></td>
	</tr>
<? } ?>

									</tbody>
								</table>

							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->

				</article>
				<!-- WIDGET END -->

			</div>

			<!-- end row -->

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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script>

	$(document).ready(function() {

	/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};



		var oTable;

		$("#mytablebody tr").click(function(){
			window.location = "showProfile.php?show=" + $(this).attr("id").substr(3);
		});


		/* TABLETOOLS */
		$('#mytable').dataTable({

			// Tabletools options:
			//   https://datatables.net/extensions/tabletools/button_options
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"iDisplayLength": 100,
			"aaSorting": [
				[1, "asc"]
			],
			"oTableTools": {
				 "aButtons": [
				 "copy",
				 "csv",
				 "xls",
					{
						"sExtends": "pdf",
						"sTitle": "SmartAdmin_PDF",
						"sPdfMessage": "SmartAdmin PDF Export",
						"sPdfSize": "letter"
					},
					{
						"sExtends": "print",
						"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
					}
				 ],
				"sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
			},
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_tabletools) {
					responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#mytable'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_tabletools.respond();
			}
		});
		

	});

</script>

<?php
	//include footer
	include("inc/google-analytics.php");
?>