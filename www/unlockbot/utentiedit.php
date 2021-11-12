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
$utenti_edit = new utenti_edit();

// Run the page
$utenti_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$utenti_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var futentiedit = currentForm = new ew.Form("futentiedit", "edit");

// Validate form
futentiedit.validate = function() {
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
		<?php if ($utenti_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->id->caption(), $utenti->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($utenti_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->name->caption(), $utenti->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($utenti_edit->pass->Required) { ?>
			elm = this.getElements("x" + infix + "_pass");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->pass->caption(), $utenti->pass->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($utenti_edit->mail->Required) { ?>
			elm = this.getElements("x" + infix + "_mail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->mail->caption(), $utenti->mail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($utenti_edit->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->status->caption(), $utenti->status->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($utenti_edit->userlevel->Required) { ?>
			elm = this.getElements("x" + infix + "_userlevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->userlevel->caption(), $utenti->userlevel->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($utenti_edit->fk_comune->Required) { ?>
			elm = this.getElements("x" + infix + "_fk_comune");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->fk_comune->caption(), $utenti->fk_comune->RequiredErrorMessage)) ?>");
		<?php } ?>

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
futentiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
futentiedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
futentiedit.lists["x_status"] = <?php echo $utenti_edit->status->Lookup->toClientList() ?>;
futentiedit.lists["x_status"].options = <?php echo JsonEncode($utenti_edit->status->options(FALSE, TRUE)) ?>;
futentiedit.lists["x_userlevel"] = <?php echo $utenti_edit->userlevel->Lookup->toClientList() ?>;
futentiedit.lists["x_userlevel"].options = <?php echo JsonEncode($utenti_edit->userlevel->lookupOptions()) ?>;
futentiedit.lists["x_fk_comune"] = <?php echo $utenti_edit->fk_comune->Lookup->toClientList() ?>;
futentiedit.lists["x_fk_comune"].options = <?php echo JsonEncode($utenti_edit->fk_comune->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $utenti_edit->showPageHeader(); ?>
<?php
$utenti_edit->showMessage();
?>
<form name="futentiedit" id="futentiedit" class="<?php echo $utenti_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($utenti_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $utenti_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="utenti">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$utenti_edit->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($utenti->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_utenti_id" class="<?php echo $utenti_edit->LeftColumnClass ?>"><?php echo $utenti->id->caption() ?><?php echo ($utenti->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $utenti_edit->RightColumnClass ?>"><div<?php echo $utenti->id->cellAttributes() ?>>
<span id="el_utenti_id">
<span<?php echo $utenti->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($utenti->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="utenti" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($utenti->id->CurrentValue) ?>">
<?php echo $utenti->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_utenti_name" for="x_name" class="<?php echo $utenti_edit->LeftColumnClass ?>"><?php echo $utenti->name->caption() ?><?php echo ($utenti->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $utenti_edit->RightColumnClass ?>"><div<?php echo $utenti->name->cellAttributes() ?>>
<span id="el_utenti_name">
<input type="text" data-table="utenti" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($utenti->name->getPlaceHolder()) ?>" value="<?php echo $utenti->name->EditValue ?>"<?php echo $utenti->name->editAttributes() ?>>
</span>
<?php echo $utenti->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->pass->Visible) { // pass ?>
	<div id="r_pass" class="form-group row">
		<label id="elh_utenti_pass" for="x_pass" class="<?php echo $utenti_edit->LeftColumnClass ?>"><?php echo $utenti->pass->caption() ?><?php echo ($utenti->pass->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $utenti_edit->RightColumnClass ?>"><div<?php echo $utenti->pass->cellAttributes() ?>>
<span id="el_utenti_pass">
<input type="text" data-table="utenti" data-field="x_pass" name="x_pass" id="x_pass" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($utenti->pass->getPlaceHolder()) ?>" value="<?php echo $utenti->pass->EditValue ?>"<?php echo $utenti->pass->editAttributes() ?>>
</span>
<?php echo $utenti->pass->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->mail->Visible) { // mail ?>
	<div id="r_mail" class="form-group row">
		<label id="elh_utenti_mail" for="x_mail" class="<?php echo $utenti_edit->LeftColumnClass ?>"><?php echo $utenti->mail->caption() ?><?php echo ($utenti->mail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $utenti_edit->RightColumnClass ?>"><div<?php echo $utenti->mail->cellAttributes() ?>>
<span id="el_utenti_mail">
<input type="text" data-table="utenti" data-field="x_mail" name="x_mail" id="x_mail" size="30" maxlength="254" placeholder="<?php echo HtmlEncode($utenti->mail->getPlaceHolder()) ?>" value="<?php echo $utenti->mail->EditValue ?>"<?php echo $utenti->mail->editAttributes() ?>>
</span>
<?php echo $utenti->mail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_utenti_status" class="<?php echo $utenti_edit->LeftColumnClass ?>"><?php echo $utenti->status->caption() ?><?php echo ($utenti->status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $utenti_edit->RightColumnClass ?>"><div<?php echo $utenti->status->cellAttributes() ?>>
<span id="el_utenti_status">
<div id="tp_x_status" class="ew-template"><input type="radio" class="form-check-input" data-table="utenti" data-field="x_status" data-value-separator="<?php echo $utenti->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $utenti->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $utenti->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $utenti->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->userlevel->Visible) { // userlevel ?>
	<div id="r_userlevel" class="form-group row">
		<label id="elh_utenti_userlevel" for="x_userlevel" class="<?php echo $utenti_edit->LeftColumnClass ?>"><?php echo $utenti->userlevel->caption() ?><?php echo ($utenti->userlevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $utenti_edit->RightColumnClass ?>"><div<?php echo $utenti->userlevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_utenti_userlevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($utenti->userlevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_utenti_userlevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="utenti" data-field="x_userlevel" data-value-separator="<?php echo $utenti->userlevel->displayValueSeparatorAttribute() ?>" id="x_userlevel" name="x_userlevel"<?php echo $utenti->userlevel->editAttributes() ?>>
		<?php echo $utenti->userlevel->selectOptionListHtml("x_userlevel") ?>
	</select>
</div>
<?php echo $utenti->userlevel->Lookup->getParamTag("p_x_userlevel") ?>
</span>
<?php } ?>
<?php echo $utenti->userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->fk_comune->Visible) { // fk_comune ?>
	<div id="r_fk_comune" class="form-group row">
		<label id="elh_utenti_fk_comune" for="x_fk_comune" class="<?php echo $utenti_edit->LeftColumnClass ?>"><?php echo $utenti->fk_comune->caption() ?><?php echo ($utenti->fk_comune->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $utenti_edit->RightColumnClass ?>"><div<?php echo $utenti->fk_comune->cellAttributes() ?>>
<span id="el_utenti_fk_comune">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="utenti" data-field="x_fk_comune" data-value-separator="<?php echo $utenti->fk_comune->displayValueSeparatorAttribute() ?>" id="x_fk_comune" name="x_fk_comune"<?php echo $utenti->fk_comune->editAttributes() ?>>
		<?php echo $utenti->fk_comune->selectOptionListHtml("x_fk_comune") ?>
	</select>
</div>
<?php echo $utenti->fk_comune->Lookup->getParamTag("p_x_fk_comune") ?>
</span>
<?php echo $utenti->fk_comune->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$utenti_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $utenti_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $utenti_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$utenti_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$utenti_edit->terminate();
?>