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
$domande_edit = new domande_edit();

// Run the page
$domande_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$domande_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fdomandeedit = currentForm = new ew.Form("fdomandeedit", "edit");

// Validate form
fdomandeedit.validate = function() {
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
		<?php if ($domande_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $domande->id->caption(), $domande->id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($domande->id->errorMessage()) ?>");
		<?php if ($domande_edit->domanda->Required) { ?>
			elm = this.getElements("x" + infix + "_domanda");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $domande->domanda->caption(), $domande->domanda->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($domande_edit->risposta_default->Required) { ?>
			elm = this.getElements("x" + infix + "_risposta_default");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $domande->risposta_default->caption(), $domande->risposta_default->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($domande_edit->fk_categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_fk_categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $domande->fk_categoria->caption(), $domande->fk_categoria->RequiredErrorMessage)) ?>");
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
fdomandeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdomandeedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdomandeedit.lists["x_fk_categoria"] = <?php echo $domande_edit->fk_categoria->Lookup->toClientList() ?>;
fdomandeedit.lists["x_fk_categoria"].options = <?php echo JsonEncode($domande_edit->fk_categoria->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $domande_edit->showPageHeader(); ?>
<?php
$domande_edit->showMessage();
?>
<form name="fdomandeedit" id="fdomandeedit" class="<?php echo $domande_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($domande_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $domande_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="domande">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$domande_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($domande->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_domande_id" for="x_id" class="<?php echo $domande_edit->LeftColumnClass ?>"><?php echo $domande->id->caption() ?><?php echo ($domande->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $domande_edit->RightColumnClass ?>"><div<?php echo $domande->id->cellAttributes() ?>>
<span id="el_domande_id">
<span<?php echo $domande->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($domande->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="domande" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($domande->id->CurrentValue) ?>">
<?php echo $domande->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($domande->domanda->Visible) { // domanda ?>
	<div id="r_domanda" class="form-group row">
		<label id="elh_domande_domanda" for="x_domanda" class="<?php echo $domande_edit->LeftColumnClass ?>"><?php echo $domande->domanda->caption() ?><?php echo ($domande->domanda->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $domande_edit->RightColumnClass ?>"><div<?php echo $domande->domanda->cellAttributes() ?>>
<span id="el_domande_domanda">
<textarea data-table="domande" data-field="x_domanda" name="x_domanda" id="x_domanda" cols="35" rows="4" placeholder="<?php echo HtmlEncode($domande->domanda->getPlaceHolder()) ?>"<?php echo $domande->domanda->editAttributes() ?>><?php echo $domande->domanda->EditValue ?></textarea>
</span>
<?php echo $domande->domanda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($domande->risposta_default->Visible) { // risposta_default ?>
	<div id="r_risposta_default" class="form-group row">
		<label id="elh_domande_risposta_default" for="x_risposta_default" class="<?php echo $domande_edit->LeftColumnClass ?>"><?php echo $domande->risposta_default->caption() ?><?php echo ($domande->risposta_default->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $domande_edit->RightColumnClass ?>"><div<?php echo $domande->risposta_default->cellAttributes() ?>>
<span id="el_domande_risposta_default">
<textarea data-table="domande" data-field="x_risposta_default" name="x_risposta_default" id="x_risposta_default" cols="35" rows="4" placeholder="<?php echo HtmlEncode($domande->risposta_default->getPlaceHolder()) ?>"<?php echo $domande->risposta_default->editAttributes() ?>><?php echo $domande->risposta_default->EditValue ?></textarea>
</span>
<?php echo $domande->risposta_default->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($domande->fk_categoria->Visible) { // fk_categoria ?>
	<div id="r_fk_categoria" class="form-group row">
		<label id="elh_domande_fk_categoria" for="x_fk_categoria" class="<?php echo $domande_edit->LeftColumnClass ?>"><?php echo $domande->fk_categoria->caption() ?><?php echo ($domande->fk_categoria->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $domande_edit->RightColumnClass ?>"><div<?php echo $domande->fk_categoria->cellAttributes() ?>>
<span id="el_domande_fk_categoria">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="domande" data-field="x_fk_categoria" data-value-separator="<?php echo $domande->fk_categoria->displayValueSeparatorAttribute() ?>" id="x_fk_categoria" name="x_fk_categoria"<?php echo $domande->fk_categoria->editAttributes() ?>>
		<?php echo $domande->fk_categoria->selectOptionListHtml("x_fk_categoria") ?>
	</select>
</div>
<?php echo $domande->fk_categoria->Lookup->getParamTag("p_x_fk_categoria") ?>
</span>
<?php echo $domande->fk_categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$domande_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $domande_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $domande_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$domande_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$domande_edit->terminate();
?>