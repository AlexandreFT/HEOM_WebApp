<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title>Dynamic Content from Azure SQL Database</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  
    </head>

    <body>

        Search:

        <table id="pacientes" data-order='[[ 1, "asc" ]]' data-page-length='25'>

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

                    $query = sqlsrv_query($conn, "SELECT * FROM [heom].[pacientes]");

                    while ($result = sqlsrv_fetch_array($query)) {
                        echo "
                            <tr>
                                <td>".$result['Column_1']."</td>
                                <td>".$result['paciente_id']."</td>
                                <td>".$result['registro_hosp']."</td>
                                <td>".$result['prim_nome']."</td>
                                <td>".$result['ult_nome']."</td>
                                <td>".$result['nome_completo']."</td>
                                <td>".$result['sexo']."</td>
                                <td>".$result['data_nascim']."</td>
                                <td>".$result['fumante_status']."</td>
                                <td>".$result['telefone']."</td>
                            </tr>
                        ";
                    }

                ?>


            </tr>
        </tbody>

    </table>
        
        

        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        
        <script type="text/javascript">

            $(document).ready( function () {
                $('#pacientes').DataTable( {
                    paging: false,
                    scrollY: 400,
                    searching: true
                });
            } );

        </script>  
    </body>
</html>