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
$t_transaccion_view = new t_transaccion_view();

// Run the page
$t_transaccion_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_transaccion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_transaccion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ft_transaccionview = currentForm = new ew.Form("ft_transaccionview", "view");

// Form_CustomValidate event
ft_transaccionview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_transaccionview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_transaccionview.lists["x_CI_Lector"] = <?php echo $t_transaccion_view->CI_Lector->Lookup->toClientList() ?>;
ft_transaccionview.lists["x_CI_Lector"].options = <?php echo JsonEncode($t_transaccion_view->CI_Lector->lookupOptions()) ?>;
ft_transaccionview.lists["x_Cod_libro"] = <?php echo $t_transaccion_view->Cod_libro->Lookup->toClientList() ?>;
ft_transaccionview.lists["x_Cod_libro"].options = <?php echo JsonEncode($t_transaccion_view->Cod_libro->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_transaccion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_transaccion_view->ExportOptions->render("body") ?>
<?php
	foreach ($t_transaccion_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_transaccion_view->showPageHeader(); ?>
<?php
$t_transaccion_view->showMessage();
?>
<form name="ft_transaccionview" id="ft_transaccionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_transaccion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_transaccion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_transaccion">
<input type="hidden" name="modal" value="<?php echo (int)$t_transaccion_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
	<tr id="r_Id_tran">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Id_tran"><?php echo $t_transaccion->Id_tran->caption() ?></span></td>
		<td data-name="Id_tran"<?php echo $t_transaccion->Id_tran->cellAttributes() ?>>
<span id="el_t_transaccion_Id_tran">
<span<?php echo $t_transaccion->Id_tran->viewAttributes() ?>>
<?php echo $t_transaccion->Id_tran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
	<tr id="r_CI_Lector">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_CI_Lector"><?php echo $t_transaccion->CI_Lector->caption() ?></span></td>
		<td data-name="CI_Lector"<?php echo $t_transaccion->CI_Lector->cellAttributes() ?>>
<span id="el_t_transaccion_CI_Lector">
<span<?php echo $t_transaccion->CI_Lector->viewAttributes() ?>>
<?php echo $t_transaccion->CI_Lector->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
	<tr id="r_Nombres">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Nombres"><?php echo $t_transaccion->Nombres->caption() ?></span></td>
		<td data-name="Nombres"<?php echo $t_transaccion->Nombres->cellAttributes() ?>>
<span id="el_t_transaccion_Nombres">
<span<?php echo $t_transaccion->Nombres->viewAttributes() ?>>
<?php echo $t_transaccion->Nombres->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
	<tr id="r_Apellidos">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Apellidos"><?php echo $t_transaccion->Apellidos->caption() ?></span></td>
		<td data-name="Apellidos"<?php echo $t_transaccion->Apellidos->cellAttributes() ?>>
<span id="el_t_transaccion_Apellidos">
<span<?php echo $t_transaccion->Apellidos->viewAttributes() ?>>
<?php echo $t_transaccion->Apellidos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
	<tr id="r_Cod_libro">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Cod_libro"><?php echo $t_transaccion->Cod_libro->caption() ?></span></td>
		<td data-name="Cod_libro"<?php echo $t_transaccion->Cod_libro->cellAttributes() ?>>
<span id="el_t_transaccion_Cod_libro">
<span<?php echo $t_transaccion->Cod_libro->viewAttributes() ?>>
<?php echo $t_transaccion->Cod_libro->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
	<tr id="r_Titulo">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Titulo"><?php echo $t_transaccion->Titulo->caption() ?></span></td>
		<td data-name="Titulo"<?php echo $t_transaccion->Titulo->cellAttributes() ?>>
<span id="el_t_transaccion_Titulo">
<span<?php echo $t_transaccion->Titulo->viewAttributes() ?>>
<?php echo $t_transaccion->Titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
	<tr id="r_Fecha_Prestamo">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Fecha_Prestamo"><?php echo $t_transaccion->Fecha_Prestamo->caption() ?></span></td>
		<td data-name="Fecha_Prestamo"<?php echo $t_transaccion->Fecha_Prestamo->cellAttributes() ?>>
<span id="el_t_transaccion_Fecha_Prestamo">
<span<?php echo $t_transaccion->Fecha_Prestamo->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Prestamo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
	<tr id="r_Fecha_Devolucion">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Fecha_Devolucion"><?php echo $t_transaccion->Fecha_Devolucion->caption() ?></span></td>
		<td data-name="Fecha_Devolucion"<?php echo $t_transaccion->Fecha_Devolucion->cellAttributes() ?>>
<span id="el_t_transaccion_Fecha_Devolucion">
<span<?php echo $t_transaccion->Fecha_Devolucion->viewAttributes() ?>>
<?php echo $t_transaccion->Fecha_Devolucion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
	<tr id="r_Estado">
		<td class="<?php echo $t_transaccion_view->TableLeftColumnClass ?>"><span id="elh_t_transaccion_Estado"><?php echo $t_transaccion->Estado->caption() ?></span></td>
		<td data-name="Estado"<?php echo $t_transaccion->Estado->cellAttributes() ?>>
<span id="el_t_transaccion_Estado">
<span<?php echo $t_transaccion->Estado->viewAttributes() ?>>
<?php echo $t_transaccion->Estado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_transaccion_view->showPageFooter();
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
$t_transaccion_view->terminate();
?>
