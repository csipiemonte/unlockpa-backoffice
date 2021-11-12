<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Table class for utenti
 */
class utenti extends DbTable
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
	public $name;
	public $pass;
	public $mail;
	public $langcode;
	public $preferred_langcode;
	public $preferred_admin_langcode;
	public $timezone;
	public $status;
	public $access;
	public $_login;
	public $init;
	public $default_langcode;
	public $userlevel;
	public $profile_field_memo;
	public $userlevel_segn;
	public $userlevel_cellule;
	public $accettazione;
	public $created;
	public $changed;
	public $fk_comune;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'utenti';
		$this->TableName = 'utenti';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"unlockpa\".\"utenti\"";
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
		$this->id = new DbField('utenti', 'utenti', 'x_id', 'id', '"id"', 'CAST("id" AS varchar(255))', 3, -1, FALSE, '"id"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Nullable = FALSE; // NOT NULL field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// name
		$this->name = new DbField('utenti', 'utenti', 'x_name', 'name', '"name"', '"name"', 200, -1, FALSE, '"name"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->name->Sortable = TRUE; // Allow sort
		$this->fields['name'] = &$this->name;

		// pass
		$this->pass = new DbField('utenti', 'utenti', 'x_pass', 'pass', '"pass"', '"pass"', 200, -1, FALSE, '"pass"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pass->Required = TRUE; // Required field
		$this->pass->Sortable = TRUE; // Allow sort
		$this->fields['pass'] = &$this->pass;

		// mail
		$this->mail = new DbField('utenti', 'utenti', 'x_mail', 'mail', '"mail"', '"mail"', 200, -1, FALSE, '"mail"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->mail->Required = TRUE; // Required field
		$this->mail->Sortable = TRUE; // Allow sort
		$this->fields['mail'] = &$this->mail;

		// langcode
		$this->langcode = new DbField('utenti', 'utenti', 'x_langcode', 'langcode', '"langcode"', '"langcode"', 200, -1, FALSE, '"langcode"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->langcode->Sortable = TRUE; // Allow sort
		$this->fields['langcode'] = &$this->langcode;

		// preferred_langcode
		$this->preferred_langcode = new DbField('utenti', 'utenti', 'x_preferred_langcode', 'preferred_langcode', '"preferred_langcode"', '"preferred_langcode"', 200, -1, FALSE, '"preferred_langcode"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->preferred_langcode->Sortable = TRUE; // Allow sort
		$this->fields['preferred_langcode'] = &$this->preferred_langcode;

		// preferred_admin_langcode
		$this->preferred_admin_langcode = new DbField('utenti', 'utenti', 'x_preferred_admin_langcode', 'preferred_admin_langcode', '"preferred_admin_langcode"', '"preferred_admin_langcode"', 200, -1, FALSE, '"preferred_admin_langcode"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->preferred_admin_langcode->Sortable = TRUE; // Allow sort
		$this->fields['preferred_admin_langcode'] = &$this->preferred_admin_langcode;

		// timezone
		$this->timezone = new DbField('utenti', 'utenti', 'x_timezone', 'timezone', '"timezone"', '"timezone"', 200, -1, FALSE, '"timezone"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->timezone->Sortable = TRUE; // Allow sort
		$this->fields['timezone'] = &$this->timezone;

		// status
		$this->status = new DbField('utenti', 'utenti', 'x_status', 'status', '"status"', 'CAST("status" AS varchar(255))', 2, -1, FALSE, '"status"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->Lookup = new Lookup('status', 'utenti', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status->OptionCount = 2;
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// access
		$this->access = new DbField('utenti', 'utenti', 'x_access', 'access', '"access"', 'CAST("access" AS varchar(255))', 3, -1, FALSE, '"access"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->access->Sortable = TRUE; // Allow sort
		$this->access->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['access'] = &$this->access;

		// login
		$this->_login = new DbField('utenti', 'utenti', 'x__login', 'login', '"login"', 'CAST("login" AS varchar(255))', 3, -1, FALSE, '"login"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_login->Sortable = TRUE; // Allow sort
		$this->_login->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['login'] = &$this->_login;

		// init
		$this->init = new DbField('utenti', 'utenti', 'x_init', 'init', '"init"', '"init"', 200, -1, FALSE, '"init"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->init->Sortable = TRUE; // Allow sort
		$this->fields['init'] = &$this->init;

		// default_langcode
		$this->default_langcode = new DbField('utenti', 'utenti', 'x_default_langcode', 'default_langcode', '"default_langcode"', 'CAST("default_langcode" AS varchar(255))', 2, -1, FALSE, '"default_langcode"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->default_langcode->Sortable = TRUE; // Allow sort
		$this->default_langcode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['default_langcode'] = &$this->default_langcode;

		// userlevel
		$this->userlevel = new DbField('utenti', 'utenti', 'x_userlevel', 'userlevel', '"userlevel"', 'CAST("userlevel" AS varchar(255))', 20, -1, FALSE, '"userlevel"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->userlevel->Sortable = TRUE; // Allow sort
		$this->userlevel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->userlevel->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->userlevel->Lookup = new Lookup('userlevel', 'userlevels', FALSE, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '');
		$this->userlevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['userlevel'] = &$this->userlevel;

		// profile_field_memo
		$this->profile_field_memo = new DbField('utenti', 'utenti', 'x_profile_field_memo', 'profile_field_memo', '"profile_field_memo"', '"profile_field_memo"', 200, -1, FALSE, '"profile_field_memo"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->profile_field_memo->Sortable = TRUE; // Allow sort
		$this->fields['profile_field_memo'] = &$this->profile_field_memo;

		// userlevel_segn
		$this->userlevel_segn = new DbField('utenti', 'utenti', 'x_userlevel_segn', 'userlevel_segn', '"userlevel_segn"', 'CAST("userlevel_segn" AS varchar(255))', 20, -1, FALSE, '"userlevel_segn"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->userlevel_segn->Sortable = TRUE; // Allow sort
		$this->userlevel_segn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['userlevel_segn'] = &$this->userlevel_segn;

		// userlevel_cellule
		$this->userlevel_cellule = new DbField('utenti', 'utenti', 'x_userlevel_cellule', 'userlevel_cellule', '"userlevel_cellule"', 'CAST("userlevel_cellule" AS varchar(255))', 20, -1, FALSE, '"userlevel_cellule"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->userlevel_cellule->Sortable = TRUE; // Allow sort
		$this->userlevel_cellule->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['userlevel_cellule'] = &$this->userlevel_cellule;

		// accettazione
		$this->accettazione = new DbField('utenti', 'utenti', 'x_accettazione', 'accettazione', '"accettazione"', 'CAST("accettazione" AS varchar(255))', 11, -1, FALSE, '"accettazione"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->accettazione->Sortable = TRUE; // Allow sort
		$this->accettazione->DataType = DATATYPE_BOOLEAN;
		$this->accettazione->Lookup = new Lookup('accettazione', 'utenti', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->accettazione->OptionCount = 2;
		$this->fields['accettazione'] = &$this->accettazione;

		// created
		$this->created = new DbField('utenti', 'utenti', 'x_created', 'created', '"created"', CastDateFieldForLike('"created"', 0, "DB"), 133, 0, FALSE, '"created"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created->Sortable = TRUE; // Allow sort
		$this->created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created'] = &$this->created;

		// changed
		$this->changed = new DbField('utenti', 'utenti', 'x_changed', 'changed', '"changed"', CastDateFieldForLike('"changed"', 0, "DB"), 133, 0, FALSE, '"changed"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->changed->Sortable = TRUE; // Allow sort
		$this->changed->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['changed'] = &$this->changed;

		// fk_comune
		$this->fk_comune = new DbField('utenti', 'utenti', 'x_fk_comune', 'fk_comune', '"fk_comune"', 'CAST("fk_comune" AS varchar(255))', 3, -1, FALSE, '"fk_comune"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->fk_comune->Sortable = TRUE; // Allow sort
		$this->fk_comune->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->fk_comune->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->fk_comune->Lookup = new Lookup('fk_comune', 'comuni', FALSE, 'id', ["toponimo","","",""], [], [], [], [], [], [], '', '');
		$this->fk_comune->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['fk_comune'] = &$this->fk_comune;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"unlockpa\".\"utenti\"";
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
		global $Security;

		// Add User ID filter
		if ($Security->currentUserID() <> "" && !$Security->isAdmin()) { // Non system admin
			$filter = $this->addUserIDFilter($filter);
		}
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
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
			if (ENCRYPTED_PASSWORD && $name == 'pass')
				$value = (CASE_SENSITIVE_PASSWORD) ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
			$this->id->setDbValue($conn->getOne("SELECT currval('unlockpa.utenti_id_seq'::regclass)"));
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
			if (ENCRYPTED_PASSWORD && $name == 'pass') {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = (CASE_SENSITIVE_PASSWORD) ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
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
		$this->name->DbValue = $row['name'];
		$this->pass->DbValue = $row['pass'];
		$this->mail->DbValue = $row['mail'];
		$this->langcode->DbValue = $row['langcode'];
		$this->preferred_langcode->DbValue = $row['preferred_langcode'];
		$this->preferred_admin_langcode->DbValue = $row['preferred_admin_langcode'];
		$this->timezone->DbValue = $row['timezone'];
		$this->status->DbValue = $row['status'];
		$this->access->DbValue = $row['access'];
		$this->_login->DbValue = $row['login'];
		$this->init->DbValue = $row['init'];
		$this->default_langcode->DbValue = $row['default_langcode'];
		$this->userlevel->DbValue = $row['userlevel'];
		$this->profile_field_memo->DbValue = $row['profile_field_memo'];
		$this->userlevel_segn->DbValue = $row['userlevel_segn'];
		$this->userlevel_cellule->DbValue = $row['userlevel_cellule'];
		$this->accettazione->DbValue = (ConvertToBool($row['accettazione']) ? "1" : "0");
		$this->created->DbValue = $row['created'];
		$this->changed->DbValue = $row['changed'];
		$this->fk_comune->DbValue = $row['fk_comune'];
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
			return "utentilist.php";
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
		if ($pageName == "utentiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "utentiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "utentiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "utentilist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("utentiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("utentiview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "utentiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "utentiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("utentiedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("utentiadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("utentidelete.php", $this->getUrlParm());
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
		$this->name->setDbValue($rs->fields('name'));
		$this->pass->setDbValue($rs->fields('pass'));
		$this->mail->setDbValue($rs->fields('mail'));
		$this->langcode->setDbValue($rs->fields('langcode'));
		$this->preferred_langcode->setDbValue($rs->fields('preferred_langcode'));
		$this->preferred_admin_langcode->setDbValue($rs->fields('preferred_admin_langcode'));
		$this->timezone->setDbValue($rs->fields('timezone'));
		$this->status->setDbValue($rs->fields('status'));
		$this->access->setDbValue($rs->fields('access'));
		$this->_login->setDbValue($rs->fields('login'));
		$this->init->setDbValue($rs->fields('init'));
		$this->default_langcode->setDbValue($rs->fields('default_langcode'));
		$this->userlevel->setDbValue($rs->fields('userlevel'));
		$this->profile_field_memo->setDbValue($rs->fields('profile_field_memo'));
		$this->userlevel_segn->setDbValue($rs->fields('userlevel_segn'));
		$this->userlevel_cellule->setDbValue($rs->fields('userlevel_cellule'));
		$this->accettazione->setDbValue(ConvertToBool($rs->fields('accettazione')) ? "1" : "0");
		$this->created->setDbValue($rs->fields('created'));
		$this->changed->setDbValue($rs->fields('changed'));
		$this->fk_comune->setDbValue($rs->fields('fk_comune'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// name
		// pass
		// mail
		// langcode
		// preferred_langcode
		// preferred_admin_langcode
		// timezone
		// status
		// access
		// login
		// init
		// default_langcode
		// userlevel
		// profile_field_memo
		// userlevel_segn
		// userlevel_cellule
		// accettazione
		// created
		// changed
		// fk_comune
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->ViewCustomAttributes = "";

		// pass
		$this->pass->ViewValue = $this->pass->CurrentValue;
		$this->pass->ViewCustomAttributes = "";

		// mail
		$this->mail->ViewValue = $this->mail->CurrentValue;
		$this->mail->ViewCustomAttributes = "";

		// langcode
		$this->langcode->ViewValue = $this->langcode->CurrentValue;
		$this->langcode->ViewCustomAttributes = "";

		// preferred_langcode
		$this->preferred_langcode->ViewValue = $this->preferred_langcode->CurrentValue;
		$this->preferred_langcode->ViewCustomAttributes = "";

		// preferred_admin_langcode
		$this->preferred_admin_langcode->ViewValue = $this->preferred_admin_langcode->CurrentValue;
		$this->preferred_admin_langcode->ViewCustomAttributes = "";

		// timezone
		$this->timezone->ViewValue = $this->timezone->CurrentValue;
		$this->timezone->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) <> "") {
			$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// access
		$this->access->ViewValue = $this->access->CurrentValue;
		$this->access->ViewValue = FormatNumber($this->access->ViewValue, 0, -2, -2, -2);
		$this->access->ViewCustomAttributes = "";

		// login
		$this->_login->ViewValue = $this->_login->CurrentValue;
		$this->_login->ViewValue = FormatNumber($this->_login->ViewValue, 0, -2, -2, -2);
		$this->_login->ViewCustomAttributes = "";

		// init
		$this->init->ViewValue = $this->init->CurrentValue;
		$this->init->ViewCustomAttributes = "";

		// default_langcode
		$this->default_langcode->ViewValue = $this->default_langcode->CurrentValue;
		$this->default_langcode->ViewValue = FormatNumber($this->default_langcode->ViewValue, 0, -2, -2, -2);
		$this->default_langcode->ViewCustomAttributes = "";

		// userlevel
		if ($Security->canAdmin()) { // System admin
		$curVal = strval($this->userlevel->CurrentValue);
		if ($curVal <> "") {
			$this->userlevel->ViewValue = $this->userlevel->lookupCacheOption($curVal);
			if ($this->userlevel->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"userlevelid\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->userlevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->userlevel->ViewValue = $this->userlevel->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->userlevel->ViewValue = $this->userlevel->CurrentValue;
				}
			}
		} else {
			$this->userlevel->ViewValue = NULL;
		}
		} else {
			$this->userlevel->ViewValue = $Language->phrase("PasswordMask");
		}
		$this->userlevel->ViewCustomAttributes = "";

		// profile_field_memo
		$this->profile_field_memo->ViewValue = $this->profile_field_memo->CurrentValue;
		$this->profile_field_memo->ViewCustomAttributes = "";

		// userlevel_segn
		$this->userlevel_segn->ViewValue = $this->userlevel_segn->CurrentValue;
		$this->userlevel_segn->ViewValue = FormatNumber($this->userlevel_segn->ViewValue, 0, -2, -2, -2);
		$this->userlevel_segn->ViewCustomAttributes = "";

		// userlevel_cellule
		$this->userlevel_cellule->ViewValue = $this->userlevel_cellule->CurrentValue;
		$this->userlevel_cellule->ViewValue = FormatNumber($this->userlevel_cellule->ViewValue, 0, -2, -2, -2);
		$this->userlevel_cellule->ViewCustomAttributes = "";

		// accettazione
		if (ConvertToBool($this->accettazione->CurrentValue)) {
			$this->accettazione->ViewValue = $this->accettazione->tagCaption(1) <> "" ? $this->accettazione->tagCaption(1) : "Yes";
		} else {
			$this->accettazione->ViewValue = $this->accettazione->tagCaption(2) <> "" ? $this->accettazione->tagCaption(2) : "No";
		}
		$this->accettazione->ViewCustomAttributes = "";

		// created
		$this->created->ViewValue = $this->created->CurrentValue;
		$this->created->ViewValue = FormatDateTime($this->created->ViewValue, 0);
		$this->created->ViewCustomAttributes = "";

		// changed
		$this->changed->ViewValue = $this->changed->CurrentValue;
		$this->changed->ViewValue = FormatDateTime($this->changed->ViewValue, 0);
		$this->changed->ViewCustomAttributes = "";

		// fk_comune
		$curVal = strval($this->fk_comune->CurrentValue);
		if ($curVal <> "") {
			$this->fk_comune->ViewValue = $this->fk_comune->lookupCacheOption($curVal);
			if ($this->fk_comune->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->fk_comune->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->fk_comune->ViewValue = $this->fk_comune->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->fk_comune->ViewValue = $this->fk_comune->CurrentValue;
				}
			}
		} else {
			$this->fk_comune->ViewValue = NULL;
		}
		$this->fk_comune->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// name
		$this->name->LinkCustomAttributes = "";
		$this->name->HrefValue = "";
		$this->name->TooltipValue = "";

		// pass
		$this->pass->LinkCustomAttributes = "";
		$this->pass->HrefValue = "";
		$this->pass->TooltipValue = "";

		// mail
		$this->mail->LinkCustomAttributes = "";
		$this->mail->HrefValue = "";
		$this->mail->TooltipValue = "";

		// langcode
		$this->langcode->LinkCustomAttributes = "";
		$this->langcode->HrefValue = "";
		$this->langcode->TooltipValue = "";

		// preferred_langcode
		$this->preferred_langcode->LinkCustomAttributes = "";
		$this->preferred_langcode->HrefValue = "";
		$this->preferred_langcode->TooltipValue = "";

		// preferred_admin_langcode
		$this->preferred_admin_langcode->LinkCustomAttributes = "";
		$this->preferred_admin_langcode->HrefValue = "";
		$this->preferred_admin_langcode->TooltipValue = "";

		// timezone
		$this->timezone->LinkCustomAttributes = "";
		$this->timezone->HrefValue = "";
		$this->timezone->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// access
		$this->access->LinkCustomAttributes = "";
		$this->access->HrefValue = "";
		$this->access->TooltipValue = "";

		// login
		$this->_login->LinkCustomAttributes = "";
		$this->_login->HrefValue = "";
		$this->_login->TooltipValue = "";

		// init
		$this->init->LinkCustomAttributes = "";
		$this->init->HrefValue = "";
		$this->init->TooltipValue = "";

		// default_langcode
		$this->default_langcode->LinkCustomAttributes = "";
		$this->default_langcode->HrefValue = "";
		$this->default_langcode->TooltipValue = "";

		// userlevel
		$this->userlevel->LinkCustomAttributes = "";
		$this->userlevel->HrefValue = "";
		$this->userlevel->TooltipValue = "";

		// profile_field_memo
		$this->profile_field_memo->LinkCustomAttributes = "";
		$this->profile_field_memo->HrefValue = "";
		$this->profile_field_memo->TooltipValue = "";

		// userlevel_segn
		$this->userlevel_segn->LinkCustomAttributes = "";
		$this->userlevel_segn->HrefValue = "";
		$this->userlevel_segn->TooltipValue = "";

		// userlevel_cellule
		$this->userlevel_cellule->LinkCustomAttributes = "";
		$this->userlevel_cellule->HrefValue = "";
		$this->userlevel_cellule->TooltipValue = "";

		// accettazione
		$this->accettazione->LinkCustomAttributes = "";
		$this->accettazione->HrefValue = "";
		$this->accettazione->TooltipValue = "";

		// created
		$this->created->LinkCustomAttributes = "";
		$this->created->HrefValue = "";
		$this->created->TooltipValue = "";

		// changed
		$this->changed->LinkCustomAttributes = "";
		$this->changed->HrefValue = "";
		$this->changed->TooltipValue = "";

		// fk_comune
		$this->fk_comune->LinkCustomAttributes = "";
		$this->fk_comune->HrefValue = "";
		$this->fk_comune->TooltipValue = "";

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
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->EditAttrs["class"] = "form-control";
		$this->name->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
		$this->name->EditValue = $this->name->CurrentValue;
		$this->name->PlaceHolder = RemoveHtml($this->name->caption());

		// pass
		$this->pass->EditAttrs["class"] = "form-control";
		$this->pass->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->pass->CurrentValue = HtmlDecode($this->pass->CurrentValue);
		$this->pass->EditValue = $this->pass->CurrentValue;
		$this->pass->PlaceHolder = RemoveHtml($this->pass->caption());

		// mail
		$this->mail->EditAttrs["class"] = "form-control";
		$this->mail->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->mail->CurrentValue = HtmlDecode($this->mail->CurrentValue);
		$this->mail->EditValue = $this->mail->CurrentValue;
		$this->mail->PlaceHolder = RemoveHtml($this->mail->caption());

		// langcode
		$this->langcode->EditAttrs["class"] = "form-control";
		$this->langcode->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->langcode->CurrentValue = HtmlDecode($this->langcode->CurrentValue);
		$this->langcode->EditValue = $this->langcode->CurrentValue;
		$this->langcode->PlaceHolder = RemoveHtml($this->langcode->caption());

		// preferred_langcode
		$this->preferred_langcode->EditAttrs["class"] = "form-control";
		$this->preferred_langcode->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->preferred_langcode->CurrentValue = HtmlDecode($this->preferred_langcode->CurrentValue);
		$this->preferred_langcode->EditValue = $this->preferred_langcode->CurrentValue;
		$this->preferred_langcode->PlaceHolder = RemoveHtml($this->preferred_langcode->caption());

		// preferred_admin_langcode
		$this->preferred_admin_langcode->EditAttrs["class"] = "form-control";
		$this->preferred_admin_langcode->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->preferred_admin_langcode->CurrentValue = HtmlDecode($this->preferred_admin_langcode->CurrentValue);
		$this->preferred_admin_langcode->EditValue = $this->preferred_admin_langcode->CurrentValue;
		$this->preferred_admin_langcode->PlaceHolder = RemoveHtml($this->preferred_admin_langcode->caption());

		// timezone
		$this->timezone->EditAttrs["class"] = "form-control";
		$this->timezone->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->timezone->CurrentValue = HtmlDecode($this->timezone->CurrentValue);
		$this->timezone->EditValue = $this->timezone->CurrentValue;
		$this->timezone->PlaceHolder = RemoveHtml($this->timezone->caption());

		// status
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->options(FALSE);

		// access
		$this->access->EditAttrs["class"] = "form-control";
		$this->access->EditCustomAttributes = "";
		$this->access->EditValue = $this->access->CurrentValue;
		$this->access->PlaceHolder = RemoveHtml($this->access->caption());

		// login
		$this->_login->EditAttrs["class"] = "form-control";
		$this->_login->EditCustomAttributes = "";
		$this->_login->EditValue = $this->_login->CurrentValue;
		$this->_login->PlaceHolder = RemoveHtml($this->_login->caption());

		// init
		$this->init->EditAttrs["class"] = "form-control";
		$this->init->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->init->CurrentValue = HtmlDecode($this->init->CurrentValue);
		$this->init->EditValue = $this->init->CurrentValue;
		$this->init->PlaceHolder = RemoveHtml($this->init->caption());

		// default_langcode
		$this->default_langcode->EditAttrs["class"] = "form-control";
		$this->default_langcode->EditCustomAttributes = "";
		$this->default_langcode->EditValue = $this->default_langcode->CurrentValue;
		$this->default_langcode->PlaceHolder = RemoveHtml($this->default_langcode->caption());

		// userlevel
		$this->userlevel->EditAttrs["class"] = "form-control";
		$this->userlevel->EditCustomAttributes = "";
		if (!$Security->canAdmin()) { // System admin
			$this->userlevel->EditValue = $Language->phrase("PasswordMask");
		} else {
		}

		// profile_field_memo
		$this->profile_field_memo->EditAttrs["class"] = "form-control";
		$this->profile_field_memo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->profile_field_memo->CurrentValue = HtmlDecode($this->profile_field_memo->CurrentValue);
		$this->profile_field_memo->EditValue = $this->profile_field_memo->CurrentValue;
		$this->profile_field_memo->PlaceHolder = RemoveHtml($this->profile_field_memo->caption());

		// userlevel_segn
		$this->userlevel_segn->EditAttrs["class"] = "form-control";
		$this->userlevel_segn->EditCustomAttributes = "";
		$this->userlevel_segn->EditValue = $this->userlevel_segn->CurrentValue;
		$this->userlevel_segn->PlaceHolder = RemoveHtml($this->userlevel_segn->caption());

		// userlevel_cellule
		$this->userlevel_cellule->EditAttrs["class"] = "form-control";
		$this->userlevel_cellule->EditCustomAttributes = "";
		$this->userlevel_cellule->EditValue = $this->userlevel_cellule->CurrentValue;
		$this->userlevel_cellule->PlaceHolder = RemoveHtml($this->userlevel_cellule->caption());

		// accettazione
		$this->accettazione->EditCustomAttributes = "";
		$this->accettazione->EditValue = $this->accettazione->options(FALSE);

		// created
		$this->created->EditAttrs["class"] = "form-control";
		$this->created->EditCustomAttributes = "";
		$this->created->EditValue = FormatDateTime($this->created->CurrentValue, 8);
		$this->created->PlaceHolder = RemoveHtml($this->created->caption());

		// changed
		$this->changed->EditAttrs["class"] = "form-control";
		$this->changed->EditCustomAttributes = "";
		$this->changed->EditValue = FormatDateTime($this->changed->CurrentValue, 8);
		$this->changed->PlaceHolder = RemoveHtml($this->changed->caption());

		// fk_comune
		$this->fk_comune->EditAttrs["class"] = "form-control";
		$this->fk_comune->EditCustomAttributes = "";

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
					$doc->exportCaption($this->name);
					$doc->exportCaption($this->pass);
					$doc->exportCaption($this->mail);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->userlevel);
					$doc->exportCaption($this->fk_comune);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->name);
					$doc->exportCaption($this->pass);
					$doc->exportCaption($this->mail);
					$doc->exportCaption($this->langcode);
					$doc->exportCaption($this->preferred_langcode);
					$doc->exportCaption($this->preferred_admin_langcode);
					$doc->exportCaption($this->timezone);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->access);
					$doc->exportCaption($this->_login);
					$doc->exportCaption($this->init);
					$doc->exportCaption($this->default_langcode);
					$doc->exportCaption($this->userlevel);
					$doc->exportCaption($this->profile_field_memo);
					$doc->exportCaption($this->userlevel_segn);
					$doc->exportCaption($this->userlevel_cellule);
					$doc->exportCaption($this->accettazione);
					$doc->exportCaption($this->created);
					$doc->exportCaption($this->changed);
					$doc->exportCaption($this->fk_comune);
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
						$doc->exportField($this->name);
						$doc->exportField($this->pass);
						$doc->exportField($this->mail);
						$doc->exportField($this->status);
						$doc->exportField($this->userlevel);
						$doc->exportField($this->fk_comune);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->name);
						$doc->exportField($this->pass);
						$doc->exportField($this->mail);
						$doc->exportField($this->langcode);
						$doc->exportField($this->preferred_langcode);
						$doc->exportField($this->preferred_admin_langcode);
						$doc->exportField($this->timezone);
						$doc->exportField($this->status);
						$doc->exportField($this->access);
						$doc->exportField($this->_login);
						$doc->exportField($this->init);
						$doc->exportField($this->default_langcode);
						$doc->exportField($this->userlevel);
						$doc->exportField($this->profile_field_memo);
						$doc->exportField($this->userlevel_segn);
						$doc->exportField($this->userlevel_cellule);
						$doc->exportField($this->accettazione);
						$doc->exportField($this->created);
						$doc->exportField($this->changed);
						$doc->exportField($this->fk_comune);
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

	// User ID filter
	public function getUserIDFilter($userId)
	{
		$userIdFilter = '"id" = ' . QuotedValue($userId, DATATYPE_NUMBER, USER_TABLE_DBID);
		return $userIdFilter;
	}

	// Add User ID filter
	public function addUserIDFilter($filter = "")
	{
		global $Security;
		$filterWrk = "";
		$id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
		if (!$this->userIdAllow($id) && !$Security->isAdmin()) {
			$filterWrk = $Security->userIdList();
			if ($filterWrk <> "")
				$filterWrk = '"id" IN (' . $filterWrk . ')';
		}

		// Call User ID Filtering event
		$this->UserID_Filtering($filterWrk);
		AddFilter($filter, $filterWrk);
		return $filter;
	}

	// User ID subquery
	public function getUserIDSubquery(&$fld, &$masterfld)
	{
		global $UserTableConn;
		$wrk = "";
		$sql = "SELECT " . $masterfld->Expression . " FROM \"unlockpa\".\"utenti\"";
		$filter = $this->addUserIDFilter("");
		if ($filter <> "")
			$sql .= " WHERE " . $filter;

		// Use subquery
		if (USE_SUBQUERY_FOR_MASTER_USER_ID) {
			$wrk = $sql;
		} else {

			// List all values
			if ($rs = $UserTableConn->execute($sql)) {
				while (!$rs->EOF) {
					if ($wrk <> "")
						$wrk .= ",";
					$wrk .= QuotedValue($rs->fields[0], $masterfld->DataType, USER_TABLE_DBID);
					$rs->moveNext();
				}
				$rs->close();
			}
		}
		if ($wrk <> "")
			$wrk = $fld->Expression . " IN (" . $wrk . ")";
		return $wrk;
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

	// Send register email
	public function sendRegisterEmail($row)
	{
		$email = $this->prepareRegisterEmail($row);
		$args = array();
		$args["rs"] = $row;
		$emailSent = FALSE;
		if ($this->Email_Sending($email, $args)) // NOTE: use Email_Sending server event of user table
			$emailSent = $email->send();
		return $emailSent;
	}

	// Prepare register email
	public function prepareRegisterEmail($row = NULL, $langId = "")
	{
		$email = new Email();
		$email->load(EMAIL_REGISTER_TEMPLATE, $langId);
		$receiverEmail = $row == NULL ? $this->mail->CurrentValue : $row['mail'];
		if ($receiverEmail == "") { // Send to recipient directly
			$receiverEmail = RECIPIENT_EMAIL;
			$bccEmail = "";
		} else { // Bcc recipient
			$bccEmail = RECIPIENT_EMAIL;
		}
		$email->replaceSender(SENDER_EMAIL); // Replace Sender
		$email->replaceRecipient($receiverEmail); // Replace Recipient
		if ($bccEmail <> "") // Add Bcc
			$email->addBcc($bccEmail);
		$email->replaceContent('<!--FieldCaption_name-->', $this->name->caption());
		$email->replaceContent('<!--name-->', $row == NULL ? strval($this->name->FormValue) : $row['name']);
		$email->replaceContent('<!--FieldCaption_pass-->', $this->pass->caption());
		$email->replaceContent('<!--pass-->', $row == NULL ? strval($this->pass->FormValue) : $row['pass']);
		$email->replaceContent('<!--FieldCaption_mail-->', $this->mail->caption());
		$email->replaceContent('<!--mail-->', $row == NULL ? strval($this->mail->FormValue) : $row['mail']);
		$loginID = $row == NULL ? $this->mail->CurrentValue : $row['mail'];
		$password = $row == NULL ? $this->pass->CurrentValue : $row['pass'];
		$activateLink = FullUrl("register.php", "activate") . "?action=confirm";
		$activateLink .= "&email=" . $receiverEmail;
		$token = Encrypt($receiverEmail) . "," . Encrypt($loginID) . "," . Encrypt($password);
		$activateLink .= "&token=" . $token;
		$email->replaceContent("<!--ActivateLink-->", $activateLink);
		$email->Content = preg_replace('/<!--\s*register_activate_link[\s\S]*?-->/i', '', $email->Content); // Remove comments
		return $email;
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
		$table = 'utenti';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'utenti';

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
				if ($fldname == 'pass')
					$newvalue = $Language->phrase("PasswordMask");
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
		$table = 'utenti';

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
					if ($fldname == 'pass') {
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
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
		$table = 'utenti';

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
				if ($fldname == 'pass')
					$oldvalue = $Language->phrase("PasswordMask");
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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