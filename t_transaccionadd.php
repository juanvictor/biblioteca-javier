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
$t_transaccion_add = new t_transaccion_add();

// Run the page
$t_transaccion_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_transaccion_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ft_transaccionadd = currentForm = new ew.Form("ft_transaccionadd", "add");

// Validate form
ft_transaccionadd.validate = function() {
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
		<?php if ($t_transaccion_add->CI_Lector->Required) { ?>
			elm = this.getElements("x" + infix + "_CI_Lector");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->CI_Lector->caption(), $t_transaccion->CI_Lector->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_add->Nombres->Required) { ?>
			elm = this.getElements("x" + infix + "_Nombres");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Nombres->caption(), $t_transaccion->Nombres->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_add->Apellidos->Required) { ?>
			elm = this.getElements("x" + infix + "_Apellidos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Apellidos->caption(), $t_transaccion->Apellidos->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_add->Cod_libro->Required) { ?>
			elm = this.getElements("x" + infix + "_Cod_libro");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Cod_libro->caption(), $t_transaccion->Cod_libro->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_add->Titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_Titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Titulo->caption(), $t_transaccion->Titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_add->Fecha_Prestamo->Required) { ?>
			elm = this.getElements("x" + infix + "_Fecha_Prestamo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Fecha_Prestamo->caption(), $t_transaccion->Fecha_Prestamo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_add->Fecha_Devolucion->Required) { ?>
			elm = this.getElements("x" + infix + "_Fecha_Devolucion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Fecha_Devolucion->caption(), $t_transaccion->Fecha_Devolucion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_transaccion_add->Estado->Required) { ?>
			elm = this.getElements("x" + infix + "_Estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_transaccion->Estado->caption(), $t_transaccion->Estado->RequiredErrorMessage)) ?>");
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
ft_transaccionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_transaccionadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_transaccionadd.lists["x_CI_Lector"] = <?php echo $t_transaccion_add->CI_Lector->Lookup->toClientList() ?>;
ft_transaccionadd.lists["x_CI_Lector"].options = <?php echo JsonEncode($t_transaccion_add->CI_Lector->lookupOptions()) ?>;
ft_transaccionadd.lists["x_Cod_libro"] = <?php echo $t_transaccion_add->Cod_libro->Lookup->toClientList() ?>;
ft_transaccionadd.lists["x_Cod_libro"].options = <?php echo JsonEncode($t_transaccion_add->Cod_libro->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_transaccion_add->showPageHeader(); ?>
<?php
$t_transaccion_add->showMessage();
?>
<form name="ft_transaccionadd" id="ft_transaccionadd" class="<?php echo $t_transaccion_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_transaccion_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_transaccion_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_transaccion">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_transaccion_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
	<div id="r_CI_Lector" class="form-group row">
		<label id="elh_t_transaccion_CI_Lector" for="x_CI_Lector" class="<?php echo $t_transaccion_add->LeftColumnClass ?>"><?php echo $t_transaccion->CI_Lector->caption() ?><?php echo ($t_transaccion->CI_Lector->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_transaccion_add->RightColumnClass ?>"><div<?php echo $t_transaccion->CI_Lector->cellAttributes() ?>>
<span id="el_t_transaccion_CI_Lector">
<?php $t_transaccion->CI_Lector->EditAttrs["onchange"] = "ew.autoFill(this);" . @$t_transaccion->CI_Lector->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_transaccion" data-field="x_CI_Lector" data-value-separator="<?php echo $t_transaccion->CI_Lector->displayValueSeparatorAttribute() ?>" id="x_CI_Lector" name="x_CI_Lector"<?php echo $t_transaccion->CI_Lector->editAttributes() ?>>
		<?php echo $t_transaccion->CI_Lector->selectOptionListHtml("x_CI_Lector") ?>
	</select>
<?php echo $t_transaccion->CI_Lector->Lookup->getParamTag("p_x_CI_Lector") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_CI_Lector" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_transaccion->CI_Lector->caption() ?>" data-title="<?php echo $t_transaccion->CI_Lector->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_CI_Lector',url:'t_lectoraddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<?php echo $t_transaccion->CI_Lector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
	<div id="r_Nombres" class="form-group row">
		<label id="elh_t_transaccion_Nombres" for="x_Nombres" class="<?php echo $t_transaccion_add->LeftColumnClass ?>"><?php echo $t_transaccion->Nombres->caption() ?><?php echo ($t_transaccion->Nombres->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_transaccion_add->RightColumnClass ?>"><div<?php echo $t_transaccion->Nombres->cellAttributes() ?>>
<span id="el_t_transaccion_Nombres">
<input type="text" data-table="t_transaccion" data-field="x_Nombres" name="x_Nombres" id="x_Nombres" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_transaccion->Nombres->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Nombres->EditValue ?>"<?php echo $t_transaccion->Nombres->editAttributes() ?>>
</span>
<?php echo $t_transaccion->Nombres->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
	<div id="r_Apellidos" class="form-group row">
		<label id="elh_t_transaccion_Apellidos" for="x_Apellidos" class="<?php echo $t_transaccion_add->LeftColumnClass ?>"><?php echo $t_transaccion->Apellidos->caption() ?><?php echo ($t_transaccion->Apellidos->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_transaccion_add->RightColumnClass ?>"><div<?php echo $t_transaccion->Apellidos->cellAttributes() ?>>
<span id="el_t_transaccion_Apellidos">
<input type="text" data-table="t_transaccion" data-field="x_Apellidos" name="x_Apellidos" id="x_Apellidos" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_transaccion->Apellidos->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Apellidos->EditValue ?>"<?php echo $t_transaccion->Apellidos->editAttributes() ?>>
</span>
<?php echo $t_transaccion->Apellidos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
	<div id="r_Cod_libro" class="form-group row">
		<label id="elh_t_transaccion_Cod_libro" for="x_Cod_libro" class="<?php echo $t_transaccion_add->LeftColumnClass ?>"><?php echo $t_transaccion->Cod_libro->caption() ?><?php echo ($t_transaccion->Cod_libro->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_transaccion_add->RightColumnClass ?>"><div<?php echo $t_transaccion->Cod_libro->cellAttributes() ?>>
<span id="el_t_transaccion_Cod_libro">
<?php $t_transaccion->Cod_libro->EditAttrs["onchange"] = "ew.autoFill(this);" . @$t_transaccion->Cod_libro->EditAttrs["onchange"]; ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Cod_libro"><?php echo strval($t_transaccion->Cod_libro->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_transaccion->Cod_libro->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_transaccion->Cod_libro->caption()), $Language->Phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo (($t_transaccion->Cod_libro->ReadOnly || $t_transaccion->Cod_libro->Disabled) ? " disabled" : "")?> onclick="ew.modalLookupShow({lnk:this,el:'x_Cod_libro',m:0,n:10});"><i class="fa fa-search ew-icon"></i></button>
<?php echo $t_transaccion->Cod_libro->Lookup->getParamTag("p_x_Cod_libro") ?>
	</div>
</div>
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_transaccion->Cod_libro->displayValueSeparatorAttribute() ?>" name="x_Cod_libro" id="x_Cod_libro" value="<?php echo $t_transaccion->Cod_libro->CurrentValue ?>"<?php echo $t_transaccion->Cod_libro->editAttributes() ?>>
</span>
<?php echo $t_transaccion->Cod_libro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
	<div id="r_Titulo" class="form-group row">
		<label id="elh_t_transaccion_Titulo" for="x_Titulo" class="<?php echo $t_transaccion_add->LeftColumnClass ?>"><?php echo $t_transaccion->Titulo->caption() ?><?php echo ($t_transaccion->Titulo->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_transaccion_add->RightColumnClass ?>"><div<?php echo $t_transaccion->Titulo->cellAttributes() ?>>
<span id="el_t_transaccion_Titulo">
<input type="text" data-table="t_transaccion" data-field="x_Titulo" name="x_Titulo" id="x_Titulo" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_transaccion->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Titulo->EditValue ?>"<?php echo $t_transaccion->Titulo->editAttributes() ?>>
</span>
<?php echo $t_transaccion->Titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
	<div id="r_Estado" class="form-group row">
		<label id="elh_t_transaccion_Estado" for="x_Estado" class="<?php echo $t_transaccion_add->LeftColumnClass ?>"><?php echo $t_transaccion->Estado->caption() ?><?php echo ($t_transaccion->Estado->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_transaccion_add->RightColumnClass ?>"><div<?php echo $t_transaccion->Estado->cellAttributes() ?>>
<span id="el_t_transaccion_Estado">
<input type="text" data-table="t_transaccion" data-field="x_Estado" name="x_Estado" id="x_Estado" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_transaccion->Estado->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Estado->EditValue ?>"<?php echo $t_transaccion->Estado->editAttributes() ?>>
</span>
<?php echo $t_transaccion->Estado->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_transaccion_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_transaccion_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_transaccion_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_transaccion_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_transaccion_add->terminate();
?>
