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
$comuni_list = new comuni_list();

// Run the page
$comuni_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comuni_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$comuni->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcomunilist = currentForm = new ew.Form("fcomunilist", "list");
fcomunilist.formKeyCountName = '<?php echo $comuni_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcomunilist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcomunilist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcomunilist.lists["x_fk_zona"] = <?php echo $comuni_list->fk_zona->Lookup->toClientList() ?>;
fcomunilist.lists["x_fk_zona"].options = <?php echo JsonEncode($comuni_list->fk_zona->lookupOptions()) ?>;
fcomunilist.lists["x_vide[]"] = <?php echo $comuni_list->vide->Lookup->toClientList() ?>;
fcomunilist.lists["x_vide[]"].options = <?php echo JsonEncode($comuni_list->vide->options(FALSE, TRUE)) ?>;
fcomunilist.lists["x_botattivo[]"] = <?php echo $comuni_list->botattivo->Lookup->toClientList() ?>;
fcomunilist.lists["x_botattivo[]"].options = <?php echo JsonEncode($comuni_list->botattivo->options(FALSE, TRUE)) ?>;

// Form object for search
var fcomunilistsrch = currentSearchForm = new ew.Form("fcomunilistsrch");

// Filters
fcomunilistsrch.filterList = <?php echo $comuni_list->getFilterList() ?>;

