 <?php
/**
 * 
 *
 * @author Admir Mucaj
 *   
 */
 
include("DBConnection.php");
class Student 
{
    protected $db;
    public $_id;
    public $_name;
    public $_surname;
    public $_sidiCode;
    public $_taxCode;
 
    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();//chiedere spiegazioni
    }
 
    //insert ok
    public function insert() {
		try {
			//echo "ciao";
    		$sql = 'INSERT INTO student (name, surname, sidi_code, tax_code)  VALUES (:name, :surname, :sidi_code, :tax_code)';
    		$data = [
			    'name' => $this->_name,
			    'surname' => $this->_surname,
			    'sidi_code' => $this->_sidiCode,
			    'tax_code' => $this->_taxCode,
			];
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $stmt->rowCount();
			//echo $status;
            return $status;
 
		} catch (Exception $e) {
    		die("errore insert ". $e);
		}
 
	}
	//ultimo id ok
   public function ultimoID()
   {
	   try
	   {
			$sql="SELECT max(id) as 'id' FROM student";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result['id'];
 
	   }
	   catch (Exception $e) 
	   {
		die("get ultimo errore  ". $e);
	}
   }


    // getAll ok
    public function list() {
    	try {
    		$sql = "SELECT * FROM student";
		    $stmt = $this->db->prepare($sql);
 
		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("errore getAll". $e);
		}
    }

    // getOne ok
    public function one() {

		
    	try {
    		$sql = "SELECT * FROM student WHERE id=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
		    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("errore getOne" . $e);
		}
    }
 
    //delete ok
	public function delete() 
	{
		try
		{
			//echo $this->_id;
			$sql = "DELETE FROM student_class WHERE id_student=:id ";
			$stm = $this->db->prepare($sql);
			$data=[ 
				'id'=>$this->_id
			];

		$stm->execute($data);

			$sql = "DELETE FROM student WHERE id=:id ";
			$stm = $this->db->prepare($sql);
			$data=[ 
				'id'=>$this->_id
			];

		$stm->execute($data);
		$status = $stm->rowCount();
		
            return "ok";
 
		} catch (Exception $e) {
    		die("errore delete ".$e);
		}
 
    }

    // put funziona
	public function put() 
	{
		try
		{
		$sql="UPDATE student SET name='$this->_name',surname='$this->_surname',sidi_code=' $this->_sidiCode',tax_code=' $this->_taxCode' WHERE id=:id";
		$data=[
			'id' => $this->_id
		];
		$stm=$this->db->prepare($sql);
		$stm->execute($data);
		}
		catch(Exception $e)
		{
			die("errore put". $e);
		}
		
    }
 
    // patch TODO
	public function patch() 
	{
		$ControlloVirgola=0;
		try
		{
			$sql="UPDATE student SET ";
			if($this->_name!='null')
			{
			$sql.="name=$this->_name";
			$ControlloVirgola=1;
			}
			if($this->_surname!='null')
			{
			if($ControlloVirgola==1){$sql.=","; $ControlloVirgola=0;}
			$sql.="surname='$this->_surname'";
			$ControlloVirgola++;
			}
			
			if($this->_sidiCode!='null')
			{
			if($ControlloVirgola==1){$sql.=","; $ControlloVirgola=0;}
			$sql.="sidi_code='$this->_sidiCode'";
			$ControlloVirgola++;
			}
			
			if($this->_taxCode!='null')
			{
			if($ControlloVirgola==1){$sql.=","; $ControlloVirgola=0;}
			$sql.="tax_code='$this->_taxCode'";
			
			}
		$sql.=" WHERE id=:id";
		$data=[
			'id'=>$this->_id
		];
		$stmp=$this->db->prepare($sql);
		$stmp->execute($data);
		return "Patch fatta";

		}
		catch(Exception $e)
		{
			die("errore patch" . $e);
		}
    }
 
}
?>