<?php
namespace PHPMaker2019\BIBLIOTECA;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_transaccion_grid))
	$t_transaccion_grid = new t_transaccion_grid();

// Run the page
$t_transaccion_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_transaccion_grid->Page_Render();
?>
<?php if (!$t_transaccion->isExport()) { ?>
<script>

// Form object
var ft_transacciongrid = new ew.Form("ft_transacciongrid", "grid");
ft_transacciongrid.formKeyCountName = '<?php echo $t_transaccion_grid->FormKeyCountName ?>';

// Validate form
ft_transacciongrid.validate = function() {
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
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($t_transaccion_grid->Id_tran->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_tran");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Id_tran->caption(), $t_transaccion->Id_tran->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_grid->CI_Lector->Required) { ?>
			elm = this.getElements("x" + infix + "_CI_Lector");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->CI_Lector->caption(), $t_transaccion->CI_Lector->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_grid->Nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_Nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Nombres->caption(), $t_transaccion->Nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_grid->Apellidos->Required) { ?>
			elm = this.getElements("x" + infix + "_Apellidos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Apellidos->caption(), $t_transaccion->Apellidos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_grid->Cod_libro->Required) { ?>
			elm = this.getElements("x" + infix + "_Cod_libro");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Cod_libro->caption(), $t_transaccion->Cod_libro->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_grid->Titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_Titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Titulo->caption(), $t_transaccion->Titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_grid->Fecha_Prestamo->Required) { ?>
			elm = this.getElements("x" + infix + "_Fecha_Prestamo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Fecha_Prestamo->caption(), $t_transaccion->Fecha_Prestamo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Fecha_Prestamo");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($t_transaccion->Fecha_Prestamo->errorMessage()) ?>");
		<?php if ($t_transaccion_grid->Fecha_Devolucion->Required) { ?>
			elm = this.getElements("x" + infix + "_Fecha_Devolucion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Fecha_Devolucion->caption(), $t_transaccion->Fecha_Devolucion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Fecha_Devolucion");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($t_transaccion->Fecha_Devolucion->errorMessage()) ?>");
		<?php if ($t_transaccion_grid->Estado->Required) { ?>
			elm = this.getElements("x" + infix + "_Estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Estado->caption(), $t_transaccion->Estado->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft_transacciongrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "CI_Lector", false)) return false;
	if (ew.valueChanged(fobj, infix, "Nombres", false)) return false;
	if (ew.valueChanged(fobj, infix, "Apellidos", false)) return false;
	if (ew.valueChanged(fobj, infix, "Cod_libro", false)) return false;
	if (ew.valueChanged(fobj, infix, "Titulo", false)) return false;
	if (ew.valueChanged(fobj, infix, "Fecha_Prestamo", false)) return false;
	if (ew.valueChanged(fobj, infix, "Fecha_Devolucion", false)) return false;
	if (ew.valueChanged(fobj, infix, "Estado", false)) return false;
	return true;
}

// Form_CustomValidate event
ft_transacciongrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_transacciongrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$t_transaccion_grid->renderOtherOptions();
?>
<?php $t_transaccion_grid->showPageHeader(); ?>
<?php
$t_transaccion_grid->showMessage();
?>
<?php if ($t_transaccion_grid->TotalRecs > 0 || $t_transaccion->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_transaccion_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_transaccion">
<div id="ft_transacciongrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_transaccion" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_t_transacciongrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_transaccion_grid->RowType = ROWTYPE_HEADER;

// Render list options
$t_transaccion_grid->renderListOptions();

// Render list options (header, left)
$t_transaccion_grid->ListOptions->render("header", "left");
?>
<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Id_tran) == "") { ?>
		<th data-name="Id_tran" class="<?php echo $t_transaccion->Id_tran->headerCellClass() ?>"><div id="elh_t_transaccion_Id_tran" class="t_transaccion_Id_tran"><div class="ew-table-header-caption"><?php echo $t_transaccion->Id_tran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_tran" class="<?php echo $t_transaccion->Id_tran->headerCellClass() ?>"><div><div id="elh_t_transaccion_Id_tran" class="t_transaccion_Id_tran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Id_tran->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Id_tran->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Id_tran->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->CI_Lector) == "") { ?>
		<th data-name="CI_Lector" class="<?php echo $t_transaccion->CI_Lector->headerCellClass() ?>"><div id="elh_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector"><div class="ew-table-header-caption"><?php echo $t_transaccion->CI_Lector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CI_Lector" class="<?php echo $t_transaccion->CI_Lector->headerCellClass() ?>"><div><div id="elh_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->CI_Lector->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->CI_Lector->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->CI_Lector->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Nombres) == "") { ?>
		<th data-name="Nombres" class="<?php echo $t_transaccion->Nombres->headerCellClass() ?>"><div id="elh_t_transaccion_Nombres" class="t_transaccion_Nombres"><div class="ew-table-header-caption"><?php echo $t_transaccion->Nombres->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombres" class="<?php echo $t_transaccion->Nombres->headerCellClass() ?>"><div><div id="elh_t_transaccion_Nombres" class="t_transaccion_Nombres">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Nombres->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Nombres->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Nombres->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Apellidos) == "") { ?>
		<th data-name="Apellidos" class="<?php echo $t_transaccion->Apellidos->headerCellClass() ?>"><div id="elh_t_transaccion_Apellidos" class="t_transaccion_Apellidos"><div class="ew-table-header-caption"><?php echo $t_transaccion->Apellidos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Apellidos" class="<?php echo $t_transaccion->Apellidos->headerCellClass() ?>"><div><div id="elh_t_transaccion_Apellidos" class="t_transaccion_Apellidos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Apellidos->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Apellidos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Apellidos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Cod_libro) == "") { ?>
		<th data-name="Cod_libro" class="<?php echo $t_transaccion->Cod_libro->headerCellClass() ?>"><div id="elh_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro"><div class="ew-table-header-caption"><?php echo $t_transaccion->Cod_libro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cod_libro" class="<?php echo $t_transaccion->Cod_libro->headerCellClass() ?>"><div><div id="elh_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Cod_libro->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Cod_libro->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Cod_libro->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Titulo) == "") { ?>
		<th data-name="Titulo" class="<?php echo $t_transaccion->Titulo->headerCellClass() ?>"><div id="elh_t_transaccion_Titulo" class="t_transaccion_Titulo"><div class="ew-table-header-caption"><?php echo $t_transaccion->Titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Titulo" class="<?php echo $t_transaccion->Titulo->headerCellClass() ?>"><div><div id="elh_t_transaccion_Titulo" class="t_transaccion_Titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Titulo->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Fecha_Prestamo) == "") { ?>
		<th data-name="Fecha_Prestamo" class="<?php echo $t_transaccion->Fecha_Prestamo->headerCellClass() ?>"><div id="elh_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo"><div class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Prestamo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fecha_Prestamo" class="<?php echo $t_transaccion->Fecha_Prestamo->headerCellClass() ?>"><div><div id="elh_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Prestamo->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Fecha_Prestamo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Fecha_Prestamo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Fecha_Devolucion) == "") { ?>
		<th data-name="Fecha_Devolucion" class="<?php echo $t_transaccion->Fecha_Devolucion->headerCellClass() ?>"><div id="elh_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion"><div class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Devolucion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fecha_Devolucion" class="<?php echo $t_transaccion->Fecha_Devolucion->headerCellClass() ?>"><div><div id="elh_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Fecha_Devolucion->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Fecha_Devolucion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Fecha_Devolucion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
	<?php if ($t_transaccion->sortUrl($t_transaccion->Estado) == "") { ?>
		<th data-name="Estado" class="<?php echo $t_transaccion->Estado->headerCellClass() ?>"><div id="elh_t_transaccion_Estado" class="t_transaccion_Estado"><div class="ew-table-header-caption"><?php echo $t_transaccion->Estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Estado" class="<?php echo $t_transaccion->Estado->headerCellClass() ?>"><div><div id="elh_t_transaccion_Estado" class="t_transaccion_Estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_transaccion->Estado->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_transaccion->Estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_transaccion->Estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_transaccion_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_transaccion_grid->StartRec = 1;
$t_transaccion_grid->StopRec = $t_transaccion_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $t_transaccion_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_transaccion_grid->FormKeyCountName) && ($t_transaccion->isGridAdd() || $t_transaccion->isGridEdit() || $t_transaccion->isConfirm())) {
		$t_transaccion_grid->KeyCount = $CurrentForm->getValue($t_transaccion_grid->FormKeyCountName);
		$t_transaccion_grid->StopRec = $t_transaccion_grid->StartRec + $t_transaccion_grid->KeyCount - 1;
	}
}
$t_transaccion_grid->RecCnt = $t_transaccion_grid->StartRec - 1;
if ($t_transaccion_grid->Recordset && !$t_transaccion_grid->Recordset->EOF) {
	$t_transaccion_grid->Recordset->moveFirst();
	$selectLimit = $t_transaccion_grid->UseSelectLimit;
	if (!$selectLimit && $t_transaccion_grid->StartRec > 1)
		$t_transaccion_grid->Recordset->move($t_transaccion_grid->StartRec - 1);
} elseif (!$t_transaccion->AllowAddDeleteRow && $t_transaccion_grid->StopRec == 0) {
	$t_transaccion_grid->StopRec = $t_transaccion->GridAddRowCount;
}

