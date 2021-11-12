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
$risposte_zona_delete = new risposte_zona_delete();

// Run the page
$risposte_zona_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$risposte_zona_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var frisposte_zonadelete = currentForm = new ew.Form("frisposte_zonadelete", "delete");

// Form_CustomValidate event
frisposte_zonadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frisposte_zonadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $risposte_zona_delete->showPageHeader(); ?>
<?php
$risposte_zona_delete->showMessage();
?>
<form name="frisposte_zonadelete" id="frisposte_zonadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($risposte_zona_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $risposte_zona_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="risposte_zona">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($risposte_zona_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($risposte_zona->id_domanda->Visible) { // id_domanda ?>
		<th class="<?php echo $risposte_zona->id_domanda->headerCellClass() ?>"><span id="elh_risposte_zona_id_domanda" class="risposte_zona_id_domanda"><?php echo $risposte_zona->id_domanda->caption() ?></span></th>
<?php } ?>
<?php if ($risposte_zona->id_zona->Visible) { // id_zona ?>
		<th class="<?php echo $risposte_zona->id_zona->headerCellClass() ?>"><span id="elh_risposte_zona_id_zona" class="risposte_zona_id_zona"><?php echo $risposte_zona->id_zona->caption() ?></span></th>
<?php } ?>
<?php if ($risposte_zona->risposta_default->Visible) { // risposta_default ?>
		<th class="<?php echo $risposte_zona->risposta_default->headerCellClass() ?>"><span id="elh_risposte_zona_risposta_default" class="risposte_zona_risposta_default"><?php echo $risposte_zona->risposta_default->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$risposte_zona_delete->RecCnt = 0;
$i = 0;
while (!$risposte_zona_delete->Recordset->EOF) {
	$risposte_zona_delete->RecCnt++;
	$risposte_zona_delete->RowCnt++;

	// Set row properties
	$risposte_zona->resetAttributes();
	$risposte_zona->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$risposte_zona_delete->loadRowValues($risposte_zona_delete->Recordset);

	// Render row
	$risposte_zona_delete->renderRow();
?>
	<tr<?php echo $risposte_zona->rowAttributes() ?>>
<?php if ($risposte_zona->id_domanda->Visible) { // id_domanda ?>
		<td<?php echo $risposte_zona->id_domanda->cellAttributes() ?>>
<span id="el<?php echo $risposte_zona_delete->RowCnt ?>_risposte_zona_id_domanda" class="risposte_zona_id_domanda">
<span<?php echo $risposte_zona->id_domanda->viewAttributes() ?>>
<?php echo $risposte_zona->id_domanda->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($risposte_zona->id_zona->Visible) { // id_zona ?>
		<td<?php echo $risposte_zona->id_zona->cellAttributes() ?>>
<span id="el<?php echo $risposte_zona_delete->RowCnt ?>_risposte_zona_id_zona" class="risposte_zona_id_zona">
<span<?php echo $risposte_zona->id_zona->viewAttributes() ?>>
<?php echo $risposte_zona->id_zona->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($risposte_zona->risposta_default->Visible) { // risposta_default ?>
		<td<?php echo $risposte_zona->risposta_default->cellAttributes() ?>>
<span id="el<?php echo $risposte_zona_delete->RowCnt ?>_risposte_zona_risposta_default" class="risposte_zona_risposta_default">
<span<?php echo $risposte_zona->risposta_default->viewAttributes() ?>>
<?php echo $risposte_zona->risposta_default->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$risposte_zona_delete->Recordset->moveNext();
}
$risposte_zona_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $risposte_zona_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$risposte_zona_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$risposte_zona_delete->terminate();
?>