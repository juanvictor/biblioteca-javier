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
$t_libro_edit = new t_libro_edit();

// Run the page
$t_libro_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_libro_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ft_libroedit = currentForm = new ew.Form("ft_libroedit", "edit");

// Validate form
ft_libroedit.validate = function() {
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
		<?php if ($t_libro_edit->Id_libro->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_libro");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Id_libro->caption(), $t_libro->Id_libro->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->Codigo_Libro->Required) { ?>
			elm = this.getElements("x" + infix + "_Codigo_Libro");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Codigo_Libro->caption(), $t_libro->Codigo_Libro->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->Titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_Titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Titulo->caption(), $t_libro->Titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->Autor->Required) { ?>
			elm = this.getElements("x" + infix + "_Autor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Autor->caption(), $t_libro->Autor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->Editorial->Required) { ?>
			elm = this.getElements("x" + infix + "_Editorial");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Editorial->caption(), $t_libro->Editorial->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->Fecha_publicacion->Required) { ?>
			elm = this.getElements("x" + infix + "_Fecha_publicacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Fecha_publicacion->caption(), $t_libro->Fecha_publicacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Fecha_publicacion");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($t_libro->Fecha_publicacion->errorMessage()) ?>");
		<?php if ($t_libro_edit->Edicion->Required) { ?>
			elm = this.getElements("x" + infix + "_Edicion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Edicion->caption(), $t_libro->Edicion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Edicion");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($t_libro->Edicion->errorMessage()) ?>");
		<?php if ($t_libro_edit->Area->Required) { ?>
			elm = this.getElements("x" + infix + "_Area");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Area->caption(), $t_libro->Area->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->Categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_Categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Categoria->caption(), $t_libro->Categoria->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->Palabras_Claves->Required) { ?>
			elm = this.getElements("x" + infix + "_Palabras_Claves");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Palabras_Claves->caption(), $t_libro->Palabras_Claves->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_edit->N_copias->Required) { ?>
			elm = this.getElements("x" + infix + "_N_copias");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->N_copias->caption(), $t_libro->N_copias->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_N_copias");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($t_libro->N_copias->errorMessage()) ?>");

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
ft_libroedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_libroedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_libroedit.lists["x_Area"] = <?php echo $t_libro_edit->Area->Lookup->toClientList() ?>;
ft_libroedit.lists["x_Area"].options = <?php echo JsonEncode($t_libro_edit->Area->lookupOptions()) ?>;
ft_libroedit.lists["x_Categoria"] = <?php echo $t_libro_edit->Categoria->Lookup->toClientList() ?>;
ft_libroedit.lists["x_Categoria"].options = <?php echo JsonEncode($t_libro_edit->Categoria->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_libro_edit->showPageHeader(); ?>
<?php
$t_libro_edit->showMessage();
?>
<form name="ft_libroedit" id="ft_libroedit" class="<?php echo $t_libro_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_libro_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_libro_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_libro">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$t_libro_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
	<div id="r_Id_libro" class="form-group row">
		<label id="elh_t_libro_Id_libro" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Id_libro->caption() ?><?php echo ($t_libro->Id_libro->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Id_libro->cellAttributes() ?>>
<span id="el_t_libro_Id_libro">
<span<?php echo $t_libro->Id_libro->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_libro->Id_libro->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Id_libro" name="x_Id_libro" id="x_Id_libro" value="<?php echo HtmlEncode($t_libro->Id_libro->CurrentValue) ?>">
<?php echo $t_libro->Id_libro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
	<div id="r_Codigo_Libro" class="form-group row">
		<label id="elh_t_libro_Codigo_Libro" for="x_Codigo_Libro" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Codigo_Libro->caption() ?><?php echo ($t_libro->Codigo_Libro->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Codigo_Libro->cellAttributes() ?>>
<span id="el_t_libro_Codigo_Libro">
<input type="text" data-table="t_libro" data-field="x_Codigo_Libro" name="x_Codigo_Libro" id="x_Codigo_Libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_libro->Codigo_Libro->getPlaceHolder()) ?>" value="<?php echo $t_libro->Codigo_Libro->EditValue ?>"<?php echo $t_libro->Codigo_Libro->editAttributes() ?>>
</span>
<?php echo $t_libro->Codigo_Libro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
	<div id="r_Titulo" class="form-group row">
		<label id="elh_t_libro_Titulo" for="x_Titulo" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Titulo->caption() ?><?php echo ($t_libro->Titulo->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Titulo->cellAttributes() ?>>
<span id="el_t_libro_Titulo">
<input type="text" data-table="t_libro" data-field="x_Titulo" name="x_Titulo" id="x_Titulo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_libro->Titulo->EditValue ?>"<?php echo $t_libro->Titulo->editAttributes() ?>>
</span>
<?php echo $t_libro->Titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Autor->Visible) { // Autor ?>
	<div id="r_Autor" class="form-group row">
		<label id="elh_t_libro_Autor" for="x_Autor" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Autor->caption() ?><?php echo ($t_libro->Autor->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Autor->cellAttributes() ?>>
<span id="el_t_libro_Autor">
<input type="text" data-table="t_libro" data-field="x_Autor" name="x_Autor" id="x_Autor" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Autor->getPlaceHolder()) ?>" value="<?php echo $t_libro->Autor->EditValue ?>"<?php echo $t_libro->Autor->editAttributes() ?>>
</span>
<?php echo $t_libro->Autor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
	<div id="r_Editorial" class="form-group row">
		<label id="elh_t_libro_Editorial" for="x_Editorial" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Editorial->caption() ?><?php echo ($t_libro->Editorial->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Editorial->cellAttributes() ?>>
<span id="el_t_libro_Editorial">
<input type="text" data-table="t_libro" data-field="x_Editorial" name="x_Editorial" id="x_Editorial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_libro->Editorial->getPlaceHolder()) ?>" value="<?php echo $t_libro->Editorial->EditValue ?>"<?php echo $t_libro->Editorial->editAttributes() ?>>
</span>
<?php echo $t_libro->Editorial->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
	<div id="r_Fecha_publicacion" class="form-group row">
		<label id="elh_t_libro_Fecha_publicacion" for="x_Fecha_publicacion" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Fecha_publicacion->caption() ?><?php echo ($t_libro->Fecha_publicacion->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Fecha_publicacion->cellAttributes() ?>>
<span id="el_t_libro_Fecha_publicacion">
<input type="text" data-table="t_libro" data-field="x_Fecha_publicacion" name="x_Fecha_publicacion" id="x_Fecha_publicacion" placeholder="<?php echo HtmlEncode($t_libro->Fecha_publicacion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Fecha_publicacion->EditValue ?>"<?php echo $t_libro->Fecha_publicacion->editAttributes() ?>>
<?php if (!$t_libro->Fecha_publicacion->ReadOnly && !$t_libro->Fecha_publicacion->Disabled && !isset($t_libro->Fecha_publicacion->EditAttrs["readonly"]) && !isset($t_libro->Fecha_publicacion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ft_libroedit", "x_Fecha_publicacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $t_libro->Fecha_publicacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
	<div id="r_Edicion" class="form-group row">
		<label id="elh_t_libro_Edicion" for="x_Edicion" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Edicion->caption() ?><?php echo ($t_libro->Edicion->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Edicion->cellAttributes() ?>>
<span id="el_t_libro_Edicion">
<input type="text" data-table="t_libro" data-field="x_Edicion" name="x_Edicion" id="x_Edicion" size="30" placeholder="<?php echo HtmlEncode($t_libro->Edicion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Edicion->EditValue ?>"<?php echo $t_libro->Edicion->editAttributes() ?>>
</span>
<?php echo $t_libro->Edicion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Area->Visible) { // Area ?>
	<div id="r_Area" class="form-group row">
		<label id="elh_t_libro_Area" for="x_Area" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Area->caption() ?><?php echo ($t_libro->Area->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Area->cellAttributes() ?>>
<span id="el_t_libro_Area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Area" data-value-separator="<?php echo $t_libro->Area->displayValueSeparatorAttribute() ?>" id="x_Area" name="x_Area"<?php echo $t_libro->Area->editAttributes() ?>>
		<?php echo $t_libro->Area->selectOptionListHtml("x_Area") ?>
	</select>
<?php echo $t_libro->Area->Lookup->getParamTag("p_x_Area") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_Area" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Area->caption() ?>" data-title="<?php echo $t_libro->Area->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_Area',url:'t_areaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<?php echo $t_libro->Area->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
	<div id="r_Categoria" class="form-group row">
		<label id="elh_t_libro_Categoria" for="x_Categoria" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Categoria->caption() ?><?php echo ($t_libro->Categoria->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Categoria->cellAttributes() ?>>
<span id="el_t_libro_Categoria">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Categoria" data-value-separator="<?php echo $t_libro->Categoria->displayValueSeparatorAttribute() ?>" id="x_Categoria" name="x_Categoria"<?php echo $t_libro->Categoria->editAttributes() ?>>
		<?php echo $t_libro->Categoria->selectOptionListHtml("x_Categoria") ?>
	</select>
<?php echo $t_libro->Categoria->Lookup->getParamTag("p_x_Categoria") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_Categoria" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Categoria->caption() ?>" data-title="<?php echo $t_libro->Categoria->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_Categoria',url:'t_categoriaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<?php echo $t_libro->Categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->Palabras_Claves->Visible) { // Palabras_Claves ?>
	<div id="r_Palabras_Claves" class="form-group row">
		<label id="elh_t_libro_Palabras_Claves" for="x_Palabras_Claves" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->Palabras_Claves->caption() ?><?php echo ($t_libro->Palabras_Claves->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->Palabras_Claves->cellAttributes() ?>>
<span id="el_t_libro_Palabras_Claves">
<textarea data-table="t_libro" data-field="x_Palabras_Claves" name="x_Palabras_Claves" id="x_Palabras_Claves" cols="35" rows="4" placeholder="<?php echo HtmlEncode($t_libro->Palabras_Claves->getPlaceHolder()) ?>"<?php echo $t_libro->Palabras_Claves->editAttributes() ?>><?php echo $t_libro->Palabras_Claves->EditValue ?></textarea>
</span>
<?php echo $t_libro->Palabras_Claves->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
	<div id="r_N_copias" class="form-group row">
		<label id="elh_t_libro_N_copias" for="x_N_copias" class="<?php echo $t_libro_edit->LeftColumnClass ?>"><?php echo $t_libro->N_copias->caption() ?><?php echo ($t_libro->N_copias->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_libro_edit->RightColumnClass ?>"><div<?php echo $t_libro->N_copias->cellAttributes() ?>>
<span id="el_t_libro_N_copias">
<input type="text" data-table="t_libro" data-field="x_N_copias" name="x_N_copias" id="x_N_copias" size="30" placeholder="<?php echo HtmlEncode($t_libro->N_copias->getPlaceHolder()) ?>" value="<?php echo $t_libro->N_copias->EditValue ?>"<?php echo $t_libro->N_copias->editAttributes() ?>>
</span>
<?php echo $t_libro->N_copias->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_libro_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_libro_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_libro_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$t_libro_edit->IsModal) { ?>
<?php if (!isset($t_libro_edit->Pager)) $t_libro_edit->Pager = new PrevNextPager($t_libro_edit->StartRec, $t_libro_edit->DisplayRecs, $t_libro_edit->TotalRecs, $t_libro_edit->AutoHidePager) ?>
<?php if ($t_libro_edit->Pager->RecordCount > 0 && $t_libro_edit->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($t_libro_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_libro_edit->pageUrl() ?>start=<?php echo $t_libro_edit->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($t_libro_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_libro_edit->pageUrl() ?>start=<?php echo $t_libro_edit->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $t_libro_edit->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($t_libro_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_libro_edit->pageUrl() ?>start=<?php echo $t_libro_edit->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($t_libro_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_libro_edit->pageUrl() ?>start=<?php echo $t_libro_edit->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_libro_edit->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$t_libro_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_libro_edit->terminate();
?>
