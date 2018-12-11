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
$t_transaccion_list = new t_transaccion_list();

// Run the page
$t_transaccion_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_transaccion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_transaccion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ft_transaccionlist = currentForm = new ew.Form("ft_transaccionlist", "list");
ft_transaccionlist.formKeyCountName = '<?php echo $t_transaccion_list->FormKeyCountName ?>';

// Form_CustomValidate event
ft_transaccionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_transaccionlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_transaccionlist.lists["x_CI_Lector"] = <?php echo $t_transaccion_list->CI_Lector->Lookup->toClientList() ?>;
ft_transaccionlist.lists["x_CI_Lector"].options = <?php echo JsonEncode($t_transaccion_list->CI_Lector->lookupOptions()) ?>;
ft_transaccionlist.lists["x_Cod_libro"] = <?php echo $t_transaccion_list->Cod_libro->Lookup->toClientList() ?>;
ft_transaccionlist.lists["x_Cod_libro"].options = <?php echo JsonEncode($t_transaccion_list->Cod_libro->lookupOptions()) ?>;

// Form object for search
var ft_transaccionlistsrch = currentSearchForm = new ew.Form("ft_transaccionlistsrch");

// Filters
ft_transaccionlistsrch.filterList = <?php echo $t_transaccion_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_transaccion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_transaccion_list->TotalRecs > 0 && $t_transaccion_list->ExportOptions->visible()) { ?>
<?php $t_transaccion_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_transaccion_list->ImportOptions->visible()) { ?>
<?php $t_transaccion_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_transaccion_list->SearchOptions->visible()) { ?>
<?php $t_transaccion_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_transaccion_list->FilterOptions->visible()) { ?>
<?php $t_transaccion_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_transaccion_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_transaccion->isExport() && !$t_transaccion->CurrentAction) { ?>
<form name="ft_transaccionlistsrch" id="ft_transaccionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($t_transaccion_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ft_transaccionlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_transaccion">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($t_transaccion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($t_transaccion_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_transaccion_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_transaccion_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_transaccion_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_transaccion_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_transaccion_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $t_transaccion_list->showPageHeader(); ?>
<?php
$t_transaccion_list->showMessage();
?>
<?php if ($t_transaccion_list->TotalRecs > 0 || $t_transaccion->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_transaccion_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_transaccion">
<form name="ft_transaccionlist" id="ft_transaccionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_transaccion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_transaccion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_transaccion">
<div id="gmp_t_transaccion" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($t_transaccion_list->TotalRecs > 0 || $t_transaccion->isGridEdit()) { ?>
<table id="tbl_t_transaccionlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_transaccion_list->RowType = ROWTYPE_HEADER;

// Render list options
$t_transaccion_list->renderListOptions();

// Render list options (header, left)
$t_transaccion_list->ListOptions->render("header", "left");
?>
<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Id_tran) == "") { ?>
		<th data-name="Id_tran" class="<?php echo $t_transaccion->Id_tran->headerCellClass() ?>"><div id="elh_t_transaccion_Id_tran" class="t_transaccion_Id_tran"><div class="ew-table-header-caption"><?php echo $t_transaccion->Id_tran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_tran" class="<?php echo $t_transaccion->Id_tran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Id_tran) ?>',1);"><div id="elh_t_transaccion_Id_tran" class="t_transaccion_Id_tran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Id_tran->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Id_tran->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Id_tran->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->CI_Lector) == "") { ?>
		<th data-name="CI_Lector" class="<?php echo $t_transaccion->CI_Lector->headerCellClass() ?>"><div id="elh_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector"><div class="ew-table-header-caption"><?php echo $t_transaccion->CI_Lector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CI_Lector" class="<?php echo $t_transaccion->CI_Lector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->CI_Lector) ?>',1);"><div id="elh_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->CI_Lector->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->CI_Lector->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->CI_Lector->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Nombres) == "") { ?>
		<th data-name="Nombres" class="<?php echo $t_transaccion->Nombres->headerCellClass() ?>"><div id="elh_t_transaccion_Nombres" class="t_transaccion_Nombres"><div class="ew-table-header-caption"><?php echo $t_transaccion->Nombres->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombres" class="<?php echo $t_transaccion->Nombres->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Nombres) ?>',1);"><div id="elh_t_transaccion_Nombres" class="t_transaccion_Nombres">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Nombres->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Nombres->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Nombres->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Apellidos) == "") { ?>
		<th data-name="Apellidos" class="<?php echo $t_transaccion->Apellidos->headerCellClass() ?>"><div id="elh_t_transaccion_Apellidos" class="t_transaccion_Apellidos"><div class="ew-table-header-caption"><?php echo $t_transaccion->Apellidos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Apellidos" class="<?php echo $t_transaccion->Apellidos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Apellidos) ?>',1);"><div id="elh_t_transaccion_Apellidos" class="t_transaccion_Apellidos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Apellidos->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Apellidos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Apellidos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Cod_libro) == "") { ?>
		<th data-name="Cod_libro" class="<?php echo $t_transaccion->Cod_libro->headerCellClass() ?>"><div id="elh_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro"><div class="ew-table-header-caption"><?php echo $t_transaccion->Cod_libro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cod_libro" class="<?php echo $t_transaccion->Cod_libro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Cod_libro) ?>',1);"><div id="elh_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Cod_libro->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Cod_libro->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Cod_libro->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Titulo) == "") { ?>
		<th data-name="Titulo" class="<?php echo $t_transaccion->Titulo->headerCellClass() ?>"><div id="elh_t_transaccion_Titulo" class="t_transaccion_Titulo"><div class="ew-table-header-caption"><?php echo $t_transaccion->Titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Titulo" class="<?php echo $t_transaccion->Titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Titulo) ?>',1);"><div id="elh_t_transaccion_Titulo" class="t_transaccion_Titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Titulo->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Fecha_Prestamo) == "") { ?>
		<th data-name="Fecha_Prestamo" class="<?php echo $t_transaccion->Fecha_Prestamo->headerCellClass() ?>"><div id="elh_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo"><div class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Prestamo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fecha_Prestamo" class="<?php echo $t_transaccion->Fecha_Prestamo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Fecha_Prestamo) ?>',1);"><div id="elh_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Prestamo->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Fecha_Prestamo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Fecha_Prestamo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Fecha_Devolucion) == "") { ?>
		<th data-name="Fecha_Devolucion" class="<?php echo $t_transaccion->Fecha_Devolucion->headerCellClass() ?>"><div id="elh_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion"><div class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Devolucion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fecha_Devolucion" class="<?php echo $t_transaccion->Fecha_Devolucion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Fecha_Devolucion) ?>',1);"><div id="elh_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Devolucion->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Fecha_Devolucion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Fecha_Devolucion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Estado) == "") { ?>
		<th data-name="Estado" class="<?php echo $t_transaccion->Estado->headerCellClass() ?>"><div id="elh_t_transaccion_Estado" class="t_transaccion_Estado"><div class="ew-table-header-caption"><?php echo $t_transaccion->Estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Estado" class="<?php echo $t_transaccion->Estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_transaccion->SortUrl($t_transaccion->Estado) ?>',1);"><div id="elh_t_transaccion_Estado" class="t_transaccion_Estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Estado->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_transaccion_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_transaccion->ExportAll && $t_transaccion->isExport()) {
	$t_transaccion_list->StopRec = $t_transaccion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t_transaccion_list->TotalRecs > $t_transaccion_list->StartRec + $t_transaccion_list->DisplayRecs - 1)
		$t_transaccion_list->StopRec = $t_transaccion_list->StartRec + $t_transaccion_list->DisplayRecs - 1;
	else
		$t_transaccion_list->StopRec = $t_transaccion_list->TotalRecs;
}
$t_transaccion_list->RecCnt = $t_transaccion_list->StartRec - 1;
if ($t_transaccion_list->Recordset && !$t_transaccion_list->Recordset->EOF) {
	$t_transaccion_list->Recordset->moveFirst();
	$selectLimit = $t_transaccion_list->UseSelectLimit;
	if (!$selectLimit && $t_transaccion_list->StartRec > 1)
		$t_transaccion_list->Recordset->move($t_transaccion_list->StartRec - 1);
} elseif (!$t_transaccion->AllowAddDeleteRow && $t_transaccion_list->StopRec == 0) {
	$t_transaccion_list->StopRec = $t_transaccion->GridAddRowCount;
}

