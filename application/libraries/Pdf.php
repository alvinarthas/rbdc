<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
        include_once APPPATH.'third_party/mpdf60/mpdf.php';

class pdf {
    
    public $param;
    public $pdf;
 
    public function __construct($param=NULL){        
        if ($params == NULL){
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';         
        }

        $this->pdf = new mPDF($param);
    }
 
}