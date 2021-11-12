<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Table class for comuni
 */
class comuni extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $istat;
	public $toponimo;
	public $telefono;
	public $indirizzo;
	public $provincia;
	public $avviso;
	public $fk_zona;
	public $no_response;
	public $dominio;
	public $vide;
	public $botattivo;
	public $logo;
	public $logobin;
	public $vide_url;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'comuni';
		$this->TableName = 'comuni';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"unlockpa\".\"comuni\"";
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

		// id
		$this->id = new DbField('comuni', 'comuni', 'x_id', 'id', '"id"', 'CAST("id" AS varchar(255))', 3, -1, FALSE, '"id"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Nullable = FALSE; // NOT NULL field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// istat
		$this->istat = new DbField('comuni', 'comuni', 'x_istat', 'istat', '"istat"', '"istat"', 200, -1, FALSE, '"istat"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->istat->Sortable = TRUE; // Allow sort
		$this->istat->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['istat'] = &$this->istat;

		// toponimo
		$this->toponimo = new DbField('comuni', 'comuni', 'x_toponimo', 'toponimo', '"toponimo"', '"toponimo"', 200, -1, FALSE, '"toponimo"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->toponimo->Nullable = FALSE; // NOT NULL field
		$this->toponimo->Required = TRUE; // Required field
		$this->toponimo->Sortable = TRUE; // Allow sort
		$this->fields['toponimo'] = &$this->toponimo;

		// telefono
		$this->telefono = new DbField('comuni', 'comuni', 'x_telefono', 'telefono', '"telefono"', '"telefono"', 200, -1, FALSE, '"telefono"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefono->Sortable = TRUE; // Allow sort
		$this->fields['telefono'] = &$this->telefono;

		// indirizzo
		$this->indirizzo = new DbField('comuni', 'comuni', 'x_indirizzo', 'indirizzo', '"indirizzo"', '"indirizzo"', 200, -1, FALSE, '"indirizzo"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->indirizzo->Sortable = TRUE; // Allow sort
		$this->fields['indirizzo'] = &$this->indirizzo;

		// provincia
		$this->provincia = new DbField('comuni', 'comuni', 'x_provincia', 'provincia', '"provincia"', '"provincia"', 200, -1, FALSE, '"provincia"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->provincia->Sortable = TRUE; // Allow sort
		$this->fields['provincia'] = &$this->provincia;

		// avviso
		$this->avviso = new DbField('comuni', 'comuni', 'x_avviso', 'avviso', '"avviso"', '"avviso"', 200, -1, FALSE, '"avviso"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->avviso->Required = TRUE; // Required field
		$this->avviso->Sortable = TRUE; // Allow sort
		$this->fields['avviso'] = &$this->avviso;

		// fk_zona
		$this->fk_zona = new DbField('comuni', 'comuni', 'x_fk_zona', 'fk_zona', '"fk_zona"', 'CAST("fk_zona" AS varchar(255))', 3, -1, FALSE, '"fk_zona"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->fk_zona->Sortable = TRUE; // Allow sort
		$this->fk_zona->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->fk_zona->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->fk_zona->Lookup = new Lookup('fk_zona', 'zone', FALSE, 'id', ["zona","","",""], [], [], [], [], [], [], '', '');
		$this->fk_zona->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['fk_zona'] = &$this->fk_zona;

		// no_response
		$this->no_response = new DbField('comuni', 'comuni', 'x_no_response', 'no_response', '"no_response"', '"no_response"', 200, -1, FALSE, '"no_response"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->no_response->Sortable = TRUE; // Allow sort
		$this->fields['no_response'] = &$this->no_response;

		// dominio
		$this->dominio = new DbField('comuni', 'comuni', 'x_dominio', 'dominio', '"dominio"', '"dominio"', 200, -1, FALSE, '"dominio"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dominio->Sortable = TRUE; // Allow sort
		$this->dominio->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['dominio'] = &$this->dominio;

		// vide
		$this->vide = new DbField('comuni', 'comuni', 'x_vide', 'vide', '"vide"', 'CAST("vide" AS varchar(255))', 11, -1, FALSE, '"vide"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->vide->Nullable = FALSE; // NOT NULL field
		$this->vide->Sortable = TRUE; // Allow sort
		$this->vide->DataType = DATATYPE_BOOLEAN;
		$this->vide->Lookup = new Lookup('vide', 'comuni', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->vide->OptionCount = 2;
		$this->fields['vide'] = &$this->vide;

		// botattivo
		$this->botattivo = new DbField('comuni', 'comuni', 'x_botattivo', 'botattivo', '"botattivo"', 'CAST("botattivo" AS varchar(255))', 11, -1, FALSE, '"botattivo"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->botattivo->Sortable = TRUE; // Allow sort
		$this->botattivo->DataType = DATATYPE_BOOLEAN;
		$this->botattivo->Lookup = new Lookup('botattivo', 'comuni', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->botattivo->OptionCount = 2;
		$this->fields['botattivo'] = &$this->botattivo;

		// logo
		$this->logo = new DbField('comuni', 'comuni', 'x_logo', 'logo', '"logo"', '"logo"', 201, -1, FALSE, '"logo"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->logo->Sortable = TRUE; // Allow sort
		$this->fields['logo'] = &$this->logo;

		// logobin
		$this->logobin = new DbField('comuni', 'comuni', 'x_logobin', 'logobin', '"logobin"', 'CAST("logobin" AS varchar(255))', 205, -1, TRUE, '"logobin"', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->logobin->Sortable = TRUE; // Allow sort
		$this->fields['logobin'] = &$this->logobin;

		// vide_url
		$this->vide_url = new DbField('comuni', 'comuni', 'x_vide_url', 'vide_url', '"vide_url"', '"vide_url"', 200, -1, FALSE, '"vide_url"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->vide_url->Sortable = TRUE; // Allow sort
		$this->fields['vide_url'] = &$this->vide_url;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"unlockpa\".\"comuni\"";
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "\"id\" ASC";
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
			$this->id->setDbValue($conn->getOne("SELECT currval('comuni_id_seq'::regclass)"));
			$rs['id'] = $this->id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'id';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->istat->DbValue = $row['istat'];
		$this->toponimo->DbValue = $row['toponimo'];
		$this->telefono->DbValue = $row['telefono'];
		$this->indirizzo->DbValue = $row['indirizzo'];
		$this->provincia->DbValue = $row['provincia'];
		$this->avviso->DbValue = $row['avviso'];
		$this->fk_zona->DbValue = $row['fk_zona'];
		$this->no_response->DbValue = $row['no_response'];
		$this->dominio->DbValue = $row['dominio'];
		$this->vide->DbValue = (ConvertToBool($row['vide']) ? "1" : "0");
		$this->botattivo->DbValue = (ConvertToBool($row['botattivo']) ? "1" : "0");
		$this->logo->DbValue = $row['logo'];
		$this->logobin->Upload->DbValue = $row['logobin'];
		$this->vide_url->DbValue = $row['vide_url'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "\"id\" = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('id', $row) ? $row['id'] : NULL) : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "comunilist.php";
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
		if ($pageName == "comuniview.php")
			return $Language->phrase("View");
		elseif ($pageName == "comuniedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "comuniadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "comunilist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("comuniview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("comuniview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "comuniadd.php?" . $this->getUrlParm($parm);
		else
			$url = "comuniadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("comuniedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("comuniadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("comunidelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
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
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
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
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
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
			$this->id->CurrentValue = $key;
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
		$this->id->setDbValue($rs->fields('id'));
		$this->istat->setDbValue($rs->fields('istat'));
		$this->toponimo->setDbValue($rs->fields('toponimo'));
		$this->telefono->setDbValue($rs->fields('telefono'));
		$this->indirizzo->setDbValue($rs->fields('indirizzo'));
		$this->provincia->setDbValue($rs->fields('provincia'));
		$this->avviso->setDbValue($rs->fields('avviso'));
		$this->fk_zona->setDbValue($rs->fields('fk_zona'));
		$this->no_response->setDbValue($rs->fields('no_response'));
		$this->dominio->setDbValue($rs->fields('dominio'));
		$this->vide->setDbValue(ConvertToBool($rs->fields('vide')) ? "1" : "0");
		$this->botattivo->setDbValue(ConvertToBool($rs->fields('botattivo')) ? "1" : "0");
		$this->logo->setDbValue($rs->fields('logo'));
		$this->logobin->Upload->DbValue = $rs->fields('logobin');
		$this->vide_url->setDbValue($rs->fields('vide_url'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// istat
		// toponimo
		// telefono
		// indirizzo
		// provincia
		// avviso
		// fk_zona
		// no_response
		// dominio
		// vide
		// botattivo
		// logo

		$this->logo->CellCssStyle = "white-space: nowrap;";

		// logobin
		// vide_url
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewValue = FormatNumber($this->id->ViewValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// istat
		$this->istat->ViewValue = $this->istat->CurrentValue;
		$this->istat->ViewCustomAttributes = "";

		// toponimo
		$this->toponimo->ViewValue = $this->toponimo->CurrentValue;
		$this->toponimo->ViewCustomAttributes = "";

		// telefono
		$this->telefono->ViewValue = $this->telefono->CurrentValue;
		$this->telefono->ViewCustomAttributes = "";

		// indirizzo
		$this->indirizzo->ViewValue = $this->indirizzo->CurrentValue;
		$this->indirizzo->ViewCustomAttributes = "";

		// provincia
		$this->provincia->ViewValue = $this->provincia->CurrentValue;
		$this->provincia->ViewCustomAttributes = "";

		// avviso
		$this->avviso->ViewValue = $this->avviso->CurrentValue;
		$this->avviso->ViewCustomAttributes = "";

		// fk_zona
		$curVal = strval($this->fk_zona->CurrentValue);
		if ($curVal <> "") {
			$this->fk_zona->ViewValue = $this->fk_zona->lookupCacheOption($curVal);
			if ($this->fk_zona->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->fk_zona->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->fk_zona->ViewValue = $this->fk_zona->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->fk_zona->ViewValue = $this->fk_zona->CurrentValue;
				}
			}
		} else {
			$this->fk_zona->ViewValue = NULL;
		}
		$this->fk_zona->ViewCustomAttributes = "";

		// no_response
		$this->no_response->ViewValue = $this->no_response->CurrentValue;
		$this->no_response->ViewCustomAttributes = "";

		// dominio
		$this->dominio->ViewValue = $this->dominio->CurrentValue;
		$this->dominio->ViewCustomAttributes = "";

		// vide
		if (ConvertToBool($this->vide->CurrentValue)) {
			$this->vide->ViewValue = $this->vide->tagCaption(1) <> "" ? $this->vide->tagCaption(1) : "Yes";
		} else {
			$this->vide->ViewValue = $this->vide->tagCaption(2) <> "" ? $this->vide->tagCaption(2) : "No";
		}
		$this->vide->ViewCustomAttributes = "";

		// botattivo
		if (ConvertToBool($this->botattivo->CurrentValue)) {
			$this->botattivo->ViewValue = $this->botattivo->tagCaption(1) <> "" ? $this->botattivo->tagCaption(1) : "Yes";
		} else {
			$this->botattivo->ViewValue = $this->botattivo->tagCaption(2) <> "" ? $this->botattivo->tagCaption(2) : "No";
		}
		$this->botattivo->ViewCustomAttributes = "";

		// logo
		$this->logo->ViewValue = $this->logo->CurrentValue;
		$this->logo->ViewCustomAttributes = "";

		// logobin
		if (!EmptyValue($this->logobin->Upload->DbValue)) {
			$this->logobin->ImageAlt = $this->logobin->alt();
			$this->logobin->ViewValue = $this->id->CurrentValue;
			$this->logobin->IsBlobImage = IsImageFile(ContentExtension($this->logobin->Upload->DbValue));
			$this->logobin->Upload->FileName = $this->logo->CurrentValue;
		} else {
			$this->logobin->ViewValue = "";
		}
		$this->logobin->ViewCustomAttributes = "";

		// vide_url
		$this->vide_url->ViewValue = $this->vide_url->CurrentValue;
		$this->vide_url->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// istat
		$this->istat->LinkCustomAttributes = "";
		$this->istat->HrefValue = "";
		$this->istat->TooltipValue = "";

		// toponimo
		$this->toponimo->LinkCustomAttributes = "";
		$this->toponimo->HrefValue = "";
		$this->toponimo->TooltipValue = "";

		// telefono
		$this->telefono->LinkCustomAttributes = "";
		$this->telefono->HrefValue = "";
		$this->telefono->TooltipValue = "";

		// indirizzo
		$this->indirizzo->LinkCustomAttributes = "";
		$this->indirizzo->HrefValue = "";
		$this->indirizzo->TooltipValue = "";

		// provincia
		$this->provincia->LinkCustomAttributes = "";
		$this->provincia->HrefValue = "";
		$this->provincia->TooltipValue = "";

		// avviso
		$this->avviso->LinkCustomAttributes = "";
		$this->avviso->HrefValue = "";
		$this->avviso->TooltipValue = "";

		// fk_zona
		$this->fk_zona->LinkCustomAttributes = "";
		$this->fk_zona->HrefValue = "";
		$this->fk_zona->TooltipValue = "";

		// no_response
		$this->no_response->LinkCustomAttributes = "";
		$this->no_response->HrefValue = "";
		$this->no_response->TooltipValue = "";

		// dominio
		$this->dominio->LinkCustomAttributes = "";
		$this->dominio->HrefValue = "";
		$this->dominio->TooltipValue = "";

		// vide
		$this->vide->LinkCustomAttributes = "";
		$this->vide->HrefValue = "";
		$this->vide->TooltipValue = "";

		// botattivo
		$this->botattivo->LinkCustomAttributes = "";
		$this->botattivo->HrefValue = "";
		$this->botattivo->TooltipValue = "";

		// logo
		$this->logo->LinkCustomAttributes = "";
		$this->logo->HrefValue = "";
		$this->logo->TooltipValue = "";

		// logobin
		$this->logobin->LinkCustomAttributes = "";
		if (!empty($this->logobin->Upload->DbValue)) {
			$this->logobin->HrefValue = GetFileUploadUrl($this->logobin, $this->id->CurrentValue);
			$this->logobin->LinkAttrs["target"] = "";
			if ($this->logobin->IsBlobImage && empty($this->logobin->LinkAttrs["target"]))
				$this->logobin->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->logobin->HrefValue = FullUrl($this->logobin->HrefValue, "href");
		} else {
			$this->logobin->HrefValue = "";
		}
		$this->logobin->ExportHrefValue = GetFileUploadUrl($this->logobin, $this->id->CurrentValue);
		$this->logobin->TooltipValue = "";
		if ($this->logobin->UseColorbox) {
			if (EmptyValue($this->logobin->TooltipValue))
				$this->logobin->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->logobin->LinkAttrs["data-rel"] = "comuni_x_logobin";
			AppendClass($this->logobin->LinkAttrs["class"], "ew-lightbox");
		}

		// vide_url
		$this->vide_url->LinkCustomAttributes = "";
		$this->vide_url->HrefValue = "";
		$this->vide_url->TooltipValue = "";

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

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->EditValue = FormatNumber($this->id->EditValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// istat
		$this->istat->EditAttrs["class"] = "form-control";
		$this->istat->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->istat->CurrentValue = HtmlDecode($this->istat->CurrentValue);
		$this->istat->EditValue = $this->istat->CurrentValue;
		$this->istat->PlaceHolder = RemoveHtml($this->istat->caption());

		// toponimo
		$this->toponimo->EditAttrs["class"] = "form-control";
		$this->toponimo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->toponimo->CurrentValue = HtmlDecode($this->toponimo->CurrentValue);
		$this->toponimo->EditValue = $this->toponimo->CurrentValue;
		$this->toponimo->PlaceHolder = RemoveHtml($this->toponimo->caption());

		// telefono
		$this->telefono->EditAttrs["class"] = "form-control";
		$this->telefono->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
		$this->telefono->EditValue = $this->telefono->CurrentValue;
		$this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

		// indirizzo
		$this->indirizzo->EditAttrs["class"] = "form-control";
		$this->indirizzo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->indirizzo->CurrentValue = HtmlDecode($this->indirizzo->CurrentValue);
		$this->indirizzo->EditValue = $this->indirizzo->CurrentValue;
		$this->indirizzo->PlaceHolder = RemoveHtml($this->indirizzo->caption());

		// provincia
		$this->provincia->EditAttrs["class"] = "form-control";
		$this->provincia->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->provincia->CurrentValue = HtmlDecode($this->provincia->CurrentValue);
		$this->provincia->EditValue = $this->provincia->CurrentValue;
		$this->provincia->PlaceHolder = RemoveHtml($this->provincia->caption());

		// avviso
		$this->avviso->EditAttrs["class"] = "form-control";
		$this->avviso->EditCustomAttributes = "";
		$this->avviso->EditValue = $this->avviso->CurrentValue;
		$this->avviso->PlaceHolder = RemoveHtml($this->avviso->caption());

		// fk_zona
		$this->fk_zona->EditAttrs["class"] = "form-control";
		$this->fk_zona->EditCustomAttributes = "";

		// no_response
		$this->no_response->EditAttrs["class"] = "form-control";
		$this->no_response->EditCustomAttributes = "";
		$this->no_response->EditValue = $this->no_response->CurrentValue;
		$this->no_response->PlaceHolder = RemoveHtml($this->no_response->caption());

		// dominio
		$this->dominio->EditAttrs["class"] = "form-control";
		$this->dominio->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->dominio->CurrentValue = HtmlDecode($this->dominio->CurrentValue);
		$this->dominio->EditValue = $this->dominio->CurrentValue;
		$this->dominio->PlaceHolder = RemoveHtml($this->dominio->caption());

		// vide
		$this->vide->EditCustomAttributes = "";
		$this->vide->EditValue = $this->vide->options(FALSE);

		// botattivo
		$this->botattivo->EditCustomAttributes = "";
		$this->botattivo->EditValue = $this->botattivo->options(FALSE);

		// logo
		$this->logo->EditAttrs["class"] = "form-control";
		$this->logo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->logo->CurrentValue = HtmlDecode($this->logo->CurrentValue);
		$this->logo->EditValue = $this->logo->CurrentValue;
		$this->logo->PlaceHolder = RemoveHtml($this->logo->caption());

		// logobin
		$this->logobin->EditAttrs["class"] = "form-control";
		$this->logobin->EditCustomAttributes = "";
		if (!EmptyValue($this->logobin->Upload->DbValue)) {
			$this->logobin->ImageAlt = $this->logobin->alt();
			$this->logobin->EditValue = $this->id->CurrentValue;
			$this->logobin->IsBlobImage = IsImageFile(ContentExtension($this->logobin->Upload->DbValue));
			$this->logobin->Upload->FileName = $this->logo->CurrentValue;
		} else {
			$this->logobin->EditValue = "";
		}
		if (!EmptyValue($this->logo->CurrentValue))
				$this->logobin->Upload->FileName = $this->logo->CurrentValue;

		// vide_url
		$this->vide_url->EditAttrs["class"] = "form-control";
		$this->vide_url->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->vide_url->CurrentValue = HtmlDecode($this->vide_url->CurrentValue);
		$this->vide_url->EditValue = $this->vide_url->CurrentValue;
		$this->vide_url->PlaceHolder = RemoveHtml($this->vide_url->caption());

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
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->istat);
					$doc->exportCaption($this->toponimo);
					$doc->exportCaption($this->telefono);
					$doc->exportCaption($this->indirizzo);
					$doc->exportCaption($this->provincia);
					$doc->exportCaption($this->avviso);
					$doc->exportCaption($this->fk_zona);
					$doc->exportCaption($this->no_response);
					$doc->exportCaption($this->dominio);
					$doc->exportCaption($this->vide);
					$doc->exportCaption($this->botattivo);
					$doc->exportCaption($this->logobin);
					$doc->exportCaption($this->vide_url);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->istat);
					$doc->exportCaption($this->toponimo);
					$doc->exportCaption($this->telefono);
					$doc->exportCaption($this->indirizzo);
					$doc->exportCaption($this->provincia);
					$doc->exportCaption($this->avviso);
					$doc->exportCaption($this->fk_zona);
					$doc->exportCaption($this->no_response);
					$doc->exportCaption($this->dominio);
					$doc->exportCaption($this->vide);
					$doc->exportCaption($this->botattivo);
					$doc->exportCaption($this->vide_url);
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
						$doc->exportField($this->id);
						$doc->exportField($this->istat);
						$doc->exportField($this->toponimo);
						$doc->exportField($this->telefono);
						$doc->exportField($this->indirizzo);
						$doc->exportField($this->provincia);
						$doc->exportField($this->avviso);
						$doc->exportField($this->fk_zona);
						$doc->exportField($this->no_response);
						$doc->exportField($this->dominio);
						$doc->exportField($this->vide);
						$doc->exportField($this->botattivo);
						$doc->exportField($this->logobin);
						$doc->exportField($this->vide_url);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->istat);
						$doc->exportField($this->toponimo);
						$doc->exportField($this->telefono);
						$doc->exportField($this->indirizzo);
						$doc->exportField($this->provincia);
						$doc->exportField($this->avviso);
						$doc->exportField($this->fk_zona);
						$doc->exportField($this->no_response);
						$doc->exportField($this->dominio);
						$doc->exportField($this->vide);
						$doc->exportField($this->botattivo);
						$doc->exportField($this->vide_url);
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
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
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
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
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
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
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
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
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
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'logobin') {
			$fldName = "logobin";
			$fileNameFld = "logo";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear output buffer
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'comuni';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'comuni';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'comuni';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'comuni';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	  if (CurrentUserLevel() == 0)
		{
		$current_table = CurrentTable()->TableName;

		// echo "current_table=".$current_table;
		$id_field = "id";

		// $filtro = "$id_field = '001272'";
		$filtro = "$id_field = '".CurrentUserInfo("fk_comune")."'";
		addFilter($filter, $filtro);
		}
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
		// RENDO NON EDITABILE PER GLI UTENTI PREDEFINITO / DEFAULT USER LEVEL = 0 
		// http://www.hkvforums.com/viewtopic.php?f=4&t=34478&p=98526&hilit=EditValue#p98526

		if (CurrentUserLevel() == 0)
	   	{

			// $this->RowAttrs["style"] = "color: Black; background-color: #ffcc99";
			$this->vide->ReadOnly = TRUE;
			$this->dominio->ReadOnly = TRUE;
			$this->vide_url->ReadOnly = TRUE;

			// $this->botattivo->ReadOnly = TRUE;
	   	} 
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>