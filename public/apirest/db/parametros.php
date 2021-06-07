<? php
incluir  "conexion.php" ;
function  getParams ( $ input ) {  
    $ filterParams = [];
    foreach ( $ entrada  como  $ param => $ valor ) {
        $ filterParams [] = "$ param =: $ param" ;
    }
    return  implode ( "," , $ filterParams );
}
function  bindAllValues ( $ declaración , $ params ) {
    foreach ( $ params  as  $ param => $ value ) {
        $ declaración -> bindValue ( ':' . $ param , $ valor );
    }
    return  $ declaración ;
}