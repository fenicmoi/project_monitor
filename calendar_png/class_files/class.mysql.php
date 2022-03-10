<?
 error_reporting(0);
 error_reporting(E_ERROR | E_PARSE);

if(preg_match('/class.mysql.php/',$_SERVER['PHP_SELF'])){

    Header("Location: index.php");

	die();

}





class DB{
	var $host = DB_HOST ;
	var $database ;
	var $connect_db ;
	var $selectdb ;
	var $db ;
	var $sql ;
	var $table ;
	var $where; 

	function connectdb($db_name="database",$user="username",$pwd="password",$chang_dbms="chang_dbms",$chang_host="chang_dbms"){

		if($chang_host!="chang_dbms") $this->host=$chang_host; else $this->host=DB_HOST;

		$this->database = $db_name;

		$this->username = $user;

		$this->password = $pwd;

		switch($chang_dbms){

			case "MYSQL" : {

				$this->connect_db = mysql_connect ( $this->host, $this->username, $this->password ) or sql_error ( "database-connect", mysql_error() );

				//$this->connect_db = mysql_pconnect ( $this->host, $this->username, $this->password ) or sql_error ( "database-connect", mysql_error() );

				$this->db = mysql_select_db ( $this->database, $this->connect_db) or sql_error ( "database-select", mysql_error() );

				mysql_query("SET NAMES UTF8"); 

				mysql_query("SET character_set_results=UTF8"); 

				return true; 

			}break;

		}#case



	}



	//�Դ����������ʹҵ����

	function closedb($chang_dbms="chang_dbms"){

		switch($chang_dbms){

			case "MYSQL" : {

				mysql_close ( $this->connect_db ) or sql_error ( "database-close", mysql_error() );

			}break;

		}#case

	}



	function add_db($table="table", $data="data",$chang_dbms="chang_dbms"){

		$key = array_keys($data); 

        $value = array_values($data); 

		$sumdata = count($key); 

		for ($i=0;$i<$sumdata;$i++) 

        { 

            if (empty($add)){ 

                $add="("; 

            }else{ 

                $add=$add.","; 

            } 

            if (empty($val)){ 

                $val="("; 

            }else{ 

                $val=$val.","; 

            } 

            $add=$add.$key[$i]; 

            $val=$val."'".$value[$i]."'"; 

        } 

        $add=$add.")"; 

        $val=$val.")"; 

        $sql="INSERT INTO ".$table." ".$add." VALUES ".$val; 



		switch($chang_dbms){

			case "MYSQL" : {

												if (mysql_query($sql)){ 

													return true; 

												}else{ 

													$this->_error(); 

													return false; 

												} 

										}break;

		}#case



	}


    function update_db($table="table",$data="data",$where="where",$chang_dbms="chang_dbms"){ 

        $key = array_keys($data); 

        $value = array_values($data); 

        $sumdata = count($key); 

        $set=""; 

        for ($i=0;$i<$sumdata;$i++) 

        { 

            if (!empty($set)){ 

                $set=$set.","; 

            } 

            $set=$set.$key[$i]."='".$value[$i]."'"; 

        } 

        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 



		switch($chang_dbms){

			case "MYSQL" : {

												if (mysql_query($sql)){ 

													return true; 

												}else{ 

													$this->_error(); 

													return false; 

												} 

											}break;

		}#case

    } 




	function update($table="table",$set="set",$where="where" ,$chang_dbms="chang_dbms"){ 

        $sql="UPDATE ".$table." SET ".$set." WHERE ".$where; 

		switch($chang_dbms){

			case "MYSQL" : {

												if (mysql_query($sql)){ 

													return true; 

												}else{ 

													$this->_error(); 

													return false; 

												} 

											}break;

		}#case

    } 


    //function del($table="table",$where="where",$chang_dbms="chang_dbms"){ 
     function del($table="table",$where="where",$chang_dbms="chang_dbms"){ 
        $sql="DELETE FROM ".$table." WHERE ".$where; 


		switch($chang_dbms){

			case "MYSQL" : {

												if (mysql_query($sql)){ 

													return true; 

												}else{ 

													$this->_error(); 

													return false; 

												} 

										}break;

		}#case

    } 



	//�Ѻ�ӹǹ�Ǣ�����

	//$db->num_rows("table","field","where"); 

    function num_rows($table="table",$field="field",$where="where",$chang_dbms="chang_dbms") { 

        if ($where=="") { 

            $where = ""; 

        } else { 

            $where = " WHERE ".$where; 

        } 

        $sql = "SELECT ".$field." FROM ".$table.$where; 



		switch($chang_dbms){

			case "MYSQL" : {



												if($res = mysql_query($sql)){ 

													return mysql_num_rows($res); 

												}else{ 

													$this->_error(); 

													return false; 

												} 

											}break;

		}#case

	} 



	//Query ������

	//$res = $db->select_query('SELECT field FROM table WHERE where'); 

    function select_query($sql="sql",$chang_dbms="chang_dbms"){ 

		switch($chang_dbms){

			case "MYSQL" : {

												if ($res = mysql_query($sql)){ 

													return $res; 

												}else{ 

													$this->_error(); 

													return false; 

												} 

											}break;

		}#case

    } 



	//�Ѻ�ӹǹ�Ǣ�����

	//$res = $db->select_query('SELECT field FROM table WHERE where'); 

	//$rows = $db->rows($res); 

    function rows($sql="sql",$chang_dbms="chang_dbms"){ 

		switch($chang_dbms){

			case "MYSQL" : {



													$res = mysql_query($sql);

												  if ($row = mysql_num_rows($res)){ 

														return $row; 

													}else{ 

														$this->_error(); 

														return false; 

													} 

											}break;

		}#case

    } 



	//�Ѻ�ӹǹ�Ǣ�����

	//$res = $db->select_query('SELECT field FROM table WHERE where'); 

	//$rows = $db->rows($res); 

    function rows1($sql="sql",$chang_dbms="chang_dbms"){ 

		switch($chang_dbms){

			case "MYSQL" : {



											  if ($row = mysql_num_rows($sql)){ 

													return $row; 

												}else{ 

													$this->_error(); 

													return false; 

												} 

											}break;

		}#case

    } 



	//�֧��� array

	//$res = $db->select_query('SELECT field FROM table WHERE where'); 

	//while ($arr = $db->fetch($res)) { 

	//		echo $arr['a']." - ".$arr['c']."<br>\n"; 

	//}

    function fetch($sql="sql",$chang_dbms="chang_dbms"){ 

		switch($chang_dbms){

			case "MYSQL" : {

											  if ($res = mysql_fetch_assoc($sql)){ 

													return $res; 

												}else{ 

													$this->_error(); 

													return false; 

												} 

											}break;

		}#case

    } 



	//�ʴ���ͤ����Դ��Ҵ

    function _error($chang_dbms="chang_dbms"){ 

		switch($chang_dbms){

			case "MYSQL" : {

												$this->error[]=mysql_errno(); 

										  }break;

		}#case

    } 



}

?>