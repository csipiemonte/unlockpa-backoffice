<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Page class
 */
class utenti_list extends utenti
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{1B294467-F675-48C8-9632-26D78A5119EB}";

	// Table name
	public $TableName = 'utenti';

	// Page object name
	public $PageObjName = "utenti_list";

	// Grid form hidden field names
	public $FormName = "futentilist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;
	public $CancelUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

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
			return $Language->phrase($this->PageID);
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
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
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
	public function getMessages()
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
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (utenti)
		if (!isset($GLOBALS["utenti"]) || get_class($GLOBALS["utenti"]) == PROJECT_NAMESPACE . "utenti") {
			$GLOBALS["utenti"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["utenti"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "utentiadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "utentidelete.php";
		$this->MultiUpdateUrl = "utentiupdate.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'utenti');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (utenti)
		if (!isset($UserTable)) {
			$UserTable = new utenti();
			$UserTableConn = Conn($UserTable->Dbid);
		}

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions();
		$this->ImportOptions->Tag = "div";
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option futentilistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $utenti;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($utenti);
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
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
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
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
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
			$key .= @$ar['id'];
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
			$this->id->Visible = FALSE;
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecs = 20;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $AutoHidePageSizeSelector = AUTO_HIDE_PAGE_SIZE_SELECTOR;
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $RecCnt = 0; // Record count
	public $EditRowCnt;
	public $StartRowCnt = 1;
	public $RowCnt = 0;
	public $Attrs = array(); // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SearchError, $EXPORT;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate();
					return;
				}
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->id->setVisibility();
		$this->name->setVisibility();
		$this->pass->setVisibility();
		$this->mail->setVisibility();
		$this->langcode->Visible = FALSE;
		$this->preferred_langcode->Visible = FALSE;
		$this->preferred_admin_langcode->Visible = FALSE;
		$this->timezone->Visible = FALSE;
		$this->status->setVisibility();
		$this->access->Visible = FALSE;
		$this->_login->Visible = FALSE;
		$this->init->Visible = FALSE;
		$this->default_langcode->Visible = FALSE;
		$this->userlevel->setVisibility();
		$this->profile_field_memo->Visible = FALSE;
		$this->userlevel_segn->Visible = FALSE;
		$this->userlevel_cellule->Visible = FALSE;
		$this->accettazione->Visible = FALSE;
		$this->created->Visible = FALSE;
		$this->changed->Visible = FALSE;
		$this->fk_comune->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();
		$this->ListActions->add("resendregisteremail", $Language->phrase("ResendRegisterEmailBtn"), IsAdmin(), ACTION_AJAX, ACTION_SINGLE);

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->userlevel);
		$this->setupLookupOptions($this->fk_comune);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRec = 1;
			$this->DisplayRecs = $this->GridAddRowCount;
			$this->TotalRecs = $this->DisplayRecs;
			$this->StopRec = $this->DisplayRecs;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecs = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
			$this->StartRec = 1;
			if ($this->DisplayRecs <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecs = $this->TotalRecs;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRec();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecs == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}

			// Audit trail on search
			if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
				$searchParm = ServerVar("QUERY_STRING");
				$searchSql = $this->getSessionWhere();
				$this->writeAuditTrailOnSearch($searchParm, $searchSql);
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecs]);
			$this->terminate(TRUE);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey <> "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter <> "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode($GLOBALS["COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Load server side filters
		if (SEARCH_FILTER_OPTION == "Server" && isset($UserProfile))
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "futentilistsrch");
		$filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
		$filterList = Concat($filterList, $this->name->AdvancedSearch->toJson(), ","); // Field name
		$filterList = Concat($filterList, $this->pass->AdvancedSearch->toJson(), ","); // Field pass
		$filterList = Concat($filterList, $this->mail->AdvancedSearch->toJson(), ","); // Field mail
		$filterList = Concat($filterList, $this->langcode->AdvancedSearch->toJson(), ","); // Field langcode
		$filterList = Concat($filterList, $this->preferred_langcode->AdvancedSearch->toJson(), ","); // Field preferred_langcode
		$filterList = Concat($filterList, $this->preferred_admin_langcode->AdvancedSearch->toJson(), ","); // Field preferred_admin_langcode
		$filterList = Concat($filterList, $this->timezone->AdvancedSearch->toJson(), ","); // Field timezone
		$filterList = Concat($filterList, $this->status->AdvancedSearch->toJson(), ","); // Field status
		$filterList = Concat($filterList, $this->access->AdvancedSearch->toJson(), ","); // Field access
		$filterList = Concat($filterList, $this->_login->AdvancedSearch->toJson(), ","); // Field login
		$filterList = Concat($filterList, $this->init->AdvancedSearch->toJson(), ","); // Field init
		$filterList = Concat($filterList, $this->default_langcode->AdvancedSearch->toJson(), ","); // Field default_langcode
		$filterList = Concat($filterList, $this->userlevel->AdvancedSearch->toJson(), ","); // Field userlevel
		$filterList = Concat($filterList, $this->profile_field_memo->AdvancedSearch->toJson(), ","); // Field profile_field_memo
		$filterList = Concat($filterList, $this->userlevel_segn->AdvancedSearch->toJson(), ","); // Field userlevel_segn
		$filterList = Concat($filterList, $this->userlevel_cellule->AdvancedSearch->toJson(), ","); // Field userlevel_cellule
		$filterList = Concat($filterList, $this->accettazione->AdvancedSearch->toJson(), ","); // Field accettazione
		$filterList = Concat($filterList, $this->created->AdvancedSearch->toJson(), ","); // Field created
		$filterList = Concat($filterList, $this->changed->AdvancedSearch->toJson(), ","); // Field changed
		$filterList = Concat($filterList, $this->fk_comune->AdvancedSearch->toJson(), ","); // Field fk_comune
		if ($this->BasicSearch->Keyword <> "") {
			$wrk = "\"" . TABLE_BASIC_SEARCH . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . TABLE_BASIC_SEARCH_TYPE . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList <> "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList <> "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList <> "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "futentilistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->save();

		// Field name
		$this->name->AdvancedSearch->SearchValue = @$filter["x_name"];
		$this->name->AdvancedSearch->SearchOperator = @$filter["z_name"];
		$this->name->AdvancedSearch->SearchCondition = @$filter["v_name"];
		$this->name->AdvancedSearch->SearchValue2 = @$filter["y_name"];
		$this->name->AdvancedSearch->SearchOperator2 = @$filter["w_name"];
		$this->name->AdvancedSearch->save();

		// Field pass
		$this->pass->AdvancedSearch->SearchValue = @$filter["x_pass"];
		$this->pass->AdvancedSearch->SearchOperator = @$filter["z_pass"];
		$this->pass->AdvancedSearch->SearchCondition = @$filter["v_pass"];
		$this->pass->AdvancedSearch->SearchValue2 = @$filter["y_pass"];
		$this->pass->AdvancedSearch->SearchOperator2 = @$filter["w_pass"];
		$this->pass->AdvancedSearch->save();

		// Field mail
		$this->mail->AdvancedSearch->SearchValue = @$filter["x_mail"];
		$this->mail->AdvancedSearch->SearchOperator = @$filter["z_mail"];
		$this->mail->AdvancedSearch->SearchCondition = @$filter["v_mail"];
		$this->mail->AdvancedSearch->SearchValue2 = @$filter["y_mail"];
		$this->mail->AdvancedSearch->SearchOperator2 = @$filter["w_mail"];
		$this->mail->AdvancedSearch->save();

		// Field langcode
		$this->langcode->AdvancedSearch->SearchValue = @$filter["x_langcode"];
		$this->langcode->AdvancedSearch->SearchOperator = @$filter["z_langcode"];
		$this->langcode->AdvancedSearch->SearchCondition = @$filter["v_langcode"];
		$this->langcode->AdvancedSearch->SearchValue2 = @$filter["y_langcode"];
		$this->langcode->AdvancedSearch->SearchOperator2 = @$filter["w_langcode"];
		$this->langcode->AdvancedSearch->save();

		// Field preferred_langcode
		$this->preferred_langcode->AdvancedSearch->SearchValue = @$filter["x_preferred_langcode"];
		$this->preferred_langcode->AdvancedSearch->SearchOperator = @$filter["z_preferred_langcode"];
		$this->preferred_langcode->AdvancedSearch->SearchCondition = @$filter["v_preferred_langcode"];
		$this->preferred_langcode->AdvancedSearch->SearchValue2 = @$filter["y_preferred_langcode"];
		$this->preferred_langcode->AdvancedSearch->SearchOperator2 = @$filter["w_preferred_langcode"];
		$this->preferred_langcode->AdvancedSearch->save();

		// Field preferred_admin_langcode
		$this->preferred_admin_langcode->AdvancedSearch->SearchValue = @$filter["x_preferred_admin_langcode"];
		$this->preferred_admin_langcode->AdvancedSearch->SearchOperator = @$filter["z_preferred_admin_langcode"];
		$this->preferred_admin_langcode->AdvancedSearch->SearchCondition = @$filter["v_preferred_admin_langcode"];
		$this->preferred_admin_langcode->AdvancedSearch->SearchValue2 = @$filter["y_preferred_admin_langcode"];
		$this->preferred_admin_langcode->AdvancedSearch->SearchOperator2 = @$filter["w_preferred_admin_langcode"];
		$this->preferred_admin_langcode->AdvancedSearch->save();

		// Field timezone
		$this->timezone->AdvancedSearch->SearchValue = @$filter["x_timezone"];
		$this->timezone->AdvancedSearch->SearchOperator = @$filter["z_timezone"];
		$this->timezone->AdvancedSearch->SearchCondition = @$filter["v_timezone"];
		$this->timezone->AdvancedSearch->SearchValue2 = @$filter["y_timezone"];
		$this->timezone->AdvancedSearch->SearchOperator2 = @$filter["w_timezone"];
		$this->timezone->AdvancedSearch->save();

		// Field status
		$this->status->AdvancedSearch->SearchValue = @$filter["x_status"];
		$this->status->AdvancedSearch->SearchOperator = @$filter["z_status"];
		$this->status->AdvancedSearch->SearchCondition = @$filter["v_status"];
		$this->status->AdvancedSearch->SearchValue2 = @$filter["y_status"];
		$this->status->AdvancedSearch->SearchOperator2 = @$filter["w_status"];
		$this->status->AdvancedSearch->save();

		// Field access
		$this->access->AdvancedSearch->SearchValue = @$filter["x_access"];
		$this->access->AdvancedSearch->SearchOperator = @$filter["z_access"];
		$this->access->AdvancedSearch->SearchCondition = @$filter["v_access"];
		$this->access->AdvancedSearch->SearchValue2 = @$filter["y_access"];
		$this->access->AdvancedSearch->SearchOperator2 = @$filter["w_access"];
		$this->access->AdvancedSearch->save();

		// Field login
		$this->_login->AdvancedSearch->SearchValue = @$filter["x__login"];
		$this->_login->AdvancedSearch->SearchOperator = @$filter["z__login"];
		$this->_login->AdvancedSearch->SearchCondition = @$filter["v__login"];
		$this->_login->AdvancedSearch->SearchValue2 = @$filter["y__login"];
		$this->_login->AdvancedSearch->SearchOperator2 = @$filter["w__login"];
		$this->_login->AdvancedSearch->save();

		// Field init
		$this->init->AdvancedSearch->SearchValue = @$filter["x_init"];
		$this->init->AdvancedSearch->SearchOperator = @$filter["z_init"];
		$this->init->AdvancedSearch->SearchCondition = @$filter["v_init"];
		$this->init->AdvancedSearch->SearchValue2 = @$filter["y_init"];
		$this->init->AdvancedSearch->SearchOperator2 = @$filter["w_init"];
		$this->init->AdvancedSearch->save();

		// Field default_langcode
		$this->default_langcode->AdvancedSearch->SearchValue = @$filter["x_default_langcode"];
		$this->default_langcode->AdvancedSearch->SearchOperator = @$filter["z_default_langcode"];
		$this->default_langcode->AdvancedSearch->SearchCondition = @$filter["v_default_langcode"];
		$this->default_langcode->AdvancedSearch->SearchValue2 = @$filter["y_default_langcode"];
		$this->default_langcode->AdvancedSearch->SearchOperator2 = @$filter["w_default_langcode"];
		$this->default_langcode->AdvancedSearch->save();

		// Field userlevel
		$this->userlevel->AdvancedSearch->SearchValue = @$filter["x_userlevel"];
		$this->userlevel->AdvancedSearch->SearchOperator = @$filter["z_userlevel"];
		$this->userlevel->AdvancedSearch->SearchCondition = @$filter["v_userlevel"];
		$this->userlevel->AdvancedSearch->SearchValue2 = @$filter["y_userlevel"];
		$this->userlevel->AdvancedSearch->SearchOperator2 = @$filter["w_userlevel"];
		$this->userlevel->AdvancedSearch->save();

		// Field profile_field_memo
		$this->profile_field_memo->AdvancedSearch->SearchValue = @$filter["x_profile_field_memo"];
		$this->profile_field_memo->AdvancedSearch->SearchOperator = @$filter["z_profile_field_memo"];
		$this->profile_field_memo->AdvancedSearch->SearchCondition = @$filter["v_profile_field_memo"];
		$this->profile_field_memo->AdvancedSearch->SearchValue2 = @$filter["y_profile_field_memo"];
		$this->profile_field_memo->AdvancedSearch->SearchOperator2 = @$filter["w_profile_field_memo"];
		$this->profile_field_memo->AdvancedSearch->save();

		// Field userlevel_segn
		$this->userlevel_segn->AdvancedSearch->SearchValue = @$filter["x_userlevel_segn"];
		$this->userlevel_segn->AdvancedSearch->SearchOperator = @$filter["z_userlevel_segn"];
		$this->userlevel_segn->AdvancedSearch->SearchCondition = @$filter["v_userlevel_segn"];
		$this->userlevel_segn->AdvancedSearch->SearchValue2 = @$filter["y_userlevel_segn"];
		$this->userlevel_segn->AdvancedSearch->SearchOperator2 = @$filter["w_userlevel_segn"];
		$this->userlevel_segn->AdvancedSearch->save();

		// Field userlevel_cellule
		$this->userlevel_cellule->AdvancedSearch->SearchValue = @$filter["x_userlevel_cellule"];
		$this->userlevel_cellule->AdvancedSearch->SearchOperator = @$filter["z_userlevel_cellule"];
		$this->userlevel_cellule->AdvancedSearch->SearchCondition = @$filter["v_userlevel_cellule"];
		$this->userlevel_cellule->AdvancedSearch->SearchValue2 = @$filter["y_userlevel_cellule"];
		$this->userlevel_cellule->AdvancedSearch->SearchOperator2 = @$filter["w_userlevel_cellule"];
		$this->userlevel_cellule->AdvancedSearch->save();

		// Field accettazione
		$this->accettazione->AdvancedSearch->SearchValue = @$filter["x_accettazione"];
		$this->accettazione->AdvancedSearch->SearchOperator = @$filter["z_accettazione"];
		$this->accettazione->AdvancedSearch->SearchCondition = @$filter["v_accettazione"];
		$this->accettazione->AdvancedSearch->SearchValue2 = @$filter["y_accettazione"];
		$this->accettazione->AdvancedSearch->SearchOperator2 = @$filter["w_accettazione"];
		$this->accettazione->AdvancedSearch->save();

		// Field created
		$this->created->AdvancedSearch->SearchValue = @$filter["x_created"];
		$this->created->AdvancedSearch->SearchOperator = @$filter["z_created"];
		$this->created->AdvancedSearch->SearchCondition = @$filter["v_created"];
		$this->created->AdvancedSearch->SearchValue2 = @$filter["y_created"];
		$this->created->AdvancedSearch->SearchOperator2 = @$filter["w_created"];
		$this->created->AdvancedSearch->save();

		// Field changed
		$this->changed->AdvancedSearch->SearchValue = @$filter["x_changed"];
		$this->changed->AdvancedSearch->SearchOperator = @$filter["z_changed"];
		$this->changed->AdvancedSearch->SearchCondition = @$filter["v_changed"];
		$this->changed->AdvancedSearch->SearchValue2 = @$filter["y_changed"];
		$this->changed->AdvancedSearch->SearchOperator2 = @$filter["w_changed"];
		$this->changed->AdvancedSearch->save();

		// Field fk_comune
		$this->fk_comune->AdvancedSearch->SearchValue = @$filter["x_fk_comune"];
		$this->fk_comune->AdvancedSearch->SearchOperator = @$filter["z_fk_comune"];
		$this->fk_comune->AdvancedSearch->SearchCondition = @$filter["v_fk_comune"];
		$this->fk_comune->AdvancedSearch->SearchValue2 = @$filter["y_fk_comune"];
		$this->fk_comune->AdvancedSearch->SearchOperator2 = @$filter["w_fk_comune"];
		$this->fk_comune->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->id, $default, FALSE); // id
		$this->buildSearchSql($where, $this->name, $default, FALSE); // name
		$this->buildSearchSql($where, $this->pass, $default, FALSE); // pass
		$this->buildSearchSql($where, $this->mail, $default, FALSE); // mail
		$this->buildSearchSql($where, $this->langcode, $default, FALSE); // langcode
		$this->buildSearchSql($where, $this->preferred_langcode, $default, FALSE); // preferred_langcode
		$this->buildSearchSql($where, $this->preferred_admin_langcode, $default, FALSE); // preferred_admin_langcode
		$this->buildSearchSql($where, $this->timezone, $default, FALSE); // timezone
		$this->buildSearchSql($where, $this->status, $default, FALSE); // status
		$this->buildSearchSql($where, $this->access, $default, FALSE); // access
		$this->buildSearchSql($where, $this->_login, $default, FALSE); // login
		$this->buildSearchSql($where, $this->init, $default, FALSE); // init
		$this->buildSearchSql($where, $this->default_langcode, $default, FALSE); // default_langcode
		$this->buildSearchSql($where, $this->userlevel, $default, FALSE); // userlevel
		$this->buildSearchSql($where, $this->profile_field_memo, $default, FALSE); // profile_field_memo
		$this->buildSearchSql($where, $this->userlevel_segn, $default, FALSE); // userlevel_segn
		$this->buildSearchSql($where, $this->userlevel_cellule, $default, FALSE); // userlevel_cellule
		$this->buildSearchSql($where, $this->accettazione, $default, FALSE); // accettazione
		$this->buildSearchSql($where, $this->created, $default, FALSE); // created
		$this->buildSearchSql($where, $this->changed, $default, FALSE); // changed
		$this->buildSearchSql($where, $this->fk_comune, $default, FALSE); // fk_comune

		// Set up search parm
		if (!$default && $where <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->id->AdvancedSearch->save(); // id
			$this->name->AdvancedSearch->save(); // name
			$this->pass->AdvancedSearch->save(); // pass
			$this->mail->AdvancedSearch->save(); // mail
			$this->langcode->AdvancedSearch->save(); // langcode
			$this->preferred_langcode->AdvancedSearch->save(); // preferred_langcode
			$this->preferred_admin_langcode->AdvancedSearch->save(); // preferred_admin_langcode
			$this->timezone->AdvancedSearch->save(); // timezone
			$this->status->AdvancedSearch->save(); // status
			$this->access->AdvancedSearch->save(); // access
			$this->_login->AdvancedSearch->save(); // login
			$this->init->AdvancedSearch->save(); // init
			$this->default_langcode->AdvancedSearch->save(); // default_langcode
			$this->userlevel->AdvancedSearch->save(); // userlevel
			$this->profile_field_memo->AdvancedSearch->save(); // profile_field_memo
			$this->userlevel_segn->AdvancedSearch->save(); // userlevel_segn
			$this->userlevel_cellule->AdvancedSearch->save(); // userlevel_cellule
			$this->accettazione->AdvancedSearch->save(); // accettazione
			$this->created->AdvancedSearch->save(); // created
			$this->changed->AdvancedSearch->save(); // changed
			$this->fk_comune->AdvancedSearch->save(); // fk_comune
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (SEARCH_MULTI_VALUE_OPTION == 1)
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal <> "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 <> "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 <> "")
				$wrk = ($wrk <> "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == NULL_VALUE || $fldVal == NOT_NULL_VALUE)
			return $fldVal;
		$value = $fldVal;
		if ($fld->DataType == DATATYPE_BOOLEAN) {
			if ($fldVal <> "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal <> "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->name, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->pass, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->mail, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->langcode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->preferred_langcode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->preferred_admin_langcode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->timezone, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->init, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->profile_field_memo, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		global $BASIC_SEARCH_IGNORE_PATTERN;
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if ($BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$keyword = preg_replace($BASIC_SEARCH_IGNORE_PATTERN, "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = array($keyword);
			}
			foreach ($ar as $keyword) {
				if ($keyword <> "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == NULL_VALUE) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == NOT_NULL_VALUE) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk <> "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] <> "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql <> "") {
			if ($where <> "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword <> "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword <> "") {
						if ($searchStr <> "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql(array($keyword), $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, array("", "reset", "resetall")))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->name->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->pass->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->mail->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->langcode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->preferred_langcode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->preferred_admin_langcode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->timezone->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->status->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->access->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->_login->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->init->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->default_langcode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->userlevel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->profile_field_memo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->userlevel_segn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->userlevel_cellule->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->accettazione->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->created->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->changed->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->fk_comune->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->id->AdvancedSearch->unsetSession();
		$this->name->AdvancedSearch->unsetSession();
		$this->pass->AdvancedSearch->unsetSession();
		$this->mail->AdvancedSearch->unsetSession();
		$this->langcode->AdvancedSearch->unsetSession();
		$this->preferred_langcode->AdvancedSearch->unsetSession();
		$this->preferred_admin_langcode->AdvancedSearch->unsetSession();
		$this->timezone->AdvancedSearch->unsetSession();
		$this->status->AdvancedSearch->unsetSession();
		$this->access->AdvancedSearch->unsetSession();
		$this->_login->AdvancedSearch->unsetSession();
		$this->init->AdvancedSearch->unsetSession();
		$this->default_langcode->AdvancedSearch->unsetSession();
		$this->userlevel->AdvancedSearch->unsetSession();
		$this->profile_field_memo->AdvancedSearch->unsetSession();
		$this->userlevel_segn->AdvancedSearch->unsetSession();
		$this->userlevel_cellule->AdvancedSearch->unsetSession();
		$this->accettazione->AdvancedSearch->unsetSession();
		$this->created->AdvancedSearch->unsetSession();
		$this->changed->AdvancedSearch->unsetSession();
		$this->fk_comune->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->id->AdvancedSearch->load();
		$this->name->AdvancedSearch->load();
		$this->pass->AdvancedSearch->load();
		$this->mail->AdvancedSearch->load();
		$this->langcode->AdvancedSearch->load();
		$this->preferred_langcode->AdvancedSearch->load();
		$this->preferred_admin_langcode->AdvancedSearch->load();
		$this->timezone->AdvancedSearch->load();
		$this->status->AdvancedSearch->load();
		$this->access->AdvancedSearch->load();
		$this->_login->AdvancedSearch->load();
		$this->init->AdvancedSearch->load();
		$this->default_langcode->AdvancedSearch->load();
		$this->userlevel->AdvancedSearch->load();
		$this->profile_field_memo->AdvancedSearch->load();
		$this->userlevel_segn->AdvancedSearch->load();
		$this->userlevel_cellule->AdvancedSearch->load();
		$this->accettazione->AdvancedSearch->load();
		$this->created->AdvancedSearch->load();
		$this->changed->AdvancedSearch->load();
		$this->fk_comune->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->id); // id
			$this->updateSort($this->name); // name
			$this->updateSort($this->pass); // pass
			$this->updateSort($this->mail); // mail
			$this->updateSort($this->status); // status
			$this->updateSort($this->userlevel); // userlevel
			$this->updateSort($this->fk_comune); // fk_comune
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
				$this->id->setSort("ASC");
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->id->setSort("");
				$this->name->setSort("");
				$this->pass->setSort("");
				$this->mail->setSort("");
				$this->status->setSort("");
				$this->userlevel->setSort("");
				$this->fk_comune->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew.selectAllKey(this);\">";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = &$this->ListOptions->getItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$opt = &$this->ListOptions->Items["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView() && $this->showOptionLink('view')) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit() && $this->showOptionLink('edit')) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = &$this->ListOptions->Items["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd() && $this->showOptionLink('add')) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = &$this->ListOptions->Items["delete"];
		if ($Security->canDelete() && $this->showOptionLink('delete'))
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

		// Set up list action buttons
		$opt = &$this->ListOptions->getItem("listactions");
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $Language->phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = &$this->ListOptions->Items["checkbox"];
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"futentilistsrch\" href=\"#\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"futentilistsrch\" href=\"#\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.futentilist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->getItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		global $UserProfile;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter <> "" && $userAction <> "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions->Items[$userAction]->Caption;
				if (!$this->ListActions->Items[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$user = $row['mail'];
					if ($userlist <> "")
						$userlist .= ",";
					$userlist .= $user;
					if ($userAction == "resendregisteremail")
						$processed = $this->sendRegisterEmail($row);
					elseif ($userAction == "resetconcurrentuser")
						$processed = FALSE;
					elseif ($userAction == "resetloginretry")
						$processed = FALSE;
					elseif ($userAction == "setpasswordexpired")
						$processed = FALSE;
					else
						$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($userAction == "resendregisteremail")
						$this->setSuccessMessage(str_replace('%u', $userlist, $Language->phrase("ResendRegisterEmailSuccess")));
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes
					if ($userAction == "resendregisteremail")
						$this->setFailureMessage(str_replace('%u', $user, $Language->phrase("ResendRegisterEmailFailure")));

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere <> "") ? " active" : "";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"futentilistsrch\">" . $Language->phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}
	protected function setupListOptionsExt()
	{
		global $Security, $Language;
	}
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
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

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(TABLE_BASIC_SEARCH, ""), FALSE);
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(TABLE_BASIC_SEARCH_TYPE, ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// id

		if (!$this->isAddOrEdit())
			$this->id->AdvancedSearch->setSearchValue(Get("x_id", Get("id", "")));
		if ($this->id->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->id->AdvancedSearch->setSearchOperator(Get("z_id", ""));

		// name
		if (!$this->isAddOrEdit())
			$this->name->AdvancedSearch->setSearchValue(Get("x_name", Get("name", "")));
		if ($this->name->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->name->AdvancedSearch->setSearchOperator(Get("z_name", ""));

		// pass
		if (!$this->isAddOrEdit())
			$this->pass->AdvancedSearch->setSearchValue(Get("x_pass", Get("pass", "")));
		if ($this->pass->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->pass->AdvancedSearch->setSearchOperator(Get("z_pass", ""));

		// mail
		if (!$this->isAddOrEdit())
			$this->mail->AdvancedSearch->setSearchValue(Get("x_mail", Get("mail", "")));
		if ($this->mail->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->mail->AdvancedSearch->setSearchOperator(Get("z_mail", ""));

		// langcode
		if (!$this->isAddOrEdit())
			$this->langcode->AdvancedSearch->setSearchValue(Get("x_langcode", Get("langcode", "")));
		if ($this->langcode->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->langcode->AdvancedSearch->setSearchOperator(Get("z_langcode", ""));

		// preferred_langcode
		if (!$this->isAddOrEdit())
			$this->preferred_langcode->AdvancedSearch->setSearchValue(Get("x_preferred_langcode", Get("preferred_langcode", "")));
		if ($this->preferred_langcode->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->preferred_langcode->AdvancedSearch->setSearchOperator(Get("z_preferred_langcode", ""));

		// preferred_admin_langcode
		if (!$this->isAddOrEdit())
			$this->preferred_admin_langcode->AdvancedSearch->setSearchValue(Get("x_preferred_admin_langcode", Get("preferred_admin_langcode", "")));
		if ($this->preferred_admin_langcode->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->preferred_admin_langcode->AdvancedSearch->setSearchOperator(Get("z_preferred_admin_langcode", ""));

		// timezone
		if (!$this->isAddOrEdit())
			$this->timezone->AdvancedSearch->setSearchValue(Get("x_timezone", Get("timezone", "")));
		if ($this->timezone->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->timezone->AdvancedSearch->setSearchOperator(Get("z_timezone", ""));

		// status
		if (!$this->isAddOrEdit())
			$this->status->AdvancedSearch->setSearchValue(Get("x_status", Get("status", "")));
		if ($this->status->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->status->AdvancedSearch->setSearchOperator(Get("z_status", ""));

		// access
		if (!$this->isAddOrEdit())
			$this->access->AdvancedSearch->setSearchValue(Get("x_access", Get("access", "")));
		if ($this->access->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->access->AdvancedSearch->setSearchOperator(Get("z_access", ""));

		// login
		if (!$this->isAddOrEdit())
			$this->_login->AdvancedSearch->setSearchValue(Get("x__login", Get("_login", "")));
		if ($this->_login->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->_login->AdvancedSearch->setSearchOperator(Get("z__login", ""));

		// init
		if (!$this->isAddOrEdit())
			$this->init->AdvancedSearch->setSearchValue(Get("x_init", Get("init", "")));
		if ($this->init->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->init->AdvancedSearch->setSearchOperator(Get("z_init", ""));

		// default_langcode
		if (!$this->isAddOrEdit())
			$this->default_langcode->AdvancedSearch->setSearchValue(Get("x_default_langcode", Get("default_langcode", "")));
		if ($this->default_langcode->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->default_langcode->AdvancedSearch->setSearchOperator(Get("z_default_langcode", ""));

		// userlevel
		if (!$this->isAddOrEdit())
			$this->userlevel->AdvancedSearch->setSearchValue(Get("x_userlevel", Get("userlevel", "")));
		if ($this->userlevel->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->userlevel->AdvancedSearch->setSearchOperator(Get("z_userlevel", ""));

		// profile_field_memo
		if (!$this->isAddOrEdit())
			$this->profile_field_memo->AdvancedSearch->setSearchValue(Get("x_profile_field_memo", Get("profile_field_memo", "")));
		if ($this->profile_field_memo->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->profile_field_memo->AdvancedSearch->setSearchOperator(Get("z_profile_field_memo", ""));

		// userlevel_segn
		if (!$this->isAddOrEdit())
			$this->userlevel_segn->AdvancedSearch->setSearchValue(Get("x_userlevel_segn", Get("userlevel_segn", "")));
		if ($this->userlevel_segn->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->userlevel_segn->AdvancedSearch->setSearchOperator(Get("z_userlevel_segn", ""));

		// userlevel_cellule
		if (!$this->isAddOrEdit())
			$this->userlevel_cellule->AdvancedSearch->setSearchValue(Get("x_userlevel_cellule", Get("userlevel_cellule", "")));
		if ($this->userlevel_cellule->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->userlevel_cellule->AdvancedSearch->setSearchOperator(Get("z_userlevel_cellule", ""));

		// accettazione
		if (!$this->isAddOrEdit())
			$this->accettazione->AdvancedSearch->setSearchValue(Get("x_accettazione", Get("accettazione", "")));
		if ($this->accettazione->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->accettazione->AdvancedSearch->setSearchOperator(Get("z_accettazione", ""));
		if (is_array($this->accettazione->AdvancedSearch->SearchValue))
			$this->accettazione->AdvancedSearch->SearchValue = implode(",", $this->accettazione->AdvancedSearch->SearchValue);
		if (is_array($this->accettazione->AdvancedSearch->SearchValue2))
			$this->accettazione->AdvancedSearch->SearchValue2 = implode(",", $this->accettazione->AdvancedSearch->SearchValue2);

		// created
		if (!$this->isAddOrEdit())
			$this->created->AdvancedSearch->setSearchValue(Get("x_created", Get("created", "")));
		if ($this->created->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->created->AdvancedSearch->setSearchOperator(Get("z_created", ""));

		// changed
		if (!$this->isAddOrEdit())
			$this->changed->AdvancedSearch->setSearchValue(Get("x_changed", Get("changed", "")));
		if ($this->changed->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->changed->AdvancedSearch->setSearchOperator(Get("z_changed", ""));

		// fk_comune
		if (!$this->isAddOrEdit())
			$this->fk_comune->AdvancedSearch->setSearchValue(Get("x_fk_comune", Get("fk_comune", "")));
		if ($this->fk_comune->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->fk_comune->AdvancedSearch->setSearchOperator(Get("z_fk_comune", ""));
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = &$this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->id->setDbValue($row['id']);
		$this->name->setDbValue($row['name']);
		$this->pass->setDbValue($row['pass']);
		$this->mail->setDbValue($row['mail']);
		$this->langcode->setDbValue($row['langcode']);
		$this->preferred_langcode->setDbValue($row['preferred_langcode']);
		$this->preferred_admin_langcode->setDbValue($row['preferred_admin_langcode']);
		$this->timezone->setDbValue($row['timezone']);
		$this->status->setDbValue($row['status']);
		$this->access->setDbValue($row['access']);
		$this->_login->setDbValue($row['login']);
		$this->init->setDbValue($row['init']);
		$this->default_langcode->setDbValue($row['default_langcode']);
		$this->userlevel->setDbValue($row['userlevel']);
		$this->profile_field_memo->setDbValue($row['profile_field_memo']);
		$this->userlevel_segn->setDbValue($row['userlevel_segn']);
		$this->userlevel_cellule->setDbValue($row['userlevel_cellule']);
		$this->accettazione->setDbValue((ConvertToBool($row['accettazione']) ? "1" : "0"));
		$this->created->setDbValue($row['created']);
		$this->changed->setDbValue($row['changed']);
		$this->fk_comune->setDbValue($row['fk_comune']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['name'] = NULL;
		$row['pass'] = NULL;
		$row['mail'] = NULL;
		$row['langcode'] = NULL;
		$row['preferred_langcode'] = NULL;
		$row['preferred_admin_langcode'] = NULL;
		$row['timezone'] = NULL;
		$row['status'] = NULL;
		$row['access'] = NULL;
		$row['login'] = NULL;
		$row['init'] = NULL;
		$row['default_langcode'] = NULL;
		$row['userlevel'] = NULL;
		$row['profile_field_memo'] = NULL;
		$row['userlevel_segn'] = NULL;
		$row['userlevel_cellule'] = NULL;
		$row['accettazione'] = NULL;
		$row['created'] = NULL;
		$row['changed'] = NULL;
		$row['fk_comune'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// userlevel
			$this->userlevel->LinkCustomAttributes = "";
			$this->userlevel->HrefValue = "";
			$this->userlevel->TooltipValue = "";

			// fk_comune
			$this->fk_comune->LinkCustomAttributes = "";
			$this->fk_comune->HrefValue = "";
			$this->fk_comune->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow($this->CurrentAction)) { // Non system admin
				$this->id->AdvancedSearch->SearchValue = CurrentUserID();
			$this->id->EditValue = $this->id->AdvancedSearch->SearchValue;
			$this->id->ViewCustomAttributes = "";
			} else {
			$this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
			$this->id->PlaceHolder = RemoveHtml($this->id->caption());
			}

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->name->AdvancedSearch->SearchValue = HtmlDecode($this->name->AdvancedSearch->SearchValue);
			$this->name->EditValue = HtmlEncode($this->name->AdvancedSearch->SearchValue);
			$this->name->PlaceHolder = RemoveHtml($this->name->caption());

			// pass
			$this->pass->EditAttrs["class"] = "form-control";
			$this->pass->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->pass->AdvancedSearch->SearchValue = HtmlDecode($this->pass->AdvancedSearch->SearchValue);
			$this->pass->EditValue = HtmlEncode($this->pass->AdvancedSearch->SearchValue);
			$this->pass->PlaceHolder = RemoveHtml($this->pass->caption());

			// mail
			$this->mail->EditAttrs["class"] = "form-control";
			$this->mail->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->mail->AdvancedSearch->SearchValue = HtmlDecode($this->mail->AdvancedSearch->SearchValue);
			$this->mail->EditValue = HtmlEncode($this->mail->AdvancedSearch->SearchValue);
			$this->mail->PlaceHolder = RemoveHtml($this->mail->caption());

			// status
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(FALSE);

			// userlevel
			$this->userlevel->EditAttrs["class"] = "form-control";
			$this->userlevel->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->userlevel->EditValue = $Language->phrase("PasswordMask");
			} else {
			$curVal = trim(strval($this->userlevel->AdvancedSearch->SearchValue));
			if ($curVal <> "")
				$this->userlevel->AdvancedSearch->ViewValue = $this->userlevel->lookupCacheOption($curVal);
			else
				$this->userlevel->AdvancedSearch->ViewValue = $this->userlevel->Lookup !== NULL && is_array($this->userlevel->Lookup->Options) ? $curVal : NULL;
			if ($this->userlevel->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->userlevel->EditValue = array_values($this->userlevel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"userlevelid\"" . SearchString("=", $this->userlevel->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->userlevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->userlevel->EditValue = $arwrk;
			}
			}

			// fk_comune
			$this->fk_comune->EditAttrs["class"] = "form-control";
			$this->fk_comune->EditCustomAttributes = "";
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
		$this->id->AdvancedSearch->load();
		$this->name->AdvancedSearch->load();
		$this->pass->AdvancedSearch->load();
		$this->mail->AdvancedSearch->load();
		$this->langcode->AdvancedSearch->load();
		$this->preferred_langcode->AdvancedSearch->load();
		$this->preferred_admin_langcode->AdvancedSearch->load();
		$this->timezone->AdvancedSearch->load();
		$this->status->AdvancedSearch->load();
		$this->access->AdvancedSearch->load();
		$this->_login->AdvancedSearch->load();
		$this->init->AdvancedSearch->load();
		$this->default_langcode->AdvancedSearch->load();
		$this->userlevel->AdvancedSearch->load();
		$this->profile_field_memo->AdvancedSearch->load();
		$this->userlevel_segn->AdvancedSearch->load();
		$this->userlevel_cellule->AdvancedSearch->load();
		$this->accettazione->AdvancedSearch->load();
		$this->created->AdvancedSearch->load();
		$this->changed->AdvancedSearch->load();
		$this->fk_comune->AdvancedSearch->load();
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->id->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
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
						case "x_userlevel":
							break;
						case "x_fk_comune":
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
}
?>