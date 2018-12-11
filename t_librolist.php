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
$t_libro_list = new t_libro_list();

// Run the page
$t_libro_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_libro_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_libro->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ft_librolist = currentForm = new ew.Form("ft_librolist", "list");
ft_librolist.formKeyCountName = '<?php echo $t_libro_list->FormKeyCountName ?>';

// Validate form
ft_librolist.validate = function() {
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
		<?php if ($t_libro_list->Id_libro->Required) { ?>
			elm = this.getElements("x" + infix + "_Id_libro");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Id_libro->caption(), $t_libro->Id_libro->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_list->Codigo_Libro->Required) { ?>
			elm = this.getElements("x" + infix + "_Codigo_Libro");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Codigo_Libro->caption(), $t_libro->Codigo_Libro->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_list->Titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_Titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Titulo->caption(), $t_libro->Titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_list->Autor->Required) { ?>
			elm = this.getElements("x" + infix + "_Autor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Autor->caption(), $t_libro->Autor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_list->Editorial->Required) { ?>
			elm = this.getElements("x" + infix + "_Editorial");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Editorial->caption(), $t_libro->Editorial->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_list->Fecha_publicacion->Required) { ?>
			elm = this.getElements("x" + infix + "_Fecha_publicacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Fecha_publicacion->caption(), $t_libro->Fecha_publicacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Fecha_publicacion");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($t_libro->Fecha_publicacion->errorMessage()) ?>");
		<?php if ($t_libro_list->Edicion->Required) { ?>
			elm = this.getElements("x" + infix + "_Edicion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Edicion->caption(), $t_libro->Edicion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Edicion");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($t_libro->Edicion->errorMessage()) ?>");
		<?php if ($t_libro_list->Area->Required) { ?>
			elm = this.getElements("x" + infix + "_Area");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Area->caption(), $t_libro->Area->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_list->Categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_Categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_libro->Categoria->caption(), $t_libro->Categoria->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($t_libro_list->N_copias->Required) { ?>
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
	return true;
}

// Form_CustomValidate event
ft_librolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_librolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_librolist.lists["x_Area"] = <?php echo $t_libro_list->Area->Lookup->toClientList() ?>;
ft_librolist.lists["x_Area"].options = <?php echo JsonEncode($t_libro_list->Area->lookupOptions()) ?>;
ft_librolist.lists["x_Categoria"] = <?php echo $t_libro_list->Categoria->Lookup->toClientList() ?>;
ft_librolist.lists["x_Categoria"].options = <?php echo JsonEncode($t_libro_list->Categoria->lookupOptions()) ?>;

// Form object for search
var ft_librolistsrch = currentSearchForm = new ew.Form("ft_librolistsrch");

// Filters
ft_librolistsrch.filterList = <?php echo $t_libro_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_libro->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_libro_list->TotalRecs > 0 && $t_libro_list->ExportOptions->visible()) { ?>
<?php $t_libro_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_libro_list->ImportOptions->visible()) { ?>
<?php $t_libro_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_libro_list->SearchOptions->visible()) { ?>
<?php $t_libro_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_libro_list->FilterOptions->visible()) { ?>
<?php $t_libro_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_libro_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$t_libro->isExport() && !$t_libro->CurrentAction) { ?>
<form name="ft_librolistsrch" id="ft_librolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($t_libro_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ft_librolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_libro">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($t_libro_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($t_libro_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_libro_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_libro_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_libro_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_libro_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_libro_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $t_libro_list->showPageHeader(); ?>
<?php
$t_libro_list->showMessage();
?>
<?php if ($t_libro_list->TotalRecs > 0 || $t_libro->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_libro_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_libro">
<form name="ft_librolist" id="ft_librolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_libro_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_libro_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_libro">
<div id="gmp_t_libro" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($t_libro_list->TotalRecs > 0 || $t_libro->isGridEdit()) { ?>
<table id="tbl_t_librolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_libro_list->RowType = ROWTYPE_HEADER;

// Render list options
$t_libro_list->renderListOptions();

// Render list options (header, left)
$t_libro_list->ListOptions->render("header", "left");
?>
<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
	<?php if ($t_libro->sortUrl($t_libro->Id_libro) == "") { ?>
		<th data-name="Id_libro" class="<?php echo $t_libro->Id_libro->headerCellClass() ?>"><div id="elh_t_libro_Id_libro" class="t_libro_Id_libro"><div class="ew-table-header-caption"><?php echo $t_libro->Id_libro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Id_libro" class="<?php echo $t_libro->Id_libro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Id_libro) ?>',1);"><div id="elh_t_libro_Id_libro" class="t_libro_Id_libro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Id_libro->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Id_libro->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Id_libro->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
	<?php if ($t_libro->sortUrl($t_libro->Codigo_Libro) == "") { ?>
		<th data-name="Codigo_Libro" class="<?php echo $t_libro->Codigo_Libro->headerCellClass() ?>"><div id="elh_t_libro_Codigo_Libro" class="t_libro_Codigo_Libro"><div class="ew-table-header-caption"><?php echo $t_libro->Codigo_Libro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Codigo_Libro" class="<?php echo $t_libro->Codigo_Libro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Codigo_Libro) ?>',1);"><div id="elh_t_libro_Codigo_Libro" class="t_libro_Codigo_Libro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Codigo_Libro->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Codigo_Libro->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Codigo_Libro->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
	<?php if ($t_libro->sortUrl($t_libro->Titulo) == "") { ?>
		<th data-name="Titulo" class="<?php echo $t_libro->Titulo->headerCellClass() ?>"><div id="elh_t_libro_Titulo" class="t_libro_Titulo"><div class="ew-table-header-caption"><?php echo $t_libro->Titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Titulo" class="<?php echo $t_libro->Titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Titulo) ?>',1);"><div id="elh_t_libro_Titulo" class="t_libro_Titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Titulo->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Autor->Visible) { // Autor ?>
	<?php if ($t_libro->sortUrl($t_libro->Autor) == "") { ?>
		<th data-name="Autor" class="<?php echo $t_libro->Autor->headerCellClass() ?>"><div id="elh_t_libro_Autor" class="t_libro_Autor"><div class="ew-table-header-caption"><?php echo $t_libro->Autor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Autor" class="<?php echo $t_libro->Autor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Autor) ?>',1);"><div id="elh_t_libro_Autor" class="t_libro_Autor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Autor->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Autor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Autor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
	<?php if ($t_libro->sortUrl($t_libro->Editorial) == "") { ?>
		<th data-name="Editorial" class="<?php echo $t_libro->Editorial->headerCellClass() ?>"><div id="elh_t_libro_Editorial" class="t_libro_Editorial"><div class="ew-table-header-caption"><?php echo $t_libro->Editorial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Editorial" class="<?php echo $t_libro->Editorial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Editorial) ?>',1);"><div id="elh_t_libro_Editorial" class="t_libro_Editorial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Editorial->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Editorial->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Editorial->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
	<?php if ($t_libro->sortUrl($t_libro->Fecha_publicacion) == "") { ?>
		<th data-name="Fecha_publicacion" class="<?php echo $t_libro->Fecha_publicacion->headerCellClass() ?>"><div id="elh_t_libro_Fecha_publicacion" class="t_libro_Fecha_publicacion"><div class="ew-table-header-caption"><?php echo $t_libro->Fecha_publicacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fecha_publicacion" class="<?php echo $t_libro->Fecha_publicacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Fecha_publicacion) ?>',1);"><div id="elh_t_libro_Fecha_publicacion" class="t_libro_Fecha_publicacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Fecha_publicacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Fecha_publicacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Fecha_publicacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
	<?php if ($t_libro->sortUrl($t_libro->Edicion) == "") { ?>
		<th data-name="Edicion" class="<?php echo $t_libro->Edicion->headerCellClass() ?>"><div id="elh_t_libro_Edicion" class="t_libro_Edicion"><div class="ew-table-header-caption"><?php echo $t_libro->Edicion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Edicion" class="<?php echo $t_libro->Edicion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Edicion) ?>',1);"><div id="elh_t_libro_Edicion" class="t_libro_Edicion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Edicion->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Edicion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Edicion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Area->Visible) { // Area ?>
	<?php if ($t_libro->sortUrl($t_libro->Area) == "") { ?>
		<th data-name="Area" class="<?php echo $t_libro->Area->headerCellClass() ?>"><div id="elh_t_libro_Area" class="t_libro_Area"><div class="ew-table-header-caption"><?php echo $t_libro->Area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Area" class="<?php echo $t_libro->Area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Area) ?>',1);"><div id="elh_t_libro_Area" class="t_libro_Area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Area->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Area->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Area->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
	<?php if ($t_libro->sortUrl($t_libro->Categoria) == "") { ?>
		<th data-name="Categoria" class="<?php echo $t_libro->Categoria->headerCellClass() ?>"><div id="elh_t_libro_Categoria" class="t_libro_Categoria"><div class="ew-table-header-caption"><?php echo $t_libro->Categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Categoria" class="<?php echo $t_libro->Categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->Categoria) ?>',1);"><div id="elh_t_libro_Categoria" class="t_libro_Categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->Categoria->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_libro->Categoria->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->Categoria->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
	<?php if ($t_libro->sortUrl($t_libro->N_copias) == "") { ?>
		<th data-name="N_copias" class="<?php echo $t_libro->N_copias->headerCellClass() ?>"><div id="elh_t_libro_N_copias" class="t_libro_N_copias"><div class="ew-table-header-caption"><?php echo $t_libro->N_copias->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="N_copias" class="<?php echo $t_libro->N_copias->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $t_libro->SortUrl($t_libro->N_copias) ?>',1);"><div id="elh_t_libro_N_copias" class="t_libro_N_copias">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_libro->N_copias->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_libro->N_copias->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($t_libro->N_copias->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_libro_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_libro->ExportAll && $t_libro->isExport()) {
	$t_libro_list->StopRec = $t_libro_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t_libro_list->TotalRecs > $t_libro_list->StartRec + $t_libro_list->DisplayRecs - 1)
		$t_libro_list->StopRec = $t_libro_list->StartRec + $t_libro_list->DisplayRecs - 1;
	else
		$t_libro_list->StopRec = $t_libro_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $t_libro_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_libro_list->FormKeyCountName) && ($t_libro->isGridAdd() || $t_libro->isGridEdit() || $t_libro->isConfirm())) {
		$t_libro_list->KeyCount = $CurrentForm->getValue($t_libro_list->FormKeyCountName);
		$t_libro_list->StopRec = $t_libro_list->StartRec + $t_libro_list->KeyCount - 1;
	}
}
$t_libro_list->RecCnt = $t_libro_list->StartRec - 1;
if ($t_libro_list->Recordset && !$t_libro_list->Recordset->EOF) {
	$t_libro_list->Recordset->moveFirst();
	$selectLimit = $t_libro_list->UseSelectLimit;
	if (!$selectLimit && $t_libro_list->StartRec > 1)
		$t_libro_list->Recordset->move($t_libro_list->StartRec - 1);
} elseif (!$t_libro->AllowAddDeleteRow && $t_libro_list->StopRec == 0) {
	$t_libro_list->StopRec = $t_libro->GridAddRowCount;
}

// Initialize aggregate
$t_libro->RowType = ROWTYPE_AGGREGATEINIT;
$t_libro->resetAttributes();
$t_libro_list->renderRow();
if ($t_libro->isGridEdit())
	$t_libro_list->RowIndex = 0;
while ($t_libro_list->RecCnt < $t_libro_list->StopRec) {
	$t_libro_list->RecCnt++;
	if ($t_libro_list->RecCnt >= $t_libro_list->StartRec) {
		$t_libro_list->RowCnt++;
		if ($t_libro->isGridAdd() || $t_libro->isGridEdit() || $t_libro->isConfirm()) {
			$t_libro_list->RowIndex++;
			$CurrentForm->Index = $t_libro_list->RowIndex;
			if ($CurrentForm->hasValue($t_libro_list->FormActionName) && $t_libro_list->EventCancelled)
				$t_libro_list->RowAction = strval($CurrentForm->getValue($t_libro_list->FormActionName));
			elseif ($t_libro->isGridAdd())
				$t_libro_list->RowAction = "insert";
			else
				$t_libro_list->RowAction = "";
		}

		// Set up key count
		$t_libro_list->KeyCount = $t_libro_list->RowIndex;

		// Init row class and style
		$t_libro->resetAttributes();
		$t_libro->CssClass = "";
		if ($t_libro->isGridAdd()) {
			$t_libro_list->loadRowValues(); // Load default values
		} else {
			$t_libro_list->loadRowValues($t_libro_list->Recordset); // Load row values
		}
		$t_libro->RowType = ROWTYPE_VIEW; // Render view
		if ($t_libro->isGridEdit()) { // Grid edit
			if ($t_libro->EventCancelled)
				$t_libro_list->restoreCurrentRowFormValues($t_libro_list->RowIndex); // Restore form values
			if ($t_libro_list->RowAction == "insert")
				$t_libro->RowType = ROWTYPE_ADD; // Render add
			else
				$t_libro->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_libro->isGridEdit() && ($t_libro->RowType == ROWTYPE_EDIT || $t_libro->RowType == ROWTYPE_ADD) && $t_libro->EventCancelled) // Update failed
			$t_libro_list->restoreCurrentRowFormValues($t_libro_list->RowIndex); // Restore form values
		if ($t_libro->RowType == ROWTYPE_EDIT) // Edit row
			$t_libro_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t_libro->RowAttrs = array_merge($t_libro->RowAttrs, array('data-rowindex'=>$t_libro_list->RowCnt, 'id'=>'r' . $t_libro_list->RowCnt . '_t_libro', 'data-rowtype'=>$t_libro->RowType));

		// Render row
		$t_libro_list->renderRow();

		// Render list options
		$t_libro_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_libro_list->RowAction <> "delete" && $t_libro_list->RowAction <> "insertdelete" && !($t_libro_list->RowAction == "insert" && $t_libro->isConfirm() && $t_libro_list->emptyRow())) {
?>
	<tr<?php echo $t_libro->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_libro_list->ListOptions->render("body", "left", $t_libro_list->RowCnt);
?>
	<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
		<td data-name="Id_libro"<?php echo $t_libro->Id_libro->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_libro" data-field="x_Id_libro" name="o<?php echo $t_libro_list->RowIndex ?>_Id_libro" id="o<?php echo $t_libro_list->RowIndex ?>_Id_libro" value="<?php echo HtmlEncode($t_libro->Id_libro->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Id_libro" class="form-group t_libro_Id_libro">
<span<?php echo $t_libro->Id_libro->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($t_libro->Id_libro->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Id_libro" name="x<?php echo $t_libro_list->RowIndex ?>_Id_libro" id="x<?php echo $t_libro_list->RowIndex ?>_Id_libro" value="<?php echo HtmlEncode($t_libro->Id_libro->CurrentValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Id_libro" class="t_libro_Id_libro">
<span<?php echo $t_libro->Id_libro->viewAttributes() ?>>
<?php echo $t_libro->Id_libro->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
		<td data-name="Codigo_Libro"<?php echo $t_libro->Codigo_Libro->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Codigo_Libro" class="form-group t_libro_Codigo_Libro">
<input type="text" data-table="t_libro" data-field="x_Codigo_Libro" name="x<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" id="x<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_libro->Codigo_Libro->getPlaceHolder()) ?>" value="<?php echo $t_libro->Codigo_Libro->EditValue ?>"<?php echo $t_libro->Codigo_Libro->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Codigo_Libro" name="o<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" id="o<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" value="<?php echo HtmlEncode($t_libro->Codigo_Libro->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Codigo_Libro" class="form-group t_libro_Codigo_Libro">
<input type="text" data-table="t_libro" data-field="x_Codigo_Libro" name="x<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" id="x<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_libro->Codigo_Libro->getPlaceHolder()) ?>" value="<?php echo $t_libro->Codigo_Libro->EditValue ?>"<?php echo $t_libro->Codigo_Libro->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Codigo_Libro" class="t_libro_Codigo_Libro">
<span<?php echo $t_libro->Codigo_Libro->viewAttributes() ?>>
<?php echo $t_libro->Codigo_Libro->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo"<?php echo $t_libro->Titulo->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Titulo" class="form-group t_libro_Titulo">
<input type="text" data-table="t_libro" data-field="x_Titulo" name="x<?php echo $t_libro_list->RowIndex ?>_Titulo" id="x<?php echo $t_libro_list->RowIndex ?>_Titulo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_libro->Titulo->EditValue ?>"<?php echo $t_libro->Titulo->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Titulo" name="o<?php echo $t_libro_list->RowIndex ?>_Titulo" id="o<?php echo $t_libro_list->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_libro->Titulo->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Titulo" class="form-group t_libro_Titulo">
<input type="text" data-table="t_libro" data-field="x_Titulo" name="x<?php echo $t_libro_list->RowIndex ?>_Titulo" id="x<?php echo $t_libro_list->RowIndex ?>_Titulo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_libro->Titulo->EditValue ?>"<?php echo $t_libro->Titulo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Titulo" class="t_libro_Titulo">
<span<?php echo $t_libro->Titulo->viewAttributes() ?>>
<?php echo $t_libro->Titulo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Autor->Visible) { // Autor ?>
		<td data-name="Autor"<?php echo $t_libro->Autor->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Autor" class="form-group t_libro_Autor">
<input type="text" data-table="t_libro" data-field="x_Autor" name="x<?php echo $t_libro_list->RowIndex ?>_Autor" id="x<?php echo $t_libro_list->RowIndex ?>_Autor" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Autor->getPlaceHolder()) ?>" value="<?php echo $t_libro->Autor->EditValue ?>"<?php echo $t_libro->Autor->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Autor" name="o<?php echo $t_libro_list->RowIndex ?>_Autor" id="o<?php echo $t_libro_list->RowIndex ?>_Autor" value="<?php echo HtmlEncode($t_libro->Autor->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Autor" class="form-group t_libro_Autor">
<input type="text" data-table="t_libro" data-field="x_Autor" name="x<?php echo $t_libro_list->RowIndex ?>_Autor" id="x<?php echo $t_libro_list->RowIndex ?>_Autor" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Autor->getPlaceHolder()) ?>" value="<?php echo $t_libro->Autor->EditValue ?>"<?php echo $t_libro->Autor->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Autor" class="t_libro_Autor">
<span<?php echo $t_libro->Autor->viewAttributes() ?>>
<?php echo $t_libro->Autor->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
		<td data-name="Editorial"<?php echo $t_libro->Editorial->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Editorial" class="form-group t_libro_Editorial">
<input type="text" data-table="t_libro" data-field="x_Editorial" name="x<?php echo $t_libro_list->RowIndex ?>_Editorial" id="x<?php echo $t_libro_list->RowIndex ?>_Editorial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_libro->Editorial->getPlaceHolder()) ?>" value="<?php echo $t_libro->Editorial->EditValue ?>"<?php echo $t_libro->Editorial->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Editorial" name="o<?php echo $t_libro_list->RowIndex ?>_Editorial" id="o<?php echo $t_libro_list->RowIndex ?>_Editorial" value="<?php echo HtmlEncode($t_libro->Editorial->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Editorial" class="form-group t_libro_Editorial">
<input type="text" data-table="t_libro" data-field="x_Editorial" name="x<?php echo $t_libro_list->RowIndex ?>_Editorial" id="x<?php echo $t_libro_list->RowIndex ?>_Editorial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_libro->Editorial->getPlaceHolder()) ?>" value="<?php echo $t_libro->Editorial->EditValue ?>"<?php echo $t_libro->Editorial->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Editorial" class="t_libro_Editorial">
<span<?php echo $t_libro->Editorial->viewAttributes() ?>>
<?php echo $t_libro->Editorial->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
		<td data-name="Fecha_publicacion"<?php echo $t_libro->Fecha_publicacion->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Fecha_publicacion" class="form-group t_libro_Fecha_publicacion">
<input type="text" data-table="t_libro" data-field="x_Fecha_publicacion" name="x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" id="x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" placeholder="<?php echo HtmlEncode($t_libro->Fecha_publicacion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Fecha_publicacion->EditValue ?>"<?php echo $t_libro->Fecha_publicacion->editAttributes() ?>>
<?php if (!$t_libro->Fecha_publicacion->ReadOnly && !$t_libro->Fecha_publicacion->Disabled && !isset($t_libro->Fecha_publicacion->EditAttrs["readonly"]) && !isset($t_libro->Fecha_publicacion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ft_librolist", "x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Fecha_publicacion" name="o<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" id="o<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" value="<?php echo HtmlEncode($t_libro->Fecha_publicacion->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Fecha_publicacion" class="form-group t_libro_Fecha_publicacion">
<input type="text" data-table="t_libro" data-field="x_Fecha_publicacion" name="x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" id="x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" placeholder="<?php echo HtmlEncode($t_libro->Fecha_publicacion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Fecha_publicacion->EditValue ?>"<?php echo $t_libro->Fecha_publicacion->editAttributes() ?>>
<?php if (!$t_libro->Fecha_publicacion->ReadOnly && !$t_libro->Fecha_publicacion->Disabled && !isset($t_libro->Fecha_publicacion->EditAttrs["readonly"]) && !isset($t_libro->Fecha_publicacion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ft_librolist", "x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Fecha_publicacion" class="t_libro_Fecha_publicacion">
<span<?php echo $t_libro->Fecha_publicacion->viewAttributes() ?>>
<?php echo $t_libro->Fecha_publicacion->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
		<td data-name="Edicion"<?php echo $t_libro->Edicion->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Edicion" class="form-group t_libro_Edicion">
<input type="text" data-table="t_libro" data-field="x_Edicion" name="x<?php echo $t_libro_list->RowIndex ?>_Edicion" id="x<?php echo $t_libro_list->RowIndex ?>_Edicion" size="30" placeholder="<?php echo HtmlEncode($t_libro->Edicion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Edicion->EditValue ?>"<?php echo $t_libro->Edicion->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Edicion" name="o<?php echo $t_libro_list->RowIndex ?>_Edicion" id="o<?php echo $t_libro_list->RowIndex ?>_Edicion" value="<?php echo HtmlEncode($t_libro->Edicion->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Edicion" class="form-group t_libro_Edicion">
<input type="text" data-table="t_libro" data-field="x_Edicion" name="x<?php echo $t_libro_list->RowIndex ?>_Edicion" id="x<?php echo $t_libro_list->RowIndex ?>_Edicion" size="30" placeholder="<?php echo HtmlEncode($t_libro->Edicion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Edicion->EditValue ?>"<?php echo $t_libro->Edicion->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Edicion" class="t_libro_Edicion">
<span<?php echo $t_libro->Edicion->viewAttributes() ?>>
<?php echo $t_libro->Edicion->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Area->Visible) { // Area ?>
		<td data-name="Area"<?php echo $t_libro->Area->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Area" class="form-group t_libro_Area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Area" data-value-separator="<?php echo $t_libro->Area->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_libro_list->RowIndex ?>_Area" name="x<?php echo $t_libro_list->RowIndex ?>_Area"<?php echo $t_libro->Area->editAttributes() ?>>
		<?php echo $t_libro->Area->selectOptionListHtml("x<?php echo $t_libro_list->RowIndex ?>_Area") ?>
	</select>
<?php echo $t_libro->Area->Lookup->getParamTag("p_x<?php echo $t_libro_list->RowIndex ?>_Area") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_libro_list->RowIndex ?>_Area" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Area->caption() ?>" data-title="<?php echo $t_libro->Area->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_libro_list->RowIndex ?>_Area',url:'t_areaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Area" name="o<?php echo $t_libro_list->RowIndex ?>_Area" id="o<?php echo $t_libro_list->RowIndex ?>_Area" value="<?php echo HtmlEncode($t_libro->Area->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Area" class="form-group t_libro_Area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Area" data-value-separator="<?php echo $t_libro->Area->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_libro_list->RowIndex ?>_Area" name="x<?php echo $t_libro_list->RowIndex ?>_Area"<?php echo $t_libro->Area->editAttributes() ?>>
		<?php echo $t_libro->Area->selectOptionListHtml("x<?php echo $t_libro_list->RowIndex ?>_Area") ?>
	</select>
<?php echo $t_libro->Area->Lookup->getParamTag("p_x<?php echo $t_libro_list->RowIndex ?>_Area") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_libro_list->RowIndex ?>_Area" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Area->caption() ?>" data-title="<?php echo $t_libro->Area->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_libro_list->RowIndex ?>_Area',url:'t_areaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Area" class="t_libro_Area">
<span<?php echo $t_libro->Area->viewAttributes() ?>>
<?php echo $t_libro->Area->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
		<td data-name="Categoria"<?php echo $t_libro->Categoria->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Categoria" class="form-group t_libro_Categoria">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Categoria" data-value-separator="<?php echo $t_libro->Categoria->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_libro_list->RowIndex ?>_Categoria" name="x<?php echo $t_libro_list->RowIndex ?>_Categoria"<?php echo $t_libro->Categoria->editAttributes() ?>>
		<?php echo $t_libro->Categoria->selectOptionListHtml("x<?php echo $t_libro_list->RowIndex ?>_Categoria") ?>
	</select>
<?php echo $t_libro->Categoria->Lookup->getParamTag("p_x<?php echo $t_libro_list->RowIndex ?>_Categoria") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_libro_list->RowIndex ?>_Categoria" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Categoria->caption() ?>" data-title="<?php echo $t_libro->Categoria->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_libro_list->RowIndex ?>_Categoria',url:'t_categoriaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Categoria" name="o<?php echo $t_libro_list->RowIndex ?>_Categoria" id="o<?php echo $t_libro_list->RowIndex ?>_Categoria" value="<?php echo HtmlEncode($t_libro->Categoria->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Categoria" class="form-group t_libro_Categoria">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Categoria" data-value-separator="<?php echo $t_libro->Categoria->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_libro_list->RowIndex ?>_Categoria" name="x<?php echo $t_libro_list->RowIndex ?>_Categoria"<?php echo $t_libro->Categoria->editAttributes() ?>>
		<?php echo $t_libro->Categoria->selectOptionListHtml("x<?php echo $t_libro_list->RowIndex ?>_Categoria") ?>
	</select>
<?php echo $t_libro->Categoria->Lookup->getParamTag("p_x<?php echo $t_libro_list->RowIndex ?>_Categoria") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_libro_list->RowIndex ?>_Categoria" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Categoria->caption() ?>" data-title="<?php echo $t_libro->Categoria->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_libro_list->RowIndex ?>_Categoria',url:'t_categoriaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_Categoria" class="t_libro_Categoria">
<span<?php echo $t_libro->Categoria->viewAttributes() ?>>
<?php echo $t_libro->Categoria->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
		<td data-name="N_copias"<?php echo $t_libro->N_copias->cellAttributes() ?>>
<?php if ($t_libro->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_N_copias" class="form-group t_libro_N_copias">
<input type="text" data-table="t_libro" data-field="x_N_copias" name="x<?php echo $t_libro_list->RowIndex ?>_N_copias" id="x<?php echo $t_libro_list->RowIndex ?>_N_copias" size="30" placeholder="<?php echo HtmlEncode($t_libro->N_copias->getPlaceHolder()) ?>" value="<?php echo $t_libro->N_copias->EditValue ?>"<?php echo $t_libro->N_copias->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_N_copias" name="o<?php echo $t_libro_list->RowIndex ?>_N_copias" id="o<?php echo $t_libro_list->RowIndex ?>_N_copias" value="<?php echo HtmlEncode($t_libro->N_copias->OldValue) ?>">
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_N_copias" class="form-group t_libro_N_copias">
<input type="text" data-table="t_libro" data-field="x_N_copias" name="x<?php echo $t_libro_list->RowIndex ?>_N_copias" id="x<?php echo $t_libro_list->RowIndex ?>_N_copias" size="30" placeholder="<?php echo HtmlEncode($t_libro->N_copias->getPlaceHolder()) ?>" value="<?php echo $t_libro->N_copias->EditValue ?>"<?php echo $t_libro->N_copias->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_libro->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_libro_list->RowCnt ?>_t_libro_N_copias" class="t_libro_N_copias">
<span<?php echo $t_libro->N_copias->viewAttributes() ?>>
<?php echo $t_libro->N_copias->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_libro_list->ListOptions->render("body", "right", $t_libro_list->RowCnt);
?>
	</tr>
<?php if ($t_libro->RowType == ROWTYPE_ADD || $t_libro->RowType == ROWTYPE_EDIT) { ?>
<script>
ft_librolist.updateLists(<?php echo $t_libro_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_libro->isGridAdd())
		if (!$t_libro_list->Recordset->EOF)
			$t_libro_list->Recordset->moveNext();
}
?>
<?php
	if ($t_libro->isGridAdd() || $t_libro->isGridEdit()) {
		$t_libro_list->RowIndex = '$rowindex$';
		$t_libro_list->loadRowValues();

		// Set row properties
		$t_libro->resetAttributes();
		$t_libro->RowAttrs = array_merge($t_libro->RowAttrs, array('data-rowindex'=>$t_libro_list->RowIndex, 'id'=>'r0_t_libro', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($t_libro->RowAttrs["class"], "ew-template");
		$t_libro->RowType = ROWTYPE_ADD;

		// Render row
		$t_libro_list->renderRow();

		// Render list options
		$t_libro_list->renderListOptions();
		$t_libro_list->StartRowCnt = 0;
?>
	<tr<?php echo $t_libro->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_libro_list->ListOptions->render("body", "left", $t_libro_list->RowIndex);
?>
	<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
		<td data-name="Id_libro">
<input type="hidden" data-table="t_libro" data-field="x_Id_libro" name="o<?php echo $t_libro_list->RowIndex ?>_Id_libro" id="o<?php echo $t_libro_list->RowIndex ?>_Id_libro" value="<?php echo HtmlEncode($t_libro->Id_libro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
		<td data-name="Codigo_Libro">
<span id="el$rowindex$_t_libro_Codigo_Libro" class="form-group t_libro_Codigo_Libro">
<input type="text" data-table="t_libro" data-field="x_Codigo_Libro" name="x<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" id="x<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($t_libro->Codigo_Libro->getPlaceHolder()) ?>" value="<?php echo $t_libro->Codigo_Libro->EditValue ?>"<?php echo $t_libro->Codigo_Libro->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Codigo_Libro" name="o<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" id="o<?php echo $t_libro_list->RowIndex ?>_Codigo_Libro" value="<?php echo HtmlEncode($t_libro->Codigo_Libro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo">
<span id="el$rowindex$_t_libro_Titulo" class="form-group t_libro_Titulo">
<input type="text" data-table="t_libro" data-field="x_Titulo" name="x<?php echo $t_libro_list->RowIndex ?>_Titulo" id="x<?php echo $t_libro_list->RowIndex ?>_Titulo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Titulo->getPlaceHolder()) ?>" value="<?php echo $t_libro->Titulo->EditValue ?>"<?php echo $t_libro->Titulo->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Titulo" name="o<?php echo $t_libro_list->RowIndex ?>_Titulo" id="o<?php echo $t_libro_list->RowIndex ?>_Titulo" value="<?php echo HtmlEncode($t_libro->Titulo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Autor->Visible) { // Autor ?>
		<td data-name="Autor">
<span id="el$rowindex$_t_libro_Autor" class="form-group t_libro_Autor">
<input type="text" data-table="t_libro" data-field="x_Autor" name="x<?php echo $t_libro_list->RowIndex ?>_Autor" id="x<?php echo $t_libro_list->RowIndex ?>_Autor" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($t_libro->Autor->getPlaceHolder()) ?>" value="<?php echo $t_libro->Autor->EditValue ?>"<?php echo $t_libro->Autor->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Autor" name="o<?php echo $t_libro_list->RowIndex ?>_Autor" id="o<?php echo $t_libro_list->RowIndex ?>_Autor" value="<?php echo HtmlEncode($t_libro->Autor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
		<td data-name="Editorial">
<span id="el$rowindex$_t_libro_Editorial" class="form-group t_libro_Editorial">
<input type="text" data-table="t_libro" data-field="x_Editorial" name="x<?php echo $t_libro_list->RowIndex ?>_Editorial" id="x<?php echo $t_libro_list->RowIndex ?>_Editorial" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_libro->Editorial->getPlaceHolder()) ?>" value="<?php echo $t_libro->Editorial->EditValue ?>"<?php echo $t_libro->Editorial->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Editorial" name="o<?php echo $t_libro_list->RowIndex ?>_Editorial" id="o<?php echo $t_libro_list->RowIndex ?>_Editorial" value="<?php echo HtmlEncode($t_libro->Editorial->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
		<td data-name="Fecha_publicacion">
<span id="el$rowindex$_t_libro_Fecha_publicacion" class="form-group t_libro_Fecha_publicacion">
<input type="text" data-table="t_libro" data-field="x_Fecha_publicacion" name="x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" id="x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" placeholder="<?php echo HtmlEncode($t_libro->Fecha_publicacion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Fecha_publicacion->EditValue ?>"<?php echo $t_libro->Fecha_publicacion->editAttributes() ?>>
<?php if (!$t_libro->Fecha_publicacion->ReadOnly && !$t_libro->Fecha_publicacion->Disabled && !isset($t_libro->Fecha_publicacion->EditAttrs["readonly"]) && !isset($t_libro->Fecha_publicacion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ft_librolist", "x<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Fecha_publicacion" name="o<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" id="o<?php echo $t_libro_list->RowIndex ?>_Fecha_publicacion" value="<?php echo HtmlEncode($t_libro->Fecha_publicacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
		<td data-name="Edicion">
<span id="el$rowindex$_t_libro_Edicion" class="form-group t_libro_Edicion">
<input type="text" data-table="t_libro" data-field="x_Edicion" name="x<?php echo $t_libro_list->RowIndex ?>_Edicion" id="x<?php echo $t_libro_list->RowIndex ?>_Edicion" size="30" placeholder="<?php echo HtmlEncode($t_libro->Edicion->getPlaceHolder()) ?>" value="<?php echo $t_libro->Edicion->EditValue ?>"<?php echo $t_libro->Edicion->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Edicion" name="o<?php echo $t_libro_list->RowIndex ?>_Edicion" id="o<?php echo $t_libro_list->RowIndex ?>_Edicion" value="<?php echo HtmlEncode($t_libro->Edicion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Area->Visible) { // Area ?>
		<td data-name="Area">
<span id="el$rowindex$_t_libro_Area" class="form-group t_libro_Area">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Area" data-value-separator="<?php echo $t_libro->Area->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_libro_list->RowIndex ?>_Area" name="x<?php echo $t_libro_list->RowIndex ?>_Area"<?php echo $t_libro->Area->editAttributes() ?>>
		<?php echo $t_libro->Area->selectOptionListHtml("x<?php echo $t_libro_list->RowIndex ?>_Area") ?>
	</select>
<?php echo $t_libro->Area->Lookup->getParamTag("p_x<?php echo $t_libro_list->RowIndex ?>_Area") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_libro_list->RowIndex ?>_Area" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Area->caption() ?>" data-title="<?php echo $t_libro->Area->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_libro_list->RowIndex ?>_Area',url:'t_areaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Area" name="o<?php echo $t_libro_list->RowIndex ?>_Area" id="o<?php echo $t_libro_list->RowIndex ?>_Area" value="<?php echo HtmlEncode($t_libro->Area->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
		<td data-name="Categoria">
<span id="el$rowindex$_t_libro_Categoria" class="form-group t_libro_Categoria">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_libro" data-field="x_Categoria" data-value-separator="<?php echo $t_libro->Categoria->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_libro_list->RowIndex ?>_Categoria" name="x<?php echo $t_libro_list->RowIndex ?>_Categoria"<?php echo $t_libro->Categoria->editAttributes() ?>>
		<?php echo $t_libro->Categoria->selectOptionListHtml("x<?php echo $t_libro_list->RowIndex ?>_Categoria") ?>
	</select>
<?php echo $t_libro->Categoria->Lookup->getParamTag("p_x<?php echo $t_libro_list->RowIndex ?>_Categoria") ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $t_libro_list->RowIndex ?>_Categoria" title="<?php echo HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t_libro->Categoria->caption() ?>" data-title="<?php echo $t_libro->Categoria->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $t_libro_list->RowIndex ?>_Categoria',url:'t_categoriaaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
</div>
</span>
<input type="hidden" data-table="t_libro" data-field="x_Categoria" name="o<?php echo $t_libro_list->RowIndex ?>_Categoria" id="o<?php echo $t_libro_list->RowIndex ?>_Categoria" value="<?php echo HtmlEncode($t_libro->Categoria->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
		<td data-name="N_copias">
<span id="el$rowindex$_t_libro_N_copias" class="form-group t_libro_N_copias">
<input type="text" data-table="t_libro" data-field="x_N_copias" name="x<?php echo $t_libro_list->RowIndex ?>_N_copias" id="x<?php echo $t_libro_list->RowIndex ?>_N_copias" size="30" placeholder="<?php echo HtmlEncode($t_libro->N_copias->getPlaceHolder()) ?>" value="<?php echo $t_libro->N_copias->EditValue ?>"<?php echo $t_libro->N_copias->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_libro" data-field="x_N_copias" name="o<?php echo $t_libro_list->RowIndex ?>_N_copias" id="o<?php echo $t_libro_list->RowIndex ?>_N_copias" value="<?php echo HtmlEncode($t_libro->N_copias->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_libro_list->ListOptions->render("body", "right", $t_libro_list->RowIndex);
?>
<script>
ft_librolist.updateLists(<?php echo $t_libro_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($t_libro->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $t_libro_list->FormKeyCountName ?>" id="<?php echo $t_libro_list->FormKeyCountName ?>" value="<?php echo $t_libro_list->KeyCount ?>">
<?php echo $t_libro_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$t_libro->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_libro_list->Recordset)
	$t_libro_list->Recordset->Close();
?>
<?php if (!$t_libro->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_libro->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($t_libro_list->Pager)) $t_libro_list->Pager = new PrevNextPager($t_libro_list->StartRec, $t_libro_list->DisplayRecs, $t_libro_list->TotalRecs, $t_libro_list->AutoHidePager) ?>
<?php if ($t_libro_list->Pager->RecordCount > 0 && $t_libro_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($t_libro_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_libro_list->pageUrl() ?>start=<?php echo $t_libro_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($t_libro_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_libro_list->pageUrl() ?>start=<?php echo $t_libro_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $t_libro_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($t_libro_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_libro_list->pageUrl() ?>start=<?php echo $t_libro_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($t_libro_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_libro_list->pageUrl() ?>start=<?php echo $t_libro_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_libro_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($t_libro_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t_libro_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t_libro_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t_libro_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_libro_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_libro_list->TotalRecs == 0 && !$t_libro->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($t_libro_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_libro_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$t_libro->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t_libro_list->terminate();
?>
