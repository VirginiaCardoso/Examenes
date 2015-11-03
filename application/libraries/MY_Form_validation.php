<?php

/**
 * MY_Form_validation: Extensión de la librería Form_validation
 *
 *@package      libraries
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
     function __construct($config = array())
     {
          parent::__construct($config);
     }
 
    /**
     * Error Array
     *
     * Returns the error messages as an array
     *
     * @return  array
     */
    function error_array()
    {
        if (count($this->_error_array) === 0)
        {
                return FALSE;
        }
        else
            return $this->_error_array;
 
    }
}


/* Fin del archivo MY_Form_validaton.php */
/* Ubicación: ./application/libraries/MY_Form_validation.php */