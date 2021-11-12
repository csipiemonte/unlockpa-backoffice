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
$zone_add = new zone_add();

// Run the page
$zone_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$zone_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fzoneadd = currentForm = new ew.Form("fzoneadd", "add");

// Validate form
fzoneadd.validate = function() {
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
		<?php if ($zone_add->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $zone->id->caption(), $zone->id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($zone->id->errorMessage()) ?>");
		<?php if ($zone_add->zona->Required) { ?>
			elm = this.getElements("x" + infix + "_zona");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $zone->zona->caption(), $zone->zona->RequiredErrorMessage)) ?>");
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
fzoneadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fzoneadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $zone_add->showPageHeader(); ?>
<?php
$zone_add->showMessage();
?>
<form name="fzoneadd" id="fzoneadd" class="<?php echo $zone_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($zone_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $zone_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="zone">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$zone_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($zone->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_zone_id" for="x_id" class="<?php echo $zone_add->LeftColumnClass ?>"><?php echo $zone->id->caption() ?><?php echo ($zone->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $zone_add->RightColumnClass ?>"><div<?php echo $zone->id->cellAttributes() ?>>
<span id="el_zone_id">
<input type="text" data-table="zone" data-field="x_id" name="x_id" id="x_id" size="30" placeholder="<?php echo HtmlEncode($zone->id->getPlaceHolder()) ?>" value="<?php echo $zone->id->EditValue ?>"<?php echo $zone->id->editAttributes() ?>>
</span>
<?php echo $zone->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($zone->zona->Visible) { // zona ?>
	<div id="r_zona" class="form-group row">
		<label id="elh_zone_zona" for="x_zona" class="<?php echo $zone_add->LeftColumnClass ?>"><?php echo $zone->zona->caption() ?><?php echo ($zone->zona->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $zone_add->RightColumnClass ?>"><div<?php echo $zone->zona->cellAttributes() ?>>
<span id="el_zone_zona">
<input type="text" data-table="zone" data-field="x_zona" name="x_zona" id="x_zona" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($zone->zona->getPlaceHolder()) ?>" value="<?php echo $zone->zona->EditValue ?>"<?php echo $zone->zona->editAttributes() ?>>
</span>
<?php echo $zone->zona->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$zone_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $zone_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $zone_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$zone_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$zone_add->terminate();
?>