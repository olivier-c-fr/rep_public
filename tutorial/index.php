<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<title>Tutorial Simple Web MVC (swmvc) For PHP</title>

 
</head>
<body class="container">
<h1>List of Persons</h1>
<?php
require("model/ModelPersons.php") ;
$model= new ModelPersons() ;
$persons=$model->getPersons() ;
if ($persons["code"]!=0) die() ;
?>
<table id="listPersons">

<?php foreach($persons["data"] as $p) { ?>
<tr id="<?= $p->id; ?>">
  <td> <?= $p->name ; ?></td>
  <td><button class="btn btn-danger button-remove">
      <span class="fa fa-trash"></span>
      </button>
  </td>
</tr>
<?php
}
?>
</table>
<h1>Add a person:</h1>
<p>
 Id : <input type="number" id="id" name="id"/> 
 Name : <input type="text" id="name" name="name">
 </p> 
 <p><button id="button-add"  class="btn btn-success" >Add person</button></p>
 <br />
   <div id="status"></div>
 


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" src="../swmvc/js/Controller.js"></script>       
<script type="text/javascript" src="./controller/MyController.js"></script>


</body>

</html>