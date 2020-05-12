<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
    textarea{
        border:solid 1px black;
        font-family: sans-serif;
        font-size:15px;
        background-color:white;
        color:black;
    }
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php

/*

░▒▓█ ACCOUNTING DOUBLE ENTRY ALGORITHM █▓▒░



*/


//DB connection variables
$host = 'localhost';
$user = 'root';
$password = '1995';

//create mysql connection
$mysqli = new mysqli($host,$user,$password);
if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    die();
}

//Drop database if exist
$mysqli->query('
DROP DATABASE IF EXISTS `accounting`;
') or die($mysqli->error);


//create the database
if ( !$mysqli->query('CREATE DATABASE accounting') ) {
    printf("Errormessage: %s\n", $mysqli->error);
}

//create user table
$mysqli->query('
CREATE TABLE `accounting`.`user`
(
    `user_id` VARCHAR(50) NOT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `user_type` VARCHAR(50) NOT NULL,
	 PRIMARY KEY (`user_id`)
);') or die($mysqli->error);

//create sheet table
$mysqli->query('
CREATE TABLE `accounting`.`sheet`
(
    `sheet_id` VARCHAR(50) NOT NULL,
    `sheet_name` VARCHAR(50) NOT NULL,
    `user_id` VARCHAR(50) NOT NULL,
    `date_created` VARCHAR(50) NOT NULL,
	 PRIMARY KEY (`sheet_id`,`user_id`)
);') or die($mysqli->error);

//create accounts table
$mysqli->query('
CREATE TABLE `accounting`.`account`
(
    `account_id` VARCHAR(50) NOT NULL,
    `sheet_id` VARCHAR(50) NOT NULL,
    `account_name` VARCHAR(50) NOT NULL,
	 PRIMARY KEY (`sheet_id`,`account_id`)
);') or die($mysqli->error);


//create transactions table
$mysqli->query('
CREATE TABLE `accounting`.`transaction`
(
    `trans_id` VARCHAR(50) NOT NULL,
    `sheet_id` VARCHAR(50) NOT NULL,
    `account_id` VARCHAR(50) NOT NULL,
    `trans_date` VARCHAR(20) NOT NULL,
    `trans_detail` VARCHAR(40) NOT NULL,
    `trans_amount` VARCHAR(10) NOT NULL,
    `trans_type` VARCHAR(50) NOT NULL,
    `account_name` VARCHAR(50) NOT NULL,
	 PRIMARY KEY (`trans_id`)
);') or die($mysqli->error);

echo "Information added to database successfully".'<br>';




$servername = "localhost";
$username = "root";
$password = "1995";
$dbname = "accounting";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    
    $person = $conn->prepare("INSERT INTO user (user_id,first_name,last_name,user_type) 
    VALUES (:user_id,:first_name,:last_name,:user_type)");
    $person->bindParam(':user_id', $user_id);
    $person->bindParam(':first_name', $first_name);
    $person->bindParam(':last_name', $last_name);
    $person->bindParam(':user_type', $user_type);

    // insert a row
    $user_id= "garyroberts1995@gmail.com";
    $first_name = "Gary";
    $last_name="Roberts";
    $user_type="student";
    $person->execute();
    
    
    
    
    $stmt1 = $conn->prepare("INSERT INTO sheet (sheet_id,sheet_name,user_id,date_created) 
    VALUES (:sheet_id,:sheet_name,:user_id,:date_created)");
    $stmt1->bindParam(':sheet_id', $sheet_id);
    $stmt1->bindParam(':sheet_name', $sheet_name);
    $stmt1->bindParam(':user_id', $user_id);
    $stmt1->bindParam(':date_created', $date_created);

    // insert a row
    $sheet_id= "sheet2018";
    $sheet_name = "NCB";
    $user_id="garyroberts1995@gmail.com";
    $date_created="January 23,2019";
    $stmt1->execute();

    $stmt2 = $conn->prepare("INSERT INTO account (account_id,sheet_id,account_name) 
    VALUES (:account_id,:sheet_id,:account_name)");
    $stmt2->bindParam(':account_id', $account_id);
    $stmt2->bindParam(':sheet_id', $sheet_id);
    $stmt2->bindParam(':account_name', $account_name);

    // insert a new account
    $account_id= "comp2018";
    $sheet_id = "sheet2018";
    $account_name= "Computer Equipment A/C";
    $stmt2->execute();

    // insert a row
    $account_id= "rent2018";
    $sheet_id = "sheet2018";
    $account_name= "Rent A/C";
    $stmt2->execute();
    
    // insert a row
    $account_id= "school2018";
    $sheet_id = "sheet2018";
    $account_name= "School Fee A/C";
    $stmt2->execute();
    
    
     $stmt3 = $conn->prepare("INSERT INTO transaction(trans_id,sheet_id,account_id,trans_date,trans_detail,trans_amount,trans_type,account_name) 
    VALUES (:trans_id,:sheet_id,:account_id,:trans_date,:trans_detail,:trans_amount,:trans_type,:account_name)");
     $stmt3->bindParam(':trans_id', $trans_id);
     $stmt3->bindParam(':sheet_id', $sheet_id);
     $stmt3->bindParam(':account_id', $account_id);
     $stmt3->bindParam(':trans_date', $trans_date);
     $stmt3->bindParam(':trans_detail', $trans_detail);
     $stmt3->bindParam(':trans_amount', $trans_amount);
     $stmt3->bindParam(':trans_type', $trans_type);
     $stmt3->bindParam(':account_name', $account_name);
    
    // insert transaction
    $trans_id= "trans1";
    $sheet_id = "sheet2018";
    $account_id= "comp2018";
    $trans_date= "January 15 2018";
    $trans_detail= "computer equipment";
    $trans_amount= "25000";
    $trans_type= "credit";
    $account_name="Computer Equipment A/C";
    $stmt3->execute();
    
    // insert transaction
    $trans_id= "trans2";
    $sheet_id = "sheet2018";
    $account_id= "comp2018";
    $trans_date= "January 20 2018";
    $trans_detail= "Computer equipment";
    $trans_amount= "500.00";
    $trans_type= "debit";
    $account_name="Computer Equipment A/C";
    $stmt3->execute();
    
    
    // insert transaction
    $trans_id= "trans7";
    $sheet_id = "sheet2018";
    $account_id= "rent2018";
    $trans_date= "February 30 2018";
    $trans_detail= "Rent";
    $trans_amount= "35000";
    $trans_type= "debit";
    $account_name="Rent A/C";
    $stmt3->execute();
    
    // insert transaction
    $trans_id= "trans3";
    $sheet_id = "sheet2018";
    $account_id= "rent2018";
    $trans_date= "February 26 2018";
    $trans_detail= "Rent";
    $trans_amount= "9000";
    $trans_type= "credit";
    $account_name="Rent A/C";
    $stmt3->execute();
    
    
     // insert transaction
    $trans_id= "bank1";
    $sheet_id = "sheet2018";
    $account_id= "school2018";
    $trans_date= "March 30 2018";
    $trans_detail= "School Fee";
    $trans_amount= "25000";
    $trans_type= "credit";
    $account_name="School Fee A/C";
    $stmt3->execute();
    
    // insert transaction
    $trans_id= "bank4";
    $sheet_id = "sheet2018";
    $account_id= "school2018";
    $trans_date= "March 30 2018";
    $trans_detail= "School Fee";
    $trans_amount= "8000";
    $trans_type= "credit";
    $account_name="School Fee A/C";
    $stmt3->execute();
    
     // insert transaction
    $trans_id= "bank2";
    $sheet_id = "sheet2018";
    $account_id= "school2018";
    $trans_date= "March 30 2018";
    $trans_detail= "School Fee";
    $trans_amount= "5000";
    $trans_type= "debit";
    $account_name="School Fee A/C";
    $stmt3->execute();
    
    
    echo "New records created successfully".'<br>';
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;



 $con=mysqli_connect("localhost","root","1995", "accounting");

if (!$con)
 {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully".'<br>';   
    
$sheet_id="sheet2018"; 
$account_id="cash2018";   
$select_trans="Select * FROM transaction";
 
$read_trans=mysqli_query($con,$select_trans);

$credit_total = array();
$debit_total = array();
$credit_trans = array();
$debit_trans = array();
$final_balances = array();
$balance_type = array();
$account_name= array();
$debit_count=0;
$credit_count=0;
$counter=0;
$counter2=0;


if(mysqli_num_rows($read_trans))
{   
	while($arr=mysqli_fetch_row($read_trans))
	{
   
       if($sheet_id==$arr[1] && $arr[6]=="credit")
		{
            $credit_count++;
            $credit_trans[$arr[3]."-".$arr[4]."-".$arr[5]]="credit".".".$arr[7];
           
            if($arr[6]=="credit")
            {
                if (!array_key_exists($arr[7],$credit_total))
                { 
                    $credit_total+=array($arr[7]=>0);
                    $account_name+=array($arr[7]=>0);
                }  
                
                if (array_key_exists($arr[7],$credit_total) && array_key_exists($arr[7],$account_name))
                { 
                    $credit_total[$arr[7]]= $credit_total[$arr[7]]+$arr[5];
                    $account_name[$arr[7]]= $account_name[$arr[7]]+$arr[5];
                }  
            }      
        }
        
        if($sheet_id==$arr[1] && $arr[6]=="debit")
		{
             $debit_count++;
             $debit_trans[$arr[3]."-".$arr[4]."-".$arr[5]]="debit".".".$arr[7];
            
            if($arr[6]=="debit")
            {
               if (!array_key_exists($arr[7],$debit_total))
                { 
                    $debit_total+=array($arr[7]=>0);
                    $account_name+=array($arr[7]=>0);
                }     
                
                if (array_key_exists($arr[7],$debit_total) && array_key_exists($arr[7],$account_name))
                { 
                    $debit_total[$arr[7]]= $debit_total[$arr[7]]+$arr[5];
                    $account_name[$arr[7]]= $account_name[$arr[7]]+$arr[5];
                } 
            }
           
        }
	  
	}
    
}




$counter_credits=0;
$counter_debits=0;
$count=1;
$credit_convert=array();
$debit_convert=array();
$account_convert=array();

foreach ($credit_total as $A=>$value) 
{ 
    $credit_convert+=array($counter_credits=>$value);
    $counter_credits++;
}


foreach ($debit_total as $B=>$value) 
{ 
    $debit_convert+=array($counter_debits=>$value);
    $counter_debits++;
}


$shift=0;

$credits_size=count($credit_total);
$debits_size=count($debit_total);

$array_size=$credits_size+$debits_size;

foreach ($account_name as $k=>$value) 
{ 
    $cr="credit";
    $dr="debit";
    
    echo '<h4>'.$k.'</h4><textarea id="'.$k.$dr.'" rows="6" cols="45" readonly>'.'</textarea><textarea id="'.$k.$cr.'" rows="6" cols="45" readonly></textarea><br>';
}


/* $data = "123_String";    
$whatIWant = substr($data, strpos($data, "_") + 1);  


$mystring = 'home/cat1/subcat2/';
$first = strtok($mystring, '/');
echo $first; // home

echo $whatIWant; echo '<br>'; */

echo '<br>';

foreach ($debit_trans as $k=>$value) 
{ 
      
    $side1 = substr($value, strpos($value, ".") + 1);  
    
    $dr="debit";
    
    $test1='<script> 
          var elem = document.getElementById('."'".$side1.$dr."'".');
        elem.innerHTML +="'.$k.'\n";
        </script>';
    
    echo $test1;

}


echo '<br>';echo '<br>';

foreach ($credit_trans as $k=>$value2) 
{ 
      
    $side2 = substr($value2, strpos($value2, ".") + 1);  
    
     $cr="credit";
    
    $test2='<script> 
          var elem = document.getElementById('."'".$side2.$cr."'".');
        elem.innerHTML +="'.$k.'\n";
        </script>';
    
    echo $test2;

}




echo '<br><br>';


echo "[ Balance ]".'<br>';

foreach ($credit_total as $m=>$value)
{
    
     if(!array_key_exists($m,$final_balances))
      { 
        $final_balances+=array($m=>0);
      }
    
    if($credit_total[$m]==$debit_total[$m])
    {
        echo "Account: ".$m."=".$value.":No balance";
        $balance_type[$counter]="no balance";
        echo " [Total for both accounts are equal]";
    }
    
     if($credit_total[$m]>$debit_total[$m])
     {
        $final_balances[$m]=$credit_total[$m]-$debit_total[$m]; 
         echo "Account: ".$m.': '; echo $final_balances[$m];
         $balance_type[$counter]="credit";
         echo " [Balance carried down on credits side]";
         
           $cr="credit";
           $dr="debit";
            $test2='<script> 
             var elem = document.getElementById('."'".$m.$cr."'".');
           elem.innerHTML +="[Total]='.$credit_total[$m].'\n";  
           
             var elem = document.getElementById('."'".$m.$dr."'".');
           elem.innerHTML +="[Total]='.$debit_total[$m].'\n";  
           
           var elem = document.getElementById('."'".$m.$cr."'".');
           elem.innerHTML +="[Balanced c/d]='.$final_balances[$m].'\n";
         
           
        </script>';
    
        echo $test2;
     }
    
      if($credit_total[$m]<$debit_total[$m])
      {
        $final_balances[$m]=$debit_total[$m]-$credit_total[$m]; 
         echo "Account: ".$m.': '; echo $final_balances[$m];
         $balance_type[$counter]="debit";
          echo " [balance carried down on debits side]";
          
           $cr="credit";
           $dr="debit";
            $test2='<script> 
             var elem = document.getElementById('."'".$m.$cr."'".');
           elem.innerHTML +="[Total]='.$credit_total[$m].'\n";  
           
             var elem = document.getElementById('."'".$m.$dr."'".');
           elem.innerHTML +="[Total]='.$debit_total[$m].'\n";  
           
           var elem = document.getElementById('."'".$m.$dr."'".');
           elem.innerHTML +="[Balanced c/d]='.$final_balances[$m].'\n";
         
           
        </script>';
    
        echo $test2;
      }
    
    $counter++;
     echo '<br>';
}


echo '<br>';


$trial_balance=array();

foreach ($final_balances as $A=>$value) 
{ 
    $trial_balance+=array($A=>$value);
}



echo'<br><br><br>';

$debit_total=0;
$credit_total=0;
$length = count($trial_balance);

 echo "[ TRIAL BALANCE ]".'<br>';
echo '<table style="width:30%">
  <tr>
    <th>Accounts</th>
    <th>Debit</th> 
    <th>Credit</th>
  </tr>';
foreach ($trial_balance as $AC=>$value) 
{ 

      if($balance_type[$counter2]=="credit")
      {
        echo' <tr>
        <td>'.$AC.'</td>
        <td></td>
        <td>'.$value.'</td>
          </tr>';  
         $credit_total=$credit_total+$value; 
      }
    
    if($balance_type[$counter2]=="debit")
    {
      echo' <tr>
        <td>'.$AC.'</td>
        <td>'.$value.'</td>
        <td></td>
          </tr>';    
        $debit_total=$debit_total+$value;
    }
      
    if ($counter2 == $length - 1) 
    {
        echo' <tr>
        <td><font size="4" color="black">Totals:</font></td>
        <td>'.$debit_total.'</td>
        <td>'.$credit_total.'</td>
          </tr>'; 
     }
    
     $counter2++;
    
}

 echo '</table> <br><br><br>';




?>