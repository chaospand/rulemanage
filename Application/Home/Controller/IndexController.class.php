<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
	private static 	$APPID= 'wxadc0ce7cac4d8ab0';
	private static 	$appsecret='725fc40d8ce334aa40e25bfa024bfcf3';
	
    public function index()
    {
		if(IS_POST){
			$data = I('POST.');
			$code = $_POST['code'];
			//var_dump($code);
			$id='';
			$verify = new \Think\Verify;
			if(!$verify->check($code, $id)){
				$this->error('验证码错误');
			}
			unset($data['code']);
			$data['password'] = md5($data['password']);
			$user = M('User')->where($data)->find();
			if(empty($user)){
				$this->error('账号密码错误');
			}else{
                $_SESSION['user']=array(
                    'id'=>$user['id'],
                    'username'=>$user['name'],
                );
                $this->success('登录成功、前往管理后台',U('Admin/Index/index'));
            }
	
		}else{
		    $this->display();
		}
    }
	
    public function frontLogin(){
        if(IS_POST){
            $data = I('POST.');
            $code = $_POST['code'];
            //var_dump($code);
            $id='';
            $verify = new \Think\Verify;
            if(!$verify->check($code, $id)){
                $this->error('验证码错误');
            }
           // dump($data);
            unset($data['code']);
            $user = M('FrontUser')->where($data)->find();
            if(empty($user)){
                $this->error('账号密码错误');
            }else{
                $_SESSION['frontUser']=array(
                    'id'=>$user['id'],
                    'username'=>$user['name'],
                );
                $this->success('登录成功、前往计算前台',U('admin/front/calculateReturn'));
            }
            
        }else{
            $this->display();
        }
    }
    
    public function frontLogout(){
        session(null);
        $this->success('退出成功',U('Home/Index/frontLogin'));
    }
    
    public function wxwebback(){
        
    }
    
    public function wxweblogin(){
        $REDIRECT_URI="http://chaospanda.ngrok.cc/ruleManage/home/index/wxwebback";
        
        $url = "https://open.weixin.qq.com/connect/qrconnect?"
            ."appid=".C('WXAPPID')
            ."&redirect_uri=".urlencode($REDIRECT_URI)
            ."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            redirect($url);
            
    }
    
    //微信公众号登陆
	public function wxlogin(){
		
		$REDIRECT_URI="http://chaospanda.ngrok.cc/ruleManage/home/index/wxback";
		
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?"
		."appid=".C('WXAPPID')
		."&redirect_uri=".urlencode($REDIRECT_URI)
		."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
		redirect($url);
		
	}

	public function userlist(){
	    $User = M('User'); // 实例化User对象
	    $count = $User->count();// 查询满足要求的总记录数
	    $Page = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	    
	    //$Page->lastSuffix=false;
	    $page->rollPage=4;
	    //$page->listRows=2;
	   // $page->$rollPage=2;
	    $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>%LIST_ROW%</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	    $Page->setConfig('prev','上一页');
	    $Page->setConfig('next','下一页');
	    $Page->setConfig('last','末页');
	    $Page->setConfig('first','首页');
	    $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	    $show   = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	    $list = $User->limit($Page->firstRow.','.$Page->listRows)->select();
	    $this->assign('list',$list);// 赋值数据集
	    $this->assign('page',$show);// 赋值分页输出
	    $this->display(); // 输出模板
	}
	
	public function bindOpenid(){
	    $data = array(
	        'name' => $_POST['username'],
	        'password'=> md5($_POST['password']),
	    );
	    $user = M('User')->where($data)->find();
	    if(empty($user)){
	        $this->error('账号密码错误');
	    }else{
	       $openid = $user['openid'];
	       if(!empty($openid)){
	           $this->error('该账号已绑定微信号,请更换账号');
	       }else{
	           if(!empty(session('userInfo'))){
	               dump(session('userInfo'));
	               $userInfo = session('userInfo');
	               $openid = $userInfo['openid'];
	               D('User')->updUser($openid,$user['id']);
	           }else{
	               $this->error('微信登录信息不存在');
	           }
	       }
	    }
	    $this->display('personInfo');
	}
	
	
	public function wxback(){
	    $code=I('get.code');
	    if(empty($code)){
	        $this->error('code 不存在。');
	    } 
	    if(empty(session('code'))){
	        echo 'set session';
	        session('code', $code);
	    }else{
	        $appsecret='725fc40d8ce334aa40e25bfa024bfcf3';
	        $url='https://api.weixin.qq.com/sns/oauth2/access_token?'
	            .'appid='.C('WXAPPID')
	            .'&secret='.C('WXSECRET')
	            .'&code='.$code
	            .'&grant_type=authorization_code';
	            //echo ($url);
	            $content = urlrequest($url);
	            $result = json_decode($content);
	          //  dump($content);
	           // dump($result);
	            session('code',null);
	            //4.通过access_token和openid拉取用户信息
	            $webAccess_token = $result->access_token;
	            $openid = $result->openid;
	            
	            $userInfourl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$webAccess_token.'&openid='.$openid.'&lang=zh_CN ';
	            
	            $recontent = urlrequest($userInfourl);
	            $userInfo = json_decode($recontent,true);
	            
	            session('userInfo',$userInfo);
	           // dump($userInfo);
	            $user = D('User')->where('openid=\'%s\'',array($userInfo['openid']))->find();
	            //if user not exist,turn to bind account page,else personpage 
	            
	          if(empty($user)){
	               $this->display('bindAcount');
	           }else{
	                $this->display('personInfo');
	           }  
	    }
	 	
	    
	    
      
        
      
      
	}
	
 	public function getTest(){
 	    
 	    $ci = curl_init();
 	    /* Curl settings */
 	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);//让cURL自己判断使用哪个版本  
 	    
 	    
	    $url='http://localhost/ruleManage/home/index/jsonTest';
	    $ch = curl_init();
	    
	    curl_setopt($ch,CURLOPT_URL,$url);
	    
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    // 抓取URL并把它传递给浏览器
	    $output = curl_exec($ch);
	    $info = curl_getinfo($ch);
	    dump($output);
	    echo '</br>';
	   dump($info);
	    //关闭cURL资源，并且释放系统资源
	    curl_close($ch);
	    
	} 
	
	public function jsonTest(){
	   /*  $data =array(
	        'id' => '1314',
	        'name' => 'chaos'
	    ); */
	    
	   /*  $data['id'] = '1314';
	    $data['name'] = 'chaos';
	    $str=json_encode($data);
	    echo  json_encode($str); */
	    
	    $rst->code = 200;
	    $rst->errormessage = "chaospanda";
	    $rst->data = array( 'name' => 'nothing');
	    echo json_encode($rst);
	}
	
	
	
	public function verify(){
		$Verify =     new \Think\Verify();
		$Verify->fontSize = 30;
		$Verify->length   = 3;
		$Verify->useNoise = false;
		$Verify->entry();
	}
	
	public function logout(){
	    session(null);
	    $this->success('退出成功',U('Home/Index/index'));
	}
	
	public function getResult(){
	    $myfile =  fopen("newfile.txt", "w") or die("Unable to open file!");
	    foreach($_POST as $k => $v){
	        $content .= $k. "=>" . $v . "|";
	    }  
	    $data['name'] = 'xxxx';
	    $result = D('User')->addData($data);
	    echo $result;
	    fwrite($myfile, $content);
	    fclose($myfile);
	    echo 'xx';
	}
	
	public function getSuppliesBybid(){
	    $bid=I('get.bid');
	   /*  $map = array(
	        'bid' =>$bid,
	    ); */
	    $map['id'] = array('in',1);
	    $business = D('Business')->find($bid);
	    $sids = $business['sids'];
	    if(trim($sids)!=""){
	        $map['id'] = array('in',$sids);
	        $supplie = D('Supplie')->where($map)->select();
	        $this->ajaxReturn($supplie);
	    }else{
	        $this->ajaxReturn($supplie);
	    }
	    
	   
	    
	}
	
	public function calculateReturn(){
	    if(IS_POST){
	        $data=I('post.');
	        //var_dump($data);
	        
	        foreach ($data as $k => $v) {
	            $data[$k]=trim($v);
	        }
	        $itemreturn =  D('Itemreturn');
	        $result = $itemreturn->create($data);
	        if($result){
	            
	            $bid = $data['bid'];
	            $sid = $data['sid'];
	            $returncash = 0;
	            $comsume = $data['comsume'];
	            $business = D('Business')->find($bid);
	            $supplie = D('Supplie')->find($sid);
	            //dump($profit);
	            if(!empty($supplie)){
	                $sprice = $supplie['price'];
	                $profit = $comsume - $sprice;
	               
	                if($profit<0){
	                    $message = '低于成本价,不进行计算' ;
	                    $actionResult = new  \Common\Normal\ActionResult(false, $message);
	                    $this->ajaxReturn($actionResult);
	                }
	                if(!empty($business)){
	                    $percent = $business['percent'];
	                    $percent = $percent/100;
	                    $returncash = ($profit*$percent);
	                }
	                
	            }
	            
	            $addResult = $itemreturn->addData($data);
	            
	            $actionResult = new  \Common\Normal\ActionResult(true, $returncash);
	            $this->ajaxReturn($actionResult);
	            /* if($addResult){
	                $this->success("成功",U('home/index/calculateReturn'));
	            }else{
	                $this->error('添加失败');
	            } */
	        }else{
	            $error = $itemreturn->getError();
	            $this->error($error);
	        }
	        
	    }else{
	        $supplie = D('Supplie')->select();
	        $business = D('Business')->select();
	        $assign = array(
	            'supplie' => $supplie,
	            'business' => $business,
	        );
	        $this->assign($assign);
	        $this->display();
	    }
	}
	
	
}