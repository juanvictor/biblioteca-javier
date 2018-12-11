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
$t_lector_list = new t_lector_list();

// Run the page
$t_lector_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lector_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_lector->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ft_lectorlist = currentForm = new ew.Form("ft_lectorlist", "list");
ft_lectorlist.formKeyCountName = '<?php echo $t_lector_list->FormKeyCountName ?>';

// Form_CustomValidate event
ft_lectorlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_lectorlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ft_lectorlistsrch = currentSearchForm = new ew.Form("ft_lectorlistsrch");

// Filters
ft_lectorlistsrch.filterList = <?php echo $t_lector_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_lector->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_lector_list->TotalRecs > 0 && $t_lector_list->ExportOptions->visible()) { ?>
<?php $t_lector_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_lector_list->ImportOptions->visible()) { ?>
<?php $t_lector_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_lector_list->SearchOptions->visible()) { ?>
<?php $t_lector_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_lector_list->FilterOptions->visible()) { ?>
<?php $t_lector_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_lector_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_lector->isExport() && !$t_lector->CurrentAction) { ?>
<form name="ft_lectorlistsrch" id="ft_lectorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($t_lector_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ft_lectorlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_lector">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($t_lector_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($t_lector_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_lector_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_lector_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_lector_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_lector_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_lector_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $t_lector_list->showPageHeader(); ?>
<?php
$t_lector_list->showMessage();
?>
<?php if ($t_lector_list->TotalRecs > 0 || $t_lector->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_lector_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_lector">
<form name="ft_lectorlist" id="ft_lectorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_lector_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_lector_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_lector">
<div id="gmp_t_lector" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($t_lector_list->TotalRecs > 0 || $t_lector->isGridEdit()) { ?>
<table id="tbl_t_lectorlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_lector_list->RowType = ROWTYPE_HEADER;

// Render list options
$t_lector_list->renderListOptions();

// Render list options (header, left)
$t_lector_list->ListOptions->render("header", "left");
?>
<?php if ($t_lector->Id_lector->Visible) { // Id_lector ?>
	<?php if ($t_lector->sortUrl($t_lector->Id_lector) == "") { ?>
		<th data-name="Id_lector" class="<?php echo $t_lector->Id_lector->headerCellClass() ?>"><div id="elh_t_lector_Id_lector" class="t_lector_Id_lector"><div class="ew-table-header-caption"><?php echo $t_lector->Id_lector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_lector" class="<?php echo $t_lector->Id_lector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->Id_lector) ?>',1);"><div id="elh_t_lector_Id_lector" class="t_lector_Id_lector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->Id_lector->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_lector->Id_lector->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->Id_lector->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
	<?php if ($t_lector->sortUrl($t_lector->CI_DNI) == "") { ?>
		<th data-name="CI_DNI" class="<?php echo $t_lector->CI_DNI->headerCellClass() ?>"><div id="elh_t_lector_CI_DNI" class="t_lector_CI_DNI"><div class="ew-table-header-caption"><?php echo $t_lector->CI_DNI->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CI_DNI" class="<?php echo $t_lector->CI_DNI->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->CI_DNI) ?>',1);"><div id="elh_t_lector_CI_DNI" class="t_lector_CI_DNI">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->CI_DNI->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_lector->CI_DNI->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->CI_DNI->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
	<?php if ($t_lector->sortUrl($t_lector->Nombres) == "") { ?>
		<th data-name="Nombres" class="<?php echo $t_lector->Nombres->headerCellClass() ?>"><div id="elh_t_lector_Nombres" class="t_lector_Nombres"><div class="ew-table-header-caption"><?php echo $t_lector->Nombres->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombres" class="<?php echo $t_lector->Nombres->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->Nombres) ?>',1);"><div id="elh_t_lector_Nombres" class="t_lector_Nombres">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->Nombres->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_lector->Nombres->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->Nombres->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
	<?php if ($t_lector->sortUrl($t_lector->Apellidos) == "") { ?>
		<th data-name="Apellidos" class="<?php echo $t_lector->Apellidos->headerCellClass() ?>"><div id="elh_t_lector_Apellidos" class="t_lector_Apellidos"><div class="ew-table-header-caption"><?php echo $t_lector->Apellidos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Apellidos" class="<?php echo $t_lector->Apellidos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->Apellidos) ?>',1);"><div id="elh_t_lector_Apellidos" class="t_lector_Apellidos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->Apellidos->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_lector->Apellidos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->Apellidos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
	<?php if ($t_lector->sortUrl($t_lector->Direccion) == "") { ?>
		<th data-name="Direccion" class="<?php echo $t_lector->Direccion->headerCellClass() ?>"><div id="elh_t_lector_Direccion" class="t_lector_Direccion"><div class="ew-table-header-caption"><?php echo $t_lector->Direccion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Direccion" class="<?php echo $t_lector->Direccion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->Direccion) ?>',1);"><div id="elh_t_lector_Direccion" class="t_lector_Direccion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->Direccion->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_lector->Direccion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->Direccion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
	<?php if ($t_lector->sortUrl($t_lector->Telefono) == "") { ?>
		<th data-name="Telefono" class="<?php echo $t_lector->Telefono->headerCellClass() ?>"><div id="elh_t_lector_Telefono" class="t_lector_Telefono"><div class="ew-table-header-caption"><?php echo $t_lector->Telefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telefono" class="<?php echo $t_lector->Telefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->Telefono) ?>',1);"><div id="elh_t_lector_Telefono" class="t_lector_Telefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->Telefono->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_lector->Telefono->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->Telefono->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
	<?php if ($t_lector->sortUrl($t_lector->Tipo_Lector) == "") { ?>
		<th data-name="Tipo_Lector" class="<?php echo $t_lector->Tipo_Lector->headerCellClass() ?>"><div id="elh_t_lector_Tipo_Lector" class="t_lector_Tipo_Lector"><div class="ew-table-header-caption"><?php echo $t_lector->Tipo_Lector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tipo_Lector" class="<?php echo $t_lector->Tipo_Lector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->Tipo_Lector) ?>',1);"><div id="elh_t_lector_Tipo_Lector" class="t_lector_Tipo_Lector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->Tipo_Lector->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_lector->Tipo_Lector->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->Tipo_Lector->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
	<?php if ($t_lector->sortUrl($t_lector->Institucion) == "") { ?>
		<th data-name="Institucion" class="<?php echo $t_lector->Institucion->headerCellClass() ?>"><div id="elh_t_lector_Institucion" class="t_lector_Institucion"><div class="ew-table-header-caption"><?php echo $t_lector->Institucion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Institucion" class="<?php echo $t_lector->Institucion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_lector->SortUrl($t_lector->Institucion) ?>',1);"><div id="elh_t_lector_Institucion" class="t_lector_Institucion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_lector->Institucion->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_lector->Institucion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_lector->Institucion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_lector_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_lector->ExportAll && $t_lector->isExport()) {
	$t_lector_list->StopRec = $t_lector_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t_lector_list->TotalRecs > $t_lector_list->StartRec + $t_lector_list->DisplayRecs - 1)
		$t_lector_list->StopRec = $t_lector_list->StartRec + $t_lector_list->DisplayRecs - 1;
	else
		$t_lector_list->StopRec = $t_lector_list->TotalRecs;
}
$t_lector_list->RecCnt = $t_lector_list->StartRec - 1;
if ($t_lector_list->Recordset && !$t_lector_list->Recordset->EOF) {
	$t_lector_list->Recordset->moveFirst();
	$selectLimit = $t_lector_list->UseSelectLimit;
	if (!$selectLimit && $t_lector_list->StartRec > 1)
		$t_lector_list->Recordset->move($t_lector_list->StartRec - 1);
} elseif (!$t_lector->AllowAddDeleteRow && $t_lector_list->StopRec == 0) {
	$t_lector_list->StopRec = $t_lector->GridAddRowCount;
}

// Initialize aggregate
$t_lector->RowType = ROWTYPE_AGGREGATEINIT;
$t_lector->resetAttributes();
$t_lector_list->renderRow();
while ($t_lector_list->RecCnt < $t_lector_list->StopRec) {
	$t_lector_list->RecCnt++;
	if ($t_lector_list->RecCnt >= $t_lector_list->StartRec) {
		$t_lector_list->RowCnt++;

		// Set up key count
		$t_lector_list->KeyCount = $t_lector_list->RowIndex;

		// Init row class and style
		$t_lector->resetAttributes();
		$t_lector->CssClass = "";
		if ($t_lector->isGridAdd()) {
		} else {
			$t_lector_list->loadRowValues($t_lector_list->Recordset); // Load row values
		}
		$t_lector->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_lector->RowAttrs = array_merge($t_lector->RowAttrs, array('data-rowindex'=>$t_lector_list->RowCnt, 'id'=>'r' . $t_lector_list->RowCnt . '_t_lector', 'data-rowtype'=>$t_lector->RowType));

		// Render row
		$t_lector_list->renderRow();

		// Render list options
		$t_lector_list->renderListOptions();
?>
	<tr<?php echo $t_lector->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_lector_list->ListOptions->render("body", "left", $t_lector_list->RowCnt);
?>
	<?php if ($t_lector->Id_lector->Visible) { // Id_lector ?>
		<td data-name="Id_lector"<?php echo $t_lector->Id_lector->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_Id_lector" class="t_lector_Id_lector">
<span<?php echo $t_lector->Id_lector->viewAttributes() ?>>
<?php echo $t_lector->Id_lector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
		<td data-name="CI_DNI"<?php echo $t_lector->CI_DNI->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_CI_DNI" class="t_lector_CI_DNI">
<span<?php echo $t_lector->CI_DNI->viewAttributes() ?>>
<?php echo $t_lector->CI_DNI->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
		<td data-name="Nombres"<?php echo $t_lector->Nombres->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_Nombres" class="t_lector_Nombres">
<span<?php echo $t_lector->Nombres->viewAttributes() ?>>
<?php echo $t_lector->Nombres->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
		<td data-name="Apellidos"<?php echo $t_lector->Apellidos->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_Apellidos" class="t_lector_Apellidos">
<span<?php echo $t_lector->Apellidos->viewAttributes() ?>>
<?php echo $t_lector->Apellidos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
		<td data-name="Direccion"<?php echo $t_lector->Direccion->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_Direccion" class="t_lector_Direccion">
<span<?php echo $t_lector->Direccion->viewAttributes() ?>>
<?php echo $t_lector->Direccion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
		<td data-name="Telefono"<?php echo $t_lector->Telefono->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_Telefono" class="t_lector_Telefono">
<span<?php echo $t_lector->Telefono->viewAttributes() ?>>
<?php echo $t_lector->Telefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
		<td data-name="Tipo_Lector"<?php echo $t_lector->Tipo_Lector->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_Tipo_Lector" class="t_lector_Tipo_Lector">
<span<?php echo $t_lector->Tipo_Lector->viewAttributes() ?>>
<?php echo $t_lector->Tipo_Lector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
		<td data-name="Institucion"<?php echo $t_lector->Institucion->cellAttributes() ?>>
<span id="el<?php echo $t_lector_list->RowCnt ?>_t_lector_Institucion" class="t_lector_Institucion">
<span<?php echo $t_lector->Institucion->viewAttributes() ?>>
<?php echo $t_lector->Institucion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_lector_list->ListOptions->render("body", "right", $t_lector_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$t_lector->isGridAdd())
		$t_lector_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$t_lector->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_lector_list->Recordset)
	$t_lector_list->Recordset->Close();
?>
<?php if (!$t_lector->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_lector->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($t_lector_list->Pager)) $t_lector_list->Pager = new PrevNextPager($t_lector_list->StartRec, $t_lector_list->DisplayRecs, $t_lector_list->TotalRecs, $t_lector_list->AutoHidePager) ?>
<?php if ($t_lector_list->Pager->RecordCount > 0 && $t_lector_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($t_lector_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_lector_list->pageUrl() ?>start=<?php echo $t_lector_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($t_lector_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_lector_list->pageUrl() ?>start=<?php echo $t_lector_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $t_lector_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($t_lector_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_lector_list->pageUrl() ?>start=<?php echo $t_lector_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($t_lector_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_lector_list->pageUrl() ?>start=<?php echo $t_lector_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_lector_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($t_lector_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t_lector_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t_lector_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t_lector_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_lector_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_lector_list->TotalRecs == 0 && !$t_lector->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_lector_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_lector_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$t_lector->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t_lector_list->terminate();
?>
