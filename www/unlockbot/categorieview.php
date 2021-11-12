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
$categorie_view = new categorie_view();

// Run the page
$categorie_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorie_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$categorie->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcategorieview = currentForm = new ew.Form("fcategorieview", "view");

// Form_CustomValidate event
fcategorieview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorieview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$categorie->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $categorie_view->ExportOptions->render("body") ?>
<?php $categorie_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $categorie_view->showPageHeader(); ?>
<?php
$categorie_view->showMessage();
?>
<form name="fcategorieview" id="fcategorieview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorie_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorie_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorie">
<input type="hidden" name="modal" value="<?php echo (int)$categorie_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($categorie->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $categorie_view->TableLeftColumnClass ?>"><span id="elh_categorie_id"><?php echo $categorie->id->caption() ?></span></td>
		<td data-name="id"<?php echo $categorie->id->cellAttributes() ?>>
<span id="el_categorie_id">
<span<?php echo $categorie->id->viewAttributes() ?>>
<?php echo $categorie->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categorie->categoria->Visible) { // categoria ?>
	<tr id="r_categoria">
		<td class="<?php echo $categorie_view->TableLeftColumnClass ?>"><span id="elh_categorie_categoria"><?php echo $categorie->categoria->caption() ?></span></td>
		<td data-name="categoria"<?php echo $categorie->categoria->cellAttributes() ?>>
<span id="el_categorie_categoria">
<span<?php echo $categorie->categoria->viewAttributes() ?>>
<?php echo $categorie->categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$categorie_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$categorie->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$categorie_view->terminate();
?>