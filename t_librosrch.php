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
$t_libro_search = new t_libro_search();

// Run the page
$t_libro_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_libro_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($t_libro_search->IsModal) { ?>
var ft_librosearch = currentAdvancedSearchForm = new ew.Form("ft_librosearch", "search");
<?php } else { ?>
var ft_librosearch = currentForm = new ew.Form("ft_librosearch", "search");
<?php } ?>

// Form_CustomValidate event
ft_librosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_librosearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_librosearch.lists["x_Area"] = <?php echo $t_libro_search->Area->Lookup->toClientList() ?>;
ft_librosearch.lists["x_Area"].options = <?php echo JsonEncode($t_libro_search->Area->lookupOptions()) ?>;
ft_librosearch.lists["x_Categoria"] = <?php echo $t_libro_search->Categoria->Lookup->toClientList() ?>;
ft_librosearch.lists["x_Categoria"].options = <?php echo JsonEncode($t_libro_search->Categoria->lookupOptions()) ?>;

// Form object for search
// Validate function for search

ft_librosearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_Id_libro");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($t_libro->Id_libro->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_Fecha_publicacion");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($t_libro->Fecha_publicacion->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_Edicion");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($t_libro->Edicion->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_N_copias");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($t_libro->N_copias->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_libro_search->showPageHeader(); ?>
<?php
$t_libro_search->showMessage();
?>
<form name="ft_librosearch" id="ft_librosearch" class="<?php echo $t_libro_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_libro_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_libro_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_libro">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$t_libro_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
	<div id="r_Id_libro" class="form-group row">
		<label for="x_Id_libro" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Id_libro"><?php echo $t_libro->Id_libro->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Id_libro" id="z_Id_libro" value="="></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Id_libro->cellAttributes() ?>>
			<span id="el_t_libro_Id_libro">
<input type="text" data-table="t_libro" data-field="x_Id_libro" name="x_Id_libro" id="x_Id_libro" placeholder="<?php echo HtmlEncode($t_libro->Id_libro->getPlaceHolder()) ?>" value="<?php echo $t_libro->Id_libro->EditValue ?>"<?php echo $t_libro->Id_libro->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
	<div id="r_Codigo_Libro" class="form-group row">
		<label for="x_Codigo_Libro" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Codigo_Libro"><?php echo $t_libro->Codigo_Libro->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Codigo_Libro" id="z_Codigo_Libro" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Codigo_Libro->cellAttributes() ?>>
			<span id="el_t_libro_Codigo_Libro">
<input type="text" data-table="t_libro" data-field="x_Codigo_Libro" name="x_Codigo_Libro" id="x_Codigo_Libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_libro->Codigo_Libro->getPlaceHolder()) ?>" value="<?php echo $t_libro->Codigo_Libro->EditValue ?>"<?php echo $t_libro->Codigo_Libro->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
	<div id="r_Titulo" class="form-group row">
		<label for="x_Titulo" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Titulo"><?php echo $t_libro->Titulo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Titulo" id="z_Titulo" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Titulo->cellAttributes() ?>>
			<span id="el_t_libro_Titulo">
<input type="text" data-table="t_libro" data-field="x_Titulo" name="x_Titulo" id="x_Titulo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_libro->Titulo->EditValue ?>"<?php echo $t_libro->Titulo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Autor->Visible) { // Autor ?>
	<div id="r_Autor" class="form-group row">
		<label for="x_Autor" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Autor"><?php echo $t_libro->Autor->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Autor" id="z_Autor" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Autor->cellAttributes() ?>>
			<span id="el_t_libro_Autor">
<input type="text" data-table="t_libro" data-field="x_Autor" name="x_Autor" id="x_Autor" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Autor->getPlaceHolder()) ?>" value="<?php echo $t_libro->Autor->EditValue ?>"<?php echo $t_libro->Autor->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
	<div id="r_Editorial" class="form-group row">
		<label for="x_Editorial" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Editorial"><?php echo $t_libro->Editorial->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Editorial" id="z_Editorial" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Editorial->cellAttributes() ?>>
			<span id="el_t_libro_Editorial">
<input type="text" data-table="t_libro" data-field="x_Editorial" name="x_Editorial" id="x_Editorial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_libro->Editorial->getPlaceHolder()) ?>" value="<?php echo $t_libro->Editorial->EditValue ?>"<?php echo $t_libro->Editorial->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
	<div id="r_Fecha_publicacion" class="form-group row">
		<label for="x_Fecha_publicacion" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Fecha_publicacion"><?php echo $t_libro->Fecha_publicacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Fecha_publicacion" id="z_Fecha_publicacion" value="="></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Fecha_publicacion->cellAttributes() ?>>
			<span id="el_t_libro_Fecha_publicacion">
