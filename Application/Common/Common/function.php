<?php 
header("Content-type:text/html;charset=utf-8");

function urlrequest($curl,$https=true,$method='GET',$data=null){
    //1.创建一个新cURL资源
    $ch = curl_init();
    
    //2.设置URL和相应的选项
    //要访问的网站
    curl_setopt($ch, CURLOPT_URL, $curl);
    //启用时会将头文件的信息作为数据流输出。
    curl_setopt($ch, CURLOPT_HEADER, false);
    //将curl_exec()获取的信息以字符串返回，而不是直接输出。
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    if($https){
        //FALSE 禁止 cURL 验证对等证书（peer's certificate）。
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  //验证主机
    }
    if($method == 'POST'){
        //发送 POST 请求
        curl_setopt($ch, CURLOPT_POST, true);
        //全部数据使用HTTP协议中的 "POST" 操作来发送。
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    
    //3.抓取URL并把它传递给浏览器
    $content = curl_exec($ch);
    if ($content  === false) {
        return "网络请求出错: " . curl_error($ch);
        exit();
    }
    
   // $content['info'] = curl_getinfo($ch);
   
    
    //4.关闭cURL资源，并且释放系统资源
    curl_close($ch);
    
    return $content;
}  

function xx(){
    echo 'xx';
}
?>