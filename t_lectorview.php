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
$t_lector_view = new t_lector_view();

// Run the page
$t_lector_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lector_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_lector->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ft_lectorview = currentForm = new ew.Form("ft_lectorview", "view");

// Form_CustomValidate event
ft_lectorview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_lectorview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_lector->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_lector_view->ExportOptions->render("body") ?>
<?php
	foreach ($t_lector_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_lector_view->showPageHeader(); ?>
<?php
$t_lector_view->showMessage();
?>
<form name="ft_lectorview" id="ft_lectorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_lector_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_lector_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_lector">
<input type="hidden" name="modal" value="<?php echo (int)$t_lector_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($t_lector->Id_lector->Visible) { // Id_lector ?>
	<tr id="r_Id_lector">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_Id_lector"><?php echo $t_lector->Id_lector->caption() ?></span></td>
		<td data-name="Id_lector"<?php echo $t_lector->Id_lector->cellAttributes() ?>>
<span id="el_t_lector_Id_lector">
<span<?php echo $t_lector->Id_lector->viewAttributes() ?>>
<?php echo $t_lector->Id_lector->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
	<tr id="r_CI_DNI">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_CI_DNI"><?php echo $t_lector->CI_DNI->caption() ?></span></td>
		<td data-name="CI_DNI"<?php echo $t_lector->CI_DNI->cellAttributes() ?>>
<span id="el_t_lector_CI_DNI">
<span<?php echo $t_lector->CI_DNI->viewAttributes() ?>>
<?php echo $t_lector->CI_DNI->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
	<tr id="r_Nombres">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_Nombres"><?php echo $t_lector->Nombres->caption() ?></span></td>
		<td data-name="Nombres"<?php echo $t_lector->Nombres->cellAttributes() ?>>
<span id="el_t_lector_Nombres">
<span<?php echo $t_lector->Nombres->viewAttributes() ?>>
<?php echo $t_lector->Nombres->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
	<tr id="r_Apellidos">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_Apellidos"><?php echo $t_lector->Apellidos->caption() ?></span></td>
		<td data-name="Apellidos"<?php echo $t_lector->Apellidos->cellAttributes() ?>>
<span id="el_t_lector_Apellidos">
<span<?php echo $t_lector->Apellidos->viewAttributes() ?>>
<?php echo $t_lector->Apellidos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
	<tr id="r_Direccion">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_Direccion"><?php echo $t_lector->Direccion->caption() ?></span></td>
		<td data-name="Direccion"<?php echo $t_lector->Direccion->cellAttributes() ?>>
<span id="el_t_lector_Direccion">
<span<?php echo $t_lector->Direccion->viewAttributes() ?>>
<?php echo $t_lector->Direccion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
	<tr id="r_Telefono">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_Telefono"><?php echo $t_lector->Telefono->caption() ?></span></td>
		<td data-name="Telefono"<?php echo $t_lector->Telefono->cellAttributes() ?>>
<span id="el_t_lector_Telefono">
<span<?php echo $t_lector->Telefono->viewAttributes() ?>>
<?php echo $t_lector->Telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
	<tr id="r_Tipo_Lector">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_Tipo_Lector"><?php echo $t_lector->Tipo_Lector->caption() ?></span></td>
		<td data-name="Tipo_Lector"<?php echo $t_lector->Tipo_Lector->cellAttributes() ?>>
<span id="el_t_lector_Tipo_Lector">
<span<?php echo $t_lector->Tipo_Lector->viewAttributes() ?>>
<?php echo $t_lector->Tipo_Lector->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
	<tr id="r_Institucion">
		<td class="<?php echo $t_lector_view->TableLeftColumnClass ?>"><span id="elh_t_lector_Institucion"><?php echo $t_lector->Institucion->caption() ?></span></td>
		<td data-name="Institucion"<?php echo $t_lector->Institucion->cellAttributes() ?>>
<span id="el_t_lector_Institucion">
<span<?php echo $t_lector->Institucion->viewAttributes() ?>>
<?php echo $t_lector->Institucion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_lector_view->showPageFooter();
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
$t_lector_view->terminate();
?>
