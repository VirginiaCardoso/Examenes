<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|
|	Constantes definidas para la aplicación
|
*/

define('PRIVILEGIO_NULO',-1);
define('PRIVILEGIO_DOCENTE',0); //Docente: solo puede ver y tomar examenes. Y crear guías si tiene permiso en catedra
define('PRIVILEGIO_ADMIN', 2);  //Es admin (acceso a todos los ABM), pero no puede nombrar nuevos admin, ni borrar/modificar examenes
define('PRIVILEGIO_SUPERADMIN',3); //Admin, que puede nombrar nuevos admin, y borrar/modificar examenes

define('PERMISO_NULO',-1); //Permiso en cátedra: no puede hacer nada
define('PERMISO_VER',0); //Permiso en cátedra: solo puede ver examenes y alumnos asociados
define('PERMISO_EVALUAR',1); //Permiso en cátedra: puede ver y tomar examenes y asociar alumnos. No puede modificar guias
define('PERMISO_TOTAL', 2); //Permiso en cátedra: puede tomar examen, cargar y modificar guias, asociar y dar de baja alumnos

define('NO_SELECTED', -1);

define('STATUS_OK', 100);
define('STATUS_EMPTY_POST', 101);
define('STATUS_INVALID_PARAM', 102);
define('STATUS_INVALID_POST', 103);
define('STATUS_REPEATED_POST', 104);
define('STATUS_NO_INSERT', 105);
define('STATUS_UNKNOWN_ERROR', 106);
define('STATUS_SESSION_EXPIRED', 107);
define('STATUS_REDIRECT', 108);

define('ERROR_NO_INSERT',201);
define('ERROR_REPETIDO',202);
define('ERROR_FALTA_ITEM',202);
define('ERROR_DUPLICATE_PRIMARY',1062);

define('CALIF_COMPETENCIA_NO_ADQUIRIDA',0);
define('CALIF_COMPETENCIA_MED_ADQUIRIDA',1);
define('CALIF_COMPETENCIA_ADQUIRIDA',2);
define('CALIF_VACIA',-1);

define('ITEM_NO',0);
define('ITEM_SI',1);
define('ITEM_VACIO',-1);


/* End of file constants.php */
/* Location: ./application/config/constants.php */