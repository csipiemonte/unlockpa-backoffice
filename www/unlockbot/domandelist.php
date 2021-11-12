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
$domande_list = new domande_list();

// Run the page
$domande_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$domande_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$domande->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdomandelist = currentForm = new ew.Form("fdomandelist", "list");
fdomandelist.formKeyCountName = '<?php echo $domande_list->FormKeyCountName ?>';

// Form_CustomValidate event
fdomandelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdomandelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdomandelist.lists["x_fk_categoria"] = <?php echo $domande_list->fk_categoria->Lookup->toClientList() ?>;
fdomandelist.lists["x_fk_categoria"].options = <?php echo JsonEncode($domande_list->fk_categoria->lookupOptions()) ?>;

// Form object for search
var fdomandelistsrch = currentSearchForm = new ew.Form("fdomandelistsrch");

// Filters
fdomandelistsrch.filterList = <?php echo $domande_list->getFilterList() ?>;

// Init search panel as collapsed
fdomandelistsrch.initSearchPanel = true;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$domande->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($domande_list->TotalRecs > 0 && $domande_list->ExportOptions->visible()) { ?>
<?php $domande_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($domande_list->ImportOptions->visible()) { ?>
<?php $domande_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($domande_list->SearchOptions->visible()) { ?>
<?php $domande_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($domande_list->FilterOptions->visible()) { ?>
<?php $domande_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$domande_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$domande->isExport() && !$domande->CurrentAction) { ?>
<form name="fdomandelistsrch" id="fdomandelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($domande_list->SearchWhere <> "") ? " show" : ""; ?>
<div id="fdomandelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="domande">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($domande_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($domande_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $domande_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($domande_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($domande_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($domande_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($domande_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $domande_list->showPageHeader(); ?>
<?php
$domande_list->showMessage();
?>
<?php if ($domande_list->TotalRecs > 0 || $domande->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($domande_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> domande">
<?php if (!$domande->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$domande->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($domande_list->Pager)) $domande_list->Pager = new PrevNextPager($domande_list->StartRec, $domande_list->DisplayRecs, $domande_list->TotalRecs, $domande_list->AutoHidePager) ?>
<?php if ($domande_list->Pager->RecordCount > 0 && $domande_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($domande_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($domande_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $domande_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($domande_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($domande_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $domande_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($domande_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $domande_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $domande_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $domande_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $domande_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdomandelist" id="fdomandelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($domande_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $domande_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="domande">
<div id="gmp_domande" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($domande_list->TotalRecs > 0 || $domande->isGridEdit()) { ?>
<table id="tbl_domandelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$domande_list->RowType = ROWTYPE_HEADER;

// Render list options
$domande_list->renderListOptions();

// Render list options (header, left)
$domande_list->ListOptions->render("header", "left");
?>
<?php if ($domande->id->Visible) { // id ?>
	<?php if ($domande->sortUrl($domande->id) == "") { ?>
		<th data-name="id" class="<?php echo $domande->id->headerCellClass() ?>"><div id="elh_domande_id" class="domande_id"><div class="ew-table-header-caption"><?php echo $domande->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $domande->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $domande->SortUrl($domande->id) ?>',1);"><div id="elh_domande_id" class="domande_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $domande->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($domande->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($domande->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($domande->domanda->Visible) { // domanda ?>
	<?php if ($domande->sortUrl($domande->domanda) == "") { ?>
		<th data-name="domanda" class="<?php echo $domande->domanda->headerCellClass() ?>"><div id="elh_domande_domanda" class="domande_domanda"><div class="ew-table-header-caption"><?php echo $domande->domanda->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="domanda" class="<?php echo $domande->domanda->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $domande->SortUrl($domande->domanda) ?>',1);"><div id="elh_domande_domanda" class="domande_domanda">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $domande->domanda->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($domande->domanda->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($domande->domanda->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($domande->risposta_default->Visible) { // risposta_default ?>
	<?php if ($domande->sortUrl($domande->risposta_default) == "") { ?>
		<th data-name="risposta_default" class="<?php echo $domande->risposta_default->headerCellClass() ?>"><div id="elh_domande_risposta_default" class="domande_risposta_default"><div class="ew-table-header-caption"><?php echo $domande->risposta_default->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="risposta_default" class="<?php echo $domande->risposta_default->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $domande->SortUrl($domande->risposta_default) ?>',1);"><div id="elh_domande_risposta_default" class="domande_risposta_default">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $domande->risposta_default->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($domande->risposta_default->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($domande->risposta_default->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($domande->fk_categoria->Visible) { // fk_categoria ?>
	<?php if ($domande->sortUrl($domande->fk_categoria) == "") { ?>
		<th data-name="fk_categoria" class="<?php echo $domande->fk_categoria->headerCellClass() ?>"><div id="elh_domande_fk_categoria" class="domande_fk_categoria"><div class="ew-table-header-caption"><?php echo $domande->fk_categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fk_categoria" class="<?php echo $domande->fk_categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $domande->SortUrl($domande->fk_categoria) ?>',1);"><div id="elh_domande_fk_categoria" class="domande_fk_categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $domande->fk_categoria->caption() ?></span><span class="ew-table-header-sort"><?php if ($domande->fk_categoria->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($domande->fk_categoria->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$domande_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($domande->ExportAll && $domande->isExport()) {
	$domande_list->StopRec = $domande_list->TotalRecs;
} else {

	// Set the last record to display
	if ($domande_list->TotalRecs > $domande_list->StartRec + $domande_list->DisplayRecs - 1)
		$domande_list->StopRec = $domande_list->StartRec + $domande_list->DisplayRecs - 1;
	else
		$domande_list->StopRec = $domande_list->TotalRecs;
}
$domande_list->RecCnt = $domande_list->StartRec - 1;
if ($domande_list->Recordset && !$domande_list->Recordset->EOF) {
	$domande_list->Recordset->moveFirst();
	$selectLimit = $domande_list->UseSelectLimit;
	if (!$selectLimit && $domande_list->StartRec > 1)
		$domande_list->Recordset->move($domande_list->StartRec - 1);
} elseif (!$domande->AllowAddDeleteRow && $domande_list->StopRec == 0) {
	$domande_list->StopRec = $domande->GridAddRowCount;
}

// Initialize aggregate
$domande->RowType = ROWTYPE_AGGREGATEINIT;
$domande->resetAttributes();
$domande_list->renderRow();
while ($domande_list->RecCnt < $domande_list->StopRec) {
	$domande_list->RecCnt++;
	if ($domande_list->RecCnt >= $domande_list->StartRec) {
		$domande_list->RowCnt++;

		// Set up key count
		$domande_list->KeyCount = $domande_list->RowIndex;

		// Init row class and style
		$domande->resetAttributes();
		$domande->CssClass = "";
		if ($domande->isGridAdd()) {
		} else {
			$domande_list->loadRowValues($domande_list->Recordset); // Load row values
		}
		$domande->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$domande->RowAttrs = array_merge($domande->RowAttrs, array('data-rowindex'=>$domande_list->RowCnt, 'id'=>'r' . $domande_list->RowCnt . '_domande', 'data-rowtype'=>$domande->RowType));

		// Render row
		$domande_list->renderRow();

		// Render list options
		$domande_list->renderListOptions();
?>
	<tr<?php echo $domande->rowAttributes() ?>>
<?php

// Render list options (body, left)
$domande_list->ListOptions->render("body", "left", $domande_list->RowCnt);
?>
	<?php if ($domande->id->Visible) { // id ?>
		<td data-name="id"<?php echo $domande->id->cellAttributes() ?>>
<span id="el<?php echo $domande_list->RowCnt ?>_domande_id" class="domande_id">
<span<?php echo $domande->id->viewAttributes() ?>>
<?php echo $domande->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($domande->domanda->Visible) { // domanda ?>
		<td data-name="domanda"<?php echo $domande->domanda->cellAttributes() ?>>
<span id="el<?php echo $domande_list->RowCnt ?>_domande_domanda" class="domande_domanda">
<span<?php echo $domande->domanda->viewAttributes() ?>>
<?php echo $domande->domanda->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($domande->risposta_default->Visible) { // risposta_default ?>
		<td data-name="risposta_default"<?php echo $domande->risposta_default->cellAttributes() ?>>
<span id="el<?php echo $domande_list->RowCnt ?>_domande_risposta_default" class="domande_risposta_default">
<span<?php echo $domande->risposta_default->viewAttributes() ?>>
<?php echo $domande->risposta_default->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($domande->fk_categoria->Visible) { // fk_categoria ?>
		<td data-name="fk_categoria"<?php echo $domande->fk_categoria->cellAttributes() ?>>
<span id="el<?php echo $domande_list->RowCnt ?>_domande_fk_categoria" class="domande_fk_categoria">
<span<?php echo $domande->fk_categoria->viewAttributes() ?>>
<?php echo $domande->fk_categoria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$domande_list->ListOptions->render("body", "right", $domande_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$domande->isGridAdd())
		$domande_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$domande->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($domande_list->Recordset)
	$domande_list->Recordset->Close();
?>
<?php if (!$domande->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$domande->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($domande_list->Pager)) $domande_list->Pager = new PrevNextPager($domande_list->StartRec, $domande_list->DisplayRecs, $domande_list->TotalRecs, $domande_list->AutoHidePager) ?>
<?php if ($domande_list->Pager->RecordCount > 0 && $domande_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($domande_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($domande_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $domande_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($domande_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($domande_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $domande_list->pageUrl() ?>start=<?php echo $domande_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $domande_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($domande_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $domande_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $domande_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $domande_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $domande_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($domande_list->TotalRecs == 0 && !$domande->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $domande_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$domande_list->showPageFooter();
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
$domande_list->terminate();
?>