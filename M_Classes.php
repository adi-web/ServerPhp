<?php
/**
 * 
 *
 * @author Admir Mucaj
 *   
 */
$requestMethod = $_SERVER["REQUEST_METHOD"];
$pathArray = explode('/', $_SERVER['REQUEST_URI']);
include('C:\xampp\htdocs\apiTpst\classes.php');
$classes = new classes();
switch($requestMethod) {
	case 'GET':
			
		if(!empty($pathArray[3])) {
			$id = !empty($pathArray[3]);
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
        
      $obj=json_decode(file_get_contents("php://input"),true);

        $classes->_year=$obj['year'];
        $classes->_section=$obj['section'];
        $dataI=$classes->insert();
        if($dataI==1)
        {
            $id=$classes->ultimoID();
        
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
        if(!empty($pathArray[3]))
        {
          $id = $pathArray[3];
          $classes->_id =$id;
          $result=$classes->delete();
          if($result=="ok")
          {
            echo " Delete fatta";
          }
        
        
        }
        break;
    case 'PATCH':
      $obj=json_decode(file_get_contents("php://input"),true);
      if(!empty($obj['id']))
      {
        $classes->_id =$obj['id'];
        if(!empty($obj['year']))
        { 
          $classes->_year =$obj['year'];
       
        }
        else
        {
      
          $classes->_year=null;
        }
        if(!empty($obj['section']))
        {
          $classes->_section=$obj['section'];
        }
        else
        {
          $classes->_section=null;
       

        }
        $data=$classes->one();
      }
      else
      {
        echo "inserire id";
      }
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
      if(!empty($obj['id']))
      {
        $classes->_id =$obj['id'];
        if(!empty($obj['year']))
        { 
          $classes->_year =$obj['year'];
       
        }
        else
        {
      
          $classes->_year=null;
        }
        if(!empty($obj['section']))
        {
          $classes->_section=$obj['section'];
        }
        else
        {
          $classes->_section=null;
       

        }
        $data=$classes->one();
      }
      else
      {
        echo "inserire id";
      }
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