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
$risposte_search = new risposte_search();

// Run the page
$risposte_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$risposte_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($risposte_search->IsModal) { ?>
var frispostesearch = currentAdvancedSearchForm = new ew.Form("frispostesearch", "search");
<?php } else { ?>
var frispostesearch = currentForm = new ew.Form("frispostesearch", "search");
<?php } ?>

// Form_CustomValidate event
frispostesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frispostesearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frispostesearch.lists["x_validato[]"] = <?php echo $risposte_search->validato->Lookup->toClientList() ?>;
frispostesearch.lists["x_validato[]"].options = <?php echo JsonEncode($risposte_search->validato->options(FALSE, TRUE)) ?>;

// Form object for search
// Validate function for search

frispostesearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $risposte_search->showPageHeader(); ?>
<?php
$risposte_search->showMessage();
?>
<form name="frispostesearch" id="frispostesearch" class="<?php echo $risposte_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($risposte_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $risposte_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="risposte">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$risposte_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($risposte->validato->Visible) { // validato ?>
	<div id="r_validato" class="form-group row">
		<label class="<?php echo $risposte_search->LeftColumnClass ?>"><span id="elh_risposte_validato"><?php echo $risposte->validato->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_validato" id="z_validato" value="="></span>
		</label>
		<div class="<?php echo $risposte_search->RightColumnClass ?>"><div<?php echo $risposte->validato->cellAttributes() ?>>
			<span id="el_risposte_validato">
<?php
$selwrk = (ConvertToBool($risposte->validato->AdvancedSearch->SearchValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="risposte" data-field="x_validato" name="x_validato[]" id="x_validato[]" value="1"<?php echo $selwrk ?><?php echo $risposte->validato->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$risposte_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $risposte_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$risposte_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$risposte_search->terminate();
?>