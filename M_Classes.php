<?php
/**
 * 
 *
 * @author Admir Mucaj
 *   
 */
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('C:\xampp\htdocs\apiTpst\classes.php');
$classes = new classes();
switch($requestMethod) {
	case 'GET':
			
		if($_GET['id']) {
			$id = $_GET['id'];
			$classes->_id = $id;
			$data = $classes->one();
        } else 
        {
			$data = $classes->list();
		}
		if(!empty($data)) {
          $js_encode = json_encode(array('status'=>TRUE, 'classInfo'=>$data), true);
        } else {
          $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
        }
        header('Content-Type: application/json');
		echo $js_encode;
		break;
    
    case 'POST':
        
        echo $_GET['year'];
        $classes->_year=$_GET['year'];
        $classes->_section=$_GET['section'];
        $dataI=$classes->insert();
        if($dataI==1)
        {
            $id=$classes->ultimoID();
           // echo "questoooo  ".$id;
            $classes->_id=$id;
            $data=$classes->one();

            if(!empty($data)) {
                echo "hai inserito <br>";
                $js_encode = json_encode(array('status'=>TRUE, 'studentInfo'=>$data), true);
              } else {
                $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
              }
              header('Content-Type: application/json');
              echo $js_encode;
        }
        else
        {
            echo "errore";
        }
    
        break;
    case 'DELETE':
        if($_GET['id'])
        {
         // echo $_GET['id'];
          $id = $_GET['id'];
          $classes->_id = $_GET['id'];
          $result=$classes->delete();
          if($result=="ok")
          {
            echo " Hai modificato il db";
          }
        
        
        }
        break;
    case 'PATCH':
      $obj=json_decode(file_get_contents("php://input"),true);
      $classes->_id =$obj['id'];
      $classes->_year =$obj['year'];
      $classes->_section=$obj['section'];
      $data=$classes->one();
      if(!empty($data)) 
      {
       echo $classes->patch();
      } else
      {
        echo " classe non esistente";
      }
        break;
    case 'PUT':
      
        $obj=json_decode(file_get_contents("php://input"),true);
        $classes->_id =$obj['id'];
        $classes->_year =$obj['year'];
        $classes->_section=$obj['section'];
        $data=$classes->one();
      if(!empty($data)) 
      {
       echo $classes->put();
      } else
      {
        echo " classe non esistente";
      }
      
        break;
    default:
	    header("HTTP/1.0 405 Method Not Allowed");
	    break;
}
?>	