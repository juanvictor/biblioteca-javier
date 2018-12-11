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
$t_transaccion_search = new t_transaccion_search();

// Run the page
$t_transaccion_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_transaccion_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($t_transaccion_search->IsModal) { ?>
var ft_transaccionsearch = currentAdvancedSearchForm = new ew.Form("ft_transaccionsearch", "search");
<?php } else { ?>
var ft_transaccionsearch = currentForm = new ew.Form("ft_transaccionsearch", "search");
<?php } ?>

// Form_CustomValidate event
ft_transaccionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_transaccionsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_transaccionsearch.lists["x_CI_Lector"] = <?php echo $t_transaccion_search->CI_Lector->Lookup->toClientList() ?>;
ft_transaccionsearch.lists["x_CI_Lector"].options = <?php echo JsonEncode($t_transaccion_search->CI_Lector->lookupOptions()) ?>;
ft_transaccionsearch.lists["x_Cod_libro"] = <?php echo $t_transaccion_search->Cod_libro->Lookup->toClientList() ?>;
ft_transaccionsearch.lists["x_Cod_libro"].options = <?php echo JsonEncode($t_transaccion_search->Cod_libro->lookupOptions()) ?>;

// Form object for search
// Validate function for search

ft_transaccionsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_Id_tran");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($t_transaccion->Id_tran->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_Fecha_Prestamo");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($t_transaccion->Fecha_Prestamo->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_Fecha_Devolucion");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($t_transaccion->Fecha_Devolucion->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_transaccion_search->showPageHeader(); ?>
<?php
$t_transaccion_search->showMessage();
?>
<form name="ft_transaccionsearch" id="ft_transaccionsearch" class="<?php echo $t_transaccion_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_transaccion_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_transaccion_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_transaccion">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$t_transaccion_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($t_transaccion->Id_tran->Visible) { // Id_tran ?>
	<div id="r_Id_tran" class="form-group row">
		<label for="x_Id_tran" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Id_tran"><?php echo $t_transaccion->Id_tran->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Id_tran" id="z_Id_tran" value="="></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Id_tran->cellAttributes() ?>>
			<span id="el_t_transaccion_Id_tran">
<input type="text" data-table="t_transaccion" data-field="x_Id_tran" name="x_Id_tran" id="x_Id_tran" placeholder="<?php echo HtmlEncode($t_transaccion->Id_tran->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Id_tran->EditValue ?>"<?php echo $t_transaccion->Id_tran->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->CI_Lector->Visible) { // CI_Lector ?>
	<div id="r_CI_Lector" class="form-group row">
		<label for="x_CI_Lector" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_CI_Lector"><?php echo $t_transaccion->CI_Lector->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_CI_Lector" id="z_CI_Lector" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->CI_Lector->cellAttributes() ?>>
			<span id="el_t_transaccion_CI_Lector">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_transaccion" data-field="x_CI_Lector" data-value-separator="<?php echo $t_transaccion->CI_Lector->displayValueSeparatorAttribute() ?>" id="x_CI_Lector" name="x_CI_Lector"<?php echo $t_transaccion->CI_Lector->editAttributes() ?>>
		<?php echo $t_transaccion->CI_Lector->selectOptionListHtml("x_CI_Lector") ?>
	</select>
<?php echo $t_transaccion->CI_Lector->Lookup->getParamTag("p_x_CI_Lector") ?>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Nombres->Visible) { // Nombres ?>
	<div id="r_Nombres" class="form-group row">
		<label for="x_Nombres" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Nombres"><?php echo $t_transaccion->Nombres->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Nombres" id="z_Nombres" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Nombres->cellAttributes() ?>>
			<span id="el_t_transaccion_Nombres">
<input type="text" data-table="t_transaccion" data-field="x_Nombres" name="x_Nombres" id="x_Nombres" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_transaccion->Nombres->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Nombres->EditValue ?>"<?php echo $t_transaccion->Nombres->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Apellidos->Visible) { // Apellidos ?>
	<div id="r_Apellidos" class="form-group row">
		<label for="x_Apellidos" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Apellidos"><?php echo $t_transaccion->Apellidos->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Apellidos" id="z_Apellidos" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Apellidos->cellAttributes() ?>>
			<span id="el_t_transaccion_Apellidos">
<input type="text" data-table="t_transaccion" data-field="x_Apellidos" name="x_Apellidos" id="x_Apellidos" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($t_transaccion->Apellidos->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Apellidos->EditValue ?>"<?php echo $t_transaccion->Apellidos->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Cod_libro->Visible) { // Cod_libro ?>
	<div id="r_Cod_libro" class="form-group row">
		<label for="x_Cod_libro" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Cod_libro"><?php echo $t_transaccion->Cod_libro->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Cod_libro" id="z_Cod_libro" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Cod_libro->cellAttributes() ?>>
			<span id="el_t_transaccion_Cod_libro">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Cod_libro"><?php echo strval($t_transaccion->Cod_libro->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_transaccion->Cod_libro->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($t_transaccion->Cod_libro->caption()), $Language->Phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo (($t_transaccion->Cod_libro->ReadOnly || $t_transaccion->Cod_libro->Disabled) ? " disabled" : "")?> onclick="ew.modalLookupShow({lnk:this,el:'x_Cod_libro',m:0,n:10});"><i class="fa fa-search ew-icon"></i></button>
<?php echo $t_transaccion->Cod_libro->Lookup->getParamTag("p_x_Cod_libro") ?>
	</div>
</div>
<input type="hidden" data-table="t_transaccion" data-field="x_Cod_libro" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_transaccion->Cod_libro->displayValueSeparatorAttribute() ?>" name="x_Cod_libro" id="x_Cod_libro" value="<?php echo $t_transaccion->Cod_libro->AdvancedSearch->SearchValue ?>"<?php echo $t_transaccion->Cod_libro->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Titulo->Visible) { // Titulo ?>
	<div id="r_Titulo" class="form-group row">
		<label for="x_Titulo" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Titulo"><?php echo $t_transaccion->Titulo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Titulo" id="z_Titulo" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Titulo->cellAttributes() ?>>
			<span id="el_t_transaccion_Titulo">
<input type="text" data-table="t_transaccion" data-field="x_Titulo" name="x_Titulo" id="x_Titulo" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($t_transaccion->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Titulo->EditValue ?>"<?php echo $t_transaccion->Titulo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Fecha_Prestamo->Visible) { // Fecha_Prestamo ?>
	<div id="r_Fecha_Prestamo" class="form-group row">
		<label for="x_Fecha_Prestamo" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Fecha_Prestamo"><?php echo $t_transaccion->Fecha_Prestamo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Fecha_Prestamo" id="z_Fecha_Prestamo" value="="></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Fecha_Prestamo->cellAttributes() ?>>
			<span id="el_t_transaccion_Fecha_Prestamo">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Prestamo" name="x_Fecha_Prestamo" id="x_Fecha_Prestamo" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Prestamo->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Prestamo->EditValue ?>"<?php echo $t_transaccion->Fecha_Prestamo->editAttributes() ?>>
<?php if (!$t_transaccion->Fecha_Prestamo->ReadOnly && !$t_transaccion->Fecha_Prestamo->Disabled && !isset($t_transaccion->Fecha_Prestamo->EditAttrs["readonly"]) && !isset($t_transaccion->Fecha_Prestamo->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ft_transaccionsearch", "x_Fecha_Prestamo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Fecha_Devolucion->Visible) { // Fecha_Devolucion ?>
	<div id="r_Fecha_Devolucion" class="form-group row">
		<label for="x_Fecha_Devolucion" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Fecha_Devolucion"><?php echo $t_transaccion->Fecha_Devolucion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Fecha_Devolucion" id="z_Fecha_Devolucion" value="="></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Fecha_Devolucion->cellAttributes() ?>>
			<span id="el_t_transaccion_Fecha_Devolucion">
<input type="text" data-table="t_transaccion" data-field="x_Fecha_Devolucion" name="x_Fecha_Devolucion" id="x_Fecha_Devolucion" placeholder="<?php echo HtmlEncode($t_transaccion->Fecha_Devolucion->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Fecha_Devolucion->EditValue ?>"<?php echo $t_transaccion->Fecha_Devolucion->editAttributes() ?>>
<?php if (!$t_transaccion->Fecha_Devolucion->ReadOnly && !$t_transaccion->Fecha_Devolucion->Disabled && !isset($t_transaccion->Fecha_Devolucion->EditAttrs["readonly"]) && !isset($t_transaccion->Fecha_Devolucion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ft_transaccionsearch", "x_Fecha_Devolucion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_transaccion->Estado->Visible) { // Estado ?>
	<div id="r_Estado" class="form-group row">
		<label for="x_Estado" class="<?php echo $t_transaccion_search->LeftColumnClass ?>"><span id="elh_t_transaccion_Estado"><?php echo $t_transaccion->Estado->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Estado" id="z_Estado" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_transaccion_search->RightColumnClass ?>"><div<?php echo $t_transaccion->Estado->cellAttributes() ?>>
			<span id="el_t_transaccion_Estado">
<input type="text" data-table="t_transaccion" data-field="x_Estado" name="x_Estado" id="x_Estado" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($t_transaccion->Estado->getPlaceHolder()) ?>" value="<?php echo $t_transaccion->Estado->EditValue ?>"<?php echo $t_transaccion->Estado->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_transaccion_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_transaccion_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_transaccion_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_transaccion_search->terminate();
?>
