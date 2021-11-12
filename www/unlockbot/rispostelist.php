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
$risposte_list = new risposte_list();

// Run the page
$risposte_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$risposte_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$risposte->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var frispostelist = currentForm = new ew.Form("frispostelist", "list");
frispostelist.formKeyCountName = '<?php echo $risposte_list->FormKeyCountName ?>';

// Validate form
frispostelist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($risposte_list->id_comune->Required) { ?>
			elm = this.getElements("x" + infix + "_id_comune");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->id_comune->caption(), $risposte->id_comune->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_list->domanda->Required) { ?>
			elm = this.getElements("x" + infix + "_domanda");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->domanda->caption(), $risposte->domanda->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_list->risposta->Required) { ?>
			elm = this.getElements("x" + infix + "_risposta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->risposta->caption(), $risposte->risposta->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_list->validato->Required) { ?>
			elm = this.getElements("x" + infix + "_validato[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->validato->caption(), $risposte->validato->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($risposte_list->categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte->categoria->caption(), $risposte->categoria->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
frispostelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frispostelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frispostelist.lists["x_id_comune"] = <?php echo $risposte_list->id_comune->Lookup->toClientList() ?>;
frispostelist.lists["x_id_comune"].options = <?php echo JsonEncode($risposte_list->id_comune->lookupOptions()) ?>;
frispostelist.autoSuggests["x_id_comune"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
frispostelist.lists["x_validato[]"] = <?php echo $risposte_list->validato->Lookup->toClientList() ?>;
frispostelist.lists["x_validato[]"].options = <?php echo JsonEncode($risposte_list->validato->options(FALSE, TRUE)) ?>;

// Form object for search
var frispostelistsrch = currentSearchForm = new ew.Form("frispostelistsrch");

// Filters
frispostelistsrch.filterList = <?php echo $risposte_list->getFilterList() ?>;

// Init search panel as collapsed
frispostelistsrch.initSearchPanel = true;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$risposte->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($risposte_list->TotalRecs > 0 && $risposte_list->ExportOptions->visible()) { ?>
<?php $risposte_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($risposte_list->ImportOptions->visible()) { ?>
<?php $risposte_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($risposte_list->SearchOptions->visible()) { ?>
<?php $risposte_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($risposte_list->FilterOptions->visible()) { ?>
<?php $risposte_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$risposte_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$risposte->isExport() && !$risposte->CurrentAction) { ?>
<form name="frispostelistsrch" id="frispostelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($risposte_list->SearchWhere <> "") ? " show" : ""; ?>
<div id="frispostelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="risposte">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($risposte_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($risposte_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $risposte_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($risposte_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($risposte_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($risposte_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($risposte_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $risposte_list->showPageHeader(); ?>
<?php
$risposte_list->showMessage();
?>
<?php if ($risposte_list->TotalRecs > 0 || $risposte->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($risposte_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> risposte">
<?php if (!$risposte->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$risposte->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($risposte_list->Pager)) $risposte_list->Pager = new PrevNextPager($risposte_list->StartRec, $risposte_list->DisplayRecs, $risposte_list->TotalRecs, $risposte_list->AutoHidePager) ?>
<?php if ($risposte_list->Pager->RecordCount > 0 && $risposte_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($risposte_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($risposte_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $risposte_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($risposte_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($risposte_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $risposte_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($risposte_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $risposte_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $risposte_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $risposte_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $risposte_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frispostelist" id="frispostelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($risposte_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $risposte_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="risposte">
<div id="gmp_risposte" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($risposte_list->TotalRecs > 0 || $risposte->isGridEdit()) { ?>
<table id="tbl_rispostelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$risposte_list->RowType = ROWTYPE_HEADER;

// Render list options
$risposte_list->renderListOptions();

// Render list options (header, left)
$risposte_list->ListOptions->render("header", "left");
?>
<?php if ($risposte->id_comune->Visible) { // id_comune ?>
	<?php if ($risposte->sortUrl($risposte->id_comune) == "") { ?>
		<th data-name="id_comune" class="<?php echo $risposte->id_comune->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_risposte_id_comune" class="risposte_id_comune"><div class="ew-table-header-caption"><?php echo $risposte->id_comune->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_comune" class="<?php echo $risposte->id_comune->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte->SortUrl($risposte->id_comune) ?>',1);"><div id="elh_risposte_id_comune" class="risposte_id_comune">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte->id_comune->caption() ?></span><span class="ew-table-header-sort"><?php if ($risposte->id_comune->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte->id_comune->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($risposte->domanda->Visible) { // domanda ?>
	<?php if ($risposte->sortUrl($risposte->domanda) == "") { ?>
		<th data-name="domanda" class="<?php echo $risposte->domanda->headerCellClass() ?>"><div id="elh_risposte_domanda" class="risposte_domanda"><div class="ew-table-header-caption"><?php echo $risposte->domanda->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="domanda" class="<?php echo $risposte->domanda->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte->SortUrl($risposte->domanda) ?>',1);"><div id="elh_risposte_domanda" class="risposte_domanda">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte->domanda->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($risposte->domanda->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte->domanda->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($risposte->risposta->Visible) { // risposta ?>
	<?php if ($risposte->sortUrl($risposte->risposta) == "") { ?>
		<th data-name="risposta" class="<?php echo $risposte->risposta->headerCellClass() ?>"><div id="elh_risposte_risposta" class="risposte_risposta"><div class="ew-table-header-caption"><?php echo $risposte->risposta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="risposta" class="<?php echo $risposte->risposta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte->SortUrl($risposte->risposta) ?>',1);"><div id="elh_risposte_risposta" class="risposte_risposta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte->risposta->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($risposte->risposta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte->risposta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($risposte->validato->Visible) { // validato ?>
	<?php if ($risposte->sortUrl($risposte->validato) == "") { ?>
		<th data-name="validato" class="<?php echo $risposte->validato->headerCellClass() ?>"><div id="elh_risposte_validato" class="risposte_validato"><div class="ew-table-header-caption"><?php echo $risposte->validato->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="validato" class="<?php echo $risposte->validato->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte->SortUrl($risposte->validato) ?>',1);"><div id="elh_risposte_validato" class="risposte_validato">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte->validato->caption() ?></span><span class="ew-table-header-sort"><?php if ($risposte->validato->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte->validato->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($risposte->categoria->Visible) { // categoria ?>
	<?php if ($risposte->sortUrl($risposte->categoria) == "") { ?>
		<th data-name="categoria" class="<?php echo $risposte->categoria->headerCellClass() ?>"><div id="elh_risposte_categoria" class="risposte_categoria"><div class="ew-table-header-caption"><?php echo $risposte->categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="categoria" class="<?php echo $risposte->categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte->SortUrl($risposte->categoria) ?>',1);"><div id="elh_risposte_categoria" class="risposte_categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte->categoria->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($risposte->categoria->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte->categoria->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$risposte_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($risposte->ExportAll && $risposte->isExport()) {
	$risposte_list->StopRec = $risposte_list->TotalRecs;
} else {

	// Set the last record to display
	if ($risposte_list->TotalRecs > $risposte_list->StartRec + $risposte_list->DisplayRecs - 1)
		$risposte_list->StopRec = $risposte_list->StartRec + $risposte_list->DisplayRecs - 1;
	else
		$risposte_list->StopRec = $risposte_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $risposte_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($risposte_list->FormKeyCountName) && ($risposte->isGridAdd() || $risposte->isGridEdit() || $risposte->isConfirm())) {
		$risposte_list->KeyCount = $CurrentForm->getValue($risposte_list->FormKeyCountName);
		$risposte_list->StopRec = $risposte_list->StartRec + $risposte_list->KeyCount - 1;
	}
}
$risposte_list->RecCnt = $risposte_list->StartRec - 1;
if ($risposte_list->Recordset && !$risposte_list->Recordset->EOF) {
	$risposte_list->Recordset->moveFirst();
	$selectLimit = $risposte_list->UseSelectLimit;
	if (!$selectLimit && $risposte_list->StartRec > 1)
		$risposte_list->Recordset->move($risposte_list->StartRec - 1);
} elseif (!$risposte->AllowAddDeleteRow && $risposte_list->StopRec == 0) {
	$risposte_list->StopRec = $risposte->GridAddRowCount;
}

// Initialize aggregate
$risposte->RowType = ROWTYPE_AGGREGATEINIT;
$risposte->resetAttributes();
$risposte_list->renderRow();
if ($risposte->isGridEdit())
	$risposte_list->RowIndex = 0;
while ($risposte_list->RecCnt < $risposte_list->StopRec) {
	$risposte_list->RecCnt++;
	if ($risposte_list->RecCnt >= $risposte_list->StartRec) {
		$risposte_list->RowCnt++;
		if ($risposte->isGridAdd() || $risposte->isGridEdit() || $risposte->isConfirm()) {
			$risposte_list->RowIndex++;
			$CurrentForm->Index = $risposte_list->RowIndex;
			if ($CurrentForm->hasValue($risposte_list->FormActionName) && $risposte_list->EventCancelled)
				$risposte_list->RowAction = strval($CurrentForm->getValue($risposte_list->FormActionName));
			elseif ($risposte->isGridAdd())
				$risposte_list->RowAction = "insert";
			else
				$risposte_list->RowAction = "";
		}

		// Set up key count
		$risposte_list->KeyCount = $risposte_list->RowIndex;

		// Init row class and style
		$risposte->resetAttributes();
		$risposte->CssClass = "";
		if ($risposte->isGridAdd()) {
			$risposte_list->loadRowValues(); // Load default values
		} else {
			$risposte_list->loadRowValues($risposte_list->Recordset); // Load row values
		}
		$risposte->RowType = ROWTYPE_VIEW; // Render view
		if ($risposte->isGridEdit()) { // Grid edit
			if ($risposte->EventCancelled)
				$risposte_list->restoreCurrentRowFormValues($risposte_list->RowIndex); // Restore form values
			if ($risposte_list->RowAction == "insert")
				$risposte->RowType = ROWTYPE_ADD; // Render add
			else
				$risposte->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($risposte->isGridEdit() && ($risposte->RowType == ROWTYPE_EDIT || $risposte->RowType == ROWTYPE_ADD) && $risposte->EventCancelled) // Update failed
			$risposte_list->restoreCurrentRowFormValues($risposte_list->RowIndex); // Restore form values
		if ($risposte->RowType == ROWTYPE_EDIT) // Edit row
			$risposte_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$risposte->RowAttrs = array_merge($risposte->RowAttrs, array('data-rowindex'=>$risposte_list->RowCnt, 'id'=>'r' . $risposte_list->RowCnt . '_risposte', 'data-rowtype'=>$risposte->RowType));

		// Render row
		$risposte_list->renderRow();

		// Render list options
		$risposte_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($risposte_list->RowAction <> "delete" && $risposte_list->RowAction <> "insertdelete" && !($risposte_list->RowAction == "insert" && $risposte->isConfirm() && $risposte_list->emptyRow())) {
?>
	<tr<?php echo $risposte->rowAttributes() ?>>
<?php

// Render list options (body, left)
$risposte_list->ListOptions->render("body", "left", $risposte_list->RowCnt);
?>
	<?php if ($risposte->id_comune->Visible) { // id_comune ?>
		<td data-name="id_comune"<?php echo $risposte->id_comune->cellAttributes() ?>>
<?php if ($risposte->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_id_comune" class="form-group risposte_id_comune">
<?php
$wrkonchange = "" . trim(@$risposte->id_comune->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$risposte->id_comune->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $risposte_list->RowIndex ?>_id_comune" class="text-nowrap" style="z-index: <?php echo (9000 - $risposte_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $risposte_list->RowIndex ?>_id_comune" id="sv_x<?php echo $risposte_list->RowIndex ?>_id_comune" value="<?php echo RemoveHtml($risposte->id_comune->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($risposte->id_comune->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($risposte->id_comune->getPlaceHolder()) ?>"<?php echo $risposte->id_comune->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte" data-field="x_id_comune" data-value-separator="<?php echo $risposte->id_comune->displayValueSeparatorAttribute() ?>" name="x<?php echo $risposte_list->RowIndex ?>_id_comune" id="x<?php echo $risposte_list->RowIndex ?>_id_comune" value="<?php echo HtmlEncode($risposte->id_comune->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
frispostelist.createAutoSuggest({"id":"x<?php echo $risposte_list->RowIndex ?>_id_comune","forceSelect":false});
</script>
<?php echo $risposte->id_comune->Lookup->getParamTag("p_x" . $risposte_list->RowIndex . "_id_comune") ?>
</span>
<input type="hidden" data-table="risposte" data-field="x_id_comune" name="o<?php echo $risposte_list->RowIndex ?>_id_comune" id="o<?php echo $risposte_list->RowIndex ?>_id_comune" value="<?php echo HtmlEncode($risposte->id_comune->OldValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_id_comune" class="form-group risposte_id_comune">
<span<?php echo $risposte->id_comune->viewAttributes() ?>>
<?php if ((!EmptyString($risposte->id_comune->TooltipValue)) && $risposte->id_comune->linkAttributes() <> "") { ?>
<a<?php echo $risposte->id_comune->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->id_comune->EditValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->id_comune->EditValue) ?>">
<?php } ?>
<span id="tt_risposte_x<?php echo $risposte_list->RowCnt ?>_id_comune" class="d-none">
<?php echo $risposte->id_comune->TooltipValue ?>
</span></span>
</span>
<input type="hidden" data-table="risposte" data-field="x_id_comune" name="x<?php echo $risposte_list->RowIndex ?>_id_comune" id="x<?php echo $risposte_list->RowIndex ?>_id_comune" value="<?php echo HtmlEncode($risposte->id_comune->CurrentValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_id_comune" class="risposte_id_comune">
<span<?php echo $risposte->id_comune->viewAttributes() ?>>
<?php if ((!EmptyString($risposte->id_comune->TooltipValue)) && $risposte->id_comune->linkAttributes() <> "") { ?>
<a<?php echo $risposte->id_comune->linkAttributes() ?>><?php echo $risposte->id_comune->getViewValue() ?></a>
<?php } else { ?>
<?php echo $risposte->id_comune->getViewValue() ?>
<?php } ?>
<span id="tt_risposte_x<?php echo $risposte_list->RowCnt ?>_id_comune" class="d-none">
<?php echo $risposte->id_comune->TooltipValue ?>
</span></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="risposte" data-field="x_id_domanda" name="x<?php echo $risposte_list->RowIndex ?>_id_domanda" id="x<?php echo $risposte_list->RowIndex ?>_id_domanda" value="<?php echo HtmlEncode($risposte->id_domanda->CurrentValue) ?>">
<input type="hidden" data-table="risposte" data-field="x_id_domanda" name="o<?php echo $risposte_list->RowIndex ?>_id_domanda" id="o<?php echo $risposte_list->RowIndex ?>_id_domanda" value="<?php echo HtmlEncode($risposte->id_domanda->OldValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_EDIT || $risposte->CurrentMode == "edit") { ?>
<input type="hidden" data-table="risposte" data-field="x_id_domanda" name="x<?php echo $risposte_list->RowIndex ?>_id_domanda" id="x<?php echo $risposte_list->RowIndex ?>_id_domanda" value="<?php echo HtmlEncode($risposte->id_domanda->CurrentValue) ?>">
<?php } ?>
	<?php if ($risposte->domanda->Visible) { // domanda ?>
		<td data-name="domanda"<?php echo $risposte->domanda->cellAttributes() ?>>
<?php if ($risposte->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_domanda" class="form-group risposte_domanda">
<textarea data-table="risposte" data-field="x_domanda" name="x<?php echo $risposte_list->RowIndex ?>_domanda" id="x<?php echo $risposte_list->RowIndex ?>_domanda" cols="35" rows="4" placeholder="<?php echo HtmlEncode($risposte->domanda->getPlaceHolder()) ?>"<?php echo $risposte->domanda->editAttributes() ?>><?php echo $risposte->domanda->EditValue ?></textarea>
</span>
<input type="hidden" data-table="risposte" data-field="x_domanda" name="o<?php echo $risposte_list->RowIndex ?>_domanda" id="o<?php echo $risposte_list->RowIndex ?>_domanda" value="<?php echo HtmlEncode($risposte->domanda->OldValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_domanda" class="form-group risposte_domanda">
<span<?php echo $risposte->domanda->viewAttributes() ?>>
<?php echo $risposte->domanda->EditValue ?></span>
</span>
<input type="hidden" data-table="risposte" data-field="x_domanda" name="x<?php echo $risposte_list->RowIndex ?>_domanda" id="x<?php echo $risposte_list->RowIndex ?>_domanda" value="<?php echo HtmlEncode($risposte->domanda->CurrentValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_domanda" class="risposte_domanda">
<span<?php echo $risposte->domanda->viewAttributes() ?>>
<?php echo $risposte->domanda->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($risposte->risposta->Visible) { // risposta ?>
		<td data-name="risposta"<?php echo $risposte->risposta->cellAttributes() ?>>
<?php if ($risposte->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_risposta" class="form-group risposte_risposta">
<textarea data-table="risposte" data-field="x_risposta" name="x<?php echo $risposte_list->RowIndex ?>_risposta" id="x<?php echo $risposte_list->RowIndex ?>_risposta" cols="80" rows="6" placeholder="<?php echo HtmlEncode($risposte->risposta->getPlaceHolder()) ?>"<?php echo $risposte->risposta->editAttributes() ?>><?php echo $risposte->risposta->EditValue ?></textarea>
</span>
<input type="hidden" data-table="risposte" data-field="x_risposta" name="o<?php echo $risposte_list->RowIndex ?>_risposta" id="o<?php echo $risposte_list->RowIndex ?>_risposta" value="<?php echo HtmlEncode($risposte->risposta->OldValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_risposta" class="form-group risposte_risposta">
<textarea data-table="risposte" data-field="x_risposta" name="x<?php echo $risposte_list->RowIndex ?>_risposta" id="x<?php echo $risposte_list->RowIndex ?>_risposta" cols="80" rows="6" placeholder="<?php echo HtmlEncode($risposte->risposta->getPlaceHolder()) ?>"<?php echo $risposte->risposta->editAttributes() ?>><?php echo $risposte->risposta->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_risposta" class="risposte_risposta">
<span<?php echo $risposte->risposta->viewAttributes() ?>>
<?php echo $risposte->risposta->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($risposte->validato->Visible) { // validato ?>
		<td data-name="validato"<?php echo $risposte->validato->cellAttributes() ?>>
<?php if ($risposte->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_validato" class="form-group risposte_validato">
<?php
$selwrk = (ConvertToBool($risposte->validato->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="risposte" data-field="x_validato" name="x<?php echo $risposte_list->RowIndex ?>_validato[]" id="x<?php echo $risposte_list->RowIndex ?>_validato[]" value="1"<?php echo $selwrk ?><?php echo $risposte->validato->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte" data-field="x_validato" name="o<?php echo $risposte_list->RowIndex ?>_validato[]" id="o<?php echo $risposte_list->RowIndex ?>_validato[]" value="<?php echo HtmlEncode($risposte->validato->OldValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_validato" class="form-group risposte_validato">
<?php
$selwrk = (ConvertToBool($risposte->validato->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="risposte" data-field="x_validato" name="x<?php echo $risposte_list->RowIndex ?>_validato[]" id="x<?php echo $risposte_list->RowIndex ?>_validato[]" value="1"<?php echo $selwrk ?><?php echo $risposte->validato->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_validato" class="risposte_validato">
<span<?php echo $risposte->validato->viewAttributes() ?>>
<?php if (ConvertToBool($risposte->validato->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $risposte->validato->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $risposte->validato->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($risposte->categoria->Visible) { // categoria ?>
		<td data-name="categoria"<?php echo $risposte->categoria->cellAttributes() ?>>
<?php if ($risposte->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_categoria" class="form-group risposte_categoria">
<input type="text" data-table="risposte" data-field="x_categoria" name="x<?php echo $risposte_list->RowIndex ?>_categoria" id="x<?php echo $risposte_list->RowIndex ?>_categoria" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($risposte->categoria->getPlaceHolder()) ?>" value="<?php echo $risposte->categoria->EditValue ?>"<?php echo $risposte->categoria->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte" data-field="x_categoria" name="o<?php echo $risposte_list->RowIndex ?>_categoria" id="o<?php echo $risposte_list->RowIndex ?>_categoria" value="<?php echo HtmlEncode($risposte->categoria->OldValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_categoria" class="form-group risposte_categoria">
<span<?php echo $risposte->categoria->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte->categoria->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="risposte" data-field="x_categoria" name="x<?php echo $risposte_list->RowIndex ?>_categoria" id="x<?php echo $risposte_list->RowIndex ?>_categoria" value="<?php echo HtmlEncode($risposte->categoria->CurrentValue) ?>">
<?php } ?>
<?php if ($risposte->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_list->RowCnt ?>_risposte_categoria" class="risposte_categoria">
<span<?php echo $risposte->categoria->viewAttributes() ?>>
<?php echo $risposte->categoria->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$risposte_list->ListOptions->render("body", "right", $risposte_list->RowCnt);
?>
	</tr>
<?php if ($risposte->RowType == ROWTYPE_ADD || $risposte->RowType == ROWTYPE_EDIT) { ?>
<script>
frispostelist.updateLists(<?php echo $risposte_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$risposte->isGridAdd())
		if (!$risposte_list->Recordset->EOF)
			$risposte_list->Recordset->moveNext();
}
?>
<?php
	if ($risposte->isGridAdd() || $risposte->isGridEdit()) {
		$risposte_list->RowIndex = '$rowindex$';
		$risposte_list->loadRowValues();

		// Set row properties
		$risposte->resetAttributes();
		$risposte->RowAttrs = array_merge($risposte->RowAttrs, array('data-rowindex'=>$risposte_list->RowIndex, 'id'=>'r0_risposte', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($risposte->RowAttrs["class"], "ew-template");
		$risposte->RowType = ROWTYPE_ADD;

		// Render row
		$risposte_list->renderRow();

		// Render list options
		$risposte_list->renderListOptions();
		$risposte_list->StartRowCnt = 0;
?>
	<tr<?php echo $risposte->rowAttributes() ?>>
<?php

// Render list options (body, left)
$risposte_list->ListOptions->render("body", "left", $risposte_list->RowIndex);
?>
	<?php if ($risposte->id_comune->Visible) { // id_comune ?>
		<td data-name="id_comune">
<span id="el$rowindex$_risposte_id_comune" class="form-group risposte_id_comune">
<?php
$wrkonchange = "" . trim(@$risposte->id_comune->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$risposte->id_comune->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $risposte_list->RowIndex ?>_id_comune" class="text-nowrap" style="z-index: <?php echo (9000 - $risposte_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $risposte_list->RowIndex ?>_id_comune" id="sv_x<?php echo $risposte_list->RowIndex ?>_id_comune" value="<?php echo RemoveHtml($risposte->id_comune->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($risposte->id_comune->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($risposte->id_comune->getPlaceHolder()) ?>"<?php echo $risposte->id_comune->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte" data-field="x_id_comune" data-value-separator="<?php echo $risposte->id_comune->displayValueSeparatorAttribute() ?>" name="x<?php echo $risposte_list->RowIndex ?>_id_comune" id="x<?php echo $risposte_list->RowIndex ?>_id_comune" value="<?php echo HtmlEncode($risposte->id_comune->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
frispostelist.createAutoSuggest({"id":"x<?php echo $risposte_list->RowIndex ?>_id_comune","forceSelect":false});
</script>
<?php echo $risposte->id_comune->Lookup->getParamTag("p_x" . $risposte_list->RowIndex . "_id_comune") ?>
</span>
<input type="hidden" data-table="risposte" data-field="x_id_comune" name="o<?php echo $risposte_list->RowIndex ?>_id_comune" id="o<?php echo $risposte_list->RowIndex ?>_id_comune" value="<?php echo HtmlEncode($risposte->id_comune->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($risposte->domanda->Visible) { // domanda ?>
		<td data-name="domanda">
<span id="el$rowindex$_risposte_domanda" class="form-group risposte_domanda">
<textarea data-table="risposte" data-field="x_domanda" name="x<?php echo $risposte_list->RowIndex ?>_domanda" id="x<?php echo $risposte_list->RowIndex ?>_domanda" cols="35" rows="4" placeholder="<?php echo HtmlEncode($risposte->domanda->getPlaceHolder()) ?>"<?php echo $risposte->domanda->editAttributes() ?>><?php echo $risposte->domanda->EditValue ?></textarea>
</span>
<input type="hidden" data-table="risposte" data-field="x_domanda" name="o<?php echo $risposte_list->RowIndex ?>_domanda" id="o<?php echo $risposte_list->RowIndex ?>_domanda" value="<?php echo HtmlEncode($risposte->domanda->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($risposte->risposta->Visible) { // risposta ?>
		<td data-name="risposta">
<span id="el$rowindex$_risposte_risposta" class="form-group risposte_risposta">
<textarea data-table="risposte" data-field="x_risposta" name="x<?php echo $risposte_list->RowIndex ?>_risposta" id="x<?php echo $risposte_list->RowIndex ?>_risposta" cols="80" rows="6" placeholder="<?php echo HtmlEncode($risposte->risposta->getPlaceHolder()) ?>"<?php echo $risposte->risposta->editAttributes() ?>><?php echo $risposte->risposta->EditValue ?></textarea>
</span>
<input type="hidden" data-table="risposte" data-field="x_risposta" name="o<?php echo $risposte_list->RowIndex ?>_risposta" id="o<?php echo $risposte_list->RowIndex ?>_risposta" value="<?php echo HtmlEncode($risposte->risposta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($risposte->validato->Visible) { // validato ?>
		<td data-name="validato">
<span id="el$rowindex$_risposte_validato" class="form-group risposte_validato">
<?php
$selwrk = (ConvertToBool($risposte->validato->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="risposte" data-field="x_validato" name="x<?php echo $risposte_list->RowIndex ?>_validato[]" id="x<?php echo $risposte_list->RowIndex ?>_validato[]" value="1"<?php echo $selwrk ?><?php echo $risposte->validato->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte" data-field="x_validato" name="o<?php echo $risposte_list->RowIndex ?>_validato[]" id="o<?php echo $risposte_list->RowIndex ?>_validato[]" value="<?php echo HtmlEncode($risposte->validato->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($risposte->categoria->Visible) { // categoria ?>
		<td data-name="categoria">
<span id="el$rowindex$_risposte_categoria" class="form-group risposte_categoria">
<input type="text" data-table="risposte" data-field="x_categoria" name="x<?php echo $risposte_list->RowIndex ?>_categoria" id="x<?php echo $risposte_list->RowIndex ?>_categoria" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($risposte->categoria->getPlaceHolder()) ?>" value="<?php echo $risposte->categoria->EditValue ?>"<?php echo $risposte->categoria->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte" data-field="x_categoria" name="o<?php echo $risposte_list->RowIndex ?>_categoria" id="o<?php echo $risposte_list->RowIndex ?>_categoria" value="<?php echo HtmlEncode($risposte->categoria->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$risposte_list->ListOptions->render("body", "right", $risposte_list->RowIndex);
?>
<script>
frispostelist.updateLists(<?php echo $risposte_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($risposte->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $risposte_list->FormKeyCountName ?>" id="<?php echo $risposte_list->FormKeyCountName ?>" value="<?php echo $risposte_list->KeyCount ?>">
<?php echo $risposte_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$risposte->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($risposte_list->Recordset)
	$risposte_list->Recordset->Close();
?>
<?php if (!$risposte->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$risposte->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($risposte_list->Pager)) $risposte_list->Pager = new PrevNextPager($risposte_list->StartRec, $risposte_list->DisplayRecs, $risposte_list->TotalRecs, $risposte_list->AutoHidePager) ?>
<?php if ($risposte_list->Pager->RecordCount > 0 && $risposte_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($risposte_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($risposte_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $risposte_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($risposte_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($risposte_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $risposte_list->pageUrl() ?>start=<?php echo $risposte_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $risposte_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($risposte_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $risposte_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $risposte_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $risposte_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $risposte_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($risposte_list->TotalRecs == 0 && !$risposte->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $risposte_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$risposte_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$risposte->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$risposte_list->terminate();
?>