// Initialize aggregate
$t_transaccion->RowType = ROWTYPE_AGGREGATEINIT;
$t_transaccion->resetAttributes();
$t_transaccion_grid->renderRow();
if ($t_transaccion->isGridAdd())
	$t_transaccion_grid->RowIndex = 0;
if ($t_transaccion->isGridEdit())
	$t_transaccion_grid->RowIndex = 0;
while ($t_transaccion_grid->RecCnt < $t_transaccion_grid->StopRec) {
	$t_transaccion_grid->RecCnt++;
	if ($t_transaccion_grid->RecCnt >= $t_transaccion_grid->StartRec) {
		$t_transaccion_grid->RowCnt++;
		if ($t_transaccion->isGridAdd() || $t_transaccion->isGridEdit() || $t_transaccion->isConfirm()) {
			$t_transaccion_grid->RowIndex++;
			$CurrentForm->Index = $t_transaccion_grid->RowIndex;
			if ($CurrentForm->hasValue($t_transaccion_grid->FormActionName) && $t_transaccion_grid->EventCancelled)
				$t_transaccion_grid->RowAction = strval($CurrentForm->getValue($t_transaccion_grid->FormActionName));
			elseif ($t_transaccion->isGridAdd())
				$t_transaccion_grid->RowAction = "insert";
			else
				$t_transaccion_grid->RowAction = "";
		}

		// Set up key count
		$t_transaccion_grid->KeyCount = $t_transaccion_grid->RowIndex;

		// Init row class and style
		$t_transaccion->resetAttributes();
		$t_transaccion->CssClass = "";
		if ($t_transaccion->isGridAdd()) {
			if ($t_transaccion->CurrentMode == "copy") {
				$t_transaccion_grid->loadRowValues($t_transaccion_grid->Recordset); // Load row values
				$t_transaccion_grid->setRecordKey($t_transaccion_grid->RowOldKey, $t_transaccion_grid->Recordset); // Set old record key
			} else {
				$t_transaccion_grid->loadRowValues(); // Load default values
				$t_transaccion_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_transaccion_grid->loadRowValues($t_transaccion_grid->Recordset); // Load row values
		}
		$t_transaccion->RowType = ROWTYPE_VIEW; // Render view
		if ($t_transaccion->isGridAdd()) // Grid add
			$t_transaccion->RowType = ROWTYPE_ADD; // Render add
		if ($t_transaccion->isGridAdd() && $t_transaccion->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_transaccion_grid->restoreCurrentRowFormValues($t_transaccion_grid->RowIndex); // Restore form values
		if ($t_transaccion->isGridEdit()) { // Grid edit
			if ($t_transaccion->EventCancelled)
				$t_transaccion_grid->restoreCurrentRowFormValues($t_transaccion_grid->RowIndex); // Restore form values
			if ($t_transaccion_grid->RowAction == "insert")
				$t_transaccion->RowType = ROWTYPE_ADD; // Render add
			else
				$t_transaccion->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_transaccion->isGridEdit() && ($t_transaccion->RowType == ROWTYPE_EDIT || $t_transaccion->RowType == ROWTYPE_ADD) && $t_transaccion->EventCancelled) // Update failed
			$t_transaccion_grid->restoreCurrentRowFormValues($t_transaccion_grid->RowIndex); // Restore form values
		if ($t_transaccion->RowType == ROWTYPE_EDIT) // Edit row
			$t_transaccion_grid->EditRowCnt++;
		if ($t_transaccion->isConfirm()) // Confirm row
			$t_transaccion_grid->restoreCurrentRowFormValues($t_transaccion_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_transaccion->RowAttrs = array_merge($t_transaccion->RowAttrs, array('data-rowindex'=>$t_transaccion_grid->RowCnt, 'id'=>'r' . $t_transaccion_grid->RowCnt . '_t_transaccion', 'data-rowtype'=>$t_transaccion->RowType));

		// Render row
		$t_transaccion_grid->renderRow();

		// Render list options
		$t_transaccion_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_transaccion_grid->RowAction <> "delete" && $t_transaccion_grid->RowAction <> "insertdelete" && !($t_transaccion_grid->RowAction == "insert" && $t_transaccion->isConfirm() && $t_transaccion_grid->emptyRow())) {
?>
	<tr<?php echo $t_transaccion->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_transaccion_grid->ListOptions->render("body", "left", $t_transaccion_grid->RowCnt);
?>
	<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
		<td data-name="Id_tran"<?php echo $t_transaccion->Id_tran->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Id_tran" class="form-group t_transaccion_Id_tran">
<span<?php echo $t_transaccion->Id_tran->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Id_tran->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->CurrentValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Id_tran" class="t_transaccion_Id_tran">
<span<?php echo $t_transaccion->Id_tran->viewAttributes() ?>>
<?php echo $t_transaccion->Id_tran->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
		<td data-name="CI_Lector"<?php echo $t_transaccion->CI_Lector->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($t_transaccion->CI_Lector->getSessionValue() <> "") { ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_CI_Lector" class="form-group t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->CI_Lector->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_CI_Lector" class="form-group t_transaccion_CI_Lector">
<input type="text" data-table="t_transaccion" data-field="x_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_transaccion->CI_Lector->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->CI_Lector->EditValue ?>"<?php echo $t_transaccion->CI_Lector->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_CI_Lector" name="o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_transaccion->CI_Lector->getSessionValue() <> "") { ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_CI_Lector" class="form-group t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->CI_Lector->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_CI_Lector" class="form-group t_transaccion_CI_Lector">
<input type="text" data-table="t_transaccion" data-field="x_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_transaccion->CI_Lector->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->CI_Lector->EditValue ?>"<?php echo $t_transaccion->CI_Lector->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<?php echo $t_transaccion->CI_Lector->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_CI_Lector" name="o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_CI_Lector" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_CI_Lector" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
		<td data-name="Nombres"<?php echo $t_transaccion->Nombres->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Nombres" class="form-group t_transaccion_Nombres">
<input type="text" data-table="t_transaccion" data-field="x_Nombres" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_transaccion->Nombres->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Nombres->EditValue ?>"<?php echo $t_transaccion->Nombres->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Nombres" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" value="<?php echo HtmlEncode($t_transaccion->Nombres->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Nombres" class="form-group t_transaccion_Nombres">
<input type="text" data-table="t_transaccion" data-field="x_Nombres" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_transaccion->Nombres->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Nombres->EditValue ?>"<?php echo $t_transaccion->Nombres->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Nombres" class="t_transaccion_Nombres">
<span<?php echo $t_transaccion->Nombres->viewAttributes() ?>>
<?php echo $t_transaccion->Nombres->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Nombres" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" value="<?php echo HtmlEncode($t_transaccion->Nombres->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Nombres" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" value="<?php echo HtmlEncode($t_transaccion->Nombres->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Nombres" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" value="<?php echo HtmlEncode($t_transaccion->Nombres->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Nombres" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" value="<?php echo HtmlEncode($t_transaccion->Nombres->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
		<td data-name="Apellidos"<?php echo $t_transaccion->Apellidos->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Apellidos" class="form-group t_transaccion_Apellidos">
<input type="text" data-table="t_transaccion" data-field="x_Apellidos" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_transaccion->Apellidos->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Apellidos->EditValue ?>"<?php echo $t_transaccion->Apellidos->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Apellidos" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" value="<?php echo HtmlEncode($t_transaccion->Apellidos->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Apellidos" class="form-group t_transaccion_Apellidos">
<input type="text" data-table="t_transaccion" data-field="x_Apellidos" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_transaccion->Apellidos->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Apellidos->EditValue ?>"<?php echo $t_transaccion->Apellidos->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Apellidos" class="t_transaccion_Apellidos">
<span<?php echo $t_transaccion->Apellidos->viewAttributes() ?>>
<?php echo $t_transaccion->Apellidos->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Apellidos" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" value="<?php echo HtmlEncode($t_transaccion->Apellidos->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Apellidos" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" value="<?php echo HtmlEncode($t_transaccion->Apellidos->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Apellidos" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" value="<?php echo HtmlEncode($t_transaccion->Apellidos->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Apellidos" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" value="<?php echo HtmlEncode($t_transaccion->Apellidos->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
		<td data-name="Cod_libro"<?php echo $t_transaccion->Cod_libro->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Cod_libro" class="form-group t_transaccion_Cod_libro">
<input type="text" data-table="t_transaccion" data-field="x_Cod_libro" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_transaccion->Cod_libro->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Cod_libro->EditValue ?>"<?php echo $t_transaccion->Cod_libro->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" value="<?php echo HtmlEncode($t_transaccion->Cod_libro->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Cod_libro" class="form-group t_transaccion_Cod_libro">
<input type="text" data-table="t_transaccion" data-field="x_Cod_libro" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_transaccion->Cod_libro->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Cod_libro->EditValue ?>"<?php echo $t_transaccion->Cod_libro->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro">
<span<?php echo $t_transaccion->Cod_libro->viewAttributes() ?>>
<?php echo $t_transaccion->Cod_libro->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" value="<?php echo HtmlEncode($t_transaccion->Cod_libro->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" value="<?php echo HtmlEncode($t_transaccion->Cod_libro->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" value="<?php echo HtmlEncode($t_transaccion->Cod_libro->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" value="<?php echo HtmlEncode($t_transaccion->Cod_libro->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo"<?php echo $t_transaccion->Titulo->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Titulo" class="form-group t_transaccion_Titulo">
<input type="text" data-table="t_transaccion" data-field="x_Titulo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_transaccion->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Titulo->EditValue ?>"<?php echo $t_transaccion->Titulo->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Titulo" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_transaccion->Titulo->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Titulo" class="form-group t_transaccion_Titulo">
<input type="text" data-table="t_transaccion" data-field="x_Titulo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_transaccion->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Titulo->EditValue ?>"<?php echo $t_transaccion->Titulo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Titulo" class="t_transaccion_Titulo">
<span<?php echo $t_transaccion->Titulo->viewAttributes() ?>>
<?php echo $t_transaccion->Titulo->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Titulo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_transaccion->Titulo->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Titulo" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_transaccion->Titulo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Titulo" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_transaccion->Titulo->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Titulo" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_transaccion->Titulo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
		<td data-name="Fecha_Prestamo"<?php echo $t_transaccion->Fecha_Prestamo->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Fecha_Prestamo" class="form-group t_transaccion_Fecha_Prestamo">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Prestamo->EditValue ?>"<?php echo $t_transaccion->Fecha_Prestamo->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" value="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Fecha_Prestamo" class="form-group t_transaccion_Fecha_Prestamo">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Prestamo->EditValue ?>"<?php echo $t_transaccion->Fecha_Prestamo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo">
<span<?php echo $t_transaccion->Fecha_Prestamo->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Prestamo->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" value="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" value="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" value="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" value="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
		<td data-name="Fecha_Devolucion"<?php echo $t_transaccion->Fecha_Devolucion->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Fecha_Devolucion" class="form-group t_transaccion_Fecha_Devolucion">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Devolucion->EditValue ?>"<?php echo $t_transaccion->Fecha_Devolucion->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" value="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Fecha_Devolucion" class="form-group t_transaccion_Fecha_Devolucion">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Devolucion->EditValue ?>"<?php echo $t_transaccion->Fecha_Devolucion->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion">
<span<?php echo $t_transaccion->Fecha_Devolucion->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Devolucion->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" value="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" value="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" value="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" value="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
		<td data-name="Estado"<?php echo $t_transaccion->Estado->cellAttributes() ?>>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Estado" class="form-group t_transaccion_Estado">
<input type="text" data-table="t_transaccion" data-field="x_Estado" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_transaccion->Estado->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Estado->EditValue ?>"<?php echo $t_transaccion->Estado->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Estado" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" value="<?php echo HtmlEncode($t_transaccion->Estado->OldValue) ?>">
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Estado" class="form-group t_transaccion_Estado">
<input type="text" data-table="t_transaccion" data-field="x_Estado" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_transaccion->Estado->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Estado->EditValue ?>"<?php echo $t_transaccion->Estado->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_transaccion->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_transaccion_grid->RowCnt ?>_t_transaccion_Estado" class="t_transaccion_Estado">
<span<?php echo $t_transaccion->Estado->viewAttributes() ?>>
<?php echo $t_transaccion->Estado->getViewValue() ?></span>
</span>
<?php if (!$t_transaccion->isConfirm()) { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Estado" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" value="<?php echo HtmlEncode($t_transaccion->Estado->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Estado" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" value="<?php echo HtmlEncode($t_transaccion->Estado->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Estado" name="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="ft_transacciongrid$x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" value="<?php echo HtmlEncode($t_transaccion->Estado->FormValue) ?>">
<input type="hidden" data-table="t_transaccion" data-field="x_Estado" name="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="ft_transacciongrid$o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" value="<?php echo HtmlEncode($t_transaccion->Estado->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_transaccion_grid->ListOptions->render("body", "right", $t_transaccion_grid->RowCnt);
?>
	</tr>
<?php if ($t_transaccion->RowType == ROWTYPE_ADD || $t_transaccion->RowType == ROWTYPE_EDIT) { ?>
<script>
ft_transacciongrid.updateLists(<?php echo $t_transaccion_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_transaccion->isGridAdd() || $t_transaccion->CurrentMode == "copy")
		if (!$t_transaccion_grid->Recordset->EOF)
			$t_transaccion_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_transaccion->CurrentMode == "add" || $t_transaccion->CurrentMode == "copy" || $t_transaccion->CurrentMode == "edit") {
		$t_transaccion_grid->RowIndex = '$rowindex$';
		$t_transaccion_grid->loadRowValues();

		// Set row properties
		$t_transaccion->resetAttributes();
		$t_transaccion->RowAttrs = array_merge($t_transaccion->RowAttrs, array('data-rowindex'=>$t_transaccion_grid->RowIndex, 'id'=>'r0_t_transaccion', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($t_transaccion->RowAttrs["class"], "ew-template");
		$t_transaccion->RowType = ROWTYPE_ADD;

		// Render row
		$t_transaccion_grid->renderRow();

		// Render list options
		$t_transaccion_grid->renderListOptions();
		$t_transaccion_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t_transaccion->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_transaccion_grid->ListOptions->render("body", "left", $t_transaccion_grid->RowIndex);
?>
	<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
		<td data-name="Id_tran">
<?php if (!$t_transaccion->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Id_tran" class="form-group t_transaccion_Id_tran">
<span<?php echo $t_transaccion->Id_tran->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Id_tran->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Id_tran" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Id_tran" value="<?php echo HtmlEncode($t_transaccion->Id_tran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
		<td data-name="CI_Lector">
<?php if (!$t_transaccion->isConfirm()) { ?>
<?php if ($t_transaccion->CI_Lector->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t_transaccion_CI_Lector" class="form-group t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->CI_Lector->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_CI_Lector" class="form-group t_transaccion_CI_Lector">
<input type="text" data-table="t_transaccion" data-field="x_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($t_transaccion->CI_Lector->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->CI_Lector->EditValue ?>"<?php echo $t_transaccion->CI_Lector->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_CI_Lector" class="form-group t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->CI_Lector->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_CI_Lector" name="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="x<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_CI_Lector" name="o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" id="o<?php echo $t_transaccion_grid->RowIndex ?>_CI_Lector" value="<?php echo HtmlEncode($t_transaccion->CI_Lector->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
		<td data-name="Nombres">
<?php if (!$t_transaccion->isConfirm()) { ?>
<span id="el$rowindex$_t_transaccion_Nombres" class="form-group t_transaccion_Nombres">
<input type="text" data-table="t_transaccion" data-field="x_Nombres" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_transaccion->Nombres->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Nombres->EditValue ?>"<?php echo $t_transaccion->Nombres->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Nombres" class="form-group t_transaccion_Nombres">
<span<?php echo $t_transaccion->Nombres->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Nombres->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Nombres" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" value="<?php echo HtmlEncode($t_transaccion->Nombres->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Nombres" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Nombres" value="<?php echo HtmlEncode($t_transaccion->Nombres->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
		<td data-name="Apellidos">
<?php if (!$t_transaccion->isConfirm()) { ?>
<span id="el$rowindex$_t_transaccion_Apellidos" class="form-group t_transaccion_Apellidos">
<input type="text" data-table="t_transaccion" data-field="x_Apellidos" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_transaccion->Apellidos->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Apellidos->EditValue ?>"<?php echo $t_transaccion->Apellidos->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Apellidos" class="form-group t_transaccion_Apellidos">
<span<?php echo $t_transaccion->Apellidos->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Apellidos->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Apellidos" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" value="<?php echo HtmlEncode($t_transaccion->Apellidos->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Apellidos" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Apellidos" value="<?php echo HtmlEncode($t_transaccion->Apellidos->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
		<td data-name="Cod_libro">
<?php if (!$t_transaccion->isConfirm()) { ?>
<span id="el$rowindex$_t_transaccion_Cod_libro" class="form-group t_transaccion_Cod_libro">
<input type="text" data-table="t_transaccion" data-field="x_Cod_libro" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_transaccion->Cod_libro->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Cod_libro->EditValue ?>"<?php echo $t_transaccion->Cod_libro->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Cod_libro" class="form-group t_transaccion_Cod_libro">
<span<?php echo $t_transaccion->Cod_libro->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Cod_libro->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" value="<?php echo HtmlEncode($t_transaccion->Cod_libro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Cod_libro" value="<?php echo HtmlEncode($t_transaccion->Cod_libro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo">
<?php if (!$t_transaccion->isConfirm()) { ?>
<span id="el$rowindex$_t_transaccion_Titulo" class="form-group t_transaccion_Titulo">
<input type="text" data-table="t_transaccion" data-field="x_Titulo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_transaccion->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Titulo->EditValue ?>"<?php echo $t_transaccion->Titulo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Titulo" class="form-group t_transaccion_Titulo">
<span<?php echo $t_transaccion->Titulo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Titulo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Titulo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_transaccion->Titulo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Titulo" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_transaccion->Titulo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
		<td data-name="Fecha_Prestamo">
<?php if (!$t_transaccion->isConfirm()) { ?>
<span id="el$rowindex$_t_transaccion_Fecha_Prestamo" class="form-group t_transaccion_Fecha_Prestamo">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Prestamo->EditValue ?>"<?php echo $t_transaccion->Fecha_Prestamo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Fecha_Prestamo" class="form-group t_transaccion_Fecha_Prestamo">
<span<?php echo $t_transaccion->Fecha_Prestamo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Fecha_Prestamo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" value="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Prestamo" value="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
		<td data-name="Fecha_Devolucion">
<?php if (!$t_transaccion->isConfirm()) { ?>
<span id="el$rowindex$_t_transaccion_Fecha_Devolucion" class="form-group t_transaccion_Fecha_Devolucion">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Devolucion->EditValue ?>"<?php echo $t_transaccion->Fecha_Devolucion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Fecha_Devolucion" class="form-group t_transaccion_Fecha_Devolucion">
<span<?php echo $t_transaccion->Fecha_Devolucion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Fecha_Devolucion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" value="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Fecha_Devolucion" value="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
		<td data-name="Estado">
<?php if (!$t_transaccion->isConfirm()) { ?>
<span id="el$rowindex$_t_transaccion_Estado" class="form-group t_transaccion_Estado">
<input type="text" data-table="t_transaccion" data-field="x_Estado" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_transaccion->Estado->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Estado->EditValue ?>"<?php echo $t_transaccion->Estado->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_transaccion_Estado" class="form-group t_transaccion_Estado">
<span<?php echo $t_transaccion->Estado->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_transaccion->Estado->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="t_transaccion" data-field="x_Estado" name="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="x<?php echo $t_transaccion_grid->RowIndex ?>_Estado" value="<?php echo HtmlEncode($t_transaccion->Estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_transaccion" data-field="x_Estado" name="o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" id="o<?php echo $t_transaccion_grid->RowIndex ?>_Estado" value="<?php echo HtmlEncode($t_transaccion->Estado->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_transaccion_grid->ListOptions->render("body", "right", $t_transaccion_grid->RowIndex);
?>
<script>
ft_transacciongrid.updateLists(<?php echo $t_transaccion_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($t_transaccion->CurrentMode == "add" || $t_transaccion->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_transaccion_grid->FormKeyCountName ?>" id="<?php echo $t_transaccion_grid->FormKeyCountName ?>" value="<?php echo $t_transaccion_grid->KeyCount ?>">
<?php echo $t_transaccion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_transaccion->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_transaccion_grid->FormKeyCountName ?>" id="<?php echo $t_transaccion_grid->FormKeyCountName ?>" value="<?php echo $t_transaccion_grid->KeyCount ?>">
<?php echo $t_transaccion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_transaccion->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_transacciongrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($t_transaccion_grid->Recordset)
	$t_transaccion_grid->Recordset->Close();
?>
</div>
<?php if ($t_transaccion_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php
	foreach ($t_transaccion_grid->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_transaccion_grid->TotalRecs == 0 && !$t_transaccion->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_transaccion_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_transaccion_grid->terminate();
?>
