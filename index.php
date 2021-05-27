<?php
include('./simple_html_dom.php');
//include_path('C:\xampp\php\PEAR');
?>
<form name="urlform"method="post" action=""> 
    
                      
                       <input  type="text" name="url"/> 
       
         
                        <input type="submit" name="submit" id="button" value="Submit" />
       
</form>

<?php
function fetch($url){
    $html=file_get_html($url);
    $a = $html->find("a");
    $check = "http";
    $urllist= array($url);
    foreach($a as $anc){

        if(strpos($anc, $url) !== false){
               echo $anc->href.'<br>';
               array_push($urllist, $anc->href);
        }

        if(strpos($anc, $check) == false){

            if(substr($anc->href, 0,1) == "/" || substr( $url,-1) == "/")
            {
                if(substr($anc->href, 0,1) == "/" && substr( $url,-1) == "/"){
                    
                                $urlnew=  substr($url, 0, -1);
                                 echo $urlnew.$anc->href.'<br>';
                                 array_push($urllist, $urlnew.$anc->href);

                }
                else{
                    echo $url.$anc->href.'<br>';
                    array_push($urllist, $url.$anc->href);

                }

                
            }

            if(substr($anc->href, 0,1) != "/" && substr( $url,-1) != "/")
            {
                echo $url.'/'.$anc->href.'<br>';
                array_push($urllist, $url.'/'.$anc->href);
                     
            }
           
            

            
        }



      

     }

    return array_unique($urllist);

}
function getWebsiteAssets($url){

    $urllist = fetch($url);
     print_r($urllist);

     foreach($urllist as $page){
        $html=file_get_html($page);
        $image = $html->find("img");
        foreach($image as $img) {
                    //Get attribute of images
                    
                    $souceImg=$img->src;
            $imgName = 'Downloads/'.basename($souceImg);
            
            
            if(strpos($souceImg, $page) !== false){
                file_put_contents($imgName, file_get_contents($souceImg));
                echo '<img src="'.$imgName.'" height="100px" />';
            }
            else{
                file_put_contents($imgName, file_get_contents($page.$souceImg));
                echo '<img src="'.$imgName.'" height="100px" />';
            }
            
           
            
                  }

     }
}


if(isset($_POST["submit"])){

   getWebsiteAssets($_POST["url"]);

     



    }
    ?>