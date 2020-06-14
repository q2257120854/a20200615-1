<?php
//echo '贪玩点卡智能建站·全开源卡盟系统 免费下载：www.kycard.cn  2018年9月14日 Se7en QQ:94170844';
?>
<?php
if(is_uploaded_file($_FILES['upfile']['tmp_name'])){ 
$upfile=$_FILES["upfile"]; 
//-------------------------------------------------获取数组里面的值 
$name=$upfile["name"];//上传文件的文件名 
$extension=".".get_extension($name);//获取上传文件扩展名
$extension=$dingdanhao.$extension; //生成新的文件夹名称
$uploadnames="/upload/".$extension;
$uploadname=str_replace('\site','',$_SERVER['DOCUMENT_ROOT'])."/upload/".$extension;
$type=$upfile["type"];//上传文件的类型 
$size=$upfile["size"];//上传文件的大小 
$tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径 
//判断是否为图片 
switch ($type){ 
case 'image/pjpeg':$okType=true; 
break; 
case 'image/jpeg':$okType=true; 
break; 
case 'image/gif':$okType=true; 
break; 
case 'image/png':$okType=true; 
break; 
} 

if($okType){ 
/** 
* 0:文件上传成功<br/> 
* 1：超过了文件大小，在php.ini文件中设置<br/> 
* 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/> 
* 3：文件只有部分被上传<br/> 
* 4：没有文件被上传<br/> 
* 5：上传文件大小为0 
*/ 
$error=$upfile["error"];//上传后系统返回的值 
//$extension 上传文件名称
//$type      上传文件类型
//$size      上传文件大小
//$error     上传后系统返回的值
//$tmp_name  上传文件的临时存放路径
//把上传的临时文件移动到up目录下面
move_uploaded_file($tmp_name,$uploadname); 
$upload_results=checkfile($uploadname);//安全检测文件是否正常
if ($upload_results<>""){
echo "<script language=\"javascript\">alert('操作失败，上传文件异常！');history.go(-1);</script>";
exit();
}elseif($error==0){ 

}elseif ($error==1){ 
echo "<script language=\"javascript\">alert('操作失败，超过了文件大小！');history.go(-1);</script>";
exit();
}elseif ($error==2){ 
echo "<script language=\"javascript\">alert('操作失败，超过了文件大小！');history.go(-1);</script>";
exit();
}elseif ($error==3){ 
echo "<script language=\"javascript\">alert('操作失败，文件只有部分被上传！');history.go(-1);</script>";
exit();
}elseif ($error==4){ 
echo "<script language=\"javascript\">alert('操作失败，上传没有文件！');history.go(-1);</script>";
exit();
}else{
echo "<script language=\"javascript\">alert('操作失败，上传文件大小为0！');history.go(-1);</script>";
exit();
} 
}else{ 
echo "<script language=\"javascript\">alert('操作失败，请上传jpg,gif,png等格式的图片！');history.go(-1);</script>";
exit();
} 
} 

?>