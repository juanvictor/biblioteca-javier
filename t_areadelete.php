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
$t_area_delete = new t_area_delete();

// Run the page
$t_area_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_area_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ft_areadelete = currentForm = new ew.Form("ft_areadelete", "delete");

// Form_CustomValidate event
ft_areadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_areadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_area_delete->showPageHeader(); ?>
<?php
$t_area_delete->showMessage();
?>
<form name="ft_areadelete" id="ft_areadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_area_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_area_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_area">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_area_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_area->Id_area->Visible) { // Id_area ?>
		<th class="<?php echo $t_area->Id_area->headerCellClass() ?>"><span id="elh_t_area_Id_area" class="t_area_Id_area"><?php echo $t_area->Id_area->caption() ?></span></th>
<?php } ?>
<?php if ($t_area->Area->Visible) { // Area ?>
		<th class="<?php echo $t_area->Area->headerCellClass() ?>"><span id="elh_t_area_Area" class="t_area_Area"><?php echo $t_area->Area->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_area_delete->RecCnt = 0;
$i = 0;
while (!$t_area_delete->Recordset->EOF) {
	$t_area_delete->RecCnt++;
	$t_area_delete->RowCnt++;

	// Set row properties
	$t_area->resetAttributes();
	$t_area->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_area_delete->loadRowValues($t_area_delete->Recordset);

	// Render row
	$t_area_delete->renderRow();
?>
	<tr<?php echo $t_area->rowAttributes() ?>>
<?php if ($t_area->Id_area->Visible) { // Id_area ?>
		<td<?php echo $t_area->Id_area->cellAttributes() ?>>
<span id="el<?php echo $t_area_delete->RowCnt ?>_t_area_Id_area" class="t_area_Id_area">
<span<?php echo $t_area->Id_area->viewAttributes() ?>>
<?php echo $t_area->Id_area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_area->Area->Visible) { // Area ?>
		<td<?php echo $t_area->Area->cellAttributes() ?>>
<span id="el<?php echo $t_area_delete->RowCnt ?>_t_area_Area" class="t_area_Area">
<span<?php echo $t_area->Area->viewAttributes() ?>>
<?php echo $t_area->Area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_area_delete->Recordset->moveNext();
}
$t_area_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_area_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_area_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_area_delete->terminate();
?>
