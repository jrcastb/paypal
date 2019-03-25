<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/5.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
  </head>
  <body>
      <div class="formulario">
            <h2>Pagos con Paypal</h2>
            <?php //$resultado = ($_GET['exito']);
            $resultado = ($_GET['exito'] === 'true') ? true : false ;
            
            if (isset($_GET['paymentId'])) {
                $paymentId = $_GET['paymentId'];
            }
            
            if ($resultado == true) {
                echo "<h3>El pago se ha realizado correctamente</h3>";
                echo "el ID es " . $paymentId;
            }else if ($resultado == false){
                echo "Pago cancelado";
            }
            
            ?>
        </div>
  </body>
  