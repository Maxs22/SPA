<? php
incluir  "datosConexion.php" ;
  función  Conectar ( $ db )
  {
      prueba {
          $ conexion = new  PDO ( "mysql: host = {$ db ['servidor']}; dbname = {$ db ['db']}; conjunto de caracteres = utf8" , $ db [ 'usuario' ], $ db [ ' contraseña ' ]);          
          $ conexión -> setAttribute ( PDO :: ATTR_ERRMODE , PDO :: ERRMODE_EXCEPTION );
          return  $ conexion ;
      } captura ( PDOException  $ e ) {
          salir ( $ e -> getMessage ());
      }
  }