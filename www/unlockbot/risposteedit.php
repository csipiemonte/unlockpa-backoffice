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
$risposte_edit = new risposte_edit();

// Run the page
$risposte_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$risposte_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var frisposteedit = currentForm = new ew.Form("frisposteedit", "edit");

// Validate form
frisposteedit.validate = function() {
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
		<?php if ($risposte_edit->id_comune->Required) { ?>
			elm = this.getElements("x" + infix + "_id_comune");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->id_comune->caption(), $risposte->id_comune->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_edit->id_domanda->Required) { ?>
			elm = this.getElements("x" + infix + "_id_domanda");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->id_domanda->caption(), $risposte->id_domanda->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_edit->risposta->Required) { ?>
			elm = this.getElements("x" + infix + "_risposta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->risposta->caption(), $risposte->risposta->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_edit->validato->Required) { ?>
			elm = this.getElements("x" + infix + "_validato[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->validato->caption(), $risposte->validato->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_edit->categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->categoria->caption(), $risposte->categoria->RequiredErrorMessage)) ?>");
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
frisposteedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frisposteedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frisposteedit.lists["x_id_comune"] = <?php echo $risposte_edit->id_comune->Lookup->toClientList() ?>;
frisposteedit.lists["x_id_comune"].options = <?php echo JsonEncode($risposte_edit->id_comune->lookupOptions()) ?>;
frisposteedit.autoSuggests["x_id_comune"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
frisposteedit.lists["x_id_domanda"] = <?php echo $risposte_edit->id_domanda->Lookup->toClientList() ?>;
frisposteedit.lists["x_id_domanda"].options = <?php echo JsonEncode($risposte_edit->id_domanda->lookupOptions()) ?>;
frisposteedit.autoSuggests["x_id_domanda"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
frisposteedit.lists["x_validato[]"] = <?php echo $risposte_edit->validato->Lookup->toClientList() ?>;
frisposteedit.lists["x_validato[]"].options = <?php echo JsonEncode($risposte_edit->validato->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $risposte_edit->showPageHeader(); ?>
<?php
$risposte_edit->showMessage();
?>
<form name="frisposteedit" id="frisposteedit" class="<?php echo $risposte_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($risposte_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $risposte_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="risposte">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$risposte_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($risposte->id_comune->Visible) { // id_comune ?>
	<div id="r_id_comune" class="form-group row">
		<label id="elh_risposte_id_comune" class="<?php echo $risposte_edit->LeftColumnClass ?>"><?php echo $risposte->id_comune->caption() ?><?php echo ($risposte->id_comune->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_edit->RightColumnClass ?>"><div<?php echo $risposte->id_comune->cellAttributes() ?>>
<span id="el_risposte_id_comune">
<span<?php echo $risposte->id_comune->viewAttributes() ?>>
<?php if ((!EmptyString($risposte->id_comune->TooltipValue)) && $risposte->id_comune->linkAttributes() <> "") { ?>
<a<?php echo $risposte->id_comune->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->id_comune->EditValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->id_comune->EditValue) ?>">
<?php } ?>
<span id="tt_risposte_x_id_comune" class="d-none">
<?php echo $risposte->id_comune->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="risposte" data-field="x_id_comune" name="x_id_comune" id="x_id_comune" value="<?php echo HtmlEncode($risposte->id_comune->CurrentValue) ?>">
<?php echo $risposte->id_comune->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($risposte->id_domanda->Visible) { // id_domanda ?>
	<div id="r_id_domanda" class="form-group row">
		<label id="elh_risposte_id_domanda" class="<?php echo $risposte_edit->LeftColumnClass ?>"><?php echo $risposte->id_domanda->caption() ?><?php echo ($risposte->id_domanda->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_edit->RightColumnClass ?>"><div<?php echo $risposte->id_domanda->cellAttributes() ?>>
<span id="el_risposte_id_domanda">
<span<?php echo $risposte->id_domanda->viewAttributes() ?>>
<?php if ((!EmptyString($risposte->id_domanda->TooltipValue)) && $risposte->id_domanda->linkAttributes() <> "") { ?>
<a<?php echo $risposte->id_domanda->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->id_domanda->EditValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->id_domanda->EditValue) ?>">
<?php } ?>
<span id="tt_risposte_x_id_domanda" class="d-none">
<?php echo $risposte->id_domanda->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="risposte" data-field="x_id_domanda" name="x_id_domanda" id="x_id_domanda" value="<?php echo HtmlEncode($risposte->id_domanda->CurrentValue) ?>">
<?php echo $risposte->id_domanda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($risposte->risposta->Visible) { // risposta ?>
	<div id="r_risposta" class="form-group row">
		<label id="elh_risposte_risposta" for="x_risposta" class="<?php echo $risposte_edit->LeftColumnClass ?>"><?php echo $risposte->risposta->caption() ?><?php echo ($risposte->risposta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_edit->RightColumnClass ?>"><div<?php echo $risposte->risposta->cellAttributes() ?>>
<span id="el_risposte_risposta">
<textarea data-table="risposte" data-field="x_risposta" name="x_risposta" id="x_risposta" cols="80" rows="6" placeholder="<?php echo HtmlEncode($risposte->risposta->getPlaceHolder()) ?>"<?php echo $risposte->risposta->editAttributes() ?>><?php echo $risposte->risposta->EditValue ?></textarea>
</span>
<?php echo $risposte->risposta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($risposte->validato->Visible) { // validato ?>
	<div id="r_validato" class="form-group row">
		<label id="elh_risposte_validato" class="<?php echo $risposte_edit->LeftColumnClass ?>"><?php echo $risposte->validato->caption() ?><?php echo ($risposte->validato->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_edit->RightColumnClass ?>"><div<?php echo $risposte->validato->cellAttributes() ?>>
<span id="el_risposte_validato">
<?php
$selwrk = (ConvertToBool($risposte->validato->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="risposte" data-field="x_validato" name="x_validato[]" id="x_validato[]" value="1"<?php echo $selwrk ?><?php echo $risposte->validato->editAttributes() ?>>
</span>
<?php echo $risposte->validato->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($risposte->categoria->Visible) { // categoria ?>
	<div id="r_categoria" class="form-group row">
		<label id="elh_risposte_categoria" for="x_categoria" class="<?php echo $risposte_edit->LeftColumnClass ?>"><?php echo $risposte->categoria->caption() ?><?php echo ($risposte->categoria->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_edit->RightColumnClass ?>"><div<?php echo $risposte->categoria->cellAttributes() ?>>
<span id="el_risposte_categoria">
<span<?php echo $risposte->categoria->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->categoria->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="risposte" data-field="x_categoria" name="x_categoria" id="x_categoria" value="<?php echo HtmlEncode($risposte->categoria->CurrentValue) ?>">
<?php echo $risposte->categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$risposte_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $risposte_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $risposte_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$risposte_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$risposte_edit->terminate();
?>