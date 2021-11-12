<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Page class
 */
class utenti_edit extends utenti
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{1B294467-F675-48C8-9632-26D78A5119EB}";

	// Table name
	public $TableName = 'utenti';

	// Page object name
	public $PageObjName = "utenti_edit";

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
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "utentiview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
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
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("utentilist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("utentilist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
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

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->userlevel);
		$this->setupLookupOptions($this->fk_comune);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
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
			if ($CurrentForm->hasValue("x_id")) {
				$this->id->setFormValue($CurrentForm->getValue("x_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
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
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("utentilist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "utentilist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
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

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);

		// Check field name 'name' first before field var 'x_name'
		$val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
		if (!$this->name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->name->Visible = FALSE; // Disable update for API request
			else
				$this->name->setFormValue($val);
		}

		// Check field name 'pass' first before field var 'x_pass'
		$val = $CurrentForm->hasValue("pass") ? $CurrentForm->getValue("pass") : $CurrentForm->getValue("x_pass");
		if (!$this->pass->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pass->Visible = FALSE; // Disable update for API request
			else
				$this->pass->setFormValue($val);
		}

		// Check field name 'mail' first before field var 'x_mail'
		$val = $CurrentForm->hasValue("mail") ? $CurrentForm->getValue("mail") : $CurrentForm->getValue("x_mail");
		if (!$this->mail->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->mail->Visible = FALSE; // Disable update for API request
			else
				$this->mail->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'userlevel' first before field var 'x_userlevel'
		$val = $CurrentForm->hasValue("userlevel") ? $CurrentForm->getValue("userlevel") : $CurrentForm->getValue("x_userlevel");
		if (!$this->userlevel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->userlevel->Visible = FALSE; // Disable update for API request
			else
				$this->userlevel->setFormValue($val);
		}

		// Check field name 'fk_comune' first before field var 'x_fk_comune'
		$val = $CurrentForm->hasValue("fk_comune") ? $CurrentForm->getValue("fk_comune") : $CurrentForm->getValue("x_fk_comune");
		if (!$this->fk_comune->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fk_comune->Visible = FALSE; // Disable update for API request
			else
				$this->fk_comune->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->pass->CurrentValue = $this->pass->FormValue;
		$this->mail->CurrentValue = $this->mail->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->userlevel->CurrentValue = $this->userlevel->FormValue;
		$this->fk_comune->CurrentValue = $this->fk_comune->FormValue;
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

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('edit');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
			$this->name->EditValue = HtmlEncode($this->name->CurrentValue);
			$this->name->PlaceHolder = RemoveHtml($this->name->caption());

			// pass
			$this->pass->EditAttrs["class"] = "form-control";
			$this->pass->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->pass->CurrentValue = HtmlDecode($this->pass->CurrentValue);
			$this->pass->EditValue = HtmlEncode($this->pass->CurrentValue);
			$this->pass->PlaceHolder = RemoveHtml($this->pass->caption());

			// mail
			$this->mail->EditAttrs["class"] = "form-control";
			$this->mail->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->mail->CurrentValue = HtmlDecode($this->mail->CurrentValue);
			$this->mail->EditValue = HtmlEncode($this->mail->CurrentValue);
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
			$curVal = trim(strval($this->userlevel->CurrentValue));
			if ($curVal <> "")
				$this->userlevel->ViewValue = $this->userlevel->lookupCacheOption($curVal);
			else
				$this->userlevel->ViewValue = $this->userlevel->Lookup !== NULL && is_array($this->userlevel->Lookup->Options) ? $curVal : NULL;
			if ($this->userlevel->ViewValue !== NULL) { // Load from cache
				$this->userlevel->EditValue = array_values($this->userlevel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"userlevelid\"" . SearchString("=", $this->userlevel->CurrentValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->fk_comune->CurrentValue));
			if ($curVal <> "")
				$this->fk_comune->ViewValue = $this->fk_comune->lookupCacheOption($curVal);
			else
				$this->fk_comune->ViewValue = $this->fk_comune->Lookup !== NULL && is_array($this->fk_comune->Lookup->Options) ? $curVal : NULL;
			if ($this->fk_comune->ViewValue !== NULL) { // Load from cache
				$this->fk_comune->EditValue = array_values($this->fk_comune->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"id\"" . SearchString("=", $this->fk_comune->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->fk_comune->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->fk_comune->EditValue = $arwrk;
			}

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";

			// pass
			$this->pass->LinkCustomAttributes = "";
			$this->pass->HrefValue = "";

			// mail
			$this->mail->LinkCustomAttributes = "";
			$this->mail->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// userlevel
			$this->userlevel->LinkCustomAttributes = "";
			$this->userlevel->HrefValue = "";

			// fk_comune
			$this->fk_comune->LinkCustomAttributes = "";
			$this->fk_comune->HrefValue = "";
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
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->name->Required) {
			if (!$this->name->IsDetailKey && $this->name->FormValue != NULL && $this->name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
			}
		}
		if ($this->pass->Required) {
			if (!$this->pass->IsDetailKey && $this->pass->FormValue != NULL && $this->pass->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pass->caption(), $this->pass->RequiredErrorMessage));
			}
		}
		if ($this->mail->Required) {
			if (!$this->mail->IsDetailKey && $this->mail->FormValue != NULL && $this->mail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->mail->caption(), $this->mail->RequiredErrorMessage));
			}
		}
		if ($this->langcode->Required) {
			if (!$this->langcode->IsDetailKey && $this->langcode->FormValue != NULL && $this->langcode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->langcode->caption(), $this->langcode->RequiredErrorMessage));
			}
		}
		if ($this->preferred_langcode->Required) {
			if (!$this->preferred_langcode->IsDetailKey && $this->preferred_langcode->FormValue != NULL && $this->preferred_langcode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->preferred_langcode->caption(), $this->preferred_langcode->RequiredErrorMessage));
			}
		}
		if ($this->preferred_admin_langcode->Required) {
			if (!$this->preferred_admin_langcode->IsDetailKey && $this->preferred_admin_langcode->FormValue != NULL && $this->preferred_admin_langcode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->preferred_admin_langcode->caption(), $this->preferred_admin_langcode->RequiredErrorMessage));
			}
		}
		if ($this->timezone->Required) {
			if (!$this->timezone->IsDetailKey && $this->timezone->FormValue != NULL && $this->timezone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->timezone->caption(), $this->timezone->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if ($this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->access->Required) {
			if (!$this->access->IsDetailKey && $this->access->FormValue != NULL && $this->access->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->access->caption(), $this->access->RequiredErrorMessage));
			}
		}
		if ($this->_login->Required) {
			if (!$this->_login->IsDetailKey && $this->_login->FormValue != NULL && $this->_login->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_login->caption(), $this->_login->RequiredErrorMessage));
			}
		}
		if ($this->init->Required) {
			if (!$this->init->IsDetailKey && $this->init->FormValue != NULL && $this->init->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->init->caption(), $this->init->RequiredErrorMessage));
			}
		}
		if ($this->default_langcode->Required) {
			if (!$this->default_langcode->IsDetailKey && $this->default_langcode->FormValue != NULL && $this->default_langcode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->default_langcode->caption(), $this->default_langcode->RequiredErrorMessage));
			}
		}
		if ($this->userlevel->Required) {
			if (!$this->userlevel->IsDetailKey && $this->userlevel->FormValue != NULL && $this->userlevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->userlevel->caption(), $this->userlevel->RequiredErrorMessage));
			}
		}
		if ($this->profile_field_memo->Required) {
			if (!$this->profile_field_memo->IsDetailKey && $this->profile_field_memo->FormValue != NULL && $this->profile_field_memo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->profile_field_memo->caption(), $this->profile_field_memo->RequiredErrorMessage));
			}
		}
		if ($this->userlevel_segn->Required) {
			if (!$this->userlevel_segn->IsDetailKey && $this->userlevel_segn->FormValue != NULL && $this->userlevel_segn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->userlevel_segn->caption(), $this->userlevel_segn->RequiredErrorMessage));
			}
		}
		if ($this->userlevel_cellule->Required) {
			if (!$this->userlevel_cellule->IsDetailKey && $this->userlevel_cellule->FormValue != NULL && $this->userlevel_cellule->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->userlevel_cellule->caption(), $this->userlevel_cellule->RequiredErrorMessage));
			}
		}
		if ($this->accettazione->Required) {
			if ($this->accettazione->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->accettazione->caption(), $this->accettazione->RequiredErrorMessage));
			}
		}
		if ($this->created->Required) {
			if (!$this->created->IsDetailKey && $this->created->FormValue != NULL && $this->created->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created->caption(), $this->created->RequiredErrorMessage));
			}
		}
		if ($this->changed->Required) {
			if (!$this->changed->IsDetailKey && $this->changed->FormValue != NULL && $this->changed->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->changed->caption(), $this->changed->RequiredErrorMessage));
			}
		}
		if ($this->fk_comune->Required) {
			if (!$this->fk_comune->IsDetailKey && $this->fk_comune->FormValue != NULL && $this->fk_comune->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fk_comune->caption(), $this->fk_comune->RequiredErrorMessage));
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
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// name
			$this->name->setDbValueDef($rsnew, $this->name->CurrentValue, NULL, $this->name->ReadOnly);

			// pass
			$this->pass->setDbValueDef($rsnew, $this->pass->CurrentValue, NULL, $this->pass->ReadOnly || ENCRYPTED_PASSWORD && $rs->fields('pass') == $this->pass->CurrentValue);

			// mail
			$this->mail->setDbValueDef($rsnew, $this->mail->CurrentValue, NULL, $this->mail->ReadOnly);

			// status
			$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, $this->status->ReadOnly);

			// userlevel
			if ($Security->canAdmin()) { // System admin
				$this->userlevel->setDbValueDef($rsnew, $this->userlevel->CurrentValue, NULL, $this->userlevel->ReadOnly);
			}

			// fk_comune
			$this->fk_comune->setDbValueDef($rsnew, $this->fk_comune->CurrentValue, NULL, $this->fk_comune->ReadOnly);

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
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("utentilist.php"), "", $this->TableVar, TRUE);
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
}
?>