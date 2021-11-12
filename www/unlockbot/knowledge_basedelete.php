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
$knowledge_base_delete = new knowledge_base_delete();

// Run the page
$knowledge_base_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$knowledge_base_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fknowledge_basedelete = currentForm = new ew.Form("fknowledge_basedelete", "delete");

// Form_CustomValidate event
fknowledge_basedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fknowledge_basedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $knowledge_base_delete->showPageHeader(); ?>
<?php
$knowledge_base_delete->showMessage();
?>
<form name="fknowledge_basedelete" id="fknowledge_basedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($knowledge_base_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $knowledge_base_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="knowledge_base">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($knowledge_base_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($knowledge_base->id->Visible) { // id ?>
		<th class="<?php echo $knowledge_base->id->headerCellClass() ?>"><span id="elh_knowledge_base_id" class="knowledge_base_id"><?php echo $knowledge_base->id->caption() ?></span></th>
<?php } ?>
<?php if ($knowledge_base->ts_creation->Visible) { // ts_creation ?>
		<th class="<?php echo $knowledge_base->ts_creation->headerCellClass() ?>"><span id="elh_knowledge_base_ts_creation" class="knowledge_base_ts_creation"><?php echo $knowledge_base->ts_creation->caption() ?></span></th>
<?php } ?>
<?php if ($knowledge_base->question_type->Visible) { // question_type ?>
		<th class="<?php echo $knowledge_base->question_type->headerCellClass() ?>"><span id="elh_knowledge_base_question_type" class="knowledge_base_question_type"><?php echo $knowledge_base->question_type->caption() ?></span></th>
<?php } ?>
<?php if ($knowledge_base->question_number->Visible) { // question_number ?>
		<th class="<?php echo $knowledge_base->question_number->headerCellClass() ?>"><span id="elh_knowledge_base_question_number" class="knowledge_base_question_number"><?php echo $knowledge_base->question_number->caption() ?></span></th>
<?php } ?>
<?php if ($knowledge_base->id_bot->Visible) { // id_bot ?>
		<th class="<?php echo $knowledge_base->id_bot->headerCellClass() ?>"><span id="elh_knowledge_base_id_bot" class="knowledge_base_id_bot"><?php echo $knowledge_base->id_bot->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$knowledge_base_delete->RecCnt = 0;
$i = 0;
while (!$knowledge_base_delete->Recordset->EOF) {
	$knowledge_base_delete->RecCnt++;
	$knowledge_base_delete->RowCnt++;

	// Set row properties
	$knowledge_base->resetAttributes();
	$knowledge_base->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$knowledge_base_delete->loadRowValues($knowledge_base_delete->Recordset);

	// Render row
	$knowledge_base_delete->renderRow();
?>
	<tr<?php echo $knowledge_base->rowAttributes() ?>>
<?php if ($knowledge_base->id->Visible) { // id ?>
		<td<?php echo $knowledge_base->id->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_delete->RowCnt ?>_knowledge_base_id" class="knowledge_base_id">
<span<?php echo $knowledge_base->id->viewAttributes() ?>>
<?php echo $knowledge_base->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($knowledge_base->ts_creation->Visible) { // ts_creation ?>
		<td<?php echo $knowledge_base->ts_creation->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_delete->RowCnt ?>_knowledge_base_ts_creation" class="knowledge_base_ts_creation">
<span<?php echo $knowledge_base->ts_creation->viewAttributes() ?>>
<?php echo $knowledge_base->ts_creation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($knowledge_base->question_type->Visible) { // question_type ?>
		<td<?php echo $knowledge_base->question_type->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_delete->RowCnt ?>_knowledge_base_question_type" class="knowledge_base_question_type">
<span<?php echo $knowledge_base->question_type->viewAttributes() ?>>
<?php echo $knowledge_base->question_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($knowledge_base->question_number->Visible) { // question_number ?>
		<td<?php echo $knowledge_base->question_number->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_delete->RowCnt ?>_knowledge_base_question_number" class="knowledge_base_question_number">
<span<?php echo $knowledge_base->question_number->viewAttributes() ?>>
<?php echo $knowledge_base->question_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($knowledge_base->id_bot->Visible) { // id_bot ?>
		<td<?php echo $knowledge_base->id_bot->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_delete->RowCnt ?>_knowledge_base_id_bot" class="knowledge_base_id_bot">
<span<?php echo $knowledge_base->id_bot->viewAttributes() ?>>
<?php echo $knowledge_base->id_bot->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$knowledge_base_delete->Recordset->moveNext();
}
$knowledge_base_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $knowledge_base_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$knowledge_base_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$knowledge_base_delete->terminate();
?>