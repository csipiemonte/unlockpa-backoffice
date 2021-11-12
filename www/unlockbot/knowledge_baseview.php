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
$knowledge_base_view = new knowledge_base_view();

// Run the page
$knowledge_base_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$knowledge_base_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$knowledge_base->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fknowledge_baseview = currentForm = new ew.Form("fknowledge_baseview", "view");

// Form_CustomValidate event
fknowledge_baseview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fknowledge_baseview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$knowledge_base->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $knowledge_base_view->ExportOptions->render("body") ?>
<?php $knowledge_base_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $knowledge_base_view->showPageHeader(); ?>
<?php
$knowledge_base_view->showMessage();
?>
<form name="fknowledge_baseview" id="fknowledge_baseview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($knowledge_base_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $knowledge_base_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="knowledge_base">
<input type="hidden" name="modal" value="<?php echo (int)$knowledge_base_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($knowledge_base->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_id"><?php echo $knowledge_base->id->caption() ?></span></td>
		<td data-name="id"<?php echo $knowledge_base->id->cellAttributes() ?>>
<span id="el_knowledge_base_id">
<span<?php echo $knowledge_base->id->viewAttributes() ?>>
<?php echo $knowledge_base->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($knowledge_base->ts_creation->Visible) { // ts_creation ?>
	<tr id="r_ts_creation">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_ts_creation"><?php echo $knowledge_base->ts_creation->caption() ?></span></td>
		<td data-name="ts_creation"<?php echo $knowledge_base->ts_creation->cellAttributes() ?>>
<span id="el_knowledge_base_ts_creation">
<span<?php echo $knowledge_base->ts_creation->viewAttributes() ?>>
<?php echo $knowledge_base->ts_creation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($knowledge_base->question_type->Visible) { // question_type ?>
	<tr id="r_question_type">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_question_type"><?php echo $knowledge_base->question_type->caption() ?></span></td>
		<td data-name="question_type"<?php echo $knowledge_base->question_type->cellAttributes() ?>>
<span id="el_knowledge_base_question_type">
<span<?php echo $knowledge_base->question_type->viewAttributes() ?>>
<?php echo $knowledge_base->question_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($knowledge_base->question_number->Visible) { // question_number ?>
	<tr id="r_question_number">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_question_number"><?php echo $knowledge_base->question_number->caption() ?></span></td>
		<td data-name="question_number"<?php echo $knowledge_base->question_number->cellAttributes() ?>>
<span id="el_knowledge_base_question_number">
<span<?php echo $knowledge_base->question_number->viewAttributes() ?>>
<?php echo $knowledge_base->question_number->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($knowledge_base->question->Visible) { // question ?>
	<tr id="r_question">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_question"><?php echo $knowledge_base->question->caption() ?></span></td>
		<td data-name="question"<?php echo $knowledge_base->question->cellAttributes() ?>>
<span id="el_knowledge_base_question">
<span<?php echo $knowledge_base->question->viewAttributes() ?>>
<?php echo $knowledge_base->question->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($knowledge_base->answer->Visible) { // answer ?>
	<tr id="r_answer">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_answer"><?php echo $knowledge_base->answer->caption() ?></span></td>
		<td data-name="answer"<?php echo $knowledge_base->answer->cellAttributes() ?>>
<span id="el_knowledge_base_answer">
<span<?php echo $knowledge_base->answer->viewAttributes() ?>>
<?php echo $knowledge_base->answer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($knowledge_base->note->Visible) { // note ?>
	<tr id="r_note">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_note"><?php echo $knowledge_base->note->caption() ?></span></td>
		<td data-name="note"<?php echo $knowledge_base->note->cellAttributes() ?>>
<span id="el_knowledge_base_note">
<span<?php echo $knowledge_base->note->viewAttributes() ?>>
<?php echo $knowledge_base->note->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($knowledge_base->id_bot->Visible) { // id_bot ?>
	<tr id="r_id_bot">
		<td class="<?php echo $knowledge_base_view->TableLeftColumnClass ?>"><span id="elh_knowledge_base_id_bot"><?php echo $knowledge_base->id_bot->caption() ?></span></td>
		<td data-name="id_bot"<?php echo $knowledge_base->id_bot->cellAttributes() ?>>
<span id="el_knowledge_base_id_bot">
<span<?php echo $knowledge_base->id_bot->viewAttributes() ?>>
<?php echo $knowledge_base->id_bot->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$knowledge_base_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$knowledge_base->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$knowledge_base_view->terminate();
?>