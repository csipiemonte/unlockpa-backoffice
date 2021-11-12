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
$zone_delete = new zone_delete();

// Run the page
$zone_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$zone_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fzonedelete = currentForm = new ew.Form("fzonedelete", "delete");

// Form_CustomValidate event
fzonedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fzonedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $zone_delete->showPageHeader(); ?>
<?php
$zone_delete->showMessage();
?>
<form name="fzonedelete" id="fzonedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($zone_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $zone_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="zone">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($zone_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($zone->id->Visible) { // id ?>
		<th class="<?php echo $zone->id->headerCellClass() ?>"><span id="elh_zone_id" class="zone_id"><?php echo $zone->id->caption() ?></span></th>
<?php } ?>
<?php if ($zone->zona->Visible) { // zona ?>
		<th class="<?php echo $zone->zona->headerCellClass() ?>"><span id="elh_zone_zona" class="zone_zona"><?php echo $zone->zona->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$zone_delete->RecCnt = 0;
$i = 0;
while (!$zone_delete->Recordset->EOF) {
	$zone_delete->RecCnt++;
	$zone_delete->RowCnt++;

	// Set row properties
	$zone->resetAttributes();
	$zone->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$zone_delete->loadRowValues($zone_delete->Recordset);

	// Render row
	$zone_delete->renderRow();
?>
	<tr<?php echo $zone->rowAttributes() ?>>
<?php if ($zone->id->Visible) { // id ?>
		<td<?php echo $zone->id->cellAttributes() ?>>
<span id="el<?php echo $zone_delete->RowCnt ?>_zone_id" class="zone_id">
<span<?php echo $zone->id->viewAttributes() ?>>
<?php echo $zone->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($zone->zona->Visible) { // zona ?>
		<td<?php echo $zone->zona->cellAttributes() ?>>
<span id="el<?php echo $zone_delete->RowCnt ?>_zone_zona" class="zone_zona">
<span<?php echo $zone->zona->viewAttributes() ?>>
<?php echo $zone->zona->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$zone_delete->Recordset->moveNext();
}
$zone_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $zone_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$zone_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$zone_delete->terminate();
?>