<?php
namespace Amb\CreditBundle\Service;


use PHPExcel;
use PHPExcel_IOFactory;
/**
 *
 * @author i.slimane@amarus.ma
 */
class AmbExceldb
{
    public function get_FromAmbExcelDB($excelObj, $Sheet)
    {

    	$ambexceldb = $excelObj->load(__DIR__.'/../../amb_dbexcel.xls');
        $objWorksheet = $ambexceldb->getSheetByName($Sheet);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        
        for ($row = 1; $row <= $highestRow; ++$row) { 
            $result_list[$objWorksheet->getCellByColumnAndRow(1, $row)->getValue()] = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue(); 
        } 
        return $result_list;
    }
    public function getlibelle_FromAmbExcelDB($excelObj, $Sheet, $Row)
    {
        $ambexceldb = $excelObj->load(__DIR__.'/../../amb_dbexcel.xls');
        $objWorksheet = $ambexceldb->getSheetByName($Sheet);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $result = $objWorksheet->getCellByColumnAndRow(1, $Row)->getValue();
        return $result;   
    }

}