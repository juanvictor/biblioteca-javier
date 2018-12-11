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
$t_lector_addopt = new t_lector_addopt();

// Run the page
$t_lector_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_lector_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var ft_lectoraddopt = currentForm = new ew.Form("ft_lectoraddopt", "addopt");

// Validate form
ft_lectoraddopt.validate = function() {
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
		<?php if ($t_lector_addopt->CI_DNI->Required) { ?>
			elm = this.getElements("x" + infix + "_CI_DNI");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->CI_DNI->caption(), $t_lector->CI_DNI->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_addopt->Nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_Nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Nombres->caption(), $t_lector->Nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_addopt->Apellidos->Required) { ?>
			elm = this.getElements("x" + infix + "_Apellidos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Apellidos->caption(), $t_lector->Apellidos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_addopt->Direccion->Required) { ?>
			elm = this.getElements("x" + infix + "_Direccion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Direccion->caption(), $t_lector->Direccion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_addopt->Telefono->Required) { ?>
			elm = this.getElements("x" + infix + "_Telefono");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Telefono->caption(), $t_lector->Telefono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_addopt->Tipo_Lector->Required) { ?>
			elm = this.getElements("x" + infix + "_Tipo_Lector");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Tipo_Lector->caption(), $t_lector->Tipo_Lector->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_lector_addopt->Institucion->Required) { ?>
			elm = this.getElements("x" + infix + "_Institucion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_lector->Institucion->caption(), $t_lector->Institucion->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft_lectoraddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_lectoraddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_lector_addopt->showPageHeader(); ?>
<?php
$t_lector_addopt->showMessage();
?>
<form name="ft_lectoraddopt" id="ft_lectoraddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($t_lector_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_lector_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $t_lector_addopt->TableVar ?>">
<?php if ($t_lector->CI_DNI->Visible) { // CI_DNI ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_CI_DNI"><?php echo $t_lector->CI_DNI->caption() ?><?php echo ($t_lector->CI_DNI->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_lector" data-field="x_CI_DNI" name="x_CI_DNI" id="x_CI_DNI" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_lector->CI_DNI->getPlaceHolder()) ?>" value="<?php echo $t_lector->CI_DNI->EditValue ?>"<?php echo $t_lector->CI_DNI->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($t_lector->Nombres->Visible) { // Nombres ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Nombres"><?php echo $t_lector->Nombres->caption() ?><?php echo ($t_lector->Nombres->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_lector" data-field="x_Nombres" name="x_Nombres" id="x_Nombres" size="30" maxlength="35" placeholder="<?php echo HtmlEncode($t_lector->Nombres->getPlaceHolder()) ?>" value="<?php echo $t_lector->Nombres->EditValue ?>"<?php echo $t_lector->Nombres->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($t_lector->Apellidos->Visible) { // Apellidos ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Apellidos"><?php echo $t_lector->Apellidos->caption() ?><?php echo ($t_lector->Apellidos->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_lector" data-field="x_Apellidos" name="x_Apellidos" id="x_Apellidos" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_lector->Apellidos->getPlaceHolder()) ?>" value="<?php echo $t_lector->Apellidos->EditValue ?>"<?php echo $t_lector->Apellidos->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($t_lector->Direccion->Visible) { // Direccion ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Direccion"><?php echo $t_lector->Direccion->caption() ?><?php echo ($t_lector->Direccion->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_lector" data-field="x_Direccion" name="x_Direccion" id="x_Direccion" size="30" maxlength="35" placeholder="<?php echo HtmlEncode($t_lector->Direccion->getPlaceHolder()) ?>" value="<?php echo $t_lector->Direccion->EditValue ?>"<?php echo $t_lector->Direccion->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($t_lector->Telefono->Visible) { // Telefono ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Telefono"><?php echo $t_lector->Telefono->caption() ?><?php echo ($t_lector->Telefono->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_lector" data-field="x_Telefono" name="x_Telefono" id="x_Telefono" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($t_lector->Telefono->getPlaceHolder()) ?>" value="<?php echo $t_lector->Telefono->EditValue ?>"<?php echo $t_lector->Telefono->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($t_lector->Tipo_Lector->Visible) { // Tipo_Lector ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Tipo_Lector"><?php echo $t_lector->Tipo_Lector->caption() ?><?php echo ($t_lector->Tipo_Lector->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_lector" data-field="x_Tipo_Lector" name="x_Tipo_Lector" id="x_Tipo_Lector" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($t_lector->Tipo_Lector->getPlaceHolder()) ?>" value="<?php echo $t_lector->Tipo_Lector->EditValue ?>"<?php echo $t_lector->Tipo_Lector->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($t_lector->Institucion->Visible) { // Institucion ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Institucion"><?php echo $t_lector->Institucion->caption() ?><?php echo ($t_lector->Institucion->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_lector" data-field="x_Institucion" name="x_Institucion" id="x_Institucion" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($t_lector->Institucion->getPlaceHolder()) ?>" value="<?php echo $t_lector->Institucion->EditValue ?>"<?php echo $t_lector->Institucion->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$t_lector_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$t_lector_addopt->terminate();
?>
