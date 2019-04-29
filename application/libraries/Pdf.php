<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdf {
    /**
     * view 頁面 檔案直接轉成  pdf 檔案
     * @view 頁面資料
     * @file 存檔檔名
     * @debug 模式 預設 false 會直接出 pdf檔 ,如果是 true 就會印 html
     */
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