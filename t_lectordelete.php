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
$t_lector_delete = new t_lector_delete();

// Run the page
$t_lector_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lector_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ft_lectordelete = currentForm = new ew.Form("ft_lectordelete", "delete");

// Form_CustomValidate event
ft_lectordelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_lectordelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_lector_delete->showPageHeader(); ?>
<?php
$t_lector_delete->showMessage();
?>
<form name="ft_lectordelete" id="ft_lectordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_lector_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_lector_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_lector">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_lector_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_lector->Id_lector->Visible) { // Id_lector ?>
		<th class="<?php echo $t_lector->Id_lector->headerCellClass() ?>"><span id="elh_t_lector_Id_lector" class="t_lector_Id_lector"><?php echo $t_lector->Id_lector->caption() ?></span></th>
<?php } ?>
<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
		<th class="<?php echo $t_lector->CI_DNI->headerCellClass() ?>"><span id="elh_t_lector_CI_DNI" class="t_lector_CI_DNI"><?php echo $t_lector->CI_DNI->caption() ?></span></th>
<?php } ?>
<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
		<th class="<?php echo $t_lector->Nombres->headerCellClass() ?>"><span id="elh_t_lector_Nombres" class="t_lector_Nombres"><?php echo $t_lector->Nombres->caption() ?></span></th>
<?php } ?>
<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
		<th class="<?php echo $t_lector->Apellidos->headerCellClass() ?>"><span id="elh_t_lector_Apellidos" class="t_lector_Apellidos"><?php echo $t_lector->Apellidos->caption() ?></span></th>
<?php } ?>
<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
		<th class="<?php echo $t_lector->Direccion->headerCellClass() ?>"><span id="elh_t_lector_Direccion" class="t_lector_Direccion"><?php echo $t_lector->Direccion->caption() ?></span></th>
<?php } ?>
<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
		<th class="<?php echo $t_lector->Telefono->headerCellClass() ?>"><span id="elh_t_lector_Telefono" class="t_lector_Telefono"><?php echo $t_lector->Telefono->caption() ?></span></th>
<?php } ?>
<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
		<th class="<?php echo $t_lector->Tipo_Lector->headerCellClass() ?>"><span id="elh_t_lector_Tipo_Lector" class="t_lector_Tipo_Lector"><?php echo $t_lector->Tipo_Lector->caption() ?></span></th>
<?php } ?>
<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
		<th class="<?php echo $t_lector->Institucion->headerCellClass() ?>"><span id="elh_t_lector_Institucion" class="t_lector_Institucion"><?php echo $t_lector->Institucion->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_lector_delete->RecCnt = 0;
$i = 0;
while (!$t_lector_delete->Recordset->EOF) {
	$t_lector_delete->RecCnt++;
	$t_lector_delete->RowCnt++;

	// Set row properties
	$t_lector->resetAttributes();
	$t_lector->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_lector_delete->loadRowValues($t_lector_delete->Recordset);

	// Render row
	$t_lector_delete->renderRow();
?>
	<tr<?php echo $t_lector->rowAttributes() ?>>
<?php if ($t_lector->Id_lector->Visible) { // Id_lector ?>
		<td<?php echo $t_lector->Id_lector->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_Id_lector" class="t_lector_Id_lector">
<span<?php echo $t_lector->Id_lector->viewAttributes() ?>>
<?php echo $t_lector->Id_lector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
		<td<?php echo $t_lector->CI_DNI->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_CI_DNI" class="t_lector_CI_DNI">
<span<?php echo $t_lector->CI_DNI->viewAttributes() ?>>
<?php echo $t_lector->CI_DNI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
		<td<?php echo $t_lector->Nombres->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_Nombres" class="t_lector_Nombres">
<span<?php echo $t_lector->Nombres->viewAttributes() ?>>
<?php echo $t_lector->Nombres->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
		<td<?php echo $t_lector->Apellidos->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_Apellidos" class="t_lector_Apellidos">
<span<?php echo $t_lector->Apellidos->viewAttributes() ?>>
<?php echo $t_lector->Apellidos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
		<td<?php echo $t_lector->Direccion->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_Direccion" class="t_lector_Direccion">
<span<?php echo $t_lector->Direccion->viewAttributes() ?>>
<?php echo $t_lector->Direccion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
		<td<?php echo $t_lector->Telefono->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_Telefono" class="t_lector_Telefono">
<span<?php echo $t_lector->Telefono->viewAttributes() ?>>
<?php echo $t_lector->Telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
		<td<?php echo $t_lector->Tipo_Lector->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_Tipo_Lector" class="t_lector_Tipo_Lector">
<span<?php echo $t_lector->Tipo_Lector->viewAttributes() ?>>
<?php echo $t_lector->Tipo_Lector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
		<td<?php echo $t_lector->Institucion->cellAttributes() ?>>
<span id="el<?php echo $t_lector_delete->RowCnt ?>_t_lector_Institucion" class="t_lector_Institucion">
<span<?php echo $t_lector->Institucion->viewAttributes() ?>>
<?php echo $t_lector->Institucion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_lector_delete->Recordset->moveNext();
}
$t_lector_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_lector_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_lector_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_lector_delete->terminate();
?>
