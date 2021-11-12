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
$answer_log_add = new answer_log_add();

// Run the page
$answer_log_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answer_log_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fanswer_logadd = currentForm = new ew.Form("fanswer_logadd", "add");

// Validate form
fanswer_logadd.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($answer_log_add->ts_creation->Required) { ?>
			elm = this.getElements("x" + infix + "_ts_creation");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answer_log->ts_creation->caption(), $answer_log->ts_creation->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ts_creation");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($answer_log->ts_creation->errorMessage()) ?>");
		<?php if ($answer_log_add->user_query->Required) { ?>
			elm = this.getElements("x" + infix + "_user_query");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answer_log->user_query->caption(), $answer_log->user_query->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($answer_log_add->confidence->Required) { ?>
			elm = this.getElements("x" + infix + "_confidence");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answer_log->confidence->caption(), $answer_log->confidence->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_confidence");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($answer_log->confidence->errorMessage()) ?>");
		<?php if ($answer_log_add->id_kb->Required) { ?>
			elm = this.getElements("x" + infix + "_id_kb");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answer_log->id_kb->caption(), $answer_log->id_kb->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_kb");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($answer_log->id_kb->errorMessage()) ?>");
		<?php if ($answer_log_add->id_bot_instance->Required) { ?>
			elm = this.getElements("x" + infix + "_id_bot_instance");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $answer_log->id_bot_instance->caption(), $answer_log->id_bot_instance->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_bot_instance");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($answer_log->id_bot_instance->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fanswer_logadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fanswer_logadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $answer_log_add->showPageHeader(); ?>
<?php
$answer_log_add->showMessage();
?>
<form name="fanswer_logadd" id="fanswer_logadd" class="<?php echo $answer_log_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($answer_log_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $answer_log_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answer_log">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$answer_log_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($answer_log->ts_creation->Visible) { // ts_creation ?>
	<div id="r_ts_creation" class="form-group row">
		<label id="elh_answer_log_ts_creation" for="x_ts_creation" class="<?php echo $answer_log_add->LeftColumnClass ?>"><?php echo $answer_log->ts_creation->caption() ?><?php echo ($answer_log->ts_creation->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answer_log_add->RightColumnClass ?>"><div<?php echo $answer_log->ts_creation->cellAttributes() ?>>
<span id="el_answer_log_ts_creation">
<input type="text" data-table="answer_log" data-field="x_ts_creation" name="x_ts_creation" id="x_ts_creation" placeholder="<?php echo HtmlEncode($answer_log->ts_creation->getPlaceHolder()) ?>" value="<?php echo $answer_log->ts_creation->EditValue ?>"<?php echo $answer_log->ts_creation->editAttributes() ?>>
</span>
<?php echo $answer_log->ts_creation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answer_log->user_query->Visible) { // user_query ?>
	<div id="r_user_query" class="form-group row">
		<label id="elh_answer_log_user_query" for="x_user_query" class="<?php echo $answer_log_add->LeftColumnClass ?>"><?php echo $answer_log->user_query->caption() ?><?php echo ($answer_log->user_query->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answer_log_add->RightColumnClass ?>"><div<?php echo $answer_log->user_query->cellAttributes() ?>>
<span id="el_answer_log_user_query">
<textarea data-table="answer_log" data-field="x_user_query" name="x_user_query" id="x_user_query" cols="35" rows="4" placeholder="<?php echo HtmlEncode($answer_log->user_query->getPlaceHolder()) ?>"<?php echo $answer_log->user_query->editAttributes() ?>><?php echo $answer_log->user_query->EditValue ?></textarea>
</span>
<?php echo $answer_log->user_query->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answer_log->confidence->Visible) { // confidence ?>
	<div id="r_confidence" class="form-group row">
		<label id="elh_answer_log_confidence" for="x_confidence" class="<?php echo $answer_log_add->LeftColumnClass ?>"><?php echo $answer_log->confidence->caption() ?><?php echo ($answer_log->confidence->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answer_log_add->RightColumnClass ?>"><div<?php echo $answer_log->confidence->cellAttributes() ?>>
<span id="el_answer_log_confidence">
<input type="text" data-table="answer_log" data-field="x_confidence" name="x_confidence" id="x_confidence" size="30" placeholder="<?php echo HtmlEncode($answer_log->confidence->getPlaceHolder()) ?>" value="<?php echo $answer_log->confidence->EditValue ?>"<?php echo $answer_log->confidence->editAttributes() ?>>
</span>
<?php echo $answer_log->confidence->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answer_log->id_kb->Visible) { // id_kb ?>
	<div id="r_id_kb" class="form-group row">
		<label id="elh_answer_log_id_kb" for="x_id_kb" class="<?php echo $answer_log_add->LeftColumnClass ?>"><?php echo $answer_log->id_kb->caption() ?><?php echo ($answer_log->id_kb->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answer_log_add->RightColumnClass ?>"><div<?php echo $answer_log->id_kb->cellAttributes() ?>>
<span id="el_answer_log_id_kb">
<input type="text" data-table="answer_log" data-field="x_id_kb" name="x_id_kb" id="x_id_kb" size="30" placeholder="<?php echo HtmlEncode($answer_log->id_kb->getPlaceHolder()) ?>" value="<?php echo $answer_log->id_kb->EditValue ?>"<?php echo $answer_log->id_kb->editAttributes() ?>>
</span>
<?php echo $answer_log->id_kb->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($answer_log->id_bot_instance->Visible) { // id_bot_instance ?>
	<div id="r_id_bot_instance" class="form-group row">
		<label id="elh_answer_log_id_bot_instance" for="x_id_bot_instance" class="<?php echo $answer_log_add->LeftColumnClass ?>"><?php echo $answer_log->id_bot_instance->caption() ?><?php echo ($answer_log->id_bot_instance->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $answer_log_add->RightColumnClass ?>"><div<?php echo $answer_log->id_bot_instance->cellAttributes() ?>>
<span id="el_answer_log_id_bot_instance">
<input type="text" data-table="answer_log" data-field="x_id_bot_instance" name="x_id_bot_instance" id="x_id_bot_instance" size="30" placeholder="<?php echo HtmlEncode($answer_log->id_bot_instance->getPlaceHolder()) ?>" value="<?php echo $answer_log->id_bot_instance->EditValue ?>"<?php echo $answer_log->id_bot_instance->editAttributes() ?>>
</span>
<?php echo $answer_log->id_bot_instance->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$answer_log_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $answer_log_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $answer_log_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$answer_log_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$answer_log_add->terminate();
?>