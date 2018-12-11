<?php
namespace PHPMaker2019\BIBLIOTECA;

//
// Page class
//
class t_libro_search extends t_libro
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E6872B47-A984-4C9A-BBE6-E4ECB78C3960}";

	// Table name
	public $TableName = 't_libro';

	// Page object name
	public $PageObjName = "t_libro_search";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

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
			if (!$Security->canSearch()) {
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
		$this->Id_libro->setVisibility();
		$this->Codigo_Libro->setVisibility();
		$this->Titulo->setVisibility();
		$this->Autor->setVisibility();
		$this->Editorial->setVisibility();
		$this->Fecha_publicacion->setVisibility();
		$this->Edicion->setVisibility();
		$this->Area->setVisibility();
		$this->Categoria->setVisibility();
		$this->Palabras_Claves->setVisibility();
		$this->N_copias->setVisibility();
		$this->Codigo_Area->Visible = FALSE;
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

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr <> "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "t_librolist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->Id_libro); // Id_libro
		$this->buildSearchUrl($srchUrl, $this->Codigo_Libro); // Codigo_Libro
		$this->buildSearchUrl($srchUrl, $this->Titulo); // Titulo
		$this->buildSearchUrl($srchUrl, $this->Autor); // Autor
		$this->buildSearchUrl($srchUrl, $this->Editorial); // Editorial
		$this->buildSearchUrl($srchUrl, $this->Fecha_publicacion); // Fecha_publicacion
		$this->buildSearchUrl($srchUrl, $this->Edicion); // Edicion
		$this->buildSearchUrl($srchUrl, $this->Area); // Area
		$this->buildSearchUrl($srchUrl, $this->Categoria); // Categoria
		$this->buildSearchUrl($srchUrl, $this->Palabras_Claves); // Palabras_Claves
		$this->buildSearchUrl($srchUrl, $this->N_copias); // N_copias
		if ($srchUrl <> "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal <> "" && $fldVal2 <> "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal <> "" && $isValidValue && IsValidOpr($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr <> "" && $oprOnly && IsValidOpr($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 <> "" && $isValidValue && IsValidOpr($fldOpr2, $fldDataType)) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 <> "" && $oprOnly && IsValidOpr($fldOpr2, $fldDataType))) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk <> "") {
			if ($url <> "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// Id_libro

		$this->Id_libro->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Id_libro"));
		$this->Id_libro->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Id_libro"));

		// Codigo_Libro
		$this->Codigo_Libro->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Codigo_Libro"));
		$this->Codigo_Libro->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Codigo_Libro"));

		// Titulo
		$this->Titulo->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Titulo"));
		$this->Titulo->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Titulo"));

		// Autor
		$this->Autor->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Autor"));
		$this->Autor->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Autor"));

		// Editorial
		$this->Editorial->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Editorial"));
		$this->Editorial->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Editorial"));

		// Fecha_publicacion
		$this->Fecha_publicacion->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Fecha_publicacion"));
		$this->Fecha_publicacion->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Fecha_publicacion"));

		// Edicion
		$this->Edicion->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Edicion"));
		$this->Edicion->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Edicion"));

		// Area
		$this->Area->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Area"));
		$this->Area->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Area"));

		// Categoria
		$this->Categoria->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Categoria"));
		$this->Categoria->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Categoria"));

		// Palabras_Claves
		$this->Palabras_Claves->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Palabras_Claves"));
		$this->Palabras_Claves->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Palabras_Claves"));

		// N_copias
		$this->N_copias->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_N_copias"));
		$this->N_copias->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_N_copias"));
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

			// Palabras_Claves
			$this->Palabras_Claves->ViewValue = $this->Palabras_Claves->CurrentValue;
			$this->Palabras_Claves->ViewCustomAttributes = "";

			// N_copias
			$this->N_copias->ViewValue = $this->N_copias->CurrentValue;
			$this->N_copias->ViewValue = FormatNumber($this->N_copias->ViewValue, 0, -2, -2, -2);
			$this->N_copias->ViewCustomAttributes = "";

			// Id_libro
			$this->Id_libro->LinkCustomAttributes = "";
			$this->Id_libro->HrefValue = "";
			$this->Id_libro->TooltipValue = "";

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

			// Palabras_Claves
			$this->Palabras_Claves->LinkCustomAttributes = "";
			$this->Palabras_Claves->HrefValue = "";
			$this->Palabras_Claves->TooltipValue = "";

			// N_copias
			$this->N_copias->LinkCustomAttributes = "";
			$this->N_copias->HrefValue = "";
			$this->N_copias->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// Id_libro
			$this->Id_libro->EditAttrs["class"] = "form-control";
			$this->Id_libro->EditCustomAttributes = "";
			$this->Id_libro->EditValue = HtmlEncode($this->Id_libro->AdvancedSearch->SearchValue);
			$this->Id_libro->PlaceHolder = RemoveHtml($this->Id_libro->caption());

			// Codigo_Libro
			$this->Codigo_Libro->EditAttrs["class"] = "form-control";
			$this->Codigo_Libro->EditCustomAttributes = "";
			$this->Codigo_Libro->EditValue = HtmlEncode($this->Codigo_Libro->AdvancedSearch->SearchValue);
			$this->Codigo_Libro->PlaceHolder = RemoveHtml($this->Codigo_Libro->caption());

			// Titulo
			$this->Titulo->EditAttrs["class"] = "form-control";
			$this->Titulo->EditCustomAttributes = "";
			$this->Titulo->EditValue = HtmlEncode($this->Titulo->AdvancedSearch->SearchValue);
			$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

			// Autor
			$this->Autor->EditAttrs["class"] = "form-control";
			$this->Autor->EditCustomAttributes = "";
			$this->Autor->EditValue = HtmlEncode($this->Autor->AdvancedSearch->SearchValue);
			$this->Autor->PlaceHolder = RemoveHtml($this->Autor->caption());

			// Editorial
			$this->Editorial->EditAttrs["class"] = "form-control";
			$this->Editorial->EditCustomAttributes = "";
			$this->Editorial->EditValue = HtmlEncode($this->Editorial->AdvancedSearch->SearchValue);
			$this->Editorial->PlaceHolder = RemoveHtml($this->Editorial->caption());

			// Fecha_publicacion
			$this->Fecha_publicacion->EditAttrs["class"] = "form-control";
			$this->Fecha_publicacion->EditCustomAttributes = "";
			$this->Fecha_publicacion->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->Fecha_publicacion->AdvancedSearch->SearchValue, 0), 8));
			$this->Fecha_publicacion->PlaceHolder = RemoveHtml($this->Fecha_publicacion->caption());

			// Edicion
			$this->Edicion->EditAttrs["class"] = "form-control";
			$this->Edicion->EditCustomAttributes = "";
			$this->Edicion->EditValue = HtmlEncode($this->Edicion->AdvancedSearch->SearchValue);
			$this->Edicion->PlaceHolder = RemoveHtml($this->Edicion->caption());

			// Area
			$this->Area->EditAttrs["class"] = "form-control";
			$this->Area->EditCustomAttributes = "";
			$curVal = trim(strval($this->Area->AdvancedSearch->SearchValue));
			if ($curVal <> "")
				$this->Area->AdvancedSearch->ViewValue = $this->Area->lookupCacheOption($curVal);
			else
				$this->Area->AdvancedSearch->ViewValue = $this->Area->Lookup !== NULL && is_array($this->Area->Lookup->Options) ? $curVal : NULL;
			if ($this->Area->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Area->EditValue = array_values($this->Area->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Area`" . SearchString("=", $this->Area->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
			$curVal = trim(strval($this->Categoria->AdvancedSearch->SearchValue));
			if ($curVal <> "")
				$this->Categoria->AdvancedSearch->ViewValue = $this->Categoria->lookupCacheOption($curVal);
			else
				$this->Categoria->AdvancedSearch->ViewValue = $this->Categoria->Lookup !== NULL && is_array($this->Categoria->Lookup->Options) ? $curVal : NULL;
			if ($this->Categoria->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Categoria->EditValue = array_values($this->Categoria->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Categoria`" . SearchString("=", $this->Categoria->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
			$this->Palabras_Claves->EditValue = HtmlEncode($this->Palabras_Claves->AdvancedSearch->SearchValue);
			$this->Palabras_Claves->PlaceHolder = RemoveHtml($this->Palabras_Claves->caption());

			// N_copias
			$this->N_copias->EditAttrs["class"] = "form-control";
			$this->N_copias->EditCustomAttributes = "";
			$this->N_copias->EditValue = HtmlEncode($this->N_copias->AdvancedSearch->SearchValue);
			$this->N_copias->PlaceHolder = RemoveHtml($this->N_copias->caption());
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
		if (!CheckInteger($this->Id_libro->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Id_libro->errorMessage());
		}
		if (!CheckDate($this->Fecha_publicacion->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Fecha_publicacion->errorMessage());
		}
		if (!CheckInteger($this->Edicion->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Edicion->errorMessage());
		}
		if (!CheckInteger($this->N_copias->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->N_copias->errorMessage());
		}

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("t_librolist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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
