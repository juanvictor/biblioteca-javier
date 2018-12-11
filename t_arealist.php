<?php
namespace PHPMaker2019\BIBLIOTECA;

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
$t_area_list = new t_area_list();

// Run the page
$t_area_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_area_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_area->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ft_arealist = currentForm = new ew.Form("ft_arealist", "list");
ft_arealist.formKeyCountName = '<?php echo $t_area_list->FormKeyCountName ?>';

// Form_CustomValidate event
ft_arealist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_arealist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ft_arealistsrch = currentSearchForm = new ew.Form("ft_arealistsrch");

// Filters
ft_arealistsrch.filterList = <?php echo $t_area_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_area->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_area_list->TotalRecs > 0 && $t_area_list->ExportOptions->visible()) { ?>
<?php $t_area_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_area_list->ImportOptions->visible()) { ?>
<?php $t_area_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_area_list->SearchOptions->visible()) { ?>
<?php $t_area_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_area_list->FilterOptions->visible()) { ?>
<?php $t_area_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_area_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_area->isExport() && !$t_area->CurrentAction) { ?>
<form name="ft_arealistsrch" id="ft_arealistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($t_area_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ft_arealistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_area">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($t_area_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($t_area_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_area_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_area_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $t_area_list->showPageHeader(); ?>
<?php
$t_area_list->showMessage();
?>
<?php if ($t_area_list->TotalRecs > 0 || $t_area->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_area_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_area">
<form name="ft_arealist" id="ft_arealist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_area_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_area_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_area">
<div id="gmp_t_area" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($t_area_list->TotalRecs > 0 || $t_area->isGridEdit()) { ?>
<table id="tbl_t_arealist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_area_list->RowType = ROWTYPE_HEADER;

// Render list options
$t_area_list->renderListOptions();

// Render list options (header, left)
$t_area_list->ListOptions->render("header", "left");
?>
<?php if ($t_area->Id_area->Visible) { // Id_area ?>
	<?php if ($t_area->sortUrl($t_area->Id_area) == "") { ?>
		<th data-name="Id_area" class="<?php echo $t_area->Id_area->headerCellClass() ?>"><div id="elh_t_area_Id_area" class="t_area_Id_area"><div class="ew-table-header-caption"><?php echo $t_area->Id_area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_area" class="<?php echo $t_area->Id_area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_area->SortUrl($t_area->Id_area) ?>',1);"><div id="elh_t_area_Id_area" class="t_area_Id_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_area->Id_area->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_area->Id_area->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_area->Id_area->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_area->Area->Visible) { // Area ?>
	<?php if ($t_area->sortUrl($t_area->Area) == "") { ?>
		<th data-name="Area" class="<?php echo $t_area->Area->headerCellClass() ?>"><div id="elh_t_area_Area" class="t_area_Area"><div class="ew-table-header-caption"><?php echo $t_area->Area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Area" class="<?php echo $t_area->Area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_area->SortUrl($t_area->Area) ?>',1);"><div id="elh_t_area_Area" class="t_area_Area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_area->Area->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_area->Area->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_area->Area->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_area_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_area->ExportAll && $t_area->isExport()) {
	$t_area_list->StopRec = $t_area_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t_area_list->TotalRecs > $t_area_list->StartRec + $t_area_list->DisplayRecs - 1)
		$t_area_list->StopRec = $t_area_list->StartRec + $t_area_list->DisplayRecs - 1;
	else
		$t_area_list->StopRec = $t_area_list->TotalRecs;
}
$t_area_list->RecCnt = $t_area_list->StartRec - 1;
if ($t_area_list->Recordset && !$t_area_list->Recordset->EOF) {
	$t_area_list->Recordset->moveFirst();
	$selectLimit = $t_area_list->UseSelectLimit;
	if (!$selectLimit && $t_area_list->StartRec > 1)
		$t_area_list->Recordset->move($t_area_list->StartRec - 1);
} elseif (!$t_area->AllowAddDeleteRow && $t_area_list->StopRec == 0) {
	$t_area_list->StopRec = $t_area->GridAddRowCount;
}

// Initialize aggregate
$t_area->RowType = ROWTYPE_AGGREGATEINIT;
$t_area->resetAttributes();
$t_area_list->renderRow();
while ($t_area_list->RecCnt < $t_area_list->StopRec) {
	$t_area_list->RecCnt++;
	if ($t_area_list->RecCnt >= $t_area_list->StartRec) {
		$t_area_list->RowCnt++;

		// Set up key count
		$t_area_list->KeyCount = $t_area_list->RowIndex;

		// Init row class and style
		$t_area->resetAttributes();
		$t_area->CssClass = "";
		if ($t_area->isGridAdd()) {
		} else {
			$t_area_list->loadRowValues($t_area_list->Recordset); // Load row values
		}
		$t_area->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_area->RowAttrs = array_merge($t_area->RowAttrs, array('data-rowindex'=>$t_area_list->RowCnt, 'id'=>'r' . $t_area_list->RowCnt . '_t_area', 'data-rowtype'=>$t_area->RowType));

		// Render row
		$t_area_list->renderRow();

		// Render list options
		$t_area_list->renderListOptions();
?>
	<tr<?php echo $t_area->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_area_list->ListOptions->render("body", "left", $t_area_list->RowCnt);
?>
	<?php if ($t_area->Id_area->Visible) { // Id_area ?>
		<td data-name="Id_area"<?php echo $t_area->Id_area->cellAttributes() ?>>
<span id="el<?php echo $t_area_list->RowCnt ?>_t_area_Id_area" class="t_area_Id_area">
<span<?php echo $t_area->Id_area->viewAttributes() ?>>
<?php echo $t_area->Id_area->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_area->Area->Visible) { // Area ?>
		<td data-name="Area"<?php echo $t_area->Area->cellAttributes() ?>>
<span id="el<?php echo $t_area_list->RowCnt ?>_t_area_Area" class="t_area_Area">
<span<?php echo $t_area->Area->viewAttributes() ?>>
<?php echo $t_area->Area->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_area_list->ListOptions->render("body", "right", $t_area_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$t_area->isGridAdd())
		$t_area_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$t_area->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_area_list->Recordset)
	$t_area_list->Recordset->Close();
?>
<?php if (!$t_area->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_area->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($t_area_list->Pager)) $t_area_list->Pager = new PrevNextPager($t_area_list->StartRec, $t_area_list->DisplayRecs, $t_area_list->TotalRecs, $t_area_list->AutoHidePager) ?>
<?php if ($t_area_list->Pager->RecordCount > 0 && $t_area_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($t_area_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_area_list->pageUrl() ?>start=<?php echo $t_area_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($t_area_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_area_list->pageUrl() ?>start=<?php echo $t_area_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $t_area_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($t_area_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_area_list->pageUrl() ?>start=<?php echo $t_area_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($t_area_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_area_list->pageUrl() ?>start=<?php echo $t_area_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_area_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($t_area_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t_area_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t_area_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t_area_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_area_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_area_list->TotalRecs == 0 && !$t_area->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_area_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_area_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$t_area->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t_area_list->terminate();
?>
