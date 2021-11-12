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
$domande_delete = new domande_delete();

// Run the page
$domande_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$domande_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fdomandedelete = currentForm = new ew.Form("fdomandedelete", "delete");

// Form_CustomValidate event
fdomandedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdomandedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdomandedelete.lists["x_fk_categoria"] = <?php echo $domande_delete->fk_categoria->Lookup->toClientList() ?>;
fdomandedelete.lists["x_fk_categoria"].options = <?php echo JsonEncode($domande_delete->fk_categoria->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $domande_delete->showPageHeader(); ?>
<?php
$domande_delete->showMessage();
?>
<form name="fdomandedelete" id="fdomandedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($domande_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $domande_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="domande">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($domande_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($domande->id->Visible) { // id ?>
		<th class="<?php echo $domande->id->headerCellClass() ?>"><span id="elh_domande_id" class="domande_id"><?php echo $domande->id->caption() ?></span></th>
<?php } ?>
<?php if ($domande->domanda->Visible) { // domanda ?>
		<th class="<?php echo $domande->domanda->headerCellClass() ?>"><span id="elh_domande_domanda" class="domande_domanda"><?php echo $domande->domanda->caption() ?></span></th>
<?php } ?>
<?php if ($domande->risposta_default->Visible) { // risposta_default ?>
		<th class="<?php echo $domande->risposta_default->headerCellClass() ?>"><span id="elh_domande_risposta_default" class="domande_risposta_default"><?php echo $domande->risposta_default->caption() ?></span></th>
<?php } ?>
<?php if ($domande->fk_categoria->Visible) { // fk_categoria ?>
		<th class="<?php echo $domande->fk_categoria->headerCellClass() ?>"><span id="elh_domande_fk_categoria" class="domande_fk_categoria"><?php echo $domande->fk_categoria->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$domande_delete->RecCnt = 0;
$i = 0;
while (!$domande_delete->Recordset->EOF) {
	$domande_delete->RecCnt++;
	$domande_delete->RowCnt++;

	// Set row properties
	$domande->resetAttributes();
	$domande->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$domande_delete->loadRowValues($domande_delete->Recordset);

	// Render row
	$domande_delete->renderRow();
?>
	<tr<?php echo $domande->rowAttributes() ?>>
<?php if ($domande->id->Visible) { // id ?>
		<td<?php echo $domande->id->cellAttributes() ?>>
<span id="el<?php echo $domande_delete->RowCnt ?>_domande_id" class="domande_id">
<span<?php echo $domande->id->viewAttributes() ?>>
<?php echo $domande->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($domande->domanda->Visible) { // domanda ?>
		<td<?php echo $domande->domanda->cellAttributes() ?>>
<span id="el<?php echo $domande_delete->RowCnt ?>_domande_domanda" class="domande_domanda">
<span<?php echo $domande->domanda->viewAttributes() ?>>
<?php echo $domande->domanda->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($domande->risposta_default->Visible) { // risposta_default ?>
		<td<?php echo $domande->risposta_default->cellAttributes() ?>>
<span id="el<?php echo $domande_delete->RowCnt ?>_domande_risposta_default" class="domande_risposta_default">
<span<?php echo $domande->risposta_default->viewAttributes() ?>>
<?php echo $domande->risposta_default->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($domande->fk_categoria->Visible) { // fk_categoria ?>
		<td<?php echo $domande->fk_categoria->cellAttributes() ?>>
<span id="el<?php echo $domande_delete->RowCnt ?>_domande_fk_categoria" class="domande_fk_categoria">
<span<?php echo $domande->fk_categoria->viewAttributes() ?>>
<?php echo $domande->fk_categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$domande_delete->Recordset->moveNext();
}
$domande_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $domande_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$domande_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$domande_delete->terminate();
?>