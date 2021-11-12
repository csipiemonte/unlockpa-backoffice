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
$utenti_list = new utenti_list();

// Run the page
$utenti_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$utenti_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$utenti->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var futentilist = currentForm = new ew.Form("futentilist", "list");
futentilist.formKeyCountName = '<?php echo $utenti_list->FormKeyCountName ?>';

// Form_CustomValidate event
futentilist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
futentilist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
futentilist.lists["x_status"] = <?php echo $utenti_list->status->Lookup->toClientList() ?>;
futentilist.lists["x_status"].options = <?php echo JsonEncode($utenti_list->status->options(FALSE, TRUE)) ?>;
futentilist.lists["x_userlevel"] = <?php echo $utenti_list->userlevel->Lookup->toClientList() ?>;
futentilist.lists["x_userlevel"].options = <?php echo JsonEncode($utenti_list->userlevel->lookupOptions()) ?>;
futentilist.lists["x_fk_comune"] = <?php echo $utenti_list->fk_comune->Lookup->toClientList() ?>;
futentilist.lists["x_fk_comune"].options = <?php echo JsonEncode($utenti_list->fk_comune->lookupOptions()) ?>;

// Form object for search
var futentilistsrch = currentSearchForm = new ew.Form("futentilistsrch");

// Validate function for search
futentilistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
futentilistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
futentilistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
futentilistsrch.lists["x_userlevel"] = <?php echo $utenti_list->userlevel->Lookup->toClientList() ?>;
futentilistsrch.lists["x_userlevel"].options = <?php echo JsonEncode($utenti_list->userlevel->lookupOptions()) ?>;

// Filters
futentilistsrch.filterList = <?php echo $utenti_list->getFilterList() ?>;

