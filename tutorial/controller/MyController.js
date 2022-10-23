
// list events to capture:
window.onload = function() {
	$(".button-remove").on('click',remove);  // ev. remove person
	$("#button-add").on('click',add); // ev. add person
}


/** click event to add person
 * required parameters : id and name 
 * @returns
 */
function add() {
	service=new Controller("./controller/MyController.php","add") ;
	service.addParam("id",$("#id").val());
	service.addParam("name",$("#name").val());
	service.call(resAdd);
}
 
/** 
 * result function from add person
 * parameters id and name are required to display a new line table in case of success
 */
function resAdd(result) {
	if (result.code==0) {
		$("#listPersons").append(result.codeHTML) ;
		$(".button-remove").on('click',remove); // reactivate this event for this new line
	
		$("#status").html("add person achieved") ;
	} else $("#status").html("add person failed") ;
}

 /**
  * remove a person
  * (this) corresponds the corresponding remove button 
  * @returns
  */
function remove() { 
	 id= $(this).parents("tr").attr("id") ;
	 service=new Controller("./controller/MyController.php","remove") ;
	 service.addParam("id",id);
	 service.call(resRemove);
}
 
 /**
  * result function from remove person
  * @param result
  * @returns
 **/
function resRemove(result) {
	 if (result.code==0) {
		$("#status").html("remove person achieved") ;
		$("#"+result.id).remove() ;
	} else $("#status").html("remove person failed") ;
 }