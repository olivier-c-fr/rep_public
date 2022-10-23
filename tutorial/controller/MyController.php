<?php
/**
 * MyController générique pour services webs
**/
header('Access-Control-Allow-Origin: *');
header("Content-type: application/json");

require (__DIR__."/../model/ModelPersons.php");
require (__DIR__."/../../swmvc/php/include.php") ;

class MyController extends swmvc\php\GenericController {
	
	public function __construct() {
		$this->model=new modelPersons();
	}
	public function add($id,$name) {
		$result["code"] = $this->model->addPerson($id, $name);
		if ($result["code"]==0) {
		ob_start();?>
		<tr id = <?= $id ; ?>>
		  <td><?= $name ; ?></td>
		  <td><button class="btn btn-danger button-remove">
			  <span class="fa fa-trash"></span>
			</button>
	      </td>    
		</tr>
<?php 
		$result["codeHTML"]=ob_get_clean();
		}
		return $result ;
	}
	
	
	public function remove($id) {
		$result["code"] = $this->model->removePerson($id);
		$result["id"]=$id ;
		return $result ;
	}
}

$controller= new MyController() ;
$controller->run($_GET);

?>