// Init search panel as collapsed
fcomunilistsrch.initSearchPanel = true;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$comuni->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($comuni_list->TotalRecs > 0 && $comuni_list->ExportOptions->visible()) { ?>
<?php $comuni_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($comuni_list->ImportOptions->visible()) { ?>
<?php $comuni_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($comuni_list->SearchOptions->visible()) { ?>
<?php $comuni_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($comuni_list->FilterOptions->visible()) { ?>
<?php $comuni_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$comuni_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$comuni->isExport() && !$comuni->CurrentAction) { ?>
<form name="fcomunilistsrch" id="fcomunilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($comuni_list->SearchWhere <> "") ? " show" : ""; ?>
<div id="fcomunilistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="comuni">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($comuni_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($comuni_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $comuni_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($comuni_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($comuni_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($comuni_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($comuni_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $comuni_list->showPageHeader(); ?>
<?php
$comuni_list->showMessage();
?>
<?php if ($comuni_list->TotalRecs > 0 || $comuni->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($comuni_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> comuni">
<?php if (!$comuni->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$comuni->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($comuni_list->Pager)) $comuni_list->Pager = new PrevNextPager($comuni_list->StartRec, $comuni_list->DisplayRecs, $comuni_list->TotalRecs, $comuni_list->AutoHidePager) ?>
<?php if ($comuni_list->Pager->RecordCount > 0 && $comuni_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($comuni_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($comuni_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $comuni_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($comuni_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($comuni_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $comuni_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($comuni_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $comuni_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $comuni_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $comuni_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $comuni_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcomunilist" id="fcomunilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comuni_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comuni_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comuni">
<div id="gmp_comuni" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($comuni_list->TotalRecs > 0 || $comuni->isGridEdit()) { ?>
<table id="tbl_comunilist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$comuni_list->RowType = ROWTYPE_HEADER;

// Render list options
$comuni_list->renderListOptions();

// Render list options (header, left)
$comuni_list->ListOptions->render("header", "left");
?>
<?php if ($comuni->id->Visible) { // id ?>
	<?php if ($comuni->sortUrl($comuni->id) == "") { ?>
		<th data-name="id" class="<?php echo $comuni->id->headerCellClass() ?>"><div id="elh_comuni_id" class="comuni_id"><div class="ew-table-header-caption"><?php echo $comuni->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $comuni->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->id) ?>',1);"><div id="elh_comuni_id" class="comuni_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($comuni->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->toponimo->Visible) { // toponimo ?>
	<?php if ($comuni->sortUrl($comuni->toponimo) == "") { ?>
		<th data-name="toponimo" class="<?php echo $comuni->toponimo->headerCellClass() ?>"><div id="elh_comuni_toponimo" class="comuni_toponimo"><div class="ew-table-header-caption"><?php echo $comuni->toponimo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="toponimo" class="<?php echo $comuni->toponimo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->toponimo) ?>',1);"><div id="elh_comuni_toponimo" class="comuni_toponimo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->toponimo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comuni->toponimo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->toponimo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->indirizzo->Visible) { // indirizzo ?>
	<?php if ($comuni->sortUrl($comuni->indirizzo) == "") { ?>
		<th data-name="indirizzo" class="<?php echo $comuni->indirizzo->headerCellClass() ?>"><div id="elh_comuni_indirizzo" class="comuni_indirizzo"><div class="ew-table-header-caption"><?php echo $comuni->indirizzo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indirizzo" class="<?php echo $comuni->indirizzo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->indirizzo) ?>',1);"><div id="elh_comuni_indirizzo" class="comuni_indirizzo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->indirizzo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comuni->indirizzo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->indirizzo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->provincia->Visible) { // provincia ?>
	<?php if ($comuni->sortUrl($comuni->provincia) == "") { ?>
		<th data-name="provincia" class="<?php echo $comuni->provincia->headerCellClass() ?>"><div id="elh_comuni_provincia" class="comuni_provincia"><div class="ew-table-header-caption"><?php echo $comuni->provincia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="provincia" class="<?php echo $comuni->provincia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->provincia) ?>',1);"><div id="elh_comuni_provincia" class="comuni_provincia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->provincia->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comuni->provincia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->provincia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->avviso->Visible) { // avviso ?>
	<?php if ($comuni->sortUrl($comuni->avviso) == "") { ?>
		<th data-name="avviso" class="<?php echo $comuni->avviso->headerCellClass() ?>"><div id="elh_comuni_avviso" class="comuni_avviso"><div class="ew-table-header-caption"><?php echo $comuni->avviso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avviso" class="<?php echo $comuni->avviso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->avviso) ?>',1);"><div id="elh_comuni_avviso" class="comuni_avviso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->avviso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comuni->avviso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->avviso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->fk_zona->Visible) { // fk_zona ?>
	<?php if ($comuni->sortUrl($comuni->fk_zona) == "") { ?>
		<th data-name="fk_zona" class="<?php echo $comuni->fk_zona->headerCellClass() ?>"><div id="elh_comuni_fk_zona" class="comuni_fk_zona"><div class="ew-table-header-caption"><?php echo $comuni->fk_zona->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fk_zona" class="<?php echo $comuni->fk_zona->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->fk_zona) ?>',1);"><div id="elh_comuni_fk_zona" class="comuni_fk_zona">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->fk_zona->caption() ?></span><span class="ew-table-header-sort"><?php if ($comuni->fk_zona->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->fk_zona->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->no_response->Visible) { // no_response ?>
	<?php if ($comuni->sortUrl($comuni->no_response) == "") { ?>
		<th data-name="no_response" class="<?php echo $comuni->no_response->headerCellClass() ?>"><div id="elh_comuni_no_response" class="comuni_no_response"><div class="ew-table-header-caption"><?php echo $comuni->no_response->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_response" class="<?php echo $comuni->no_response->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->no_response) ?>',1);"><div id="elh_comuni_no_response" class="comuni_no_response">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->no_response->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comuni->no_response->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->no_response->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->dominio->Visible) { // dominio ?>
	<?php if ($comuni->sortUrl($comuni->dominio) == "") { ?>
		<th data-name="dominio" class="<?php echo $comuni->dominio->headerCellClass() ?>"><div id="elh_comuni_dominio" class="comuni_dominio"><div class="ew-table-header-caption"><?php echo $comuni->dominio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dominio" class="<?php echo $comuni->dominio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->dominio) ?>',1);"><div id="elh_comuni_dominio" class="comuni_dominio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->dominio->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comuni->dominio->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->dominio->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->vide->Visible) { // vide ?>
	<?php if ($comuni->sortUrl($comuni->vide) == "") { ?>
		<th data-name="vide" class="<?php echo $comuni->vide->headerCellClass() ?>"><div id="elh_comuni_vide" class="comuni_vide"><div class="ew-table-header-caption"><?php echo $comuni->vide->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="vide" class="<?php echo $comuni->vide->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->vide) ?>',1);"><div id="elh_comuni_vide" class="comuni_vide">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->vide->caption() ?></span><span class="ew-table-header-sort"><?php if ($comuni->vide->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->vide->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->botattivo->Visible) { // botattivo ?>
	<?php if ($comuni->sortUrl($comuni->botattivo) == "") { ?>
		<th data-name="botattivo" class="<?php echo $comuni->botattivo->headerCellClass() ?>"><div id="elh_comuni_botattivo" class="comuni_botattivo"><div class="ew-table-header-caption"><?php echo $comuni->botattivo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="botattivo" class="<?php echo $comuni->botattivo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->botattivo) ?>',1);"><div id="elh_comuni_botattivo" class="comuni_botattivo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->botattivo->caption() ?></span><span class="ew-table-header-sort"><?php if ($comuni->botattivo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->botattivo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comuni->vide_url->Visible) { // vide_url ?>
	<?php if ($comuni->sortUrl($comuni->vide_url) == "") { ?>
		<th data-name="vide_url" class="<?php echo $comuni->vide_url->headerCellClass() ?>"><div id="elh_comuni_vide_url" class="comuni_vide_url"><div class="ew-table-header-caption"><?php echo $comuni->vide_url->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="vide_url" class="<?php echo $comuni->vide_url->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comuni->SortUrl($comuni->vide_url) ?>',1);"><div id="elh_comuni_vide_url" class="comuni_vide_url">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comuni->vide_url->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comuni->vide_url->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comuni->vide_url->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$comuni_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($comuni->ExportAll && $comuni->isExport()) {
	$comuni_list->StopRec = $comuni_list->TotalRecs;
} else {

	// Set the last record to display
	if ($comuni_list->TotalRecs > $comuni_list->StartRec + $comuni_list->DisplayRecs - 1)
		$comuni_list->StopRec = $comuni_list->StartRec + $comuni_list->DisplayRecs - 1;
	else
		$comuni_list->StopRec = $comuni_list->TotalRecs;
}
$comuni_list->RecCnt = $comuni_list->StartRec - 1;
if ($comuni_list->Recordset && !$comuni_list->Recordset->EOF) {
	$comuni_list->Recordset->moveFirst();
	$selectLimit = $comuni_list->UseSelectLimit;
	if (!$selectLimit && $comuni_list->StartRec > 1)
		$comuni_list->Recordset->move($comuni_list->StartRec - 1);
} elseif (!$comuni->AllowAddDeleteRow && $comuni_list->StopRec == 0) {
	$comuni_list->StopRec = $comuni->GridAddRowCount;
}

// Initialize aggregate
$comuni->RowType = ROWTYPE_AGGREGATEINIT;
$comuni->resetAttributes();
$comuni_list->renderRow();
while ($comuni_list->RecCnt < $comuni_list->StopRec) {
	$comuni_list->RecCnt++;
	if ($comuni_list->RecCnt >= $comuni_list->StartRec) {
		$comuni_list->RowCnt++;

		// Set up key count
		$comuni_list->KeyCount = $comuni_list->RowIndex;

		// Init row class and style
		$comuni->resetAttributes();
		$comuni->CssClass = "";
		if ($comuni->isGridAdd()) {
		} else {
			$comuni_list->loadRowValues($comuni_list->Recordset); // Load row values
		}
		$comuni->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$comuni->RowAttrs = array_merge($comuni->RowAttrs, array('data-rowindex'=>$comuni_list->RowCnt, 'id'=>'r' . $comuni_list->RowCnt . '_comuni', 'data-rowtype'=>$comuni->RowType));

		// Render row
		$comuni_list->renderRow();

		// Render list options
		$comuni_list->renderListOptions();
?>
	<tr<?php echo $comuni->rowAttributes() ?>>
<?php

// Render list options (body, left)
$comuni_list->ListOptions->render("body", "left", $comuni_list->RowCnt);
?>
	<?php if ($comuni->id->Visible) { // id ?>
		<td data-name="id"<?php echo $comuni->id->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_id" class="comuni_id">
<span<?php echo $comuni->id->viewAttributes() ?>>
<?php echo $comuni->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->toponimo->Visible) { // toponimo ?>
		<td data-name="toponimo"<?php echo $comuni->toponimo->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_toponimo" class="comuni_toponimo">
<span<?php echo $comuni->toponimo->viewAttributes() ?>>
<?php echo $comuni->toponimo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->indirizzo->Visible) { // indirizzo ?>
		<td data-name="indirizzo"<?php echo $comuni->indirizzo->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_indirizzo" class="comuni_indirizzo">
<span<?php echo $comuni->indirizzo->viewAttributes() ?>>
<?php echo $comuni->indirizzo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->provincia->Visible) { // provincia ?>
		<td data-name="provincia"<?php echo $comuni->provincia->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_provincia" class="comuni_provincia">
<span<?php echo $comuni->provincia->viewAttributes() ?>>
<?php echo $comuni->provincia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->avviso->Visible) { // avviso ?>
		<td data-name="avviso"<?php echo $comuni->avviso->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_avviso" class="comuni_avviso">
<span<?php echo $comuni->avviso->viewAttributes() ?>>
<?php echo $comuni->avviso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->fk_zona->Visible) { // fk_zona ?>
		<td data-name="fk_zona"<?php echo $comuni->fk_zona->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_fk_zona" class="comuni_fk_zona">
<span<?php echo $comuni->fk_zona->viewAttributes() ?>>
<?php echo $comuni->fk_zona->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->no_response->Visible) { // no_response ?>
		<td data-name="no_response"<?php echo $comuni->no_response->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_no_response" class="comuni_no_response">
<span<?php echo $comuni->no_response->viewAttributes() ?>>
<?php echo $comuni->no_response->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->dominio->Visible) { // dominio ?>
		<td data-name="dominio"<?php echo $comuni->dominio->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_dominio" class="comuni_dominio">
<span<?php echo $comuni->dominio->viewAttributes() ?>>
<?php echo $comuni->dominio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->vide->Visible) { // vide ?>
		<td data-name="vide"<?php echo $comuni->vide->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_vide" class="comuni_vide">
<span<?php echo $comuni->vide->viewAttributes() ?>>
<?php if (ConvertToBool($comuni->vide->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $comuni->vide->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $comuni->vide->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->botattivo->Visible) { // botattivo ?>
		<td data-name="botattivo"<?php echo $comuni->botattivo->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_botattivo" class="comuni_botattivo">
<span<?php echo $comuni->botattivo->viewAttributes() ?>>
<?php if (ConvertToBool($comuni->botattivo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $comuni->botattivo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $comuni->botattivo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($comuni->vide_url->Visible) { // vide_url ?>
		<td data-name="vide_url"<?php echo $comuni->vide_url->cellAttributes() ?>>
<span id="el<?php echo $comuni_list->RowCnt ?>_comuni_vide_url" class="comuni_vide_url">
<span<?php echo $comuni->vide_url->viewAttributes() ?>>
<?php echo $comuni->vide_url->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$comuni_list->ListOptions->render("body", "right", $comuni_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$comuni->isGridAdd())
		$comuni_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$comuni->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($comuni_list->Recordset)
	$comuni_list->Recordset->Close();
?>
<?php if (!$comuni->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$comuni->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($comuni_list->Pager)) $comuni_list->Pager = new PrevNextPager($comuni_list->StartRec, $comuni_list->DisplayRecs, $comuni_list->TotalRecs, $comuni_list->AutoHidePager) ?>
<?php if ($comuni_list->Pager->RecordCount > 0 && $comuni_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($comuni_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($comuni_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $comuni_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($comuni_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($comuni_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $comuni_list->pageUrl() ?>start=<?php echo $comuni_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $comuni_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($comuni_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $comuni_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $comuni_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $comuni_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $comuni_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($comuni_list->TotalRecs == 0 && !$comuni->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $comuni_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$comuni_list->showPageFooter();
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
$comuni_list->terminate();
?>