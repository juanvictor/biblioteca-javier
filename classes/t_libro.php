<?php
namespace PHPMaker2019\BIBLIOTECA;

/**
 * Table class for t_libro
 */
class t_libro extends DbTable
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
	public $Id_libro;
	public $Codigo_Libro;
	public $Titulo;
	public $Autor;
	public $Editorial;
	public $Fecha_publicacion;
	public $Edicion;
	public $Area;
	public $Categoria;
	public $Palabras_Claves;
	public $N_copias;
	public $Codigo_Area;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_libro';
		$this->TableName = 't_libro';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_libro`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "legal"; // Page size (PDF only)
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

		// Id_libro
		$this->Id_libro = new DbField('t_libro', 't_libro', 'x_Id_libro', 'Id_libro', '`Id_libro`', '`Id_libro`', 3, -1, FALSE, '`Id_libro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->Id_libro->IsAutoIncrement = TRUE; // Autoincrement field
		$this->Id_libro->IsPrimaryKey = TRUE; // Primary key field
		$this->Id_libro->Sortable = TRUE; // Allow sort
		$this->Id_libro->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['Id_libro'] = &$this->Id_libro;

		// Codigo_Libro
		$this->Codigo_Libro = new DbField('t_libro', 't_libro', 'x_Codigo_Libro', 'Codigo_Libro', '`Codigo_Libro`', '`Codigo_Libro`', 200, -1, FALSE, '`Codigo_Libro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Codigo_Libro->Sortable = TRUE; // Allow sort
		$this->fields['Codigo_Libro'] = &$this->Codigo_Libro;

		// Titulo
		$this->Titulo = new DbField('t_libro', 't_libro', 'x_Titulo', 'Titulo', '`Titulo`', '`Titulo`', 200, -1, FALSE, '`Titulo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Titulo->Nullable = FALSE; // NOT NULL field
		$this->Titulo->Required = TRUE; // Required field
		$this->Titulo->Sortable = TRUE; // Allow sort
		$this->fields['Titulo'] = &$this->Titulo;

		// Autor
		$this->Autor = new DbField('t_libro', 't_libro', 'x_Autor', 'Autor', '`Autor`', '`Autor`', 200, -1, FALSE, '`Autor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Autor->Nullable = FALSE; // NOT NULL field
		$this->Autor->Required = TRUE; // Required field
		$this->Autor->Sortable = TRUE; // Allow sort
		$this->fields['Autor'] = &$this->Autor;

		// Editorial
		$this->Editorial = new DbField('t_libro', 't_libro', 'x_Editorial', 'Editorial', '`Editorial`', '`Editorial`', 200, -1, FALSE, '`Editorial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Editorial->Sortable = TRUE; // Allow sort
		$this->fields['Editorial'] = &$this->Editorial;

		// Fecha_publicacion
		$this->Fecha_publicacion = new DbField('t_libro', 't_libro', 'x_Fecha_publicacion', 'Fecha_publicacion', '`Fecha_publicacion`', CastDateFieldForLike('`Fecha_publicacion`', 0, "DB"), 133, 0, FALSE, '`Fecha_publicacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Fecha_publicacion->Sortable = TRUE; // Allow sort
		$this->Fecha_publicacion->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['Fecha_publicacion'] = &$this->Fecha_publicacion;

		// Edicion
		$this->Edicion = new DbField('t_libro', 't_libro', 'x_Edicion', 'Edicion', '`Edicion`', '`Edicion`', 3, -1, FALSE, '`Edicion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Edicion->Sortable = TRUE; // Allow sort
		$this->Edicion->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['Edicion'] = &$this->Edicion;

		// Area
		$this->Area = new DbField('t_libro', 't_libro', 'x_Area', 'Area', '`Area`', '`Area`', 200, -1, FALSE, '`Area`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Area->Nullable = FALSE; // NOT NULL field
		$this->Area->Required = TRUE; // Required field
		$this->Area->Sortable = TRUE; // Allow sort
		$this->Area->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Area->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->Area->Lookup = new Lookup('Area', 't_area', FALSE, 'Area', ["Area","","",""], [], [], [], ["Id_area"], ["x_Codigo_Area"], '', '');
		$this->fields['Area'] = &$this->Area;

		// Categoria
		$this->Categoria = new DbField('t_libro', 't_libro', 'x_Categoria', 'Categoria', '`Categoria`', '`Categoria`', 200, -1, FALSE, '`Categoria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Categoria->Nullable = FALSE; // NOT NULL field
		$this->Categoria->Required = TRUE; // Required field
		$this->Categoria->Sortable = TRUE; // Allow sort
		$this->Categoria->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Categoria->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->Categoria->Lookup = new Lookup('Categoria', 't_categoria', FALSE, 'Categoria', ["Categoria","","",""], [], [], [], [], [], '', '');
		$this->fields['Categoria'] = &$this->Categoria;

		// Palabras_Claves
		$this->Palabras_Claves = new DbField('t_libro', 't_libro', 'x_Palabras_Claves', 'Palabras_Claves', '`Palabras_Claves`', '`Palabras_Claves`', 201, -1, FALSE, '`Palabras_Claves`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Palabras_Claves->Nullable = FALSE; // NOT NULL field
		$this->Palabras_Claves->Sortable = TRUE; // Allow sort
		$this->fields['Palabras_Claves'] = &$this->Palabras_Claves;

		// N_copias
		$this->N_copias = new DbField('t_libro', 't_libro', 'x_N_copias', 'N_copias', '`N_copias`', '`N_copias`', 3, -1, FALSE, '`N_copias`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->N_copias->Nullable = FALSE; // NOT NULL field
		$this->N_copias->Required = TRUE; // Required field
		$this->N_copias->Sortable = TRUE; // Allow sort
		$this->N_copias->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['N_copias'] = &$this->N_copias;

		// Codigo_Area
		$this->Codigo_Area = new DbField('t_libro', 't_libro', 'x_Codigo_Area', 'Codigo_Area', '`Codigo_Area`', '`Codigo_Area`', 3, -1, FALSE, '`Codigo_Area`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Codigo_Area->Nullable = FALSE; // NOT NULL field
		$this->Codigo_Area->Sortable = FALSE; // Allow sort
		$this->Codigo_Area->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['Codigo_Area'] = &$this->Codigo_Area;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`t_libro`";
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
			$this->Id_libro->setDbValue($conn->insert_ID());
			$rs['Id_libro'] = $this->Id_libro->DbValue;
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
			if (array_key_exists('Id_libro', $rs))
				AddFilter($where, QuotedName('Id_libro', $this->Dbid) . '=' . QuotedValue($rs['Id_libro'], $this->Id_libro->DataType, $this->Dbid));
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
		$this->Id_libro->DbValue = $row['Id_libro'];
		$this->Codigo_Libro->DbValue = $row['Codigo_Libro'];
		$this->Titulo->DbValue = $row['Titulo'];
		$this->Autor->DbValue = $row['Autor'];
		$this->Editorial->DbValue = $row['Editorial'];
		$this->Fecha_publicacion->DbValue = $row['Fecha_publicacion'];
		$this->Edicion->DbValue = $row['Edicion'];
		$this->Area->DbValue = $row['Area'];
		$this->Categoria->DbValue = $row['Categoria'];
		$this->Palabras_Claves->DbValue = $row['Palabras_Claves'];
		$this->N_copias->DbValue = $row['N_copias'];
		$this->Codigo_Area->DbValue = $row['Codigo_Area'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`Id_libro` = @Id_libro@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('Id_libro', $row) ? $row['Id_libro'] : NULL) : $this->Id_libro->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@Id_libro@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "t_librolist.php";
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
		if ($pageName == "t_libroview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "t_libroedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "t_libroadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_librolist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("t_libroview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_libroview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "t_libroadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_libroadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_libroedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("t_libroadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("t_librodelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "Id_libro:" . JsonEncode($this->Id_libro->CurrentValue, "number");
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
		if ($this->Id_libro->CurrentValue != NULL) {
			$url .= "Id_libro=" . urlencode($this->Id_libro->CurrentValue);
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
			if (Param("Id_libro") !== NULL)
				$arKeys[] = Param("Id_libro");
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
			$this->Id_libro->CurrentValue = $key;
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
		$this->Id_libro->setDbValue($rs->fields('Id_libro'));
		$this->Codigo_Libro->setDbValue($rs->fields('Codigo_Libro'));
		$this->Titulo->setDbValue($rs->fields('Titulo'));
		$this->Autor->setDbValue($rs->fields('Autor'));
		$this->Editorial->setDbValue($rs->fields('Editorial'));
		$this->Fecha_publicacion->setDbValue($rs->fields('Fecha_publicacion'));
		$this->Edicion->setDbValue($rs->fields('Edicion'));
		$this->Area->setDbValue($rs->fields('Area'));
		$this->Categoria->setDbValue($rs->fields('Categoria'));
		$this->Palabras_Claves->setDbValue($rs->fields('Palabras_Claves'));
		$this->N_copias->setDbValue($rs->fields('N_copias'));
		$this->Codigo_Area->setDbValue($rs->fields('Codigo_Area'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
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

		// Codigo_Area
		$this->Codigo_Area->ViewValue = $this->Codigo_Area->CurrentValue;
		$this->Codigo_Area->ViewValue = FormatNumber($this->Codigo_Area->ViewValue, 0, -2, -2, -2);
		$this->Codigo_Area->ViewCustomAttributes = "";

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

		// Codigo_Area
		$this->Codigo_Area->LinkCustomAttributes = "";
		$this->Codigo_Area->HrefValue = "";
		$this->Codigo_Area->TooltipValue = "";

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

		// Id_libro
		$this->Id_libro->EditAttrs["class"] = "form-control";
		$this->Id_libro->EditCustomAttributes = "";
		$this->Id_libro->EditValue = $this->Id_libro->CurrentValue;
		$this->Id_libro->ViewCustomAttributes = "";

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

		// Fecha_publicacion
		$this->Fecha_publicacion->EditAttrs["class"] = "form-control";
		$this->Fecha_publicacion->EditCustomAttributes = "";
		$this->Fecha_publicacion->EditValue = FormatDateTime($this->Fecha_publicacion->CurrentValue, 8);
		$this->Fecha_publicacion->PlaceHolder = RemoveHtml($this->Fecha_publicacion->caption());

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

		// Palabras_Claves
		$this->Palabras_Claves->EditAttrs["class"] = "form-control";
		$this->Palabras_Claves->EditCustomAttributes = "";
		$this->Palabras_Claves->EditValue = $this->Palabras_Claves->CurrentValue;
		$this->Palabras_Claves->PlaceHolder = RemoveHtml($this->Palabras_Claves->caption());

		// N_copias
		$this->N_copias->EditAttrs["class"] = "form-control";
		$this->N_copias->EditCustomAttributes = "";
		$this->N_copias->EditValue = $this->N_copias->CurrentValue;
		$this->N_copias->PlaceHolder = RemoveHtml($this->N_copias->caption());

		// Codigo_Area
		$this->Codigo_Area->EditAttrs["class"] = "form-control";
		$this->Codigo_Area->EditCustomAttributes = "";
		$this->Codigo_Area->EditValue = $this->Codigo_Area->CurrentValue;
		$this->Codigo_Area->PlaceHolder = RemoveHtml($this->Codigo_Area->caption());

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
					if ($this->Id_libro->Exportable)
						$doc->exportCaption($this->Id_libro);
					if ($this->Codigo_Libro->Exportable)
						$doc->exportCaption($this->Codigo_Libro);
					if ($this->Titulo->Exportable)
						$doc->exportCaption($this->Titulo);
					if ($this->Autor->Exportable)
						$doc->exportCaption($this->Autor);
					if ($this->Editorial->Exportable)
						$doc->exportCaption($this->Editorial);
					if ($this->Fecha_publicacion->Exportable)
						$doc->exportCaption($this->Fecha_publicacion);
					if ($this->Edicion->Exportable)
						$doc->exportCaption($this->Edicion);
					if ($this->Area->Exportable)
						$doc->exportCaption($this->Area);
					if ($this->Categoria->Exportable)
						$doc->exportCaption($this->Categoria);
					if ($this->Palabras_Claves->Exportable)
						$doc->exportCaption($this->Palabras_Claves);
					if ($this->N_copias->Exportable)
						$doc->exportCaption($this->N_copias);
				} else {
					if ($this->Id_libro->Exportable)
						$doc->exportCaption($this->Id_libro);
					if ($this->Codigo_Libro->Exportable)
						$doc->exportCaption($this->Codigo_Libro);
					if ($this->Titulo->Exportable)
						$doc->exportCaption($this->Titulo);
					if ($this->Autor->Exportable)
						$doc->exportCaption($this->Autor);
					if ($this->Editorial->Exportable)
						$doc->exportCaption($this->Editorial);
					if ($this->Fecha_publicacion->Exportable)
						$doc->exportCaption($this->Fecha_publicacion);
					if ($this->Edicion->Exportable)
						$doc->exportCaption($this->Edicion);
					if ($this->Area->Exportable)
						$doc->exportCaption($this->Area);
					if ($this->Categoria->Exportable)
						$doc->exportCaption($this->Categoria);
					if ($this->N_copias->Exportable)
						$doc->exportCaption($this->N_copias);
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
						if ($this->Id_libro->Exportable)
							$doc->exportField($this->Id_libro);
						if ($this->Codigo_Libro->Exportable)
							$doc->exportField($this->Codigo_Libro);
						if ($this->Titulo->Exportable)
							$doc->exportField($this->Titulo);
						if ($this->Autor->Exportable)
							$doc->exportField($this->Autor);
						if ($this->Editorial->Exportable)
							$doc->exportField($this->Editorial);
						if ($this->Fecha_publicacion->Exportable)
							$doc->exportField($this->Fecha_publicacion);
						if ($this->Edicion->Exportable)
							$doc->exportField($this->Edicion);
						if ($this->Area->Exportable)
							$doc->exportField($this->Area);
						if ($this->Categoria->Exportable)
							$doc->exportField($this->Categoria);
						if ($this->Palabras_Claves->Exportable)
							$doc->exportField($this->Palabras_Claves);
						if ($this->N_copias->Exportable)
							$doc->exportField($this->N_copias);
					} else {
						if ($this->Id_libro->Exportable)
							$doc->exportField($this->Id_libro);
						if ($this->Codigo_Libro->Exportable)
							$doc->exportField($this->Codigo_Libro);
						if ($this->Titulo->Exportable)
							$doc->exportField($this->Titulo);
						if ($this->Autor->Exportable)
							$doc->exportField($this->Autor);
						if ($this->Editorial->Exportable)
							$doc->exportField($this->Editorial);
						if ($this->Fecha_publicacion->Exportable)
							$doc->exportField($this->Fecha_publicacion);
						if ($this->Edicion->Exportable)
							$doc->exportField($this->Edicion);
						if ($this->Area->Exportable)
							$doc->exportField($this->Area);
						if ($this->Categoria->Exportable)
							$doc->exportField($this->Categoria);
						if ($this->N_copias->Exportable)
							$doc->exportField($this->N_copias);
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
