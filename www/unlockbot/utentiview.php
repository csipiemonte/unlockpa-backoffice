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
$utenti_view = new utenti_view();

// Run the page
$utenti_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$utenti_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$utenti->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var futentiview = currentForm = new ew.Form("futentiview", "view");

// Form_CustomValidate event
futentiview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
futentiview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
futentiview.lists["x_status"] = <?php echo $utenti_view->status->Lookup->toClientList() ?>;
futentiview.lists["x_status"].options = <?php echo JsonEncode($utenti_view->status->options(FALSE, TRUE)) ?>;
futentiview.lists["x_userlevel"] = <?php echo $utenti_view->userlevel->Lookup->toClientList() ?>;
futentiview.lists["x_userlevel"].options = <?php echo JsonEncode($utenti_view->userlevel->lookupOptions()) ?>;
futentiview.lists["x_fk_comune"] = <?php echo $utenti_view->fk_comune->Lookup->toClientList() ?>;
futentiview.lists["x_fk_comune"].options = <?php echo JsonEncode($utenti_view->fk_comune->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$utenti->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $utenti_view->ExportOptions->render("body") ?>
<?php $utenti_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $utenti_view->showPageHeader(); ?>
<?php
$utenti_view->showMessage();
?>
<form name="futentiview" id="futentiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($utenti_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $utenti_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="utenti">
<input type="hidden" name="modal" value="<?php echo (int)$utenti_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($utenti->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $utenti_view->TableLeftColumnClass ?>"><span id="elh_utenti_id"><?php echo $utenti->id->caption() ?></span></td>
		<td data-name="id"<?php echo $utenti->id->cellAttributes() ?>>
<span id="el_utenti_id">
<span<?php echo $utenti->id->viewAttributes() ?>>
<?php echo $utenti->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($utenti->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $utenti_view->TableLeftColumnClass ?>"><span id="elh_utenti_name"><?php echo $utenti->name->caption() ?></span></td>
		<td data-name="name"<?php echo $utenti->name->cellAttributes() ?>>
<span id="el_utenti_name">
<span<?php echo $utenti->name->viewAttributes() ?>>
<?php echo $utenti->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($utenti->pass->Visible) { // pass ?>
	<tr id="r_pass">
		<td class="<?php echo $utenti_view->TableLeftColumnClass ?>"><span id="elh_utenti_pass"><?php echo $utenti->pass->caption() ?></span></td>
		<td data-name="pass"<?php echo $utenti->pass->cellAttributes() ?>>
<span id="el_utenti_pass">
<span<?php echo $utenti->pass->viewAttributes() ?>>
<?php echo $utenti->pass->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($utenti->mail->Visible) { // mail ?>
	<tr id="r_mail">
		<td class="<?php echo $utenti_view->TableLeftColumnClass ?>"><span id="elh_utenti_mail"><?php echo $utenti->mail->caption() ?></span></td>
		<td data-name="mail"<?php echo $utenti->mail->cellAttributes() ?>>
<span id="el_utenti_mail">
<span<?php echo $utenti->mail->viewAttributes() ?>>
<?php echo $utenti->mail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($utenti->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $utenti_view->TableLeftColumnClass ?>"><span id="elh_utenti_status"><?php echo $utenti->status->caption() ?></span></td>
		<td data-name="status"<?php echo $utenti->status->cellAttributes() ?>>
<span id="el_utenti_status">
<span<?php echo $utenti->status->viewAttributes() ?>>
<?php echo $utenti->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($utenti->userlevel->Visible) { // userlevel ?>
	<tr id="r_userlevel">
		<td class="<?php echo $utenti_view->TableLeftColumnClass ?>"><span id="elh_utenti_userlevel"><?php echo $utenti->userlevel->caption() ?></span></td>
		<td data-name="userlevel"<?php echo $utenti->userlevel->cellAttributes() ?>>
<span id="el_utenti_userlevel">
<span<?php echo $utenti->userlevel->viewAttributes() ?>>
<?php echo $utenti->userlevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($utenti->fk_comune->Visible) { // fk_comune ?>
	<tr id="r_fk_comune">
		<td class="<?php echo $utenti_view->TableLeftColumnClass ?>"><span id="elh_utenti_fk_comune"><?php echo $utenti->fk_comune->caption() ?></span></td>
		<td data-name="fk_comune"<?php echo $utenti->fk_comune->cellAttributes() ?>>
<span id="el_utenti_fk_comune">
<span<?php echo $utenti->fk_comune->viewAttributes() ?>>
<?php echo $utenti->fk_comune->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$utenti_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$utenti->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$utenti_view->terminate();
?>