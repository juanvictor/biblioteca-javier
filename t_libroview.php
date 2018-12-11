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
$t_libro_view = new t_libro_view();

// Run the page
$t_libro_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_libro_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$t_libro->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ft_libroview = currentForm = new ew.Form("ft_libroview", "view");

// Form_CustomValidate event
ft_libroview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_libroview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft_libroview.lists["x_Area"] = <?php echo $t_libro_view->Area->Lookup->toClientList() ?>;
ft_libroview.lists["x_Area"].options = <?php echo JsonEncode($t_libro_view->Area->lookupOptions()) ?>;
ft_libroview.lists["x_Categoria"] = <?php echo $t_libro_view->Categoria->Lookup->toClientList() ?>;
ft_libroview.lists["x_Categoria"].options = <?php echo JsonEncode($t_libro_view->Categoria->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$t_libro->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_libro_view->ExportOptions->render("body") ?>
<?php
	foreach ($t_libro_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_libro_view->showPageHeader(); ?>
<?php
$t_libro_view->showMessage();
?>
<form name="ft_libroview" id="ft_libroview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_libro_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_libro_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_libro">
<input type="hidden" name="modal" value="<?php echo (int)$t_libro_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($t_libro->Id_libro->Visible) { // Id_libro ?>
	<tr id="r_Id_libro">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Id_libro"><?php echo $t_libro->Id_libro->caption() ?></span></td>
		<td data-name="Id_libro"<?php echo $t_libro->Id_libro->cellAttributes() ?>>
<span id="el_t_libro_Id_libro">
<span<?php echo $t_libro->Id_libro->viewAttributes() ?>>
<?php echo $t_libro->Id_libro->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Codigo_Libro->Visible) { // Codigo_Libro ?>
	<tr id="r_Codigo_Libro">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Codigo_Libro"><?php echo $t_libro->Codigo_Libro->caption() ?></span></td>
		<td data-name="Codigo_Libro"<?php echo $t_libro->Codigo_Libro->cellAttributes() ?>>
<span id="el_t_libro_Codigo_Libro">
<span<?php echo $t_libro->Codigo_Libro->viewAttributes() ?>>
<?php echo $t_libro->Codigo_Libro->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Titulo->Visible) { // Titulo ?>
	<tr id="r_Titulo">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Titulo"><?php echo $t_libro->Titulo->caption() ?></span></td>
		<td data-name="Titulo"<?php echo $t_libro->Titulo->cellAttributes() ?>>
<span id="el_t_libro_Titulo">
<span<?php echo $t_libro->Titulo->viewAttributes() ?>>
<?php echo $t_libro->Titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Autor->Visible) { // Autor ?>
	<tr id="r_Autor">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Autor"><?php echo $t_libro->Autor->caption() ?></span></td>
		<td data-name="Autor"<?php echo $t_libro->Autor->cellAttributes() ?>>
<span id="el_t_libro_Autor">
<span<?php echo $t_libro->Autor->viewAttributes() ?>>
<?php echo $t_libro->Autor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Editorial->Visible) { // Editorial ?>
	<tr id="r_Editorial">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Editorial"><?php echo $t_libro->Editorial->caption() ?></span></td>
		<td data-name="Editorial"<?php echo $t_libro->Editorial->cellAttributes() ?>>
<span id="el_t_libro_Editorial">
<span<?php echo $t_libro->Editorial->viewAttributes() ?>>
<?php echo $t_libro->Editorial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Fecha_publicacion->Visible) { // Fecha_publicacion ?>
	<tr id="r_Fecha_publicacion">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Fecha_publicacion"><?php echo $t_libro->Fecha_publicacion->caption() ?></span></td>
		<td data-name="Fecha_publicacion"<?php echo $t_libro->Fecha_publicacion->cellAttributes() ?>>
<span id="el_t_libro_Fecha_publicacion">
<span<?php echo $t_libro->Fecha_publicacion->viewAttributes() ?>>
<?php echo $t_libro->Fecha_publicacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Edicion->Visible) { // Edicion ?>
	<tr id="r_Edicion">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Edicion"><?php echo $t_libro->Edicion->caption() ?></span></td>
		<td data-name="Edicion"<?php echo $t_libro->Edicion->cellAttributes() ?>>
<span id="el_t_libro_Edicion">
<span<?php echo $t_libro->Edicion->viewAttributes() ?>>
<?php echo $t_libro->Edicion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Area->Visible) { // Area ?>
	<tr id="r_Area">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Area"><?php echo $t_libro->Area->caption() ?></span></td>
		<td data-name="Area"<?php echo $t_libro->Area->cellAttributes() ?>>
<span id="el_t_libro_Area">
<span<?php echo $t_libro->Area->viewAttributes() ?>>
<?php echo $t_libro->Area->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Categoria->Visible) { // Categoria ?>
	<tr id="r_Categoria">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Categoria"><?php echo $t_libro->Categoria->caption() ?></span></td>
		<td data-name="Categoria"<?php echo $t_libro->Categoria->cellAttributes() ?>>
<span id="el_t_libro_Categoria">
<span<?php echo $t_libro->Categoria->viewAttributes() ?>>
<?php echo $t_libro->Categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->Palabras_Claves->Visible) { // Palabras_Claves ?>
	<tr id="r_Palabras_Claves">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_Palabras_Claves"><?php echo $t_libro->Palabras_Claves->caption() ?></span></td>
		<td data-name="Palabras_Claves"<?php echo $t_libro->Palabras_Claves->cellAttributes() ?>>
<span id="el_t_libro_Palabras_Claves">
<span<?php echo $t_libro->Palabras_Claves->viewAttributes() ?>>
<?php echo $t_libro->Palabras_Claves->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_libro->N_copias->Visible) { // N_copias ?>
	<tr id="r_N_copias">
		<td class="<?php echo $t_libro_view->TableLeftColumnClass ?>"><span id="elh_t_libro_N_copias"><?php echo $t_libro->N_copias->caption() ?></span></td>
		<td data-name="N_copias"<?php echo $t_libro->N_copias->cellAttributes() ?>>
<span id="el_t_libro_N_copias">
<span<?php echo $t_libro->N_copias->viewAttributes() ?>>
<?php echo $t_libro->N_copias->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_libro_view->IsModal) { ?>
<?php if (!$t_libro->isExport()) { ?>
<?php if (!isset($t_libro_view->Pager)) $t_libro_view->Pager = new PrevNextPager($t_libro_view->StartRec, $t_libro_view->DisplayRecs, $t_libro_view->TotalRecs, $t_libro_view->AutoHidePager) ?>
<?php if ($t_libro_view->Pager->RecordCount > 0 && $t_libro_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($t_libro_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_libro_view->pageUrl() ?>start=<?php echo $t_libro_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($t_libro_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_libro_view->pageUrl() ?>start=<?php echo $t_libro_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $t_libro_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($t_libro_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_libro_view->pageUrl() ?>start=<?php echo $t_libro_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($t_libro_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_libro_view->pageUrl() ?>start=<?php echo $t_libro_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_libro_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$t_libro_view->showPageFooter();
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
$t_libro_view->terminate();
?>