// Initialize aggregate
$t_transaccion->RowType = ROWTYPE_AGGREGATEINIT;
$t_transaccion->resetAttributes();
$t_transaccion_list->renderRow();
while ($t_transaccion_list->RecCnt < $t_transaccion_list->StopRec) {
	$t_transaccion_list->RecCnt++;
	if ($t_transaccion_list->RecCnt >= $t_transaccion_list->StartRec) {
		$t_transaccion_list->RowCnt++;

		// Set up key count
		$t_transaccion_list->KeyCount = $t_transaccion_list->RowIndex;

		// Init row class and style
		$t_transaccion->resetAttributes();
		$t_transaccion->CssClass = "";
		if ($t_transaccion->isGridAdd()) {
		} else {
			$t_transaccion_list->loadRowValues($t_transaccion_list->Recordset); // Load row values
		}
		$t_transaccion->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_transaccion->RowAttrs = array_merge($t_transaccion->RowAttrs, array('data-rowindex'=>$t_transaccion_list->RowCnt, 'id'=>'r' . $t_transaccion_list->RowCnt . '_t_transaccion', 'data-rowtype'=>$t_transaccion->RowType));

		// Render row
		$t_transaccion_list->renderRow();

		// Render list options
		$t_transaccion_list->renderListOptions();
?>
	<tr<?php echo $t_transaccion->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_transaccion_list->ListOptions->render("body", "left", $t_transaccion_list->RowCnt);
?>
	<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
		<td data-name="Id_tran"<?php echo $t_transaccion->Id_tran->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Id_tran" class="t_transaccion_Id_tran">
<span<?php echo $t_transaccion->Id_tran->viewAttributes() ?>>
<?php echo $t_transaccion->Id_tran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
		<td data-name="CI_Lector"<?php echo $t_transaccion->CI_Lector->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<?php echo $t_transaccion->CI_Lector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
		<td data-name="Nombres"<?php echo $t_transaccion->Nombres->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Nombres" class="t_transaccion_Nombres">
<span<?php echo $t_transaccion->Nombres->viewAttributes() ?>>
<?php echo $t_transaccion->Nombres->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
		<td data-name="Apellidos"<?php echo $t_transaccion->Apellidos->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Apellidos" class="t_transaccion_Apellidos">
<span<?php echo $t_transaccion->Apellidos->viewAttributes() ?>>
<?php echo $t_transaccion->Apellidos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
		<td data-name="Cod_libro"<?php echo $t_transaccion->Cod_libro->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro">
<span<?php echo $t_transaccion->Cod_libro->viewAttributes() ?>>
<?php echo $t_transaccion->Cod_libro->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo"<?php echo $t_transaccion->Titulo->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Titulo" class="t_transaccion_Titulo">
<span<?php echo $t_transaccion->Titulo->viewAttributes() ?>>
<?php echo $t_transaccion->Titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
		<td data-name="Fecha_Prestamo"<?php echo $t_transaccion->Fecha_Prestamo->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo">
<span<?php echo $t_transaccion->Fecha_Prestamo->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Prestamo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
		<td data-name="Fecha_Devolucion"<?php echo $t_transaccion->Fecha_Devolucion->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion">
<span<?php echo $t_transaccion->Fecha_Devolucion->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Devolucion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
		<td data-name="Estado"<?php echo $t_transaccion->Estado->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_list->RowCnt ?>_t_transaccion_Estado" class="t_transaccion_Estado">
<span<?php echo $t_transaccion->Estado->viewAttributes() ?>>
<?php echo $t_transaccion->Estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_transaccion_list->ListOptions->render("body", "right", $t_transaccion_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$t_transaccion->isGridAdd())
		$t_transaccion_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$t_transaccion->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_transaccion_list->Recordset)
	$t_transaccion_list->Recordset->Close();
?>
<?php if (!$t_transaccion->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_transaccion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($t_transaccion_list->Pager)) $t_transaccion_list->Pager = new PrevNextPager($t_transaccion_list->StartRec, $t_transaccion_list->DisplayRecs, $t_transaccion_list->TotalRecs, $t_transaccion_list->AutoHidePager) ?>
<?php if ($t_transaccion_list->Pager->RecordCount > 0 && $t_transaccion_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($t_transaccion_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_transaccion_list->pageUrl() ?>start=<?php echo $t_transaccion_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($t_transaccion_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_transaccion_list->pageUrl() ?>start=<?php echo $t_transaccion_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $t_transaccion_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($t_transaccion_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_transaccion_list->pageUrl() ?>start=<?php echo $t_transaccion_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($t_transaccion_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_transaccion_list->pageUrl() ?>start=<?php echo $t_transaccion_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_transaccion_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($t_transaccion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t_transaccion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t_transaccion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t_transaccion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_transaccion_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_transaccion_list->TotalRecs == 0 && !$t_transaccion->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_transaccion_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_transaccion_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$t_transaccion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t_transaccion_list->terminate();
?>
