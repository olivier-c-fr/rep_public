<?php
class ModelPersons {
	var $dataPersons;
	
	var $dataFile=__DIR__ . "/dataPersons.json";
	
	public function __construct() {
		try {
			$data = file_get_contents ( $this->dataFile );
			$this->dataPersons = json_decode ( $data )->persons;
		} catch ( Exception $e ) {
			echo 'Erreur : ' . $e->getMessage () . '<br />';
			echo 'N° : ' . $e->getCode ();
			$this->dataPersons = - 1;
		}
	}

	/*
	 * get all persons (id,name)
	 * @return integer status code: -1 if error, 0 otherwise
	 *
	 */
	public function getPersons() {
		if ($this->dataPersons == - 1)
			$result = array (
					'code' => - 1,
					'data' => "Problem reading data file"
			);
		else {
			$result = array (
					'code' => 0,
					'data' => $this->dataPersons
			);
		}
		return $result;
	}
	/*
	 * add a new person
	 * @param id integer the ident of a person
	 * @param name string the name of a person
	 * @return integer status code: -1 if error, 0 otherwise
	 */
	public function addPerson($id, $name) {
		if ($this->existId ( $id ) != - 1)
			return - 1;
		$entry = new stdClass ();
		$entry->id = $id;
		$entry->name = $name;
		$this->dataPersons [] = $entry;
		$this->updateJSON ();

		return 0;
	}
	/**
	 * remove a person
	 *
	 * @param
	 *        	id integer the ident of a person
	 * @return integer status code: -1 if error, 0 otherwise
	 */
	public function removePerson($id) {
		$index = $this->existId ( $id );
		if ($index == - 1)
			return - 1;
		\array_splice($this->dataPersons, $index, 1 );
		$this->updateJSON ();
		return 0;
	}

	/**
	 * check if id of a person exists or not
	 *
	 * @return integer returns -1 if not exists, the table index otherwise
	 */
	private function existId($id) {
		foreach ( $this->dataPersons as $index => $p ) {
			if ($p->id == $id)
				return $index;
		}
		return - 1;
	}
	
	private function updateJSON(){
		$json = new stdClass ();
		$json->persons = $this->dataPersons ;
		file_put_contents($this->dataFile, json_encode($json));
	}
}