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
$comuni_view = new comuni_view();

// Run the page
$comuni_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comuni_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$comuni->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcomuniview = currentForm = new ew.Form("fcomuniview", "view");

// Form_CustomValidate event
fcomuniview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcomuniview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcomuniview.lists["x_fk_zona"] = <?php echo $comuni_view->fk_zona->Lookup->toClientList() ?>;
fcomuniview.lists["x_fk_zona"].options = <?php echo JsonEncode($comuni_view->fk_zona->lookupOptions()) ?>;
fcomuniview.lists["x_vide[]"] = <?php echo $comuni_view->vide->Lookup->toClientList() ?>;
fcomuniview.lists["x_vide[]"].options = <?php echo JsonEncode($comuni_view->vide->options(FALSE, TRUE)) ?>;
fcomuniview.lists["x_botattivo[]"] = <?php echo $comuni_view->botattivo->Lookup->toClientList() ?>;
fcomuniview.lists["x_botattivo[]"].options = <?php echo JsonEncode($comuni_view->botattivo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$comuni->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $comuni_view->ExportOptions->render("body") ?>
<?php $comuni_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $comuni_view->showPageHeader(); ?>
<?php
$comuni_view->showMessage();
?>
<form name="fcomuniview" id="fcomuniview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comuni_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comuni_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comuni">
<input type="hidden" name="modal" value="<?php echo (int)$comuni_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($comuni->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_id"><?php echo $comuni->id->caption() ?></span></td>
		<td data-name="id"<?php echo $comuni->id->cellAttributes() ?>>
<span id="el_comuni_id">
<span<?php echo $comuni->id->viewAttributes() ?>>
<?php echo $comuni->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->istat->Visible) { // istat ?>
	<tr id="r_istat">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_istat"><?php echo $comuni->istat->caption() ?></span></td>
		<td data-name="istat"<?php echo $comuni->istat->cellAttributes() ?>>
<span id="el_comuni_istat">
<span<?php echo $comuni->istat->viewAttributes() ?>>
<?php echo $comuni->istat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->toponimo->Visible) { // toponimo ?>
	<tr id="r_toponimo">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_toponimo"><?php echo $comuni->toponimo->caption() ?></span></td>
		<td data-name="toponimo"<?php echo $comuni->toponimo->cellAttributes() ?>>
<span id="el_comuni_toponimo">
<span<?php echo $comuni->toponimo->viewAttributes() ?>>
<?php echo $comuni->toponimo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->telefono->Visible) { // telefono ?>
	<tr id="r_telefono">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_telefono"><?php echo $comuni->telefono->caption() ?></span></td>
		<td data-name="telefono"<?php echo $comuni->telefono->cellAttributes() ?>>
<span id="el_comuni_telefono">
<span<?php echo $comuni->telefono->viewAttributes() ?>>
<?php echo $comuni->telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->indirizzo->Visible) { // indirizzo ?>
	<tr id="r_indirizzo">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_indirizzo"><?php echo $comuni->indirizzo->caption() ?></span></td>
		<td data-name="indirizzo"<?php echo $comuni->indirizzo->cellAttributes() ?>>
<span id="el_comuni_indirizzo">
<span<?php echo $comuni->indirizzo->viewAttributes() ?>>
<?php echo $comuni->indirizzo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->provincia->Visible) { // provincia ?>
	<tr id="r_provincia">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_provincia"><?php echo $comuni->provincia->caption() ?></span></td>
		<td data-name="provincia"<?php echo $comuni->provincia->cellAttributes() ?>>
<span id="el_comuni_provincia">
<span<?php echo $comuni->provincia->viewAttributes() ?>>
<?php echo $comuni->provincia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->avviso->Visible) { // avviso ?>
	<tr id="r_avviso">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_avviso"><?php echo $comuni->avviso->caption() ?></span></td>
		<td data-name="avviso"<?php echo $comuni->avviso->cellAttributes() ?>>
<span id="el_comuni_avviso">
<span<?php echo $comuni->avviso->viewAttributes() ?>>
<?php echo $comuni->avviso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->fk_zona->Visible) { // fk_zona ?>
	<tr id="r_fk_zona">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_fk_zona"><?php echo $comuni->fk_zona->caption() ?></span></td>
		<td data-name="fk_zona"<?php echo $comuni->fk_zona->cellAttributes() ?>>
<span id="el_comuni_fk_zona">
<span<?php echo $comuni->fk_zona->viewAttributes() ?>>
<?php echo $comuni->fk_zona->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->no_response->Visible) { // no_response ?>
	<tr id="r_no_response">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_no_response"><?php echo $comuni->no_response->caption() ?></span></td>
		<td data-name="no_response"<?php echo $comuni->no_response->cellAttributes() ?>>
<span id="el_comuni_no_response">
<span<?php echo $comuni->no_response->viewAttributes() ?>>
<?php echo $comuni->no_response->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->dominio->Visible) { // dominio ?>
	<tr id="r_dominio">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_dominio"><?php echo $comuni->dominio->caption() ?></span></td>
		<td data-name="dominio"<?php echo $comuni->dominio->cellAttributes() ?>>
<span id="el_comuni_dominio">
<span<?php echo $comuni->dominio->viewAttributes() ?>>
<?php echo $comuni->dominio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->vide->Visible) { // vide ?>
	<tr id="r_vide">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_vide"><?php echo $comuni->vide->caption() ?></span></td>
		<td data-name="vide"<?php echo $comuni->vide->cellAttributes() ?>>
<span id="el_comuni_vide">
<span<?php echo $comuni->vide->viewAttributes() ?>>
<?php if (ConvertToBool($comuni->vide->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $comuni->vide->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $comuni->vide->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->botattivo->Visible) { // botattivo ?>
	<tr id="r_botattivo">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_botattivo"><?php echo $comuni->botattivo->caption() ?></span></td>
		<td data-name="botattivo"<?php echo $comuni->botattivo->cellAttributes() ?>>
<span id="el_comuni_botattivo">
<span<?php echo $comuni->botattivo->viewAttributes() ?>>
<?php if (ConvertToBool($comuni->botattivo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $comuni->botattivo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $comuni->botattivo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->logobin->Visible) { // logobin ?>
	<tr id="r_logobin">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_logobin"><?php echo $comuni->logobin->caption() ?></span></td>
		<td data-name="logobin"<?php echo $comuni->logobin->cellAttributes() ?>>
<span id="el_comuni_logobin">
<span>
<?php echo GetFileViewTag($comuni->logobin, $comuni->logobin->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comuni->vide_url->Visible) { // vide_url ?>
	<tr id="r_vide_url">
		<td class="<?php echo $comuni_view->TableLeftColumnClass ?>"><span id="elh_comuni_vide_url"><?php echo $comuni->vide_url->caption() ?></span></td>
		<td data-name="vide_url"<?php echo $comuni->vide_url->cellAttributes() ?>>
<span id="el_comuni_vide_url">
<span<?php echo $comuni->vide_url->viewAttributes() ?>>
<?php echo $comuni->vide_url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$comuni_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$comuni->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$comuni_view->terminate();
?>