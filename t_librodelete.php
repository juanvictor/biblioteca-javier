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
$t_libro_delete = new t_libro_delete();

// Run the page
$t_libro_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_libro_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ft_librodelete = currentForm = new ew.Form("ft_librodelete", "delete");

// Form_CustomValidate event
ft_librodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_librodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_librodelete.lists["x_Area"] = <?php echo $t_libro_delete->Area->Lookup->toClientList() ?>;
ft_librodelete.lists["x_Area"].options = <?php echo JsonEncode($t_libro_delete->Area->lookupOptions()) ?>;
ft_librodelete.lists["x_Categoria"] = <?php echo $t_libro_delete->Categoria->Lookup->toClientList() ?>;
ft_librodelete.lists["x_Categoria"].options = <?php echo JsonEncode($t_libro_delete->Categoria->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_libro_delete->showPageHeader(); ?>
<?php
$t_libro_delete->showMessage();
?>
<form name="ft_librodelete" id="ft_librodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_libro_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_libro_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_libro">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_libro_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
		<th class="<?php echo $t_libro->Id_libro->headerCellClass() ?>"><span id="elh_t_libro_Id_libro" class="t_libro_Id_libro"><?php echo $t_libro->Id_libro->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
		<th class="<?php echo $t_libro->Codigo_Libro->headerCellClass() ?>"><span id="elh_t_libro_Codigo_Libro" class="t_libro_Codigo_Libro"><?php echo $t_libro->Codigo_Libro->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
		<th class="<?php echo $t_libro->Titulo->headerCellClass() ?>"><span id="elh_t_libro_Titulo" class="t_libro_Titulo"><?php echo $t_libro->Titulo->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Autor->Visible) { // Autor ?>
		<th class="<?php echo $t_libro->Autor->headerCellClass() ?>"><span id="elh_t_libro_Autor" class="t_libro_Autor"><?php echo $t_libro->Autor->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
		<th class="<?php echo $t_libro->Editorial->headerCellClass() ?>"><span id="elh_t_libro_Editorial" class="t_libro_Editorial"><?php echo $t_libro->Editorial->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
		<th class="<?php echo $t_libro->Fecha_publicacion->headerCellClass() ?>"><span id="elh_t_libro_Fecha_publicacion" class="t_libro_Fecha_publicacion"><?php echo $t_libro->Fecha_publicacion->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
		<th class="<?php echo $t_libro->Edicion->headerCellClass() ?>"><span id="elh_t_libro_Edicion" class="t_libro_Edicion"><?php echo $t_libro->Edicion->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Area->Visible) { // Area ?>
		<th class="<?php echo $t_libro->Area->headerCellClass() ?>"><span id="elh_t_libro_Area" class="t_libro_Area"><?php echo $t_libro->Area->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
		<th class="<?php echo $t_libro->Categoria->headerCellClass() ?>"><span id="elh_t_libro_Categoria" class="t_libro_Categoria"><?php echo $t_libro->Categoria->caption() ?></span></th>
<?php } ?>
<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
		<th class="<?php echo $t_libro->N_copias->headerCellClass() ?>"><span id="elh_t_libro_N_copias" class="t_libro_N_copias"><?php echo $t_libro->N_copias->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_libro_delete->RecCnt = 0;
$i = 0;
while (!$t_libro_delete->Recordset->EOF) {
	$t_libro_delete->RecCnt++;
	$t_libro_delete->RowCnt++;

	// Set row properties
	$t_libro->resetAttributes();
	$t_libro->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_libro_delete->loadRowValues($t_libro_delete->Recordset);

	// Render row
	$t_libro_delete->renderRow();
?>
	<tr<?php echo $t_libro->rowAttributes() ?>>
<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
		<td<?php echo $t_libro->Id_libro->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Id_libro" class="t_libro_Id_libro">
<span<?php echo $t_libro->Id_libro->viewAttributes() ?>>
<?php echo $t_libro->Id_libro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
		<td<?php echo $t_libro->Codigo_Libro->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Codigo_Libro" class="t_libro_Codigo_Libro">
<span<?php echo $t_libro->Codigo_Libro->viewAttributes() ?>>
<?php echo $t_libro->Codigo_Libro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
		<td<?php echo $t_libro->Titulo->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Titulo" class="t_libro_Titulo">
<span<?php echo $t_libro->Titulo->viewAttributes() ?>>
<?php echo $t_libro->Titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Autor->Visible) { // Autor ?>
		<td<?php echo $t_libro->Autor->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Autor" class="t_libro_Autor">
<span<?php echo $t_libro->Autor->viewAttributes() ?>>
<?php echo $t_libro->Autor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
		<td<?php echo $t_libro->Editorial->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Editorial" class="t_libro_Editorial">
<span<?php echo $t_libro->Editorial->viewAttributes() ?>>
<?php echo $t_libro->Editorial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
		<td<?php echo $t_libro->Fecha_publicacion->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Fecha_publicacion" class="t_libro_Fecha_publicacion">
<span<?php echo $t_libro->Fecha_publicacion->viewAttributes() ?>>
<?php echo $t_libro->Fecha_publicacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
		<td<?php echo $t_libro->Edicion->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Edicion" class="t_libro_Edicion">
<span<?php echo $t_libro->Edicion->viewAttributes() ?>>
<?php echo $t_libro->Edicion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Area->Visible) { // Area ?>
		<td<?php echo $t_libro->Area->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Area" class="t_libro_Area">
<span<?php echo $t_libro->Area->viewAttributes() ?>>
<?php echo $t_libro->Area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
		<td<?php echo $t_libro->Categoria->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_Categoria" class="t_libro_Categoria">
<span<?php echo $t_libro->Categoria->viewAttributes() ?>>
<?php echo $t_libro->Categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
		<td<?php echo $t_libro->N_copias->cellAttributes() ?>>
<span id="el<?php echo $t_libro_delete->RowCnt ?>_t_libro_N_copias" class="t_libro_N_copias">
<span<?php echo $t_libro->N_copias->viewAttributes() ?>>
<?php echo $t_libro->N_copias->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_libro_delete->Recordset->moveNext();
}
$t_libro_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_libro_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_libro_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_libro_delete->terminate();
?>
