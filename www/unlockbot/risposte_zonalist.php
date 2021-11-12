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
$risposte_zona_list = new risposte_zona_list();

// Run the page
$risposte_zona_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$risposte_zona_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$risposte_zona->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var frisposte_zonalist = currentForm = new ew.Form("frisposte_zonalist", "list");
frisposte_zonalist.formKeyCountName = '<?php echo $risposte_zona_list->FormKeyCountName ?>';

// Validate form
frisposte_zonalist.validate = function() {
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
		<?php if ($risposte_zona_list->id_domanda->Required) { ?>
			elm = this.getElements("x" + infix + "_id_domanda");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte_zona->id_domanda->caption(), $risposte_zona->id_domanda->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_domanda");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($risposte_zona->id_domanda->errorMessage()) ?>");
		<?php if ($risposte_zona_list->id_zona->Required) { ?>
			elm = this.getElements("x" + infix + "_id_zona");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte_zona->id_zona->caption(), $risposte_zona->id_zona->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_zona");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($risposte_zona->id_zona->errorMessage()) ?>");
		<?php if ($risposte_zona_list->risposta_default->Required) { ?>
			elm = this.getElements("x" + infix + "_risposta_default");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $risposte_zona->risposta_default->caption(), $risposte_zona->risposta_default->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
frisposte_zonalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frisposte_zonalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var frisposte_zonalistsrch = currentSearchForm = new ew.Form("frisposte_zonalistsrch");

// Filters
frisposte_zonalistsrch.filterList = <?php echo $risposte_zona_list->getFilterList() ?>;

// Init search panel as collapsed
frisposte_zonalistsrch.initSearchPanel = true;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$risposte_zona->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($risposte_zona_list->TotalRecs > 0 && $risposte_zona_list->ExportOptions->visible()) { ?>
<?php $risposte_zona_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($risposte_zona_list->ImportOptions->visible()) { ?>
<?php $risposte_zona_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($risposte_zona_list->SearchOptions->visible()) { ?>
<?php $risposte_zona_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($risposte_zona_list->FilterOptions->visible()) { ?>
<?php $risposte_zona_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$risposte_zona_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$risposte_zona->isExport() && !$risposte_zona->CurrentAction) { ?>
<form name="frisposte_zonalistsrch" id="frisposte_zonalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($risposte_zona_list->SearchWhere <> "") ? " show" : ""; ?>
<div id="frisposte_zonalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="risposte_zona">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($risposte_zona_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($risposte_zona_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $risposte_zona_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($risposte_zona_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($risposte_zona_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($risposte_zona_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($risposte_zona_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $risposte_zona_list->showPageHeader(); ?>
<?php
$risposte_zona_list->showMessage();
?>
<?php if ($risposte_zona_list->TotalRecs > 0 || $risposte_zona->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($risposte_zona_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> risposte_zona">
<?php if (!$risposte_zona->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$risposte_zona->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($risposte_zona_list->Pager)) $risposte_zona_list->Pager = new PrevNextPager($risposte_zona_list->StartRec, $risposte_zona_list->DisplayRecs, $risposte_zona_list->TotalRecs, $risposte_zona_list->AutoHidePager) ?>
<?php if ($risposte_zona_list->Pager->RecordCount > 0 && $risposte_zona_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($risposte_zona_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($risposte_zona_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $risposte_zona_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($risposte_zona_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($risposte_zona_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $risposte_zona_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($risposte_zona_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $risposte_zona_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $risposte_zona_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $risposte_zona_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $risposte_zona_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frisposte_zonalist" id="frisposte_zonalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($risposte_zona_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $risposte_zona_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="risposte_zona">
<div id="gmp_risposte_zona" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($risposte_zona_list->TotalRecs > 0 || $risposte_zona->isGridEdit()) { ?>
<table id="tbl_risposte_zonalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$risposte_zona_list->RowType = ROWTYPE_HEADER;

// Render list options
$risposte_zona_list->renderListOptions();

// Render list options (header, left)
$risposte_zona_list->ListOptions->render("header", "left");
?>
<?php if ($risposte_zona->id_domanda->Visible) { // id_domanda ?>
	<?php if ($risposte_zona->sortUrl($risposte_zona->id_domanda) == "") { ?>
		<th data-name="id_domanda" class="<?php echo $risposte_zona->id_domanda->headerCellClass() ?>"><div id="elh_risposte_zona_id_domanda" class="risposte_zona_id_domanda"><div class="ew-table-header-caption"><?php echo $risposte_zona->id_domanda->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_domanda" class="<?php echo $risposte_zona->id_domanda->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte_zona->SortUrl($risposte_zona->id_domanda) ?>',1);"><div id="elh_risposte_zona_id_domanda" class="risposte_zona_id_domanda">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte_zona->id_domanda->caption() ?></span><span class="ew-table-header-sort"><?php if ($risposte_zona->id_domanda->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte_zona->id_domanda->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($risposte_zona->id_zona->Visible) { // id_zona ?>
	<?php if ($risposte_zona->sortUrl($risposte_zona->id_zona) == "") { ?>
		<th data-name="id_zona" class="<?php echo $risposte_zona->id_zona->headerCellClass() ?>"><div id="elh_risposte_zona_id_zona" class="risposte_zona_id_zona"><div class="ew-table-header-caption"><?php echo $risposte_zona->id_zona->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_zona" class="<?php echo $risposte_zona->id_zona->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte_zona->SortUrl($risposte_zona->id_zona) ?>',1);"><div id="elh_risposte_zona_id_zona" class="risposte_zona_id_zona">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte_zona->id_zona->caption() ?></span><span class="ew-table-header-sort"><?php if ($risposte_zona->id_zona->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte_zona->id_zona->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($risposte_zona->risposta_default->Visible) { // risposta_default ?>
	<?php if ($risposte_zona->sortUrl($risposte_zona->risposta_default) == "") { ?>
		<th data-name="risposta_default" class="<?php echo $risposte_zona->risposta_default->headerCellClass() ?>"><div id="elh_risposte_zona_risposta_default" class="risposte_zona_risposta_default"><div class="ew-table-header-caption"><?php echo $risposte_zona->risposta_default->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="risposta_default" class="<?php echo $risposte_zona->risposta_default->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $risposte_zona->SortUrl($risposte_zona->risposta_default) ?>',1);"><div id="elh_risposte_zona_risposta_default" class="risposte_zona_risposta_default">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $risposte_zona->risposta_default->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($risposte_zona->risposta_default->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($risposte_zona->risposta_default->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$risposte_zona_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($risposte_zona->ExportAll && $risposte_zona->isExport()) {
	$risposte_zona_list->StopRec = $risposte_zona_list->TotalRecs;
} else {

	// Set the last record to display
	if ($risposte_zona_list->TotalRecs > $risposte_zona_list->StartRec + $risposte_zona_list->DisplayRecs - 1)
		$risposte_zona_list->StopRec = $risposte_zona_list->StartRec + $risposte_zona_list->DisplayRecs - 1;
	else
		$risposte_zona_list->StopRec = $risposte_zona_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $risposte_zona_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($risposte_zona_list->FormKeyCountName) && ($risposte_zona->isGridAdd() || $risposte_zona->isGridEdit() || $risposte_zona->isConfirm())) {
		$risposte_zona_list->KeyCount = $CurrentForm->getValue($risposte_zona_list->FormKeyCountName);
		$risposte_zona_list->StopRec = $risposte_zona_list->StartRec + $risposte_zona_list->KeyCount - 1;
	}
}
$risposte_zona_list->RecCnt = $risposte_zona_list->StartRec - 1;
if ($risposte_zona_list->Recordset && !$risposte_zona_list->Recordset->EOF) {
	$risposte_zona_list->Recordset->moveFirst();
	$selectLimit = $risposte_zona_list->UseSelectLimit;
	if (!$selectLimit && $risposte_zona_list->StartRec > 1)
		$risposte_zona_list->Recordset->move($risposte_zona_list->StartRec - 1);
} elseif (!$risposte_zona->AllowAddDeleteRow && $risposte_zona_list->StopRec == 0) {
	$risposte_zona_list->StopRec = $risposte_zona->GridAddRowCount;
}

// Initialize aggregate
$risposte_zona->RowType = ROWTYPE_AGGREGATEINIT;
$risposte_zona->resetAttributes();
$risposte_zona_list->renderRow();
if ($risposte_zona->isGridEdit())
	$risposte_zona_list->RowIndex = 0;
while ($risposte_zona_list->RecCnt < $risposte_zona_list->StopRec) {
	$risposte_zona_list->RecCnt++;
	if ($risposte_zona_list->RecCnt >= $risposte_zona_list->StartRec) {
		$risposte_zona_list->RowCnt++;
		if ($risposte_zona->isGridAdd() || $risposte_zona->isGridEdit() || $risposte_zona->isConfirm()) {
			$risposte_zona_list->RowIndex++;
			$CurrentForm->Index = $risposte_zona_list->RowIndex;
			if ($CurrentForm->hasValue($risposte_zona_list->FormActionName) && $risposte_zona_list->EventCancelled)
				$risposte_zona_list->RowAction = strval($CurrentForm->getValue($risposte_zona_list->FormActionName));
			elseif ($risposte_zona->isGridAdd())
				$risposte_zona_list->RowAction = "insert";
			else
				$risposte_zona_list->RowAction = "";
		}

		// Set up key count
		$risposte_zona_list->KeyCount = $risposte_zona_list->RowIndex;

		// Init row class and style
		$risposte_zona->resetAttributes();
		$risposte_zona->CssClass = "";
		if ($risposte_zona->isGridAdd()) {
			$risposte_zona_list->loadRowValues(); // Load default values
		} else {
			$risposte_zona_list->loadRowValues($risposte_zona_list->Recordset); // Load row values
		}
		$risposte_zona->RowType = ROWTYPE_VIEW; // Render view
		if ($risposte_zona->isGridEdit()) { // Grid edit
			if ($risposte_zona->EventCancelled)
				$risposte_zona_list->restoreCurrentRowFormValues($risposte_zona_list->RowIndex); // Restore form values
			if ($risposte_zona_list->RowAction == "insert")
				$risposte_zona->RowType = ROWTYPE_ADD; // Render add
			else
				$risposte_zona->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($risposte_zona->isGridEdit() && ($risposte_zona->RowType == ROWTYPE_EDIT || $risposte_zona->RowType == ROWTYPE_ADD) && $risposte_zona->EventCancelled) // Update failed
			$risposte_zona_list->restoreCurrentRowFormValues($risposte_zona_list->RowIndex); // Restore form values
		if ($risposte_zona->RowType == ROWTYPE_EDIT) // Edit row
			$risposte_zona_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$risposte_zona->RowAttrs = array_merge($risposte_zona->RowAttrs, array('data-rowindex'=>$risposte_zona_list->RowCnt, 'id'=>'r' . $risposte_zona_list->RowCnt . '_risposte_zona', 'data-rowtype'=>$risposte_zona->RowType));

		// Render row
		$risposte_zona_list->renderRow();

		// Render list options
		$risposte_zona_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($risposte_zona_list->RowAction <> "delete" && $risposte_zona_list->RowAction <> "insertdelete" && !($risposte_zona_list->RowAction == "insert" && $risposte_zona->isConfirm() && $risposte_zona_list->emptyRow())) {
?>
	<tr<?php echo $risposte_zona->rowAttributes() ?>>
<?php

// Render list options (body, left)
$risposte_zona_list->ListOptions->render("body", "left", $risposte_zona_list->RowCnt);
?>
	<?php if ($risposte_zona->id_domanda->Visible) { // id_domanda ?>
		<td data-name="id_domanda"<?php echo $risposte_zona->id_domanda->cellAttributes() ?>>
<?php if ($risposte_zona->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_id_domanda" class="form-group risposte_zona_id_domanda">
<input type="text" data-table="risposte_zona" data-field="x_id_domanda" name="x<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" id="x<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" size="30" placeholder="<?php echo HtmlEncode($risposte_zona->id_domanda->getPlaceHolder()) ?>" value="<?php echo $risposte_zona->id_domanda->EditValue ?>"<?php echo $risposte_zona->id_domanda->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_id_domanda" name="o<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" id="o<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" value="<?php echo HtmlEncode($risposte_zona->id_domanda->OldValue) ?>">
<?php } ?>
<?php if ($risposte_zona->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_id_domanda" class="form-group risposte_zona_id_domanda">
<span<?php echo $risposte_zona->id_domanda->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte_zona->id_domanda->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_id_domanda" name="x<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" id="x<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" value="<?php echo HtmlEncode($risposte_zona->id_domanda->CurrentValue) ?>">
<?php } ?>
<?php if ($risposte_zona->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_id_domanda" class="risposte_zona_id_domanda">
<span<?php echo $risposte_zona->id_domanda->viewAttributes() ?>>
<?php echo $risposte_zona->id_domanda->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($risposte_zona->id_zona->Visible) { // id_zona ?>
		<td data-name="id_zona"<?php echo $risposte_zona->id_zona->cellAttributes() ?>>
<?php if ($risposte_zona->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_id_zona" class="form-group risposte_zona_id_zona">
<input type="text" data-table="risposte_zona" data-field="x_id_zona" name="x<?php echo $risposte_zona_list->RowIndex ?>_id_zona" id="x<?php echo $risposte_zona_list->RowIndex ?>_id_zona" size="30" placeholder="<?php echo HtmlEncode($risposte_zona->id_zona->getPlaceHolder()) ?>" value="<?php echo $risposte_zona->id_zona->EditValue ?>"<?php echo $risposte_zona->id_zona->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_id_zona" name="o<?php echo $risposte_zona_list->RowIndex ?>_id_zona" id="o<?php echo $risposte_zona_list->RowIndex ?>_id_zona" value="<?php echo HtmlEncode($risposte_zona->id_zona->OldValue) ?>">
<?php } ?>
<?php if ($risposte_zona->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_id_zona" class="form-group risposte_zona_id_zona">
<span<?php echo $risposte_zona->id_zona->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($risposte_zona->id_zona->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_id_zona" name="x<?php echo $risposte_zona_list->RowIndex ?>_id_zona" id="x<?php echo $risposte_zona_list->RowIndex ?>_id_zona" value="<?php echo HtmlEncode($risposte_zona->id_zona->CurrentValue) ?>">
<?php } ?>
<?php if ($risposte_zona->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_id_zona" class="risposte_zona_id_zona">
<span<?php echo $risposte_zona->id_zona->viewAttributes() ?>>
<?php echo $risposte_zona->id_zona->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($risposte_zona->risposta_default->Visible) { // risposta_default ?>
		<td data-name="risposta_default"<?php echo $risposte_zona->risposta_default->cellAttributes() ?>>
<?php if ($risposte_zona->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_risposta_default" class="form-group risposte_zona_risposta_default">
<textarea data-table="risposte_zona" data-field="x_risposta_default" name="x<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" id="x<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" cols="60" rows="4" placeholder="<?php echo HtmlEncode($risposte_zona->risposta_default->getPlaceHolder()) ?>"<?php echo $risposte_zona->risposta_default->editAttributes() ?>><?php echo $risposte_zona->risposta_default->EditValue ?></textarea>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_risposta_default" name="o<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" id="o<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" value="<?php echo HtmlEncode($risposte_zona->risposta_default->OldValue) ?>">
<?php } ?>
<?php if ($risposte_zona->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_risposta_default" class="form-group risposte_zona_risposta_default">
<textarea data-table="risposte_zona" data-field="x_risposta_default" name="x<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" id="x<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" cols="60" rows="4" placeholder="<?php echo HtmlEncode($risposte_zona->risposta_default->getPlaceHolder()) ?>"<?php echo $risposte_zona->risposta_default->editAttributes() ?>><?php echo $risposte_zona->risposta_default->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($risposte_zona->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $risposte_zona_list->RowCnt ?>_risposte_zona_risposta_default" class="risposte_zona_risposta_default">
<span<?php echo $risposte_zona->risposta_default->viewAttributes() ?>>
<?php echo $risposte_zona->risposta_default->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$risposte_zona_list->ListOptions->render("body", "right", $risposte_zona_list->RowCnt);
?>
	</tr>
<?php if ($risposte_zona->RowType == ROWTYPE_ADD || $risposte_zona->RowType == ROWTYPE_EDIT) { ?>
<script>
frisposte_zonalist.updateLists(<?php echo $risposte_zona_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$risposte_zona->isGridAdd())
		if (!$risposte_zona_list->Recordset->EOF)
			$risposte_zona_list->Recordset->moveNext();
}
?>
<?php
	if ($risposte_zona->isGridAdd() || $risposte_zona->isGridEdit()) {
		$risposte_zona_list->RowIndex = '$rowindex$';
		$risposte_zona_list->loadRowValues();

		// Set row properties
		$risposte_zona->resetAttributes();
		$risposte_zona->RowAttrs = array_merge($risposte_zona->RowAttrs, array('data-rowindex'=>$risposte_zona_list->RowIndex, 'id'=>'r0_risposte_zona', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($risposte_zona->RowAttrs["class"], "ew-template");
		$risposte_zona->RowType = ROWTYPE_ADD;

		// Render row
		$risposte_zona_list->renderRow();

		// Render list options
		$risposte_zona_list->renderListOptions();
		$risposte_zona_list->StartRowCnt = 0;
?>
	<tr<?php echo $risposte_zona->rowAttributes() ?>>
<?php

// Render list options (body, left)
$risposte_zona_list->ListOptions->render("body", "left", $risposte_zona_list->RowIndex);
?>
	<?php if ($risposte_zona->id_domanda->Visible) { // id_domanda ?>
		<td data-name="id_domanda">
<span id="el$rowindex$_risposte_zona_id_domanda" class="form-group risposte_zona_id_domanda">
<input type="text" data-table="risposte_zona" data-field="x_id_domanda" name="x<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" id="x<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" size="30" placeholder="<?php echo HtmlEncode($risposte_zona->id_domanda->getPlaceHolder()) ?>" value="<?php echo $risposte_zona->id_domanda->EditValue ?>"<?php echo $risposte_zona->id_domanda->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_id_domanda" name="o<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" id="o<?php echo $risposte_zona_list->RowIndex ?>_id_domanda" value="<?php echo HtmlEncode($risposte_zona->id_domanda->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($risposte_zona->id_zona->Visible) { // id_zona ?>
		<td data-name="id_zona">
<span id="el$rowindex$_risposte_zona_id_zona" class="form-group risposte_zona_id_zona">
<input type="text" data-table="risposte_zona" data-field="x_id_zona" name="x<?php echo $risposte_zona_list->RowIndex ?>_id_zona" id="x<?php echo $risposte_zona_list->RowIndex ?>_id_zona" size="30" placeholder="<?php echo HtmlEncode($risposte_zona->id_zona->getPlaceHolder()) ?>" value="<?php echo $risposte_zona->id_zona->EditValue ?>"<?php echo $risposte_zona->id_zona->editAttributes() ?>>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_id_zona" name="o<?php echo $risposte_zona_list->RowIndex ?>_id_zona" id="o<?php echo $risposte_zona_list->RowIndex ?>_id_zona" value="<?php echo HtmlEncode($risposte_zona->id_zona->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($risposte_zona->risposta_default->Visible) { // risposta_default ?>
		<td data-name="risposta_default">
<span id="el$rowindex$_risposte_zona_risposta_default" class="form-group risposte_zona_risposta_default">
<textarea data-table="risposte_zona" data-field="x_risposta_default" name="x<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" id="x<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" cols="60" rows="4" placeholder="<?php echo HtmlEncode($risposte_zona->risposta_default->getPlaceHolder()) ?>"<?php echo $risposte_zona->risposta_default->editAttributes() ?>><?php echo $risposte_zona->risposta_default->EditValue ?></textarea>
</span>
<input type="hidden" data-table="risposte_zona" data-field="x_risposta_default" name="o<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" id="o<?php echo $risposte_zona_list->RowIndex ?>_risposta_default" value="<?php echo HtmlEncode($risposte_zona->risposta_default->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$risposte_zona_list->ListOptions->render("body", "right", $risposte_zona_list->RowIndex);
?>
<script>
frisposte_zonalist.updateLists(<?php echo $risposte_zona_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($risposte_zona->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $risposte_zona_list->FormKeyCountName ?>" id="<?php echo $risposte_zona_list->FormKeyCountName ?>" value="<?php echo $risposte_zona_list->KeyCount ?>">
<?php echo $risposte_zona_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$risposte_zona->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($risposte_zona_list->Recordset)
	$risposte_zona_list->Recordset->Close();
?>
<?php if (!$risposte_zona->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$risposte_zona->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($risposte_zona_list->Pager)) $risposte_zona_list->Pager = new PrevNextPager($risposte_zona_list->StartRec, $risposte_zona_list->DisplayRecs, $risposte_zona_list->TotalRecs, $risposte_zona_list->AutoHidePager) ?>
<?php if ($risposte_zona_list->Pager->RecordCount > 0 && $risposte_zona_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($risposte_zona_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($risposte_zona_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $risposte_zona_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($risposte_zona_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($risposte_zona_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $risposte_zona_list->pageUrl() ?>start=<?php echo $risposte_zona_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $risposte_zona_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($risposte_zona_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $risposte_zona_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $risposte_zona_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $risposte_zona_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $risposte_zona_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($risposte_zona_list->TotalRecs == 0 && !$risposte_zona->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $risposte_zona_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$risposte_zona_list->showPageFooter();
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
$risposte_zona_list->terminate();
?>