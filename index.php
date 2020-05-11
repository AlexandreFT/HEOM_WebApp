
<html>
<head>
<Title>HEOM - Hospital Especializado Octávio Mangabeira</Title>
</head>
<body>
<form method="post" action="?action=add" enctype="multipart/form-data" >
    Column_1 <input type="text" name="Column_1" id="Column_1"/></br>

    Paciente ID <input type="text" name="paciente_id" id="paciente_id"/></br>

    Registro do Hospital <input type="text" name="registro_hosp" id="registro_hosp"/></br>

    Primeiro Nome <input type="text" name="prim_nome" id="prim_nome"/></br>

    Último Nome <input type="text" name="ult_nome" id="ult_nome"/></br>

    Nome Completo <input type="text" name="nome_completo" id="nome_completo"/></br>

    Sexo
    <input type="radio" id="M" name="sexo" value="M">
    <label for="M">Masculino</label><br>
    <input type="radio" id="F" name="sexo" value="F">
    <label for="F">Feminino</label><br>

    Data de Nascimento
    <input type="date" name="data_nascim" id="data_nascim"/></br>

    O(a) paciente é fumante?
    <input type="radio" id="Sim" name="fumante_status" value="Sim">
    <label for="Sim">Sim</label><br>
    <input type="radio" id="Ex-Fumante" name="fumante_status" value="Ex-Fumante">
    <label for="F">Ex-Fumante</label><br>
    <input type="radio" id="Não" name="fumante_status" value="Não">
    <label for="F">Não</label><br>
    
    Telefone <input type="text" name="telefone" id="telefone"/></br>

    <input type="submit" name="submit" value="Submit" />

</form>
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
        $insertSql = "INSERT INTO heom.pacientes (Column_1, paciente_id,registro_hosp,prim_nome,ult_nome,
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
            echo "Registration complete.</br>";
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
</body>
</html>
