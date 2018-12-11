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
$prestado_list = new prestado_list();

// Run the page
$prestado_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$prestado_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$prestado->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fprestadolist = currentForm = new ew.Form("fprestadolist", "list");
fprestadolist.formKeyCountName = '<?php echo $prestado_list->FormKeyCountName ?>';

// Form_CustomValidate event
fprestadolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprestadolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fprestadolist.lists["x_CI_Lector"] = <?php echo $prestado_list->CI_Lector->Lookup->toClientList() ?>;
fprestadolist.lists["x_CI_Lector"].options = <?php echo JsonEncode($prestado_list->CI_Lector->lookupOptions()) ?>;

// Form object for search
var fprestadolistsrch = currentSearchForm = new ew.Form("fprestadolistsrch");

// Filters
fprestadolistsrch.filterList = <?php echo $prestado_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$prestado->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($prestado_list->TotalRecs > 0 && $prestado_list->ExportOptions->visible()) { ?>
<?php $prestado_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($prestado_list->ImportOptions->visible()) { ?>
<?php $prestado_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($prestado_list->SearchOptions->visible()) { ?>
<?php $prestado_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($prestado_list->FilterOptions->visible()) { ?>
<?php $prestado_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$prestado_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$prestado->isExport() && !$prestado->CurrentAction) { ?>
<form name="fprestadolistsrch" id="fprestadolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($prestado_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fprestadolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="prestado">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($prestado_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($prestado_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $prestado_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($prestado_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($prestado_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($prestado_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($prestado_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $prestado_list->showPageHeader(); ?>
<?php
$prestado_list->showMessage();
?>
<?php if ($prestado_list->TotalRecs > 0 || $prestado->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($prestado_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> prestado">
<form name="fprestadolist" id="fprestadolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($prestado_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $prestado_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="prestado">
<div id="gmp_prestado" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($prestado_list->TotalRecs > 0 || $prestado->isGridEdit()) { ?>
<table id="tbl_prestadolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$prestado_list->RowType = ROWTYPE_HEADER;

// Render list options
$prestado_list->renderListOptions();

// Render list options (header, left)
$prestado_list->ListOptions->render("header", "left");
?>
<?php if ($prestado->CI_Lector->Visible) { // CI_Lector ?>
	<?php if ($prestado->sortUrl($prestado->CI_Lector) == "") { ?>
		<th data-name="CI_Lector" class="<?php echo $prestado->CI_Lector->headerCellClass() ?>"><div id="elh_prestado_CI_Lector" class="prestado_CI_Lector"><div class="ew-table-header-caption"><?php echo $prestado->CI_Lector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CI_Lector" class="<?php echo $prestado->CI_Lector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prestado->SortUrl($prestado->CI_Lector) ?>',1);"><div id="elh_prestado_CI_Lector" class="prestado_CI_Lector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prestado->CI_Lector->caption() ?></span><span class="ew-table-header-sort"><?php if ($prestado->CI_Lector->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prestado->CI_Lector->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prestado->Nombres->Visible) { // Nombres ?>
	<?php if ($prestado->sortUrl($prestado->Nombres) == "") { ?>
		<th data-name="Nombres" class="<?php echo $prestado->Nombres->headerCellClass() ?>"><div id="elh_prestado_Nombres" class="prestado_Nombres"><div class="ew-table-header-caption"><?php echo $prestado->Nombres->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombres" class="<?php echo $prestado->Nombres->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prestado->SortUrl($prestado->Nombres) ?>',1);"><div id="elh_prestado_Nombres" class="prestado_Nombres">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prestado->Nombres->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($prestado->Nombres->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prestado->Nombres->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prestado->Apellidos->Visible) { // Apellidos ?>
	<?php if ($prestado->sortUrl($prestado->Apellidos) == "") { ?>
		<th data-name="Apellidos" class="<?php echo $prestado->Apellidos->headerCellClass() ?>"><div id="elh_prestado_Apellidos" class="prestado_Apellidos"><div class="ew-table-header-caption"><?php echo $prestado->Apellidos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Apellidos" class="<?php echo $prestado->Apellidos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prestado->SortUrl($prestado->Apellidos) ?>',1);"><div id="elh_prestado_Apellidos" class="prestado_Apellidos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prestado->Apellidos->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($prestado->Apellidos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prestado->Apellidos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prestado->Titulo->Visible) { // Titulo ?>
	<?php if ($prestado->sortUrl($prestado->Titulo) == "") { ?>
		<th data-name="Titulo" class="<?php echo $prestado->Titulo->headerCellClass() ?>"><div id="elh_prestado_Titulo" class="prestado_Titulo"><div class="ew-table-header-caption"><?php echo $prestado->Titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Titulo" class="<?php echo $prestado->Titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prestado->SortUrl($prestado->Titulo) ?>',1);"><div id="elh_prestado_Titulo" class="prestado_Titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prestado->Titulo->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($prestado->Titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prestado->Titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prestado->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
	<?php if ($prestado->sortUrl($prestado->Fecha_Prestamo) == "") { ?>
		<th data-name="Fecha_Prestamo" class="<?php echo $prestado->Fecha_Prestamo->headerCellClass() ?>"><div id="elh_prestado_Fecha_Prestamo" class="prestado_Fecha_Prestamo"><div class="ew-table-header-caption"><?php echo $prestado->Fecha_Prestamo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fecha_Prestamo" class="<?php echo $prestado->Fecha_Prestamo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prestado->SortUrl($prestado->Fecha_Prestamo) ?>',1);"><div id="elh_prestado_Fecha_Prestamo" class="prestado_Fecha_Prestamo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prestado->Fecha_Prestamo->caption() ?></span><span class="ew-table-header-sort"><?php if ($prestado->Fecha_Prestamo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prestado->Fecha_Prestamo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$prestado_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($prestado->ExportAll && $prestado->isExport()) {
	$prestado_list->StopRec = $prestado_list->TotalRecs;
} else {

	// Set the last record to display
	if ($prestado_list->TotalRecs > $prestado_list->StartRec + $prestado_list->DisplayRecs - 1)
		$prestado_list->StopRec = $prestado_list->StartRec + $prestado_list->DisplayRecs - 1;
	else
		$prestado_list->StopRec = $prestado_list->TotalRecs;
}
$prestado_list->RecCnt = $prestado_list->StartRec - 1;
if ($prestado_list->Recordset && !$prestado_list->Recordset->EOF) {
	$prestado_list->Recordset->moveFirst();
	$selectLimit = $prestado_list->UseSelectLimit;
	if (!$selectLimit && $prestado_list->StartRec > 1)
		$prestado_list->Recordset->move($prestado_list->StartRec - 1);
} elseif (!$prestado->AllowAddDeleteRow && $prestado_list->StopRec == 0) {
	$prestado_list->StopRec = $prestado->GridAddRowCount;
}

// Initialize aggregate
$prestado->RowType = ROWTYPE_AGGREGATEINIT;
$prestado->resetAttributes();
$prestado_list->renderRow();
while ($prestado_list->RecCnt < $prestado_list->StopRec) {
	$prestado_list->RecCnt++;
	if ($prestado_list->RecCnt >= $prestado_list->StartRec) {
		$prestado_list->RowCnt++;

		// Set up key count
		$prestado_list->KeyCount = $prestado_list->RowIndex;

		// Init row class and style
		$prestado->resetAttributes();
		$prestado->CssClass = "";
		if ($prestado->isGridAdd()) {
		} else {
			$prestado_list->loadRowValues($prestado_list->Recordset); // Load row values
		}
		$prestado->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$prestado->RowAttrs = array_merge($prestado->RowAttrs, array('data-rowindex'=>$prestado_list->RowCnt, 'id'=>'r' . $prestado_list->RowCnt . '_prestado', 'data-rowtype'=>$prestado->RowType));

		// Render row
		$prestado_list->renderRow();

		// Render list options
		$prestado_list->renderListOptions();
?>
	<tr<?php echo $prestado->rowAttributes() ?>>
<?php

// Render list options (body, left)
$prestado_list->ListOptions->render("body", "left", $prestado_list->RowCnt);
?>
	<?php if ($prestado->CI_Lector->Visible) { // CI_Lector ?>
		<td data-name="CI_Lector"<?php echo $prestado->CI_Lector->cellAttributes() ?>>
<span id="el<?php echo $prestado_list->RowCnt ?>_prestado_CI_Lector" class="prestado_CI_Lector">
<span<?php echo $prestado->CI_Lector->viewAttributes() ?>>
<?php echo $prestado->CI_Lector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prestado->Nombres->Visible) { // Nombres ?>
		<td data-name="Nombres"<?php echo $prestado->Nombres->cellAttributes() ?>>
<span id="el<?php echo $prestado_list->RowCnt ?>_prestado_Nombres" class="prestado_Nombres">
<span<?php echo $prestado->Nombres->viewAttributes() ?>>
<?php echo $prestado->Nombres->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prestado->Apellidos->Visible) { // Apellidos ?>
		<td data-name="Apellidos"<?php echo $prestado->Apellidos->cellAttributes() ?>>
<span id="el<?php echo $prestado_list->RowCnt ?>_prestado_Apellidos" class="prestado_Apellidos">
<span<?php echo $prestado->Apellidos->viewAttributes() ?>>
<?php echo $prestado->Apellidos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prestado->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo"<?php echo $prestado->Titulo->cellAttributes() ?>>
<span id="el<?php echo $prestado_list->RowCnt ?>_prestado_Titulo" class="prestado_Titulo">
<span<?php echo $prestado->Titulo->viewAttributes() ?>>
<?php echo $prestado->Titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prestado->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
		<td data-name="Fecha_Prestamo"<?php echo $prestado->Fecha_Prestamo->cellAttributes() ?>>
<span id="el<?php echo $prestado_list->RowCnt ?>_prestado_Fecha_Prestamo" class="prestado_Fecha_Prestamo">
<span<?php echo $prestado->Fecha_Prestamo->viewAttributes() ?>>
<?php echo $prestado->Fecha_Prestamo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$prestado_list->ListOptions->render("body", "right", $prestado_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$prestado->isGridAdd())
		$prestado_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$prestado->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($prestado_list->Recordset)
	$prestado_list->Recordset->Close();
?>
<?php if (!$prestado->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$prestado->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($prestado_list->Pager)) $prestado_list->Pager = new PrevNextPager($prestado_list->StartRec, $prestado_list->DisplayRecs, $prestado_list->TotalRecs, $prestado_list->AutoHidePager) ?>
<?php if ($prestado_list->Pager->RecordCount > 0 && $prestado_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($prestado_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $prestado_list->pageUrl() ?>start=<?php echo $prestado_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($prestado_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $prestado_list->pageUrl() ?>start=<?php echo $prestado_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $prestado_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($prestado_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $prestado_list->pageUrl() ?>start=<?php echo $prestado_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($prestado_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $prestado_list->pageUrl() ?>start=<?php echo $prestado_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $prestado_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($prestado_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $prestado_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $prestado_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $prestado_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($prestado_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($prestado_list->TotalRecs == 0 && !$prestado->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($prestado_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$prestado_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$prestado->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$prestado_list->terminate();
?>
