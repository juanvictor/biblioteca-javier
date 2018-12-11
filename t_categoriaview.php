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
$t_categoria_view = new t_categoria_view();

// Run the page
$t_categoria_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_categoria_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_categoria->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ft_categoriaview = currentForm = new ew.Form("ft_categoriaview", "view");

// Form_CustomValidate event
ft_categoriaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_categoriaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_categoria->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_categoria_view->ExportOptions->render("body") ?>
<?php
	foreach ($t_categoria_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_categoria_view->showPageHeader(); ?>
<?php
$t_categoria_view->showMessage();
?>
<form name="ft_categoriaview" id="ft_categoriaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_categoria_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_categoria_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_categoria">
<input type="hidden" name="modal" value="<?php echo (int)$t_categoria_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($t_categoria->Id_categoria->Visible) { // Id_categoria ?>
	<tr id="r_Id_categoria">
		<td class="<?php echo $t_categoria_view->TableLeftColumnClass ?>"><span id="elh_t_categoria_Id_categoria"><?php echo $t_categoria->Id_categoria->caption() ?></span></td>
		<td data-name="Id_categoria"<?php echo $t_categoria->Id_categoria->cellAttributes() ?>>
<span id="el_t_categoria_Id_categoria">
<span<?php echo $t_categoria->Id_categoria->viewAttributes() ?>>
<?php echo $t_categoria->Id_categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_categoria->Categoria->Visible) { // Categoria ?>
	<tr id="r_Categoria">
		<td class="<?php echo $t_categoria_view->TableLeftColumnClass ?>"><span id="elh_t_categoria_Categoria"><?php echo $t_categoria->Categoria->caption() ?></span></td>
		<td data-name="Categoria"<?php echo $t_categoria->Categoria->cellAttributes() ?>>
<span id="el_t_categoria_Categoria">
<span<?php echo $t_categoria->Categoria->viewAttributes() ?>>
<?php echo $t_categoria->Categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_categoria_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$t_categoria->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t_categoria_view->terminate();
?>
