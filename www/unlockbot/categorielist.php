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
$categorie_list = new categorie_list();

// Run the page
$categorie_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categorie_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$categorie->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcategorielist = currentForm = new ew.Form("fcategorielist", "list");
fcategorielist.formKeyCountName = '<?php echo $categorie_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcategorielist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorielist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$categorie->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($categorie_list->TotalRecs > 0 && $categorie_list->ExportOptions->visible()) { ?>
<?php $categorie_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($categorie_list->ImportOptions->visible()) { ?>
<?php $categorie_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$categorie_list->renderOtherOptions();
?>
<?php $categorie_list->showPageHeader(); ?>
<?php
$categorie_list->showMessage();
?>
<?php if ($categorie_list->TotalRecs > 0 || $categorie->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($categorie_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> categorie">
<?php if (!$categorie->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$categorie->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categorie_list->Pager)) $categorie_list->Pager = new PrevNextPager($categorie_list->StartRec, $categorie_list->DisplayRecs, $categorie_list->TotalRecs, $categorie_list->AutoHidePager) ?>
<?php if ($categorie_list->Pager->RecordCount > 0 && $categorie_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categorie_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categorie_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categorie_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categorie_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categorie_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categorie_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($categorie_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $categorie_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $categorie_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $categorie_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $categorie_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcategorielist" id="fcategorielist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($categorie_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $categorie_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categorie">
<div id="gmp_categorie" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($categorie_list->TotalRecs > 0 || $categorie->isGridEdit()) { ?>
<table id="tbl_categorielist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$categorie_list->RowType = ROWTYPE_HEADER;

// Render list options
$categorie_list->renderListOptions();

// Render list options (header, left)
$categorie_list->ListOptions->render("header", "left");
?>
<?php if ($categorie->id->Visible) { // id ?>
	<?php if ($categorie->sortUrl($categorie->id) == "") { ?>
		<th data-name="id" class="<?php echo $categorie->id->headerCellClass() ?>"><div id="elh_categorie_id" class="categorie_id"><div class="ew-table-header-caption"><?php echo $categorie->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $categorie->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $categorie->SortUrl($categorie->id) ?>',1);"><div id="elh_categorie_id" class="categorie_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categorie->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($categorie->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($categorie->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categorie->categoria->Visible) { // categoria ?>
	<?php if ($categorie->sortUrl($categorie->categoria) == "") { ?>
		<th data-name="categoria" class="<?php echo $categorie->categoria->headerCellClass() ?>"><div id="elh_categorie_categoria" class="categorie_categoria"><div class="ew-table-header-caption"><?php echo $categorie->categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="categoria" class="<?php echo $categorie->categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $categorie->SortUrl($categorie->categoria) ?>',1);"><div id="elh_categorie_categoria" class="categorie_categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categorie->categoria->caption() ?></span><span class="ew-table-header-sort"><?php if ($categorie->categoria->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($categorie->categoria->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$categorie_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($categorie->ExportAll && $categorie->isExport()) {
	$categorie_list->StopRec = $categorie_list->TotalRecs;
} else {

	// Set the last record to display
	if ($categorie_list->TotalRecs > $categorie_list->StartRec + $categorie_list->DisplayRecs - 1)
		$categorie_list->StopRec = $categorie_list->StartRec + $categorie_list->DisplayRecs - 1;
	else
		$categorie_list->StopRec = $categorie_list->TotalRecs;
}
$categorie_list->RecCnt = $categorie_list->StartRec - 1;
if ($categorie_list->Recordset && !$categorie_list->Recordset->EOF) {
	$categorie_list->Recordset->moveFirst();
	$selectLimit = $categorie_list->UseSelectLimit;
	if (!$selectLimit && $categorie_list->StartRec > 1)
		$categorie_list->Recordset->move($categorie_list->StartRec - 1);
} elseif (!$categorie->AllowAddDeleteRow && $categorie_list->StopRec == 0) {
	$categorie_list->StopRec = $categorie->GridAddRowCount;
}

// Initialize aggregate
$categorie->RowType = ROWTYPE_AGGREGATEINIT;
$categorie->resetAttributes();
$categorie_list->renderRow();
while ($categorie_list->RecCnt < $categorie_list->StopRec) {
	$categorie_list->RecCnt++;
	if ($categorie_list->RecCnt >= $categorie_list->StartRec) {
		$categorie_list->RowCnt++;

		// Set up key count
		$categorie_list->KeyCount = $categorie_list->RowIndex;

		// Init row class and style
		$categorie->resetAttributes();
		$categorie->CssClass = "";
		if ($categorie->isGridAdd()) {
		} else {
			$categorie_list->loadRowValues($categorie_list->Recordset); // Load row values
		}
		$categorie->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$categorie->RowAttrs = array_merge($categorie->RowAttrs, array('data-rowindex'=>$categorie_list->RowCnt, 'id'=>'r' . $categorie_list->RowCnt . '_categorie', 'data-rowtype'=>$categorie->RowType));

		// Render row
		$categorie_list->renderRow();

		// Render list options
		$categorie_list->renderListOptions();
?>
	<tr<?php echo $categorie->rowAttributes() ?>>
<?php

// Render list options (body, left)
$categorie_list->ListOptions->render("body", "left", $categorie_list->RowCnt);
?>
	<?php if ($categorie->id->Visible) { // id ?>
		<td data-name="id"<?php echo $categorie->id->cellAttributes() ?>>
<span id="el<?php echo $categorie_list->RowCnt ?>_categorie_id" class="categorie_id">
<span<?php echo $categorie->id->viewAttributes() ?>>
<?php echo $categorie->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($categorie->categoria->Visible) { // categoria ?>
		<td data-name="categoria"<?php echo $categorie->categoria->cellAttributes() ?>>
<span id="el<?php echo $categorie_list->RowCnt ?>_categorie_categoria" class="categorie_categoria">
<span<?php echo $categorie->categoria->viewAttributes() ?>>
<?php echo $categorie->categoria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$categorie_list->ListOptions->render("body", "right", $categorie_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$categorie->isGridAdd())
		$categorie_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$categorie->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($categorie_list->Recordset)
	$categorie_list->Recordset->Close();
?>
<?php if (!$categorie->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$categorie->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($categorie_list->Pager)) $categorie_list->Pager = new PrevNextPager($categorie_list->StartRec, $categorie_list->DisplayRecs, $categorie_list->TotalRecs, $categorie_list->AutoHidePager) ?>
<?php if ($categorie_list->Pager->RecordCount > 0 && $categorie_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($categorie_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($categorie_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $categorie_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($categorie_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($categorie_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $categorie_list->pageUrl() ?>start=<?php echo $categorie_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $categorie_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($categorie_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $categorie_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $categorie_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $categorie_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $categorie_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($categorie_list->TotalRecs == 0 && !$categorie->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $categorie_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$categorie_list->showPageFooter();
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
$categorie_list->terminate();
?>