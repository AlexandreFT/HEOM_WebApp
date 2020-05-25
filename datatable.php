<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title>Dynamic Content from Azure SQL Database</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  
    </head>

    <body>

        <table id="pacientes">

            <thead>
                <th>Column_1</th>
                <th>paciente_id</th>
                <th>registro_hosp</th>
                <th>prim_nome</th>
                <th>ult_nome</th>
                <th>nome_completo</th>
                <th>sexo</th>
                <th>data_nascim</th>
                <th>fumante_status</th>
                <th>telefone</th>
            </thead>

        <tbody>
            <!-- Fetch from DB! -->
            <tr>
                <?php
                    $serverName = "tcp:heom.database.windows.net,1433";
                    $connectionOptions = array("Database"=>"heom",
                                        "UID"=>"alex",
                                        "PWD" => "Q03mpx23lk!");
                    $conn = sqlsrv_connect($serverName, $connectionOptions);
                    
                    if($conn === false) {              
                        die(print_r(sqlsrv_errors(), true));
                    }

                ?>


            </tr>
        </tbody>

    </table>
        
        

        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        
        <script type="text/javascript">

            $(document).ready( function () {
                $('#pacientes').DataTable();
            } );

        </script>  
    </body>
</html>