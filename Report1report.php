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
$Report1_report = new Report1_report();

// Run the page
$Report1_report->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>
<?php if (!$Report1->isExport()) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php
$Report1_report->RecCnt = 1; // No grouping
if ($Report1_report->DbDetailFilter <> "") {
	if ($Report1_report->ReportFilter <> "") $Report1_report->ReportFilter .= " AND ";
	$Report1_report->ReportFilter .= "(" . $Report1_report->DbDetailFilter . ")";
}
$ReportConn = &$Report1_report->getConnection();

// Set up detail SQL
$Report1->CurrentFilter = $Report1_report->ReportFilter;
$Report1_report->ReportSql = $Report1->getDetailSql();

// Load recordset
$Report1_report->Recordset = $ReportConn->Execute($Report1_report->ReportSql);
$Report1_report->RecordExists = !$Report1_report->Recordset->EOF;
?>
<?php if (!$Report1->isExport()) { ?>
<?php if ($Report1_report->RecordExists) { ?>
<div class="ew-view-export-options"><?php $Report1_report->ExportOptions->render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $Report1_report->showPageHeader(); ?>
<table class="ew-report-table">
<?php

	// Get detail records
	$Report1_report->ReportFilter = $Report1_report->DefaultFilter;
	if ($Report1_report->DbDetailFilter <> "") {
		if ($Report1_report->ReportFilter <> "")
			$Report1_report->ReportFilter .= " AND ";
		$Report1_report->ReportFilter .= "(" . $Report1_report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$Report1->CurrentFilter = $Report1_report->ReportFilter;
	$Report1_report->ReportSql = $Report1->getDetailSql();

	// Load detail records
	$Report1_report->DetailRecordset = $ReportConn->execute($Report1_report->ReportSql);
	$Report1_report->DtlRecordCount = $Report1_report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$Report1_report->DetailRecordset->EOF) {
		$Report1_report->RecCnt++;
	}
	if ($Report1_report->RecCnt == 1) {
		$Report1_report->ReportCounts[0] = 0;
	}
	$Report1_report->ReportCounts[0] += $Report1_report->DtlRecordCount;
	if ($Report1_report->RecordExists) {
?>
	<tr>
		<td class="ew-group-header"><?php echo $Report1->Codigo_Libro->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->Titulo->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->Autor->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->Editorial->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->Edicion->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->Area->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->Categoria->caption() ?></td>
	</tr>
<?php
	}
	while (!$Report1_report->DetailRecordset->EOF) {
		$Report1_report->RowCnt++;
		$Report1->Codigo_Libro->setDbValue($Report1_report->DetailRecordset->fields('Codigo_Libro'));
		$Report1->Titulo->setDbValue($Report1_report->DetailRecordset->fields('Titulo'));
		$Report1->Autor->setDbValue($Report1_report->DetailRecordset->fields('Autor'));
		$Report1->Editorial->setDbValue($Report1_report->DetailRecordset->fields('Editorial'));
		$Report1->Edicion->setDbValue($Report1_report->DetailRecordset->fields('Edicion'));
		$Report1->Area->setDbValue($Report1_report->DetailRecordset->fields('Area'));
		$Report1->Categoria->setDbValue($Report1_report->DetailRecordset->fields('Categoria'));

		// Render for view
		$Report1->RowType = ROWTYPE_VIEW;
		$Report1->resetAttributes();
		$Report1_report->renderRow();
?>
	<tr>
		<td<?php echo $Report1->Codigo_Libro->cellAttributes() ?>>
<span<?php echo $Report1->Codigo_Libro->viewAttributes() ?>>
<?php echo $Report1->Codigo_Libro->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->Titulo->cellAttributes() ?>>
<span<?php echo $Report1->Titulo->viewAttributes() ?>>
<?php echo $Report1->Titulo->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->Autor->cellAttributes() ?>>
<span<?php echo $Report1->Autor->viewAttributes() ?>>
<?php echo $Report1->Autor->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->Editorial->cellAttributes() ?>>
<span<?php echo $Report1->Editorial->viewAttributes() ?>>
<?php echo $Report1->Editorial->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->Edicion->cellAttributes() ?>>
<span<?php echo $Report1->Edicion->viewAttributes() ?>>
<?php echo $Report1->Edicion->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->Area->cellAttributes() ?>>
<span<?php echo $Report1->Area->viewAttributes() ?>>
<?php echo $Report1->Area->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->Categoria->cellAttributes() ?>>
<span<?php echo $Report1->Categoria->viewAttributes() ?>>
<?php echo $Report1->Categoria->getViewValue() ?></span>
</td>
	</tr>
<?php
		$Report1_report->DetailRecordset->moveNext();
	}
	$Report1_report->DetailRecordset->close();
?>
<?php if ($Report1_report->RecordExists) { ?>
	<tr><td colspan="7">&nbsp;<br></td></tr>
	<tr><td colspan="7" class="ew-grand-summary"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo FormatNumber($Report1_report->ReportCounts[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
<?php if ($Report1_report->RecordExists) { ?>
	<tr><td colspan=7>&nbsp;<br></td></tr>
<?php } else { ?>
	<tr><td><?php echo $Language->Phrase("NoRecord") ?></td></tr>
<?php } ?>
</table>
<?php
$Report1_report->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Report1->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Report1_report->terminate();
?>
