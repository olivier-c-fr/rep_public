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
 
 class Controller {
  //var params ;
  //var controller ;
	
  constructor(adrController, serviceName) {
    this.params = new Object() ;
    this.controller=adrController ;
    this.params["_prog"] = serviceName ;
  }
  
  addParam(name,value) { this.params[name]= value ;  }
  
  call(functionResult) {
	  $.ajax ( {                   // asynchronous JQuery
			url: this.controller,
			type: 'GET',
			datatype : 'json',
			data: this.params,
			success: function(result) {
				if (result._code != 0) Controller.display_error(result._code) ;
				else
				functionResult(result);
			}
		} );
  }
  static display_error(code) {
	  var msg;
		if (code==-1) msg="Error: bad service name";
		else if (code==-2) msg="Error: not found method" ;
		else if (code == -3) msg="Error: incorrect parameter number";
		else if (code == -4) msg="Error: missing parameters";
		else msg="Error: wrong parameters during execution" ;
		alert(msg+", contact your developper");
	}
}
