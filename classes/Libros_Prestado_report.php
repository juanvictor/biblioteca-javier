<?php
namespace PHPMaker2019\BIBLIOTECA;

/**
 * Table class for Libros Prestado
 */
class Libros_Prestado extends DbTableBase
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
	public $CI_Lector;
	public $Nombres;
	public $Apellidos;
	public $Titulo;
	public $Fecha_Prestamo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Libros_Prestado';
		$this->TableName = 'Libros Prestado';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`prestado`";
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

		// CI_Lector
		$this->CI_Lector = new DbField('Libros_Prestado', 'Libros Prestado', 'x_CI_Lector', 'CI_Lector', '`CI_Lector`', '`CI_Lector`', 200, -1, FALSE, '`CI_Lector`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CI_Lector->Nullable = FALSE; // NOT NULL field
		$this->CI_Lector->Sortable = TRUE; // Allow sort
		$this->CI_Lector->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CI_Lector->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->CI_Lector->Lookup = new Lookup('CI_Lector', 't_lector', FALSE, 'CI_DNI', ["CI_DNI","","",""], [], [], [], ["Nombres","Apellidos"], ["x_Nombres","x_Apellidos"], '', '');
		$this->CI_Lector->SourceTableVar = 'prestado';
		$this->fields['CI_Lector'] = &$this->CI_Lector;

		// Nombres
		$this->Nombres = new DbField('Libros_Prestado', 'Libros Prestado', 'x_Nombres', 'Nombres', '`Nombres`', '`Nombres`', 200, -1, FALSE, '`Nombres`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nombres->Nullable = FALSE; // NOT NULL field
		$this->Nombres->Sortable = TRUE; // Allow sort
		$this->Nombres->SourceTableVar = 'prestado';
		$this->fields['Nombres'] = &$this->Nombres;

		// Apellidos
		$this->Apellidos = new DbField('Libros_Prestado', 'Libros Prestado', 'x_Apellidos', 'Apellidos', '`Apellidos`', '`Apellidos`', 200, -1, FALSE, '`Apellidos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Apellidos->Nullable = FALSE; // NOT NULL field
		$this->Apellidos->Sortable = TRUE; // Allow sort
		$this->Apellidos->SourceTableVar = 'prestado';
		$this->fields['Apellidos'] = &$this->Apellidos;

		// Titulo
		$this->Titulo = new DbField('Libros_Prestado', 'Libros Prestado', 'x_Titulo', 'Titulo', '`Titulo`', '`Titulo`', 200, -1, FALSE, '`Titulo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Titulo->Nullable = FALSE; // NOT NULL field
		$this->Titulo->Sortable = TRUE; // Allow sort
		$this->Titulo->SourceTableVar = 'prestado';
		$this->fields['Titulo'] = &$this->Titulo;

		// Fecha_Prestamo
		$this->Fecha_Prestamo = new DbField('Libros_Prestado', 'Libros Prestado', 'x_Fecha_Prestamo', 'Fecha_Prestamo', '`Fecha_Prestamo`', CastDateFieldForLike('`Fecha_Prestamo`', 0, "DB"), 133, 0, FALSE, '`Fecha_Prestamo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fecha_Prestamo->Sortable = TRUE; // Allow sort
		$this->Fecha_Prestamo->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->Fecha_Prestamo->SourceTableVar = 'prestado';
		$this->fields['Fecha_Prestamo'] = &$this->Fecha_Prestamo;
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
		return ($this->SqlDetailSelect <> "") ? $this->SqlDetailSelect : "SELECT * FROM `prestado`";
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
		return ($this->SqlDetailOrderBy <> "") ? $this->SqlDetailOrderBy : "";
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
			return "Libros_Prestadoreport.php";
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
		return "Libros_Prestadoreport.php";
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

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
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
class Libros_Prestado_report extends Libros_Prestado
{

	// Page ID
	public $PageID = "report";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 'Libros Prestado';

	// Page object name
	public $PageObjName = "Libros_Prestado_report";

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

		// Table object (Libros_Prestado)
		if (!isset($GLOBALS["Libros_Prestado"]) || get_class($GLOBALS["Libros_Prestado"]) == PROJECT_NAMESPACE . "Libros_Prestado") {
			$GLOBALS["Libros_Prestado"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Libros_Prestado"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Libros Prestado');

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
		$this->ReportTotals = &Init2DArray(1, 6, 0);
		$this->ReportMaxs = &Init2DArray(1, 6, 0);
		$this->ReportMins = &Init2DArray(1, 6, 0);

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
		// CI_Lector
		// Nombres
		// Apellidos
		// Titulo
		// Fecha_Prestamo

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// CI_Lector
			$curVal = strval($this->CI_Lector->CurrentValue);
			if ($curVal <> "") {
				$this->CI_Lector->ViewValue = $this->CI_Lector->lookupCacheOption($curVal);
				if ($this->CI_Lector->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CI_DNI`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->CI_Lector->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->CI_Lector->ViewValue = $this->CI_Lector->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CI_Lector->ViewValue = $this->CI_Lector->CurrentValue;
					}
				}
			} else {
				$this->CI_Lector->ViewValue = NULL;
			}
			$this->CI_Lector->ViewCustomAttributes = "";

			// Nombres
			$this->Nombres->ViewValue = $this->Nombres->CurrentValue;
			$this->Nombres->ViewCustomAttributes = "";

			// Apellidos
			$this->Apellidos->ViewValue = $this->Apellidos->CurrentValue;
			$this->Apellidos->ViewCustomAttributes = "";

			// Titulo
			$this->Titulo->ViewValue = $this->Titulo->CurrentValue;
			$this->Titulo->ViewCustomAttributes = "";

			// Fecha_Prestamo
			$this->Fecha_Prestamo->ViewValue = $this->Fecha_Prestamo->CurrentValue;
			$this->Fecha_Prestamo->ViewValue = FormatDateTime($this->Fecha_Prestamo->ViewValue, 0);
			$this->Fecha_Prestamo->ViewCustomAttributes = "";

			// CI_Lector
			$this->CI_Lector->LinkCustomAttributes = "";
			$this->CI_Lector->HrefValue = "";
			$this->CI_Lector->TooltipValue = "";

			// Nombres
			$this->Nombres->LinkCustomAttributes = "";
			$this->Nombres->HrefValue = "";
			$this->Nombres->TooltipValue = "";

			// Apellidos
			$this->Apellidos->LinkCustomAttributes = "";
			$this->Apellidos->HrefValue = "";
			$this->Apellidos->TooltipValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";
			$this->Titulo->TooltipValue = "";

			// Fecha_Prestamo
			$this->Fecha_Prestamo->LinkCustomAttributes = "";
			$this->Fecha_Prestamo->HrefValue = "";
			$this->Fecha_Prestamo->TooltipValue = "";
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
						case "x_CI_Lector":
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
