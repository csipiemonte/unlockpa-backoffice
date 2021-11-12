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
$answer_log_delete = new answer_log_delete();

// Run the page
$answer_log_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answer_log_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fanswer_logdelete = currentForm = new ew.Form("fanswer_logdelete", "delete");

// Form_CustomValidate event
fanswer_logdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fanswer_logdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $answer_log_delete->showPageHeader(); ?>
<?php
$answer_log_delete->showMessage();
?>
<form name="fanswer_logdelete" id="fanswer_logdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($answer_log_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $answer_log_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answer_log">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($answer_log_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($answer_log->id->Visible) { // id ?>
		<th class="<?php echo $answer_log->id->headerCellClass() ?>"><span id="elh_answer_log_id" class="answer_log_id"><?php echo $answer_log->id->caption() ?></span></th>
<?php } ?>
<?php if ($answer_log->ts_creation->Visible) { // ts_creation ?>
		<th class="<?php echo $answer_log->ts_creation->headerCellClass() ?>"><span id="elh_answer_log_ts_creation" class="answer_log_ts_creation"><?php echo $answer_log->ts_creation->caption() ?></span></th>
<?php } ?>
<?php if ($answer_log->confidence->Visible) { // confidence ?>
		<th class="<?php echo $answer_log->confidence->headerCellClass() ?>"><span id="elh_answer_log_confidence" class="answer_log_confidence"><?php echo $answer_log->confidence->caption() ?></span></th>
<?php } ?>
<?php if ($answer_log->id_kb->Visible) { // id_kb ?>
		<th class="<?php echo $answer_log->id_kb->headerCellClass() ?>"><span id="elh_answer_log_id_kb" class="answer_log_id_kb"><?php echo $answer_log->id_kb->caption() ?></span></th>
<?php } ?>
<?php if ($answer_log->id_bot_instance->Visible) { // id_bot_instance ?>
		<th class="<?php echo $answer_log->id_bot_instance->headerCellClass() ?>"><span id="elh_answer_log_id_bot_instance" class="answer_log_id_bot_instance"><?php echo $answer_log->id_bot_instance->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$answer_log_delete->RecCnt = 0;
$i = 0;
while (!$answer_log_delete->Recordset->EOF) {
	$answer_log_delete->RecCnt++;
	$answer_log_delete->RowCnt++;

	// Set row properties
	$answer_log->resetAttributes();
	$answer_log->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$answer_log_delete->loadRowValues($answer_log_delete->Recordset);

	// Render row
	$answer_log_delete->renderRow();
?>
	<tr<?php echo $answer_log->rowAttributes() ?>>
<?php if ($answer_log->id->Visible) { // id ?>
		<td<?php echo $answer_log->id->cellAttributes() ?>>
<span id="el<?php echo $answer_log_delete->RowCnt ?>_answer_log_id" class="answer_log_id">
<span<?php echo $answer_log->id->viewAttributes() ?>>
<?php echo $answer_log->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answer_log->ts_creation->Visible) { // ts_creation ?>
		<td<?php echo $answer_log->ts_creation->cellAttributes() ?>>
<span id="el<?php echo $answer_log_delete->RowCnt ?>_answer_log_ts_creation" class="answer_log_ts_creation">
<span<?php echo $answer_log->ts_creation->viewAttributes() ?>>
<?php echo $answer_log->ts_creation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answer_log->confidence->Visible) { // confidence ?>
		<td<?php echo $answer_log->confidence->cellAttributes() ?>>
<span id="el<?php echo $answer_log_delete->RowCnt ?>_answer_log_confidence" class="answer_log_confidence">
<span<?php echo $answer_log->confidence->viewAttributes() ?>>
<?php echo $answer_log->confidence->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answer_log->id_kb->Visible) { // id_kb ?>
		<td<?php echo $answer_log->id_kb->cellAttributes() ?>>
<span id="el<?php echo $answer_log_delete->RowCnt ?>_answer_log_id_kb" class="answer_log_id_kb">
<span<?php echo $answer_log->id_kb->viewAttributes() ?>>
<?php echo $answer_log->id_kb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($answer_log->id_bot_instance->Visible) { // id_bot_instance ?>
		<td<?php echo $answer_log->id_bot_instance->cellAttributes() ?>>
<span id="el<?php echo $answer_log_delete->RowCnt ?>_answer_log_id_bot_instance" class="answer_log_id_bot_instance">
<span<?php echo $answer_log->id_bot_instance->viewAttributes() ?>>
<?php echo $answer_log->id_bot_instance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$answer_log_delete->Recordset->moveNext();
}
$answer_log_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $answer_log_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$answer_log_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$answer_log_delete->terminate();
?>