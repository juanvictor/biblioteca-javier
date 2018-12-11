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
$t_categoria_add = new t_categoria_add();

// Run the page
$t_categoria_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_categoria_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ft_categoriaadd = currentForm = new ew.Form("ft_categoriaadd", "add");

// Validate form
ft_categoriaadd.validate = function() {
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
		<?php if ($t_categoria_add->Categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_Categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_categoria->Categoria->caption(), $t_categoria->Categoria->RequiredErrorMessage)) ?>");
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
ft_categoriaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ft_categoriaadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $t_categoria_add->showPageHeader(); ?>
<?php
$t_categoria_add->showMessage();
?>
<form name="ft_categoriaadd" id="ft_categoriaadd" class="<?php echo $t_categoria_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($t_categoria_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $t_categoria_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_categoria">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$t_categoria_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($t_categoria->Categoria->Visible) { // Categoria ?>
	<div id="r_Categoria" class="form-group row">
		<label id="elh_t_categoria_Categoria" for="x_Categoria" class="<?php echo $t_categoria_add->LeftColumnClass ?>"><?php echo $t_categoria->Categoria->caption() ?><?php echo ($t_categoria->Categoria->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $t_categoria_add->RightColumnClass ?>"><div<?php echo $t_categoria->Categoria->cellAttributes() ?>>
<span id="el_t_categoria_Categoria">
<input type="text" data-table="t_categoria" data-field="x_Categoria" name="x_Categoria" id="x_Categoria" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_categoria->Categoria->getPlaceHolder()) ?>" value="<?php echo $t_categoria->Categoria->EditValue ?>"<?php echo $t_categoria->Categoria->editAttributes() ?>>
</span>
<?php echo $t_categoria->Categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t_categoria_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $t_categoria_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_categoria_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$t_categoria_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_categoria_add->terminate();
?>
