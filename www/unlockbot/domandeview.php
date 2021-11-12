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
$domande_view = new domande_view();

// Run the page
$domande_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$domande_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$domande->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdomandeview = currentForm = new ew.Form("fdomandeview", "view");

// Form_CustomValidate event
fdomandeview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdomandeview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdomandeview.lists["x_fk_categoria"] = <?php echo $domande_view->fk_categoria->Lookup->toClientList() ?>;
fdomandeview.lists["x_fk_categoria"].options = <?php echo JsonEncode($domande_view->fk_categoria->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$domande->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $domande_view->ExportOptions->render("body") ?>
<?php $domande_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $domande_view->showPageHeader(); ?>
<?php
$domande_view->showMessage();
?>
<form name="fdomandeview" id="fdomandeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($domande_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $domande_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="domande">
<input type="hidden" name="modal" value="<?php echo (int)$domande_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($domande->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $domande_view->TableLeftColumnClass ?>"><span id="elh_domande_id"><?php echo $domande->id->caption() ?></span></td>
		<td data-name="id"<?php echo $domande->id->cellAttributes() ?>>
<span id="el_domande_id">
<span<?php echo $domande->id->viewAttributes() ?>>
<?php echo $domande->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($domande->domanda->Visible) { // domanda ?>
	<tr id="r_domanda">
		<td class="<?php echo $domande_view->TableLeftColumnClass ?>"><span id="elh_domande_domanda"><?php echo $domande->domanda->caption() ?></span></td>
		<td data-name="domanda"<?php echo $domande->domanda->cellAttributes() ?>>
<span id="el_domande_domanda">
<span<?php echo $domande->domanda->viewAttributes() ?>>
<?php echo $domande->domanda->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($domande->risposta_default->Visible) { // risposta_default ?>
	<tr id="r_risposta_default">
		<td class="<?php echo $domande_view->TableLeftColumnClass ?>"><span id="elh_domande_risposta_default"><?php echo $domande->risposta_default->caption() ?></span></td>
		<td data-name="risposta_default"<?php echo $domande->risposta_default->cellAttributes() ?>>
<span id="el_domande_risposta_default">
<span<?php echo $domande->risposta_default->viewAttributes() ?>>
<?php echo $domande->risposta_default->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($domande->fk_categoria->Visible) { // fk_categoria ?>
	<tr id="r_fk_categoria">
		<td class="<?php echo $domande_view->TableLeftColumnClass ?>"><span id="elh_domande_fk_categoria"><?php echo $domande->fk_categoria->caption() ?></span></td>
		<td data-name="fk_categoria"<?php echo $domande->fk_categoria->cellAttributes() ?>>
<span id="el_domande_fk_categoria">
<span<?php echo $domande->fk_categoria->viewAttributes() ?>>
<?php echo $domande->fk_categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$domande_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$domande->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$domande_view->terminate();
?>