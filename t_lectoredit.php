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
$t_lector_edit = new t_lector_edit();

// Run the page
$t_lector_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lector_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ft_lectoredit = currentForm = new ew.Form("ft_lectoredit", "edit");

// Validate form
ft_lectoredit.validate = function() {
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
		<?php if ($t_lector_edit->Id_lector->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_lector");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Id_lector->caption(), $t_lector->Id_lector->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_edit->CI_DNI->Required) { ?>
			elm = this.getElements("x" + infix + "_CI_DNI");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->CI_DNI->caption(), $t_lector->CI_DNI->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_edit->Nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_Nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Nombres->caption(), $t_lector->Nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_edit->Apellidos->Required) { ?>
			elm = this.getElements("x" + infix + "_Apellidos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Apellidos->caption(), $t_lector->Apellidos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_edit->Direccion->Required) { ?>
			elm = this.getElements("x" + infix + "_Direccion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Direccion->caption(), $t_lector->Direccion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_edit->Telefono->Required) { ?>
			elm = this.getElements("x" + infix + "_Telefono");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Telefono->caption(), $t_lector->Telefono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_edit->Tipo_Lector->Required) { ?>
			elm = this.getElements("x" + infix + "_Tipo_Lector");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Tipo_Lector->caption(), $t_lector->Tipo_Lector->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_edit->Institucion->Required) { ?>
			elm = this.getElements("x" + infix + "_Institucion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Institucion->caption(), $t_lector->Institucion->RequiredErrorMessage)) ?>");
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
ft_lectoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_lectoredit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_lector_edit->showPageHeader(); ?>
<?php
$t_lector_edit->showMessage();
?>
<form name="ft_lectoredit" id="ft_lectoredit" class="<?php echo $t_lector_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_lector_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_lector_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_lector">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_lector_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_lector->Id_lector->Visible) { // Id_lector ?>
	<div id="r_Id_lector" class="form-group row">
		<label id="elh_t_lector_Id_lector" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->Id_lector->caption() ?><?php echo ($t_lector->Id_lector->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->Id_lector->cellAttributes() ?>>
<span id="el_t_lector_Id_lector">
<span<?php echo $t_lector->Id_lector->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_lector->Id_lector->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="t_lector" data-field="x_Id_lector" name="x_Id_lector" id="x_Id_lector" value="<?php echo HtmlEncode($t_lector->Id_lector->CurrentValue) ?>">
<?php echo $t_lector->Id_lector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
	<div id="r_CI_DNI" class="form-group row">
		<label id="elh_t_lector_CI_DNI" for="x_CI_DNI" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->CI_DNI->caption() ?><?php echo ($t_lector->CI_DNI->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->CI_DNI->cellAttributes() ?>>
<span id="el_t_lector_CI_DNI">
<input type="text" data-table="t_lector" data-field="x_CI_DNI" name="x_CI_DNI" id="x_CI_DNI" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_lector->CI_DNI->getPlaceHolder()) ?>" value="<?php echo $t_lector->CI_DNI->EditValue ?>"<?php echo $t_lector->CI_DNI->editAttributes() ?>>
</span>
<?php echo $t_lector->CI_DNI->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
	<div id="r_Nombres" class="form-group row">
		<label id="elh_t_lector_Nombres" for="x_Nombres" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->Nombres->caption() ?><?php echo ($t_lector->Nombres->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->Nombres->cellAttributes() ?>>
<span id="el_t_lector_Nombres">
<input type="text" data-table="t_lector" data-field="x_Nombres" name="x_Nombres" id="x_Nombres" size="30" maxlength="35" placeholder="<?php echo HtmlEncode($t_lector->Nombres->getPlaceHolder()) ?>" value="<?php echo $t_lector->Nombres->EditValue ?>"<?php echo $t_lector->Nombres->editAttributes() ?>>
</span>
<?php echo $t_lector->Nombres->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
	<div id="r_Apellidos" class="form-group row">
		<label id="elh_t_lector_Apellidos" for="x_Apellidos" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->Apellidos->caption() ?><?php echo ($t_lector->Apellidos->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->Apellidos->cellAttributes() ?>>
<span id="el_t_lector_Apellidos">
<input type="text" data-table="t_lector" data-field="x_Apellidos" name="x_Apellidos" id="x_Apellidos" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_lector->Apellidos->getPlaceHolder()) ?>" value="<?php echo $t_lector->Apellidos->EditValue ?>"<?php echo $t_lector->Apellidos->editAttributes() ?>>
</span>
<?php echo $t_lector->Apellidos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
	<div id="r_Direccion" class="form-group row">
		<label id="elh_t_lector_Direccion" for="x_Direccion" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->Direccion->caption() ?><?php echo ($t_lector->Direccion->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->Direccion->cellAttributes() ?>>
<span id="el_t_lector_Direccion">
<input type="text" data-table="t_lector" data-field="x_Direccion" name="x_Direccion" id="x_Direccion" size="30" maxlength="35" placeholder="<?php echo HtmlEncode($t_lector->Direccion->getPlaceHolder()) ?>" value="<?php echo $t_lector->Direccion->EditValue ?>"<?php echo $t_lector->Direccion->editAttributes() ?>>
</span>
<?php echo $t_lector->Direccion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
	<div id="r_Telefono" class="form-group row">
		<label id="elh_t_lector_Telefono" for="x_Telefono" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->Telefono->caption() ?><?php echo ($t_lector->Telefono->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->Telefono->cellAttributes() ?>>
<span id="el_t_lector_Telefono">
<input type="text" data-table="t_lector" data-field="x_Telefono" name="x_Telefono" id="x_Telefono" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($t_lector->Telefono->getPlaceHolder()) ?>" value="<?php echo $t_lector->Telefono->EditValue ?>"<?php echo $t_lector->Telefono->editAttributes() ?>>
</span>
<?php echo $t_lector->Telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
	<div id="r_Tipo_Lector" class="form-group row">
		<label id="elh_t_lector_Tipo_Lector" for="x_Tipo_Lector" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->Tipo_Lector->caption() ?><?php echo ($t_lector->Tipo_Lector->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->Tipo_Lector->cellAttributes() ?>>
<span id="el_t_lector_Tipo_Lector">
<input type="text" data-table="t_lector" data-field="x_Tipo_Lector" name="x_Tipo_Lector" id="x_Tipo_Lector" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_lector->Tipo_Lector->getPlaceHolder()) ?>" value="<?php echo $t_lector->Tipo_Lector->EditValue ?>"<?php echo $t_lector->Tipo_Lector->editAttributes() ?>>
</span>
<?php echo $t_lector->Tipo_Lector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
	<div id="r_Institucion" class="form-group row">
		<label id="elh_t_lector_Institucion" for="x_Institucion" class="<?php echo $t_lector_edit->LeftColumnClass ?>"><?php echo $t_lector->Institucion->caption() ?><?php echo ($t_lector->Institucion->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_lector_edit->RightColumnClass ?>"><div<?php echo $t_lector->Institucion->cellAttributes() ?>>
<span id="el_t_lector_Institucion">
<input type="text" data-table="t_lector" data-field="x_Institucion" name="x_Institucion" id="x_Institucion" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($t_lector->Institucion->getPlaceHolder()) ?>" value="<?php echo $t_lector->Institucion->EditValue ?>"<?php echo $t_lector->Institucion->editAttributes() ?>>
</span>
<?php echo $t_lector->Institucion->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_lector_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_lector_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_lector_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_lector_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_lector_edit->terminate();
?>
