

<html>
<meta charset="UTF-8">
<title>
</title>
<body>
<?/*php
include('db_conn.php'); 

$id_kr_sentence = ' ';

if(isset($_POST['korean'])){
	$korean = $_POST['korean'];
			$kr_w_find = $conn->prepare("Select id from kr_mn inner join korean on kr_mn.k_id=korean.id where korean.kr_w = '".$korean."'");
			$kr_w_find->execute();	
			$kr_w_find = $kr_w_find -> fetch();
			$kr_found = $kr_w_find['id'];
}


	if (isset($_POST['Insert']))
	{
		//korean ug shalgah insert
		if(isset($_POST['kr_w'])&& !empty($_POST['kr_w']))
		{
			$kr1 = $_POST['kr_w'];

			$kr_w_find = $conn->prepare("Select id from korean where kr_w = '".$kr1."'");
			$kr_w_find->execute();	
			$kr_w_find = $kr_w_find -> fetch();
			$kr_found = $kr_w_find['id'];
			if(isset( $kr_w_find['id']))
			{
				//echo  $kr_found;
				//$ur_id = $u_id_ch['uramshuulal_id'];
			}
			else
			{
				$sql ="insert into korean(kr_w) values('".$kr1."')";
				$conn->exec($sql);
				$kr_w_find = $conn->prepare("Select id from korean where kr_w = '".$kr1."'");
				$kr_w_find->execute();	
				$kr_w_find = $kr_w_find -> fetch();
				$kr_found = $kr_w_find['id'];					
			}
		}
		//mongol ug shalgah insert
			$mn_found_arr = array();
			for ($i=0; $i <=$_POST['Contentword'] ; $i++) 
			{ 
				if(isset($_POST['mn_w'.$i.'']) && !empty($_POST['mn_w'.$i.'']))
				{
					$mn1 = $_POST['mn_w'.$i.''];
					$mn_w_find = $conn->prepare("Select id from mongol where mn_w = '".$mn1."'");
					$mn_w_find->execute();	
					$mn_w_find = $mn_w_find -> fetch();
					$mn_found_arr[$i] = $mn_w_find['id'];
					if(isset( $mn_found_arr[$i]))
					{
						//echo  $mn_found_arr[$i];
						//$ur_id = $u_id_ch['uramshuulal_id'];					
					}
					else
					{
						$sql ="insert into mongol(mn_w) values('".$mn1."')";
						$conn->exec($sql);		
						$mn_w_find = $conn->prepare("Select id from mongol where mn_w = '".$mn1."'");
						$mn_w_find->execute();	
						$mn_w_find = $mn_w_find -> fetch();
						$mn_found_arr[$i] = $mn_w_find['id'];				
					}
				}			
			}


			$kr_mn_kr = null;
			$kr_mn_mn = null;

			if(isset($kr_found)){
				$kr_mn_check = $conn->prepare("Select id from kr_mn where k_id = '".$kr_found."'");
				$kr_mn_check->execute();	
				$kr_mn_check = $kr_mn_check -> fetch();
				$kr_mn_kr = $kr_mn_check['id'];
				//echo "korine";
				//echo $kr_mn_kr;
			}
		for ($i=0; $i <= sizeof($mn_found_arr) ; $i++) 
		{

			if(isset($mn_found_arr[$i])&&isset($kr_found))
			{
			//	echo "dundiin husnegt <br>";
			//	echo $mn_found_arr[$i];
				
				
				$kr_mn_check1 = $conn->prepare("Select id from kr_mn where m_id = '".$mn_found_arr[$i]."'");
				$kr_mn_check1->execute();	
				$kr_mn_check1 = $kr_mn_check1 -> fetch();
				$kr_mn_mn = $kr_mn_check1['id'];
				echo "mongol id";
				echo $kr_mn_mn;
					if(isset($kr_mn_kr)&&isset($kr_mn_mn)){
						echo "dundiin ";
						if($kr_mn_kr!=$kr_mn_mn)
						{
						//	echo "dundiin husnegt insert davtagdahgui oroh";
							$sql ="insert into kr_mn(k_id,m_id,aimag_id) values('".$kr_found."','".$mn_found_arr[$i]."',1)";
							$conn->exec($sql);	
							
						}
					}
					else
					{
						//echo "dundiin husnegt insert anhnii oroh";
						$sql ="insert into kr_mn(k_id,m_id,aimag_id) values('".$kr_found."','".$mn_found_arr[$i]."',1)";
							$conn->exec($sql);

					}		
					
			}
		}
		
		
	}?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $( function()
    { 
        $("#kr_word_result").autocomplete({
            source: 'php-auto.php',
            select: function(event, ui) 
            {             
               $("#kr_word_result").val(ui.item.val)
            $utga = ui.item.label.toString();
            //alert($utga);
           
           $id_kr_sentence = $utga.split("-",1);
           // alert($id_kr_sentence);
            }  
          

        });

       
    });
</script>
<?php
	if(isset($_POST['click']))
	{
		if(isset($_POST['kr_word_result']))
		{
			echo $_POST['kr_word_result'];
			$idblabla =  explode("-", $_POST['kr_word_result']);
			echo "explode=".$idblabla[0];
			$id_check = $conn->prepare("Select id from kr_mn where id = '".$idblabla[0]."'");
			$id_check->execute();	
			$id_check = $id_check -> fetch();
			$id_check1 = $id_check['id'];
			if(isset( $id_check['id']))
			{
				echo  "oldloo-".$id_check1;
				//$ur_id = $u_id_ch['uramshuulal_id'];
				if(isset($_POST['sentence1']) && !empty($_POST['sentence1']))
				{
					$s1 = $_POST['sentence1'];
				//	echo "s1=". $s1;
					$sql ="insert into kr_sentence(sentence,kr_mn_id) values('".$s1."','".$id_check1."')";
									$conn->exec($sql);

				}
				if(isset($_POST['sentence2']) && !empty($_POST['sentence2']))
				{
					$s2 = $_POST['sentence2'];
				//	echo "s2=".$s2;
					$sql ="insert into kr_sentence(sentence,kr_mn_id) values('".$s2."','".$id_check1."')";
									$conn->exec($sql);
				}
				if(isset($_POST['sentence3'])&& !empty($_POST['sentence3']))
				{
					$s3 = $_POST['sentence3'];
				//	echo "s3=".$s3;
					$sql ="insert into kr_sentence(sentence,kr_mn_id) values('".$s3."','".$id_check1."')";
									$conn->exec($sql);
				}
			}
			else
			{
				echo "oldsongui";					
			}


		}
}
	
?> 
	<form  action="<?php echo $_SERVER["PHP_SELF"]; ?>"  method="post" >
		<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Үг оруулах хэсэг</h3> <br>

		&nbsp;Солонгос үг:<br>
		<input type="text" name="kr_w"  placeholder="Солонгос үгээ оруулна уу" style="height: 35px;  width: 300px;"><br><br>
		<!-- <select name="Content word" >
	    <option value="n">Нэр үг</option>
	    <option value="v">Үйл үг</option>
	    <option value="adj">Тэмдэг нэр</option>
	    <option value="pn">Төлөөний үг</option>
	  </select>
   -->
       <br> <br>

        Монгол утга1:<br><input type="text" name="mn_w0"  placeholder="Монгол утгаа оруулна уу" style="height: 35px;  width: 300px;">
	     утга нэмэх<select name="Contentword"  id="select_id"  onclick="MyChoose()">
	    <option value="0"></option>
	    <option value="1">1</option>
	    <option value="2">2</option>
	    <option value="3">3</option>
	    <option value="4">4</option>
	    <option value="5">5</option>
	    <option value="6">6</option>
	    <option value="7">7</option>
	    <option value="8">8</option>
	    <option value="9">9</option>
	    <option value="10">10</option>
	  </select>
     <p  id="demo"></p>
  <br><br>     
  <div id= "container"></div>
	  
		
		<input type="submit" name="Insert"   value="Insert"  style="margin-left:200px;  height: 35px; width: 60px;"  onclick="utga();">
		<br><br>
	</form>
	
	

	<script type="text/javascript">

	
		var  v="hello"
	 var  input;
		function MyChoose(){
			 var number = document.getElementById("select_id").value;
             var container = document.getElementById("container");
             var  input;
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=1;i<=number;i++){
                container.appendChild(document.createTextNode("Moнгол утга" + (i+1+": ")));
                container.appendChild(document.createElement("br"));
                input = document.createElement("input");
                input.type = "text";
                input.name="mn_w"+i;
                input.id="mn"+i;
                input.style.height='35px';
                 input.style.width='300px';
                container.appendChild(input);
              //  input.appendChild(document.createElement("br"))
                container.appendChild(document.createElement("br"));
                 container.appendChild(document.createElement("br"));
            }
	}
	
	function  utga(){
		var  utgaa=document.getElementById("mn0").value;
	//	document.getElementById("demo").innerHTML=utgaa;
	//	valuee(utgaa);
		

	}
	
	


	</script>
      
			<br>
		</div>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<form  action="<?php echo $_SERVER["PHP_SELF"]; ?>"  method="post" >
		
				<label class="col-sm-3 control-label">  Солонгос үг: </label>
  		<input type="text" id="kr_word_result" name="kr_word_result">
  		<br><br>
		
		
      <input type="text" name="sentence1"  id="sentence1" placeholder="sentence1"   style="height: 55px;width: 300px;"><br><br>
		<input type="text" name="sentence2" placeholder="sentence2" style="height: 55px;width: 300px;"   id="sentence2"><br><br>
		
		<input type="text" name="sentence3"  id="sentence3"placeholder="sentence3" style="height: 55px;width: 300px;"><br><br>
		
		<input type="submit" name="click"   value="оруулах">
	</form>
	</body>
</html>

<!-- <? /*php  echo "DICTIONARY"; 
$servername = "localhost"
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername,$username,$password,$dbname);
mysqli_set_charset($conn,"utf8");
if($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}



	$sql = "Select * from mongol";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		echo "id:".$row["id"]. "word: ".$row["mn_w"]."<br>";

	
}
if(isset($_POST(['mn'])) && isset($_POST(['kr']))){
	echo "ckicked";
}
	
$conn->close();

?> 

<html>
<header>
	
</header>
<body>
	<form>
		Korean : 
		<input type="text" name="kr"> &nbsp;&nbsp;
		Mongolian :
		<input type="text" name="mn"><br><br>

		<input type="radio" name="check" value = "word" checked>new word<br><br><br>
	</form>
		<form>
		EXAMPLE SENTENCE <br><br>
		inputed korean word:
		<input type="text" name="kr"> &nbsp;&nbsp;
		sentence :
		<input type="text" name="mn"><br><br>

		<input type="radio" name="check" value = "sentence" >new sentence<br>

		<BUTTON name = "insert1" >INSERT</BUTTON>

	<BUTTON>UPDATE</BUTTON>
	<BUTTON>DELETE</BUTTON>
	</form>
	


</body>

</html> -->