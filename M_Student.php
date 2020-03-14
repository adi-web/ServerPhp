<?php
/**
 * 
 *
 * @author Admir Mucaj
 *   
 */
//$pathArray = explode('/', $_SERVER['REQUEST_URI']);
$requestMethod = $_SERVER["REQUEST_METHOD"];
/*$pathArray = explode('/', $_SERVER['REQUEST_URI']);
echo 'path: '.$pathArray[1];
echo '<br>';
echo 'param: '.$pathArray[2]; // <---- qui c'è il parametro*/
//echo  $_SERVER["REQUEST_METHOD"];
include('C:\xampp\htdocs\apiTpst\Student.php');
$student = new Student();
switch($requestMethod) {
	case 'GET':
		$id = '';	
		if($_GET['id']) {
			$id = $_GET['id'];
			$student->_id = $id;
			$data = $student->one();
		} else {
			$data = $student->list();
		}
		if(!empty($data)) {
          $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
        } else {
          $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
        }
        header('Content-Type: application/json');
		echo $js_encode;
		break;
    
    case 'POST':
        
        $student->_name =$_GET['name'];
        $student->_surname=$_GET['surname'];
        $student->_sidiCode=$_GET['sCode'];
        $student->_taxCode=$_GET['tCode'];
        $dataI=$student->insert();
        if($dataI==1)
        {
            $id=$student->ultimoID();
           // echo "questoooo  ".$id;
            $student->_id=$id;
            $data=$student->one();

            if(!empty($data)) {
                echo "hai inserito <br>";
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
              } else {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
              }
              header('Content-Type: application/json');
              echo $js_encode;
        }
    
        break;
    case 'DELETE':
        if($_GET['id'])
        {
         // echo $_GET['id'];
          $id = $_GET['id'];
          $student->_id = $_GET['id'];
          $result=$student->delete();
          if($result=="ok")
          {
            echo " Hai modificato il db";
          }
        
        
        }
        break;
    case 'PATCH':
      $obj=json_decode(file_get_contents("php://input"),true);
      $student->_id =$obj['id'];
      $student->_name =$obj['name'];
      $student->_surname=$obj['surname'];
      $student->_sidiCode=$obj['sidiCode'];
      $student->_taxCode=$obj['taxCode'];
      $data=$student->one();
      if(!empty($data)) 
      {
       echo $student->patch();
      } else
      {
        echo " studente non esistente";
      }
        break;
    case 'PUT':
      
      $obj=json_decode(file_get_contents("php://input"),true);
      echo $obj['name'];
      $student->_id =$obj['id'];
      $student->_name =$obj['name'];
      $student->_surname=$obj['surname'];
      $student->_sidiCode=$obj['sidiCode'];
      $student->_taxCode=$obj['taxCode'];
      $data=$student->one();
      if(!empty($data)) 
      {
       $student->put();
      } else
      {
        echo " studente non esistente";
      }
      
        break;
    default:
	    header("HTTP/1.0 405 Method Not Allowed");
	    break;
}
?>	