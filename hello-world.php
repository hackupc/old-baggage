<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
$connector = new NetworkPrintConnector("192.168.1.100", 9100);
$printer = new Printer($connector);
try {
	$connector = new FilePrintConnector("/dev/ttyS0");
	$printer = new Printer($connector);
	$printer -> text("Hello World!\n");
	$printer -> cut();
} finally {
    $printer -> close();
}