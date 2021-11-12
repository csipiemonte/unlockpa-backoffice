<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Table class for risposte
 */
class risposte extends DbTable
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
	public $id_comune;
	public $id_domanda;
	public $domanda;
	public $risposta;
	public $validato;
	public $categoria;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'risposte';
		$this->TableName = 'risposte';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"unlockpa\".\"risposte\"";
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

		// id_comune
		$this->id_comune = new DbField('risposte', 'risposte', 'x_id_comune', 'id_comune', '"id_comune"', 'CAST("id_comune" AS varchar(255))', 3, -1, FALSE, '"id_comune"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_comune->IsPrimaryKey = TRUE; // Primary key field
		$this->id_comune->Nullable = FALSE; // NOT NULL field
		$this->id_comune->Required = TRUE; // Required field
		$this->id_comune->Sortable = TRUE; // Allow sort
		$this->id_comune->Lookup = new Lookup('id_comune', 'comuni', FALSE, 'id', ["toponimo","","",""], [], [], [], [], [], [], '', '');
		$this->id_comune->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_comune'] = &$this->id_comune;

		// id_domanda
		$this->id_domanda = new DbField('risposte', 'risposte', 'x_id_domanda', 'id_domanda', '"id_domanda"', 'CAST("id_domanda" AS varchar(255))', 3, -1, FALSE, '"id_domanda"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_domanda->IsPrimaryKey = TRUE; // Primary key field
		$this->id_domanda->Nullable = FALSE; // NOT NULL field
		$this->id_domanda->Required = TRUE; // Required field
		$this->id_domanda->Sortable = TRUE; // Allow sort
		$this->id_domanda->Lookup = new Lookup('id_domanda', 'domande', FALSE, 'id', ["domanda","","",""], [], [], [], [], [], [], '', '');
		$this->id_domanda->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_domanda'] = &$this->id_domanda;

		// domanda
		$this->domanda = new DbField('risposte', 'risposte', 'x_domanda', 'domanda', '"domanda"', '"domanda"', 200, -1, FALSE, '"domanda"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->domanda->Sortable = TRUE; // Allow sort
		$this->domanda->AdvancedSearch->SearchValueDefault = "prova0";
		$this->domanda->AdvancedSearch->SearchOperatorDefault = "LIKE";
		$this->domanda->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->domanda->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['domanda'] = &$this->domanda;

		// risposta
		$this->risposta = new DbField('risposte', 'risposte', 'x_risposta', 'risposta', '"risposta"', '"risposta"', 200, -1, FALSE, '"risposta"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->risposta->Sortable = TRUE; // Allow sort
		$this->risposta->AdvancedSearch->SearchValueDefault = "prova1";
		$this->risposta->AdvancedSearch->SearchOperatorDefault = "LIKE";
		$this->risposta->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->risposta->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['risposta'] = &$this->risposta;

		// validato
		$this->validato = new DbField('risposte', 'risposte', 'x_validato', 'validato', '"validato"', 'CAST("validato" AS varchar(255))', 11, -1, FALSE, '"validato"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->validato->Sortable = TRUE; // Allow sort
		$this->validato->DataType = DATATYPE_BOOLEAN;
		$this->validato->Lookup = new Lookup('validato', 'risposte', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->validato->OptionCount = 2;
		$this->validato->AdvancedSearch->SearchValueDefault = true;
		$this->validato->AdvancedSearch->SearchOperatorDefault = "=";
		$this->validato->AdvancedSearch->SearchOperatorDefault2 = "";
		$this->validato->AdvancedSearch->SearchConditionDefault = "AND";
		$this->fields['validato'] = &$this->validato;

		// categoria
		$this->categoria = new DbField('risposte', 'risposte', 'x_categoria', 'categoria', '"categoria"', '"categoria"', 200, -1, FALSE, '"categoria"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->categoria->Sortable = TRUE; // Allow sort
		$this->fields['categoria'] = &$this->categoria;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"unlockpa\".\"risposte\"";
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "\"id_domanda\" ASC";
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
			$fldname = 'id_comune';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$fldname = 'id_domanda';
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
			if (array_key_exists('id_comune', $rs))
				AddFilter($where, QuotedName('id_comune', $this->Dbid) . '=' . QuotedValue($rs['id_comune'], $this->id_comune->DataType, $this->Dbid));
			if (array_key_exists('id_domanda', $rs))
				AddFilter($where, QuotedName('id_domanda', $this->Dbid) . '=' . QuotedValue($rs['id_domanda'], $this->id_domanda->DataType, $this->Dbid));
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
		$this->id_comune->DbValue = $row['id_comune'];
		$this->id_domanda->DbValue = $row['id_domanda'];
		$this->domanda->DbValue = $row['domanda'];
		$this->risposta->DbValue = $row['risposta'];
		$this->validato->DbValue = (ConvertToBool($row['validato']) ? "1" : "0");
		$this->categoria->DbValue = $row['categoria'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "\"id_comune\" = @id_comune@ AND \"id_domanda\" = @id_domanda@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('id_comune', $row) ? $row['id_comune'] : NULL) : $this->id_comune->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_comune@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		$val = is_array($row) ? (array_key_exists('id_domanda', $row) ? $row['id_domanda'] : NULL) : $this->id_domanda->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_domanda@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "rispostelist.php";
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
		if ($pageName == "risposteview.php")
			return $Language->phrase("View");
		elseif ($pageName == "risposteedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "risposteadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "rispostelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("risposteview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("risposteview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "risposteadd.php?" . $this->getUrlParm($parm);
		else
			$url = "risposteadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("risposteedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("risposteadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("rispostedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_comune:" . JsonEncode($this->id_comune->CurrentValue, "number");
		$json .= ",id_domanda:" . JsonEncode($this->id_domanda->CurrentValue, "number");
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
		if ($this->id_comune->CurrentValue != NULL) {
			$url .= "id_comune=" . urlencode($this->id_comune->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->id_domanda->CurrentValue != NULL) {
			$url .= "&id_domanda=" . urlencode($this->id_domanda->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode($COMPOSITE_KEY_SEPARATOR, $arKeys[$i]);
		} else {
			if (Param("id_comune") !== NULL)
				$arKey[] = Param("id_comune");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("id_domanda") !== NULL)
				$arKey[] = Param("id_domanda");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) <> 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // id_comune
					continue;
				if (!is_numeric($key[1])) // id_domanda
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
			$this->id_comune->CurrentValue = $key[0];
			$this->id_domanda->CurrentValue = $key[1];
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
		$this->id_comune->setDbValue($rs->fields('id_comune'));
		$this->id_domanda->setDbValue($rs->fields('id_domanda'));
		$this->domanda->setDbValue($rs->fields('domanda'));
		$this->risposta->setDbValue($rs->fields('risposta'));
		$this->validato->setDbValue(ConvertToBool($rs->fields('validato')) ? "1" : "0");
		$this->categoria->setDbValue($rs->fields('categoria'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_comune

		$this->id_comune->CellCssStyle = "white-space: nowrap;";

		// id_domanda
		$this->id_domanda->CellCssStyle = "width: 400px;";

		// domanda
		// risposta
		// validato
		// categoria
		// id_comune

		$this->id_comune->ViewValue = $this->id_comune->CurrentValue;
		$curVal = strval($this->id_comune->CurrentValue);
		if ($curVal <> "") {
			$this->id_comune->ViewValue = $this->id_comune->lookupCacheOption($curVal);
			if ($this->id_comune->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_comune->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->id_comune->ViewValue = $this->id_comune->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_comune->ViewValue = $this->id_comune->CurrentValue;
				}
			}
		} else {
			$this->id_comune->ViewValue = NULL;
		}
		$this->id_comune->ViewCustomAttributes = "";

		// id_domanda
		$this->id_domanda->ViewValue = $this->id_domanda->CurrentValue;
		$curVal = strval($this->id_domanda->CurrentValue);
		if ($curVal <> "") {
			$this->id_domanda->ViewValue = $this->id_domanda->lookupCacheOption($curVal);
			if ($this->id_domanda->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_domanda->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = htmlentities($rswrk->fields('df'));
					$this->id_domanda->ViewValue = $this->id_domanda->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_domanda->ViewValue = $this->id_domanda->CurrentValue;
				}
			}
		} else {
			$this->id_domanda->ViewValue = NULL;
		}
		$this->id_domanda->ViewCustomAttributes = "";

		// domanda
		$this->domanda->ViewValue = $this->domanda->CurrentValue;
		$this->domanda->ViewCustomAttributes = "";

		// risposta
		$this->risposta->ViewValue = $this->risposta->CurrentValue;
		$this->risposta->ViewCustomAttributes = "";

		// validato
		if (ConvertToBool($this->validato->CurrentValue)) {
			$this->validato->ViewValue = $this->validato->tagCaption(1) <> "" ? $this->validato->tagCaption(1) : "Yes";
		} else {
			$this->validato->ViewValue = $this->validato->tagCaption(2) <> "" ? $this->validato->tagCaption(2) : "No";
		}
		$this->validato->ViewCustomAttributes = "";

		// categoria
		$this->categoria->ViewValue = $this->categoria->CurrentValue;
		$this->categoria->ViewCustomAttributes = "";

		// id_comune
		$this->id_comune->LinkCustomAttributes = "";
		$this->id_comune->HrefValue = "";
		if (!$this->isExport()) {
			$this->id_comune->TooltipValue = ($this->id_domanda->ViewValue <> "") ? $this->id_domanda->ViewValue : $this->id_domanda->CurrentValue;
			if ($this->id_comune->HrefValue == "") $this->id_comune->HrefValue = "javascript:void(0);";
			AppendClass($this->id_comune->LinkAttrs["class"], "ew-tooltip-link");
			$this->id_comune->LinkAttrs["data-tooltip-id"] = "tt_risposte_x" . (($this->RowType <> ROWTYPE_MASTER) ? @$this->RowCnt : "") . "_id_comune";
			$this->id_comune->LinkAttrs["data-tooltip-width"] = $this->id_comune->TooltipWidth;
			$this->id_comune->LinkAttrs["data-placement"] = $GLOBALS["CSS_FLIP"] ? "left" : "right";
		}

		// id_domanda
		$this->id_domanda->LinkCustomAttributes = "";
		$this->id_domanda->HrefValue = "";
		if (!$this->isExport()) {
			$this->id_domanda->TooltipValue = ($this->id_domanda->ViewValue <> "") ? $this->id_domanda->ViewValue : $this->id_domanda->CurrentValue;
			if ($this->id_domanda->HrefValue == "") $this->id_domanda->HrefValue = "javascript:void(0);";
			AppendClass($this->id_domanda->LinkAttrs["class"], "ew-tooltip-link");
			$this->id_domanda->LinkAttrs["data-tooltip-id"] = "tt_risposte_x" . (($this->RowType <> ROWTYPE_MASTER) ? @$this->RowCnt : "") . "_id_domanda";
			$this->id_domanda->LinkAttrs["data-tooltip-width"] = $this->id_domanda->TooltipWidth;
			$this->id_domanda->LinkAttrs["data-placement"] = $GLOBALS["CSS_FLIP"] ? "left" : "right";
		}

		// domanda
		$this->domanda->LinkCustomAttributes = "";
		$this->domanda->HrefValue = "";
		$this->domanda->TooltipValue = "";

		// risposta
		$this->risposta->LinkCustomAttributes = "";
		$this->risposta->HrefValue = "";
		$this->risposta->TooltipValue = "";

		// validato
		$this->validato->LinkCustomAttributes = "";
		$this->validato->HrefValue = "";
		$this->validato->TooltipValue = "";

		// categoria
		$this->categoria->LinkCustomAttributes = "";
		$this->categoria->HrefValue = "";
		$this->categoria->TooltipValue = "";

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

		// id_comune
		$this->id_comune->EditAttrs["class"] = "form-control";
		$this->id_comune->EditCustomAttributes = "";
		$this->id_comune->EditValue = $this->id_comune->CurrentValue;
		$curVal = strval($this->id_comune->CurrentValue);
		if ($curVal <> "") {
			$this->id_comune->EditValue = $this->id_comune->lookupCacheOption($curVal);
			if ($this->id_comune->EditValue === NULL) { // Lookup from database
				$filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_comune->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->id_comune->EditValue = $this->id_comune->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_comune->EditValue = $this->id_comune->CurrentValue;
				}
			}
		} else {
			$this->id_comune->EditValue = NULL;
		}
		$this->id_comune->ViewCustomAttributes = "";

		// id_domanda
		$this->id_domanda->EditAttrs["class"] = "form-control";
		$this->id_domanda->EditCustomAttributes = "";
		$this->id_domanda->EditValue = $this->id_domanda->CurrentValue;
		$curVal = strval($this->id_domanda->CurrentValue);
		if ($curVal <> "") {
			$this->id_domanda->EditValue = $this->id_domanda->lookupCacheOption($curVal);
			if ($this->id_domanda->EditValue === NULL) { // Lookup from database
				$filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_domanda->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = htmlentities($rswrk->fields('df'));
					$this->id_domanda->EditValue = $this->id_domanda->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_domanda->EditValue = $this->id_domanda->CurrentValue;
				}
			}
		} else {
			$this->id_domanda->EditValue = NULL;
		}
		$this->id_domanda->ViewCustomAttributes = "";

		// domanda
		$this->domanda->EditAttrs["class"] = "form-control";
		$this->domanda->EditCustomAttributes = "";
		$this->domanda->EditValue = $this->domanda->CurrentValue;
		$this->domanda->ViewCustomAttributes = "";

		// risposta
		$this->risposta->EditAttrs["class"] = "form-control";
		$this->risposta->EditCustomAttributes = "";
		$this->risposta->EditValue = $this->risposta->CurrentValue;
		$this->risposta->PlaceHolder = RemoveHtml($this->risposta->caption());

		// validato
		$this->validato->EditCustomAttributes = "";
		$this->validato->EditValue = $this->validato->options(FALSE);

		// categoria
		$this->categoria->EditAttrs["class"] = "form-control";
		$this->categoria->EditCustomAttributes = "";
		$this->categoria->EditValue = $this->categoria->CurrentValue;
		$this->categoria->ViewCustomAttributes = "";

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
					$doc->exportCaption($this->id_comune);
					$doc->exportCaption($this->id_domanda);
					$doc->exportCaption($this->validato);
					$doc->exportCaption($this->categoria);
				} else {
					$doc->exportCaption($this->id_comune);
					$doc->exportCaption($this->id_domanda);
					$doc->exportCaption($this->domanda);
					$doc->exportCaption($this->risposta);
					$doc->exportCaption($this->validato);
					$doc->exportCaption($this->categoria);
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
						$doc->exportField($this->id_comune);
						$doc->exportField($this->id_domanda);
						$doc->exportField($this->validato);
						$doc->exportField($this->categoria);
					} else {
						$doc->exportField($this->id_comune);
						$doc->exportField($this->id_domanda);
						$doc->exportField($this->domanda);
						$doc->exportField($this->risposta);
						$doc->exportField($this->validato);
						$doc->exportField($this->categoria);
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

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'risposte';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'risposte';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id_comune'];
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id_domanda'];

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
		$table = 'risposte';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['id_comune'];
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['id_domanda'];

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
		$table = 'risposte';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id_comune'];
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id_domanda'];

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
		$id_field = "id_comune";

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
		// VEDI  http://www.hkvforums.com/viewtopic.php?f=4&t=34478&p=98526&hilit=EditValue#p98526
		// COLORO IL RECORD IN BASE AD UN CRITERIO ALFANUMERICO
		// 1 buono, 2 pessimo, 3 ottimo
	//	if($this->id_domanda->CurrentValue == 3) 
	//	{
	//		$this->RowAttrs["style"] = "color: Black; background-color: #ffcc99";
	//	} 
	//	if($this->fk_stato_manufatto->CurrentValue == 2) 
	//	{
	//		$this->RowAttrs["style"] = "color: Black; background-color: #f70f07";
	//	} 
	//	if($this->fk_stato_manufatto->CurrentValue == 3) 
	//	{
	//		$this->RowAttrs["style"] = "color: Black; background-color: #36e24d";
	//	} 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>