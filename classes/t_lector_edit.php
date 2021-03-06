<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class t_lector_edit extends t_lector
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 't_lector';

	// Page object name
	public $PageObjName = "t_lector_edit";

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

		// Table object (t_lector)
		if (!isset($GLOBALS["t_lector"]) || get_class($GLOBALS["t_lector"]) == PROJECT_NAMESPACE . "t_lector") {
			$GLOBALS["t_lector"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_lector"];
		}

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 't_lector');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($Conn))
			$Conn = GetConnection($this->Dbid);
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
		global $EXPORT, $t_lector;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t_lector);
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
					if ($pageName == "t_lectorview.php")
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
			$key .= @$ar['Id_lector'];
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
			$this->Id_lector->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_lectorlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Id_lector->setVisibility();
		$this->CI_DNI->setVisibility();
		$this->Nombres->setVisibility();
		$this->Apellidos->setVisibility();
		$this->Direccion->setVisibility();
		$this->Telefono->setVisibility();
		$this->Tipo_Lector->setVisibility();
		$this->Institucion->setVisibility();
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
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$returnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_Id_lector")) {
				$this->Id_lector->setFormValue($CurrentForm->getValue("x_Id_lector"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("Id_lector") !== NULL) {
				$this->Id_lector->setQueryStringValue(Get("Id_lector"));
				$loadByQuery = TRUE;
			} else {
				$this->Id_lector->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi())
					$this->terminate();
				else
					$this->CurrentAction = ""; // Form error, reset action
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->terminate("t_lectorlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_lectorlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if (IsApi())
						$this->terminate(TRUE);
					else
						$this->terminate($returnUrl); // Return to caller
				} elseif (IsApi()) { // API request, return
					$this->terminate();
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
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

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Id_lector' first before field var 'x_Id_lector'
		$val = $CurrentForm->hasValue("Id_lector") ? $CurrentForm->getValue("Id_lector") : $CurrentForm->getValue("x_Id_lector");
		if (!$this->Id_lector->IsDetailKey)
			$this->Id_lector->setFormValue($val);

		// Check field name 'CI_DNI' first before field var 'x_CI_DNI'
		$val = $CurrentForm->hasValue("CI_DNI") ? $CurrentForm->getValue("CI_DNI") : $CurrentForm->getValue("x_CI_DNI");
		if (!$this->CI_DNI->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CI_DNI->Visible = FALSE; // Disable update for API request
			else
				$this->CI_DNI->setFormValue($val);
		}

		// Check field name 'Nombres' first before field var 'x_Nombres'
		$val = $CurrentForm->hasValue("Nombres") ? $CurrentForm->getValue("Nombres") : $CurrentForm->getValue("x_Nombres");
		if (!$this->Nombres->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Nombres->Visible = FALSE; // Disable update for API request
			else
				$this->Nombres->setFormValue($val);
		}

		// Check field name 'Apellidos' first before field var 'x_Apellidos'
		$val = $CurrentForm->hasValue("Apellidos") ? $CurrentForm->getValue("Apellidos") : $CurrentForm->getValue("x_Apellidos");
		if (!$this->Apellidos->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Apellidos->Visible = FALSE; // Disable update for API request
			else
				$this->Apellidos->setFormValue($val);
		}

		// Check field name 'Direccion' first before field var 'x_Direccion'
		$val = $CurrentForm->hasValue("Direccion") ? $CurrentForm->getValue("Direccion") : $CurrentForm->getValue("x_Direccion");
		if (!$this->Direccion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Direccion->Visible = FALSE; // Disable update for API request
			else
				$this->Direccion->setFormValue($val);
		}

		// Check field name 'Telefono' first before field var 'x_Telefono'
		$val = $CurrentForm->hasValue("Telefono") ? $CurrentForm->getValue("Telefono") : $CurrentForm->getValue("x_Telefono");
		if (!$this->Telefono->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Telefono->Visible = FALSE; // Disable update for API request
			else
				$this->Telefono->setFormValue($val);
		}

		// Check field name 'Tipo_Lector' first before field var 'x_Tipo_Lector'
		$val = $CurrentForm->hasValue("Tipo_Lector") ? $CurrentForm->getValue("Tipo_Lector") : $CurrentForm->getValue("x_Tipo_Lector");
		if (!$this->Tipo_Lector->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Tipo_Lector->Visible = FALSE; // Disable update for API request
			else
				$this->Tipo_Lector->setFormValue($val);
		}

		// Check field name 'Institucion' first before field var 'x_Institucion'
		$val = $CurrentForm->hasValue("Institucion") ? $CurrentForm->getValue("Institucion") : $CurrentForm->getValue("x_Institucion");
		if (!$this->Institucion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Institucion->Visible = FALSE; // Disable update for API request
			else
				$this->Institucion->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Id_lector->CurrentValue = $this->Id_lector->FormValue;
		$this->CI_DNI->CurrentValue = $this->CI_DNI->FormValue;
		$this->Nombres->CurrentValue = $this->Nombres->FormValue;
		$this->Apellidos->CurrentValue = $this->Apellidos->FormValue;
		$this->Direccion->CurrentValue = $this->Direccion->FormValue;
		$this->Telefono->CurrentValue = $this->Telefono->FormValue;
		$this->Tipo_Lector->CurrentValue = $this->Tipo_Lector->FormValue;
		$this->Institucion->CurrentValue = $this->Institucion->FormValue;
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
		$this->Id_lector->setDbValue($row['Id_lector']);
		$this->CI_DNI->setDbValue($row['CI_DNI']);
		$this->Nombres->setDbValue($row['Nombres']);
		$this->Apellidos->setDbValue($row['Apellidos']);
		$this->Direccion->setDbValue($row['Direccion']);
		$this->Telefono->setDbValue($row['Telefono']);
		$this->Tipo_Lector->setDbValue($row['Tipo_Lector']);
		$this->Institucion->setDbValue($row['Institucion']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['Id_lector'] = NULL;
		$row['CI_DNI'] = NULL;
		$row['Nombres'] = NULL;
		$row['Apellidos'] = NULL;
		$row['Direccion'] = NULL;
		$row['Telefono'] = NULL;
		$row['Tipo_Lector'] = NULL;
		$row['Institucion'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("Id_lector")) <> "")
			$this->Id_lector->CurrentValue = $this->getKey("Id_lector"); // Id_lector
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// Id_lector
		// CI_DNI
		// Nombres
		// Apellidos
		// Direccion
		// Telefono
		// Tipo_Lector
		// Institucion

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Id_lector
			$this->Id_lector->ViewValue = $this->Id_lector->CurrentValue;
			$this->Id_lector->ViewCustomAttributes = "";

			// CI_DNI
			$this->CI_DNI->ViewValue = $this->CI_DNI->CurrentValue;
			$this->CI_DNI->ViewCustomAttributes = "";

			// Nombres
			$this->Nombres->ViewValue = $this->Nombres->CurrentValue;
			$this->Nombres->ViewCustomAttributes = "";

			// Apellidos
			$this->Apellidos->ViewValue = $this->Apellidos->CurrentValue;
			$this->Apellidos->ViewCustomAttributes = "";

			// Direccion
			$this->Direccion->ViewValue = $this->Direccion->CurrentValue;
			$this->Direccion->ViewCustomAttributes = "";

			// Telefono
			$this->Telefono->ViewValue = $this->Telefono->CurrentValue;
			$this->Telefono->ViewCustomAttributes = "";

			// Tipo_Lector
			$this->Tipo_Lector->ViewValue = $this->Tipo_Lector->CurrentValue;
			$this->Tipo_Lector->ViewCustomAttributes = "";

			// Institucion
			$this->Institucion->ViewValue = $this->Institucion->CurrentValue;
			$this->Institucion->ViewCustomAttributes = "";

			// Id_lector
			$this->Id_lector->LinkCustomAttributes = "";
			$this->Id_lector->HrefValue = "";
			$this->Id_lector->TooltipValue = "";

			// CI_DNI
			$this->CI_DNI->LinkCustomAttributes = "";
			$this->CI_DNI->HrefValue = "";
			$this->CI_DNI->TooltipValue = "";

			// Nombres
			$this->Nombres->LinkCustomAttributes = "";
			$this->Nombres->HrefValue = "";
			$this->Nombres->TooltipValue = "";

			// Apellidos
			$this->Apellidos->LinkCustomAttributes = "";
			$this->Apellidos->HrefValue = "";
			$this->Apellidos->TooltipValue = "";

			// Direccion
			$this->Direccion->LinkCustomAttributes = "";
			$this->Direccion->HrefValue = "";
			$this->Direccion->TooltipValue = "";

			// Telefono
			$this->Telefono->LinkCustomAttributes = "";
			$this->Telefono->HrefValue = "";
			$this->Telefono->TooltipValue = "";

			// Tipo_Lector
			$this->Tipo_Lector->LinkCustomAttributes = "";
			$this->Tipo_Lector->HrefValue = "";
			$this->Tipo_Lector->TooltipValue = "";

			// Institucion
			$this->Institucion->LinkCustomAttributes = "";
			$this->Institucion->HrefValue = "";
			$this->Institucion->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Id_lector
			$this->Id_lector->EditAttrs["class"] = "form-control";
			$this->Id_lector->EditCustomAttributes = "";
			$this->Id_lector->EditValue = $this->Id_lector->CurrentValue;
			$this->Id_lector->ViewCustomAttributes = "";

			// CI_DNI
			$this->CI_DNI->EditAttrs["class"] = "form-control";
			$this->CI_DNI->EditCustomAttributes = "";
			$this->CI_DNI->EditValue = HtmlEncode($this->CI_DNI->CurrentValue);
			$this->CI_DNI->PlaceHolder = RemoveHtml($this->CI_DNI->caption());

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

			// Direccion
			$this->Direccion->EditAttrs["class"] = "form-control";
			$this->Direccion->EditCustomAttributes = "";
			$this->Direccion->EditValue = HtmlEncode($this->Direccion->CurrentValue);
			$this->Direccion->PlaceHolder = RemoveHtml($this->Direccion->caption());

			// Telefono
			$this->Telefono->EditAttrs["class"] = "form-control";
			$this->Telefono->EditCustomAttributes = "";
			$this->Telefono->EditValue = HtmlEncode($this->Telefono->CurrentValue);
			$this->Telefono->PlaceHolder = RemoveHtml($this->Telefono->caption());

			// Tipo_Lector
			$this->Tipo_Lector->EditAttrs["class"] = "form-control";
			$this->Tipo_Lector->EditCustomAttributes = "";
			$this->Tipo_Lector->EditValue = HtmlEncode($this->Tipo_Lector->CurrentValue);
			$this->Tipo_Lector->PlaceHolder = RemoveHtml($this->Tipo_Lector->caption());

			// Institucion
			$this->Institucion->EditAttrs["class"] = "form-control";
			$this->Institucion->EditCustomAttributes = "";
			$this->Institucion->EditValue = HtmlEncode($this->Institucion->CurrentValue);
			$this->Institucion->PlaceHolder = RemoveHtml($this->Institucion->caption());

			// Edit refer script
			// Id_lector

			$this->Id_lector->LinkCustomAttributes = "";
			$this->Id_lector->HrefValue = "";

			// CI_DNI
			$this->CI_DNI->LinkCustomAttributes = "";
			$this->CI_DNI->HrefValue = "";

			// Nombres
			$this->Nombres->LinkCustomAttributes = "";
			$this->Nombres->HrefValue = "";

			// Apellidos
			$this->Apellidos->LinkCustomAttributes = "";
			$this->Apellidos->HrefValue = "";

			// Direccion
			$this->Direccion->LinkCustomAttributes = "";
			$this->Direccion->HrefValue = "";

			// Telefono
			$this->Telefono->LinkCustomAttributes = "";
			$this->Telefono->HrefValue = "";

			// Tipo_Lector
			$this->Tipo_Lector->LinkCustomAttributes = "";
			$this->Tipo_Lector->HrefValue = "";

			// Institucion
			$this->Institucion->LinkCustomAttributes = "";
			$this->Institucion->HrefValue = "";
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

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->Id_lector->Required) {
			if (!$this->Id_lector->IsDetailKey && $this->Id_lector->FormValue != NULL && $this->Id_lector->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Id_lector->caption(), $this->Id_lector->RequiredErrorMessage));
			}
		}
		if ($this->CI_DNI->Required) {
			if (!$this->CI_DNI->IsDetailKey && $this->CI_DNI->FormValue != NULL && $this->CI_DNI->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CI_DNI->caption(), $this->CI_DNI->RequiredErrorMessage));
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
		if ($this->Direccion->Required) {
			if (!$this->Direccion->IsDetailKey && $this->Direccion->FormValue != NULL && $this->Direccion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Direccion->caption(), $this->Direccion->RequiredErrorMessage));
			}
		}
		if ($this->Telefono->Required) {
			if (!$this->Telefono->IsDetailKey && $this->Telefono->FormValue != NULL && $this->Telefono->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Telefono->caption(), $this->Telefono->RequiredErrorMessage));
			}
		}
		if ($this->Tipo_Lector->Required) {
			if (!$this->Tipo_Lector->IsDetailKey && $this->Tipo_Lector->FormValue != NULL && $this->Tipo_Lector->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Tipo_Lector->caption(), $this->Tipo_Lector->RequiredErrorMessage));
			}
		}
		if ($this->Institucion->Required) {
			if (!$this->Institucion->IsDetailKey && $this->Institucion->FormValue != NULL && $this->Institucion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Institucion->caption(), $this->Institucion->RequiredErrorMessage));
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

			// CI_DNI
			$this->CI_DNI->setDbValueDef($rsnew, $this->CI_DNI->CurrentValue, "", $this->CI_DNI->ReadOnly);

			// Nombres
			$this->Nombres->setDbValueDef($rsnew, $this->Nombres->CurrentValue, "", $this->Nombres->ReadOnly);

			// Apellidos
			$this->Apellidos->setDbValueDef($rsnew, $this->Apellidos->CurrentValue, "", $this->Apellidos->ReadOnly);

			// Direccion
			$this->Direccion->setDbValueDef($rsnew, $this->Direccion->CurrentValue, "", $this->Direccion->ReadOnly);

			// Telefono
			$this->Telefono->setDbValueDef($rsnew, $this->Telefono->CurrentValue, "", $this->Telefono->ReadOnly);

			// Tipo_Lector
			$this->Tipo_Lector->setDbValueDef($rsnew, $this->Tipo_Lector->CurrentValue, "", $this->Tipo_Lector->ReadOnly);

			// Institucion
			$this->Institucion->setDbValueDef($rsnew, $this->Institucion->CurrentValue, "", $this->Institucion->ReadOnly);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_lectorlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
}
?>
