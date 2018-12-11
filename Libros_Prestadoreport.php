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
$Libros_Prestado_report = new Libros_Prestado_report();

// Run the page
$Libros_Prestado_report->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>
<?php if (!$Libros_Prestado->isExport()) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php
$Libros_Prestado_report->RecCnt = 1; // No grouping
if ($Libros_Prestado_report->DbDetailFilter <> "") {
	if ($Libros_Prestado_report->ReportFilter <> "") $Libros_Prestado_report->ReportFilter .= " AND ";
	$Libros_Prestado_report->ReportFilter .= "(" . $Libros_Prestado_report->DbDetailFilter . ")";
}
$ReportConn = &$Libros_Prestado_report->getConnection();

// Set up detail SQL
$Libros_Prestado->CurrentFilter = $Libros_Prestado_report->ReportFilter;
$Libros_Prestado_report->ReportSql = $Libros_Prestado->getDetailSql();

// Load recordset
$Libros_Prestado_report->Recordset = $ReportConn->Execute($Libros_Prestado_report->ReportSql);
$Libros_Prestado_report->RecordExists = !$Libros_Prestado_report->Recordset->EOF;
?>
<?php if (!$Libros_Prestado->isExport()) { ?>
<?php if ($Libros_Prestado_report->RecordExists) { ?>
<div class="ew-view-export-options"><?php $Libros_Prestado_report->ExportOptions->render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $Libros_Prestado_report->showPageHeader(); ?>
<table class="ew-report-table">
<?php

	// Get detail records
	$Libros_Prestado_report->ReportFilter = $Libros_Prestado_report->DefaultFilter;
	if ($Libros_Prestado_report->DbDetailFilter <> "") {
		if ($Libros_Prestado_report->ReportFilter <> "")
			$Libros_Prestado_report->ReportFilter .= " AND ";
		$Libros_Prestado_report->ReportFilter .= "(" . $Libros_Prestado_report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$Libros_Prestado->CurrentFilter = $Libros_Prestado_report->ReportFilter;
	$Libros_Prestado_report->ReportSql = $Libros_Prestado->getDetailSql();

	// Load detail records
	$Libros_Prestado_report->DetailRecordset = $ReportConn->execute($Libros_Prestado_report->ReportSql);
	$Libros_Prestado_report->DtlRecordCount = $Libros_Prestado_report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$Libros_Prestado_report->DetailRecordset->EOF) {
		$Libros_Prestado_report->RecCnt++;
	}
	if ($Libros_Prestado_report->RecCnt == 1) {
		$Libros_Prestado_report->ReportCounts[0] = 0;
	}
	$Libros_Prestado_report->ReportCounts[0] += $Libros_Prestado_report->DtlRecordCount;
	if ($Libros_Prestado_report->RecordExists) {
?>
	<tr>
		<td class="ew-group-header"><?php echo $Libros_Prestado->CI_Lector->caption() ?></td>
		<td class="ew-group-header"><?php echo $Libros_Prestado->Nombres->caption() ?></td>
		<td class="ew-group-header"><?php echo $Libros_Prestado->Apellidos->caption() ?></td>
		<td class="ew-group-header"><?php echo $Libros_Prestado->Titulo->caption() ?></td>
		<td class="ew-group-header"><?php echo $Libros_Prestado->Fecha_Prestamo->caption() ?></td>
	</tr>
<?php
	}
	while (!$Libros_Prestado_report->DetailRecordset->EOF) {
		$Libros_Prestado_report->RowCnt++;
		$Libros_Prestado->CI_Lector->setDbValue($Libros_Prestado_report->DetailRecordset->fields('CI_Lector'));
		$Libros_Prestado->Nombres->setDbValue($Libros_Prestado_report->DetailRecordset->fields('Nombres'));
		$Libros_Prestado->Apellidos->setDbValue($Libros_Prestado_report->DetailRecordset->fields('Apellidos'));
		$Libros_Prestado->Titulo->setDbValue($Libros_Prestado_report->DetailRecordset->fields('Titulo'));
		$Libros_Prestado->Fecha_Prestamo->setDbValue($Libros_Prestado_report->DetailRecordset->fields('Fecha_Prestamo'));

		// Render for view
		$Libros_Prestado->RowType = ROWTYPE_VIEW;
		$Libros_Prestado->resetAttributes();
		$Libros_Prestado_report->renderRow();
?>
	<tr>
		<td<?php echo $Libros_Prestado->CI_Lector->cellAttributes() ?>>
<span<?php echo $Libros_Prestado->CI_Lector->viewAttributes() ?>>
<?php echo $Libros_Prestado->CI_Lector->getViewValue() ?></span>
</td>
		<td<?php echo $Libros_Prestado->Nombres->cellAttributes() ?>>
<span<?php echo $Libros_Prestado->Nombres->viewAttributes() ?>>
<?php echo $Libros_Prestado->Nombres->getViewValue() ?></span>
</td>
		<td<?php echo $Libros_Prestado->Apellidos->cellAttributes() ?>>
<span<?php echo $Libros_Prestado->Apellidos->viewAttributes() ?>>
<?php echo $Libros_Prestado->Apellidos->getViewValue() ?></span>
</td>
		<td<?php echo $Libros_Prestado->Titulo->cellAttributes() ?>>
<span<?php echo $Libros_Prestado->Titulo->viewAttributes() ?>>
<?php echo $Libros_Prestado->Titulo->getViewValue() ?></span>
</td>
		<td<?php echo $Libros_Prestado->Fecha_Prestamo->cellAttributes() ?>>
<span<?php echo $Libros_Prestado->Fecha_Prestamo->viewAttributes() ?>>
<?php echo $Libros_Prestado->Fecha_Prestamo->getViewValue() ?></span>
</td>
	</tr>
<?php
		$Libros_Prestado_report->DetailRecordset->moveNext();
	}
	$Libros_Prestado_report->DetailRecordset->close();
?>
<?php if ($Libros_Prestado_report->RecordExists) { ?>
	<tr><td colspan="5">&nbsp;<br></td></tr>
	<tr><td colspan="5" class="ew-grand-summary"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo FormatNumber($Libros_Prestado_report->ReportCounts[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
<?php if ($Libros_Prestado_report->RecordExists) { ?>
	<tr><td colspan=5>&nbsp;<br></td></tr>
<?php } else { ?>
	<tr><td><?php echo $Language->Phrase("NoRecord") ?></td></tr>
<?php } ?>
</table>
<?php
$Libros_Prestado_report->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Libros_Prestado->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Libros_Prestado_report->terminate();
?>
