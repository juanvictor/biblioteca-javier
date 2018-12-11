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
$t_categoria_addopt = new t_categoria_addopt();

// Run the page
$t_categoria_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_categoria_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var ft_categoriaaddopt = currentForm = new ew.Form("ft_categoriaaddopt", "addopt");

// Validate form
ft_categoriaaddopt.validate = function() {
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
		<?php if ($t_categoria_addopt->Categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_Categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_categoria->Categoria->caption(), $t_categoria->Categoria->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft_categoriaaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_categoriaaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_categoria_addopt->showPageHeader(); ?>
<?php
$t_categoria_addopt->showMessage();
?>
<form name="ft_categoriaaddopt" id="ft_categoriaaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($t_categoria_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_categoria_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $t_categoria_addopt->TableVar ?>">
<?php if ($t_categoria->Categoria->Visible) { // Categoria ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_Categoria"><?php echo $t_categoria->Categoria->caption() ?><?php echo ($t_categoria->Categoria->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="t_categoria" data-field="x_Categoria" name="x_Categoria" id="x_Categoria" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_categoria->Categoria->getPlaceHolder()) ?>" value="<?php echo $t_categoria->Categoria->EditValue ?>"<?php echo $t_categoria->Categoria->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$t_categoria_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$t_categoria_addopt->terminate();
?>
