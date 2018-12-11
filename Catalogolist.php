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
$Catalogo_list = new Catalogo_list();

// Run the page
$Catalogo_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Catalogo_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Catalogo->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fCatalogolist = currentForm = new ew.Form("fCatalogolist", "list");
fCatalogolist.formKeyCountName = '<?php echo $Catalogo_list->FormKeyCountName ?>';

// Form_CustomValidate event
fCatalogolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCatalogolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fCatalogolist.lists["x_Area"] = <?php echo $Catalogo_list->Area->Lookup->toClientList() ?>;
fCatalogolist.lists["x_Area"].options = <?php echo JsonEncode($Catalogo_list->Area->lookupOptions()) ?>;
fCatalogolist.lists["x_Categoria"] = <?php echo $Catalogo_list->Categoria->Lookup->toClientList() ?>;
fCatalogolist.lists["x_Categoria"].options = <?php echo JsonEncode($Catalogo_list->Categoria->lookupOptions()) ?>;

// Form object for search
var fCatalogolistsrch = currentSearchForm = new ew.Form("fCatalogolistsrch");

// Filters
fCatalogolistsrch.filterList = <?php echo $Catalogo_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$Catalogo->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Catalogo_list->TotalRecs > 0 && $Catalogo_list->ExportOptions->visible()) { ?>
<?php $Catalogo_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Catalogo_list->ImportOptions->visible()) { ?>
<?php $Catalogo_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Catalogo_list->SearchOptions->visible()) { ?>
<?php $Catalogo_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Catalogo_list->FilterOptions->visible()) { ?>
<?php $Catalogo_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Catalogo_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Catalogo->isExport() && !$Catalogo->CurrentAction) { ?>
<form name="fCatalogolistsrch" id="fCatalogolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Catalogo_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fCatalogolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Catalogo">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($Catalogo_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($Catalogo_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Catalogo_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Catalogo_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Catalogo_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Catalogo_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Catalogo_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $Catalogo_list->showPageHeader(); ?>
<?php
$Catalogo_list->showMessage();
?>
<?php if ($Catalogo_list->TotalRecs > 0 || $Catalogo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Catalogo_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Catalogo">
<form name="fCatalogolist" id="fCatalogolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Catalogo_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Catalogo_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Catalogo">
<div id="gmp_Catalogo" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($Catalogo_list->TotalRecs > 0 || $Catalogo->isGridEdit()) { ?>
<table id="tbl_Catalogolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Catalogo_list->RowType = ROWTYPE_HEADER;

// Render list options
$Catalogo_list->renderListOptions();

// Render list options (header, left)
$Catalogo_list->ListOptions->render("header", "left");
?>
<?php if ($Catalogo->Codigo_Libro->Visible) { // Codigo_Libro ?>
	<?php if ($Catalogo->sortUrl($Catalogo->Codigo_Libro) == "") { ?>
		<th data-name="Codigo_Libro" class="<?php echo $Catalogo->Codigo_Libro->headerCellClass() ?>"><div id="elh_Catalogo_Codigo_Libro" class="Catalogo_Codigo_Libro"><div class="ew-table-header-caption"><?php echo $Catalogo->Codigo_Libro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Codigo_Libro" class="<?php echo $Catalogo->Codigo_Libro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Catalogo->SortUrl($Catalogo->Codigo_Libro) ?>',1);"><div id="elh_Catalogo_Codigo_Libro" class="Catalogo_Codigo_Libro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Catalogo->Codigo_Libro->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Catalogo->Codigo_Libro->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Catalogo->Codigo_Libro->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Catalogo->Titulo->Visible) { // Titulo ?>
	<?php if ($Catalogo->sortUrl($Catalogo->Titulo) == "") { ?>
		<th data-name="Titulo" class="<?php echo $Catalogo->Titulo->headerCellClass() ?>"><div id="elh_Catalogo_Titulo" class="Catalogo_Titulo"><div class="ew-table-header-caption"><?php echo $Catalogo->Titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Titulo" class="<?php echo $Catalogo->Titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Catalogo->SortUrl($Catalogo->Titulo) ?>',1);"><div id="elh_Catalogo_Titulo" class="Catalogo_Titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Catalogo->Titulo->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Catalogo->Titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Catalogo->Titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Catalogo->Autor->Visible) { // Autor ?>
	<?php if ($Catalogo->sortUrl($Catalogo->Autor) == "") { ?>
		<th data-name="Autor" class="<?php echo $Catalogo->Autor->headerCellClass() ?>"><div id="elh_Catalogo_Autor" class="Catalogo_Autor"><div class="ew-table-header-caption"><?php echo $Catalogo->Autor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Autor" class="<?php echo $Catalogo->Autor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Catalogo->SortUrl($Catalogo->Autor) ?>',1);"><div id="elh_Catalogo_Autor" class="Catalogo_Autor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Catalogo->Autor->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Catalogo->Autor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Catalogo->Autor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Catalogo->Editorial->Visible) { // Editorial ?>
	<?php if ($Catalogo->sortUrl($Catalogo->Editorial) == "") { ?>
		<th data-name="Editorial" class="<?php echo $Catalogo->Editorial->headerCellClass() ?>"><div id="elh_Catalogo_Editorial" class="Catalogo_Editorial"><div class="ew-table-header-caption"><?php echo $Catalogo->Editorial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Editorial" class="<?php echo $Catalogo->Editorial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Catalogo->SortUrl($Catalogo->Editorial) ?>',1);"><div id="elh_Catalogo_Editorial" class="Catalogo_Editorial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Catalogo->Editorial->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Catalogo->Editorial->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Catalogo->Editorial->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Catalogo->Edicion->Visible) { // Edicion ?>
	<?php if ($Catalogo->sortUrl($Catalogo->Edicion) == "") { ?>
		<th data-name="Edicion" class="<?php echo $Catalogo->Edicion->headerCellClass() ?>"><div id="elh_Catalogo_Edicion" class="Catalogo_Edicion"><div class="ew-table-header-caption"><?php echo $Catalogo->Edicion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Edicion" class="<?php echo $Catalogo->Edicion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Catalogo->SortUrl($Catalogo->Edicion) ?>',1);"><div id="elh_Catalogo_Edicion" class="Catalogo_Edicion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Catalogo->Edicion->caption() ?></span><span class="ew-table-header-sort"><?php if ($Catalogo->Edicion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Catalogo->Edicion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Catalogo->Area->Visible) { // Area ?>
	<?php if ($Catalogo->sortUrl($Catalogo->Area) == "") { ?>
		<th data-name="Area" class="<?php echo $Catalogo->Area->headerCellClass() ?>"><div id="elh_Catalogo_Area" class="Catalogo_Area"><div class="ew-table-header-caption"><?php echo $Catalogo->Area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Area" class="<?php echo $Catalogo->Area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Catalogo->SortUrl($Catalogo->Area) ?>',1);"><div id="elh_Catalogo_Area" class="Catalogo_Area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Catalogo->Area->caption() ?></span><span class="ew-table-header-sort"><?php if ($Catalogo->Area->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Catalogo->Area->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Catalogo->Categoria->Visible) { // Categoria ?>
	<?php if ($Catalogo->sortUrl($Catalogo->Categoria) == "") { ?>
		<th data-name="Categoria" class="<?php echo $Catalogo->Categoria->headerCellClass() ?>"><div id="elh_Catalogo_Categoria" class="Catalogo_Categoria"><div class="ew-table-header-caption"><?php echo $Catalogo->Categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Categoria" class="<?php echo $Catalogo->Categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Catalogo->SortUrl($Catalogo->Categoria) ?>',1);"><div id="elh_Catalogo_Categoria" class="Catalogo_Categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Catalogo->Categoria->caption() ?></span><span class="ew-table-header-sort"><?php if ($Catalogo->Categoria->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Catalogo->Categoria->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Catalogo_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Catalogo->ExportAll && $Catalogo->isExport()) {
	$Catalogo_list->StopRec = $Catalogo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Catalogo_list->TotalRecs > $Catalogo_list->StartRec + $Catalogo_list->DisplayRecs - 1)
		$Catalogo_list->StopRec = $Catalogo_list->StartRec + $Catalogo_list->DisplayRecs - 1;
	else
		$Catalogo_list->StopRec = $Catalogo_list->TotalRecs;
}
$Catalogo_list->RecCnt = $Catalogo_list->StartRec - 1;
if ($Catalogo_list->Recordset && !$Catalogo_list->Recordset->EOF) {
	$Catalogo_list->Recordset->moveFirst();
	$selectLimit = $Catalogo_list->UseSelectLimit;
	if (!$selectLimit && $Catalogo_list->StartRec > 1)
		$Catalogo_list->Recordset->move($Catalogo_list->StartRec - 1);
} elseif (!$Catalogo->AllowAddDeleteRow && $Catalogo_list->StopRec == 0) {
	$Catalogo_list->StopRec = $Catalogo->GridAddRowCount;
}

// Initialize aggregate
$Catalogo->RowType = ROWTYPE_AGGREGATEINIT;
$Catalogo->resetAttributes();
$Catalogo_list->renderRow();
while ($Catalogo_list->RecCnt < $Catalogo_list->StopRec) {
	$Catalogo_list->RecCnt++;
	if ($Catalogo_list->RecCnt >= $Catalogo_list->StartRec) {
		$Catalogo_list->RowCnt++;

		// Set up key count
		$Catalogo_list->KeyCount = $Catalogo_list->RowIndex;

		// Init row class and style
		$Catalogo->resetAttributes();
		$Catalogo->CssClass = "";
		if ($Catalogo->isGridAdd()) {
		} else {
			$Catalogo_list->loadRowValues($Catalogo_list->Recordset); // Load row values
		}
		$Catalogo->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Catalogo->RowAttrs = array_merge($Catalogo->RowAttrs, array('data-rowindex'=>$Catalogo_list->RowCnt, 'id'=>'r' . $Catalogo_list->RowCnt . '_Catalogo', 'data-rowtype'=>$Catalogo->RowType));

		// Render row
		$Catalogo_list->renderRow();

		// Render list options
		$Catalogo_list->renderListOptions();
?>
	<tr<?php echo $Catalogo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Catalogo_list->ListOptions->render("body", "left", $Catalogo_list->RowCnt);
?>
	<?php if ($Catalogo->Codigo_Libro->Visible) { // Codigo_Libro ?>
		<td data-name="Codigo_Libro"<?php echo $Catalogo->Codigo_Libro->cellAttributes() ?>>
<span id="el<?php echo $Catalogo_list->RowCnt ?>_Catalogo_Codigo_Libro" class="Catalogo_Codigo_Libro">
<span<?php echo $Catalogo->Codigo_Libro->viewAttributes() ?>>
<?php echo $Catalogo->Codigo_Libro->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Catalogo->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo"<?php echo $Catalogo->Titulo->cellAttributes() ?>>
<span id="el<?php echo $Catalogo_list->RowCnt ?>_Catalogo_Titulo" class="Catalogo_Titulo">
<span<?php echo $Catalogo->Titulo->viewAttributes() ?>>
<?php echo $Catalogo->Titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Catalogo->Autor->Visible) { // Autor ?>
		<td data-name="Autor"<?php echo $Catalogo->Autor->cellAttributes() ?>>
<span id="el<?php echo $Catalogo_list->RowCnt ?>_Catalogo_Autor" class="Catalogo_Autor">
<span<?php echo $Catalogo->Autor->viewAttributes() ?>>
<?php echo $Catalogo->Autor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Catalogo->Editorial->Visible) { // Editorial ?>
		<td data-name="Editorial"<?php echo $Catalogo->Editorial->cellAttributes() ?>>
<span id="el<?php echo $Catalogo_list->RowCnt ?>_Catalogo_Editorial" class="Catalogo_Editorial">
<span<?php echo $Catalogo->Editorial->viewAttributes() ?>>
<?php echo $Catalogo->Editorial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Catalogo->Edicion->Visible) { // Edicion ?>
		<td data-name="Edicion"<?php echo $Catalogo->Edicion->cellAttributes() ?>>
<span id="el<?php echo $Catalogo_list->RowCnt ?>_Catalogo_Edicion" class="Catalogo_Edicion">
<span<?php echo $Catalogo->Edicion->viewAttributes() ?>>
<?php echo $Catalogo->Edicion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Catalogo->Area->Visible) { // Area ?>
		<td data-name="Area"<?php echo $Catalogo->Area->cellAttributes() ?>>
<span id="el<?php echo $Catalogo_list->RowCnt ?>_Catalogo_Area" class="Catalogo_Area">
<span<?php echo $Catalogo->Area->viewAttributes() ?>>
<?php echo $Catalogo->Area->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Catalogo->Categoria->Visible) { // Categoria ?>
		<td data-name="Categoria"<?php echo $Catalogo->Categoria->cellAttributes() ?>>
<span id="el<?php echo $Catalogo_list->RowCnt ?>_Catalogo_Categoria" class="Catalogo_Categoria">
<span<?php echo $Catalogo->Categoria->viewAttributes() ?>>
<?php echo $Catalogo->Categoria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Catalogo_list->ListOptions->render("body", "right", $Catalogo_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$Catalogo->isGridAdd())
		$Catalogo_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$Catalogo->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Catalogo_list->Recordset)
	$Catalogo_list->Recordset->Close();
?>
<?php if (!$Catalogo->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Catalogo->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Catalogo_list->Pager)) $Catalogo_list->Pager = new PrevNextPager($Catalogo_list->StartRec, $Catalogo_list->DisplayRecs, $Catalogo_list->TotalRecs, $Catalogo_list->AutoHidePager) ?>
<?php if ($Catalogo_list->Pager->RecordCount > 0 && $Catalogo_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($Catalogo_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $Catalogo_list->pageUrl() ?>start=<?php echo $Catalogo_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($Catalogo_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $Catalogo_list->pageUrl() ?>start=<?php echo $Catalogo_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $Catalogo_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($Catalogo_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $Catalogo_list->pageUrl() ?>start=<?php echo $Catalogo_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($Catalogo_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $Catalogo_list->pageUrl() ?>start=<?php echo $Catalogo_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $Catalogo_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Catalogo_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Catalogo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Catalogo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Catalogo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($Catalogo_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Catalogo_list->TotalRecs == 0 && !$Catalogo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($Catalogo_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Catalogo_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Catalogo->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Catalogo_list->terminate();
?>