<input type="text" data-table="t_libro" data-field="x_Fecha_publicacion" name="x_Fecha_publicacion" id="x_Fecha_publicacion" placeholder="<?php echo HtmlEncode($t_libro->Fecha_publicacion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Fecha_publicacion->EditValue ?>"<?php echo $t_libro->Fecha_publicacion->editAttributes() ?>>
<?php if (!$t_libro->Fecha_publicacion->ReadOnly && !$t_libro->Fecha_publicacion->Disabled && !isset($t_libro->Fecha_publicacion->EditAttrs["readonly"]) && !isset($t_libro->Fecha_publicacion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ft_librosearch", "x_Fecha_publicacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
	<div id="r_Edicion" class="form-group row">
		<label for="x_Edicion" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Edicion"><?php echo $t_libro->Edicion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Edicion" id="z_Edicion" value="="></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Edicion->cellAttributes() ?>>
			<span id="el_t_libro_Edicion">
<input type="text" data-table="t_libro" data-field="x_Edicion" name="x_Edicion" id="x_Edicion" size="30" placeholder="<?php echo HtmlEncode($t_libro->Edicion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Edicion->EditValue ?>"<?php echo $t_libro->Edicion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Area->Visible) { // Area ?>
	<div id="r_Area" class="form-group row">
		<label for="x_Area" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Area"><?php echo $t_libro->Area->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Area" id="z_Area" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Area->cellAttributes() ?>>
			<span id="el_t_libro_Area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Area" data-value-separator="<?php echo $t_libro->Area->displayValueSeparatorAttribute() ?>" id="x_Area" name="x_Area"<?php echo $t_libro->Area->editAttributes() ?>>
		<?php echo $t_libro->Area->selectOptionListHtml("x_Area") ?>
	</select>
<?php echo $t_libro->Area->Lookup->getParamTag("p_x_Area") ?>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
	<div id="r_Categoria" class="form-group row">
		<label for="x_Categoria" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Categoria"><?php echo $t_libro->Categoria->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Categoria" id="z_Categoria" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Categoria->cellAttributes() ?>>
			<span id="el_t_libro_Categoria">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Categoria" data-value-separator="<?php echo $t_libro->Categoria->displayValueSeparatorAttribute() ?>" id="x_Categoria" name="x_Categoria"<?php echo $t_libro->Categoria->editAttributes() ?>>
		<?php echo $t_libro->Categoria->selectOptionListHtml("x_Categoria") ?>
	</select>
<?php echo $t_libro->Categoria->Lookup->getParamTag("p_x_Categoria") ?>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Palabras_Claves->Visible) { // Palabras_Claves ?>
	<div id="r_Palabras_Claves" class="form-group row">
		<label for="x_Palabras_Claves" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_Palabras_Claves"><?php echo $t_libro->Palabras_Claves->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Palabras_Claves" id="z_Palabras_Claves" value="LIKE"></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->Palabras_Claves->cellAttributes() ?>>
			<span id="el_t_libro_Palabras_Claves">
<input type="text" data-table="t_libro" data-field="x_Palabras_Claves" name="x_Palabras_Claves" id="x_Palabras_Claves" size="35" placeholder="<?php echo HtmlEncode($t_libro->Palabras_Claves->getPlaceHolder()) ?>" value="<?php echo $t_libro->Palabras_Claves->EditValue ?>"<?php echo $t_libro->Palabras_Claves->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
	<div id="r_N_copias" class="form-group row">
		<label for="x_N_copias" class="<?php echo $t_libro_search->LeftColumnClass ?>"><span id="elh_t_libro_N_copias"><?php echo $t_libro->N_copias->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_N_copias" id="z_N_copias" value="="></span>
		</label>
		<div class="<?php echo $t_libro_search->RightColumnClass ?>"><div<?php echo $t_libro->N_copias->cellAttributes() ?>>
			<span id="el_t_libro_N_copias">
<input type="text" data-table="t_libro" data-field="x_N_copias" name="x_N_copias" id="x_N_copias" size="30" placeholder="<?php echo HtmlEncode($t_libro->N_copias->getPlaceHolder()) ?>" value="<?php echo $t_libro->N_copias->EditValue ?>"<?php echo $t_libro->N_copias->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_libro_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_libro_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_libro_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_libro_search->terminate();
?>
