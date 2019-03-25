<?php 

if (!isset($_POST['producto'], $_POST['precio'])) {
    exit("Hubo un error");
}
use PayPal\Api\Payer; //nameSpace para importar la clase payer
use PayPal\Api\Item;//nameSpace para importar la clase Item
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'config.php';

$producto = htmlspecialchars($_POST['producto']);
$precio = (int) htmlspecialchars($_POST['precio']);
$envio = 0;
$total = $precio + $envio;

//para realizar un pago el primer paso es crear el payer
$compra = new Payer();
//agregar atributos a la compra
$compra->setPaymentMethod('paypal');//primer argumento es el metodo de pago

$articulo = new Item();
$articulo->setName($producto)
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setPrice($precio);

$listaArticulos = new ItemList();
$listaArticulos->setItems(array($articulo)); //si existieran mas articulos solo hay que agregar una coma y la variable del siguiente articulo ya que es un array
$detalles = new Details();
$detalles->setShipping($envio)
        ->setSubtotal($precio);

$cantidad = new Amount();
$cantidad->setCurrency('USD')
        ->setTotal($total)
        ->setDetails($detalles);

$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($listaArticulos)
            ->setDescription('Pago ')
            ->setInvoiceNumber(uniqid());

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?exito=true")
            ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?exito=false");


$pago = new Payment();
$pago->setIntent("sale")//porque se realiza una venta
    ->setPayer($compra)
    ->setRedirectUrls($redireccionar)
    ->setTransactions(array($transaccion));

try {
    $pago->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $pce) {
     echo "<pre>";
        print_r(json_decode($pce->getData()));
        exit;
     echo "</pre>";
}
//pago correcto
$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");
/* if($_GET['exito'] == true){
    echo "el pago fue correcto";
} */