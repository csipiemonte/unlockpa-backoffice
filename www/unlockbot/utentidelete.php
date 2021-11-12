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
$utenti_delete = new utenti_delete();

// Run the page
$utenti_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$utenti_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var futentidelete = currentForm = new ew.Form("futentidelete", "delete");

// Form_CustomValidate event
futentidelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
futentidelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
futentidelete.lists["x_status"] = <?php echo $utenti_delete->status->Lookup->toClientList() ?>;
futentidelete.lists["x_status"].options = <?php echo JsonEncode($utenti_delete->status->options(FALSE, TRUE)) ?>;
futentidelete.lists["x_userlevel"] = <?php echo $utenti_delete->userlevel->Lookup->toClientList() ?>;
futentidelete.lists["x_userlevel"].options = <?php echo JsonEncode($utenti_delete->userlevel->lookupOptions()) ?>;
futentidelete.lists["x_fk_comune"] = <?php echo $utenti_delete->fk_comune->Lookup->toClientList() ?>;
futentidelete.lists["x_fk_comune"].options = <?php echo JsonEncode($utenti_delete->fk_comune->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $utenti_delete->showPageHeader(); ?>
<?php
$utenti_delete->showMessage();
?>
<form name="futentidelete" id="futentidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($utenti_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $utenti_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="utenti">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($utenti_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($utenti->id->Visible) { // id ?>
		<th class="<?php echo $utenti->id->headerCellClass() ?>"><span id="elh_utenti_id" class="utenti_id"><?php echo $utenti->id->caption() ?></span></th>
<?php } ?>
<?php if ($utenti->name->Visible) { // name ?>
		<th class="<?php echo $utenti->name->headerCellClass() ?>"><span id="elh_utenti_name" class="utenti_name"><?php echo $utenti->name->caption() ?></span></th>
<?php } ?>
<?php if ($utenti->pass->Visible) { // pass ?>
		<th class="<?php echo $utenti->pass->headerCellClass() ?>"><span id="elh_utenti_pass" class="utenti_pass"><?php echo $utenti->pass->caption() ?></span></th>
<?php } ?>
<?php if ($utenti->mail->Visible) { // mail ?>
		<th class="<?php echo $utenti->mail->headerCellClass() ?>"><span id="elh_utenti_mail" class="utenti_mail"><?php echo $utenti->mail->caption() ?></span></th>
<?php } ?>
<?php if ($utenti->status->Visible) { // status ?>
		<th class="<?php echo $utenti->status->headerCellClass() ?>"><span id="elh_utenti_status" class="utenti_status"><?php echo $utenti->status->caption() ?></span></th>
<?php } ?>
<?php if ($utenti->userlevel->Visible) { // userlevel ?>
		<th class="<?php echo $utenti->userlevel->headerCellClass() ?>"><span id="elh_utenti_userlevel" class="utenti_userlevel"><?php echo $utenti->userlevel->caption() ?></span></th>
<?php } ?>
<?php if ($utenti->fk_comune->Visible) { // fk_comune ?>
		<th class="<?php echo $utenti->fk_comune->headerCellClass() ?>"><span id="elh_utenti_fk_comune" class="utenti_fk_comune"><?php echo $utenti->fk_comune->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$utenti_delete->RecCnt = 0;
$i = 0;
while (!$utenti_delete->Recordset->EOF) {
	$utenti_delete->RecCnt++;
	$utenti_delete->RowCnt++;

	// Set row properties
	$utenti->resetAttributes();
	$utenti->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$utenti_delete->loadRowValues($utenti_delete->Recordset);

	// Render row
	$utenti_delete->renderRow();
?>
	<tr<?php echo $utenti->rowAttributes() ?>>
<?php if ($utenti->id->Visible) { // id ?>
		<td<?php echo $utenti->id->cellAttributes() ?>>
<span id="el<?php echo $utenti_delete->RowCnt ?>_utenti_id" class="utenti_id">
<span<?php echo $utenti->id->viewAttributes() ?>>
<?php echo $utenti->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($utenti->name->Visible) { // name ?>
		<td<?php echo $utenti->name->cellAttributes() ?>>
<span id="el<?php echo $utenti_delete->RowCnt ?>_utenti_name" class="utenti_name">
<span<?php echo $utenti->name->viewAttributes() ?>>
<?php echo $utenti->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($utenti->pass->Visible) { // pass ?>
		<td<?php echo $utenti->pass->cellAttributes() ?>>
<span id="el<?php echo $utenti_delete->RowCnt ?>_utenti_pass" class="utenti_pass">
<span<?php echo $utenti->pass->viewAttributes() ?>>
<?php echo $utenti->pass->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($utenti->mail->Visible) { // mail ?>
		<td<?php echo $utenti->mail->cellAttributes() ?>>
<span id="el<?php echo $utenti_delete->RowCnt ?>_utenti_mail" class="utenti_mail">
<span<?php echo $utenti->mail->viewAttributes() ?>>
<?php echo $utenti->mail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($utenti->status->Visible) { // status ?>
		<td<?php echo $utenti->status->cellAttributes() ?>>
<span id="el<?php echo $utenti_delete->RowCnt ?>_utenti_status" class="utenti_status">
<span<?php echo $utenti->status->viewAttributes() ?>>
<?php echo $utenti->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($utenti->userlevel->Visible) { // userlevel ?>
		<td<?php echo $utenti->userlevel->cellAttributes() ?>>
<span id="el<?php echo $utenti_delete->RowCnt ?>_utenti_userlevel" class="utenti_userlevel">
<span<?php echo $utenti->userlevel->viewAttributes() ?>>
<?php echo $utenti->userlevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($utenti->fk_comune->Visible) { // fk_comune ?>
		<td<?php echo $utenti->fk_comune->cellAttributes() ?>>
<span id="el<?php echo $utenti_delete->RowCnt ?>_utenti_fk_comune" class="utenti_fk_comune">
<span<?php echo $utenti->fk_comune->viewAttributes() ?>>
<?php echo $utenti->fk_comune->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$utenti_delete->Recordset->moveNext();
}
$utenti_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $utenti_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$utenti_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$utenti_delete->terminate();
?>