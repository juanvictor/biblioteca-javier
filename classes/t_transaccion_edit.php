<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class t_transaccion_edit extends t_transaccion
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 't_transaccion';

	// Page object name
	public $PageObjName = "t_transaccion_edit";

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

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
					$this->terminate(GetUrl("t_transaccionlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
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
			if ($CurrentForm->hasValue("x_Id_tran")) {
				$this->Id_tran->setFormValue($CurrentForm->getValue("x_Id_tran"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("Id_tran") !== NULL) {
				$this->Id_tran->setQueryStringValue(Get("Id_tran"));
				$loadByQuery = TRUE;
			} else {
				$this->Id_tran->CurrentValue = NULL;
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
					$this->terminate("t_transaccionlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "t_transaccionlist.php")
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

		// Check field name 'Id_tran' first before field var 'x_Id_tran'
		$val = $CurrentForm->hasValue("Id_tran") ? $CurrentForm->getValue("Id_tran") : $CurrentForm->getValue("x_Id_tran");
		if (!$this->Id_tran->IsDetailKey)
			$this->Id_tran->setFormValue($val);

		// Check field name 'CI_Lector' first before field var 'x_CI_Lector'
		$val = $CurrentForm->hasValue("CI_Lector") ? $CurrentForm->getValue("CI_Lector") : $CurrentForm->getValue("x_CI_Lector");
		if (!$this->CI_Lector->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CI_Lector->Visible = FALSE; // Disable update for API request
			else
				$this->CI_Lector->setFormValue($val);
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

		// Check field name 'Cod_libro' first before field var 'x_Cod_libro'
		$val = $CurrentForm->hasValue("Cod_libro") ? $CurrentForm->getValue("Cod_libro") : $CurrentForm->getValue("x_Cod_libro");
		if (!$this->Cod_libro->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Cod_libro->Visible = FALSE; // Disable update for API request
			else
				$this->Cod_libro->setFormValue($val);
		}

		// Check field name 'Titulo' first before field var 'x_Titulo'
		$val = $CurrentForm->hasValue("Titulo") ? $CurrentForm->getValue("Titulo") : $CurrentForm->getValue("x_Titulo");
		if (!$this->Titulo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Titulo->Visible = FALSE; // Disable update for API request
			else
				$this->Titulo->setFormValue($val);
		}

		// Check field name 'Fecha_Prestamo' first before field var 'x_Fecha_Prestamo'
		$val = $CurrentForm->hasValue("Fecha_Prestamo") ? $CurrentForm->getValue("Fecha_Prestamo") : $CurrentForm->getValue("x_Fecha_Prestamo");
		if (!$this->Fecha_Prestamo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Fecha_Prestamo->Visible = FALSE; // Disable update for API request
			else
				$this->Fecha_Prestamo->setFormValue($val);
			$this->Fecha_Prestamo->CurrentValue = UnFormatDateTime($this->Fecha_Prestamo->CurrentValue, 0);
		}

		// Check field name 'Fecha_Devolucion' first before field var 'x_Fecha_Devolucion'
		$val = $CurrentForm->hasValue("Fecha_Devolucion") ? $CurrentForm->getValue("Fecha_Devolucion") : $CurrentForm->getValue("x_Fecha_Devolucion");
		if (!$this->Fecha_Devolucion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Fecha_Devolucion->Visible = FALSE; // Disable update for API request
			else
				$this->Fecha_Devolucion->setFormValue($val);
			$this->Fecha_Devolucion->CurrentValue = UnFormatDateTime($this->Fecha_Devolucion->CurrentValue, 0);
		}

		// Check field name 'Estado' first before field var 'x_Estado'
		$val = $CurrentForm->hasValue("Estado") ? $CurrentForm->getValue("Estado") : $CurrentForm->getValue("x_Estado");
		if (!$this->Estado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Estado->Visible = FALSE; // Disable update for API request
			else
				$this->Estado->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
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

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("Id_tran")) <> "")
			$this->Id_tran->CurrentValue = $this->getKey("Id_tran"); // Id_tran
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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Id_tran
			$this->Id_tran->EditAttrs["class"] = "form-control";
			$this->Id_tran->EditCustomAttributes = "";
			$this->Id_tran->EditValue = $this->Id_tran->CurrentValue;
			$this->Id_tran->ViewCustomAttributes = "";

			// CI_Lector
			$this->CI_Lector->EditAttrs["class"] = "form-control";
			$this->CI_Lector->EditCustomAttributes = "";
			$curVal = trim(strval($this->CI_Lector->CurrentValue));
			if ($curVal <> "")
				$this->CI_Lector->ViewValue = $this->CI_Lector->lookupCacheOption($curVal);
			else
				$this->CI_Lector->ViewValue = $this->CI_Lector->Lookup !== NULL && is_array($this->CI_Lector->Lookup->Options) ? $curVal : NULL;
			if ($this->CI_Lector->ViewValue !== NULL) { // Load from cache
				$this->CI_Lector->EditValue = array_values($this->CI_Lector->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CI_DNI`" . SearchString("=", $this->CI_Lector->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->CI_Lector->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->CI_Lector->EditValue = $arwrk;
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
			$this->Cod_libro->EditCustomAttributes = "";
			$curVal = trim(strval($this->Cod_libro->CurrentValue));
			if ($curVal <> "")
				$this->Cod_libro->ViewValue = $this->Cod_libro->lookupCacheOption($curVal);
			else
				$this->Cod_libro->ViewValue = $this->Cod_libro->Lookup !== NULL && is_array($this->Cod_libro->Lookup->Options) ? $curVal : NULL;
			if ($this->Cod_libro->ViewValue !== NULL) { // Load from cache
				$this->Cod_libro->EditValue = array_values($this->Cod_libro->Lookup->Options);
				if ($this->Cod_libro->ViewValue == "")
					$this->Cod_libro->ViewValue = $Language->Phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Codigo_Libro`" . SearchString("=", $this->Cod_libro->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Cod_libro->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
					$this->Cod_libro->ViewValue = $this->Cod_libro->displayValue($arwrk);
				} else {
					$this->Cod_libro->ViewValue = $Language->Phrase("PleaseSelect");
				}
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Cod_libro->EditValue = $arwrk;
			}

			// Titulo
			$this->Titulo->EditAttrs["class"] = "form-control";
			$this->Titulo->EditCustomAttributes = "";
			$this->Titulo->EditValue = HtmlEncode($this->Titulo->CurrentValue);
			$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

			// Fecha_Prestamo
			// Fecha_Devolucion
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

		// Initialize form error message
		$FormError = "";

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
		if ($this->Fecha_Devolucion->Required) {
			if (!$this->Fecha_Devolucion->IsDetailKey && $this->Fecha_Devolucion->FormValue != NULL && $this->Fecha_Devolucion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fecha_Devolucion->caption(), $this->Fecha_Devolucion->RequiredErrorMessage));
			}
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
			$this->Fecha_Prestamo->setDbValueDef($rsnew, CurrentDate(), NULL);
			$rsnew['Fecha_Prestamo'] = &$this->Fecha_Prestamo->DbValue;

			// Fecha_Devolucion
			$this->Fecha_Devolucion->setDbValueDef($rsnew, CurrentDate(), NULL);
			$rsnew['Fecha_Devolucion'] = &$this->Fecha_Devolucion->DbValue;

			// Estado
			$this->Estado->setDbValueDef($rsnew, $this->Estado->CurrentValue, NULL, $this->Estado->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_transaccionlist.php"), "", $this->TableVar, TRUE);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
