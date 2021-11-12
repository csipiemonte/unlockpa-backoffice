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
$zone_list = new zone_list();

// Run the page
$zone_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$zone_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$zone->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fzonelist = currentForm = new ew.Form("fzonelist", "list");
fzonelist.formKeyCountName = '<?php echo $zone_list->FormKeyCountName ?>';

// Form_CustomValidate event
fzonelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fzonelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$zone->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($zone_list->TotalRecs > 0 && $zone_list->ExportOptions->visible()) { ?>
<?php $zone_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($zone_list->ImportOptions->visible()) { ?>
<?php $zone_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$zone_list->renderOtherOptions();
?>
<?php $zone_list->showPageHeader(); ?>
<?php
$zone_list->showMessage();
?>
<?php if ($zone_list->TotalRecs > 0 || $zone->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($zone_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> zone">
<?php if (!$zone->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$zone->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($zone_list->Pager)) $zone_list->Pager = new PrevNextPager($zone_list->StartRec, $zone_list->DisplayRecs, $zone_list->TotalRecs, $zone_list->AutoHidePager) ?>
<?php if ($zone_list->Pager->RecordCount > 0 && $zone_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($zone_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($zone_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $zone_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($zone_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($zone_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $zone_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($zone_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $zone_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $zone_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $zone_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $zone_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fzonelist" id="fzonelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($zone_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $zone_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="zone">
<div id="gmp_zone" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($zone_list->TotalRecs > 0 || $zone->isGridEdit()) { ?>
<table id="tbl_zonelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$zone_list->RowType = ROWTYPE_HEADER;

// Render list options
$zone_list->renderListOptions();

// Render list options (header, left)
$zone_list->ListOptions->render("header", "left");
?>
<?php if ($zone->id->Visible) { // id ?>
	<?php if ($zone->sortUrl($zone->id) == "") { ?>
		<th data-name="id" class="<?php echo $zone->id->headerCellClass() ?>"><div id="elh_zone_id" class="zone_id"><div class="ew-table-header-caption"><?php echo $zone->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $zone->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $zone->SortUrl($zone->id) ?>',1);"><div id="elh_zone_id" class="zone_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $zone->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($zone->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($zone->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($zone->zona->Visible) { // zona ?>
	<?php if ($zone->sortUrl($zone->zona) == "") { ?>
		<th data-name="zona" class="<?php echo $zone->zona->headerCellClass() ?>"><div id="elh_zone_zona" class="zone_zona"><div class="ew-table-header-caption"><?php echo $zone->zona->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="zona" class="<?php echo $zone->zona->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $zone->SortUrl($zone->zona) ?>',1);"><div id="elh_zone_zona" class="zone_zona">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $zone->zona->caption() ?></span><span class="ew-table-header-sort"><?php if ($zone->zona->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($zone->zona->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$zone_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($zone->ExportAll && $zone->isExport()) {
	$zone_list->StopRec = $zone_list->TotalRecs;
} else {

	// Set the last record to display
	if ($zone_list->TotalRecs > $zone_list->StartRec + $zone_list->DisplayRecs - 1)
		$zone_list->StopRec = $zone_list->StartRec + $zone_list->DisplayRecs - 1;
	else
		$zone_list->StopRec = $zone_list->TotalRecs;
}
$zone_list->RecCnt = $zone_list->StartRec - 1;
if ($zone_list->Recordset && !$zone_list->Recordset->EOF) {
	$zone_list->Recordset->moveFirst();
	$selectLimit = $zone_list->UseSelectLimit;
	if (!$selectLimit && $zone_list->StartRec > 1)
		$zone_list->Recordset->move($zone_list->StartRec - 1);
} elseif (!$zone->AllowAddDeleteRow && $zone_list->StopRec == 0) {
	$zone_list->StopRec = $zone->GridAddRowCount;
}

// Initialize aggregate
$zone->RowType = ROWTYPE_AGGREGATEINIT;
$zone->resetAttributes();
$zone_list->renderRow();
while ($zone_list->RecCnt < $zone_list->StopRec) {
	$zone_list->RecCnt++;
	if ($zone_list->RecCnt >= $zone_list->StartRec) {
		$zone_list->RowCnt++;

		// Set up key count
		$zone_list->KeyCount = $zone_list->RowIndex;

		// Init row class and style
		$zone->resetAttributes();
		$zone->CssClass = "";
		if ($zone->isGridAdd()) {
		} else {
			$zone_list->loadRowValues($zone_list->Recordset); // Load row values
		}
		$zone->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$zone->RowAttrs = array_merge($zone->RowAttrs, array('data-rowindex'=>$zone_list->RowCnt, 'id'=>'r' . $zone_list->RowCnt . '_zone', 'data-rowtype'=>$zone->RowType));

		// Render row
		$zone_list->renderRow();

		// Render list options
		$zone_list->renderListOptions();
?>
	<tr<?php echo $zone->rowAttributes() ?>>
<?php

// Render list options (body, left)
$zone_list->ListOptions->render("body", "left", $zone_list->RowCnt);
?>
	<?php if ($zone->id->Visible) { // id ?>
		<td data-name="id"<?php echo $zone->id->cellAttributes() ?>>
<span id="el<?php echo $zone_list->RowCnt ?>_zone_id" class="zone_id">
<span<?php echo $zone->id->viewAttributes() ?>>
<?php echo $zone->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($zone->zona->Visible) { // zona ?>
		<td data-name="zona"<?php echo $zone->zona->cellAttributes() ?>>
<span id="el<?php echo $zone_list->RowCnt ?>_zone_zona" class="zone_zona">
<span<?php echo $zone->zona->viewAttributes() ?>>
<?php echo $zone->zona->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$zone_list->ListOptions->render("body", "right", $zone_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$zone->isGridAdd())
		$zone_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$zone->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($zone_list->Recordset)
	$zone_list->Recordset->Close();
?>
<?php if (!$zone->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$zone->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($zone_list->Pager)) $zone_list->Pager = new PrevNextPager($zone_list->StartRec, $zone_list->DisplayRecs, $zone_list->TotalRecs, $zone_list->AutoHidePager) ?>
<?php if ($zone_list->Pager->RecordCount > 0 && $zone_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($zone_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($zone_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $zone_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($zone_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($zone_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $zone_list->pageUrl() ?>start=<?php echo $zone_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $zone_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($zone_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $zone_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $zone_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $zone_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $zone_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($zone_list->TotalRecs == 0 && !$zone->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $zone_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$zone_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$zone->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$zone_list->terminate();
?>