<?php
    

    function yukle($dosya , $boyutLimit = 1,$dosya_uzantilari = null)
    {   
        $sonuc = [];
        if ($dosya ['error'] == 4)
        {
            $sonuc['hata'] = "Lütfen dosyanızı seçin.";
        }
    
        else{
            print_r($dosya);
            if(is_uploaded_file($dosya ['tmp_name']))
            {
                $gecerli_dosya_uzantilari = $dosya_uzantilari ? $dosya_uzantilari : [
                   'image/jpeg',
                   'image/png',
                   'image/jpg',
                    'image/gif' 
                ]; 
    
                $gecerli_dosya_boyutu = (1024 * 1024) * $boyutLimit;
    
                $dosya_uzantisi = $dosya ['type'];
    
                if(in_array($dosya_uzantisi, $gecerli_dosya_uzantilari)){
    
                    if($gecerli_dosya_boyutu >= $dosya['size']){
    
                        $yukle = move_uploaded_file($dosya['tmp_name'],'upload/' . $dosya['name']);
    
                        if($yukle){
                            echo '<h3>Dosyanız başarıyla yüklendi</h3>';
                            echo '<img src="upload/' . $dosya['name'] .  '">';
                        }
                        else{
                            $sonuc['hata'] = 'bir sorun oluştu ve dosyanız yüklenemedi.';
                        }
    
                    }
                    else{
                        $sonuc['hata'] = "dosyanız maximum 3mb olabilir.";
                    }
    
                }
                else
                {
                    $sonuc['hata'] = 'dosya uygun formatta deil';
                }
                //mime types olarak geçiyor     
            }
            else{
                $sonuc['hata'] = 'dosya yüklenirken bir sorun oluştu';
            }
        }
        return $sonuc;
    }
    //$_FILES

    $sonuc = yukle($_FILES['dosya']);
    if (isset($sonuc['hata']))
    {
        echo $sonuc['hata'];
    }

    else {
        echo '<a href="' . $sonuc['dosya'] . '">Dosyayı görmek için tıklayın.</a>';
    }
   

 //   copy($_FILES['dosya'] ['tmp_name'], 'upload/' . $_FILES['dosya']['name']);
    
?>
    