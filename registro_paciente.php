<?php
/*Connect using SQL Server authentication.*/
$serverName = "tcp:heom.database.windows.net,1433";
$connectionOptions = array("Database"=>"heom",
                           "UID"=>"alex",
                           "PWD" => "Q03mpx23lk!");
$conn = sqlsrv_connect($serverName, $connectionOptions);
if($conn === false)
{
    die(print_r(sqlsrv_errors(), true));
}
if(isset($_GET['action']))
{
    if($_GET['action'] == 'add')
    {
        /*Insert data.*/
        $insertSql = "INSERT INTO heom.pacientes_php_test (Column_1, paciente_id,registro_hosp,prim_nome,ult_nome,
        nome_completo,sexo,data_nascim,fumante_status,telefone)
                      VALUES (?,?,?,?,?,?,?,?,?,?)";
        $params = array(&$_POST['Column_1'],
                        &$_POST['paciente_id'],
                        &$_POST['registro_hosp'],
                        &$_POST['prim_nome'],
                        &$_POST['ult_nome'],
                        &$_POST['nome_completo'],
                        &$_POST['sexo'],
                        &$_POST['data_nascim'],
                        &$_POST['fumante_status'],
                        &$_POST['telefone']);
        $stmt = sqlsrv_query($conn, $insertSql, $params);
        if($stmt === false)
        {
            /*Handle the case of a duplicte e-mail address.*/
            $errors = sqlsrv_errors();
            if($errors[0]['code'] == 2601)
            {
                echo "The e-mail address you entered has already been used.</br>";
            }
            /*Die if other errors occurred.*/
            else
            {
                die(print_r($errors, true));
            }
        }
        else
        {
            echo "Paciente registrado com sucesso!</br>";
        }
    }
}
/*Display registered people.*/
/*$sql = "SELECT * FROM empTable ORDER BY name";
$stmt = sqlsrv_query($conn, $sql);
if($stmt === false)
{
    die(print_r(sqlsrv_errors(), true));
}
if(sqlsrv_has_rows($stmt))
{
    print("<table border='1px'>");
    print("<tr><td>Emp Id</td>");
    print("<td>Name</td>");
    print("<td>education</td>");
    print("<td>Email</td></tr>");
     
    while($row = sqlsrv_fetch_array($stmt))
    {
         
        print("<tr><td>".$row['emp_id']."</td>");
        print("<td>".$row['name']."</td>");
        print("<td>".$row['education']."</td>");
        print("<td>".$row['email']."</td></tr>");
    }
    print("</table>");
}*/
?>