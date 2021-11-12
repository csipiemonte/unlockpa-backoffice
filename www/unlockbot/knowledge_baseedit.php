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
$knowledge_base_edit = new knowledge_base_edit();

// Run the page
$knowledge_base_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$knowledge_base_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fknowledge_baseedit = currentForm = new ew.Form("fknowledge_baseedit", "edit");

// Validate form
fknowledge_baseedit.validate = function() {
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
		<?php if ($knowledge_base_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->id->caption(), $knowledge_base->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($knowledge_base_edit->ts_creation->Required) { ?>
			elm = this.getElements("x" + infix + "_ts_creation");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->ts_creation->caption(), $knowledge_base->ts_creation->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ts_creation");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($knowledge_base->ts_creation->errorMessage()) ?>");
		<?php if ($knowledge_base_edit->question_type->Required) { ?>
			elm = this.getElements("x" + infix + "_question_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->question_type->caption(), $knowledge_base->question_type->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($knowledge_base_edit->question_number->Required) { ?>
			elm = this.getElements("x" + infix + "_question_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->question_number->caption(), $knowledge_base->question_number->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($knowledge_base_edit->question->Required) { ?>
			elm = this.getElements("x" + infix + "_question");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->question->caption(), $knowledge_base->question->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($knowledge_base_edit->answer->Required) { ?>
			elm = this.getElements("x" + infix + "_answer");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->answer->caption(), $knowledge_base->answer->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($knowledge_base_edit->note->Required) { ?>
			elm = this.getElements("x" + infix + "_note");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->note->caption(), $knowledge_base->note->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($knowledge_base_edit->id_bot->Required) { ?>
			elm = this.getElements("x" + infix + "_id_bot");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $knowledge_base->id_bot->caption(), $knowledge_base->id_bot->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_bot");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($knowledge_base->id_bot->errorMessage()) ?>");

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
fknowledge_baseedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fknowledge_baseedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $knowledge_base_edit->showPageHeader(); ?>
<?php
$knowledge_base_edit->showMessage();
?>
<form name="fknowledge_baseedit" id="fknowledge_baseedit" class="<?php echo $knowledge_base_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($knowledge_base_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $knowledge_base_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="knowledge_base">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$knowledge_base_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($knowledge_base->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_knowledge_base_id" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->id->caption() ?><?php echo ($knowledge_base->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->id->cellAttributes() ?>>
<span id="el_knowledge_base_id">
<span<?php echo $knowledge_base->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($knowledge_base->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="knowledge_base" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($knowledge_base->id->CurrentValue) ?>">
<?php echo $knowledge_base->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($knowledge_base->ts_creation->Visible) { // ts_creation ?>
	<div id="r_ts_creation" class="form-group row">
		<label id="elh_knowledge_base_ts_creation" for="x_ts_creation" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->ts_creation->caption() ?><?php echo ($knowledge_base->ts_creation->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->ts_creation->cellAttributes() ?>>
<span id="el_knowledge_base_ts_creation">
<input type="text" data-table="knowledge_base" data-field="x_ts_creation" name="x_ts_creation" id="x_ts_creation" placeholder="<?php echo HtmlEncode($knowledge_base->ts_creation->getPlaceHolder()) ?>" value="<?php echo $knowledge_base->ts_creation->EditValue ?>"<?php echo $knowledge_base->ts_creation->editAttributes() ?>>
</span>
<?php echo $knowledge_base->ts_creation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($knowledge_base->question_type->Visible) { // question_type ?>
	<div id="r_question_type" class="form-group row">
		<label id="elh_knowledge_base_question_type" for="x_question_type" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->question_type->caption() ?><?php echo ($knowledge_base->question_type->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->question_type->cellAttributes() ?>>
<span id="el_knowledge_base_question_type">
<input type="text" data-table="knowledge_base" data-field="x_question_type" name="x_question_type" id="x_question_type" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($knowledge_base->question_type->getPlaceHolder()) ?>" value="<?php echo $knowledge_base->question_type->EditValue ?>"<?php echo $knowledge_base->question_type->editAttributes() ?>>
</span>
<?php echo $knowledge_base->question_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($knowledge_base->question_number->Visible) { // question_number ?>
	<div id="r_question_number" class="form-group row">
		<label id="elh_knowledge_base_question_number" for="x_question_number" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->question_number->caption() ?><?php echo ($knowledge_base->question_number->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->question_number->cellAttributes() ?>>
<span id="el_knowledge_base_question_number">
<input type="text" data-table="knowledge_base" data-field="x_question_number" name="x_question_number" id="x_question_number" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($knowledge_base->question_number->getPlaceHolder()) ?>" value="<?php echo $knowledge_base->question_number->EditValue ?>"<?php echo $knowledge_base->question_number->editAttributes() ?>>
</span>
<?php echo $knowledge_base->question_number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($knowledge_base->question->Visible) { // question ?>
	<div id="r_question" class="form-group row">
		<label id="elh_knowledge_base_question" for="x_question" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->question->caption() ?><?php echo ($knowledge_base->question->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->question->cellAttributes() ?>>
<span id="el_knowledge_base_question">
<textarea data-table="knowledge_base" data-field="x_question" name="x_question" id="x_question" cols="35" rows="4" placeholder="<?php echo HtmlEncode($knowledge_base->question->getPlaceHolder()) ?>"<?php echo $knowledge_base->question->editAttributes() ?>><?php echo $knowledge_base->question->EditValue ?></textarea>
</span>
<?php echo $knowledge_base->question->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($knowledge_base->answer->Visible) { // answer ?>
	<div id="r_answer" class="form-group row">
		<label id="elh_knowledge_base_answer" for="x_answer" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->answer->caption() ?><?php echo ($knowledge_base->answer->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->answer->cellAttributes() ?>>
<span id="el_knowledge_base_answer">
<textarea data-table="knowledge_base" data-field="x_answer" name="x_answer" id="x_answer" cols="35" rows="4" placeholder="<?php echo HtmlEncode($knowledge_base->answer->getPlaceHolder()) ?>"<?php echo $knowledge_base->answer->editAttributes() ?>><?php echo $knowledge_base->answer->EditValue ?></textarea>
</span>
<?php echo $knowledge_base->answer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($knowledge_base->note->Visible) { // note ?>
	<div id="r_note" class="form-group row">
		<label id="elh_knowledge_base_note" for="x_note" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->note->caption() ?><?php echo ($knowledge_base->note->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->note->cellAttributes() ?>>
<span id="el_knowledge_base_note">
<textarea data-table="knowledge_base" data-field="x_note" name="x_note" id="x_note" cols="35" rows="4" placeholder="<?php echo HtmlEncode($knowledge_base->note->getPlaceHolder()) ?>"<?php echo $knowledge_base->note->editAttributes() ?>><?php echo $knowledge_base->note->EditValue ?></textarea>
</span>
<?php echo $knowledge_base->note->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($knowledge_base->id_bot->Visible) { // id_bot ?>
	<div id="r_id_bot" class="form-group row">
		<label id="elh_knowledge_base_id_bot" for="x_id_bot" class="<?php echo $knowledge_base_edit->LeftColumnClass ?>"><?php echo $knowledge_base->id_bot->caption() ?><?php echo ($knowledge_base->id_bot->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $knowledge_base_edit->RightColumnClass ?>"><div<?php echo $knowledge_base->id_bot->cellAttributes() ?>>
<span id="el_knowledge_base_id_bot">
<input type="text" data-table="knowledge_base" data-field="x_id_bot" name="x_id_bot" id="x_id_bot" size="30" placeholder="<?php echo HtmlEncode($knowledge_base->id_bot->getPlaceHolder()) ?>" value="<?php echo $knowledge_base->id_bot->EditValue ?>"<?php echo $knowledge_base->id_bot->editAttributes() ?>>
</span>
<?php echo $knowledge_base->id_bot->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$knowledge_base_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $knowledge_base_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $knowledge_base_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$knowledge_base_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$knowledge_base_edit->terminate();
?>