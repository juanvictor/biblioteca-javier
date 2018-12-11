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
$t_area_addopt = new t_area_addopt();

// Run the page
$t_area_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_area_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var ft_areaaddopt = currentForm = new ew.Form("ft_areaaddopt", "addopt");

// Validate form
ft_areaaddopt.validate = function() {
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
		<?php if ($t_area_addopt->Area->Required) { ?>
			elm = this.getElements("x" + infix + "_Area");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_area->Area->caption(), $t_area->Area->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft_areaaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_areaaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_area_addopt->showPageHeader(); ?>
<?php
$t_area_addopt->showMessage();
?>
<form name="ft_areaaddopt" id="ft_areaaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($t_area_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_area_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $t_area_addopt->TableVar ?>">
<?php if ($t_area->Area->Visible) { // Area ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Area"><?php echo $t_area->Area->caption() ?><?php echo ($t_area->Area->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_area" data-field="x_Area" name="x_Area" id="x_Area" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_area->Area->getPlaceHolder()) ?>" value="<?php echo $t_area->Area->EditValue ?>"<?php echo $t_area->Area->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$t_area_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$t_area_addopt->terminate();
?>
