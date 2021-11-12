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
$categorie_edit = new categorie_edit();

// Run the page
$categorie_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorie_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcategorieedit = currentForm = new ew.Form("fcategorieedit", "edit");

// Validate form
fcategorieedit.validate = function() {
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
		<?php if ($categorie_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categorie->id->caption(), $categorie->id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($categorie->id->errorMessage()) ?>");
		<?php if ($categorie_edit->categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categorie->categoria->caption(), $categorie->categoria->RequiredErrorMessage)) ?>");
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
fcategorieedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorieedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $categorie_edit->showPageHeader(); ?>
<?php
$categorie_edit->showMessage();
?>
<form name="fcategorieedit" id="fcategorieedit" class="<?php echo $categorie_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorie_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorie_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorie">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$categorie_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($categorie->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_categorie_id" for="x_id" class="<?php echo $categorie_edit->LeftColumnClass ?>"><?php echo $categorie->id->caption() ?><?php echo ($categorie->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categorie_edit->RightColumnClass ?>"><div<?php echo $categorie->id->cellAttributes() ?>>
<span id="el_categorie_id">
<span<?php echo $categorie->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($categorie->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="categorie" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($categorie->id->CurrentValue) ?>">
<?php echo $categorie->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categorie->categoria->Visible) { // categoria ?>
	<div id="r_categoria" class="form-group row">
		<label id="elh_categorie_categoria" for="x_categoria" class="<?php echo $categorie_edit->LeftColumnClass ?>"><?php echo $categorie->categoria->caption() ?><?php echo ($categorie->categoria->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categorie_edit->RightColumnClass ?>"><div<?php echo $categorie->categoria->cellAttributes() ?>>
<span id="el_categorie_categoria">
<input type="text" data-table="categorie" data-field="x_categoria" name="x_categoria" id="x_categoria" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($categorie->categoria->getPlaceHolder()) ?>" value="<?php echo $categorie->categoria->EditValue ?>"<?php echo $categorie->categoria->editAttributes() ?>>
</span>
<?php echo $categorie->categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$categorie_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $categorie_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categorie_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$categorie_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$categorie_edit->terminate();
?>