<?php
error_reporting(0);
ini_set('display_errors', 0);
include('./simple_html_dom.php');
//include_path('C:\xampp\php\PEAR');
?>

<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

<div>
<img style="height: 100px; margin-left: 45%;"src="./logo.jpg"/>
<h1 style="text-align:center;width:100%">Interface Image Downloader</h1>
<h3 style="text-align:center;width:100%;color:gray">Download All assets from any url</h3>
<form name="urlform"method="post" action=""> 
    
                      
                       <input  type="text" width="600px" name="url" required/> <br>
                       <input type="radio"  name="target" value="page">
  <label for="female">Download Assets from only given url</label>&nbsp;&nbsp;
                       <input type="radio"  name="target" value="website">
  <label for="male">Download Assets from entire Website</label><br>
  
 
       
         
                        <input type="submit" name="submit" value="Submit" />
       
</form>
</div>
<?php
function fetch($url){
    $html=file_get_html($url);
    $a = $html->find("a");
    $check = "http";
    $urllist= array($url);
    foreach($a as $anc){

        if(strpos($anc, $url) !== false){
              // echo $anc->href.'<br>';
               array_push($urllist, $anc->href);
        }

        if(strpos($anc, $check) == false){

            if(substr($anc->href, 0,1) == "/" || substr( $url,-1) == "/")
            {
                if(substr($anc->href, 0,1) == "/" && substr( $url,-1) == "/"){
                    
                                $urlnew=  substr($url, 0, -1);
                                // echo $urlnew.$anc->href.'<br>';
                                 array_push($urllist, $urlnew.$anc->href);

                }
                else{
                    //echo $url.$anc->href.'<br>';
                    array_push($urllist, $url.$anc->href);

                }

                
            }

            if(substr($anc->href, 0,1) != "/" && substr( $url,-1) != "/")
            {
              //  echo $url.'/'.$anc->href.'<br>';
                array_push($urllist, $url.'/'.$anc->href);
                     
            }
           
            

            
        }



      

     }
     echo "<b>Pages list Scanned ✔ </b><br>";
     echo "<b>Downloading assets from pages..... </b><br>";
     

     

     foreach(array_unique($urllist) as $page){
         echo $page.'<br>';
     }

    return array_unique($urllist);

}




function getWebsiteAssets($url){

    //$urllist = fetch($url);
    
    // print_r($urllist);
    // echo "<b>Pages list Scanned ✔ <b><br>";
   
    // foreach($pages as $page){
        $page =$url;
        $html=file_get_html($page);
        $image = $html->find("img");
        echo "<h1>Downloaded Images from".$page."</h1>";
        foreach($image as $img) {
                    //Get attribute of images
                    
                    $souceImg=$img->src;
                    $imgName = 'Downloads/'.basename($souceImg);
            
            
                if(strpos($souceImg, 'http') !== false){
                file_put_contents($imgName, file_get_contents($souceImg));
                echo '<img src="'.$imgName.'" height="100px" />';
            }
            else{
                file_put_contents($imgName, file_get_contents($page.$souceImg));
                echo '<img src="'.$imgName.'" height="100px" />';
            }
            
           
            
                  }

                

    // }
    echo "<h1>For more check in Downloads folder</h1>";
}


if(isset($_POST["submit"])){

   

   if( $_POST["target"] == 'website'){
    $urllist= fetch($_POST["url"]);
    foreach($urllist as $url){
        getWebsiteAssets($url);
    }
   }
   else{
    getWebsiteAssets($_POST["url"]);
   }
}
    ?>