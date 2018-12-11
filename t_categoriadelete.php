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
$t_categoria_delete = new t_categoria_delete();

// Run the page
$t_categoria_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_categoria_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ft_categoriadelete = currentForm = new ew.Form("ft_categoriadelete", "delete");

// Form_CustomValidate event
ft_categoriadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_categoriadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_categoria_delete->showPageHeader(); ?>
<?php
$t_categoria_delete->showMessage();
?>
<form name="ft_categoriadelete" id="ft_categoriadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_categoria_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_categoria_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_categoria">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_categoria_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_categoria->Id_categoria->Visible) { // Id_categoria ?>
		<th class="<?php echo $t_categoria->Id_categoria->headerCellClass() ?>"><span id="elh_t_categoria_Id_categoria" class="t_categoria_Id_categoria"><?php echo $t_categoria->Id_categoria->caption() ?></span></th>
<?php } ?>
<?php if ($t_categoria->Categoria->Visible) { // Categoria ?>
		<th class="<?php echo $t_categoria->Categoria->headerCellClass() ?>"><span id="elh_t_categoria_Categoria" class="t_categoria_Categoria"><?php echo $t_categoria->Categoria->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_categoria_delete->RecCnt = 0;
$i = 0;
while (!$t_categoria_delete->Recordset->EOF) {
	$t_categoria_delete->RecCnt++;
	$t_categoria_delete->RowCnt++;

	// Set row properties
	$t_categoria->resetAttributes();
	$t_categoria->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_categoria_delete->loadRowValues($t_categoria_delete->Recordset);

	// Render row
	$t_categoria_delete->renderRow();
?>
	<tr<?php echo $t_categoria->rowAttributes() ?>>
<?php if ($t_categoria->Id_categoria->Visible) { // Id_categoria ?>
		<td<?php echo $t_categoria->Id_categoria->cellAttributes() ?>>
<span id="el<?php echo $t_categoria_delete->RowCnt ?>_t_categoria_Id_categoria" class="t_categoria_Id_categoria">
<span<?php echo $t_categoria->Id_categoria->viewAttributes() ?>>
<?php echo $t_categoria->Id_categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_categoria->Categoria->Visible) { // Categoria ?>
		<td<?php echo $t_categoria->Categoria->cellAttributes() ?>>
<span id="el<?php echo $t_categoria_delete->RowCnt ?>_t_categoria_Categoria" class="t_categoria_Categoria">
<span<?php echo $t_categoria->Categoria->viewAttributes() ?>>
<?php echo $t_categoria->Categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_categoria_delete->Recordset->moveNext();
}
$t_categoria_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_categoria_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_categoria_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_categoria_delete->terminate();
?>
