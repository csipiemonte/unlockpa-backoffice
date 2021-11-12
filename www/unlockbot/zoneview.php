<?php
namespace PHPMaker2019\unlockBOT;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$zone_view = new zone_view();

// Run the page
$zone_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$zone_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$zone->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fzoneview = currentForm = new ew.Form("fzoneview", "view");

// Form_CustomValidate event
fzoneview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fzoneview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$zone->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $zone_view->ExportOptions->render("body") ?>
<?php $zone_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $zone_view->showPageHeader(); ?>
<?php
$zone_view->showMessage();
?>
<form name="fzoneview" id="fzoneview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($zone_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $zone_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="zone">
<input type="hidden" name="modal" value="<?php echo (int)$zone_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($zone->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $zone_view->TableLeftColumnClass ?>"><span id="elh_zone_id"><?php echo $zone->id->caption() ?></span></td>
		<td data-name="id"<?php echo $zone->id->cellAttributes() ?>>
<span id="el_zone_id">
<span<?php echo $zone->id->viewAttributes() ?>>
<?php echo $zone->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($zone->zona->Visible) { // zona ?>
	<tr id="r_zona">
		<td class="<?php echo $zone_view->TableLeftColumnClass ?>"><span id="elh_zone_zona"><?php echo $zone->zona->caption() ?></span></td>
		<td data-name="zona"<?php echo $zone->zona->cellAttributes() ?>>
<span id="el_zone_zona">
<span<?php echo $zone->zona->viewAttributes() ?>>
<?php echo $zone->zona->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$zone_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$zone->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$zone_view->terminate();
?>