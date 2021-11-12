<?php
namespace PHPMaker2019\unlockBOT;

/**
 * Page class
 */
class register extends utenti
{

	// Page ID
	public $PageID = "register";

	// Project ID
	public $ProjectID = "{1B294467-F675-48C8-9632-26D78A5119EB}";

	// Page object name
	public $PageObjName = "register";

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
		if (!isset($GLOBALS["utenti"]))
			$GLOBALS["utenti"] = new utenti();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'register');

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
	public $FormClassName = "ew-horizontal ew-form ew-register-form";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$UserTableConn, $CurrentLanguage, $FormError, $Breadcrumb;

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
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action

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
		$this->FormClassName = "ew-form ew-register-form ew-horizontal";

		// Set up Breadcrumb
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb = new Breadcrumb();
		$Breadcrumb->add("register", "RegisterPage", $url, "", "", TRUE);
		$this->Heading = $Language->phrase("RegisterPage");
		$userExists = FALSE;
		$this->loadRowValues(); // Load default values
		if (Post("action") <> "") {

			// Get action
			$this->CurrentAction = Post("action");
			$this->loadFormValues(); // Get form values

			// Validate form
			if (!$this->validateForm()) {
				$this->CurrentAction = "show"; // Form error, reset action
				$this->setFailureMessage($FormError);
			}
		} else {
			$this->CurrentAction = "show"; // Display blank record
		}

		// Handle email activation
		if (Get("action") <> "") {
			$action = Get("action");
			$emailAddress = Get("email");
			$code = Get("token");
			@list($approvalCode, $usr, $pwd) = explode(",", $code, 3);
			$approvalCode = Decrypt($approvalCode);
			$usr = Decrypt($usr);
			$pwd = Decrypt($pwd);
			if ($emailAddress == $approvalCode) {
				if (SameText($action, "confirm")) { // Email activation
					if ($this->activateEmail($emailAddress)) { // Activate this email
						if ($this->getSuccessMessage() == "")
							$this->setSuccessMessage($Language->phrase("ActivateAccount")); // Set up message acount activated
						$this->terminate("login.php"); // Go to login page
					}
				}
			}
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("ActivateFailed")); // Set activate failed message
			$this->terminate("login.php"); // Go to login page
		}

		// Insert record
		if ($this->isInsert()) {

			// Check for duplicate User ID
			$filter = str_replace("%u", AdjustSql($this->mail->CurrentValue, USER_TABLE_DBID), USER_NAME_FILTER);

			// Set up filter (WHERE Clause)
			$this->CurrentFilter = $filter;
			$userSql = $this->getCurrentSql();
			if ($rs = $UserTableConn->execute($userSql)) {
				if (!$rs->EOF) {
					$userExists = TRUE;
					$this->restoreFormValues(); // Restore form values
					$this->setFailureMessage($Language->phrase("UserExists")); // Set user exist message
				}
				$rs->Close();
			}
			if (!$userExists) {
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow()) { // Add record
					$email = $this->prepareRegisterEmail();

					// Get new recordset
					$this->CurrentFilter = $this->getRecordFilter();
					$sql = $this->getCurrentSql();
					$rsnew = $UserTableConn->execute($sql);
					$row = $rsnew->fields;
					$args = array();
					$args["rs"] = $row;
					$emailSent = FALSE;
					if ($this->Email_Sending($email, $args))
						$emailSent = $email->send();

					// Send email failed
					if (!$emailSent)
						$this->setFailureMessage($email->SendErrDescription);
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("RegisterSuccessActivate")); // Activate success
					$this->terminate("login.php"); // Return
				} else {
					$this->restoreFormValues(); // Restore form values
				}
			}
		}

		// Render row
		$this->RowType = ROWTYPE_ADD; // Render add
		$this->resetAttributes();
		$this->renderRow();
	}

	// Activate account based on email
	protected function activateEmail($email)
	{
		global $UserTableConn, $Language;
		$filter = str_replace("%e", AdjustSql($email, USER_TABLE_DBID), USER_EMAIL_FILTER);
		$sql = $this->getSql($filter);
		$UserTableConn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $UserTableConn->execute($sql);
		$UserTableConn->raiseErrorFn = '';
		if (!$rs)
			return FALSE;
		if (!$rs->EOF) {
			$rsnew = $rs->fields;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
			$rsact = array('status' => 1); // Auto register
			$this->CurrentFilter = $filter;
			$res = $this->update($rsact);
			if ($res) { // Call User Activated event
				$rsnew['status'] = 1;
				$this->User_Activated($rsnew);
			}
			return $res;
		} else {
			$this->setFailureMessage($Language->phrase("NoRecord"));
			$rs->close();
			return FALSE;
		}
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
		$this->name->CurrentValue = NULL;
		$this->name->OldValue = $this->name->CurrentValue;
		$this->pass->CurrentValue = NULL;
		$this->pass->OldValue = $this->pass->CurrentValue;
		$this->mail->CurrentValue = NULL;
		$this->mail->OldValue = $this->mail->CurrentValue;
		$this->langcode->CurrentValue = NULL;
		$this->langcode->OldValue = $this->langcode->CurrentValue;
		$this->preferred_langcode->CurrentValue = NULL;
		$this->preferred_langcode->OldValue = $this->preferred_langcode->CurrentValue;
		$this->preferred_admin_langcode->CurrentValue = NULL;
		$this->preferred_admin_langcode->OldValue = $this->preferred_admin_langcode->CurrentValue;
		$this->timezone->CurrentValue = NULL;
		$this->timezone->OldValue = $this->timezone->CurrentValue;
		$this->status->CurrentValue = NULL;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->access->CurrentValue = NULL;
		$this->access->OldValue = $this->access->CurrentValue;
		$this->_login->CurrentValue = NULL;
		$this->_login->OldValue = $this->_login->CurrentValue;
		$this->init->CurrentValue = NULL;
		$this->init->OldValue = $this->init->CurrentValue;
		$this->default_langcode->CurrentValue = NULL;
		$this->default_langcode->OldValue = $this->default_langcode->CurrentValue;
		$this->userlevel->CurrentValue = NULL;
		$this->userlevel->OldValue = $this->userlevel->CurrentValue;
		$this->profile_field_memo->CurrentValue = NULL;
		$this->profile_field_memo->OldValue = $this->profile_field_memo->CurrentValue;
		$this->userlevel_segn->CurrentValue = NULL;
		$this->userlevel_segn->OldValue = $this->userlevel_segn->CurrentValue;
		$this->userlevel_cellule->CurrentValue = NULL;
		$this->userlevel_cellule->OldValue = $this->userlevel_cellule->CurrentValue;
		$this->accettazione->CurrentValue = NULL;
		$this->accettazione->OldValue = $this->accettazione->CurrentValue;
		$this->created->CurrentValue = NULL;
		$this->created->OldValue = $this->created->CurrentValue;
		$this->changed->CurrentValue = NULL;
		$this->changed->OldValue = $this->changed->CurrentValue;
		$this->fk_comune->CurrentValue = NULL;
		$this->fk_comune->OldValue = $this->fk_comune->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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
		$this->pass->ConfirmValue = $CurrentForm->getValue("c_pass");

		// Check field name 'mail' first before field var 'x_mail'
		$val = $CurrentForm->hasValue("mail") ? $CurrentForm->getValue("mail") : $CurrentForm->getValue("x_mail");
		if (!$this->mail->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->mail->Visible = FALSE; // Disable update for API request
			else
				$this->mail->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->pass->CurrentValue = $this->pass->FormValue;
		$this->mail->CurrentValue = $this->mail->FormValue;
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
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['name'] = $this->name->CurrentValue;
		$row['pass'] = $this->pass->CurrentValue;
		$row['mail'] = $this->mail->CurrentValue;
		$row['langcode'] = $this->langcode->CurrentValue;
		$row['preferred_langcode'] = $this->preferred_langcode->CurrentValue;
		$row['preferred_admin_langcode'] = $this->preferred_admin_langcode->CurrentValue;
		$row['timezone'] = $this->timezone->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['access'] = $this->access->CurrentValue;
		$row['login'] = $this->_login->CurrentValue;
		$row['init'] = $this->init->CurrentValue;
		$row['default_langcode'] = $this->default_langcode->CurrentValue;
		$row['userlevel'] = $this->userlevel->CurrentValue;
		$row['profile_field_memo'] = $this->profile_field_memo->CurrentValue;
		$row['userlevel_segn'] = $this->userlevel_segn->CurrentValue;
		$row['userlevel_cellule'] = $this->userlevel_cellule->CurrentValue;
		$row['accettazione'] = $this->accettazione->CurrentValue;
		$row['created'] = $this->created->CurrentValue;
		$row['changed'] = $this->changed->CurrentValue;
		$row['fk_comune'] = $this->fk_comune->CurrentValue;
		return $row;
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// Add refer script
			// name

			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";

			// pass
			$this->pass->LinkCustomAttributes = "";
			$this->pass->HrefValue = "";

			// mail
			$this->mail->LinkCustomAttributes = "";
			$this->mail->HrefValue = "";
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
				AddMessage($FormError, $Language->phrase("EnterPassword"));
			}
		}
		if ($this->mail->Required) {
			if (!$this->mail->IsDetailKey && $this->mail->FormValue != NULL && $this->mail->FormValue == "") {
				AddMessage($FormError, $Language->phrase("EnterUserName"));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() <> "" && !EmptyValue($this->id->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->id->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->id->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// name
		$this->name->setDbValueDef($rsnew, $this->name->CurrentValue, NULL, FALSE);

		// pass
		$this->pass->setDbValueDef($rsnew, $this->pass->CurrentValue, NULL, FALSE);

		// mail
		$this->mail->setDbValueDef($rsnew, $this->mail->CurrentValue, NULL, FALSE);

		// id
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

			// Call User Registered event
			$this->User_Registered($rsnew);
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

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

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// User Registered event
	function User_Registered(&$rs) {

		//echo "User_Registered";
	}

	// User Activated event
	function User_Activated(&$rs) {

		//echo "User_Activated";
	}
}
?>