 <?PHP
 
 /*
  * Gatekeeper - Software to Keep track of visitors
    
    Copyright (C) 2012  Michael 'heeed' Rimicans

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/



$dbhost = '127.0.0.1';
$dbname = '';
$dbuser = '';
$dbpass = '';

if(!$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die('no connection to database');
}
else
{
	echo('Gatekeeper v0.1 <br/> Database live and connected');
}

$con = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

 


echo "<hr>";


if(!empty($_POST['in']))
{
	$sql = $con -> prepare("UPDATE visitors SET present = ? WHERE `Attendee #` = ?");
	$sql->execute(array('1',$_POST['in']));
}

if(!empty($_POST['out']))
{
	$sql = $con -> prepare("UPDATE visitors SET present = ? WHERE `Attendee #` = ?");
	$sql->execute(array('0',$_POST['out']));
}

if(!empty($_POST['id']))
{
	$sql = $con -> prepare("select  `Attendee #` as attendee,`First Name` as fname, `Last Name` as lname, present from visitors where `Attendee #` LIKE '%".$_POST['id']."%'");
	
	$sql->execute();
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);
}
elseif(!empty($_POST['name_search']))
{
	$sql = $con -> prepare("select  `Attendee #` as attendee,`First Name` as fname, `Last Name` as lname, present from visitors where `First Name` LIKE '%".$_POST['name_search']."%'");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}
elseif(!empty($_POST['name_surname']))
{
	
	$sql = $con -> prepare("select  `Attendee #` as attendee,`First Name` as fname, `Last Name` as lname,present from visitors where `Last Name` LIKE '%".$_POST['name_surname']."%'");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
       

}
else
{
	echo "Nothing Entered<br/>";
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>


<form name="input" action="" method="post">

Ticket No: <input type="text" name="id" id = "name_id" >
Name: <input type="text" name="name_search" id = "name_id" >
Surname: <input type="text" name="name_surname" id = "name_id" >
<input type="submit" value="Check">

</form>

<?PHP

$table = '<table border="1"><th>Id</th><th>name</th><th>status</th><th>Check In</th><th>Check Out</th>';

foreach ($result as $key => $value)
{
    	
    $table .=  "<tr><td>".$result[$key]['attendee']."</td><td>".$result[$key]['fname']." ".$result[$key]['lname'];
     
     
 if($result[$key]['present'] !== '0')
			{
				$table .= "<td style=\"background-color:green;\"></td>";
			}
			else
			{
				$table .= "<td style=\"background-color:red;\"></td>";
			};
     
     $table .= "<td><form action=\"\" method=\"post\">
				<input type=\"hidden\" name=\"in\" value = \"".$result[$key]['attendee']."\">
				<input type = \"submit\" value=\"in\">
				</form></td>";
				
	 $table .= "<td><form action=\"\" method=\"post\">
				<input type=\"hidden\" name=\"out\" value = \"".$result[$key]['attendee']."\">
				<input type = \"submit\" value=\"out\">
				</form></td>";			
     
      $table .= "</tr>";
     
    
    
}
$table .= "</table>";
 echo $table;
?>
