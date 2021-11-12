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
$categorie_delete = new categorie_delete();

// Run the page
$categorie_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorie_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcategoriedelete = currentForm = new ew.Form("fcategoriedelete", "delete");

// Form_CustomValidate event
fcategoriedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoriedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $categorie_delete->showPageHeader(); ?>
<?php
$categorie_delete->showMessage();
?>
<form name="fcategoriedelete" id="fcategoriedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorie_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorie_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorie">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($categorie_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($categorie->id->Visible) { // id ?>
		<th class="<?php echo $categorie->id->headerCellClass() ?>"><span id="elh_categorie_id" class="categorie_id"><?php echo $categorie->id->caption() ?></span></th>
<?php } ?>
<?php if ($categorie->categoria->Visible) { // categoria ?>
		<th class="<?php echo $categorie->categoria->headerCellClass() ?>"><span id="elh_categorie_categoria" class="categorie_categoria"><?php echo $categorie->categoria->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$categorie_delete->RecCnt = 0;
$i = 0;
while (!$categorie_delete->Recordset->EOF) {
	$categorie_delete->RecCnt++;
	$categorie_delete->RowCnt++;

	// Set row properties
	$categorie->resetAttributes();
	$categorie->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$categorie_delete->loadRowValues($categorie_delete->Recordset);

	// Render row
	$categorie_delete->renderRow();
?>
	<tr<?php echo $categorie->rowAttributes() ?>>
<?php if ($categorie->id->Visible) { // id ?>
		<td<?php echo $categorie->id->cellAttributes() ?>>
<span id="el<?php echo $categorie_delete->RowCnt ?>_categorie_id" class="categorie_id">
<span<?php echo $categorie->id->viewAttributes() ?>>
<?php echo $categorie->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($categorie->categoria->Visible) { // categoria ?>
		<td<?php echo $categorie->categoria->cellAttributes() ?>>
<span id="el<?php echo $categorie_delete->RowCnt ?>_categorie_categoria" class="categorie_categoria">
<span<?php echo $categorie->categoria->viewAttributes() ?>>
<?php echo $categorie->categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$categorie_delete->Recordset->moveNext();
}
$categorie_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categorie_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$categorie_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$categorie_delete->terminate();
?>