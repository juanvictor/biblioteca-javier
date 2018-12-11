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
$t_area_view = new t_area_view();

// Run the page
$t_area_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_area_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_area->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ft_areaview = currentForm = new ew.Form("ft_areaview", "view");

// Form_CustomValidate event
ft_areaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_areaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_area->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_area_view->ExportOptions->render("body") ?>
<?php
	foreach ($t_area_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_area_view->showPageHeader(); ?>
<?php
$t_area_view->showMessage();
?>
<form name="ft_areaview" id="ft_areaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_area_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_area_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_area">
<input type="hidden" name="modal" value="<?php echo (int)$t_area_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($t_area->Id_area->Visible) { // Id_area ?>
	<tr id="r_Id_area">
		<td class="<?php echo $t_area_view->TableLeftColumnClass ?>"><span id="elh_t_area_Id_area"><?php echo $t_area->Id_area->caption() ?></span></td>
		<td data-name="Id_area"<?php echo $t_area->Id_area->cellAttributes() ?>>
<span id="el_t_area_Id_area">
<span<?php echo $t_area->Id_area->viewAttributes() ?>>
<?php echo $t_area->Id_area->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_area->Area->Visible) { // Area ?>
	<tr id="r_Area">
		<td class="<?php echo $t_area_view->TableLeftColumnClass ?>"><span id="elh_t_area_Area"><?php echo $t_area->Area->caption() ?></span></td>
		<td data-name="Area"<?php echo $t_area->Area->cellAttributes() ?>>
<span id="el_t_area_Area">
<span<?php echo $t_area->Area->viewAttributes() ?>>
<?php echo $t_area->Area->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$t_area_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$t_area->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t_area_view->terminate();
?>
