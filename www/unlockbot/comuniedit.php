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
$comuni_edit = new comuni_edit();

// Run the page
$comuni_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comuni_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcomuniedit = currentForm = new ew.Form("fcomuniedit", "edit");

// Validate form
fcomuniedit.validate = function() {
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
		<?php if ($comuni_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->id->caption(), $comuni->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->istat->Required) { ?>
			elm = this.getElements("x" + infix + "_istat");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->istat->caption(), $comuni->istat->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_istat");
			if (elm && !ew.checkByRegEx(elm.value, '^[A-zÀ-ý0-9!@€#$&() \\\-\'+,.;\"]*$'))
				return this.onError(elm, "<?php echo JsEncode($comuni->istat->errorMessage()) ?>");
		<?php if ($comuni_edit->toponimo->Required) { ?>
			elm = this.getElements("x" + infix + "_toponimo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->toponimo->caption(), $comuni->toponimo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->telefono->Required) { ?>
			elm = this.getElements("x" + infix + "_telefono");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->telefono->caption(), $comuni->telefono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->indirizzo->Required) { ?>
			elm = this.getElements("x" + infix + "_indirizzo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->indirizzo->caption(), $comuni->indirizzo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->provincia->Required) { ?>
			elm = this.getElements("x" + infix + "_provincia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->provincia->caption(), $comuni->provincia->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->avviso->Required) { ?>
			elm = this.getElements("x" + infix + "_avviso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->avviso->caption(), $comuni->avviso->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->fk_zona->Required) { ?>
			elm = this.getElements("x" + infix + "_fk_zona");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->fk_zona->caption(), $comuni->fk_zona->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->no_response->Required) { ?>
			elm = this.getElements("x" + infix + "_no_response");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->no_response->caption(), $comuni->no_response->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->dominio->Required) { ?>
			elm = this.getElements("x" + infix + "_dominio");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->dominio->caption(), $comuni->dominio->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_dominio");
			if (elm && !ew.checkByRegEx(elm.value, '^[A-zÀ-ý0-9!@€#$&() \\\-\'+,.;\"]*$'))
				return this.onError(elm, "<?php echo JsEncode($comuni->dominio->errorMessage()) ?>");
		<?php if ($comuni_edit->vide->Required) { ?>
			elm = this.getElements("x" + infix + "_vide[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->vide->caption(), $comuni->vide->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->botattivo->Required) { ?>
			elm = this.getElements("x" + infix + "_botattivo[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->botattivo->caption(), $comuni->botattivo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->logobin->Required) { ?>
			felm = this.getElements("x" + infix + "_logobin");
			elm = this.getElements("fn_x" + infix + "_logobin");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $comuni->logobin->caption(), $comuni->logobin->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comuni_edit->vide_url->Required) { ?>
			elm = this.getElements("x" + infix + "_vide_url");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comuni->vide_url->caption(), $comuni->vide_url->RequiredErrorMessage)) ?>");
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
fcomuniedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
// Funziona correttamente. Todo : aggiugere tutte le stringhe da verificare 
//    var element = document.getElementById('x_avviso');
//    //alert(element.value);
//    var str = element.value;
//    if (str.includes("and")){
//      //  block of code to be executed if the condition is true
//      alert("Contiene and non posso salvare");
//      return false;
//    } else {
//      //  block of code to be executed if the condition is false
//      alert("NON Contiene and e quindi salvo");
//      return true;
//    }
//alert("Hello! I am an alert box!!");    
//return false;
//alert($qty.value);
//(alert("Hello! I am an alert box!!");
//	return true;

	return true;
}

// Use JavaScript validation or not
fcomuniedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcomuniedit.lists["x_fk_zona"] = <?php echo $comuni_edit->fk_zona->Lookup->toClientList() ?>;
fcomuniedit.lists["x_fk_zona"].options = <?php echo JsonEncode($comuni_edit->fk_zona->lookupOptions()) ?>;
fcomuniedit.lists["x_vide[]"] = <?php echo $comuni_edit->vide->Lookup->toClientList() ?>;
fcomuniedit.lists["x_vide[]"].options = <?php echo JsonEncode($comuni_edit->vide->options(FALSE, TRUE)) ?>;
fcomuniedit.lists["x_botattivo[]"] = <?php echo $comuni_edit->botattivo->Lookup->toClientList() ?>;
fcomuniedit.lists["x_botattivo[]"].options = <?php echo JsonEncode($comuni_edit->botattivo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $comuni_edit->showPageHeader(); ?>
<?php
$comuni_edit->showMessage();
?>
<form name="fcomuniedit" id="fcomuniedit" class="<?php echo $comuni_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comuni_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comuni_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comuni">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$comuni_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($comuni->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_comuni_id" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->id->caption() ?><?php echo ($comuni->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->id->cellAttributes() ?>>
<span id="el_comuni_id">
<span<?php echo $comuni->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comuni->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="comuni" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($comuni->id->CurrentValue) ?>">
<?php echo $comuni->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->istat->Visible) { // istat ?>
	<div id="r_istat" class="form-group row">
		<label id="elh_comuni_istat" for="x_istat" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->istat->caption() ?><?php echo ($comuni->istat->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->istat->cellAttributes() ?>>
<span id="el_comuni_istat">
<input type="text" data-table="comuni" data-field="x_istat" name="x_istat" id="x_istat" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($comuni->istat->getPlaceHolder()) ?>" value="<?php echo $comuni->istat->EditValue ?>"<?php echo $comuni->istat->editAttributes() ?>>
</span>
<?php echo $comuni->istat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->toponimo->Visible) { // toponimo ?>
	<div id="r_toponimo" class="form-group row">
		<label id="elh_comuni_toponimo" for="x_toponimo" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->toponimo->caption() ?><?php echo ($comuni->toponimo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->toponimo->cellAttributes() ?>>
<span id="el_comuni_toponimo">
<input type="text" data-table="comuni" data-field="x_toponimo" name="x_toponimo" id="x_toponimo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($comuni->toponimo->getPlaceHolder()) ?>" value="<?php echo $comuni->toponimo->EditValue ?>"<?php echo $comuni->toponimo->editAttributes() ?>>
</span>
<?php echo $comuni->toponimo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_comuni_telefono" for="x_telefono" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->telefono->caption() ?><?php echo ($comuni->telefono->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->telefono->cellAttributes() ?>>
<span id="el_comuni_telefono">
<input type="text" data-table="comuni" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($comuni->telefono->getPlaceHolder()) ?>" value="<?php echo $comuni->telefono->EditValue ?>"<?php echo $comuni->telefono->editAttributes() ?>>
</span>
<?php echo $comuni->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->indirizzo->Visible) { // indirizzo ?>
	<div id="r_indirizzo" class="form-group row">
		<label id="elh_comuni_indirizzo" for="x_indirizzo" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->indirizzo->caption() ?><?php echo ($comuni->indirizzo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->indirizzo->cellAttributes() ?>>
<span id="el_comuni_indirizzo">
<input type="text" data-table="comuni" data-field="x_indirizzo" name="x_indirizzo" id="x_indirizzo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($comuni->indirizzo->getPlaceHolder()) ?>" value="<?php echo $comuni->indirizzo->EditValue ?>"<?php echo $comuni->indirizzo->editAttributes() ?>>
</span>
<?php echo $comuni->indirizzo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->provincia->Visible) { // provincia ?>
	<div id="r_provincia" class="form-group row">
		<label id="elh_comuni_provincia" for="x_provincia" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->provincia->caption() ?><?php echo ($comuni->provincia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->provincia->cellAttributes() ?>>
<span id="el_comuni_provincia">
<input type="text" data-table="comuni" data-field="x_provincia" name="x_provincia" id="x_provincia" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($comuni->provincia->getPlaceHolder()) ?>" value="<?php echo $comuni->provincia->EditValue ?>"<?php echo $comuni->provincia->editAttributes() ?>>
</span>
<?php echo $comuni->provincia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->avviso->Visible) { // avviso ?>
	<div id="r_avviso" class="form-group row">
		<label id="elh_comuni_avviso" for="x_avviso" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->avviso->caption() ?><?php echo ($comuni->avviso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->avviso->cellAttributes() ?>>
<span id="el_comuni_avviso">
<textarea data-table="comuni" data-field="x_avviso" name="x_avviso" id="x_avviso" cols="35" rows="4" placeholder="<?php echo HtmlEncode($comuni->avviso->getPlaceHolder()) ?>"<?php echo $comuni->avviso->editAttributes() ?>><?php echo $comuni->avviso->EditValue ?></textarea>
</span>
<?php echo $comuni->avviso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->fk_zona->Visible) { // fk_zona ?>
	<div id="r_fk_zona" class="form-group row">
		<label id="elh_comuni_fk_zona" for="x_fk_zona" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->fk_zona->caption() ?><?php echo ($comuni->fk_zona->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->fk_zona->cellAttributes() ?>>
<span id="el_comuni_fk_zona">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="comuni" data-field="x_fk_zona" data-value-separator="<?php echo $comuni->fk_zona->displayValueSeparatorAttribute() ?>" id="x_fk_zona" name="x_fk_zona"<?php echo $comuni->fk_zona->editAttributes() ?>>
		<?php echo $comuni->fk_zona->selectOptionListHtml("x_fk_zona") ?>
	</select>
</div>
<?php echo $comuni->fk_zona->Lookup->getParamTag("p_x_fk_zona") ?>
</span>
<?php echo $comuni->fk_zona->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->no_response->Visible) { // no_response ?>
	<div id="r_no_response" class="form-group row">
		<label id="elh_comuni_no_response" for="x_no_response" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->no_response->caption() ?><?php echo ($comuni->no_response->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->no_response->cellAttributes() ?>>
<span id="el_comuni_no_response">
<textarea data-table="comuni" data-field="x_no_response" name="x_no_response" id="x_no_response" cols="35" rows="4" placeholder="<?php echo HtmlEncode($comuni->no_response->getPlaceHolder()) ?>"<?php echo $comuni->no_response->editAttributes() ?>><?php echo $comuni->no_response->EditValue ?></textarea>
</span>
<?php echo $comuni->no_response->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->dominio->Visible) { // dominio ?>
	<div id="r_dominio" class="form-group row">
		<label id="elh_comuni_dominio" for="x_dominio" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->dominio->caption() ?><?php echo ($comuni->dominio->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->dominio->cellAttributes() ?>>
<span id="el_comuni_dominio">
<input type="text" data-table="comuni" data-field="x_dominio" name="x_dominio" id="x_dominio" size="30" maxlength="512" placeholder="<?php echo HtmlEncode($comuni->dominio->getPlaceHolder()) ?>" value="<?php echo $comuni->dominio->EditValue ?>"<?php echo $comuni->dominio->editAttributes() ?>>
</span>
<?php echo $comuni->dominio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->vide->Visible) { // vide ?>
	<div id="r_vide" class="form-group row">
		<label id="elh_comuni_vide" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->vide->caption() ?><?php echo ($comuni->vide->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->vide->cellAttributes() ?>>
<span id="el_comuni_vide">
<?php
$selwrk = (ConvertToBool($comuni->vide->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="comuni" data-field="x_vide" name="x_vide[]" id="x_vide[]" value="1"<?php echo $selwrk ?><?php echo $comuni->vide->editAttributes() ?>>
</span>
<?php echo $comuni->vide->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->botattivo->Visible) { // botattivo ?>
	<div id="r_botattivo" class="form-group row">
		<label id="elh_comuni_botattivo" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->botattivo->caption() ?><?php echo ($comuni->botattivo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->botattivo->cellAttributes() ?>>
<span id="el_comuni_botattivo">
<?php
$selwrk = (ConvertToBool($comuni->botattivo->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="comuni" data-field="x_botattivo" name="x_botattivo[]" id="x_botattivo[]" value="1"<?php echo $selwrk ?><?php echo $comuni->botattivo->editAttributes() ?>>
</span>
<?php echo $comuni->botattivo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->logobin->Visible) { // logobin ?>
	<div id="r_logobin" class="form-group row">
		<label id="elh_comuni_logobin" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->logobin->caption() ?><?php echo ($comuni->logobin->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->logobin->cellAttributes() ?>>
<span id="el_comuni_logobin">
<div id="fd_x_logobin">
<span title="<?php echo $comuni->logobin->title() ? $comuni->logobin->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($comuni->logobin->ReadOnly || $comuni->logobin->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="comuni" data-field="x_logobin" name="x_logobin" id="x_logobin"<?php echo $comuni->logobin->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_logobin" id= "fn_x_logobin" value="<?php echo $comuni->logobin->Upload->FileName ?>">
<?php if (Post("fa_x_logobin") == "0") { ?>
<input type="hidden" name="fa_x_logobin" id= "fa_x_logobin" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_logobin" id= "fa_x_logobin" value="1">
<?php } ?>
<input type="hidden" name="fs_x_logobin" id= "fs_x_logobin" value="0">
<input type="hidden" name="fx_x_logobin" id= "fx_x_logobin" value="<?php echo $comuni->logobin->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_logobin" id= "fm_x_logobin" value="<?php echo $comuni->logobin->UploadMaxFileSize ?>">
</div>
<table id="ft_x_logobin" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $comuni->logobin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comuni->vide_url->Visible) { // vide_url ?>
	<div id="r_vide_url" class="form-group row">
		<label id="elh_comuni_vide_url" for="x_vide_url" class="<?php echo $comuni_edit->LeftColumnClass ?>"><?php echo $comuni->vide_url->caption() ?><?php echo ($comuni->vide_url->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comuni_edit->RightColumnClass ?>"><div<?php echo $comuni->vide_url->cellAttributes() ?>>
<span id="el_comuni_vide_url">
<input type="text" data-table="comuni" data-field="x_vide_url" name="x_vide_url" id="x_vide_url" size="30" maxlength="512" placeholder="<?php echo HtmlEncode($comuni->vide_url->getPlaceHolder()) ?>" value="<?php echo $comuni->vide_url->EditValue ?>"<?php echo $comuni->vide_url->editAttributes() ?>>
</span>
<?php echo $comuni->vide_url->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$comuni_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $comuni_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $comuni_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$comuni_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$comuni_edit->terminate();
?>