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
$t_transaccion_delete = new t_transaccion_delete();

// Run the page
$t_transaccion_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_transaccion_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ft_transacciondelete = currentForm = new ew.Form("ft_transacciondelete", "delete");

// Form_CustomValidate event
ft_transacciondelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_transacciondelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_transacciondelete.lists["x_CI_Lector"] = <?php echo $t_transaccion_delete->CI_Lector->Lookup->toClientList() ?>;
ft_transacciondelete.lists["x_CI_Lector"].options = <?php echo JsonEncode($t_transaccion_delete->CI_Lector->lookupOptions()) ?>;
ft_transacciondelete.lists["x_Cod_libro"] = <?php echo $t_transaccion_delete->Cod_libro->Lookup->toClientList() ?>;
ft_transacciondelete.lists["x_Cod_libro"].options = <?php echo JsonEncode($t_transaccion_delete->Cod_libro->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_transaccion_delete->showPageHeader(); ?>
<?php
$t_transaccion_delete->showMessage();
?>
<form name="ft_transacciondelete" id="ft_transacciondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_transaccion_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_transaccion_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_transaccion">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_transaccion_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
		<th class="<?php echo $t_transaccion->Id_tran->headerCellClass() ?>"><span id="elh_t_transaccion_Id_tran" class="t_transaccion_Id_tran"><?php echo $t_transaccion->Id_tran->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
		<th class="<?php echo $t_transaccion->CI_Lector->headerCellClass() ?>"><span id="elh_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector"><?php echo $t_transaccion->CI_Lector->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
		<th class="<?php echo $t_transaccion->Nombres->headerCellClass() ?>"><span id="elh_t_transaccion_Nombres" class="t_transaccion_Nombres"><?php echo $t_transaccion->Nombres->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
		<th class="<?php echo $t_transaccion->Apellidos->headerCellClass() ?>"><span id="elh_t_transaccion_Apellidos" class="t_transaccion_Apellidos"><?php echo $t_transaccion->Apellidos->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
		<th class="<?php echo $t_transaccion->Cod_libro->headerCellClass() ?>"><span id="elh_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro"><?php echo $t_transaccion->Cod_libro->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
		<th class="<?php echo $t_transaccion->Titulo->headerCellClass() ?>"><span id="elh_t_transaccion_Titulo" class="t_transaccion_Titulo"><?php echo $t_transaccion->Titulo->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
		<th class="<?php echo $t_transaccion->Fecha_Prestamo->headerCellClass() ?>"><span id="elh_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo"><?php echo $t_transaccion->Fecha_Prestamo->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
		<th class="<?php echo $t_transaccion->Fecha_Devolucion->headerCellClass() ?>"><span id="elh_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion"><?php echo $t_transaccion->Fecha_Devolucion->caption() ?></span></th>
<?php } ?>
<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
		<th class="<?php echo $t_transaccion->Estado->headerCellClass() ?>"><span id="elh_t_transaccion_Estado" class="t_transaccion_Estado"><?php echo $t_transaccion->Estado->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_transaccion_delete->RecCnt = 0;
$i = 0;
while (!$t_transaccion_delete->Recordset->EOF) {
	$t_transaccion_delete->RecCnt++;
	$t_transaccion_delete->RowCnt++;

	// Set row properties
	$t_transaccion->resetAttributes();
	$t_transaccion->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_transaccion_delete->loadRowValues($t_transaccion_delete->Recordset);

	// Render row
	$t_transaccion_delete->renderRow();
?>
	<tr<?php echo $t_transaccion->rowAttributes() ?>>
<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
		<td<?php echo $t_transaccion->Id_tran->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Id_tran" class="t_transaccion_Id_tran">
<span<?php echo $t_transaccion->Id_tran->viewAttributes() ?>>
<?php echo $t_transaccion->Id_tran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
		<td<?php echo $t_transaccion->CI_Lector->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_CI_Lector" class="t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<?php echo $t_transaccion->CI_Lector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
		<td<?php echo $t_transaccion->Nombres->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Nombres" class="t_transaccion_Nombres">
<span<?php echo $t_transaccion->Nombres->viewAttributes() ?>>
<?php echo $t_transaccion->Nombres->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
		<td<?php echo $t_transaccion->Apellidos->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Apellidos" class="t_transaccion_Apellidos">
<span<?php echo $t_transaccion->Apellidos->viewAttributes() ?>>
<?php echo $t_transaccion->Apellidos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
		<td<?php echo $t_transaccion->Cod_libro->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Cod_libro" class="t_transaccion_Cod_libro">
<span<?php echo $t_transaccion->Cod_libro->viewAttributes() ?>>
<?php echo $t_transaccion->Cod_libro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
		<td<?php echo $t_transaccion->Titulo->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Titulo" class="t_transaccion_Titulo">
<span<?php echo $t_transaccion->Titulo->viewAttributes() ?>>
<?php echo $t_transaccion->Titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
		<td<?php echo $t_transaccion->Fecha_Prestamo->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Fecha_Prestamo" class="t_transaccion_Fecha_Prestamo">
<span<?php echo $t_transaccion->Fecha_Prestamo->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Prestamo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
		<td<?php echo $t_transaccion->Fecha_Devolucion->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Fecha_Devolucion" class="t_transaccion_Fecha_Devolucion">
<span<?php echo $t_transaccion->Fecha_Devolucion->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Devolucion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
		<td<?php echo $t_transaccion->Estado->cellAttributes() ?>>
<span id="el<?php echo $t_transaccion_delete->RowCnt ?>_t_transaccion_Estado" class="t_transaccion_Estado">
<span<?php echo $t_transaccion->Estado->viewAttributes() ?>>
<?php echo $t_transaccion->Estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_transaccion_delete->Recordset->moveNext();
}
$t_transaccion_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_transaccion_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_transaccion_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_transaccion_delete->terminate();
?>
