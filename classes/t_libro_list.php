<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class t_libro_list extends t_libro
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 't_libro';

	// Page object name
	public $PageObjName = "t_libro_list";

	// Grid form hidden field names
	public $FormName = "ft_librolist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

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

		// Table object (t_libro)
		if (!isset($GLOBALS["t_libro"]) || get_class($GLOBALS["t_libro"]) == PROJECT_NAMESPACE . "t_libro") {
			$GLOBALS["t_libro"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_libro"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "t_libroadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "t_librodelete.php";
		$this->MultiUpdateUrl = "t_libroupdate.php";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_libro');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($Conn))
			$Conn = GetConnection($this->Dbid);

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions();
		$this->ImportOptions->Tag = "div";
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option ft_librolistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
		global $EXPORT, $t_libro;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t_libro);
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
			$key .= @$ar['Id_libro'];
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
			$this->Id_libro->Visible = FALSE;
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions = array(); // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecs = 20;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $AutoHidePageSizeSelector = AUTO_HIDE_PAGE_SIZE_SELECTOR;
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $RecCnt = 0; // Record count
	public $EditRowCnt;
	public $StartRowCnt = 1;
	public $RowCnt = 0;
	public $Attrs = array(); // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SearchError, $EXPORT;

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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();

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

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->Id_libro->setVisibility();
		$this->Codigo_Libro->setVisibility();
		$this->Titulo->setVisibility();
		$this->Autor->setVisibility();
		$this->Editorial->setVisibility();
		$this->Fecha_publicacion->setVisibility();
		$this->Edicion->setVisibility();
		$this->Area->setVisibility();
		$this->Codigo_Area->Visible = FALSE;
		$this->Categoria->setVisibility();
		$this->Palabras_Claves->Visible = FALSE;
		$this->N_copias->setVisibility();
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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->Area);
		$this->setupLookupOptions($this->Categoria);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid edit mode
				if ($this->isGridEdit())
					$this->gridEditMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Update
					if (($this->isGridUpdate() || $this->isGridOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "gridedit") {
						if ($this->validateGridForm()) {
							$gridUpdate = $this->gridUpdate();
						} else {
							$gridUpdate = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridUpdate) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridEditMode(); // Stay in Grid edit mode
						}
					}
				} elseif (@$_SESSION[SESSION_INLINE_MODE] == "gridedit") { // Previously in grid edit mode
					if (Get(TABLE_START_REC) !== NULL || Get(TABLE_PAGE_NO) !== NULL) // Stay in grid edit mode if paging
						$this->gridEditMode();
					else // Reset grid edit
						$this->clearInlineMode();
				}
			}

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport()) {
				foreach ($this->OtherOptions as &$option)
					$option->hideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions->getItem("griddelete");
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys($EXPORT))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRec = 1;
			$this->DisplayRecs = $this->GridAddRowCount;
			$this->TotalRecs = $this->DisplayRecs;
			$this->StopRec = $this->DisplayRecs;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecs = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
			$this->StartRec = 1;
			if ($this->DisplayRecs <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecs = $this->TotalRecs;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRec();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecs == 0) {
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->Phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecs]);
			$this->terminate(TRUE);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key <> "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey <> "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter <> "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode($GLOBALS["COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arKeyFlds) >= 1) {
			$this->Id_libro->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->Id_libro->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_Codigo_Libro") && $CurrentForm->hasValue("o_Codigo_Libro") && $this->Codigo_Libro->CurrentValue <> $this->Codigo_Libro->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Titulo") && $CurrentForm->hasValue("o_Titulo") && $this->Titulo->CurrentValue <> $this->Titulo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Autor") && $CurrentForm->hasValue("o_Autor") && $this->Autor->CurrentValue <> $this->Autor->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Editorial") && $CurrentForm->hasValue("o_Editorial") && $this->Editorial->CurrentValue <> $this->Editorial->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Fecha_publicacion") && $CurrentForm->hasValue("o_Fecha_publicacion") && $this->Fecha_publicacion->CurrentValue <> $this->Fecha_publicacion->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Edicion") && $CurrentForm->hasValue("o_Edicion") && $this->Edicion->CurrentValue <> $this->Edicion->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Area") && $CurrentForm->hasValue("o_Area") && $this->Area->CurrentValue <> $this->Area->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Categoria") && $CurrentForm->hasValue("o_Categoria") && $this->Categoria->CurrentValue <> $this->Categoria->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_N_copias") && $CurrentForm->hasValue("o_N_copias") && $this->N_copias->CurrentValue <> $this->N_copias->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->Id_libro->AdvancedSearch->toJson(), ","); // Field Id_libro
		$filterList = Concat($filterList, $this->Codigo_Libro->AdvancedSearch->toJson(), ","); // Field Codigo_Libro
		$filterList = Concat($filterList, $this->Titulo->AdvancedSearch->toJson(), ","); // Field Titulo
		$filterList = Concat($filterList, $this->Autor->AdvancedSearch->toJson(), ","); // Field Autor
		$filterList = Concat($filterList, $this->Editorial->AdvancedSearch->toJson(), ","); // Field Editorial
		$filterList = Concat($filterList, $this->Fecha_publicacion->AdvancedSearch->toJson(), ","); // Field Fecha_publicacion
		$filterList = Concat($filterList, $this->Edicion->AdvancedSearch->toJson(), ","); // Field Edicion
		$filterList = Concat($filterList, $this->Area->AdvancedSearch->toJson(), ","); // Field Area
		$filterList = Concat($filterList, $this->Categoria->AdvancedSearch->toJson(), ","); // Field Categoria
		$filterList = Concat($filterList, $this->Palabras_Claves->AdvancedSearch->toJson(), ","); // Field Palabras_Claves
		$filterList = Concat($filterList, $this->N_copias->AdvancedSearch->toJson(), ","); // Field N_copias
		if ($this->BasicSearch->Keyword <> "") {
			$wrk = "\"" . TABLE_BASIC_SEARCH . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . TABLE_BASIC_SEARCH_TYPE . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList <> "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList <> "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList <> "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "ft_librolistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field Id_libro
		$this->Id_libro->AdvancedSearch->SearchValue = @$filter["x_Id_libro"];
		$this->Id_libro->AdvancedSearch->SearchOperator = @$filter["z_Id_libro"];
		$this->Id_libro->AdvancedSearch->SearchCondition = @$filter["v_Id_libro"];
		$this->Id_libro->AdvancedSearch->SearchValue2 = @$filter["y_Id_libro"];
		$this->Id_libro->AdvancedSearch->SearchOperator2 = @$filter["w_Id_libro"];
		$this->Id_libro->AdvancedSearch->save();

		// Field Codigo_Libro
		$this->Codigo_Libro->AdvancedSearch->SearchValue = @$filter["x_Codigo_Libro"];
		$this->Codigo_Libro->AdvancedSearch->SearchOperator = @$filter["z_Codigo_Libro"];
		$this->Codigo_Libro->AdvancedSearch->SearchCondition = @$filter["v_Codigo_Libro"];
		$this->Codigo_Libro->AdvancedSearch->SearchValue2 = @$filter["y_Codigo_Libro"];
		$this->Codigo_Libro->AdvancedSearch->SearchOperator2 = @$filter["w_Codigo_Libro"];
		$this->Codigo_Libro->AdvancedSearch->save();

		// Field Titulo
		$this->Titulo->AdvancedSearch->SearchValue = @$filter["x_Titulo"];
		$this->Titulo->AdvancedSearch->SearchOperator = @$filter["z_Titulo"];
		$this->Titulo->AdvancedSearch->SearchCondition = @$filter["v_Titulo"];
		$this->Titulo->AdvancedSearch->SearchValue2 = @$filter["y_Titulo"];
		$this->Titulo->AdvancedSearch->SearchOperator2 = @$filter["w_Titulo"];
		$this->Titulo->AdvancedSearch->save();

		// Field Autor
		$this->Autor->AdvancedSearch->SearchValue = @$filter["x_Autor"];
		$this->Autor->AdvancedSearch->SearchOperator = @$filter["z_Autor"];
		$this->Autor->AdvancedSearch->SearchCondition = @$filter["v_Autor"];
		$this->Autor->AdvancedSearch->SearchValue2 = @$filter["y_Autor"];
		$this->Autor->AdvancedSearch->SearchOperator2 = @$filter["w_Autor"];
		$this->Autor->AdvancedSearch->save();

		// Field Editorial
		$this->Editorial->AdvancedSearch->SearchValue = @$filter["x_Editorial"];
		$this->Editorial->AdvancedSearch->SearchOperator = @$filter["z_Editorial"];
		$this->Editorial->AdvancedSearch->SearchCondition = @$filter["v_Editorial"];
		$this->Editorial->AdvancedSearch->SearchValue2 = @$filter["y_Editorial"];
		$this->Editorial->AdvancedSearch->SearchOperator2 = @$filter["w_Editorial"];
		$this->Editorial->AdvancedSearch->save();

		// Field Fecha_publicacion
		$this->Fecha_publicacion->AdvancedSearch->SearchValue = @$filter["x_Fecha_publicacion"];
		$this->Fecha_publicacion->AdvancedSearch->SearchOperator = @$filter["z_Fecha_publicacion"];
		$this->Fecha_publicacion->AdvancedSearch->SearchCondition = @$filter["v_Fecha_publicacion"];
		$this->Fecha_publicacion->AdvancedSearch->SearchValue2 = @$filter["y_Fecha_publicacion"];
		$this->Fecha_publicacion->AdvancedSearch->SearchOperator2 = @$filter["w_Fecha_publicacion"];
		$this->Fecha_publicacion->AdvancedSearch->save();

		// Field Edicion
		$this->Edicion->AdvancedSearch->SearchValue = @$filter["x_Edicion"];
		$this->Edicion->AdvancedSearch->SearchOperator = @$filter["z_Edicion"];
		$this->Edicion->AdvancedSearch->SearchCondition = @$filter["v_Edicion"];
		$this->Edicion->AdvancedSearch->SearchValue2 = @$filter["y_Edicion"];
		$this->Edicion->AdvancedSearch->SearchOperator2 = @$filter["w_Edicion"];
		$this->Edicion->AdvancedSearch->save();

		// Field Area
		$this->Area->AdvancedSearch->SearchValue = @$filter["x_Area"];
		$this->Area->AdvancedSearch->SearchOperator = @$filter["z_Area"];
		$this->Area->AdvancedSearch->SearchCondition = @$filter["v_Area"];
		$this->Area->AdvancedSearch->SearchValue2 = @$filter["y_Area"];
		$this->Area->AdvancedSearch->SearchOperator2 = @$filter["w_Area"];
		$this->Area->AdvancedSearch->save();

		// Field Categoria
		$this->Categoria->AdvancedSearch->SearchValue = @$filter["x_Categoria"];
		$this->Categoria->AdvancedSearch->SearchOperator = @$filter["z_Categoria"];
		$this->Categoria->AdvancedSearch->SearchCondition = @$filter["v_Categoria"];
		$this->Categoria->AdvancedSearch->SearchValue2 = @$filter["y_Categoria"];
		$this->Categoria->AdvancedSearch->SearchOperator2 = @$filter["w_Categoria"];
		$this->Categoria->AdvancedSearch->save();

		// Field Palabras_Claves
		$this->Palabras_Claves->AdvancedSearch->SearchValue = @$filter["x_Palabras_Claves"];
		$this->Palabras_Claves->AdvancedSearch->SearchOperator = @$filter["z_Palabras_Claves"];
		$this->Palabras_Claves->AdvancedSearch->SearchCondition = @$filter["v_Palabras_Claves"];
		$this->Palabras_Claves->AdvancedSearch->SearchValue2 = @$filter["y_Palabras_Claves"];
		$this->Palabras_Claves->AdvancedSearch->SearchOperator2 = @$filter["w_Palabras_Claves"];
		$this->Palabras_Claves->AdvancedSearch->save();

		// Field N_copias
		$this->N_copias->AdvancedSearch->SearchValue = @$filter["x_N_copias"];
		$this->N_copias->AdvancedSearch->SearchOperator = @$filter["z_N_copias"];
		$this->N_copias->AdvancedSearch->SearchCondition = @$filter["v_N_copias"];
		$this->N_copias->AdvancedSearch->SearchValue2 = @$filter["y_N_copias"];
		$this->N_copias->AdvancedSearch->SearchOperator2 = @$filter["w_N_copias"];
		$this->N_copias->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		$this->buildSearchSql($where, $this->Id_libro, $default, FALSE); // Id_libro
		$this->buildSearchSql($where, $this->Codigo_Libro, $default, FALSE); // Codigo_Libro
		$this->buildSearchSql($where, $this->Titulo, $default, FALSE); // Titulo
		$this->buildSearchSql($where, $this->Autor, $default, FALSE); // Autor
		$this->buildSearchSql($where, $this->Editorial, $default, FALSE); // Editorial
		$this->buildSearchSql($where, $this->Fecha_publicacion, $default, FALSE); // Fecha_publicacion
		$this->buildSearchSql($where, $this->Edicion, $default, FALSE); // Edicion
		$this->buildSearchSql($where, $this->Area, $default, FALSE); // Area
		$this->buildSearchSql($where, $this->Categoria, $default, FALSE); // Categoria
		$this->buildSearchSql($where, $this->Palabras_Claves, $default, FALSE); // Palabras_Claves
		$this->buildSearchSql($where, $this->N_copias, $default, FALSE); // N_copias

		// Set up search parm
		if (!$default && $where <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->Id_libro->AdvancedSearch->save(); // Id_libro
			$this->Codigo_Libro->AdvancedSearch->save(); // Codigo_Libro
			$this->Titulo->AdvancedSearch->save(); // Titulo
			$this->Autor->AdvancedSearch->save(); // Autor
			$this->Editorial->AdvancedSearch->save(); // Editorial
			$this->Fecha_publicacion->AdvancedSearch->save(); // Fecha_publicacion
			$this->Edicion->AdvancedSearch->save(); // Edicion
			$this->Area->AdvancedSearch->save(); // Area
			$this->Categoria->AdvancedSearch->save(); // Categoria
			$this->Palabras_Claves->AdvancedSearch->save(); // Palabras_Claves
			$this->N_copias->AdvancedSearch->save(); // N_copias
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (SEARCH_MULTI_VALUE_OPTION == 1)
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal <> "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 <> "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 <> "")
				$wrk = ($wrk <> "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == NULL_VALUE || $fldVal == NOT_NULL_VALUE)
			return $fldVal;
		$value = $fldVal;
		if ($fld->DataType == DATATYPE_BOOLEAN) {
			if ($fldVal <> "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal <> "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->Codigo_Libro, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Titulo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Autor, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Editorial, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Area, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Categoria, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Palabras_Claves, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		global $BASIC_SEARCH_IGNORE_PATTERN;
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if ($BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$keyword = preg_replace($BASIC_SEARCH_IGNORE_PATTERN, "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = array($keyword);
			}
			foreach ($ar as $keyword) {
				if ($keyword <> "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == NULL_VALUE) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == NOT_NULL_VALUE) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk <> "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] <> "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql <> "") {
			if ($where <> "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword <> "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword <> "") {
						if ($searchStr <> "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql(array($keyword), $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, array("", "reset", "resetall")))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->Id_libro->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Codigo_Libro->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Titulo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Autor->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Editorial->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Fecha_publicacion->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Edicion->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Area->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Categoria->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Palabras_Claves->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->N_copias->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->Id_libro->AdvancedSearch->unsetSession();
		$this->Codigo_Libro->AdvancedSearch->unsetSession();
		$this->Titulo->AdvancedSearch->unsetSession();
		$this->Autor->AdvancedSearch->unsetSession();
		$this->Editorial->AdvancedSearch->unsetSession();
		$this->Fecha_publicacion->AdvancedSearch->unsetSession();
		$this->Edicion->AdvancedSearch->unsetSession();
		$this->Area->AdvancedSearch->unsetSession();
		$this->Categoria->AdvancedSearch->unsetSession();
		$this->Palabras_Claves->AdvancedSearch->unsetSession();
		$this->N_copias->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->Id_libro->AdvancedSearch->load();
		$this->Codigo_Libro->AdvancedSearch->load();
		$this->Titulo->AdvancedSearch->load();
		$this->Autor->AdvancedSearch->load();
		$this->Editorial->AdvancedSearch->load();
		$this->Fecha_publicacion->AdvancedSearch->load();
		$this->Edicion->AdvancedSearch->load();
		$this->Area->AdvancedSearch->load();
		$this->Categoria->AdvancedSearch->load();
		$this->Palabras_Claves->AdvancedSearch->load();
		$this->N_copias->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->Id_libro); // Id_libro
			$this->updateSort($this->Codigo_Libro); // Codigo_Libro
			$this->updateSort($this->Titulo); // Titulo
			$this->updateSort($this->Autor); // Autor
			$this->updateSort($this->Editorial); // Editorial
			$this->updateSort($this->Fecha_publicacion); // Fecha_publicacion
			$this->updateSort($this->Edicion); // Edicion
			$this->updateSort($this->Area); // Area
			$this->updateSort($this->Categoria); // Categoria
			$this->updateSort($this->N_copias); // N_copias
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->Id_libro->setSort("");
				$this->Codigo_Libro->setSort("");
				$this->Titulo->setSort("");
				$this->Autor->setSort("");
				$this->Editorial->setSort("");
				$this->Fecha_publicacion->setSort("");
				$this->Edicion->setSort("");
				$this->Area->setSort("");
				$this->Categoria->setSort("");
				$this->N_copias->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->isLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->isLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->isLoggedIn();
		$item->OnLeft = FALSE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew.selectAllKey(this);\">";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = ""; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = &$this->ListOptions->getItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = &$options->Items["griddelete"];
				$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}

		// "view"
		$opt = &$this->ListOptions->Items["view"];
		$viewcaption = HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->isLoggedIn()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		$editcaption = HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->isLoggedIn()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = &$this->ListOptions->Items["delete"];
		if ($Security->isLoggedIn())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

		// Set up list action buttons
		$opt = &$this->ListOptions->getItem("listactions");
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = &$this->ListOptions->Items["checkbox"];
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->Id_libro->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->Id_libro->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->isLoggedIn());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->isLoggedIn());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ft_librolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ft_librolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.ft_librolist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->getItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->hideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->hideAllOptions();
			if ($this->isGridEdit()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->isLoggedIn();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
					$item = &$option->add("gridsave");
					$item->Body = "<a class=\"ew-action ew-grid-save\" title=\"" . HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->add("gridcancel");
					$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter <> "" && $userAction <> "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions->Items[$userAction]->Caption;
				if (!$this->ListActions->Items[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft_librolistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"t_librosrch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<button type=\"button\" class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-table=\"t_libro\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" onclick=\"ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'t_librosrch.php'});\">" . $Language->Phrase("AdvancedSearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-highlight active\" title=\"" . $Language->Phrase("Highlight") . "\" data-caption=\"" . $Language->Phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ft_librolistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->Phrase("HighlightBtn") . "</button>";
		$item->Visible = ($this->SearchWhere <> "" && $this->TotalRecs > 0);

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
	}
	protected function setupListOptionsExt()
	{
		global $Security, $Language;
	}
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
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

	// Load default values
	protected function loadDefaultValues()
	{
		$this->Id_libro->CurrentValue = NULL;
		$this->Id_libro->OldValue = $this->Id_libro->CurrentValue;
		$this->Codigo_Libro->CurrentValue = NULL;
		$this->Codigo_Libro->OldValue = $this->Codigo_Libro->CurrentValue;
		$this->Titulo->CurrentValue = NULL;
		$this->Titulo->OldValue = $this->Titulo->CurrentValue;
		$this->Autor->CurrentValue = NULL;
		$this->Autor->OldValue = $this->Autor->CurrentValue;
		$this->Editorial->CurrentValue = NULL;
		$this->Editorial->OldValue = $this->Editorial->CurrentValue;
		$this->Fecha_publicacion->CurrentValue = NULL;
		$this->Fecha_publicacion->OldValue = $this->Fecha_publicacion->CurrentValue;
		$this->Edicion->CurrentValue = NULL;
		$this->Edicion->OldValue = $this->Edicion->CurrentValue;
		$this->Area->CurrentValue = NULL;
		$this->Area->OldValue = $this->Area->CurrentValue;
		$this->Codigo_Area->CurrentValue = NULL;
		$this->Codigo_Area->OldValue = $this->Codigo_Area->CurrentValue;
		$this->Categoria->CurrentValue = NULL;
		$this->Categoria->OldValue = $this->Categoria->CurrentValue;
		$this->Palabras_Claves->CurrentValue = NULL;
		$this->Palabras_Claves->OldValue = $this->Palabras_Claves->CurrentValue;
		$this->N_copias->CurrentValue = NULL;
		$this->N_copias->OldValue = $this->N_copias->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(TABLE_BASIC_SEARCH, ""), FALSE);
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(TABLE_BASIC_SEARCH_TYPE, ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// Id_libro

		$this->Id_libro->AdvancedSearch->setSearchValue(Get("x_Id_libro", Get("Id_libro", "")));
		if ($this->Id_libro->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Id_libro->AdvancedSearch->setSearchOperator(Get("z_Id_libro", ""));

		// Codigo_Libro
		$this->Codigo_Libro->AdvancedSearch->setSearchValue(Get("x_Codigo_Libro", Get("Codigo_Libro", "")));
		if ($this->Codigo_Libro->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Codigo_Libro->AdvancedSearch->setSearchOperator(Get("z_Codigo_Libro", ""));

		// Titulo
		$this->Titulo->AdvancedSearch->setSearchValue(Get("x_Titulo", Get("Titulo", "")));
		if ($this->Titulo->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Titulo->AdvancedSearch->setSearchOperator(Get("z_Titulo", ""));

		// Autor
		$this->Autor->AdvancedSearch->setSearchValue(Get("x_Autor", Get("Autor", "")));
		if ($this->Autor->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Autor->AdvancedSearch->setSearchOperator(Get("z_Autor", ""));

		// Editorial
		$this->Editorial->AdvancedSearch->setSearchValue(Get("x_Editorial", Get("Editorial", "")));
		if ($this->Editorial->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Editorial->AdvancedSearch->setSearchOperator(Get("z_Editorial", ""));

		// Fecha_publicacion
		$this->Fecha_publicacion->AdvancedSearch->setSearchValue(Get("x_Fecha_publicacion", Get("Fecha_publicacion", "")));
		if ($this->Fecha_publicacion->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Fecha_publicacion->AdvancedSearch->setSearchOperator(Get("z_Fecha_publicacion", ""));

		// Edicion
		$this->Edicion->AdvancedSearch->setSearchValue(Get("x_Edicion", Get("Edicion", "")));
		if ($this->Edicion->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Edicion->AdvancedSearch->setSearchOperator(Get("z_Edicion", ""));

		// Area
		$this->Area->AdvancedSearch->setSearchValue(Get("x_Area", Get("Area", "")));
		if ($this->Area->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Area->AdvancedSearch->setSearchOperator(Get("z_Area", ""));

		// Categoria
		$this->Categoria->AdvancedSearch->setSearchValue(Get("x_Categoria", Get("Categoria", "")));
		if ($this->Categoria->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Categoria->AdvancedSearch->setSearchOperator(Get("z_Categoria", ""));

		// Palabras_Claves
		$this->Palabras_Claves->AdvancedSearch->setSearchValue(Get("x_Palabras_Claves", Get("Palabras_Claves", "")));
		if ($this->Palabras_Claves->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Palabras_Claves->AdvancedSearch->setSearchOperator(Get("z_Palabras_Claves", ""));

		// N_copias
		$this->N_copias->AdvancedSearch->setSearchValue(Get("x_N_copias", Get("N_copias", "")));
		if ($this->N_copias->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->N_copias->AdvancedSearch->setSearchOperator(Get("z_N_copias", ""));
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Id_libro' first before field var 'x_Id_libro'
		$val = $CurrentForm->hasValue("Id_libro") ? $CurrentForm->getValue("Id_libro") : $CurrentForm->getValue("x_Id_libro");
		if (!$this->Id_libro->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->Id_libro->setFormValue($val);

		// Check field name 'Codigo_Libro' first before field var 'x_Codigo_Libro'
		$val = $CurrentForm->hasValue("Codigo_Libro") ? $CurrentForm->getValue("Codigo_Libro") : $CurrentForm->getValue("x_Codigo_Libro");
		if (!$this->Codigo_Libro->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Codigo_Libro->Visible = FALSE; // Disable update for API request
			else
				$this->Codigo_Libro->setFormValue($val);
		}

		// Check field name 'Titulo' first before field var 'x_Titulo'
		$val = $CurrentForm->hasValue("Titulo") ? $CurrentForm->getValue("Titulo") : $CurrentForm->getValue("x_Titulo");
		if (!$this->Titulo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Titulo->Visible = FALSE; // Disable update for API request
			else
				$this->Titulo->setFormValue($val);
		}

		// Check field name 'Autor' first before field var 'x_Autor'
		$val = $CurrentForm->hasValue("Autor") ? $CurrentForm->getValue("Autor") : $CurrentForm->getValue("x_Autor");
		if (!$this->Autor->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Autor->Visible = FALSE; // Disable update for API request
			else
				$this->Autor->setFormValue($val);
		}

		// Check field name 'Editorial' first before field var 'x_Editorial'
		$val = $CurrentForm->hasValue("Editorial") ? $CurrentForm->getValue("Editorial") : $CurrentForm->getValue("x_Editorial");
		if (!$this->Editorial->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Editorial->Visible = FALSE; // Disable update for API request
			else
				$this->Editorial->setFormValue($val);
		}

		// Check field name 'Fecha_publicacion' first before field var 'x_Fecha_publicacion'
		$val = $CurrentForm->hasValue("Fecha_publicacion") ? $CurrentForm->getValue("Fecha_publicacion") : $CurrentForm->getValue("x_Fecha_publicacion");
		if (!$this->Fecha_publicacion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Fecha_publicacion->Visible = FALSE; // Disable update for API request
			else
				$this->Fecha_publicacion->setFormValue($val);
			$this->Fecha_publicacion->CurrentValue = UnFormatDateTime($this->Fecha_publicacion->CurrentValue, 0);
		}

		// Check field name 'Edicion' first before field var 'x_Edicion'
		$val = $CurrentForm->hasValue("Edicion") ? $CurrentForm->getValue("Edicion") : $CurrentForm->getValue("x_Edicion");
		if (!$this->Edicion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Edicion->Visible = FALSE; // Disable update for API request
			else
				$this->Edicion->setFormValue($val);
		}

		// Check field name 'Area' first before field var 'x_Area'
		$val = $CurrentForm->hasValue("Area") ? $CurrentForm->getValue("Area") : $CurrentForm->getValue("x_Area");
		if (!$this->Area->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Area->Visible = FALSE; // Disable update for API request
			else
				$this->Area->setFormValue($val);
		}

		// Check field name 'Categoria' first before field var 'x_Categoria'
		$val = $CurrentForm->hasValue("Categoria") ? $CurrentForm->getValue("Categoria") : $CurrentForm->getValue("x_Categoria");
		if (!$this->Categoria->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Categoria->Visible = FALSE; // Disable update for API request
			else
				$this->Categoria->setFormValue($val);
		}

		// Check field name 'N_copias' first before field var 'x_N_copias'
		$val = $CurrentForm->hasValue("N_copias") ? $CurrentForm->getValue("N_copias") : $CurrentForm->getValue("x_N_copias");
		if (!$this->N_copias->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->N_copias->Visible = FALSE; // Disable update for API request
			else
				$this->N_copias->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->Id_libro->CurrentValue = $this->Id_libro->FormValue;
		$this->Codigo_Libro->CurrentValue = $this->Codigo_Libro->FormValue;
		$this->Titulo->CurrentValue = $this->Titulo->FormValue;
		$this->Autor->CurrentValue = $this->Autor->FormValue;
		$this->Editorial->CurrentValue = $this->Editorial->FormValue;
		$this->Fecha_publicacion->CurrentValue = $this->Fecha_publicacion->FormValue;
		$this->Fecha_publicacion->CurrentValue = UnFormatDateTime($this->Fecha_publicacion->CurrentValue, 0);
		$this->Edicion->CurrentValue = $this->Edicion->FormValue;
		$this->Area->CurrentValue = $this->Area->FormValue;
		$this->Categoria->CurrentValue = $this->Categoria->FormValue;
		$this->N_copias->CurrentValue = $this->N_copias->FormValue;
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
			if (!$this->EventCancelled)
				$this->HashValue = $this->getRowHash($rs); // Get hash value for record
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
		$this->Id_libro->setDbValue($row['Id_libro']);
		$this->Codigo_Libro->setDbValue($row['Codigo_Libro']);
		$this->Titulo->setDbValue($row['Titulo']);
		$this->Autor->setDbValue($row['Autor']);
		$this->Editorial->setDbValue($row['Editorial']);
		$this->Fecha_publicacion->setDbValue($row['Fecha_publicacion']);
		$this->Edicion->setDbValue($row['Edicion']);
		$this->Area->setDbValue($row['Area']);
		$this->Codigo_Area->setDbValue($row['Codigo_Area']);
		$this->Categoria->setDbValue($row['Categoria']);
		$this->Palabras_Claves->setDbValue($row['Palabras_Claves']);
		$this->N_copias->setDbValue($row['N_copias']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['Id_libro'] = $this->Id_libro->CurrentValue;
		$row['Codigo_Libro'] = $this->Codigo_Libro->CurrentValue;
		$row['Titulo'] = $this->Titulo->CurrentValue;
		$row['Autor'] = $this->Autor->CurrentValue;
		$row['Editorial'] = $this->Editorial->CurrentValue;
		$row['Fecha_publicacion'] = $this->Fecha_publicacion->CurrentValue;
		$row['Edicion'] = $this->Edicion->CurrentValue;
		$row['Area'] = $this->Area->CurrentValue;
		$row['Codigo_Area'] = $this->Codigo_Area->CurrentValue;
		$row['Categoria'] = $this->Categoria->CurrentValue;
		$row['Palabras_Claves'] = $this->Palabras_Claves->CurrentValue;
		$row['N_copias'] = $this->N_copias->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("Id_libro")) <> "")
			$this->Id_libro->CurrentValue = $this->getKey("Id_libro"); // Id_libro
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

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
		// Codigo_Area
		// Categoria
		// Palabras_Claves
		// N_copias

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
						$arwrk[2] = $rswrk->fields('df2');
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

			// Id_libro
			$this->Id_libro->LinkCustomAttributes = "";
			$this->Id_libro->HrefValue = "";
			$this->Id_libro->TooltipValue = "";
			if (!$this->isExport())
				$this->Id_libro->ViewValue = $this->highlightValue($this->Id_libro);

			// Codigo_Libro
			$this->Codigo_Libro->LinkCustomAttributes = "";
			$this->Codigo_Libro->HrefValue = "";
			$this->Codigo_Libro->TooltipValue = "";
			if (!$this->isExport())
				$this->Codigo_Libro->ViewValue = $this->highlightValue($this->Codigo_Libro);

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";
			$this->Titulo->TooltipValue = "";
			if (!$this->isExport())
				$this->Titulo->ViewValue = $this->highlightValue($this->Titulo);

			// Autor
			$this->Autor->LinkCustomAttributes = "";
			$this->Autor->HrefValue = "";
			$this->Autor->TooltipValue = "";
			if (!$this->isExport())
				$this->Autor->ViewValue = $this->highlightValue($this->Autor);

			// Editorial
			$this->Editorial->LinkCustomAttributes = "";
			$this->Editorial->HrefValue = "";
			$this->Editorial->TooltipValue = "";
			if (!$this->isExport())
				$this->Editorial->ViewValue = $this->highlightValue($this->Editorial);

			// Fecha_publicacion
			$this->Fecha_publicacion->LinkCustomAttributes = "";
			$this->Fecha_publicacion->HrefValue = "";
			$this->Fecha_publicacion->TooltipValue = "";

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

			// N_copias
			$this->N_copias->LinkCustomAttributes = "";
			$this->N_copias->HrefValue = "";
			$this->N_copias->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Id_libro
			// Codigo_Libro

			$this->Codigo_Libro->EditAttrs["class"] = "form-control";
			$this->Codigo_Libro->EditCustomAttributes = "";
			$this->Codigo_Libro->EditValue = HtmlEncode($this->Codigo_Libro->CurrentValue);
			$this->Codigo_Libro->PlaceHolder = RemoveHtml($this->Codigo_Libro->caption());

			// Titulo
			$this->Titulo->EditAttrs["class"] = "form-control";
			$this->Titulo->EditCustomAttributes = "";
			$this->Titulo->EditValue = HtmlEncode($this->Titulo->CurrentValue);
			$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

			// Autor
			$this->Autor->EditAttrs["class"] = "form-control";
			$this->Autor->EditCustomAttributes = "";
			$this->Autor->EditValue = HtmlEncode($this->Autor->CurrentValue);
			$this->Autor->PlaceHolder = RemoveHtml($this->Autor->caption());

			// Editorial
			$this->Editorial->EditAttrs["class"] = "form-control";
			$this->Editorial->EditCustomAttributes = "";
			$this->Editorial->EditValue = HtmlEncode($this->Editorial->CurrentValue);
			$this->Editorial->PlaceHolder = RemoveHtml($this->Editorial->caption());

			// Fecha_publicacion
			$this->Fecha_publicacion->EditAttrs["class"] = "form-control";
			$this->Fecha_publicacion->EditCustomAttributes = "";
			$this->Fecha_publicacion->EditValue = HtmlEncode(FormatDateTime($this->Fecha_publicacion->CurrentValue, 8));
			$this->Fecha_publicacion->PlaceHolder = RemoveHtml($this->Fecha_publicacion->caption());

			// Edicion
			$this->Edicion->EditAttrs["class"] = "form-control";
			$this->Edicion->EditCustomAttributes = "";
			$this->Edicion->EditValue = HtmlEncode($this->Edicion->CurrentValue);
			$this->Edicion->PlaceHolder = RemoveHtml($this->Edicion->caption());

			// Area
			$this->Area->EditAttrs["class"] = "form-control";
			$this->Area->EditCustomAttributes = "";
			$curVal = trim(strval($this->Area->CurrentValue));
			if ($curVal <> "")
				$this->Area->ViewValue = $this->Area->lookupCacheOption($curVal);
			else
				$this->Area->ViewValue = $this->Area->Lookup !== NULL && is_array($this->Area->Lookup->Options) ? $curVal : NULL;
			if ($this->Area->ViewValue !== NULL) { // Load from cache
				$this->Area->EditValue = array_values($this->Area->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Area`" . SearchString("=", $this->Area->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Area->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Area->EditValue = $arwrk;
			}

			// Categoria
			$this->Categoria->EditAttrs["class"] = "form-control";
			$this->Categoria->EditCustomAttributes = "";
			$curVal = trim(strval($this->Categoria->CurrentValue));
			if ($curVal <> "")
				$this->Categoria->ViewValue = $this->Categoria->lookupCacheOption($curVal);
			else
				$this->Categoria->ViewValue = $this->Categoria->Lookup !== NULL && is_array($this->Categoria->Lookup->Options) ? $curVal : NULL;
			if ($this->Categoria->ViewValue !== NULL) { // Load from cache
				$this->Categoria->EditValue = array_values($this->Categoria->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Categoria`" . SearchString("=", $this->Categoria->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Categoria->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Categoria->EditValue = $arwrk;
			}

			// N_copias
			$this->N_copias->EditAttrs["class"] = "form-control";
			$this->N_copias->EditCustomAttributes = "";
			$this->N_copias->EditValue = HtmlEncode($this->N_copias->CurrentValue);
			$this->N_copias->PlaceHolder = RemoveHtml($this->N_copias->caption());

			// Add refer script
			// Id_libro

			$this->Id_libro->LinkCustomAttributes = "";
			$this->Id_libro->HrefValue = "";

			// Codigo_Libro
			$this->Codigo_Libro->LinkCustomAttributes = "";
			$this->Codigo_Libro->HrefValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";

			// Autor
			$this->Autor->LinkCustomAttributes = "";
			$this->Autor->HrefValue = "";

			// Editorial
			$this->Editorial->LinkCustomAttributes = "";
			$this->Editorial->HrefValue = "";

			// Fecha_publicacion
			$this->Fecha_publicacion->LinkCustomAttributes = "";
			$this->Fecha_publicacion->HrefValue = "";

			// Edicion
			$this->Edicion->LinkCustomAttributes = "";
			$this->Edicion->HrefValue = "";

			// Area
			$this->Area->LinkCustomAttributes = "";
			$this->Area->HrefValue = "";

			// Categoria
			$this->Categoria->LinkCustomAttributes = "";
			$this->Categoria->HrefValue = "";

			// N_copias
			$this->N_copias->LinkCustomAttributes = "";
			$this->N_copias->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Id_libro
			$this->Id_libro->EditAttrs["class"] = "form-control";
			$this->Id_libro->EditCustomAttributes = "";
			$this->Id_libro->EditValue = $this->Id_libro->CurrentValue;
			$this->Id_libro->ViewCustomAttributes = "";

			// Codigo_Libro
			$this->Codigo_Libro->EditAttrs["class"] = "form-control";
			$this->Codigo_Libro->EditCustomAttributes = "";
			$this->Codigo_Libro->EditValue = HtmlEncode($this->Codigo_Libro->CurrentValue);
			$this->Codigo_Libro->PlaceHolder = RemoveHtml($this->Codigo_Libro->caption());

			// Titulo
			$this->Titulo->EditAttrs["class"] = "form-control";
			$this->Titulo->EditCustomAttributes = "";
			$this->Titulo->EditValue = HtmlEncode($this->Titulo->CurrentValue);
			$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

			// Autor
			$this->Autor->EditAttrs["class"] = "form-control";
			$this->Autor->EditCustomAttributes = "";
			$this->Autor->EditValue = HtmlEncode($this->Autor->CurrentValue);
			$this->Autor->PlaceHolder = RemoveHtml($this->Autor->caption());

			// Editorial
			$this->Editorial->EditAttrs["class"] = "form-control";
			$this->Editorial->EditCustomAttributes = "";
			$this->Editorial->EditValue = HtmlEncode($this->Editorial->CurrentValue);
			$this->Editorial->PlaceHolder = RemoveHtml($this->Editorial->caption());

			// Fecha_publicacion
			$this->Fecha_publicacion->EditAttrs["class"] = "form-control";
			$this->Fecha_publicacion->EditCustomAttributes = "";
			$this->Fecha_publicacion->EditValue = HtmlEncode(FormatDateTime($this->Fecha_publicacion->CurrentValue, 8));
			$this->Fecha_publicacion->PlaceHolder = RemoveHtml($this->Fecha_publicacion->caption());

			// Edicion
			$this->Edicion->EditAttrs["class"] = "form-control";
			$this->Edicion->EditCustomAttributes = "";
			$this->Edicion->EditValue = HtmlEncode($this->Edicion->CurrentValue);
			$this->Edicion->PlaceHolder = RemoveHtml($this->Edicion->caption());

			// Area
			$this->Area->EditAttrs["class"] = "form-control";
			$this->Area->EditCustomAttributes = "";
			$curVal = trim(strval($this->Area->CurrentValue));
			if ($curVal <> "")
				$this->Area->ViewValue = $this->Area->lookupCacheOption($curVal);
			else
				$this->Area->ViewValue = $this->Area->Lookup !== NULL && is_array($this->Area->Lookup->Options) ? $curVal : NULL;
			if ($this->Area->ViewValue !== NULL) { // Load from cache
				$this->Area->EditValue = array_values($this->Area->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Area`" . SearchString("=", $this->Area->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Area->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Area->EditValue = $arwrk;
			}

			// Categoria
			$this->Categoria->EditAttrs["class"] = "form-control";
			$this->Categoria->EditCustomAttributes = "";
			$curVal = trim(strval($this->Categoria->CurrentValue));
			if ($curVal <> "")
				$this->Categoria->ViewValue = $this->Categoria->lookupCacheOption($curVal);
			else
				$this->Categoria->ViewValue = $this->Categoria->Lookup !== NULL && is_array($this->Categoria->Lookup->Options) ? $curVal : NULL;
			if ($this->Categoria->ViewValue !== NULL) { // Load from cache
				$this->Categoria->EditValue = array_values($this->Categoria->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Categoria`" . SearchString("=", $this->Categoria->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Categoria->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Categoria->EditValue = $arwrk;
			}

			// N_copias
			$this->N_copias->EditAttrs["class"] = "form-control";
			$this->N_copias->EditCustomAttributes = "";
			$this->N_copias->EditValue = HtmlEncode($this->N_copias->CurrentValue);
			$this->N_copias->PlaceHolder = RemoveHtml($this->N_copias->caption());

			// Edit refer script
			// Id_libro

			$this->Id_libro->LinkCustomAttributes = "";
			$this->Id_libro->HrefValue = "";

			// Codigo_Libro
			$this->Codigo_Libro->LinkCustomAttributes = "";
			$this->Codigo_Libro->HrefValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";

			// Autor
			$this->Autor->LinkCustomAttributes = "";
			$this->Autor->HrefValue = "";

			// Editorial
			$this->Editorial->LinkCustomAttributes = "";
			$this->Editorial->HrefValue = "";

			// Fecha_publicacion
			$this->Fecha_publicacion->LinkCustomAttributes = "";
			$this->Fecha_publicacion->HrefValue = "";

			// Edicion
			$this->Edicion->LinkCustomAttributes = "";
			$this->Edicion->HrefValue = "";

			// Area
			$this->Area->LinkCustomAttributes = "";
			$this->Area->HrefValue = "";

			// Categoria
			$this->Categoria->LinkCustomAttributes = "";
			$this->Categoria->HrefValue = "";

			// N_copias
			$this->N_copias->LinkCustomAttributes = "";
			$this->N_copias->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->Id_libro->Required) {
			if (!$this->Id_libro->IsDetailKey && $this->Id_libro->FormValue != NULL && $this->Id_libro->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Id_libro->caption(), $this->Id_libro->RequiredErrorMessage));
			}
		}
		if ($this->Codigo_Libro->Required) {
			if (!$this->Codigo_Libro->IsDetailKey && $this->Codigo_Libro->FormValue != NULL && $this->Codigo_Libro->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Codigo_Libro->caption(), $this->Codigo_Libro->RequiredErrorMessage));
			}
		}
		if ($this->Titulo->Required) {
			if (!$this->Titulo->IsDetailKey && $this->Titulo->FormValue != NULL && $this->Titulo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Titulo->caption(), $this->Titulo->RequiredErrorMessage));
			}
		}
		if ($this->Autor->Required) {
			if (!$this->Autor->IsDetailKey && $this->Autor->FormValue != NULL && $this->Autor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Autor->caption(), $this->Autor->RequiredErrorMessage));
			}
		}
		if ($this->Editorial->Required) {
			if (!$this->Editorial->IsDetailKey && $this->Editorial->FormValue != NULL && $this->Editorial->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Editorial->caption(), $this->Editorial->RequiredErrorMessage));
			}
		}
		if ($this->Fecha_publicacion->Required) {
			if (!$this->Fecha_publicacion->IsDetailKey && $this->Fecha_publicacion->FormValue != NULL && $this->Fecha_publicacion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fecha_publicacion->caption(), $this->Fecha_publicacion->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Fecha_publicacion->FormValue)) {
			AddMessage($FormError, $this->Fecha_publicacion->errorMessage());
		}
		if ($this->Edicion->Required) {
			if (!$this->Edicion->IsDetailKey && $this->Edicion->FormValue != NULL && $this->Edicion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Edicion->caption(), $this->Edicion->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Edicion->FormValue)) {
			AddMessage($FormError, $this->Edicion->errorMessage());
		}
		if ($this->Area->Required) {
			if (!$this->Area->IsDetailKey && $this->Area->FormValue != NULL && $this->Area->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Area->caption(), $this->Area->RequiredErrorMessage));
			}
		}
		if ($this->Codigo_Area->Required) {
			if (!$this->Codigo_Area->IsDetailKey && $this->Codigo_Area->FormValue != NULL && $this->Codigo_Area->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Codigo_Area->caption(), $this->Codigo_Area->RequiredErrorMessage));
			}
		}
		if ($this->Categoria->Required) {
			if (!$this->Categoria->IsDetailKey && $this->Categoria->FormValue != NULL && $this->Categoria->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Categoria->caption(), $this->Categoria->RequiredErrorMessage));
			}
		}
		if ($this->Palabras_Claves->Required) {
			if (!$this->Palabras_Claves->IsDetailKey && $this->Palabras_Claves->FormValue != NULL && $this->Palabras_Claves->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Palabras_Claves->caption(), $this->Palabras_Claves->RequiredErrorMessage));
			}
		}
		if ($this->N_copias->Required) {
			if (!$this->N_copias->IsDetailKey && $this->N_copias->FormValue != NULL && $this->N_copias->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->N_copias->caption(), $this->N_copias->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->N_copias->FormValue)) {
			AddMessage($FormError, $this->N_copias->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	//
	// Delete records based on current filter
	//

	protected function deleteRows()
	{
		global $Language, $Security;
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey <> "")
					$thisKey .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
				$thisKey .= $row['Id_libro'];
				if (DELETE_UPLOADED_FILES) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($deleteRows === FALSE)
					break;
				if ($key <> "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// Codigo_Libro
			$this->Codigo_Libro->setDbValueDef($rsnew, $this->Codigo_Libro->CurrentValue, NULL, $this->Codigo_Libro->ReadOnly);

			// Titulo
			$this->Titulo->setDbValueDef($rsnew, $this->Titulo->CurrentValue, "", $this->Titulo->ReadOnly);

			// Autor
			$this->Autor->setDbValueDef($rsnew, $this->Autor->CurrentValue, "", $this->Autor->ReadOnly);

			// Editorial
			$this->Editorial->setDbValueDef($rsnew, $this->Editorial->CurrentValue, NULL, $this->Editorial->ReadOnly);

			// Fecha_publicacion
			$this->Fecha_publicacion->setDbValueDef($rsnew, UnFormatDateTime($this->Fecha_publicacion->CurrentValue, 0), NULL, $this->Fecha_publicacion->ReadOnly);

			// Edicion
			$this->Edicion->setDbValueDef($rsnew, $this->Edicion->CurrentValue, NULL, $this->Edicion->ReadOnly);

			// Area
			$this->Area->setDbValueDef($rsnew, $this->Area->CurrentValue, "", $this->Area->ReadOnly);

			// Categoria
			$this->Categoria->setDbValueDef($rsnew, $this->Categoria->CurrentValue, "", $this->Categoria->ReadOnly);

			// N_copias
			$this->N_copias->setDbValueDef($rsnew, $this->N_copias->CurrentValue, 0, $this->N_copias->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Load row hash
	protected function loadRowHash()
	{
		$filter = $this->getRecordFilter();

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$rsRow = $conn->Execute($sql);
		$this->HashValue = ($rsRow && !$rsRow->EOF) ? $this->getRowHash($rsRow) : ""; // Get hash value for record
		$rsRow->close();
	}

	// Get Row Hash
	public function getRowHash(&$rs)
	{
		if (!$rs)
			return "";
		$hash = "";
		$hash .= GetFieldHash($rs->fields('Codigo_Libro')); // Codigo_Libro
		$hash .= GetFieldHash($rs->fields('Titulo')); // Titulo
		$hash .= GetFieldHash($rs->fields('Autor')); // Autor
		$hash .= GetFieldHash($rs->fields('Editorial')); // Editorial
		$hash .= GetFieldHash($rs->fields('Fecha_publicacion')); // Fecha_publicacion
		$hash .= GetFieldHash($rs->fields('Edicion')); // Edicion
		$hash .= GetFieldHash($rs->fields('Area')); // Area
		$hash .= GetFieldHash($rs->fields('Categoria')); // Categoria
		$hash .= GetFieldHash($rs->fields('N_copias')); // N_copias
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// Codigo_Libro
		$this->Codigo_Libro->setDbValueDef($rsnew, $this->Codigo_Libro->CurrentValue, NULL, FALSE);

		// Titulo
		$this->Titulo->setDbValueDef($rsnew, $this->Titulo->CurrentValue, "", FALSE);

		// Autor
		$this->Autor->setDbValueDef($rsnew, $this->Autor->CurrentValue, "", FALSE);

		// Editorial
		$this->Editorial->setDbValueDef($rsnew, $this->Editorial->CurrentValue, NULL, FALSE);

		// Fecha_publicacion
		$this->Fecha_publicacion->setDbValueDef($rsnew, UnFormatDateTime($this->Fecha_publicacion->CurrentValue, 0), NULL, FALSE);

		// Edicion
		$this->Edicion->setDbValueDef($rsnew, $this->Edicion->CurrentValue, NULL, FALSE);

		// Area
		$this->Area->setDbValueDef($rsnew, $this->Area->CurrentValue, "", FALSE);

		// Categoria
		$this->Categoria->setDbValueDef($rsnew, $this->Categoria->CurrentValue, "", FALSE);

		// N_copias
		$this->N_copias->setDbValueDef($rsnew, $this->N_copias->CurrentValue, 0, strval($this->N_copias->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->Id_libro->AdvancedSearch->load();
		$this->Codigo_Libro->AdvancedSearch->load();
		$this->Titulo->AdvancedSearch->load();
		$this->Autor->AdvancedSearch->load();
		$this->Editorial->AdvancedSearch->load();
		$this->Fecha_publicacion->AdvancedSearch->load();
		$this->Edicion->AdvancedSearch->load();
		$this->Area->AdvancedSearch->load();
		$this->Categoria->AdvancedSearch->load();
		$this->Palabras_Claves->AdvancedSearch->load();
		$this->N_copias->AdvancedSearch->load();
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
		$item->Body = "<button id=\"emf_t_libro\" class=\"ew-export-link ew-email\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_t_libro',hdr:ew.language.phrase('ExportToEmailText'),f:document.ft_librolist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$selectLimit = $this->UseSelectLimit;

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

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->setupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		$this->ExportDoc = GetExportDocument($this, "h");
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
		$this->exportDocument($doc, $rs, $this->StartRec, $this->StopRec, "");
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
}
?>
