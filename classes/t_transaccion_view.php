<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class t_transaccion_view extends t_transaccion
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 't_transaccion';

	// Page object name
	public $PageObjName = "t_transaccion_view";

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
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
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
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
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
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") <> "")
				return ($this->TableVar == Get("t"));
		} else {
			return TRUE;
		}
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

		// Table object (t_transaccion)
		if (!isset($GLOBALS["t_transaccion"]) || get_class($GLOBALS["t_transaccion"]) == PROJECT_NAMESPACE . "t_transaccion") {
			$GLOBALS["t_transaccion"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_transaccion"];
		}
		$keyUrl = "";
		if (Get("Id_tran") !== NULL) {
			$this->RecKey["Id_tran"] = Get("Id_tran");
			$keyUrl .= "&amp;Id_tran=" . urlencode($this->RecKey["Id_tran"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_transaccion');

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

		// Other options
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
	}

	//
	// Terminate page
	//

	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $t_transaccion;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t_transaccion);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "t_transaccionview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson([$row]);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType(substr($val, 0, 11)), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => ContentType("", $val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => ContentType("", $val), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['Id_tran'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->Id_tran->Visible = FALSE;
	}
	public $ExportOptions; // Export options
	public $OtherOptions = array(); // Other options
	public $DisplayRecs = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $RecCnt;
	public $RecKey = array();
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SkipHeaderFooter, $EXPORT;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . "CheckToken";
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_transaccionlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header
		if (Get("Id_tran") !== NULL) {
			if ($ExportFileName <> "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("Id_tran");
		}

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
		$this->Id_tran->setVisibility();
		$this->CI_Lector->setVisibility();
		$this->Nombres->setVisibility();
		$this->Apellidos->setVisibility();
		$this->Cod_libro->setVisibility();
		$this->Titulo->setVisibility();
		$this->Fecha_Prestamo->setVisibility();
		$this->Fecha_Devolucion->setVisibility();
		$this->Estado->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->Phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->CI_Lector);
		$this->setupLookupOptions($this->Cod_libro);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("Id_tran") !== NULL) {
				$this->Id_tran->setQueryStringValue(Get("Id_tran"));
				$this->RecKey["Id_tran"] = $this->Id_tran->QueryStringValue;
			} elseif (IsApi() && Key(0) != NULL) {
				$this->Id_tran->setQueryStringValue(Key(0));
				$this->RecKey["Id_tran"] = $this->Id_tran->QueryStringValue;
			} elseif (Post("Id_tran") !== NULL) {
				$this->Id_tran->setFormValue(Post("Id_tran"));
				$this->RecKey["Id_tran"] = $this->Id_tran->FormValue;
			} elseif (IsApi() && Route(2) != NULL) {
				$this->Id_tran->setFormValue(Route(2));
				$this->RecKey["Id_tran"] = $this->Id_tran->FormValue;
			} else {
				$returnUrl = "t_transaccionlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = &$this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$returnUrl = "t_transaccionlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys($EXPORT))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "t_transaccionlist.php"; // Not page request, return to list
		}
		if ($returnUrl <> "")
			$this->terminate($returnUrl);

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->Phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->isLoggedIn());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->Phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->isLoggedIn());

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = &$this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->Id_tran->setDbValue($row['Id_tran']);
		$this->CI_Lector->setDbValue($row['CI_Lector']);
		$this->Nombres->setDbValue($row['Nombres']);
		$this->Apellidos->setDbValue($row['Apellidos']);
		$this->Cod_libro->setDbValue($row['Cod_libro']);
		$this->Titulo->setDbValue($row['Titulo']);
		$this->Fecha_Prestamo->setDbValue($row['Fecha_Prestamo']);
		$this->Fecha_Devolucion->setDbValue($row['Fecha_Devolucion']);
		$this->Estado->setDbValue($row['Estado']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['Id_tran'] = NULL;
		$row['CI_Lector'] = NULL;
		$row['Nombres'] = NULL;
		$row['Apellidos'] = NULL;
		$row['Cod_libro'] = NULL;
		$row['Titulo'] = NULL;
		$row['Fecha_Prestamo'] = NULL;
		$row['Fecha_Devolucion'] = NULL;
		$row['Estado'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// Id_tran
		// CI_Lector
		// Nombres
		// Apellidos
		// Cod_libro
		// Titulo
		// Fecha_Prestamo
		// Fecha_Devolucion
		// Estado

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Id_tran
			$this->Id_tran->ViewValue = $this->Id_tran->CurrentValue;
			$this->Id_tran->ViewCustomAttributes = "";

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

			// Cod_libro
			$curVal = strval($this->Cod_libro->CurrentValue);
			if ($curVal <> "") {
				$this->Cod_libro->ViewValue = $this->Cod_libro->lookupCacheOption($curVal);
				if ($this->Cod_libro->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Codigo_Libro`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Cod_libro->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->Cod_libro->ViewValue = $this->Cod_libro->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Cod_libro->ViewValue = $this->Cod_libro->CurrentValue;
					}
				}
			} else {
				$this->Cod_libro->ViewValue = NULL;
			}
			$this->Cod_libro->ViewCustomAttributes = "";

			// Titulo
			$this->Titulo->ViewValue = $this->Titulo->CurrentValue;
			$this->Titulo->ViewCustomAttributes = "";

			// Fecha_Prestamo
			$this->Fecha_Prestamo->ViewValue = $this->Fecha_Prestamo->CurrentValue;
			$this->Fecha_Prestamo->ViewValue = FormatDateTime($this->Fecha_Prestamo->ViewValue, 0);
			$this->Fecha_Prestamo->ViewCustomAttributes = "";

			// Fecha_Devolucion
			$this->Fecha_Devolucion->ViewValue = $this->Fecha_Devolucion->CurrentValue;
			$this->Fecha_Devolucion->ViewValue = FormatDateTime($this->Fecha_Devolucion->ViewValue, 0);
			$this->Fecha_Devolucion->ViewCustomAttributes = "";

			// Estado
			$this->Estado->ViewValue = $this->Estado->CurrentValue;
			$this->Estado->ViewCustomAttributes = "";

			// Id_tran
			$this->Id_tran->LinkCustomAttributes = "";
			$this->Id_tran->HrefValue = "";
			$this->Id_tran->TooltipValue = "";

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

			// Cod_libro
			$this->Cod_libro->LinkCustomAttributes = "";
			$this->Cod_libro->HrefValue = "";
			$this->Cod_libro->TooltipValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";
			$this->Titulo->TooltipValue = "";

			// Fecha_Prestamo
			$this->Fecha_Prestamo->LinkCustomAttributes = "";
			$this->Fecha_Prestamo->HrefValue = "";
			$this->Fecha_Prestamo->TooltipValue = "";

			// Fecha_Devolucion
			$this->Fecha_Devolucion->LinkCustomAttributes = "";
			$this->Fecha_Devolucion->HrefValue = "";
			$this->Fecha_Devolucion->TooltipValue = "";

			// Estado
			$this->Estado->LinkCustomAttributes = "";
			$this->Estado->HrefValue = "";
			$this->Estado->TooltipValue = "";
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

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_t_transaccion\" class=\"ew-export-link ew-email\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_t_transaccion',hdr:ew.language.phrase('ExportToEmailText'),f:document.ft_transaccionview,key:" . ArrayToJsonAttribute($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed 
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(PROJECT_CHARSET, "utf-8");
		$selectLimit = FALSE;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecs = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->setupStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs <= 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->Phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRec, $this->StopRec, "view");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!DEBUG_ENABLED && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (DEBUG_ENABLED && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_transaccionlist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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
						case "x_Cod_libro":
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

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
