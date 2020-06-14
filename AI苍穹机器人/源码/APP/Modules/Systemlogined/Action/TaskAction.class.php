<?php
class TaskAction extends CommonAction {

    public function index(){

        $this->display();
    }

    //删除会员
    public function deletetask(){
        $complete = M('complete');
        if ($complete->where(array('id'=>$_GET['id'],'status'=>0))->delete()) {
            alert('删除成功！',U(GROUP_NAME.'/Task/complete'));
        }else{
            alert('删除失败！',U(GROUP_NAME.'/Task/complete'));
        }
    }



    Public function upload(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 1000000 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->saveRule = uniqid;//这里的时间是根据上传的图片的多少来自动改变图片的名称的（并且时间都不同，所以上传的图片的名称就不会相同）
        $upload->savePath =  './Public/Uploads/';// 设置附件上传目录
        if(!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }else{// 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
        }
        $User = M("task"); // 实例化User对象

        $User->create(); // 创建数据对象
        $User->image = '/Public/Uploads/renwu/'.$info[0]["savename"]; // 这里的$info[0]["savename"]的下标[0]表示上传的第1个图片按顺序，记住是下标
        $User->image1 = '/Public/Uploads/renwu/'.$info[1]["savename"];
        $User->image2= '/Public/Uploads/renwu/'.$info[2]["savename"];

        $User->add(); // 写入用户数据到数据库

        $this->success("数据保存成功！");

    }

    public function complete(){
        $complete = M('complete'); // 实例化Data数据对象
        import("@.ORG.Util.Page");// 导入分页类
        $type=$_POST['type'];
        $typename=$_POST['typename'];
        if (!empty($type) && !empty($typename)) {
            if($type ==1){
                $map['username']=	$typename;
            }elseif($type ==2){
                $map['truename']=$typename;
            }
        }
        $map['status']=0;
        $count      = $complete->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,25);// 实例化分页类 传入总记录数

        $list = $complete->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->display(); // 输出模板
    }
    public function yescomplete(){
        $complete = M('complete'); // 实例化Data数据对象
        import("@.ORG.Util.Page");// 导入分页类
        $type=$_POST['type'];
        $typename=$_POST['typename'];
        if (!empty($type) && !empty($typename)) {
            if($type ==1){
                $map['username']=	$typename;
            }elseif($type ==2){
                $map['truename']=$typename;
            }
        }
        $map['status']=1;
        $count      = $complete->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,25);// 实例化分页类 传入总记录数

        $list = $complete->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->display(); // 输出模板
    }
    public function notcomplete(){
        $complete = M('complete'); // 实例化Data数据对象
        import("@.ORG.Util.Page");// 导入分页类
        $type=$_POST['type'];
        $typename=$_POST['typename'];
        if (!empty($type) && !empty($typename)) {
            if($type ==1){
                $map['username']=	$typename;
            }elseif($type ==2){
                $map['truename']=$typename;
            }
        }
        $map['status']=2;
        $count      = $complete->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,25);// 实例化分页类 传入总记录数

        $list = $complete->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->display(); // 输出模板
    }


    //已完成审核任务
    public function completeuser(){

        $d_id=I('id',0,'intval');
        if(empty($d_id)){
            $this->error('没有了！',U(GROUP_NAME.'/Task/complete'));
            exit;
        }

        $complete = M('complete')->where(array('id'=>I('id'),'status'=>0))->find();
        if(empty($complete)){
            $this->error('非法操作！');
            exit;
        }
        if($complete['status']==2){
            $this->error('已经审核！',U(GROUP_NAME.'/Task/complete'));
            exit;
        }

        //下一个会员

        $next_id=M('complete')->where("id > {$d_id} and status = 0")->order('id asc')->getField('id');

        $this->assign('next_id',$next_id);
        $this->assign('complete',$complete);
        $this->display();
    }
    //任务完成审核执行
    public function completeuserHandle(){
        $id = $_POST['id'];
		$data['jinbi'] = $_POST['jinbi'];

        $data['status']= $_POST['status'];


        if (M('complete')->where(array('id'=>$id))->save($data)) {
            if($data['status'] == 1){
                $username = M('complete')->where(array('id'=>I('id')))->getField('username');
                M('member')->where(array('username'=>$username))->setInc('jifen',$data['jinbi']);
				account_log($username,$data['jinbi'],'完成任务奖'.$data['jinbi'].'元',1);
            }
            $next_id=M('complete')->where("status = 0 and truename!=''")->order('id asc')->getField('id');
            $this->success('审核成功！',U(GROUP_NAME.'/Task/completeuser',array('id'=>$next_id)));
        }else{
            $this->error('数据没有更改！',U(GROUP_NAME.'/Task/complete'));
        }
    }
//批量审核
    public function plsh(){
        foreach($_POST['userids'] as $k => $v){
            $username = M('complete')->where(array('id' => $v,'zt'=>0))->find();
            if(!empty($username)){
                $jinbi = C('jinbi');
                $dara = array();
                $dara['status'] = 1;
                M('complete')->where(array('username' => $username['username']))->save($dara);
                M('member')->where(array('username'=>$username['username']))->setInc('jifen',$jinbi);
                account_log($username,$jinbi,'完成任务奖'.$jinbi.'元',1);
            }
        }
        $this->success('批量审核成功!');
    }

}
