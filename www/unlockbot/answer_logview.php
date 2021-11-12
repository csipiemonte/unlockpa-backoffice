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
$answer_log_view = new answer_log_view();

// Run the page
$answer_log_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answer_log_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$answer_log->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fanswer_logview = currentForm = new ew.Form("fanswer_logview", "view");

// Form_CustomValidate event
fanswer_logview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fanswer_logview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$answer_log->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $answer_log_view->ExportOptions->render("body") ?>
<?php $answer_log_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $answer_log_view->showPageHeader(); ?>
<?php
$answer_log_view->showMessage();
?>
<form name="fanswer_logview" id="fanswer_logview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($answer_log_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $answer_log_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answer_log">
<input type="hidden" name="modal" value="<?php echo (int)$answer_log_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($answer_log->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $answer_log_view->TableLeftColumnClass ?>"><span id="elh_answer_log_id"><?php echo $answer_log->id->caption() ?></span></td>
		<td data-name="id"<?php echo $answer_log->id->cellAttributes() ?>>
<span id="el_answer_log_id">
<span<?php echo $answer_log->id->viewAttributes() ?>>
<?php echo $answer_log->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answer_log->ts_creation->Visible) { // ts_creation ?>
	<tr id="r_ts_creation">
		<td class="<?php echo $answer_log_view->TableLeftColumnClass ?>"><span id="elh_answer_log_ts_creation"><?php echo $answer_log->ts_creation->caption() ?></span></td>
		<td data-name="ts_creation"<?php echo $answer_log->ts_creation->cellAttributes() ?>>
<span id="el_answer_log_ts_creation">
<span<?php echo $answer_log->ts_creation->viewAttributes() ?>>
<?php echo $answer_log->ts_creation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answer_log->user_query->Visible) { // user_query ?>
	<tr id="r_user_query">
		<td class="<?php echo $answer_log_view->TableLeftColumnClass ?>"><span id="elh_answer_log_user_query"><?php echo $answer_log->user_query->caption() ?></span></td>
		<td data-name="user_query"<?php echo $answer_log->user_query->cellAttributes() ?>>
<span id="el_answer_log_user_query">
<span<?php echo $answer_log->user_query->viewAttributes() ?>>
<?php echo $answer_log->user_query->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answer_log->confidence->Visible) { // confidence ?>
	<tr id="r_confidence">
		<td class="<?php echo $answer_log_view->TableLeftColumnClass ?>"><span id="elh_answer_log_confidence"><?php echo $answer_log->confidence->caption() ?></span></td>
		<td data-name="confidence"<?php echo $answer_log->confidence->cellAttributes() ?>>
<span id="el_answer_log_confidence">
<span<?php echo $answer_log->confidence->viewAttributes() ?>>
<?php echo $answer_log->confidence->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answer_log->id_kb->Visible) { // id_kb ?>
	<tr id="r_id_kb">
		<td class="<?php echo $answer_log_view->TableLeftColumnClass ?>"><span id="elh_answer_log_id_kb"><?php echo $answer_log->id_kb->caption() ?></span></td>
		<td data-name="id_kb"<?php echo $answer_log->id_kb->cellAttributes() ?>>
<span id="el_answer_log_id_kb">
<span<?php echo $answer_log->id_kb->viewAttributes() ?>>
<?php echo $answer_log->id_kb->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($answer_log->id_bot_instance->Visible) { // id_bot_instance ?>
	<tr id="r_id_bot_instance">
		<td class="<?php echo $answer_log_view->TableLeftColumnClass ?>"><span id="elh_answer_log_id_bot_instance"><?php echo $answer_log->id_bot_instance->caption() ?></span></td>
		<td data-name="id_bot_instance"<?php echo $answer_log->id_bot_instance->cellAttributes() ?>>
<span id="el_answer_log_id_bot_instance">
<span<?php echo $answer_log->id_bot_instance->viewAttributes() ?>>
<?php echo $answer_log->id_bot_instance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$answer_log_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$answer_log->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$answer_log_view->terminate();
?>