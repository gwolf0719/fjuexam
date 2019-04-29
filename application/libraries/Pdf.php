<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdf {
    function view_to_pdf($view,$file,$debug=false){
        if($debug == true){
            echo $view;
        }else{
            if (!is_dir('./html/')) {
                mkdir('./html/');
            } else {
                $path = $file.'.html';
                $fp = fopen('./html/' . $path, 'w');//建檔
                fwrite($fp, $view);
                fclose($fp);//關閉開啟的檔案
            }

            if (!is_dir('./pdf/')) {
                mkdir('./pdf/');
            } else {
                exec('wkhtmltopdf --lowquality  --enable-forms '.base_url().'/html/'.$file.'.html  ./pdf/'.$file.'.pdf');
            }
            echo '<script>location.href="'.base_url().'/pdf/'.$file.'.pdf"</script>';
        }
        
    }
}
?>