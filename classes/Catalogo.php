<?php
namespace PHPMaker2019\BIBLIOTECA;

/**
 * Table class for Catalogo
 */
class Catalogo extends DbTable
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
	public $Codigo_Libro;
	public $Titulo;
	public $Autor;
	public $Editorial;
	public $Edicion;
	public $Area;
	public $Categoria;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Catalogo';
		$this->TableName = 'Catalogo';
		$this->TableType = 'CUSTOMVIEW';

		// Update Table
		$this->UpdateTable = "t_libro";
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

		// Codigo_Libro
		$this->Codigo_Libro = new DbField('Catalogo', 'Catalogo', 'x_Codigo_Libro', 'Codigo_Libro', 't_libro.Codigo_Libro', 't_libro.Codigo_Libro', 200, -1, FALSE, 't_libro.Codigo_Libro', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Codigo_Libro->Sortable = TRUE; // Allow sort
		$this->fields['Codigo_Libro'] = &$this->Codigo_Libro;

		// Titulo
		$this->Titulo = new DbField('Catalogo', 'Catalogo', 'x_Titulo', 'Titulo', 't_libro.Titulo', 't_libro.Titulo', 200, -1, FALSE, 't_libro.Titulo', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Titulo->Nullable = FALSE; // NOT NULL field
		$this->Titulo->Required = TRUE; // Required field
		$this->Titulo->Sortable = TRUE; // Allow sort
		$this->fields['Titulo'] = &$this->Titulo;

		// Autor
		$this->Autor = new DbField('Catalogo', 'Catalogo', 'x_Autor', 'Autor', 't_libro.Autor', 't_libro.Autor', 200, -1, FALSE, 't_libro.Autor', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Autor->Nullable = FALSE; // NOT NULL field
		$this->Autor->Required = TRUE; // Required field
		$this->Autor->Sortable = TRUE; // Allow sort
		$this->fields['Autor'] = &$this->Autor;

		// Editorial
		$this->Editorial = new DbField('Catalogo', 'Catalogo', 'x_Editorial', 'Editorial', 't_libro.Editorial', 't_libro.Editorial', 200, -1, FALSE, 't_libro.Editorial', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Editorial->Sortable = TRUE; // Allow sort
		$this->fields['Editorial'] = &$this->Editorial;

		// Edicion
		$this->Edicion = new DbField('Catalogo', 'Catalogo', 'x_Edicion', 'Edicion', 't_libro.Edicion', 't_libro.Edicion', 3, -1, FALSE, 't_libro.Edicion', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Edicion->Sortable = TRUE; // Allow sort
		$this->Edicion->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['Edicion'] = &$this->Edicion;

		// Area
		$this->Area = new DbField('Catalogo', 'Catalogo', 'x_Area', 'Area', 't_libro.Area', 't_libro.Area', 200, -1, FALSE, 't_libro.Area', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Area->Nullable = FALSE; // NOT NULL field
		$this->Area->Required = TRUE; // Required field
		$this->Area->Sortable = TRUE; // Allow sort
		$this->Area->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Area->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->Area->Lookup = new Lookup('Area', 't_area', FALSE, 'Area', ["Area","","",""], [], [], [], [], [], '', '');
		$this->fields['Area'] = &$this->Area;

		// Categoria
		$this->Categoria = new DbField('Catalogo', 'Catalogo', 'x_Categoria', 'Categoria', 't_libro.Categoria', 't_libro.Categoria', 200, -1, FALSE, 't_libro.Categoria', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Categoria->Nullable = FALSE; // NOT NULL field
		$this->Categoria->Required = TRUE; // Required field
		$this->Categoria->Sortable = TRUE; // Allow sort
		$this->Categoria->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Categoria->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->Categoria->Lookup = new Lookup('Categoria', 't_categoria', FALSE, 'Categoria', ["Categoria","","",""], [], [], [], [], [], '', '');
		$this->fields['Categoria'] = &$this->Categoria;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "t_libro";
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
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT t_libro.Codigo_Libro, t_libro.Titulo, t_libro.Autor, t_libro.Editorial, t_libro.Edicion, t_libro.Area, t_libro.Categoria FROM " . $this->getSqlFrom();
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
		$this->Codigo_Libro->DbValue = $row['Codigo_Libro'];
		$this->Titulo->DbValue = $row['Titulo'];
		$this->Autor->DbValue = $row['Autor'];
		$this->Editorial->DbValue = $row['Editorial'];
		$this->Edicion->DbValue = $row['Edicion'];
		$this->Area->DbValue = $row['Area'];
		$this->Categoria->DbValue = $row['Categoria'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "Catalogolist.php";
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
		if ($pageName == "Catalogoview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "Catalogoedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "Catalogoadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Catalogolist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("Catalogoview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Catalogoview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "Catalogoadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Catalogoadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Catalogoedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("Catalogoadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("Catalogodelete.php", $this->getUrlParm());
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

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->Codigo_Libro->setDbValue($rs->fields('Codigo_Libro'));
		$this->Titulo->setDbValue($rs->fields('Titulo'));
		$this->Autor->setDbValue($rs->fields('Autor'));
		$this->Editorial->setDbValue($rs->fields('Editorial'));
		$this->Edicion->setDbValue($rs->fields('Edicion'));
		$this->Area->setDbValue($rs->fields('Area'));
		$this->Categoria->setDbValue($rs->fields('Categoria'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// Codigo_Libro
		// Titulo
		// Autor
		// Editorial
		// Edicion
		// Area
		// Categoria
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

		// Codigo_Libro
		$this->Codigo_Libro->EditAttrs["class"] = "form-control";
		$this->Codigo_Libro->EditCustomAttributes = "";
		$this->Codigo_Libro->EditValue = $this->Codigo_Libro->CurrentValue;
		$this->Codigo_Libro->PlaceHolder = RemoveHtml($this->Codigo_Libro->caption());

		// Titulo
		$this->Titulo->EditAttrs["class"] = "form-control";
		$this->Titulo->EditCustomAttributes = "";
		$this->Titulo->EditValue = $this->Titulo->CurrentValue;
		$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

		// Autor
		$this->Autor->EditAttrs["class"] = "form-control";
		$this->Autor->EditCustomAttributes = "";
		$this->Autor->EditValue = $this->Autor->CurrentValue;
		$this->Autor->PlaceHolder = RemoveHtml($this->Autor->caption());

		// Editorial
		$this->Editorial->EditAttrs["class"] = "form-control";
		$this->Editorial->EditCustomAttributes = "";
		$this->Editorial->EditValue = $this->Editorial->CurrentValue;
		$this->Editorial->PlaceHolder = RemoveHtml($this->Editorial->caption());

		// Edicion
		$this->Edicion->EditAttrs["class"] = "form-control";
		$this->Edicion->EditCustomAttributes = "";
		$this->Edicion->EditValue = $this->Edicion->CurrentValue;
		$this->Edicion->PlaceHolder = RemoveHtml($this->Edicion->caption());

		// Area
		$this->Area->EditAttrs["class"] = "form-control";
		$this->Area->EditCustomAttributes = "";

		// Categoria
		$this->Categoria->EditAttrs["class"] = "form-control";
		$this->Categoria->EditCustomAttributes = "";

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
					if ($this->Codigo_Libro->Exportable)
						$doc->exportCaption($this->Codigo_Libro);
					if ($this->Titulo->Exportable)
						$doc->exportCaption($this->Titulo);
					if ($this->Autor->Exportable)
						$doc->exportCaption($this->Autor);
					if ($this->Editorial->Exportable)
						$doc->exportCaption($this->Editorial);
					if ($this->Edicion->Exportable)
						$doc->exportCaption($this->Edicion);
					if ($this->Area->Exportable)
						$doc->exportCaption($this->Area);
					if ($this->Categoria->Exportable)
						$doc->exportCaption($this->Categoria);
				} else {
					if ($this->Codigo_Libro->Exportable)
						$doc->exportCaption($this->Codigo_Libro);
					if ($this->Titulo->Exportable)
						$doc->exportCaption($this->Titulo);
					if ($this->Autor->Exportable)
						$doc->exportCaption($this->Autor);
					if ($this->Editorial->Exportable)
						$doc->exportCaption($this->Editorial);
					if ($this->Edicion->Exportable)
						$doc->exportCaption($this->Edicion);
					if ($this->Area->Exportable)
						$doc->exportCaption($this->Area);
					if ($this->Categoria->Exportable)
						$doc->exportCaption($this->Categoria);
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
						if ($this->Codigo_Libro->Exportable)
							$doc->exportField($this->Codigo_Libro);
						if ($this->Titulo->Exportable)
							$doc->exportField($this->Titulo);
						if ($this->Autor->Exportable)
							$doc->exportField($this->Autor);
						if ($this->Editorial->Exportable)
							$doc->exportField($this->Editorial);
						if ($this->Edicion->Exportable)
							$doc->exportField($this->Edicion);
						if ($this->Area->Exportable)
							$doc->exportField($this->Area);
						if ($this->Categoria->Exportable)
							$doc->exportField($this->Categoria);
					} else {
						if ($this->Codigo_Libro->Exportable)
							$doc->exportField($this->Codigo_Libro);
						if ($this->Titulo->Exportable)
							$doc->exportField($this->Titulo);
						if ($this->Autor->Exportable)
							$doc->exportField($this->Autor);
						if ($this->Editorial->Exportable)
							$doc->exportField($this->Editorial);
						if ($this->Edicion->Exportable)
							$doc->exportField($this->Edicion);
						if ($this->Area->Exportable)
							$doc->exportField($this->Area);
						if ($this->Categoria->Exportable)
							$doc->exportField($this->Categoria);
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
