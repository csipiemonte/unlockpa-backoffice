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
$risposte_zona_add = new risposte_zona_add();

// Run the page
$risposte_zona_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$risposte_zona_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var frisposte_zonaadd = currentForm = new ew.Form("frisposte_zonaadd", "add");

// Validate form
frisposte_zonaadd.validate = function() {
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
		<?php if ($risposte_zona_add->id_domanda->Required) { ?>
			elm = this.getElements("x" + infix + "_id_domanda");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte_zona->id_domanda->caption(), $risposte_zona->id_domanda->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_domanda");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($risposte_zona->id_domanda->errorMessage()) ?>");
		<?php if ($risposte_zona_add->id_zona->Required) { ?>
			elm = this.getElements("x" + infix + "_id_zona");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte_zona->id_zona->caption(), $risposte_zona->id_zona->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_zona");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($risposte_zona->id_zona->errorMessage()) ?>");
		<?php if ($risposte_zona_add->risposta_default->Required) { ?>
			elm = this.getElements("x" + infix + "_risposta_default");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte_zona->risposta_default->caption(), $risposte_zona->risposta_default->RequiredErrorMessage)) ?>");
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
frisposte_zonaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frisposte_zonaadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $risposte_zona_add->showPageHeader(); ?>
<?php
$risposte_zona_add->showMessage();
?>
<form name="frisposte_zonaadd" id="frisposte_zonaadd" class="<?php echo $risposte_zona_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($risposte_zona_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $risposte_zona_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="risposte_zona">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$risposte_zona_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($risposte_zona->id_domanda->Visible) { // id_domanda ?>
	<div id="r_id_domanda" class="form-group row">
		<label id="elh_risposte_zona_id_domanda" for="x_id_domanda" class="<?php echo $risposte_zona_add->LeftColumnClass ?>"><?php echo $risposte_zona->id_domanda->caption() ?><?php echo ($risposte_zona->id_domanda->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_zona_add->RightColumnClass ?>"><div<?php echo $risposte_zona->id_domanda->cellAttributes() ?>>
<span id="el_risposte_zona_id_domanda">
<input type="text" data-table="risposte_zona" data-field="x_id_domanda" name="x_id_domanda" id="x_id_domanda" size="30" placeholder="<?php echo HtmlEncode($risposte_zona->id_domanda->getPlaceHolder()) ?>" value="<?php echo $risposte_zona->id_domanda->EditValue ?>"<?php echo $risposte_zona->id_domanda->editAttributes() ?>>
</span>
<?php echo $risposte_zona->id_domanda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($risposte_zona->id_zona->Visible) { // id_zona ?>
	<div id="r_id_zona" class="form-group row">
		<label id="elh_risposte_zona_id_zona" for="x_id_zona" class="<?php echo $risposte_zona_add->LeftColumnClass ?>"><?php echo $risposte_zona->id_zona->caption() ?><?php echo ($risposte_zona->id_zona->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_zona_add->RightColumnClass ?>"><div<?php echo $risposte_zona->id_zona->cellAttributes() ?>>
<span id="el_risposte_zona_id_zona">
<input type="text" data-table="risposte_zona" data-field="x_id_zona" name="x_id_zona" id="x_id_zona" size="30" placeholder="<?php echo HtmlEncode($risposte_zona->id_zona->getPlaceHolder()) ?>" value="<?php echo $risposte_zona->id_zona->EditValue ?>"<?php echo $risposte_zona->id_zona->editAttributes() ?>>
</span>
<?php echo $risposte_zona->id_zona->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($risposte_zona->risposta_default->Visible) { // risposta_default ?>
	<div id="r_risposta_default" class="form-group row">
		<label id="elh_risposte_zona_risposta_default" for="x_risposta_default" class="<?php echo $risposte_zona_add->LeftColumnClass ?>"><?php echo $risposte_zona->risposta_default->caption() ?><?php echo ($risposte_zona->risposta_default->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $risposte_zona_add->RightColumnClass ?>"><div<?php echo $risposte_zona->risposta_default->cellAttributes() ?>>
<span id="el_risposte_zona_risposta_default">
<textarea data-table="risposte_zona" data-field="x_risposta_default" name="x_risposta_default" id="x_risposta_default" cols="60" rows="4" placeholder="<?php echo HtmlEncode($risposte_zona->risposta_default->getPlaceHolder()) ?>"<?php echo $risposte_zona->risposta_default->editAttributes() ?>><?php echo $risposte_zona->risposta_default->EditValue ?></textarea>
</span>
<?php echo $risposte_zona->risposta_default->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$risposte_zona_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $risposte_zona_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $risposte_zona_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$risposte_zona_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$risposte_zona_add->terminate();
?>