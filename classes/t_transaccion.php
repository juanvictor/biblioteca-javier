<?php
namespace PHPMaker2019\BIBLIOTECA;

/**
 * Table class for t_transaccion
 */
class t_transaccion extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $Id_tran;
	public $CI_Lector;
	public $Nombres;
	public $Apellidos;
	public $Cod_libro;
	public $Titulo;
	public $Fecha_Prestamo;
	public $Fecha_Devolucion;
	public $Estado;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_transaccion';
		$this->TableName = 't_transaccion';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_transaccion`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// Id_tran
		$this->Id_tran = new DbField('t_transaccion', 't_transaccion', 'x_Id_tran', 'Id_tran', '`Id_tran`', '`Id_tran`', 3, -1, FALSE, '`Id_tran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Id_tran->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Id_tran->IsPrimaryKey = TRUE; // Primary key field
		$this->Id_tran->Sortable = TRUE; // Allow sort
		$this->Id_tran->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['Id_tran'] = &$this->Id_tran;

		// CI_Lector
		$this->CI_Lector = new DbField('t_transaccion', 't_transaccion', 'x_CI_Lector', 'CI_Lector', '`CI_Lector`', '`CI_Lector`', 200, -1, FALSE, '`CI_Lector`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->CI_Lector->Nullable = FALSE; // NOT NULL field
		$this->CI_Lector->Required = TRUE; // Required field
		$this->CI_Lector->Sortable = TRUE; // Allow sort
		$this->CI_Lector->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->CI_Lector->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->CI_Lector->Lookup = new Lookup('CI_Lector', 't_lector', FALSE, 'CI_DNI', ["CI_DNI","","",""], [], [], [], ["Nombres","Apellidos"], ["x_Nombres","x_Apellidos"], '', '');
		$this->fields['CI_Lector'] = &$this->CI_Lector;

		// Nombres
		$this->Nombres = new DbField('t_transaccion', 't_transaccion', 'x_Nombres', 'Nombres', '`Nombres`', '`Nombres`', 200, -1, FALSE, '`Nombres`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nombres->Nullable = FALSE; // NOT NULL field
		$this->Nombres->Required = TRUE; // Required field
		$this->Nombres->Sortable = TRUE; // Allow sort
		$this->fields['Nombres'] = &$this->Nombres;

		// Apellidos
		$this->Apellidos = new DbField('t_transaccion', 't_transaccion', 'x_Apellidos', 'Apellidos', '`Apellidos`', '`Apellidos`', 200, -1, FALSE, '`Apellidos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Apellidos->Nullable = FALSE; // NOT NULL field
		$this->Apellidos->Required = TRUE; // Required field
		$this->Apellidos->Sortable = TRUE; // Allow sort
		$this->fields['Apellidos'] = &$this->Apellidos;

		// Cod_libro
		$this->Cod_libro = new DbField('t_transaccion', 't_transaccion', 'x_Cod_libro', 'Cod_libro', '`Cod_libro`', '`Cod_libro`', 200, -1, FALSE, '`Cod_libro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Cod_libro->Nullable = FALSE; // NOT NULL field
		$this->Cod_libro->Required = TRUE; // Required field
		$this->Cod_libro->Sortable = TRUE; // Allow sort
		$this->Cod_libro->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Cod_libro->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->Cod_libro->Lookup = new Lookup('Cod_libro', 't_libro', FALSE, 'Codigo_Libro', ["Codigo_Libro","Titulo","Autor",""], [], [], [], ["Titulo"], ["x_Titulo"], '', '');
		$this->fields['Cod_libro'] = &$this->Cod_libro;

		// Titulo
		$this->Titulo = new DbField('t_transaccion', 't_transaccion', 'x_Titulo', 'Titulo', '`Titulo`', '`Titulo`', 200, -1, FALSE, '`Titulo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Titulo->Nullable = FALSE; // NOT NULL field
		$this->Titulo->Required = TRUE; // Required field
		$this->Titulo->Sortable = TRUE; // Allow sort
		$this->fields['Titulo'] = &$this->Titulo;

		// Fecha_Prestamo
		$this->Fecha_Prestamo = new DbField('t_transaccion', 't_transaccion', 'x_Fecha_Prestamo', 'Fecha_Prestamo', '`Fecha_Prestamo`', CastDateFieldForLike('`Fecha_Prestamo`', 0, "DB"), 133, 0, FALSE, '`Fecha_Prestamo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fecha_Prestamo->Sortable = TRUE; // Allow sort
		$this->Fecha_Prestamo->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['Fecha_Prestamo'] = &$this->Fecha_Prestamo;

		// Fecha_Devolucion
		$this->Fecha_Devolucion = new DbField('t_transaccion', 't_transaccion', 'x_Fecha_Devolucion', 'Fecha_Devolucion', '`Fecha_Devolucion`', CastDateFieldForLike('`Fecha_Devolucion`', 0, "DB"), 133, 0, FALSE, '`Fecha_Devolucion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fecha_Devolucion->Sortable = TRUE; // Allow sort
		$this->Fecha_Devolucion->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['Fecha_Devolucion'] = &$this->Fecha_Devolucion;

		// Estado
		$this->Estado = new DbField('t_transaccion', 't_transaccion', 'x_Estado', 'Estado', '`Estado`', '`Estado`', 200, -1, FALSE, '`Estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Estado->Sortable = TRUE; // Allow sort
		$this->fields['Estado'] = &$this->Estado;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`t_transaccion`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
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

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->Id_tran->setDbValue($conn->insert_ID());
			$rs['Id_tran'] = $this->Id_tran->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('Id_tran', $rs))
				AddFilter($where, QuotedName('Id_tran', $this->Dbid) . '=' . QuotedValue($rs['Id_tran'], $this->Id_tran->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->Id_tran->DbValue = $row['Id_tran'];
		$this->CI_Lector->DbValue = $row['CI_Lector'];
		$this->Nombres->DbValue = $row['Nombres'];
		$this->Apellidos->DbValue = $row['Apellidos'];
		$this->Cod_libro->DbValue = $row['Cod_libro'];
		$this->Titulo->DbValue = $row['Titulo'];
		$this->Fecha_Prestamo->DbValue = $row['Fecha_Prestamo'];
		$this->Fecha_Devolucion->DbValue = $row['Fecha_Devolucion'];
		$this->Estado->DbValue = $row['Estado'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`Id_tran` = @Id_tran@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('Id_tran', $row) ? $row['Id_tran'] : NULL) : $this->Id_tran->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Id_tran@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
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
			return "t_transaccionlist.php";
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
		if ($pageName == "t_transaccionview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "t_transaccionedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "t_transaccionadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_transaccionlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("t_transaccionview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_transaccionview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "t_transaccionadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_transaccionadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_transaccionedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("t_transaccionadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("t_transacciondelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Id_tran:" . JsonEncode($this->Id_tran->CurrentValue, "number");
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
		if ($this->Id_tran->CurrentValue != NULL) {
			$url .= "Id_tran=" . urlencode($this->Id_tran->CurrentValue);
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
			if (Param("Id_tran") !== NULL)
				$arKeys[] = Param("Id_tran");
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
			$this->Id_tran->CurrentValue = $key;
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

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->Id_tran->setDbValue($rs->fields('Id_tran'));
		$this->CI_Lector->setDbValue($rs->fields('CI_Lector'));
		$this->Nombres->setDbValue($rs->fields('Nombres'));
		$this->Apellidos->setDbValue($rs->fields('Apellidos'));
		$this->Cod_libro->setDbValue($rs->fields('Cod_libro'));
		$this->Titulo->setDbValue($rs->fields('Titulo'));
		$this->Fecha_Prestamo->setDbValue($rs->fields('Fecha_Prestamo'));
		$this->Fecha_Devolucion->setDbValue($rs->fields('Fecha_Devolucion'));
		$this->Estado->setDbValue($rs->fields('Estado'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// Id_tran
		// CI_Lector
		// Nombres
		// Apellidos
		// Cod_libro
		// Titulo
		// Fecha_Prestamo
		// Fecha_Devolucion
		// Estado
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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Id_tran
		$this->Id_tran->EditAttrs["class"] = "form-control";
		$this->Id_tran->EditCustomAttributes = "";
		$this->Id_tran->EditValue = $this->Id_tran->CurrentValue;
		$this->Id_tran->ViewCustomAttributes = "";

		// CI_Lector
		$this->CI_Lector->EditAttrs["class"] = "form-control";
		$this->CI_Lector->EditCustomAttributes = "";

		// Nombres
		$this->Nombres->EditAttrs["class"] = "form-control";
		$this->Nombres->EditCustomAttributes = "";
		$this->Nombres->EditValue = $this->Nombres->CurrentValue;
		$this->Nombres->PlaceHolder = RemoveHtml($this->Nombres->caption());

		// Apellidos
		$this->Apellidos->EditAttrs["class"] = "form-control";
		$this->Apellidos->EditCustomAttributes = "";
		$this->Apellidos->EditValue = $this->Apellidos->CurrentValue;
		$this->Apellidos->PlaceHolder = RemoveHtml($this->Apellidos->caption());

		// Cod_libro
		$this->Cod_libro->EditAttrs["class"] = "form-control";
		$this->Cod_libro->EditCustomAttributes = "";

		// Titulo
		$this->Titulo->EditAttrs["class"] = "form-control";
		$this->Titulo->EditCustomAttributes = "";
		$this->Titulo->EditValue = $this->Titulo->CurrentValue;
		$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

		// Fecha_Prestamo
		// Fecha_Devolucion
		// Estado

		$this->Estado->EditAttrs["class"] = "form-control";
		$this->Estado->EditCustomAttributes = "";
		$this->Estado->EditValue = $this->Estado->CurrentValue;
		$this->Estado->PlaceHolder = RemoveHtml($this->Estado->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					if ($this->Id_tran->Exportable)
						$doc->exportCaption($this->Id_tran);
					if ($this->CI_Lector->Exportable)
						$doc->exportCaption($this->CI_Lector);
					if ($this->Nombres->Exportable)
						$doc->exportCaption($this->Nombres);
					if ($this->Apellidos->Exportable)
						$doc->exportCaption($this->Apellidos);
					if ($this->Cod_libro->Exportable)
						$doc->exportCaption($this->Cod_libro);
					if ($this->Titulo->Exportable)
						$doc->exportCaption($this->Titulo);
					if ($this->Fecha_Prestamo->Exportable)
						$doc->exportCaption($this->Fecha_Prestamo);
					if ($this->Fecha_Devolucion->Exportable)
						$doc->exportCaption($this->Fecha_Devolucion);
					if ($this->Estado->Exportable)
						$doc->exportCaption($this->Estado);
				} else {
					if ($this->Id_tran->Exportable)
						$doc->exportCaption($this->Id_tran);
					if ($this->CI_Lector->Exportable)
						$doc->exportCaption($this->CI_Lector);
					if ($this->Nombres->Exportable)
						$doc->exportCaption($this->Nombres);
					if ($this->Apellidos->Exportable)
						$doc->exportCaption($this->Apellidos);
					if ($this->Cod_libro->Exportable)
						$doc->exportCaption($this->Cod_libro);
					if ($this->Titulo->Exportable)
						$doc->exportCaption($this->Titulo);
					if ($this->Fecha_Prestamo->Exportable)
						$doc->exportCaption($this->Fecha_Prestamo);
					if ($this->Fecha_Devolucion->Exportable)
						$doc->exportCaption($this->Fecha_Devolucion);
					if ($this->Estado->Exportable)
						$doc->exportCaption($this->Estado);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						if ($this->Id_tran->Exportable)
							$doc->exportField($this->Id_tran);
						if ($this->CI_Lector->Exportable)
							$doc->exportField($this->CI_Lector);
						if ($this->Nombres->Exportable)
							$doc->exportField($this->Nombres);
						if ($this->Apellidos->Exportable)
							$doc->exportField($this->Apellidos);
						if ($this->Cod_libro->Exportable)
							$doc->exportField($this->Cod_libro);
						if ($this->Titulo->Exportable)
							$doc->exportField($this->Titulo);
						if ($this->Fecha_Prestamo->Exportable)
							$doc->exportField($this->Fecha_Prestamo);
						if ($this->Fecha_Devolucion->Exportable)
							$doc->exportField($this->Fecha_Devolucion);
						if ($this->Estado->Exportable)
							$doc->exportField($this->Estado);
					} else {
						if ($this->Id_tran->Exportable)
							$doc->exportField($this->Id_tran);
						if ($this->CI_Lector->Exportable)
							$doc->exportField($this->CI_Lector);
						if ($this->Nombres->Exportable)
							$doc->exportField($this->Nombres);
						if ($this->Apellidos->Exportable)
							$doc->exportField($this->Apellidos);
						if ($this->Cod_libro->Exportable)
							$doc->exportField($this->Cod_libro);
						if ($this->Titulo->Exportable)
							$doc->exportField($this->Titulo);
						if ($this->Fecha_Prestamo->Exportable)
							$doc->exportField($this->Fecha_Prestamo);
						if ($this->Fecha_Devolucion->Exportable)
							$doc->exportField($this->Fecha_Devolucion);
						if ($this->Estado->Exportable)
							$doc->exportField($this->Estado);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					$validRequest = $Security->isLoggedIn(); // Logged in
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$validRequest = $Security->isLoggedIn(); // Logged in
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = (Post("distinct") === "1");
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		$lookup->FilterValues[] = rawurldecode(Post("v0", Post("lookupValue", ""))); // Lookup values
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = rawurldecode(Post("v" . $i, ""));
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

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
