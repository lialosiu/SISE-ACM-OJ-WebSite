<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

define('_StatusCode_SystemError', -1);
define('_StatusCode_UnknownStatus', 0);
define('_StatusCode_Pending', 1);
define('_StatusCode_Compiling', 2);
define('_StatusCode_Running', 3);
define('_StatusCode_Accepted', 4);
define('_StatusCode_PresentationError', 5);
define('_StatusCode_WrongAnswer', 6);
define('_StatusCode_TimeLimitExceeded', 7);
define('_StatusCode_MemoryLimitExceeded', 8);
define('_StatusCode_OutputLimitExceeded', 9);
define('_StatusCode_RuntimeError', 10);
define('_StatusCode_CompileError', 11);

define('_LanguageCode_UnknownLanguage', 0);
define('_LanguageCode_C', 1);
define('_LanguageCode_CPP', 2);
define('_LanguageCode_Java', 3);

define('_DefaultRowLimit_', 15);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */