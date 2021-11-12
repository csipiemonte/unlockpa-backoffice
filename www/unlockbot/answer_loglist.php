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
$answer_log_list = new answer_log_list();

// Run the page
$answer_log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$answer_log_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$answer_log->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fanswer_loglist = currentForm = new ew.Form("fanswer_loglist", "list");
fanswer_loglist.formKeyCountName = '<?php echo $answer_log_list->FormKeyCountName ?>';

// Form_CustomValidate event
fanswer_loglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fanswer_loglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$answer_log->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($answer_log_list->TotalRecs > 0 && $answer_log_list->ExportOptions->visible()) { ?>
<?php $answer_log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($answer_log_list->ImportOptions->visible()) { ?>
<?php $answer_log_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$answer_log_list->renderOtherOptions();
?>
<?php $answer_log_list->showPageHeader(); ?>
<?php
$answer_log_list->showMessage();
?>
<?php if ($answer_log_list->TotalRecs > 0 || $answer_log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($answer_log_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> answer_log">
<form name="fanswer_loglist" id="fanswer_loglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($answer_log_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $answer_log_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="answer_log">
<div id="gmp_answer_log" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($answer_log_list->TotalRecs > 0 || $answer_log->isGridEdit()) { ?>
<table id="tbl_answer_loglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$answer_log_list->RowType = ROWTYPE_HEADER;

// Render list options
$answer_log_list->renderListOptions();

// Render list options (header, left)
$answer_log_list->ListOptions->render("header", "left");
?>
<?php if ($answer_log->id->Visible) { // id ?>
	<?php if ($answer_log->sortUrl($answer_log->id) == "") { ?>
		<th data-name="id" class="<?php echo $answer_log->id->headerCellClass() ?>"><div id="elh_answer_log_id" class="answer_log_id"><div class="ew-table-header-caption"><?php echo $answer_log->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $answer_log->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $answer_log->SortUrl($answer_log->id) ?>',1);"><div id="elh_answer_log_id" class="answer_log_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answer_log->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($answer_log->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($answer_log->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answer_log->ts_creation->Visible) { // ts_creation ?>
	<?php if ($answer_log->sortUrl($answer_log->ts_creation) == "") { ?>
		<th data-name="ts_creation" class="<?php echo $answer_log->ts_creation->headerCellClass() ?>"><div id="elh_answer_log_ts_creation" class="answer_log_ts_creation"><div class="ew-table-header-caption"><?php echo $answer_log->ts_creation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ts_creation" class="<?php echo $answer_log->ts_creation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $answer_log->SortUrl($answer_log->ts_creation) ?>',1);"><div id="elh_answer_log_ts_creation" class="answer_log_ts_creation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answer_log->ts_creation->caption() ?></span><span class="ew-table-header-sort"><?php if ($answer_log->ts_creation->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($answer_log->ts_creation->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answer_log->confidence->Visible) { // confidence ?>
	<?php if ($answer_log->sortUrl($answer_log->confidence) == "") { ?>
		<th data-name="confidence" class="<?php echo $answer_log->confidence->headerCellClass() ?>"><div id="elh_answer_log_confidence" class="answer_log_confidence"><div class="ew-table-header-caption"><?php echo $answer_log->confidence->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="confidence" class="<?php echo $answer_log->confidence->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $answer_log->SortUrl($answer_log->confidence) ?>',1);"><div id="elh_answer_log_confidence" class="answer_log_confidence">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answer_log->confidence->caption() ?></span><span class="ew-table-header-sort"><?php if ($answer_log->confidence->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($answer_log->confidence->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answer_log->id_kb->Visible) { // id_kb ?>
	<?php if ($answer_log->sortUrl($answer_log->id_kb) == "") { ?>
		<th data-name="id_kb" class="<?php echo $answer_log->id_kb->headerCellClass() ?>"><div id="elh_answer_log_id_kb" class="answer_log_id_kb"><div class="ew-table-header-caption"><?php echo $answer_log->id_kb->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kb" class="<?php echo $answer_log->id_kb->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $answer_log->SortUrl($answer_log->id_kb) ?>',1);"><div id="elh_answer_log_id_kb" class="answer_log_id_kb">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answer_log->id_kb->caption() ?></span><span class="ew-table-header-sort"><?php if ($answer_log->id_kb->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($answer_log->id_kb->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($answer_log->id_bot_instance->Visible) { // id_bot_instance ?>
	<?php if ($answer_log->sortUrl($answer_log->id_bot_instance) == "") { ?>
		<th data-name="id_bot_instance" class="<?php echo $answer_log->id_bot_instance->headerCellClass() ?>"><div id="elh_answer_log_id_bot_instance" class="answer_log_id_bot_instance"><div class="ew-table-header-caption"><?php echo $answer_log->id_bot_instance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_bot_instance" class="<?php echo $answer_log->id_bot_instance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $answer_log->SortUrl($answer_log->id_bot_instance) ?>',1);"><div id="elh_answer_log_id_bot_instance" class="answer_log_id_bot_instance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $answer_log->id_bot_instance->caption() ?></span><span class="ew-table-header-sort"><?php if ($answer_log->id_bot_instance->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($answer_log->id_bot_instance->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$answer_log_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($answer_log->ExportAll && $answer_log->isExport()) {
	$answer_log_list->StopRec = $answer_log_list->TotalRecs;
} else {

	// Set the last record to display
	if ($answer_log_list->TotalRecs > $answer_log_list->StartRec + $answer_log_list->DisplayRecs - 1)
		$answer_log_list->StopRec = $answer_log_list->StartRec + $answer_log_list->DisplayRecs - 1;
	else
		$answer_log_list->StopRec = $answer_log_list->TotalRecs;
}
$answer_log_list->RecCnt = $answer_log_list->StartRec - 1;
if ($answer_log_list->Recordset && !$answer_log_list->Recordset->EOF) {
	$answer_log_list->Recordset->moveFirst();
	$selectLimit = $answer_log_list->UseSelectLimit;
	if (!$selectLimit && $answer_log_list->StartRec > 1)
		$answer_log_list->Recordset->move($answer_log_list->StartRec - 1);
} elseif (!$answer_log->AllowAddDeleteRow && $answer_log_list->StopRec == 0) {
	$answer_log_list->StopRec = $answer_log->GridAddRowCount;
}

// Initialize aggregate
$answer_log->RowType = ROWTYPE_AGGREGATEINIT;
$answer_log->resetAttributes();
$answer_log_list->renderRow();
while ($answer_log_list->RecCnt < $answer_log_list->StopRec) {
	$answer_log_list->RecCnt++;
	if ($answer_log_list->RecCnt >= $answer_log_list->StartRec) {
		$answer_log_list->RowCnt++;

		// Set up key count
		$answer_log_list->KeyCount = $answer_log_list->RowIndex;

		// Init row class and style
		$answer_log->resetAttributes();
		$answer_log->CssClass = "";
		if ($answer_log->isGridAdd()) {
		} else {
			$answer_log_list->loadRowValues($answer_log_list->Recordset); // Load row values
		}
		$answer_log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$answer_log->RowAttrs = array_merge($answer_log->RowAttrs, array('data-rowindex'=>$answer_log_list->RowCnt, 'id'=>'r' . $answer_log_list->RowCnt . '_answer_log', 'data-rowtype'=>$answer_log->RowType));

		// Render row
		$answer_log_list->renderRow();

		// Render list options
		$answer_log_list->renderListOptions();
?>
	<tr<?php echo $answer_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$answer_log_list->ListOptions->render("body", "left", $answer_log_list->RowCnt);
?>
	<?php if ($answer_log->id->Visible) { // id ?>
		<td data-name="id"<?php echo $answer_log->id->cellAttributes() ?>>
<span id="el<?php echo $answer_log_list->RowCnt ?>_answer_log_id" class="answer_log_id">
<span<?php echo $answer_log->id->viewAttributes() ?>>
<?php echo $answer_log->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answer_log->ts_creation->Visible) { // ts_creation ?>
		<td data-name="ts_creation"<?php echo $answer_log->ts_creation->cellAttributes() ?>>
<span id="el<?php echo $answer_log_list->RowCnt ?>_answer_log_ts_creation" class="answer_log_ts_creation">
<span<?php echo $answer_log->ts_creation->viewAttributes() ?>>
<?php echo $answer_log->ts_creation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answer_log->confidence->Visible) { // confidence ?>
		<td data-name="confidence"<?php echo $answer_log->confidence->cellAttributes() ?>>
<span id="el<?php echo $answer_log_list->RowCnt ?>_answer_log_confidence" class="answer_log_confidence">
<span<?php echo $answer_log->confidence->viewAttributes() ?>>
<?php echo $answer_log->confidence->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answer_log->id_kb->Visible) { // id_kb ?>
		<td data-name="id_kb"<?php echo $answer_log->id_kb->cellAttributes() ?>>
<span id="el<?php echo $answer_log_list->RowCnt ?>_answer_log_id_kb" class="answer_log_id_kb">
<span<?php echo $answer_log->id_kb->viewAttributes() ?>>
<?php echo $answer_log->id_kb->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($answer_log->id_bot_instance->Visible) { // id_bot_instance ?>
		<td data-name="id_bot_instance"<?php echo $answer_log->id_bot_instance->cellAttributes() ?>>
<span id="el<?php echo $answer_log_list->RowCnt ?>_answer_log_id_bot_instance" class="answer_log_id_bot_instance">
<span<?php echo $answer_log->id_bot_instance->viewAttributes() ?>>
<?php echo $answer_log->id_bot_instance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$answer_log_list->ListOptions->render("body", "right", $answer_log_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$answer_log->isGridAdd())
		$answer_log_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$answer_log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($answer_log_list->Recordset)
	$answer_log_list->Recordset->Close();
?>
<?php if (!$answer_log->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$answer_log->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($answer_log_list->Pager)) $answer_log_list->Pager = new PrevNextPager($answer_log_list->StartRec, $answer_log_list->DisplayRecs, $answer_log_list->TotalRecs, $answer_log_list->AutoHidePager) ?>
<?php if ($answer_log_list->Pager->RecordCount > 0 && $answer_log_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($answer_log_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $answer_log_list->pageUrl() ?>start=<?php echo $answer_log_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($answer_log_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $answer_log_list->pageUrl() ?>start=<?php echo $answer_log_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $answer_log_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($answer_log_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $answer_log_list->pageUrl() ?>start=<?php echo $answer_log_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($answer_log_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $answer_log_list->pageUrl() ?>start=<?php echo $answer_log_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $answer_log_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($answer_log_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $answer_log_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $answer_log_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $answer_log_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $answer_log_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($answer_log_list->TotalRecs == 0 && !$answer_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $answer_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$answer_log_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$answer_log->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$answer_log_list->terminate();
?>