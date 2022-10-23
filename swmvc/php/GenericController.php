<?php
/******************************************************************************
 *       SWMVC Simple Web MVC Framework for PHP                         *
 *                (c) 2022 Olivier Caron                    *
 *                                                                             *
 * This library is free software; you can redistribute it and/or modify it     *
 * under the terms of the GNU Lesser General Public License as published by    *
 * the Free Software Foundation; either version 3.0 of the License, or (at     *
 * your option) any later version.                                             *
 *                                                                             *
 * This library is distributed in the hope that it will be useful, but WITHOUT *
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or       *
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public License *
 * for more details.                                                           *
 *                                                                             *
 * You should have received a copy of the GNU Lesser General Public License    *
 * along with this library; if not, write to the Free Software Foundation,     *
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301 USA.          *
 *******************************************************************************
 *                           SWMVC    v1.0                                     *
 *				                                                                     *
 * Contributors: Olivier Caron                                                 *
 *                                                                             *
 ******************************************************************************/
namespace swmvc\php ;

use ArgumentCountError;
use ReflectionException;

class GenericController  {
    
	public function __construct() {
	}
	
	/**
	 * 
	 * @param  $params : table : "_prog" : name of program, others : program parameters
	 * error codes stored in  "_code":
	 * 		-1 : program name missing
	 * 		-2 : method not found
	 * 		-3 : incorrect number of parameters
	 * 		-4 : missing parameter
	 * 		-5 : parameter error during execution 
	 * 		0 : success
	 */
	public function run($params) {
		if (count($params)==0 || !isset($params["_prog"])) {
			echo json_encode(array("_code" => -1)) ; return ;
		}
		try {
		  $reflectionMethod = new \ReflectionMethod($this, $params["_prog"]);
		} catch(ReflectionException $e) {
			echo json_encode(array("_code" => -2)) ; return ;
		}
		$paramsMethod=array();
		$refparams=$reflectionMethod->getParameters();
		if ((count($refparams)+1)!=count($params)) {
			echo json_encode(array("_code" => -3)) ; return ;
		}
		foreach($refparams as $refparam)
			if(!isset($params[$refparam->getName()])) {
				echo json_encode(array("_code" => -4)) ; return ;
			} else
				$paramsMethod[] = $params[$refparam->getName()];
		try {
			$data=$reflectionMethod->invokeArgs($this, $paramsMethod);
		} catch(ArgumentCountError $e) {
			echo json_encode(array("_code" => -5)) ; return ;
		}
		$data["_code"]=0 ;
		echo json_encode($data) ;
	}
}