// Init search panel as collapsed
futentilistsrch.initSearchPanel = true;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$utenti->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($utenti_list->TotalRecs > 0 && $utenti_list->ExportOptions->visible()) { ?>
<?php $utenti_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($utenti_list->ImportOptions->visible()) { ?>
<?php $utenti_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($utenti_list->SearchOptions->visible()) { ?>
<?php $utenti_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($utenti_list->FilterOptions->visible()) { ?>
<?php $utenti_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$utenti_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$utenti->isExport() && !$utenti->CurrentAction) { ?>
<form name="futentilistsrch" id="futentilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($utenti_list->SearchWhere <> "") ? " show" : ""; ?>
<div id="futentilistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="utenti">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$utenti_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$utenti->RowType = ROWTYPE_SEARCH;

// Render row
$utenti->resetAttributes();
$utenti_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($utenti->userlevel->Visible) { // userlevel ?>
	<div id="xsc_userlevel" class="ew-cell form-group">
		<label for="x_userlevel" class="ew-search-caption ew-label"><?php echo $utenti->userlevel->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_userlevel" id="z_userlevel" value="="></span>
		<span class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($utenti->userlevel->EditValue) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="utenti" data-field="x_userlevel" data-value-separator="<?php echo $utenti->userlevel->displayValueSeparatorAttribute() ?>" id="x_userlevel" name="x_userlevel"<?php echo $utenti->userlevel->editAttributes() ?>>
		<?php echo $utenti->userlevel->selectOptionListHtml("x_userlevel") ?>
	</select>
</div>
<?php echo $utenti->userlevel->Lookup->getParamTag("p_x_userlevel") ?>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($utenti_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($utenti_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $utenti_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($utenti_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($utenti_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($utenti_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($utenti_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $utenti_list->showPageHeader(); ?>
<?php
$utenti_list->showMessage();
?>
<?php if ($utenti_list->TotalRecs > 0 || $utenti->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($utenti_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> utenti">
<?php if (!$utenti->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$utenti->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($utenti_list->Pager)) $utenti_list->Pager = new PrevNextPager($utenti_list->StartRec, $utenti_list->DisplayRecs, $utenti_list->TotalRecs, $utenti_list->AutoHidePager) ?>
<?php if ($utenti_list->Pager->RecordCount > 0 && $utenti_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($utenti_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($utenti_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $utenti_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($utenti_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($utenti_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $utenti_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($utenti_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $utenti_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $utenti_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $utenti_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $utenti_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="futentilist" id="futentilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($utenti_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $utenti_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="utenti">
<div id="gmp_utenti" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($utenti_list->TotalRecs > 0 || $utenti->isGridEdit()) { ?>
<table id="tbl_utentilist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$utenti_list->RowType = ROWTYPE_HEADER;

// Render list options
$utenti_list->renderListOptions();

// Render list options (header, left)
$utenti_list->ListOptions->render("header", "left");
?>
<?php if ($utenti->id->Visible) { // id ?>
	<?php if ($utenti->sortUrl($utenti->id) == "") { ?>
		<th data-name="id" class="<?php echo $utenti->id->headerCellClass() ?>"><div id="elh_utenti_id" class="utenti_id"><div class="ew-table-header-caption"><?php echo $utenti->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $utenti->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $utenti->SortUrl($utenti->id) ?>',1);"><div id="elh_utenti_id" class="utenti_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $utenti->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($utenti->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($utenti->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($utenti->name->Visible) { // name ?>
	<?php if ($utenti->sortUrl($utenti->name) == "") { ?>
		<th data-name="name" class="<?php echo $utenti->name->headerCellClass() ?>"><div id="elh_utenti_name" class="utenti_name"><div class="ew-table-header-caption"><?php echo $utenti->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $utenti->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $utenti->SortUrl($utenti->name) ?>',1);"><div id="elh_utenti_name" class="utenti_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $utenti->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($utenti->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($utenti->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($utenti->pass->Visible) { // pass ?>
	<?php if ($utenti->sortUrl($utenti->pass) == "") { ?>
		<th data-name="pass" class="<?php echo $utenti->pass->headerCellClass() ?>"><div id="elh_utenti_pass" class="utenti_pass"><div class="ew-table-header-caption"><?php echo $utenti->pass->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pass" class="<?php echo $utenti->pass->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $utenti->SortUrl($utenti->pass) ?>',1);"><div id="elh_utenti_pass" class="utenti_pass">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $utenti->pass->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($utenti->pass->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($utenti->pass->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($utenti->mail->Visible) { // mail ?>
	<?php if ($utenti->sortUrl($utenti->mail) == "") { ?>
		<th data-name="mail" class="<?php echo $utenti->mail->headerCellClass() ?>"><div id="elh_utenti_mail" class="utenti_mail"><div class="ew-table-header-caption"><?php echo $utenti->mail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mail" class="<?php echo $utenti->mail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $utenti->SortUrl($utenti->mail) ?>',1);"><div id="elh_utenti_mail" class="utenti_mail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $utenti->mail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($utenti->mail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($utenti->mail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($utenti->status->Visible) { // status ?>
	<?php if ($utenti->sortUrl($utenti->status) == "") { ?>
		<th data-name="status" class="<?php echo $utenti->status->headerCellClass() ?>"><div id="elh_utenti_status" class="utenti_status"><div class="ew-table-header-caption"><?php echo $utenti->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $utenti->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $utenti->SortUrl($utenti->status) ?>',1);"><div id="elh_utenti_status" class="utenti_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $utenti->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($utenti->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($utenti->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($utenti->userlevel->Visible) { // userlevel ?>
	<?php if ($utenti->sortUrl($utenti->userlevel) == "") { ?>
		<th data-name="userlevel" class="<?php echo $utenti->userlevel->headerCellClass() ?>"><div id="elh_utenti_userlevel" class="utenti_userlevel"><div class="ew-table-header-caption"><?php echo $utenti->userlevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevel" class="<?php echo $utenti->userlevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $utenti->SortUrl($utenti->userlevel) ?>',1);"><div id="elh_utenti_userlevel" class="utenti_userlevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $utenti->userlevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($utenti->userlevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($utenti->userlevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($utenti->fk_comune->Visible) { // fk_comune ?>
	<?php if ($utenti->sortUrl($utenti->fk_comune) == "") { ?>
		<th data-name="fk_comune" class="<?php echo $utenti->fk_comune->headerCellClass() ?>"><div id="elh_utenti_fk_comune" class="utenti_fk_comune"><div class="ew-table-header-caption"><?php echo $utenti->fk_comune->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fk_comune" class="<?php echo $utenti->fk_comune->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $utenti->SortUrl($utenti->fk_comune) ?>',1);"><div id="elh_utenti_fk_comune" class="utenti_fk_comune">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $utenti->fk_comune->caption() ?></span><span class="ew-table-header-sort"><?php if ($utenti->fk_comune->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($utenti->fk_comune->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$utenti_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($utenti->ExportAll && $utenti->isExport()) {
	$utenti_list->StopRec = $utenti_list->TotalRecs;
} else {

	// Set the last record to display
	if ($utenti_list->TotalRecs > $utenti_list->StartRec + $utenti_list->DisplayRecs - 1)
		$utenti_list->StopRec = $utenti_list->StartRec + $utenti_list->DisplayRecs - 1;
	else
		$utenti_list->StopRec = $utenti_list->TotalRecs;
}
$utenti_list->RecCnt = $utenti_list->StartRec - 1;
if ($utenti_list->Recordset && !$utenti_list->Recordset->EOF) {
	$utenti_list->Recordset->moveFirst();
	$selectLimit = $utenti_list->UseSelectLimit;
	if (!$selectLimit && $utenti_list->StartRec > 1)
		$utenti_list->Recordset->move($utenti_list->StartRec - 1);
} elseif (!$utenti->AllowAddDeleteRow && $utenti_list->StopRec == 0) {
	$utenti_list->StopRec = $utenti->GridAddRowCount;
}

// Initialize aggregate
$utenti->RowType = ROWTYPE_AGGREGATEINIT;
$utenti->resetAttributes();
$utenti_list->renderRow();
while ($utenti_list->RecCnt < $utenti_list->StopRec) {
	$utenti_list->RecCnt++;
	if ($utenti_list->RecCnt >= $utenti_list->StartRec) {
		$utenti_list->RowCnt++;

		// Set up key count
		$utenti_list->KeyCount = $utenti_list->RowIndex;

		// Init row class and style
		$utenti->resetAttributes();
		$utenti->CssClass = "";
		if ($utenti->isGridAdd()) {
		} else {
			$utenti_list->loadRowValues($utenti_list->Recordset); // Load row values
		}
		$utenti->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$utenti->RowAttrs = array_merge($utenti->RowAttrs, array('data-rowindex'=>$utenti_list->RowCnt, 'id'=>'r' . $utenti_list->RowCnt . '_utenti', 'data-rowtype'=>$utenti->RowType));

		// Render row
		$utenti_list->renderRow();

		// Render list options
		$utenti_list->renderListOptions();
?>
	<tr<?php echo $utenti->rowAttributes() ?>>
<?php

// Render list options (body, left)
$utenti_list->ListOptions->render("body", "left", $utenti_list->RowCnt);
?>
	<?php if ($utenti->id->Visible) { // id ?>
		<td data-name="id"<?php echo $utenti->id->cellAttributes() ?>>
<span id="el<?php echo $utenti_list->RowCnt ?>_utenti_id" class="utenti_id">
<span<?php echo $utenti->id->viewAttributes() ?>>
<?php echo $utenti->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($utenti->name->Visible) { // name ?>
		<td data-name="name"<?php echo $utenti->name->cellAttributes() ?>>
<span id="el<?php echo $utenti_list->RowCnt ?>_utenti_name" class="utenti_name">
<span<?php echo $utenti->name->viewAttributes() ?>>
<?php echo $utenti->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($utenti->pass->Visible) { // pass ?>
		<td data-name="pass"<?php echo $utenti->pass->cellAttributes() ?>>
<span id="el<?php echo $utenti_list->RowCnt ?>_utenti_pass" class="utenti_pass">
<span<?php echo $utenti->pass->viewAttributes() ?>>
<?php echo $utenti->pass->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($utenti->mail->Visible) { // mail ?>
		<td data-name="mail"<?php echo $utenti->mail->cellAttributes() ?>>
<span id="el<?php echo $utenti_list->RowCnt ?>_utenti_mail" class="utenti_mail">
<span<?php echo $utenti->mail->viewAttributes() ?>>
<?php echo $utenti->mail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($utenti->status->Visible) { // status ?>
		<td data-name="status"<?php echo $utenti->status->cellAttributes() ?>>
<span id="el<?php echo $utenti_list->RowCnt ?>_utenti_status" class="utenti_status">
<span<?php echo $utenti->status->viewAttributes() ?>>
<?php echo $utenti->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($utenti->userlevel->Visible) { // userlevel ?>
		<td data-name="userlevel"<?php echo $utenti->userlevel->cellAttributes() ?>>
<span id="el<?php echo $utenti_list->RowCnt ?>_utenti_userlevel" class="utenti_userlevel">
<span<?php echo $utenti->userlevel->viewAttributes() ?>>
<?php echo $utenti->userlevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($utenti->fk_comune->Visible) { // fk_comune ?>
		<td data-name="fk_comune"<?php echo $utenti->fk_comune->cellAttributes() ?>>
<span id="el<?php echo $utenti_list->RowCnt ?>_utenti_fk_comune" class="utenti_fk_comune">
<span<?php echo $utenti->fk_comune->viewAttributes() ?>>
<?php echo $utenti->fk_comune->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$utenti_list->ListOptions->render("body", "right", $utenti_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$utenti->isGridAdd())
		$utenti_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$utenti->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($utenti_list->Recordset)
	$utenti_list->Recordset->Close();
?>
<?php if (!$utenti->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$utenti->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($utenti_list->Pager)) $utenti_list->Pager = new PrevNextPager($utenti_list->StartRec, $utenti_list->DisplayRecs, $utenti_list->TotalRecs, $utenti_list->AutoHidePager) ?>
<?php if ($utenti_list->Pager->RecordCount > 0 && $utenti_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($utenti_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($utenti_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $utenti_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($utenti_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($utenti_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $utenti_list->pageUrl() ?>start=<?php echo $utenti_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $utenti_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($utenti_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $utenti_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $utenti_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $utenti_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $utenti_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($utenti_list->TotalRecs == 0 && !$utenti->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $utenti_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$utenti_list->showPageFooter();
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
$utenti_list->terminate();
?>