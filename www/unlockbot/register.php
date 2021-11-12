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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "register";
var fregister = currentForm = new ew.Form("fregister", "register");

// Validate form
fregister.validate = function() {
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
		<?php if ($register->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $utenti->name->caption(), $utenti->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($register->pass->Required) { ?>
			elm = this.getElements("x" + infix + "_pass");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterPassword"));
		<?php } ?>
			if (fobj.c_pass.value != fobj.x_pass.value)
				return this.onError(fobj.c_pass, ew.language.phrase("MismatchPassword"));
		<?php if ($register->mail->Required) { ?>
			elm = this.getElements("x" + infix + "_mail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterUserName"));
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fregister.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($register->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $register->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="utenti">
<input type="hidden" name="action" id="action" value="insert">
<!-- Fields to prevent google autofill -->
<input type="hidden" type="text" name="<?php echo Encrypt(Random()) ?>">
<input type="hidden" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-register-div"><!-- page* -->
<?php if ($utenti->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_utenti_name" for="x_name" class="<?php echo $register->LeftColumnClass ?>"><?php echo $utenti->name->caption() ?><?php echo ($utenti->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $utenti->name->cellAttributes() ?>>
<span id="el_utenti_name">
<input type="text" data-table="utenti" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($utenti->name->getPlaceHolder()) ?>" value="<?php echo $utenti->name->EditValue ?>"<?php echo $utenti->name->editAttributes() ?>>
</span>
<?php echo $utenti->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->pass->Visible) { // pass ?>
	<div id="r_pass" class="form-group row">
		<label id="elh_utenti_pass" for="x_pass" class="<?php echo $register->LeftColumnClass ?>"><?php echo $utenti->pass->caption() ?><?php echo ($utenti->pass->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $utenti->pass->cellAttributes() ?>>
<span id="el_utenti_pass">
<input type="text" data-table="utenti" data-field="x_pass" name="x_pass" id="x_pass" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($utenti->pass->getPlaceHolder()) ?>" value="<?php echo $utenti->pass->EditValue ?>"<?php echo $utenti->pass->editAttributes() ?>>
</span>
<?php echo $utenti->pass->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($utenti->pass->Visible) { // pass ?>
	<div id="r_c_pass" class="form-group row">
		<label id="elh_c_utenti_pass" for="c_pass" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $utenti->pass->caption() ?><?php echo ($utenti->pass->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $utenti->pass->cellAttributes() ?>>
<span id="el_c_utenti_pass">
<input type="text" data-table="utenti" data-field="c_pass" name="c_pass" id="c_pass" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($utenti->pass->getPlaceHolder()) ?>" value="<?php echo $utenti->pass->EditValue ?>"<?php echo $utenti->pass->editAttributes() ?>>
</span>
</div></div>
	</div>
<?php } ?>
<?php if ($utenti->mail->Visible) { // mail ?>
	<div id="r_mail" class="form-group row">
		<label id="elh_utenti_mail" for="x_mail" class="<?php echo $register->LeftColumnClass ?>"><?php echo $utenti->mail->caption() ?><?php echo ($utenti->mail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $utenti->mail->cellAttributes() ?>>
<span id="el_utenti_mail">
<input type="text" data-table="utenti" data-field="x_mail" name="x_mail" id="x_mail" size="30" maxlength="254" placeholder="<?php echo HtmlEncode($utenti->mail->getPlaceHolder()) ?>" value="<?php echo $utenti->mail->EditValue ?>"<?php echo $utenti->mail->editAttributes() ?>>
</span>
<?php echo $utenti->mail->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("RegisterBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
</form>
<?php
$register->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$register->terminate();
?>