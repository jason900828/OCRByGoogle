<?php

header("Content-Type:text/html; charset=utf-8");

require_once(dirname(__FILE__) . "/config.php");

function getFiles() {
    $i = 0;  // 遞增 array 數量
    
    foreach ($_FILES as $file) {
    	
        // string 型態，表示上傳單一檔案
        if (is_string($file['name'])) {
            $files[$i] = $file;
            $i++;
        }
        // array 型態，表示上傳多個檔案
        elseif (is_array($file['name'])) {
            foreach ($file['name'] as $key => $value) {
                $files[$i]['name'] = strtolower($file['name'][$key]);
                $files[$i]['type'] = $file['type'][$key];
                $files[$i]['tmp_name'] = $file['tmp_name'][$key];
                $files[$i]['error'] = $file['error'][$key];
                $files[$i]['size'] = $file['size'][$key];
                $i++;
            }
        }
    }
 
    return $files;
}

function uploadfile($file_info,$uploaddir,$allowExt = array('jpeg', 'jpg', 'gif', 'png','pdf','bmp')){
  $ext = pathinfo($file_info['name'], PATHINFO_EXTENSION);
  if (!file_exists($uploaddir)){
    mkdir($uploaddir);
  }
  if ($file_info['error'] === UPLOAD_ERR_OK){

    # 檢查檔案是否已經存在
    if (!in_array(strtolower($ext), $allowExt)){
        echo '錯誤：上傳錯誤檔案格式';
        return 'error';
    }
    if (file_exists($uploaddir. $file_info['name'])){
      echo '檔案已覆蓋。<br/>';
      unlink($uploaddir.$file_info['name']);
    } 
    $file = $file_info['tmp_name'];
    $dest = $uploaddir . $file_info['name'];
    # 將檔案移至指定位置
    move_uploaded_file($file, $dest);
    return 'success';
  } else {
    echo '錯誤代碼：' . $file_info['error'];
    return 'error';
  }
}
if (!file_exists('./image_here/')){
    mkdir('./image_here/');
  }
$timenamefolder=date("YmdHis").rand(0,100);
// 重新建構上傳檔案 array 格式
$files = getFiles();


foreach ($files as $filesInfo) {
	
    $res = uploadfile($filesInfo,'./image_here/'.$timenamefolder.'/');
    
    if ($res=='error'){
        break;
    }

}
$data = "{
    \"path\":\"$timenamefolder\"
}";
file_put_contents( 'path_number.json' , $data);

echo shell_exec('python OCR.py');

echo "<br/><br/><button class =\"btn btn-primary\"type=\"button\" onclick=\"location.href='download_zip.php?timenamefolder=".$timenamefolder."'\"> 下載結果</button>".'<br />';
?>