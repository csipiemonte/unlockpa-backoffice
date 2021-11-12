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
$risposte_zona_view = new risposte_zona_view();

// Run the page
$risposte_zona_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$risposte_zona_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$risposte_zona->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var frisposte_zonaview = currentForm = new ew.Form("frisposte_zonaview", "view");

// Form_CustomValidate event
frisposte_zonaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frisposte_zonaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$risposte_zona->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $risposte_zona_view->ExportOptions->render("body") ?>
<?php $risposte_zona_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $risposte_zona_view->showPageHeader(); ?>
<?php
$risposte_zona_view->showMessage();
?>
<form name="frisposte_zonaview" id="frisposte_zonaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($risposte_zona_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $risposte_zona_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="risposte_zona">
<input type="hidden" name="modal" value="<?php echo (int)$risposte_zona_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($risposte_zona->id_domanda->Visible) { // id_domanda ?>
	<tr id="r_id_domanda">
		<td class="<?php echo $risposte_zona_view->TableLeftColumnClass ?>"><span id="elh_risposte_zona_id_domanda"><?php echo $risposte_zona->id_domanda->caption() ?></span></td>
		<td data-name="id_domanda"<?php echo $risposte_zona->id_domanda->cellAttributes() ?>>
<span id="el_risposte_zona_id_domanda">
<span<?php echo $risposte_zona->id_domanda->viewAttributes() ?>>
<?php echo $risposte_zona->id_domanda->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($risposte_zona->id_zona->Visible) { // id_zona ?>
	<tr id="r_id_zona">
		<td class="<?php echo $risposte_zona_view->TableLeftColumnClass ?>"><span id="elh_risposte_zona_id_zona"><?php echo $risposte_zona->id_zona->caption() ?></span></td>
		<td data-name="id_zona"<?php echo $risposte_zona->id_zona->cellAttributes() ?>>
<span id="el_risposte_zona_id_zona">
<span<?php echo $risposte_zona->id_zona->viewAttributes() ?>>
<?php echo $risposte_zona->id_zona->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($risposte_zona->risposta_default->Visible) { // risposta_default ?>
	<tr id="r_risposta_default">
		<td class="<?php echo $risposte_zona_view->TableLeftColumnClass ?>"><span id="elh_risposte_zona_risposta_default"><?php echo $risposte_zona->risposta_default->caption() ?></span></td>
		<td data-name="risposta_default"<?php echo $risposte_zona->risposta_default->cellAttributes() ?>>
<span id="el_risposte_zona_risposta_default">
<span<?php echo $risposte_zona->risposta_default->viewAttributes() ?>>
<?php echo $risposte_zona->risposta_default->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$risposte_zona_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$risposte_zona->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$risposte_zona_view->terminate();
?>