<?php
/* Call this file 'hello-world.php' */
require 'C:\Users\Oriol Closa\github\baggage\vendor\autoload.php';
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
$connector = new WindowsPrintConnector("POS-58");
      $printer = new Printer($connector);
      $printer -> text("Prova!\n\n\n");
      $printer -> cut();
      $printer -> close();