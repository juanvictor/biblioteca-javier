<?php
namespace PHPMaker2019\BIBLIOTECA;

/**
 * Table class for Report1
 */
class Report1 extends DbTableBase
{
	protected $SqlGroupSelect = "";
	protected $SqlGroupWhere = "";
	protected $SqlGroupGroupBy = "";
	protected $SqlGroupHaving = "";
	protected $SqlGroupOrderBy = "";
	protected $SqlDetailSelect = "";
	protected $SqlDetailWhere = "";
	protected $SqlDetailGroupBy = "";
	protected $SqlDetailHaving = "";
	protected $SqlDetailOrderBy = "";

	// Export
	public $ExportDoc;

	// Fields
	public $Id_libro;
	public $Codigo_Libro;
	public $Titulo;
	public $Autor;
	public $Editorial;
	public $Fecha_publicacion;
	public $Edicion;
	public $Area;
	public $Categoria;
	public $Palabras_Claves;
	public $N_copias;
	public $Codigo_Area;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Report1';
		$this->TableName = 'Report1';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`t_libro`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = 0; // User ID Allow

		// Id_libro
		$this->Id_libro = new DbField('Report1', 'Report1', 'x_Id_libro', 'Id_libro', '`Id_libro`', '`Id_libro`', 3, -1, FALSE, '`Id_libro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Id_libro->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Id_libro->IsPrimaryKey = TRUE; // Primary key field
		$this->Id_libro->Sortable = TRUE; // Allow sort
		$this->Id_libro->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->Id_libro->SourceTableVar = 't_libro';
		$this->fields['Id_libro'] = &$this->Id_libro;

		// Codigo_Libro
		$this->Codigo_Libro = new DbField('Report1', 'Report1', 'x_Codigo_Libro', 'Codigo_Libro', '`Codigo_Libro`', '`Codigo_Libro`', 200, -1, FALSE, '`Codigo_Libro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Codigo_Libro->Sortable = TRUE; // Allow sort
		$this->Codigo_Libro->SourceTableVar = 't_libro';
		$this->fields['Codigo_Libro'] = &$this->Codigo_Libro;

		// Titulo
		$this->Titulo = new DbField('Report1', 'Report1', 'x_Titulo', 'Titulo', '`Titulo`', '`Titulo`', 200, -1, FALSE, '`Titulo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Titulo->Nullable = FALSE; // NOT NULL field
		$this->Titulo->Sortable = TRUE; // Allow sort
		$this->Titulo->SourceTableVar = 't_libro';
		$this->fields['Titulo'] = &$this->Titulo;

		// Autor
		$this->Autor = new DbField('Report1', 'Report1', 'x_Autor', 'Autor', '`Autor`', '`Autor`', 200, -1, FALSE, '`Autor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Autor->Nullable = FALSE; // NOT NULL field
		$this->Autor->Sortable = TRUE; // Allow sort
		$this->Autor->SourceTableVar = 't_libro';
		$this->fields['Autor'] = &$this->Autor;

		// Editorial
		$this->Editorial = new DbField('Report1', 'Report1', 'x_Editorial', 'Editorial', '`Editorial`', '`Editorial`', 200, -1, FALSE, '`Editorial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Editorial->Sortable = TRUE; // Allow sort
		$this->Editorial->SourceTableVar = 't_libro';
		$this->fields['Editorial'] = &$this->Editorial;

		// Fecha_publicacion
		$this->Fecha_publicacion = new DbField('Report1', 'Report1', 'x_Fecha_publicacion', 'Fecha_publicacion', '`Fecha_publicacion`', CastDateFieldForLike('`Fecha_publicacion`', 0, "DB"), 133, 0, FALSE, '`Fecha_publicacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fecha_publicacion->Sortable = TRUE; // Allow sort
		$this->Fecha_publicacion->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->Fecha_publicacion->SourceTableVar = 't_libro';
		$this->fields['Fecha_publicacion'] = &$this->Fecha_publicacion;

		// Edicion
		$this->Edicion = new DbField('Report1', 'Report1', 'x_Edicion', 'Edicion', '`Edicion`', '`Edicion`', 3, -1, FALSE, '`Edicion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Edicion->Sortable = TRUE; // Allow sort
		$this->Edicion->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->Edicion->SourceTableVar = 't_libro';
		$this->fields['Edicion'] = &$this->Edicion;

		// Area
		$this->Area = new DbField('Report1', 'Report1', 'x_Area', 'Area', '`Area`', '`Area`', 200, -1, FALSE, '`Area`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Area->Nullable = FALSE; // NOT NULL field
		$this->Area->Sortable = TRUE; // Allow sort
		$this->Area->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Area->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->Area->Lookup = new Lookup('Area', 't_area', FALSE, 'Area', ["Area","","",""], [], [], [], ["Id_area"], ["x_Codigo_Area"], '', '');
		$this->Area->SourceTableVar = 't_libro';
		$this->fields['Area'] = &$this->Area;

		// Categoria
		$this->Categoria = new DbField('Report1', 'Report1', 'x_Categoria', 'Categoria', '`Categoria`', '`Categoria`', 200, -1, FALSE, '`Categoria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Categoria->Nullable = FALSE; // NOT NULL field
		$this->Categoria->Sortable = TRUE; // Allow sort
		$this->Categoria->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Categoria->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->Categoria->Lookup = new Lookup('Categoria', 't_categoria', FALSE, 'Categoria', ["Categoria","","",""], [], [], [], [], [], '', '');
		$this->Categoria->SourceTableVar = 't_libro';
		$this->fields['Categoria'] = &$this->Categoria;

		// Palabras_Claves
		$this->Palabras_Claves = new DbField('Report1', 'Report1', 'x_Palabras_Claves', 'Palabras_Claves', '`Palabras_Claves`', '`Palabras_Claves`', 201, -1, FALSE, '`Palabras_Claves`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Palabras_Claves->Nullable = FALSE; // NOT NULL field
		$this->Palabras_Claves->Sortable = TRUE; // Allow sort
		$this->Palabras_Claves->SourceTableVar = 't_libro';
		$this->fields['Palabras_Claves'] = &$this->Palabras_Claves;

		// N_copias
		$this->N_copias = new DbField('Report1', 'Report1', 'x_N_copias', 'N_copias', '`N_copias`', '`N_copias`', 3, -1, FALSE, '`N_copias`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->N_copias->Nullable = FALSE; // NOT NULL field
		$this->N_copias->Sortable = TRUE; // Allow sort
		$this->N_copias->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->N_copias->SourceTableVar = 't_libro';
		$this->fields['N_copias'] = &$this->N_copias;

		// Codigo_Area
		$this->Codigo_Area = new DbField('Report1', 'Report1', 'x_Codigo_Area', 'Codigo_Area', '`Codigo_Area`', '`Codigo_Area`', 3, -1, FALSE, '`Codigo_Area`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Codigo_Area->Nullable = FALSE; // NOT NULL field
		$this->Codigo_Area->Sortable = FALSE; // Allow sort
		$this->Codigo_Area->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->Codigo_Area->SourceTableVar = 't_libro';
		$this->fields['Codigo_Area'] = &$this->Codigo_Area;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Report detail level SQL
	public function getSqlDetailSelect() // Select
	{
		return ($this->SqlDetailSelect <> "") ? $this->SqlDetailSelect : "SELECT * FROM `t_libro`";
	}
	public function sqlDetailSelect() // For backward compatibility
	{
		return $this->getSqlDetailSelect();
	}
	public function setSqlDetailSelect($v)
	{
		$this->SqlDetailSelect = $v;
	}
	public function getSqlDetailWhere() // Where
	{
		return ($this->SqlDetailWhere <> "") ? $this->SqlDetailWhere : "";
	}
	public function sqlDetailWhere() // For backward compatibility
	{
		return $this->getSqlDetailWhere();
	}
	public function setSqlDetailWhere($v)
	{
		$this->SqlDetailWhere = $v;
	}
	public function getSqlDetailGroupBy() // Group By
	{
		return ($this->SqlDetailGroupBy <> "") ? $this->SqlDetailGroupBy : "";
	}
	public function sqlDetailGroupBy() // For backward compatibility
	{
		return $this->getSqlDetailGroupBy();
	}
	public function setSqlDetailGroupBy($v)
	{
		$this->SqlDetailGroupBy = $v;
	}
	public function getSqlDetailHaving() // Having
	{
		return ($this->SqlDetailHaving <> "") ? $this->SqlDetailHaving : "";
	}
	public function sqlDetailHaving() // For backward compatibility
	{
		return $this->getSqlDetailHaving();
	}
	public function setSqlDetailHaving($v)
	{
		$this->SqlDetailHaving = $v;
	}
	public function getSqlDetailOrderBy() // Order By
	{
		return ($this->SqlDetailOrderBy <> "") ? $this->SqlDetailOrderBy : "`Codigo_Libro` ASC,`Area` ASC,`Titulo` ASC";
	}
	public function sqlDetailOrderBy() // For backward compatibility
	{
		return $this->getSqlDetailOrderBy();
	}
	public function setSqlDetailOrderBy($v)
	{
		$this->SqlDetailOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Report detail SQL
	public function getDetailSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = "";
		return BuildSelectSql($this->getSqlDetailSelect(), $this->getSqlDetailWhere(),
			$this->getSqlDetailGroupBy(), $this->getSqlDetailHaving(),
			$this->getSqlDetailOrderBy(), $filter, $sort);
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "Report1report.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "")
			return $Language->Phrase("View");
		elseif ($pageName == "")
			return $Language->Phrase("Edit");
		elseif ($pageName == "")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Report1report.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Id_libro:" . JsonEncode($this->Id_libro->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->Id_libro->CurrentValue != NULL) {
			$url .= "Id_libro=" . urlencode($this->Id_libro->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("Id_libro") !== NULL)
				$arKeys[] = Param("Id_libro");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->Id_libro->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class Report1_report extends Report1
{

	// Page ID
	public $PageID = "report";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 'Report1';

	// Page object name
	public $PageObjName = "Report1_report";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;
	public $CheckTokenFn = PROJECT_NAMESPACE . "CheckToken";
	public $CreateTokenFn = PROJECT_NAMESPACE . "CreateToken";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		return $url;
	}

	// Message
	public function getMessage()
	{
		return @$_SESSION[SESSION_MESSAGE];
	}
	public function setMessage($v)
	{
		AddMessage($_SESSION[SESSION_MESSAGE], $v);
	}
	public function getFailureMessage()
	{
		return @$_SESSION[SESSION_FAILURE_MESSAGE];
	}
	public function setFailureMessage($v)
	{
		AddMessage($_SESSION[SESSION_FAILURE_MESSAGE], $v);
	}
	public function getSuccessMessage()
	{
		return @$_SESSION[SESSION_SUCCESS_MESSAGE];
	}
	public function setSuccessMessage($v)
	{
		AddMessage($_SESSION[SESSION_SUCCESS_MESSAGE], $v);
	}
	public function getWarningMessage()
	{
		return @$_SESSION[SESSION_WARNING_MESSAGE];
	}
	public function setWarningMessage($v)
	{
		AddMessage($_SESSION[SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	public function clearMessage()
	{
		$_SESSION[SESSION_MESSAGE] = "";
	}
	public function clearFailureMessage()
	{
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}
	public function clearSuccessMessage()
	{
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}
	public function clearWarningMessage()
	{
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}
	public function clearMessages()
	{
		$_SESSION[SESSION_MESSAGE] = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessageAsArray()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;

		//if ($this->CheckToken) { // Always create token, required by API file/lookup request
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$CurrentToken = $this->Token; // Save to global variable

		//}
	}

	//
	// Page class constructor
	//

	public function __construct()
	{
		global $Conn, $Language, $COMPOSITE_KEY_SEPARATOR;

		// Validate configuration
		if (!IS_PHP5)
			die("This script requires PHP 5.5 or later, but you are running " . phpversion() . ".");
		if (!function_exists("xml_parser_create"))
			die("This script requires PHP XML Parser.");
		if (!IS_WINDOWS && IS_MSACCESS)
			die("Microsoft Access is supported on Windows server only.");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (Report1)
		if (!isset($GLOBALS["Report1"]) || get_class($GLOBALS["Report1"]) == PROJECT_NAMESPACE . "Report1") {
			$GLOBALS["Report1"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Report1"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'report');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Report1');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($Conn))
			$Conn = GetConnection($this->Dbid);

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";
	}

	//
	// Terminate page
	//

	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT_REPORT;
		if ($this->isExport() && array_key_exists($this->Export, $EXPORT_REPORT)) {
			$content = ob_get_clean(); // ob_get_contents() and ob_end_clean()
			$fn = $EXPORT_REPORT[$this->Export];
			$this->$fn($content);
		}

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessageAsArray()));
			exit();
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}
	public $ExportOptions; // Export options
	public $RecCnt = 0;
	public $RowCnt = 0; // For custom view tag
	public $ReportSql = "";
	public $ReportFilter = "";
	public $DefaultFilter = "";
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $MasterRecordExists;
	public $Command;
	public $DtlRecordCount;
	public $ReportGroups;
	public $ReportCounts;
	public $LevelBreak;
	public $ReportTotals;
	public $ReportMaxs;
	public $ReportMins;
	public $DetailRecordset;
	public $RecordExists;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . "CheckToken";
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . "CheckToken";
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn()) $Security->autoLogin();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canReport()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined(PROJECT_NAMESPACE . "USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined(PROJECT_NAMESPACE . "USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Check token
		if (!$this->validPost()) {
			Write($Language->Phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();
		$this->ReportGroups = &InitArray(1, NULL);
		$this->ReportCounts = &InitArray(1, 0);
		$this->LevelBreak = &InitArray(1, FALSE);
		$this->ReportTotals = &Init2DArray(1, 8, 0);
		$this->ReportMaxs = &Init2DArray(1, 8, 0);
		$this->ReportMins = &Init2DArray(1, 8, 0);

		// Set up Breadcrumb
		$this->setupBreadcrumb();
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// Id_libro
		// Codigo_Libro
		// Titulo
		// Autor
		// Editorial
		// Fecha_publicacion
		// Edicion
		// Area
		// Categoria
		// Palabras_Claves
		// N_copias
		// Codigo_Area

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Id_libro
			$this->Id_libro->ViewValue = $this->Id_libro->CurrentValue;
			$this->Id_libro->ViewCustomAttributes = "";

			// Codigo_Libro
			$this->Codigo_Libro->ViewValue = $this->Codigo_Libro->CurrentValue;
			$this->Codigo_Libro->ViewCustomAttributes = "";

			// Titulo
			$this->Titulo->ViewValue = $this->Titulo->CurrentValue;
			$this->Titulo->ViewCustomAttributes = "";

			// Autor
			$this->Autor->ViewValue = $this->Autor->CurrentValue;
			$this->Autor->ViewCustomAttributes = "";

			// Editorial
			$this->Editorial->ViewValue = $this->Editorial->CurrentValue;
			$this->Editorial->ViewCustomAttributes = "";

			// Fecha_publicacion
			$this->Fecha_publicacion->ViewValue = $this->Fecha_publicacion->CurrentValue;
			$this->Fecha_publicacion->ViewValue = FormatDateTime($this->Fecha_publicacion->ViewValue, 0);
			$this->Fecha_publicacion->ViewCustomAttributes = "";

			// Edicion
			$this->Edicion->ViewValue = $this->Edicion->CurrentValue;
			$this->Edicion->ViewValue = FormatNumber($this->Edicion->ViewValue, 0, -2, -2, -2);
			$this->Edicion->ViewCustomAttributes = "";

			// Area
			$curVal = strval($this->Area->CurrentValue);
			if ($curVal <> "") {
				$this->Area->ViewValue = $this->Area->lookupCacheOption($curVal);
				if ($this->Area->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Area`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Area->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->Area->ViewValue = $this->Area->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Area->ViewValue = $this->Area->CurrentValue;
					}
				}
			} else {
				$this->Area->ViewValue = NULL;
			}
			$this->Area->ViewCustomAttributes = "";

			// Categoria
			$curVal = strval($this->Categoria->CurrentValue);
			if ($curVal <> "") {
				$this->Categoria->ViewValue = $this->Categoria->lookupCacheOption($curVal);
				if ($this->Categoria->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Categoria`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Categoria->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->Categoria->ViewValue = $this->Categoria->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Categoria->ViewValue = $this->Categoria->CurrentValue;
					}
				}
			} else {
				$this->Categoria->ViewValue = NULL;
			}
			$this->Categoria->ViewCustomAttributes = "";

			// N_copias
			$this->N_copias->ViewValue = $this->N_copias->CurrentValue;
			$this->N_copias->ViewValue = FormatNumber($this->N_copias->ViewValue, 0, -2, -2, -2);
			$this->N_copias->ViewCustomAttributes = "";

			// Codigo_Libro
			$this->Codigo_Libro->LinkCustomAttributes = "";
			$this->Codigo_Libro->HrefValue = "";
			$this->Codigo_Libro->TooltipValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";
			$this->Titulo->TooltipValue = "";

			// Autor
			$this->Autor->LinkCustomAttributes = "";
			$this->Autor->HrefValue = "";
			$this->Autor->TooltipValue = "";

			// Editorial
			$this->Editorial->LinkCustomAttributes = "";
			$this->Editorial->HrefValue = "";
			$this->Editorial->TooltipValue = "";

			// Edicion
			$this->Edicion->LinkCustomAttributes = "";
			$this->Edicion->HrefValue = "";
			$this->Edicion->TooltipValue = "";

			// Area
			$this->Area->LinkCustomAttributes = "";
			$this->Area->HrefValue = "";
			$this->Area->TooltipValue = "";

			// Categoria
			$this->Categoria->LinkCustomAttributes = "";
			$this->Categoria->HrefValue = "";
			$this->Categoria->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("report", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_Area":
							break;
						case "x_Categoria":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Export report to EXCEL
	public function exportReportExcel($html)
	{
		global $ExportFileName;
		AddHeader('Content-Type', 'application/vnd.ms-excel' . (PROJECT_CHARSET <> '' ? '; charset=' . PROJECT_CHARSET : ''));
		AddHeader('Content-Disposition', 'attachment; filename=' . $ExportFileName . '.xls');
		AddHeader('Set-Cookie', 'fileDownload=true; path=/');
		Write($html);
	}
}
?>
