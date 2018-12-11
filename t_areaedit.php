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
$t_area_edit = new t_area_edit();

// Run the page
$t_area_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_area_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ft_areaedit = currentForm = new ew.Form("ft_areaedit", "edit");

// Validate form
ft_areaedit.validate = function() {
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
		<?php if ($t_area_edit->Id_area->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_area");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_area->Id_area->caption(), $t_area->Id_area->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_area_edit->Area->Required) { ?>
			elm = this.getElements("x" + infix + "_Area");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_area->Area->caption(), $t_area->Area->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft_areaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_areaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_area_edit->showPageHeader(); ?>
<?php
$t_area_edit->showMessage();
?>
<form name="ft_areaedit" id="ft_areaedit" class="<?php echo $t_area_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_area_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_area_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_area">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_area_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_area->Id_area->Visible) { // Id_area ?>
	<div id="r_Id_area" class="form-group row">
		<label id="elh_t_area_Id_area" class="<?php echo $t_area_edit->LeftColumnClass ?>"><?php echo $t_area->Id_area->caption() ?><?php echo ($t_area->Id_area->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_area_edit->RightColumnClass ?>"><div<?php echo $t_area->Id_area->cellAttributes() ?>>
<span id="el_t_area_Id_area">
<span<?php echo $t_area->Id_area->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_area->Id_area->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="t_area" data-field="x_Id_area" name="x_Id_area" id="x_Id_area" value="<?php echo HtmlEncode($t_area->Id_area->CurrentValue) ?>">
<?php echo $t_area->Id_area->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_area->Area->Visible) { // Area ?>
	<div id="r_Area" class="form-group row">
		<label id="elh_t_area_Area" for="x_Area" class="<?php echo $t_area_edit->LeftColumnClass ?>"><?php echo $t_area->Area->caption() ?><?php echo ($t_area->Area->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_area_edit->RightColumnClass ?>"><div<?php echo $t_area->Area->cellAttributes() ?>>
<span id="el_t_area_Area">
<input type="text" data-table="t_area" data-field="x_Area" name="x_Area" id="x_Area" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_area->Area->getPlaceHolder()) ?>" value="<?php echo $t_area->Area->EditValue ?>"<?php echo $t_area->Area->editAttributes() ?>>
</span>
<?php echo $t_area->Area->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_area_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_area_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_area_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_area_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_area_edit->terminate();
?>
