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
$knowledge_base_list = new knowledge_base_list();

// Run the page
$knowledge_base_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$knowledge_base_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$knowledge_base->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fknowledge_baselist = currentForm = new ew.Form("fknowledge_baselist", "list");
fknowledge_baselist.formKeyCountName = '<?php echo $knowledge_base_list->FormKeyCountName ?>';

// Form_CustomValidate event
fknowledge_baselist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fknowledge_baselist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fknowledge_baselistsrch = currentSearchForm = new ew.Form("fknowledge_baselistsrch");

// Filters
fknowledge_baselistsrch.filterList = <?php echo $knowledge_base_list->getFilterList() ?>;

// Init search panel as collapsed
fknowledge_baselistsrch.initSearchPanel = true;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$knowledge_base->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($knowledge_base_list->TotalRecs > 0 && $knowledge_base_list->ExportOptions->visible()) { ?>
<?php $knowledge_base_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($knowledge_base_list->ImportOptions->visible()) { ?>
<?php $knowledge_base_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($knowledge_base_list->SearchOptions->visible()) { ?>
<?php $knowledge_base_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($knowledge_base_list->FilterOptions->visible()) { ?>
<?php $knowledge_base_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$knowledge_base_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$knowledge_base->isExport() && !$knowledge_base->CurrentAction) { ?>
<form name="fknowledge_baselistsrch" id="fknowledge_baselistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($knowledge_base_list->SearchWhere <> "") ? " show" : ""; ?>
<div id="fknowledge_baselistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="knowledge_base">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($knowledge_base_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($knowledge_base_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $knowledge_base_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($knowledge_base_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($knowledge_base_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($knowledge_base_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($knowledge_base_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $knowledge_base_list->showPageHeader(); ?>
<?php
$knowledge_base_list->showMessage();
?>
<?php if ($knowledge_base_list->TotalRecs > 0 || $knowledge_base->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($knowledge_base_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> knowledge_base">
<form name="fknowledge_baselist" id="fknowledge_baselist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($knowledge_base_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $knowledge_base_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="knowledge_base">
<div id="gmp_knowledge_base" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($knowledge_base_list->TotalRecs > 0 || $knowledge_base->isGridEdit()) { ?>
<table id="tbl_knowledge_baselist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$knowledge_base_list->RowType = ROWTYPE_HEADER;

// Render list options
$knowledge_base_list->renderListOptions();

// Render list options (header, left)
$knowledge_base_list->ListOptions->render("header", "left");
?>
<?php if ($knowledge_base->id->Visible) { // id ?>
	<?php if ($knowledge_base->sortUrl($knowledge_base->id) == "") { ?>
		<th data-name="id" class="<?php echo $knowledge_base->id->headerCellClass() ?>"><div id="elh_knowledge_base_id" class="knowledge_base_id"><div class="ew-table-header-caption"><?php echo $knowledge_base->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $knowledge_base->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $knowledge_base->SortUrl($knowledge_base->id) ?>',1);"><div id="elh_knowledge_base_id" class="knowledge_base_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $knowledge_base->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($knowledge_base->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($knowledge_base->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($knowledge_base->ts_creation->Visible) { // ts_creation ?>
	<?php if ($knowledge_base->sortUrl($knowledge_base->ts_creation) == "") { ?>
		<th data-name="ts_creation" class="<?php echo $knowledge_base->ts_creation->headerCellClass() ?>"><div id="elh_knowledge_base_ts_creation" class="knowledge_base_ts_creation"><div class="ew-table-header-caption"><?php echo $knowledge_base->ts_creation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ts_creation" class="<?php echo $knowledge_base->ts_creation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $knowledge_base->SortUrl($knowledge_base->ts_creation) ?>',1);"><div id="elh_knowledge_base_ts_creation" class="knowledge_base_ts_creation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $knowledge_base->ts_creation->caption() ?></span><span class="ew-table-header-sort"><?php if ($knowledge_base->ts_creation->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($knowledge_base->ts_creation->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($knowledge_base->question_type->Visible) { // question_type ?>
	<?php if ($knowledge_base->sortUrl($knowledge_base->question_type) == "") { ?>
		<th data-name="question_type" class="<?php echo $knowledge_base->question_type->headerCellClass() ?>"><div id="elh_knowledge_base_question_type" class="knowledge_base_question_type"><div class="ew-table-header-caption"><?php echo $knowledge_base->question_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_type" class="<?php echo $knowledge_base->question_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $knowledge_base->SortUrl($knowledge_base->question_type) ?>',1);"><div id="elh_knowledge_base_question_type" class="knowledge_base_question_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $knowledge_base->question_type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($knowledge_base->question_type->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($knowledge_base->question_type->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($knowledge_base->question_number->Visible) { // question_number ?>
	<?php if ($knowledge_base->sortUrl($knowledge_base->question_number) == "") { ?>
		<th data-name="question_number" class="<?php echo $knowledge_base->question_number->headerCellClass() ?>"><div id="elh_knowledge_base_question_number" class="knowledge_base_question_number"><div class="ew-table-header-caption"><?php echo $knowledge_base->question_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="question_number" class="<?php echo $knowledge_base->question_number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $knowledge_base->SortUrl($knowledge_base->question_number) ?>',1);"><div id="elh_knowledge_base_question_number" class="knowledge_base_question_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $knowledge_base->question_number->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($knowledge_base->question_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($knowledge_base->question_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($knowledge_base->id_bot->Visible) { // id_bot ?>
	<?php if ($knowledge_base->sortUrl($knowledge_base->id_bot) == "") { ?>
		<th data-name="id_bot" class="<?php echo $knowledge_base->id_bot->headerCellClass() ?>"><div id="elh_knowledge_base_id_bot" class="knowledge_base_id_bot"><div class="ew-table-header-caption"><?php echo $knowledge_base->id_bot->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_bot" class="<?php echo $knowledge_base->id_bot->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $knowledge_base->SortUrl($knowledge_base->id_bot) ?>',1);"><div id="elh_knowledge_base_id_bot" class="knowledge_base_id_bot">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $knowledge_base->id_bot->caption() ?></span><span class="ew-table-header-sort"><?php if ($knowledge_base->id_bot->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($knowledge_base->id_bot->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$knowledge_base_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($knowledge_base->ExportAll && $knowledge_base->isExport()) {
	$knowledge_base_list->StopRec = $knowledge_base_list->TotalRecs;
} else {

	// Set the last record to display
	if ($knowledge_base_list->TotalRecs > $knowledge_base_list->StartRec + $knowledge_base_list->DisplayRecs - 1)
		$knowledge_base_list->StopRec = $knowledge_base_list->StartRec + $knowledge_base_list->DisplayRecs - 1;
	else
		$knowledge_base_list->StopRec = $knowledge_base_list->TotalRecs;
}
$knowledge_base_list->RecCnt = $knowledge_base_list->StartRec - 1;
if ($knowledge_base_list->Recordset && !$knowledge_base_list->Recordset->EOF) {
	$knowledge_base_list->Recordset->moveFirst();
	$selectLimit = $knowledge_base_list->UseSelectLimit;
	if (!$selectLimit && $knowledge_base_list->StartRec > 1)
		$knowledge_base_list->Recordset->move($knowledge_base_list->StartRec - 1);
} elseif (!$knowledge_base->AllowAddDeleteRow && $knowledge_base_list->StopRec == 0) {
	$knowledge_base_list->StopRec = $knowledge_base->GridAddRowCount;
}

// Initialize aggregate
$knowledge_base->RowType = ROWTYPE_AGGREGATEINIT;
$knowledge_base->resetAttributes();
$knowledge_base_list->renderRow();
while ($knowledge_base_list->RecCnt < $knowledge_base_list->StopRec) {
	$knowledge_base_list->RecCnt++;
	if ($knowledge_base_list->RecCnt >= $knowledge_base_list->StartRec) {
		$knowledge_base_list->RowCnt++;

		// Set up key count
		$knowledge_base_list->KeyCount = $knowledge_base_list->RowIndex;

		// Init row class and style
		$knowledge_base->resetAttributes();
		$knowledge_base->CssClass = "";
		if ($knowledge_base->isGridAdd()) {
		} else {
			$knowledge_base_list->loadRowValues($knowledge_base_list->Recordset); // Load row values
		}
		$knowledge_base->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$knowledge_base->RowAttrs = array_merge($knowledge_base->RowAttrs, array('data-rowindex'=>$knowledge_base_list->RowCnt, 'id'=>'r' . $knowledge_base_list->RowCnt . '_knowledge_base', 'data-rowtype'=>$knowledge_base->RowType));

		// Render row
		$knowledge_base_list->renderRow();

		// Render list options
		$knowledge_base_list->renderListOptions();
?>
	<tr<?php echo $knowledge_base->rowAttributes() ?>>
<?php

// Render list options (body, left)
$knowledge_base_list->ListOptions->render("body", "left", $knowledge_base_list->RowCnt);
?>
	<?php if ($knowledge_base->id->Visible) { // id ?>
		<td data-name="id"<?php echo $knowledge_base->id->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_list->RowCnt ?>_knowledge_base_id" class="knowledge_base_id">
<span<?php echo $knowledge_base->id->viewAttributes() ?>>
<?php echo $knowledge_base->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($knowledge_base->ts_creation->Visible) { // ts_creation ?>
		<td data-name="ts_creation"<?php echo $knowledge_base->ts_creation->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_list->RowCnt ?>_knowledge_base_ts_creation" class="knowledge_base_ts_creation">
<span<?php echo $knowledge_base->ts_creation->viewAttributes() ?>>
<?php echo $knowledge_base->ts_creation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($knowledge_base->question_type->Visible) { // question_type ?>
		<td data-name="question_type"<?php echo $knowledge_base->question_type->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_list->RowCnt ?>_knowledge_base_question_type" class="knowledge_base_question_type">
<span<?php echo $knowledge_base->question_type->viewAttributes() ?>>
<?php echo $knowledge_base->question_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($knowledge_base->question_number->Visible) { // question_number ?>
		<td data-name="question_number"<?php echo $knowledge_base->question_number->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_list->RowCnt ?>_knowledge_base_question_number" class="knowledge_base_question_number">
<span<?php echo $knowledge_base->question_number->viewAttributes() ?>>
<?php echo $knowledge_base->question_number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($knowledge_base->id_bot->Visible) { // id_bot ?>
		<td data-name="id_bot"<?php echo $knowledge_base->id_bot->cellAttributes() ?>>
<span id="el<?php echo $knowledge_base_list->RowCnt ?>_knowledge_base_id_bot" class="knowledge_base_id_bot">
<span<?php echo $knowledge_base->id_bot->viewAttributes() ?>>
<?php echo $knowledge_base->id_bot->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$knowledge_base_list->ListOptions->render("body", "right", $knowledge_base_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$knowledge_base->isGridAdd())
		$knowledge_base_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$knowledge_base->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($knowledge_base_list->Recordset)
	$knowledge_base_list->Recordset->Close();
?>
<?php if (!$knowledge_base->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$knowledge_base->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($knowledge_base_list->Pager)) $knowledge_base_list->Pager = new PrevNextPager($knowledge_base_list->StartRec, $knowledge_base_list->DisplayRecs, $knowledge_base_list->TotalRecs, $knowledge_base_list->AutoHidePager) ?>
<?php if ($knowledge_base_list->Pager->RecordCount > 0 && $knowledge_base_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($knowledge_base_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $knowledge_base_list->pageUrl() ?>start=<?php echo $knowledge_base_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($knowledge_base_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $knowledge_base_list->pageUrl() ?>start=<?php echo $knowledge_base_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $knowledge_base_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($knowledge_base_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $knowledge_base_list->pageUrl() ?>start=<?php echo $knowledge_base_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($knowledge_base_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $knowledge_base_list->pageUrl() ?>start=<?php echo $knowledge_base_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $knowledge_base_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($knowledge_base_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $knowledge_base_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $knowledge_base_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $knowledge_base_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $knowledge_base_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($knowledge_base_list->TotalRecs == 0 && !$knowledge_base->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $knowledge_base_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$knowledge_base_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$knowledge_base->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$knowledge_base_list->terminate();
?>