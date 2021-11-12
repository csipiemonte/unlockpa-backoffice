<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Page class
 */
class knowledge_base_add extends knowledge_base
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{1B294467-F675-48C8-9632-26D78A5119EB}";

	// Table name
	public $TableName = 'knowledge_base';

	// Page object name
	public $PageObjName = "knowledge_base_add";

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

		// Table object (knowledge_base)
		if (!isset($GLOBALS["knowledge_base"]) || get_class($GLOBALS["knowledge_base"]) == PROJECT_NAMESPACE . "knowledge_base") {
			$GLOBALS["knowledge_base"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["knowledge_base"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (utenti)
		if (!isset($GLOBALS['utenti']))
			$GLOBALS['utenti'] = new utenti();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'knowledge_base');

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
		global $EXPORT, $knowledge_base;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($knowledge_base);
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
					if ($pageName == "knowledge_baseview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("knowledge_baselist.php"));
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
		$this->id->Visible = FALSE;
		$this->ts_creation->setVisibility();
		$this->question_type->setVisibility();
		$this->question_number->setVisibility();
		$this->question->setVisibility();
		$this->answer->setVisibility();
		$this->note->setVisibility();
		$this->id_bot->setVisibility();
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
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("knowledge_baselist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "knowledge_baselist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "knowledge_baseview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->ts_creation->CurrentValue = NULL;
		$this->ts_creation->OldValue = $this->ts_creation->CurrentValue;
		$this->question_type->CurrentValue = NULL;
		$this->question_type->OldValue = $this->question_type->CurrentValue;
		$this->question_number->CurrentValue = NULL;
		$this->question_number->OldValue = $this->question_number->CurrentValue;
		$this->question->CurrentValue = NULL;
		$this->question->OldValue = $this->question->CurrentValue;
		$this->answer->CurrentValue = NULL;
		$this->answer->OldValue = $this->answer->CurrentValue;
		$this->note->CurrentValue = NULL;
		$this->note->OldValue = $this->note->CurrentValue;
		$this->id_bot->CurrentValue = NULL;
		$this->id_bot->OldValue = $this->id_bot->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ts_creation' first before field var 'x_ts_creation'
		$val = $CurrentForm->hasValue("ts_creation") ? $CurrentForm->getValue("ts_creation") : $CurrentForm->getValue("x_ts_creation");
		if (!$this->ts_creation->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ts_creation->Visible = FALSE; // Disable update for API request
			else
				$this->ts_creation->setFormValue($val);
			$this->ts_creation->CurrentValue = UnFormatDateTime($this->ts_creation->CurrentValue, 0);
		}

		// Check field name 'question_type' first before field var 'x_question_type'
		$val = $CurrentForm->hasValue("question_type") ? $CurrentForm->getValue("question_type") : $CurrentForm->getValue("x_question_type");
		if (!$this->question_type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->question_type->Visible = FALSE; // Disable update for API request
			else
				$this->question_type->setFormValue($val);
		}

		// Check field name 'question_number' first before field var 'x_question_number'
		$val = $CurrentForm->hasValue("question_number") ? $CurrentForm->getValue("question_number") : $CurrentForm->getValue("x_question_number");
		if (!$this->question_number->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->question_number->Visible = FALSE; // Disable update for API request
			else
				$this->question_number->setFormValue($val);
		}

		// Check field name 'question' first before field var 'x_question'
		$val = $CurrentForm->hasValue("question") ? $CurrentForm->getValue("question") : $CurrentForm->getValue("x_question");
		if (!$this->question->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->question->Visible = FALSE; // Disable update for API request
			else
				$this->question->setFormValue($val);
		}

		// Check field name 'answer' first before field var 'x_answer'
		$val = $CurrentForm->hasValue("answer") ? $CurrentForm->getValue("answer") : $CurrentForm->getValue("x_answer");
		if (!$this->answer->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->answer->Visible = FALSE; // Disable update for API request
			else
				$this->answer->setFormValue($val);
		}

		// Check field name 'note' first before field var 'x_note'
		$val = $CurrentForm->hasValue("note") ? $CurrentForm->getValue("note") : $CurrentForm->getValue("x_note");
		if (!$this->note->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->note->Visible = FALSE; // Disable update for API request
			else
				$this->note->setFormValue($val);
		}

		// Check field name 'id_bot' first before field var 'x_id_bot'
		$val = $CurrentForm->hasValue("id_bot") ? $CurrentForm->getValue("id_bot") : $CurrentForm->getValue("x_id_bot");
		if (!$this->id_bot->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_bot->Visible = FALSE; // Disable update for API request
			else
				$this->id_bot->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ts_creation->CurrentValue = $this->ts_creation->FormValue;
		$this->ts_creation->CurrentValue = UnFormatDateTime($this->ts_creation->CurrentValue, 0);
		$this->question_type->CurrentValue = $this->question_type->FormValue;
		$this->question_number->CurrentValue = $this->question_number->FormValue;
		$this->question->CurrentValue = $this->question->FormValue;
		$this->answer->CurrentValue = $this->answer->FormValue;
		$this->note->CurrentValue = $this->note->FormValue;
		$this->id_bot->CurrentValue = $this->id_bot->FormValue;
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
		$this->ts_creation->setDbValue($row['ts_creation']);
		$this->question_type->setDbValue($row['question_type']);
		$this->question_number->setDbValue($row['question_number']);
		$this->question->setDbValue($row['question']);
		$this->answer->setDbValue($row['answer']);
		$this->note->setDbValue($row['note']);
		$this->id_bot->setDbValue($row['id_bot']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['ts_creation'] = $this->ts_creation->CurrentValue;
		$row['question_type'] = $this->question_type->CurrentValue;
		$row['question_number'] = $this->question_number->CurrentValue;
		$row['question'] = $this->question->CurrentValue;
		$row['answer'] = $this->answer->CurrentValue;
		$row['note'] = $this->note->CurrentValue;
		$row['id_bot'] = $this->id_bot->CurrentValue;
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
		// ts_creation
		// question_type
		// question_number
		// question
		// answer
		// note
		// id_bot

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// ts_creation
			$this->ts_creation->ViewValue = $this->ts_creation->CurrentValue;
			$this->ts_creation->ViewValue = FormatDateTime($this->ts_creation->ViewValue, 0);
			$this->ts_creation->ViewCustomAttributes = "";

			// question_type
			$this->question_type->ViewValue = $this->question_type->CurrentValue;
			$this->question_type->ViewCustomAttributes = "";

			// question_number
			$this->question_number->ViewValue = $this->question_number->CurrentValue;
			$this->question_number->ViewCustomAttributes = "";

			// question
			$this->question->ViewValue = $this->question->CurrentValue;
			$this->question->ViewCustomAttributes = "";

			// answer
			$this->answer->ViewValue = $this->answer->CurrentValue;
			$this->answer->ViewCustomAttributes = "";

			// note
			$this->note->ViewValue = $this->note->CurrentValue;
			$this->note->ViewCustomAttributes = "";

			// id_bot
			$this->id_bot->ViewValue = $this->id_bot->CurrentValue;
			$this->id_bot->ViewValue = FormatNumber($this->id_bot->ViewValue, 0, -2, -2, -2);
			$this->id_bot->ViewCustomAttributes = "";

			// ts_creation
			$this->ts_creation->LinkCustomAttributes = "";
			$this->ts_creation->HrefValue = "";
			$this->ts_creation->TooltipValue = "";

			// question_type
			$this->question_type->LinkCustomAttributes = "";
			$this->question_type->HrefValue = "";
			$this->question_type->TooltipValue = "";

			// question_number
			$this->question_number->LinkCustomAttributes = "";
			$this->question_number->HrefValue = "";
			$this->question_number->TooltipValue = "";

			// question
			$this->question->LinkCustomAttributes = "";
			$this->question->HrefValue = "";
			$this->question->TooltipValue = "";

			// answer
			$this->answer->LinkCustomAttributes = "";
			$this->answer->HrefValue = "";
			$this->answer->TooltipValue = "";

			// note
			$this->note->LinkCustomAttributes = "";
			$this->note->HrefValue = "";
			$this->note->TooltipValue = "";

			// id_bot
			$this->id_bot->LinkCustomAttributes = "";
			$this->id_bot->HrefValue = "";
			$this->id_bot->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ts_creation
			$this->ts_creation->EditAttrs["class"] = "form-control";
			$this->ts_creation->EditCustomAttributes = "";
			$this->ts_creation->EditValue = HtmlEncode(FormatDateTime($this->ts_creation->CurrentValue, 8));
			$this->ts_creation->PlaceHolder = RemoveHtml($this->ts_creation->caption());

			// question_type
			$this->question_type->EditAttrs["class"] = "form-control";
			$this->question_type->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->question_type->CurrentValue = HtmlDecode($this->question_type->CurrentValue);
			$this->question_type->EditValue = HtmlEncode($this->question_type->CurrentValue);
			$this->question_type->PlaceHolder = RemoveHtml($this->question_type->caption());

			// question_number
			$this->question_number->EditAttrs["class"] = "form-control";
			$this->question_number->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->question_number->CurrentValue = HtmlDecode($this->question_number->CurrentValue);
			$this->question_number->EditValue = HtmlEncode($this->question_number->CurrentValue);
			$this->question_number->PlaceHolder = RemoveHtml($this->question_number->caption());

			// question
			$this->question->EditAttrs["class"] = "form-control";
			$this->question->EditCustomAttributes = "";
			$this->question->EditValue = HtmlEncode($this->question->CurrentValue);
			$this->question->PlaceHolder = RemoveHtml($this->question->caption());

			// answer
			$this->answer->EditAttrs["class"] = "form-control";
			$this->answer->EditCustomAttributes = "";
			$this->answer->EditValue = HtmlEncode($this->answer->CurrentValue);
			$this->answer->PlaceHolder = RemoveHtml($this->answer->caption());

			// note
			$this->note->EditAttrs["class"] = "form-control";
			$this->note->EditCustomAttributes = "";
			$this->note->EditValue = HtmlEncode($this->note->CurrentValue);
			$this->note->PlaceHolder = RemoveHtml($this->note->caption());

			// id_bot
			$this->id_bot->EditAttrs["class"] = "form-control";
			$this->id_bot->EditCustomAttributes = "";
			$this->id_bot->EditValue = HtmlEncode($this->id_bot->CurrentValue);
			$this->id_bot->PlaceHolder = RemoveHtml($this->id_bot->caption());

			// Add refer script
			// ts_creation

			$this->ts_creation->LinkCustomAttributes = "";
			$this->ts_creation->HrefValue = "";

			// question_type
			$this->question_type->LinkCustomAttributes = "";
			$this->question_type->HrefValue = "";

			// question_number
			$this->question_number->LinkCustomAttributes = "";
			$this->question_number->HrefValue = "";

			// question
			$this->question->LinkCustomAttributes = "";
			$this->question->HrefValue = "";

			// answer
			$this->answer->LinkCustomAttributes = "";
			$this->answer->HrefValue = "";

			// note
			$this->note->LinkCustomAttributes = "";
			$this->note->HrefValue = "";

			// id_bot
			$this->id_bot->LinkCustomAttributes = "";
			$this->id_bot->HrefValue = "";
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
		if ($this->ts_creation->Required) {
			if (!$this->ts_creation->IsDetailKey && $this->ts_creation->FormValue != NULL && $this->ts_creation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ts_creation->caption(), $this->ts_creation->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ts_creation->FormValue)) {
			AddMessage($FormError, $this->ts_creation->errorMessage());
		}
		if ($this->question_type->Required) {
			if (!$this->question_type->IsDetailKey && $this->question_type->FormValue != NULL && $this->question_type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->question_type->caption(), $this->question_type->RequiredErrorMessage));
			}
		}
		if ($this->question_number->Required) {
			if (!$this->question_number->IsDetailKey && $this->question_number->FormValue != NULL && $this->question_number->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->question_number->caption(), $this->question_number->RequiredErrorMessage));
			}
		}
		if ($this->question->Required) {
			if (!$this->question->IsDetailKey && $this->question->FormValue != NULL && $this->question->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->question->caption(), $this->question->RequiredErrorMessage));
			}
		}
		if ($this->answer->Required) {
			if (!$this->answer->IsDetailKey && $this->answer->FormValue != NULL && $this->answer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->answer->caption(), $this->answer->RequiredErrorMessage));
			}
		}
		if ($this->note->Required) {
			if (!$this->note->IsDetailKey && $this->note->FormValue != NULL && $this->note->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->note->caption(), $this->note->RequiredErrorMessage));
			}
		}
		if ($this->id_bot->Required) {
			if (!$this->id_bot->IsDetailKey && $this->id_bot->FormValue != NULL && $this->id_bot->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_bot->caption(), $this->id_bot->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_bot->FormValue)) {
			AddMessage($FormError, $this->id_bot->errorMessage());
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ts_creation
		$this->ts_creation->setDbValueDef($rsnew, UnFormatDateTime($this->ts_creation->CurrentValue, 0), NULL, FALSE);

		// question_type
		$this->question_type->setDbValueDef($rsnew, $this->question_type->CurrentValue, NULL, FALSE);

		// question_number
		$this->question_number->setDbValueDef($rsnew, $this->question_number->CurrentValue, NULL, FALSE);

		// question
		$this->question->setDbValueDef($rsnew, $this->question->CurrentValue, NULL, FALSE);

		// answer
		$this->answer->setDbValueDef($rsnew, $this->answer->CurrentValue, NULL, FALSE);

		// note
		$this->note->setDbValueDef($rsnew, $this->note->CurrentValue, NULL, FALSE);

		// id_bot
		$this->id_bot->setDbValueDef($rsnew, $this->id_bot->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("knowledge_baselist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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