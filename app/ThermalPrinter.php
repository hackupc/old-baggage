<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;

class ThermalPrinter extends Model
{
    public static function printTicket($reg_row, $reg_col, $reg_id, $reg_name, $reg_surname, $reg_time){
      $connector = new WindowsPrintConnector("POS-58");
      $printer = new Printer($connector);
      $printer -> setJustification(Printer::JUSTIFY_CENTER);
      $logo = EscposImage::load(public_path()."/assets/ticket/logo2.png");
      $printer -> bitImage($logo);
      $printer -> feed(2);
      $logo = EscposImage::load(public_path()."/assets/ticket/logo3.png");
      $printer -> bitImage($logo);
      $printer -> feed(2);
      $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT|Printer::MODE_DOUBLE_WIDTH);
      $printer -> text("Location: ".$reg_row.$reg_col);
      $printer -> feed(2);
      $printer -> selectPrintMode(Printer::MODE_FONT_A|Printer::MODE_EMPHASIZED);
      $printer -> text("ID/Passport: ".$reg_id);
      $printer -> feed(1);
      $printer -> text("Name: ".$reg_name." ".$reg_surname);
      $printer -> feed(2);
      $printer -> selectPrintMode(Printer::MODE_FONT_A);
      $printer -> text("Time: ".date("d/m/Y H:i:s", $reg_time));
      $printer -> feed(2);
      if($reg_row=="@"){
        $logo = EscposImage::load(public_path()."/assets/ticket/warning.png");
        $printer -> bitImage($logo);
        $printer -> feed(2);
      }
      $logo = EscposImage::load(public_path()."/assets/ticket/footer.png");
      $printer -> bitImage($logo);
      $printer -> feed(5);
      $printer -> cut();
      $printer -> close();
      return "A";
    }

}
