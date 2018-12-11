<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class t_transaccion_grid extends t_transaccion
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 't_transaccion';

	// Page object name
	public $PageObjName = "t_transaccion_grid";

	// Grid form hidden field names
	public $FormName = "ft_transacciongrid";
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
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (t_transaccion)
		if (!isset($GLOBALS["t_transaccion"]) || get_class($GLOBALS["t_transaccion"]) == PROJECT_NAMESPACE . "t_transaccion") {
			$GLOBALS["t_transaccion"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["t_transaccion"];

		}
		$this->AddUrl = "t_transaccionadd.php";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	//
	// Terminate page
	//

	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

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

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

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
	public $ShowOtherOptions = FALSE;
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

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
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

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		// Search filters

		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Handle reset command
			$this->resetCmd();

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions->getItem("griddelete");
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
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

		// Build filter
		$filter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->getMasterFilter() <> "" && $this->getCurrentMasterTable() == "t_lector") {
			global $t_lector;
			$rsmaster = $t_lector->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->terminate("t_lectorlist.php"); // Return to master page
			} else {
				$t_lector->loadListRowValues($rsmaster);
				$t_lector->RowType = ROWTYPE_MASTER; // Master row
				$t_lector->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecs = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecs = $this->Recordset->RecordCount();
				}
				$this->StartRec = 1;
				$this->DisplayRecs = $this->TotalRecs;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRec = 1;
				$this->DisplayRecs = $this->GridAddRowCount;
			}
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
			$this->DisplayRecs = $this->TotalRecs; // Display all records
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

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
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

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
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
			$this->Id_tran->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->Id_tran->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = &$this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key <> "")
						$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
					$key .= $this->Id_tran->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter <> "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_CI_Lector") && $CurrentForm->hasValue("o_CI_Lector") && $this->CI_Lector->CurrentValue <> $this->CI_Lector->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Nombres") && $CurrentForm->hasValue("o_Nombres") && $this->Nombres->CurrentValue <> $this->Nombres->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Apellidos") && $CurrentForm->hasValue("o_Apellidos") && $this->Apellidos->CurrentValue <> $this->Apellidos->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Cod_libro") && $CurrentForm->hasValue("o_Cod_libro") && $this->Cod_libro->CurrentValue <> $this->Cod_libro->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Titulo") && $CurrentForm->hasValue("o_Titulo") && $this->Titulo->CurrentValue <> $this->Titulo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Fecha_Prestamo") && $CurrentForm->hasValue("o_Fecha_Prestamo") && $this->Fecha_Prestamo->CurrentValue <> $this->Fecha_Prestamo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Fecha_Devolucion") && $CurrentForm->hasValue("o_Fecha_Devolucion") && $this->Fecha_Devolucion->CurrentValue <> $this->Fecha_Devolucion->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Estado") && $CurrentForm->hasValue("o_Estado") && $this->Estado->CurrentValue <> $this->Estado->OldValue)
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

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->CI_Lector->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
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

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->isLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->isLoggedIn();
		$item->OnLeft = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = ""; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
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
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = &$options->Items["griddelete"];
				$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}
		if ($this->CurrentMode == "view") { // View mode

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

		// "copy"
		$opt = &$this->ListOptions->Items["copy"];
		$copycaption = HtmlTitle($Language->Phrase("CopyLink"));
		if ($Security->isLoggedIn()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = &$this->ListOptions->Items["delete"];
		if ($Security->isLoggedIn())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->Id_tran->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('Id_tran');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = &$this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;
		$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->Phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
			$item->Visible = ($this->AddUrl <> "" && $Security->isLoggedIn());
		}
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = &$options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
				$item->Visible = $Security->isLoggedIn();
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = &$options["addedit"];
			$item = &$option->getItem("add");
			$this->ShowOtherOptions = $item && $item->Visible;
		}
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

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->Id_tran->CurrentValue = NULL;
		$this->Id_tran->OldValue = $this->Id_tran->CurrentValue;
		$this->CI_Lector->CurrentValue = NULL;
		$this->CI_Lector->OldValue = $this->CI_Lector->CurrentValue;
		$this->Nombres->CurrentValue = NULL;
		$this->Nombres->OldValue = $this->Nombres->CurrentValue;
		$this->Apellidos->CurrentValue = NULL;
		$this->Apellidos->OldValue = $this->Apellidos->CurrentValue;
		$this->Cod_libro->CurrentValue = NULL;
		$this->Cod_libro->OldValue = $this->Cod_libro->CurrentValue;
		$this->Titulo->CurrentValue = NULL;
		$this->Titulo->OldValue = $this->Titulo->CurrentValue;
		$this->Fecha_Prestamo->CurrentValue = NULL;
		$this->Fecha_Prestamo->OldValue = $this->Fecha_Prestamo->CurrentValue;
		$this->Fecha_Devolucion->CurrentValue = NULL;
		$this->Fecha_Devolucion->OldValue = $this->Fecha_Devolucion->CurrentValue;
		$this->Estado->CurrentValue = NULL;
		$this->Estado->OldValue = $this->Estado->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'Id_tran' first before field var 'x_Id_tran'
		$val = $CurrentForm->hasValue("Id_tran") ? $CurrentForm->getValue("Id_tran") : $CurrentForm->getValue("x_Id_tran");
		if (!$this->Id_tran->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->Id_tran->setFormValue($val);

		// Check field name 'CI_Lector' first before field var 'x_CI_Lector'
		$val = $CurrentForm->hasValue("CI_Lector") ? $CurrentForm->getValue("CI_Lector") : $CurrentForm->getValue("x_CI_Lector");
		if (!$this->CI_Lector->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CI_Lector->Visible = FALSE; // Disable update for API request
			else
				$this->CI_Lector->setFormValue($val);
		}
		$this->CI_Lector->setOldValue($CurrentForm->getValue("o_CI_Lector"));

		// Check field name 'Nombres' first before field var 'x_Nombres'
		$val = $CurrentForm->hasValue("Nombres") ? $CurrentForm->getValue("Nombres") : $CurrentForm->getValue("x_Nombres");
		if (!$this->Nombres->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Nombres->Visible = FALSE; // Disable update for API request
			else
				$this->Nombres->setFormValue($val);
		}
		$this->Nombres->setOldValue($CurrentForm->getValue("o_Nombres"));

		// Check field name 'Apellidos' first before field var 'x_Apellidos'
		$val = $CurrentForm->hasValue("Apellidos") ? $CurrentForm->getValue("Apellidos") : $CurrentForm->getValue("x_Apellidos");
		if (!$this->Apellidos->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Apellidos->Visible = FALSE; // Disable update for API request
			else
				$this->Apellidos->setFormValue($val);
		}
		$this->Apellidos->setOldValue($CurrentForm->getValue("o_Apellidos"));

		// Check field name 'Cod_libro' first before field var 'x_Cod_libro'
		$val = $CurrentForm->hasValue("Cod_libro") ? $CurrentForm->getValue("Cod_libro") : $CurrentForm->getValue("x_Cod_libro");
		if (!$this->Cod_libro->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Cod_libro->Visible = FALSE; // Disable update for API request
			else
				$this->Cod_libro->setFormValue($val);
		}
		$this->Cod_libro->setOldValue($CurrentForm->getValue("o_Cod_libro"));

		// Check field name 'Titulo' first before field var 'x_Titulo'
		$val = $CurrentForm->hasValue("Titulo") ? $CurrentForm->getValue("Titulo") : $CurrentForm->getValue("x_Titulo");
		if (!$this->Titulo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Titulo->Visible = FALSE; // Disable update for API request
			else
				$this->Titulo->setFormValue($val);
		}
		$this->Titulo->setOldValue($CurrentForm->getValue("o_Titulo"));

		// Check field name 'Fecha_Prestamo' first before field var 'x_Fecha_Prestamo'
		$val = $CurrentForm->hasValue("Fecha_Prestamo") ? $CurrentForm->getValue("Fecha_Prestamo") : $CurrentForm->getValue("x_Fecha_Prestamo");
		if (!$this->Fecha_Prestamo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Fecha_Prestamo->Visible = FALSE; // Disable update for API request
			else
				$this->Fecha_Prestamo->setFormValue($val);
			$this->Fecha_Prestamo->CurrentValue = UnFormatDateTime($this->Fecha_Prestamo->CurrentValue, 0);
		}
		$this->Fecha_Prestamo->setOldValue($CurrentForm->getValue("o_Fecha_Prestamo"));

		// Check field name 'Fecha_Devolucion' first before field var 'x_Fecha_Devolucion'
		$val = $CurrentForm->hasValue("Fecha_Devolucion") ? $CurrentForm->getValue("Fecha_Devolucion") : $CurrentForm->getValue("x_Fecha_Devolucion");
		if (!$this->Fecha_Devolucion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Fecha_Devolucion->Visible = FALSE; // Disable update for API request
			else
				$this->Fecha_Devolucion->setFormValue($val);
			$this->Fecha_Devolucion->CurrentValue = UnFormatDateTime($this->Fecha_Devolucion->CurrentValue, 0);
		}
		$this->Fecha_Devolucion->setOldValue($CurrentForm->getValue("o_Fecha_Devolucion"));

		// Check field name 'Estado' first before field var 'x_Estado'
		$val = $CurrentForm->hasValue("Estado") ? $CurrentForm->getValue("Estado") : $CurrentForm->getValue("x_Estado");
		if (!$this->Estado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Estado->Visible = FALSE; // Disable update for API request
			else
				$this->Estado->setFormValue($val);
		}
		$this->Estado->setOldValue($CurrentForm->getValue("o_Estado"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->Id_tran->CurrentValue = $this->Id_tran->FormValue;
		$this->CI_Lector->CurrentValue = $this->CI_Lector->FormValue;
		$this->Nombres->CurrentValue = $this->Nombres->FormValue;
		$this->Apellidos->CurrentValue = $this->Apellidos->FormValue;
		$this->Cod_libro->CurrentValue = $this->Cod_libro->FormValue;
		$this->Titulo->CurrentValue = $this->Titulo->FormValue;
		$this->Fecha_Prestamo->CurrentValue = $this->Fecha_Prestamo->FormValue;
		$this->Fecha_Prestamo->CurrentValue = UnFormatDateTime($this->Fecha_Prestamo->CurrentValue, 0);
		$this->Fecha_Devolucion->CurrentValue = $this->Fecha_Devolucion->FormValue;
		$this->Fecha_Devolucion->CurrentValue = UnFormatDateTime($this->Fecha_Devolucion->CurrentValue, 0);
		$this->Estado->CurrentValue = $this->Estado->FormValue;
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
		$this->loadDefaultValues();
		$row = [];
		$row['Id_tran'] = $this->Id_tran->CurrentValue;
		$row['CI_Lector'] = $this->CI_Lector->CurrentValue;
		$row['Nombres'] = $this->Nombres->CurrentValue;
		$row['Apellidos'] = $this->Apellidos->CurrentValue;
		$row['Cod_libro'] = $this->Cod_libro->CurrentValue;
		$row['Titulo'] = $this->Titulo->CurrentValue;
		$row['Fecha_Prestamo'] = $this->Fecha_Prestamo->CurrentValue;
		$row['Fecha_Devolucion'] = $this->Fecha_Devolucion->CurrentValue;
		$row['Estado'] = $this->Estado->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->Id_tran->CurrentValue = strval($arKeys[0]); // Id_tran
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

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
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

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
			$this->CI_Lector->ViewValue = $this->CI_Lector->CurrentValue;
			$this->CI_Lector->ViewCustomAttributes = "";

			// Nombres
			$this->Nombres->ViewValue = $this->Nombres->CurrentValue;
			$this->Nombres->ViewCustomAttributes = "";

			// Apellidos
			$this->Apellidos->ViewValue = $this->Apellidos->CurrentValue;
			$this->Apellidos->ViewCustomAttributes = "";

			// Cod_libro
			$this->Cod_libro->ViewValue = $this->Cod_libro->CurrentValue;
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Id_tran
			// CI_Lector

			$this->CI_Lector->EditAttrs["class"] = "form-control";
			$this->CI_Lector->EditCustomAttributes = "";
			if ($this->CI_Lector->getSessionValue() <> "") {
				$this->CI_Lector->CurrentValue = $this->CI_Lector->getSessionValue();
				$this->CI_Lector->OldValue = $this->CI_Lector->CurrentValue;
			$this->CI_Lector->ViewValue = $this->CI_Lector->CurrentValue;
			$this->CI_Lector->ViewCustomAttributes = "";
			} else {
			$this->CI_Lector->EditValue = HtmlEncode($this->CI_Lector->CurrentValue);
			$this->CI_Lector->PlaceHolder = RemoveHtml($this->CI_Lector->caption());
			}

			// Nombres
			$this->Nombres->EditAttrs["class"] = "form-control";
			$this->Nombres->EditCustomAttributes = "";
			$this->Nombres->EditValue = HtmlEncode($this->Nombres->CurrentValue);
			$this->Nombres->PlaceHolder = RemoveHtml($this->Nombres->caption());

			// Apellidos
			$this->Apellidos->EditAttrs["class"] = "form-control";
			$this->Apellidos->EditCustomAttributes = "";
			$this->Apellidos->EditValue = HtmlEncode($this->Apellidos->CurrentValue);
			$this->Apellidos->PlaceHolder = RemoveHtml($this->Apellidos->caption());

			// Cod_libro
			$this->Cod_libro->EditAttrs["class"] = "form-control";
			$this->Cod_libro->EditCustomAttributes = "";
			$this->Cod_libro->EditValue = HtmlEncode($this->Cod_libro->CurrentValue);
			$this->Cod_libro->PlaceHolder = RemoveHtml($this->Cod_libro->caption());

			// Titulo
			$this->Titulo->EditAttrs["class"] = "form-control";
			$this->Titulo->EditCustomAttributes = "";
			$this->Titulo->EditValue = HtmlEncode($this->Titulo->CurrentValue);
			$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

			// Fecha_Prestamo
			$this->Fecha_Prestamo->EditAttrs["class"] = "form-control";
			$this->Fecha_Prestamo->EditCustomAttributes = "";
			$this->Fecha_Prestamo->EditValue = HtmlEncode(FormatDateTime($this->Fecha_Prestamo->CurrentValue, 8));
			$this->Fecha_Prestamo->PlaceHolder = RemoveHtml($this->Fecha_Prestamo->caption());

			// Fecha_Devolucion
			$this->Fecha_Devolucion->EditAttrs["class"] = "form-control";
			$this->Fecha_Devolucion->EditCustomAttributes = "";
			$this->Fecha_Devolucion->EditValue = HtmlEncode(FormatDateTime($this->Fecha_Devolucion->CurrentValue, 8));
			$this->Fecha_Devolucion->PlaceHolder = RemoveHtml($this->Fecha_Devolucion->caption());

			// Estado
			$this->Estado->EditAttrs["class"] = "form-control";
			$this->Estado->EditCustomAttributes = "";
			$this->Estado->EditValue = HtmlEncode($this->Estado->CurrentValue);
			$this->Estado->PlaceHolder = RemoveHtml($this->Estado->caption());

			// Add refer script
			// Id_tran

			$this->Id_tran->LinkCustomAttributes = "";
			$this->Id_tran->HrefValue = "";

			// CI_Lector
			$this->CI_Lector->LinkCustomAttributes = "";
			$this->CI_Lector->HrefValue = "";

			// Nombres
			$this->Nombres->LinkCustomAttributes = "";
			$this->Nombres->HrefValue = "";

			// Apellidos
			$this->Apellidos->LinkCustomAttributes = "";
			$this->Apellidos->HrefValue = "";

			// Cod_libro
			$this->Cod_libro->LinkCustomAttributes = "";
			$this->Cod_libro->HrefValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";

			// Fecha_Prestamo
			$this->Fecha_Prestamo->LinkCustomAttributes = "";
			$this->Fecha_Prestamo->HrefValue = "";

			// Fecha_Devolucion
			$this->Fecha_Devolucion->LinkCustomAttributes = "";
			$this->Fecha_Devolucion->HrefValue = "";

			// Estado
			$this->Estado->LinkCustomAttributes = "";
			$this->Estado->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Id_tran
			$this->Id_tran->EditAttrs["class"] = "form-control";
			$this->Id_tran->EditCustomAttributes = "";
			$this->Id_tran->EditValue = $this->Id_tran->CurrentValue;
			$this->Id_tran->ViewCustomAttributes = "";

			// CI_Lector
			$this->CI_Lector->EditAttrs["class"] = "form-control";
			$this->CI_Lector->EditCustomAttributes = "";
			if ($this->CI_Lector->getSessionValue() <> "") {
				$this->CI_Lector->CurrentValue = $this->CI_Lector->getSessionValue();
				$this->CI_Lector->OldValue = $this->CI_Lector->CurrentValue;
			$this->CI_Lector->ViewValue = $this->CI_Lector->CurrentValue;
			$this->CI_Lector->ViewCustomAttributes = "";
			} else {
			$this->CI_Lector->EditValue = HtmlEncode($this->CI_Lector->CurrentValue);
			$this->CI_Lector->PlaceHolder = RemoveHtml($this->CI_Lector->caption());
			}

			// Nombres
			$this->Nombres->EditAttrs["class"] = "form-control";
			$this->Nombres->EditCustomAttributes = "";
			$this->Nombres->EditValue = HtmlEncode($this->Nombres->CurrentValue);
			$this->Nombres->PlaceHolder = RemoveHtml($this->Nombres->caption());

			// Apellidos
			$this->Apellidos->EditAttrs["class"] = "form-control";
			$this->Apellidos->EditCustomAttributes = "";
			$this->Apellidos->EditValue = HtmlEncode($this->Apellidos->CurrentValue);
			$this->Apellidos->PlaceHolder = RemoveHtml($this->Apellidos->caption());

			// Cod_libro
			$this->Cod_libro->EditAttrs["class"] = "form-control";
			$this->Cod_libro->EditCustomAttributes = "";
			$this->Cod_libro->EditValue = HtmlEncode($this->Cod_libro->CurrentValue);
			$this->Cod_libro->PlaceHolder = RemoveHtml($this->Cod_libro->caption());

			// Titulo
			$this->Titulo->EditAttrs["class"] = "form-control";
			$this->Titulo->EditCustomAttributes = "";
			$this->Titulo->EditValue = HtmlEncode($this->Titulo->CurrentValue);
			$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

			// Fecha_Prestamo
			$this->Fecha_Prestamo->EditAttrs["class"] = "form-control";
			$this->Fecha_Prestamo->EditCustomAttributes = "";
			$this->Fecha_Prestamo->EditValue = HtmlEncode(FormatDateTime($this->Fecha_Prestamo->CurrentValue, 8));
			$this->Fecha_Prestamo->PlaceHolder = RemoveHtml($this->Fecha_Prestamo->caption());

			// Fecha_Devolucion
			$this->Fecha_Devolucion->EditAttrs["class"] = "form-control";
			$this->Fecha_Devolucion->EditCustomAttributes = "";
			$this->Fecha_Devolucion->EditValue = HtmlEncode(FormatDateTime($this->Fecha_Devolucion->CurrentValue, 8));
			$this->Fecha_Devolucion->PlaceHolder = RemoveHtml($this->Fecha_Devolucion->caption());

			// Estado
			$this->Estado->EditAttrs["class"] = "form-control";
			$this->Estado->EditCustomAttributes = "";
			$this->Estado->EditValue = HtmlEncode($this->Estado->CurrentValue);
			$this->Estado->PlaceHolder = RemoveHtml($this->Estado->caption());

			// Edit refer script
			// Id_tran

			$this->Id_tran->LinkCustomAttributes = "";
			$this->Id_tran->HrefValue = "";

			// CI_Lector
			$this->CI_Lector->LinkCustomAttributes = "";
			$this->CI_Lector->HrefValue = "";

			// Nombres
			$this->Nombres->LinkCustomAttributes = "";
			$this->Nombres->HrefValue = "";

			// Apellidos
			$this->Apellidos->LinkCustomAttributes = "";
			$this->Apellidos->HrefValue = "";

			// Cod_libro
			$this->Cod_libro->LinkCustomAttributes = "";
			$this->Cod_libro->HrefValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";

			// Fecha_Prestamo
			$this->Fecha_Prestamo->LinkCustomAttributes = "";
			$this->Fecha_Prestamo->HrefValue = "";

			// Fecha_Devolucion
			$this->Fecha_Devolucion->LinkCustomAttributes = "";
			$this->Fecha_Devolucion->HrefValue = "";

			// Estado
			$this->Estado->LinkCustomAttributes = "";
			$this->Estado->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->Id_tran->Required) {
			if (!$this->Id_tran->IsDetailKey && $this->Id_tran->FormValue != NULL && $this->Id_tran->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Id_tran->caption(), $this->Id_tran->RequiredErrorMessage));
			}
		}
		if ($this->CI_Lector->Required) {
			if (!$this->CI_Lector->IsDetailKey && $this->CI_Lector->FormValue != NULL && $this->CI_Lector->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CI_Lector->caption(), $this->CI_Lector->RequiredErrorMessage));
			}
		}
		if ($this->Nombres->Required) {
			if (!$this->Nombres->IsDetailKey && $this->Nombres->FormValue != NULL && $this->Nombres->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nombres->caption(), $this->Nombres->RequiredErrorMessage));
			}
		}
		if ($this->Apellidos->Required) {
			if (!$this->Apellidos->IsDetailKey && $this->Apellidos->FormValue != NULL && $this->Apellidos->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Apellidos->caption(), $this->Apellidos->RequiredErrorMessage));
			}
		}
		if ($this->Cod_libro->Required) {
			if (!$this->Cod_libro->IsDetailKey && $this->Cod_libro->FormValue != NULL && $this->Cod_libro->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Cod_libro->caption(), $this->Cod_libro->RequiredErrorMessage));
			}
		}
		if ($this->Titulo->Required) {
			if (!$this->Titulo->IsDetailKey && $this->Titulo->FormValue != NULL && $this->Titulo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Titulo->caption(), $this->Titulo->RequiredErrorMessage));
			}
		}
		if ($this->Fecha_Prestamo->Required) {
			if (!$this->Fecha_Prestamo->IsDetailKey && $this->Fecha_Prestamo->FormValue != NULL && $this->Fecha_Prestamo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fecha_Prestamo->caption(), $this->Fecha_Prestamo->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Fecha_Prestamo->FormValue)) {
			AddMessage($FormError, $this->Fecha_Prestamo->errorMessage());
		}
		if ($this->Fecha_Devolucion->Required) {
			if (!$this->Fecha_Devolucion->IsDetailKey && $this->Fecha_Devolucion->FormValue != NULL && $this->Fecha_Devolucion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fecha_Devolucion->caption(), $this->Fecha_Devolucion->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Fecha_Devolucion->FormValue)) {
			AddMessage($FormError, $this->Fecha_Devolucion->errorMessage());
		}
		if ($this->Estado->Required) {
			if (!$this->Estado->IsDetailKey && $this->Estado->FormValue != NULL && $this->Estado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Estado->caption(), $this->Estado->RequiredErrorMessage));
			}
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
				$thisKey .= $row['Id_tran'];
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

			// CI_Lector
			$this->CI_Lector->setDbValueDef($rsnew, $this->CI_Lector->CurrentValue, "", $this->CI_Lector->ReadOnly);

			// Nombres
			$this->Nombres->setDbValueDef($rsnew, $this->Nombres->CurrentValue, "", $this->Nombres->ReadOnly);

			// Apellidos
			$this->Apellidos->setDbValueDef($rsnew, $this->Apellidos->CurrentValue, "", $this->Apellidos->ReadOnly);

			// Cod_libro
			$this->Cod_libro->setDbValueDef($rsnew, $this->Cod_libro->CurrentValue, "", $this->Cod_libro->ReadOnly);

			// Titulo
			$this->Titulo->setDbValueDef($rsnew, $this->Titulo->CurrentValue, "", $this->Titulo->ReadOnly);

			// Fecha_Prestamo
			$this->Fecha_Prestamo->setDbValueDef($rsnew, UnFormatDateTime($this->Fecha_Prestamo->CurrentValue, 0), CurrentDate(), $this->Fecha_Prestamo->ReadOnly);

			// Fecha_Devolucion
			$this->Fecha_Devolucion->setDbValueDef($rsnew, UnFormatDateTime($this->Fecha_Devolucion->CurrentValue, 0), CurrentDate(), $this->Fecha_Devolucion->ReadOnly);

			// Estado
			$this->Estado->setDbValueDef($rsnew, $this->Estado->CurrentValue, "", $this->Estado->ReadOnly);

			// Check referential integrity for master table 't_lector'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_t_lector();
			$keyValue = isset($rsnew['CI_Lector']) ? $rsnew['CI_Lector'] : $rsold['CI_Lector'];
			if (strval($keyValue) <> "") {
				$masterFilter = str_replace("@Id_lector@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["t_lector"]))
					$GLOBALS["t_lector"] = new t_lector();
				$rsmaster = $GLOBALS["t_lector"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "t_lector", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "t_lector") {
				$this->CI_Lector->CurrentValue = $this->CI_Lector->getSessionValue();
			}

		// Check referential integrity for master table 't_lector'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_t_lector();
		if (strval($this->CI_Lector->CurrentValue) <> "") {
			$masterFilter = str_replace("@Id_lector@", AdjustSql($this->CI_Lector->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["t_lector"]))
				$GLOBALS["t_lector"] = new t_lector();
			$rsmaster = $GLOBALS["t_lector"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "t_lector", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// CI_Lector
		$this->CI_Lector->setDbValueDef($rsnew, $this->CI_Lector->CurrentValue, "", FALSE);

		// Nombres
		$this->Nombres->setDbValueDef($rsnew, $this->Nombres->CurrentValue, "", FALSE);

		// Apellidos
		$this->Apellidos->setDbValueDef($rsnew, $this->Apellidos->CurrentValue, "", FALSE);

		// Cod_libro
		$this->Cod_libro->setDbValueDef($rsnew, $this->Cod_libro->CurrentValue, "", FALSE);

		// Titulo
		$this->Titulo->setDbValueDef($rsnew, $this->Titulo->CurrentValue, "", FALSE);

		// Fecha_Prestamo
		$this->Fecha_Prestamo->setDbValueDef($rsnew, UnFormatDateTime($this->Fecha_Prestamo->CurrentValue, 0), CurrentDate(), FALSE);

		// Fecha_Devolucion
		$this->Fecha_Devolucion->setDbValueDef($rsnew, UnFormatDateTime($this->Fecha_Devolucion->CurrentValue, 0), CurrentDate(), FALSE);

		// Estado
		$this->Estado->setDbValueDef($rsnew, $this->Estado->CurrentValue, "", FALSE);

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "t_lector") {
			$this->CI_Lector->Visible = FALSE;
			if ($GLOBALS["t_lector"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
}
?>
