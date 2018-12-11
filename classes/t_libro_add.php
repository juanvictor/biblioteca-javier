<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class t_libro_add extends t_libro
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 't_libro';

	// Page object name
	public $PageObjName = "t_libro_add";

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

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "t_libroview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("t_librolist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Id_libro->Visible = FALSE;
		$this->Codigo_Libro->Visible = FALSE;
		$this->Titulo->setVisibility();
		$this->Autor->setVisibility();
		$this->Editorial->setVisibility();
		$this->Fecha_publicacion->setVisibility();
		$this->Edicion->setVisibility();
		$this->Area->setVisibility();
		$this->Codigo_Area->setVisibility();
		$this->Categoria->setVisibility();
		$this->Palabras_Claves->setVisibility();
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

		// Set up lookup cache
		$this->setupLookupOptions($this->Area);
		$this->setupLookupOptions($this->Categoria);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("Id_libro") !== NULL) {
				$this->Id_libro->setQueryStringValue(Get("Id_libro"));
				$this->setKey("Id_libro", $this->Id_libro->CurrentValue); // Set up key
			} else {
				$this->setKey("Id_libro", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi())
					$this->terminate();
				else
					$this->CurrentAction = "show"; // Form error, reset action
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->terminate("t_librolist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "t_librolist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "t_libroview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) // Return to caller
						$this->terminate(TRUE);
					else
						$this->terminate($returnUrl);
				} elseif (IsApi()) { // API request, return
					$this->terminate();
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
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

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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

		// Check field name 'Codigo_Area' first before field var 'x_Codigo_Area'
		$val = $CurrentForm->hasValue("Codigo_Area") ? $CurrentForm->getValue("Codigo_Area") : $CurrentForm->getValue("x_Codigo_Area");
		if (!$this->Codigo_Area->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Codigo_Area->Visible = FALSE; // Disable update for API request
			else
				$this->Codigo_Area->setFormValue($val);
		}

		// Check field name 'Categoria' first before field var 'x_Categoria'
		$val = $CurrentForm->hasValue("Categoria") ? $CurrentForm->getValue("Categoria") : $CurrentForm->getValue("x_Categoria");
		if (!$this->Categoria->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Categoria->Visible = FALSE; // Disable update for API request
			else
				$this->Categoria->setFormValue($val);
		}

		// Check field name 'Palabras_Claves' first before field var 'x_Palabras_Claves'
		$val = $CurrentForm->hasValue("Palabras_Claves") ? $CurrentForm->getValue("Palabras_Claves") : $CurrentForm->getValue("x_Palabras_Claves");
		if (!$this->Palabras_Claves->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Palabras_Claves->Visible = FALSE; // Disable update for API request
			else
				$this->Palabras_Claves->setFormValue($val);
		}

		// Check field name 'N_copias' first before field var 'x_N_copias'
		$val = $CurrentForm->hasValue("N_copias") ? $CurrentForm->getValue("N_copias") : $CurrentForm->getValue("x_N_copias");
		if (!$this->N_copias->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->N_copias->Visible = FALSE; // Disable update for API request
			else
				$this->N_copias->setFormValue($val);
		}

		// Check field name 'Id_libro' first before field var 'x_Id_libro'
		$val = $CurrentForm->hasValue("Id_libro") ? $CurrentForm->getValue("Id_libro") : $CurrentForm->getValue("x_Id_libro");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Titulo->CurrentValue = $this->Titulo->FormValue;
		$this->Autor->CurrentValue = $this->Autor->FormValue;
		$this->Editorial->CurrentValue = $this->Editorial->FormValue;
		$this->Fecha_publicacion->CurrentValue = $this->Fecha_publicacion->FormValue;
		$this->Fecha_publicacion->CurrentValue = UnFormatDateTime($this->Fecha_publicacion->CurrentValue, 0);
		$this->Edicion->CurrentValue = $this->Edicion->FormValue;
		$this->Area->CurrentValue = $this->Area->FormValue;
		$this->Codigo_Area->CurrentValue = $this->Codigo_Area->FormValue;
		$this->Categoria->CurrentValue = $this->Categoria->FormValue;
		$this->Palabras_Claves->CurrentValue = $this->Palabras_Claves->FormValue;
		$this->N_copias->CurrentValue = $this->N_copias->FormValue;
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

			// Codigo_Area
			$this->Codigo_Area->ViewValue = $this->Codigo_Area->CurrentValue;
			$this->Codigo_Area->ViewValue = FormatNumber($this->Codigo_Area->ViewValue, 0, -2, -2, -2);
			$this->Codigo_Area->ViewCustomAttributes = "";

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

			// Palabras_Claves
			$this->Palabras_Claves->ViewValue = $this->Palabras_Claves->CurrentValue;
			$this->Palabras_Claves->ViewCustomAttributes = "";

			// N_copias
			$this->N_copias->ViewValue = $this->N_copias->CurrentValue;
			$this->N_copias->ViewValue = FormatNumber($this->N_copias->ViewValue, 0, -2, -2, -2);
			$this->N_copias->ViewCustomAttributes = "";

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

			// Codigo_Area
			$this->Codigo_Area->LinkCustomAttributes = "";
			$this->Codigo_Area->HrefValue = "";
			$this->Codigo_Area->TooltipValue = "";

			// Categoria
			$this->Categoria->LinkCustomAttributes = "";
			$this->Categoria->HrefValue = "";
			$this->Categoria->TooltipValue = "";

			// Palabras_Claves
			$this->Palabras_Claves->LinkCustomAttributes = "";
			$this->Palabras_Claves->HrefValue = "";
			$this->Palabras_Claves->TooltipValue = "";

			// N_copias
			$this->N_copias->LinkCustomAttributes = "";
			$this->N_copias->HrefValue = "";
			$this->N_copias->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// Codigo_Area
			$this->Codigo_Area->EditAttrs["class"] = "form-control";
			$this->Codigo_Area->EditCustomAttributes = "";
			$this->Codigo_Area->EditValue = HtmlEncode($this->Codigo_Area->CurrentValue);
			$this->Codigo_Area->PlaceHolder = RemoveHtml($this->Codigo_Area->caption());

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

			// Palabras_Claves
			$this->Palabras_Claves->EditAttrs["class"] = "form-control";
			$this->Palabras_Claves->EditCustomAttributes = "";
			$this->Palabras_Claves->EditValue = HtmlEncode($this->Palabras_Claves->CurrentValue);
			$this->Palabras_Claves->PlaceHolder = RemoveHtml($this->Palabras_Claves->caption());

			// N_copias
			$this->N_copias->EditAttrs["class"] = "form-control";
			$this->N_copias->EditCustomAttributes = "";
			$this->N_copias->EditValue = HtmlEncode($this->N_copias->CurrentValue);
			$this->N_copias->PlaceHolder = RemoveHtml($this->N_copias->caption());

			// Add refer script
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

			// Codigo_Area
			$this->Codigo_Area->LinkCustomAttributes = "";
			$this->Codigo_Area->HrefValue = "";

			// Categoria
			$this->Categoria->LinkCustomAttributes = "";
			$this->Categoria->HrefValue = "";

			// Palabras_Claves
			$this->Palabras_Claves->LinkCustomAttributes = "";
			$this->Palabras_Claves->HrefValue = "";

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
		if (!CheckInteger($this->Codigo_Area->FormValue)) {
			AddMessage($FormError, $this->Codigo_Area->errorMessage());
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

		// Codigo_Area
		$this->Codigo_Area->setDbValueDef($rsnew, $this->Codigo_Area->CurrentValue, 0, FALSE);

		// Categoria
		$this->Categoria->setDbValueDef($rsnew, $this->Categoria->CurrentValue, "", FALSE);

		// Palabras_Claves
		$this->Palabras_Claves->setDbValueDef($rsnew, $this->Palabras_Claves->CurrentValue, "", FALSE);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_librolist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
}
?>
