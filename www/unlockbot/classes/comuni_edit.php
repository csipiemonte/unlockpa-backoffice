<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Page class
 */
class comuni_edit extends comuni
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{1B294467-F675-48C8-9632-26D78A5119EB}";

	// Table name
	public $TableName = 'comuni';

	// Page object name
	public $PageObjName = "comuni_edit";

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

		// Table object (comuni)
		if (!isset($GLOBALS["comuni"]) || get_class($GLOBALS["comuni"]) == PROJECT_NAMESPACE . "comuni") {
			$GLOBALS["comuni"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["comuni"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (utenti)
		if (!isset($GLOBALS['utenti']))
			$GLOBALS['utenti'] = new utenti();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'comuni');

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
		global $EXPORT, $comuni;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($comuni);
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
					if ($pageName == "comuniview.php")
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
					$this->terminate(GetUrl("comunilist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->istat->setVisibility();
		$this->toponimo->setVisibility();
		$this->telefono->setVisibility();
		$this->indirizzo->setVisibility();
		$this->provincia->setVisibility();
		$this->avviso->setVisibility();
		$this->fk_zona->setVisibility();
		$this->no_response->setVisibility();
		$this->dominio->setVisibility();
		$this->vide->setVisibility();
		$this->botattivo->setVisibility();
		$this->logo->setVisibility();
		$this->logobin->setVisibility();
		$this->vide_url->setVisibility();
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
		$this->setupLookupOptions($this->fk_zona);

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
					$this->terminate("comunilist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "comunilist.php")
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
		$this->logobin->Upload->Index = $CurrentForm->Index;
		$this->logobin->Upload->uploadFile();
		$this->logo->CurrentValue = $this->logobin->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);

		// Check field name 'istat' first before field var 'x_istat'
		$val = $CurrentForm->hasValue("istat") ? $CurrentForm->getValue("istat") : $CurrentForm->getValue("x_istat");
		if (!$this->istat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->istat->Visible = FALSE; // Disable update for API request
			else
				$this->istat->setFormValue($val);
		}

		// Check field name 'toponimo' first before field var 'x_toponimo'
		$val = $CurrentForm->hasValue("toponimo") ? $CurrentForm->getValue("toponimo") : $CurrentForm->getValue("x_toponimo");
		if (!$this->toponimo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->toponimo->Visible = FALSE; // Disable update for API request
			else
				$this->toponimo->setFormValue($val);
		}

		// Check field name 'telefono' first before field var 'x_telefono'
		$val = $CurrentForm->hasValue("telefono") ? $CurrentForm->getValue("telefono") : $CurrentForm->getValue("x_telefono");
		if (!$this->telefono->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telefono->Visible = FALSE; // Disable update for API request
			else
				$this->telefono->setFormValue($val);
		}

		// Check field name 'indirizzo' first before field var 'x_indirizzo'
		$val = $CurrentForm->hasValue("indirizzo") ? $CurrentForm->getValue("indirizzo") : $CurrentForm->getValue("x_indirizzo");
		if (!$this->indirizzo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->indirizzo->Visible = FALSE; // Disable update for API request
			else
				$this->indirizzo->setFormValue($val);
		}

		// Check field name 'provincia' first before field var 'x_provincia'
		$val = $CurrentForm->hasValue("provincia") ? $CurrentForm->getValue("provincia") : $CurrentForm->getValue("x_provincia");
		if (!$this->provincia->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->provincia->Visible = FALSE; // Disable update for API request
			else
				$this->provincia->setFormValue($val);
		}

		// Check field name 'avviso' first before field var 'x_avviso'
		$val = $CurrentForm->hasValue("avviso") ? $CurrentForm->getValue("avviso") : $CurrentForm->getValue("x_avviso");
		if (!$this->avviso->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->avviso->Visible = FALSE; // Disable update for API request
			else
				$this->avviso->setFormValue($val);
		}

		// Check field name 'fk_zona' first before field var 'x_fk_zona'
		$val = $CurrentForm->hasValue("fk_zona") ? $CurrentForm->getValue("fk_zona") : $CurrentForm->getValue("x_fk_zona");
		if (!$this->fk_zona->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fk_zona->Visible = FALSE; // Disable update for API request
			else
				$this->fk_zona->setFormValue($val);
		}

		// Check field name 'no_response' first before field var 'x_no_response'
		$val = $CurrentForm->hasValue("no_response") ? $CurrentForm->getValue("no_response") : $CurrentForm->getValue("x_no_response");
		if (!$this->no_response->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->no_response->Visible = FALSE; // Disable update for API request
			else
				$this->no_response->setFormValue($val);
		}

		// Check field name 'dominio' first before field var 'x_dominio'
		$val = $CurrentForm->hasValue("dominio") ? $CurrentForm->getValue("dominio") : $CurrentForm->getValue("x_dominio");
		if (!$this->dominio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->dominio->Visible = FALSE; // Disable update for API request
			else
				$this->dominio->setFormValue($val);
		}

		// Check field name 'vide' first before field var 'x_vide'
		$val = $CurrentForm->hasValue("vide") ? $CurrentForm->getValue("vide") : $CurrentForm->getValue("x_vide");
		if (!$this->vide->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->vide->Visible = FALSE; // Disable update for API request
			else
				$this->vide->setFormValue($val);
		}

		// Check field name 'botattivo' first before field var 'x_botattivo'
		$val = $CurrentForm->hasValue("botattivo") ? $CurrentForm->getValue("botattivo") : $CurrentForm->getValue("x_botattivo");
		if (!$this->botattivo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->botattivo->Visible = FALSE; // Disable update for API request
			else
				$this->botattivo->setFormValue($val);
		}

		// Check field name 'vide_url' first before field var 'x_vide_url'
		$val = $CurrentForm->hasValue("vide_url") ? $CurrentForm->getValue("vide_url") : $CurrentForm->getValue("x_vide_url");
		if (!$this->vide_url->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->vide_url->Visible = FALSE; // Disable update for API request
			else
				$this->vide_url->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->istat->CurrentValue = $this->istat->FormValue;
		$this->toponimo->CurrentValue = $this->toponimo->FormValue;
		$this->telefono->CurrentValue = $this->telefono->FormValue;
		$this->indirizzo->CurrentValue = $this->indirizzo->FormValue;
		$this->provincia->CurrentValue = $this->provincia->FormValue;
		$this->avviso->CurrentValue = $this->avviso->FormValue;
		$this->fk_zona->CurrentValue = $this->fk_zona->FormValue;
		$this->no_response->CurrentValue = $this->no_response->FormValue;
		$this->dominio->CurrentValue = $this->dominio->FormValue;
		$this->vide->CurrentValue = $this->vide->FormValue;
		$this->botattivo->CurrentValue = $this->botattivo->FormValue;
		$this->vide_url->CurrentValue = $this->vide_url->FormValue;
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
		$this->istat->setDbValue($row['istat']);
		$this->toponimo->setDbValue($row['toponimo']);
		$this->telefono->setDbValue($row['telefono']);
		$this->indirizzo->setDbValue($row['indirizzo']);
		$this->provincia->setDbValue($row['provincia']);
		$this->avviso->setDbValue($row['avviso']);
		$this->fk_zona->setDbValue($row['fk_zona']);
		$this->no_response->setDbValue($row['no_response']);
		$this->dominio->setDbValue($row['dominio']);
		$this->vide->setDbValue((ConvertToBool($row['vide']) ? "1" : "0"));
		$this->botattivo->setDbValue((ConvertToBool($row['botattivo']) ? "1" : "0"));
		$this->logo->setDbValue($row['logo']);
		$this->logobin->Upload->DbValue = $row['logobin'];
		if (is_array($this->logobin->Upload->DbValue) || is_object($this->logobin->Upload->DbValue)) // Byte array
			$this->logobin->Upload->DbValue = BytesToString($this->logobin->Upload->DbValue);
		$this->vide_url->setDbValue($row['vide_url']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['istat'] = NULL;
		$row['toponimo'] = NULL;
		$row['telefono'] = NULL;
		$row['indirizzo'] = NULL;
		$row['provincia'] = NULL;
		$row['avviso'] = NULL;
		$row['fk_zona'] = NULL;
		$row['no_response'] = NULL;
		$row['dominio'] = NULL;
		$row['vide'] = NULL;
		$row['botattivo'] = NULL;
		$row['logo'] = NULL;
		$row['logobin'] = NULL;
		$row['vide_url'] = NULL;
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
		// logobin
		// vide_url

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
			$this->istat->EditValue = HtmlEncode($this->istat->CurrentValue);
			$this->istat->PlaceHolder = RemoveHtml($this->istat->caption());

			// toponimo
			$this->toponimo->EditAttrs["class"] = "form-control";
			$this->toponimo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->toponimo->CurrentValue = HtmlDecode($this->toponimo->CurrentValue);
			$this->toponimo->EditValue = HtmlEncode($this->toponimo->CurrentValue);
			$this->toponimo->PlaceHolder = RemoveHtml($this->toponimo->caption());

			// telefono
			$this->telefono->EditAttrs["class"] = "form-control";
			$this->telefono->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
			$this->telefono->EditValue = HtmlEncode($this->telefono->CurrentValue);
			$this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

			// indirizzo
			$this->indirizzo->EditAttrs["class"] = "form-control";
			$this->indirizzo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->indirizzo->CurrentValue = HtmlDecode($this->indirizzo->CurrentValue);
			$this->indirizzo->EditValue = HtmlEncode($this->indirizzo->CurrentValue);
			$this->indirizzo->PlaceHolder = RemoveHtml($this->indirizzo->caption());

			// provincia
			$this->provincia->EditAttrs["class"] = "form-control";
			$this->provincia->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->provincia->CurrentValue = HtmlDecode($this->provincia->CurrentValue);
			$this->provincia->EditValue = HtmlEncode($this->provincia->CurrentValue);
			$this->provincia->PlaceHolder = RemoveHtml($this->provincia->caption());

			// avviso
			$this->avviso->EditAttrs["class"] = "form-control";
			$this->avviso->EditCustomAttributes = "";
			$this->avviso->EditValue = HtmlEncode($this->avviso->CurrentValue);
			$this->avviso->PlaceHolder = RemoveHtml($this->avviso->caption());

			// fk_zona
			$this->fk_zona->EditAttrs["class"] = "form-control";
			$this->fk_zona->EditCustomAttributes = "";
			$curVal = trim(strval($this->fk_zona->CurrentValue));
			if ($curVal <> "")
				$this->fk_zona->ViewValue = $this->fk_zona->lookupCacheOption($curVal);
			else
				$this->fk_zona->ViewValue = $this->fk_zona->Lookup !== NULL && is_array($this->fk_zona->Lookup->Options) ? $curVal : NULL;
			if ($this->fk_zona->ViewValue !== NULL) { // Load from cache
				$this->fk_zona->EditValue = array_values($this->fk_zona->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"id\"" . SearchString("=", $this->fk_zona->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->fk_zona->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->fk_zona->EditValue = $arwrk;
			}

			// no_response
			$this->no_response->EditAttrs["class"] = "form-control";
			$this->no_response->EditCustomAttributes = "";
			$this->no_response->EditValue = HtmlEncode($this->no_response->CurrentValue);
			$this->no_response->PlaceHolder = RemoveHtml($this->no_response->caption());

			// dominio
			$this->dominio->EditAttrs["class"] = "form-control";
			$this->dominio->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->dominio->CurrentValue = HtmlDecode($this->dominio->CurrentValue);
			$this->dominio->EditValue = HtmlEncode($this->dominio->CurrentValue);
			$this->dominio->PlaceHolder = RemoveHtml($this->dominio->caption());

			// vide
			$this->vide->EditCustomAttributes = "";
			$this->vide->EditValue = $this->vide->options(FALSE);

			// botattivo
			$this->botattivo->EditCustomAttributes = "";
			$this->botattivo->EditValue = $this->botattivo->options(FALSE);

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
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->logobin);

			// vide_url
			$this->vide_url->EditAttrs["class"] = "form-control";
			$this->vide_url->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->vide_url->CurrentValue = HtmlDecode($this->vide_url->CurrentValue);
			$this->vide_url->EditValue = HtmlEncode($this->vide_url->CurrentValue);
			$this->vide_url->PlaceHolder = RemoveHtml($this->vide_url->caption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// istat
			$this->istat->LinkCustomAttributes = "";
			$this->istat->HrefValue = "";

			// toponimo
			$this->toponimo->LinkCustomAttributes = "";
			$this->toponimo->HrefValue = "";

			// telefono
			$this->telefono->LinkCustomAttributes = "";
			$this->telefono->HrefValue = "";

			// indirizzo
			$this->indirizzo->LinkCustomAttributes = "";
			$this->indirizzo->HrefValue = "";

			// provincia
			$this->provincia->LinkCustomAttributes = "";
			$this->provincia->HrefValue = "";

			// avviso
			$this->avviso->LinkCustomAttributes = "";
			$this->avviso->HrefValue = "";

			// fk_zona
			$this->fk_zona->LinkCustomAttributes = "";
			$this->fk_zona->HrefValue = "";

			// no_response
			$this->no_response->LinkCustomAttributes = "";
			$this->no_response->HrefValue = "";

			// dominio
			$this->dominio->LinkCustomAttributes = "";
			$this->dominio->HrefValue = "";

			// vide
			$this->vide->LinkCustomAttributes = "";
			$this->vide->HrefValue = "";

			// botattivo
			$this->botattivo->LinkCustomAttributes = "";
			$this->botattivo->HrefValue = "";

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

			// vide_url
			$this->vide_url->LinkCustomAttributes = "";
			$this->vide_url->HrefValue = "";
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
		if ($this->istat->Required) {
			if (!$this->istat->IsDetailKey && $this->istat->FormValue != NULL && $this->istat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->istat->caption(), $this->istat->RequiredErrorMessage));
			}
		}
		if (!CheckByRegEx($this->istat->FormValue, '/^[A-zÀ-ý0-9!@€#$&() \\\\\'\-+,.;_\"]*$/')) {
			AddMessage($FormError, $this->istat->errorMessage());
		}
		if ($this->toponimo->Required) {
			if (!$this->toponimo->IsDetailKey && $this->toponimo->FormValue != NULL && $this->toponimo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->toponimo->caption(), $this->toponimo->RequiredErrorMessage));
			}
		}
		if ($this->telefono->Required) {
			if (!$this->telefono->IsDetailKey && $this->telefono->FormValue != NULL && $this->telefono->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telefono->caption(), $this->telefono->RequiredErrorMessage));
			}
		}
		if ($this->indirizzo->Required) {
			if (!$this->indirizzo->IsDetailKey && $this->indirizzo->FormValue != NULL && $this->indirizzo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->indirizzo->caption(), $this->indirizzo->RequiredErrorMessage));
			}
		}
		if ($this->provincia->Required) {
			if (!$this->provincia->IsDetailKey && $this->provincia->FormValue != NULL && $this->provincia->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->provincia->caption(), $this->provincia->RequiredErrorMessage));
			}
		}
		if ($this->avviso->Required) {
			if (!$this->avviso->IsDetailKey && $this->avviso->FormValue != NULL && $this->avviso->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->avviso->caption(), $this->avviso->RequiredErrorMessage));
			}
		}
		if ($this->fk_zona->Required) {
			if (!$this->fk_zona->IsDetailKey && $this->fk_zona->FormValue != NULL && $this->fk_zona->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fk_zona->caption(), $this->fk_zona->RequiredErrorMessage));
			}
		}
		if ($this->no_response->Required) {
			if (!$this->no_response->IsDetailKey && $this->no_response->FormValue != NULL && $this->no_response->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->no_response->caption(), $this->no_response->RequiredErrorMessage));
			}
		}
		if ($this->dominio->Required) {
			if (!$this->dominio->IsDetailKey && $this->dominio->FormValue != NULL && $this->dominio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->dominio->caption(), $this->dominio->RequiredErrorMessage));
			}
		}
		if (!CheckByRegEx($this->dominio->FormValue, '/^[A-zÀ-ý0-9!@€#$&() \\\\\'\-+,.;_\"]*$/')) {
			AddMessage($FormError, $this->dominio->errorMessage());
		}
		if ($this->vide->Required) {
			if ($this->vide->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->vide->caption(), $this->vide->RequiredErrorMessage));
			}
		}
		if ($this->botattivo->Required) {
			if ($this->botattivo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->botattivo->caption(), $this->botattivo->RequiredErrorMessage));
			}
		}
		if ($this->logo->Required) {
			if (!$this->logo->IsDetailKey && $this->logo->FormValue != NULL && $this->logo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->logo->caption(), $this->logo->RequiredErrorMessage));
			}
		}
		if ($this->logobin->Required) {
			if ($this->logobin->Upload->FileName == "" && !$this->logobin->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->logobin->caption(), $this->logobin->RequiredErrorMessage));
			}
		}
		if ($this->vide_url->Required) {
			if (!$this->vide_url->IsDetailKey && $this->vide_url->FormValue != NULL && $this->vide_url->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->vide_url->caption(), $this->vide_url->RequiredErrorMessage));
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

			// istat
			$this->istat->setDbValueDef($rsnew, $this->istat->CurrentValue, NULL, $this->istat->ReadOnly);

			// toponimo
			$this->toponimo->setDbValueDef($rsnew, $this->toponimo->CurrentValue, "", $this->toponimo->ReadOnly);

			// telefono
			$this->telefono->setDbValueDef($rsnew, $this->telefono->CurrentValue, NULL, $this->telefono->ReadOnly);

			// indirizzo
			$this->indirizzo->setDbValueDef($rsnew, $this->indirizzo->CurrentValue, NULL, $this->indirizzo->ReadOnly);

			// provincia
			$this->provincia->setDbValueDef($rsnew, $this->provincia->CurrentValue, NULL, $this->provincia->ReadOnly);

			// avviso
			$this->avviso->setDbValueDef($rsnew, $this->avviso->CurrentValue, NULL, $this->avviso->ReadOnly);

			// fk_zona
			$this->fk_zona->setDbValueDef($rsnew, $this->fk_zona->CurrentValue, NULL, $this->fk_zona->ReadOnly);

			// no_response
			$this->no_response->setDbValueDef($rsnew, $this->no_response->CurrentValue, NULL, $this->no_response->ReadOnly);

			// dominio
			$this->dominio->setDbValueDef($rsnew, $this->dominio->CurrentValue, NULL, $this->dominio->ReadOnly);

			// vide
			$tmpBool = $this->vide->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->vide->setDbValueDef($rsnew, $tmpBool, 0, $this->vide->ReadOnly);

			// botattivo
			$tmpBool = $this->botattivo->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->botattivo->setDbValueDef($rsnew, $tmpBool, NULL, $this->botattivo->ReadOnly);

			// logobin
			if ($this->logobin->Visible && !$this->logobin->ReadOnly && !$this->logobin->Upload->KeepFile) {
				if ($this->logobin->Upload->Value == NULL) {
					$rsnew['logobin'] = NULL;
				} else {
					$rsnew['logobin'] = $this->logobin->Upload->Value;
				}
				$this->logo->setDbValueDef($rsnew, $this->logobin->Upload->FileName, NULL, FALSE);
			}

			// vide_url
			$this->vide_url->setDbValueDef($rsnew, $this->vide_url->CurrentValue, NULL, $this->vide_url->ReadOnly);

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

		// logobin
		if ($this->logobin->Upload->FileToken <> "")
			CleanUploadTempPath($this->logobin->Upload->FileToken, $this->logobin->Upload->Index);
		else
			CleanUploadTempPath($this->logobin, $this->logobin->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("comunilist.php"), "", $this->TableVar, TRUE);
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
						case "x_fk_zona":
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
	// Funziona correttamente. Todo : aggiugere tutte le stringhe da verificare 
	//	// Controllo lato server che il contenuto di un campo (avviso)
	// 	// non contenga alcune sequenze di caratteri
	// 	$valore = strval($this->avviso->CurrentValue);
	// 	//$pos = stripos($valore,"and");
	// 	//echo ("valore=".$valore." - Pos=".$pos);
	// 	if (strpos($valore, 'and') !== false)
	// 	//if ($pos>=0)
	//   	{
	//		// echo("Valore = ".$valore);
	//   		$customError = "Il campo Avviso non può contenere 'and'";
	//   		Return false;
	//   	} 
	// 
	// Form_CustomValidate 
	// 
	// This event is fired after the normal form validation. 
	// You can use this event to do your own custom validation. 
	// Note: This function is a member of the JavaScript page class. 
	// 
	// Return false if the form values do not pass your validation.
	// 
	// Note If you use this client side event, make sure you have enabled client-side 
	// validation, see Validation in PHP Settings.
	// 
	// The HTML form object can be accessed by the parameter fobj. 
	// You can also use the jQuery plugin .fields() in this event.
	// 
	// 
	// Example 1
	// 
	// Make sure an integer field value meet a certain requirement 
	// 
	// function(fobj) { // DO NOT CHANGE THIS LINE!
	//     var $qty = $(this).fields("Qty"); // Get a field as jQuery object by field name
	//      if ($qty.toNumber() % 10 != 0) // Assume Qty is a textbox         
	//         return this.onError($qty, "Order quantity must be multiples of 10."); // Return false if invalid
	//     return true; // Return true if valid
	//  }
	// 
	// Example 2
	// 
	// Compare 2 date fields 
	// 
	// function(fobj) { // DO NOT CHANGE THIS LINE!
	//     var $row = $(this).fields(); // Get all fields
	//     if ($row["Start"].toJsDate() > $row["End"].toJsDate()) // Assume Start and End are textboxes        
	//         return this.onError($row["End"], "The End Date must be later than the Start Date."); // Return false if invalid
	//     return true; // Return true if valid
	// } 
	// 
	// Example 3
	// 
	// Manipulation of date fields 
	// 
	// function(fobj) { // DO NOT CHANGE THIS LINE!
	//     var $start = $(this).fields("Start"), $end = $(this).fields("End"); // Get fields as jQuery objects by field names
	//     if ($start.toDate().add(7, "days").isAfter($end.toDate())) // Assume Start and End are textboxes        
	//         return this.onError($end, "The End Date must be at least 7 days after the Start Date."); // Return false if invalid
	//     return true; // Return true if valid
	// } 
	// 

		return TRUE;
	}
}
?>