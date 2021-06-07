<? php
incluir  "db/parametros.php";
 permisos de función () {  
  if ( isset ( $ _SERVER [ 'HTTP_ORIGIN' ])) {
      encabezado ( "Acceso-Control-Permitir-Origen: *" );
      header ( "Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS" );
      header ( "Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept" );
      encabezado ( 'Access-Control-Allow-Credentials: true' );      
  }  
  if ( $ _SERVER [ 'REQUEST_METHOD' ] == 'OPTIONS' ) {
    if ( isset ( $ _SERVER [ 'HTTP_ACCESS_CONTROL_REQUEST_METHOD' ]))          
        header ( "Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS" );
    if ( isset ( $ _SERVER [ 'HTTP_ACCESS_CONTROL_REQUEST_HEADERS' ]))
        header ( "Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept" );
    salir ( 0 );
  }
}
permisos ();
$ conexión =   Conectar ( $ db );
if ( $ _SERVER [ 'REQUEST_METHOD' ] == 'OBTENER' ) {
    if ( isset ( $ _GET [ 'id' ])) {      
      $ sql = $ conexion -> prepare ( "SELECT * FROM articulos where id =: id" );
      $ sql -> bindValue ( ': id' , $ _GET [ 'id' ]);
      $ sql -> ejecutar ();
      encabezado ( "HTTP / 1.1 200 OK" );
      echo  json_encode ( $ sql -> buscar ( PDO :: FETCH_ASSOC ));
      salir ();
    }
    else {      
      $ sql = $ conexión -> preparar ( "SELECCIONAR * DE articulos" );
      $ sql -> ejecutar ();
      $ sql -> setFetchMode ( PDO :: FETCH_ASSOC );
      encabezado ( "HTTP / 1.1 200 OK" );
      echo  json_encode ( $ sql -> fetchAll ());
      salir ();
    }
}
if ( $ _SERVER [ 'REQUEST_METHOD' ] == 'POST' ) {
    $ entrada = $ _POST ;		
    $ sql = "INSERT INTO articulos (descripcion, precio, stock) VALUES (: descripcion,: precio,: stock)" ;		  
    $ resultado = $ conexión -> preparar ( $ sql );
    bindAllValues ( $ resultado , $ entrada );
    $ resultado -> ejecutar ();
    $ id = $ conexión -> lastInsertId ();
    if ( $ id ) {
      $ entrada [ 'id' ] = $ id ;
      encabezado ( "HTTP / 1.1 200 OK" );
      echo  json_encode ( $ entrada );
      salir ();
    }
}
if ( $ _SERVER [ 'REQUEST_METHOD' ] == 'PUT' ) {
    $ entrada = $ _GET ;	
    $ id = $ input [ 'id' ];
    $ campos = getParams ( $ entrada );
    $ sql = "ACTUALIZAR articulos SET $ campos DONDE id = '$ id'" ;
    $ resultado = $ conexión -> preparar ( $ sql );
    bindAllValues ( $ resultado , $ entrada );
    $ resultado -> ejecutar ();
    encabezado ( "HTTP / 1.1 200 OK" );
    salir ();
}
if ( $ _SERVER [ 'REQUEST_METHOD' ] == 'BORRAR' ) {
  $ id = $ _GET [ 'id' ];
  $ resultado = $ conexion -> prepare ( "BORRAR DE articulos donde id =: id" );
  $ resultado -> bindValue ( ': id' , $ id );
  $ resultado -> ejecutar ();
  encabezado ( "HTTP / 1.1 200 OK" );
  salir ();
}
encabezado ( "HTTP / 1.1 400 Peticion HTTP inexistente" );
?>