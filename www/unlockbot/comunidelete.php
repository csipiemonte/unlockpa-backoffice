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
$comuni_delete = new comuni_delete();

// Run the page
$comuni_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comuni_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcomunidelete = currentForm = new ew.Form("fcomunidelete", "delete");

// Form_CustomValidate event
fcomunidelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcomunidelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcomunidelete.lists["x_fk_zona"] = <?php echo $comuni_delete->fk_zona->Lookup->toClientList() ?>;
fcomunidelete.lists["x_fk_zona"].options = <?php echo JsonEncode($comuni_delete->fk_zona->lookupOptions()) ?>;
fcomunidelete.lists["x_vide[]"] = <?php echo $comuni_delete->vide->Lookup->toClientList() ?>;
fcomunidelete.lists["x_vide[]"].options = <?php echo JsonEncode($comuni_delete->vide->options(FALSE, TRUE)) ?>;
fcomunidelete.lists["x_botattivo[]"] = <?php echo $comuni_delete->botattivo->Lookup->toClientList() ?>;
fcomunidelete.lists["x_botattivo[]"].options = <?php echo JsonEncode($comuni_delete->botattivo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $comuni_delete->showPageHeader(); ?>
<?php
$comuni_delete->showMessage();
?>
<form name="fcomunidelete" id="fcomunidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comuni_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comuni_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comuni">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($comuni_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($comuni->id->Visible) { // id ?>
		<th class="<?php echo $comuni->id->headerCellClass() ?>"><span id="elh_comuni_id" class="comuni_id"><?php echo $comuni->id->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->toponimo->Visible) { // toponimo ?>
		<th class="<?php echo $comuni->toponimo->headerCellClass() ?>"><span id="elh_comuni_toponimo" class="comuni_toponimo"><?php echo $comuni->toponimo->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->indirizzo->Visible) { // indirizzo ?>
		<th class="<?php echo $comuni->indirizzo->headerCellClass() ?>"><span id="elh_comuni_indirizzo" class="comuni_indirizzo"><?php echo $comuni->indirizzo->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->provincia->Visible) { // provincia ?>
		<th class="<?php echo $comuni->provincia->headerCellClass() ?>"><span id="elh_comuni_provincia" class="comuni_provincia"><?php echo $comuni->provincia->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->avviso->Visible) { // avviso ?>
		<th class="<?php echo $comuni->avviso->headerCellClass() ?>"><span id="elh_comuni_avviso" class="comuni_avviso"><?php echo $comuni->avviso->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->fk_zona->Visible) { // fk_zona ?>
		<th class="<?php echo $comuni->fk_zona->headerCellClass() ?>"><span id="elh_comuni_fk_zona" class="comuni_fk_zona"><?php echo $comuni->fk_zona->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->no_response->Visible) { // no_response ?>
		<th class="<?php echo $comuni->no_response->headerCellClass() ?>"><span id="elh_comuni_no_response" class="comuni_no_response"><?php echo $comuni->no_response->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->dominio->Visible) { // dominio ?>
		<th class="<?php echo $comuni->dominio->headerCellClass() ?>"><span id="elh_comuni_dominio" class="comuni_dominio"><?php echo $comuni->dominio->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->vide->Visible) { // vide ?>
		<th class="<?php echo $comuni->vide->headerCellClass() ?>"><span id="elh_comuni_vide" class="comuni_vide"><?php echo $comuni->vide->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->botattivo->Visible) { // botattivo ?>
		<th class="<?php echo $comuni->botattivo->headerCellClass() ?>"><span id="elh_comuni_botattivo" class="comuni_botattivo"><?php echo $comuni->botattivo->caption() ?></span></th>
<?php } ?>
<?php if ($comuni->vide_url->Visible) { // vide_url ?>
		<th class="<?php echo $comuni->vide_url->headerCellClass() ?>"><span id="elh_comuni_vide_url" class="comuni_vide_url"><?php echo $comuni->vide_url->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$comuni_delete->RecCnt = 0;
$i = 0;
while (!$comuni_delete->Recordset->EOF) {
	$comuni_delete->RecCnt++;
	$comuni_delete->RowCnt++;

	// Set row properties
	$comuni->resetAttributes();
	$comuni->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$comuni_delete->loadRowValues($comuni_delete->Recordset);

	// Render row
	$comuni_delete->renderRow();
?>
	<tr<?php echo $comuni->rowAttributes() ?>>
<?php if ($comuni->id->Visible) { // id ?>
		<td<?php echo $comuni->id->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_id" class="comuni_id">
<span<?php echo $comuni->id->viewAttributes() ?>>
<?php echo $comuni->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->toponimo->Visible) { // toponimo ?>
		<td<?php echo $comuni->toponimo->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_toponimo" class="comuni_toponimo">
<span<?php echo $comuni->toponimo->viewAttributes() ?>>
<?php echo $comuni->toponimo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->indirizzo->Visible) { // indirizzo ?>
		<td<?php echo $comuni->indirizzo->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_indirizzo" class="comuni_indirizzo">
<span<?php echo $comuni->indirizzo->viewAttributes() ?>>
<?php echo $comuni->indirizzo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->provincia->Visible) { // provincia ?>
		<td<?php echo $comuni->provincia->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_provincia" class="comuni_provincia">
<span<?php echo $comuni->provincia->viewAttributes() ?>>
<?php echo $comuni->provincia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->avviso->Visible) { // avviso ?>
		<td<?php echo $comuni->avviso->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_avviso" class="comuni_avviso">
<span<?php echo $comuni->avviso->viewAttributes() ?>>
<?php echo $comuni->avviso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->fk_zona->Visible) { // fk_zona ?>
		<td<?php echo $comuni->fk_zona->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_fk_zona" class="comuni_fk_zona">
<span<?php echo $comuni->fk_zona->viewAttributes() ?>>
<?php echo $comuni->fk_zona->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->no_response->Visible) { // no_response ?>
		<td<?php echo $comuni->no_response->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_no_response" class="comuni_no_response">
<span<?php echo $comuni->no_response->viewAttributes() ?>>
<?php echo $comuni->no_response->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->dominio->Visible) { // dominio ?>
		<td<?php echo $comuni->dominio->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_dominio" class="comuni_dominio">
<span<?php echo $comuni->dominio->viewAttributes() ?>>
<?php echo $comuni->dominio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comuni->vide->Visible) { // vide ?>
		<td<?php echo $comuni->vide->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_vide" class="comuni_vide">
<span<?php echo $comuni->vide->viewAttributes() ?>>
<?php if (ConvertToBool($comuni->vide->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $comuni->vide->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $comuni->vide->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($comuni->botattivo->Visible) { // botattivo ?>
		<td<?php echo $comuni->botattivo->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_botattivo" class="comuni_botattivo">
<span<?php echo $comuni->botattivo->viewAttributes() ?>>
<?php if (ConvertToBool($comuni->botattivo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $comuni->botattivo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $comuni->botattivo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($comuni->vide_url->Visible) { // vide_url ?>
		<td<?php echo $comuni->vide_url->cellAttributes() ?>>
<span id="el<?php echo $comuni_delete->RowCnt ?>_comuni_vide_url" class="comuni_vide_url">
<span<?php echo $comuni->vide_url->viewAttributes() ?>>
<?php echo $comuni->vide_url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$comuni_delete->Recordset->moveNext();
}
$comuni_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $comuni_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$comuni_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$comuni_delete->terminate();
?>