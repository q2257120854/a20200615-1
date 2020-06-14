<?php  
	/**
	 * 系统设置控制器
	 */
	Class SystemAction extends CommonAction{

		/**
		 * 系统日志视图
		 * @return [type] [description]
		 */
		public function systemLog(){
			$Data = M('log'); // 实例化Data数据对象
	        import('ORG.Util.Page');// 导入分页类
	        $map = array();
	        if (isset($_GET['account']) && $_GET['account']!='') {
	        	$map['logaccount'] = $_GET['account']; 
	        }

	        $count      = $Data->where($map)->count();// 查询满足要求的总记录数
	        $Page       = new Page($count,10);// 实例化分页类 传入总记录数
	        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
	        $nowPage = isset($_GET['p'])?$_GET['p']:1;
	        $list = $Data->where($map)->order('logtime desc')->page($nowPage.','.$Page->listRows)->select();
	        $show       = $Page->show();// 分页显示输出
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('list',$list);// 赋值数据集
	        $this->display(); // 输出模板
		}

		//系统配置视图
		public function customSetting(){
			$config = include './App/Conf/system.php';

			
			// list
			$this->assign('config',$config);
			// print_r($config); 
			$this->display();
		}

		//奖金配置处理
		public function bonusConf(){
			$path = './App/Conf/system.php';
			$config = include $path;
			$config['ONE']      = I('post.ONE',0,'floatval');
			$config['TWO']      = I('post.TWO',0,'floatval');
			$config['THREE']      = I('post.THREE',0,'floatval');
			$config['ONES']      = I('post.ONES',0,'floatval');
			$config['TWOS']      = I('post.TWOS',0,'floatval');
			$config['THREES']      = I('post.THREES',0,'floatval');
			$config['shou1']      = I('post.shou1',0,'floatval');
			$config['shou2']      = I('post.shou2',0,'floatval');
			$config['shou3']      = I('post.shou3',0,'floatval');
			$config['rwsm']      = I('post.rwsm','','trim');
			$config['gonggao']      = I('post.gonggao','','trim');
			$config['mrkd']      = I('post.mrkd',0,'floatval');
			$config['faquan']      = I('post.faquan',0,'floatval');
			$config['jinbi']      = I('post.jinbi',0,'floatval');
			$config['duihuan']      = I('post.duihuan',0,'floatval');
			$config['hongbao']      = I('post.hongbao',0,'floatval');

			$config['chengzhu']      = I('post.chengzhu',0,'floatval');
			$config['daishu']      = I('post.daishu',0,'floatval');
			$config['buyjj']      = I('post.buyjj',0,'floatval');
			$config['shoujj']      = I('post.shoujj',0,'floatval');

			$config['kefu1']      = I('post.kefu1',0,'floatval');
			$config['kefu2']      = I('post.kefu2',0,'floatval');
			$config['kefu3']      = I('post.kefu3',0,'floatval');

			$config['adurl']      = I('post.adurl','','trim');
			$config['open_web']      = I('post.open_web',0,'intval');
			$config['open_web_notice']      = I('post.open_web_notice','','trim');
			$config['jiesuan_time']      = I('post.jiesuan_time',0,'floatval');
 			$data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";
			if (file_put_contents($path, $data)) {
				$this->success('修改成功', U(GROUP_NAME.'/System/customSetting'));
			} else {
				$this->error('修改失败， 请修改' . $path . '的写入权限');
			}
		} 
		
		//电子货币提现设置处理
		public function withdrawConf(){
			$path = './App/Conf/system.php';
			$config = include $path;
			$config['WITHDRAW_STATUS'] = I('post.withdraw_status','off','strval');
			$config['WITHDRAW_IN_DAY_NUM'] = I('post.withdraw_in_day_num',0,'intval');
			$config['WITHDRAW_TAX'] = I('post.withdraw_tax',0,'intval');
			$config['WITHDRAW_MIN'] = I('post.withdraw_min',0,'intval');
			$config['WITHDRAW_INT'] = I('post.withdraw_int',0,'intval');
			$config['tx_time']      = I('post.tx_time','','trim');
			$data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";

			if (file_put_contents($path, $data)) {
				$this->success('修改成功', U(GROUP_NAME.'/System/customSetting'));
			} else {
				$this->error('修改失败， 请修改' . $path . '的写入权限');
			}
		}

		//电子货币转账设置处理
		public function transferConf(){
			$path = './App/Conf/system.php';
			$config = include $path;
			$config['TRANSFER_STATUS'] = I('post.transfer_status','off','strval');
			$config['TRANSFER_PASS2'] = I('post.transfer_pass2','off','strval');
			$config['TRANSFER_MIN'] = I('post.transfer_min',0,'intval');
			$config['TRANSFER_MAX'] = I('post.transfer_max',0,'intval');
			$config['TRANSFER_TAX'] = I('post.transfer_tax',0,'intval');
			$config['TRANSFER_TAX_MIN'] = I('post.transfer_tax_min',0,'intval');
			$config['TRANSFER_TAX_MAX'] = I('post.transfer_tax_max',0,'intval');
			$config['TRANSFER_PROPORTION'] = I('post.transfer_proportion',1,'intval');
			$config['TRANSFER_GROUP'] = I('post.transfer_group',0,'intval');
			
			$data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";

			if (file_put_contents($path, $data)) {
				$this->success('修改成功', U(GROUP_NAME.'/System/customSetting'));
			} else {
				$this->error('修改失败， 请修改' . $path . '的写入权限');
			}
		}

		//电子货币充值设置处理
		public function rechargeConf(){
			$path = './App/Conf/system.php';
			$config = include $path;
			$config['RECHARGE_MIN'] = I('post.recharge_min',0,'intval');
			$config['RECHARGE_MAX'] = I('post.recharge_max',0,'intval');
			$config['RECHARGE_PROPORTION'] = I('post.recharge_proportion');
			$config['RECHARGE_GIFT'] = I('post.recharge_gift',0,'intval');
			
			$config['recharge_note'] = I('post.recharge_note');
			$config['recharge_is'] = I('post.recharge_is',0,'intval');
			$config['recharge_type'] = I('post.recharge_type',0,'intval');
			
			$config['recharge_examine_type'] = I('post.recharge_examine_type',0,'intval');
			$config['kuangji_id'] = I('post.kuangji_id',0,'intval');
			$config['kuangji_num'] = I('post.kuangji_num',0,'intval');
			
			
			
			$data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";

			if (file_put_contents($path, $data)) {
				$this->success('修改成功', U(GROUP_NAME.'/System/customSetting'));
			} else {
				$this->error('修改失败， 请修改' . $path . '的写入权限');
			}

		}
		
		/**
		 * 修改会员相关配置
		 */
		public function memberConf(){
			$path = './App/Conf/system.php';
			$config = include $path;
			$config['MEMBER_LOGIN'] = I('post.memberlogin','','strval');

			$config['CODE_ACCOUNT'] = I('post.code_account','','strval');
		 	$config['CODE_PASSWORD'] = I('post.code_password','','strval');
			$config['CODE_CF'] = I('post.code_cf',0,'intval');
            $config['CODE_GQ'] = I('post.code_gq',0,'intval');
									
			$data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";
			
			if (file_put_contents($path, $data)) {
				$this->success('修改成功', U(GROUP_NAME.'/System/customSetting'));
			} else {
				$this->error('修改失败， 请修改' . $path . '的写入权限');
			}
		}


		
    public function backUp() {
        $DataDir = RUNTIME_PATH.'databak/';

        if (!empty($_GET['Action'])) {
            import("ORG.Util.MySQLReback");
            $config = array(
                'host' => C('DB_HOST'),
                'port' => C('DB_PORT'),
                'userName' => C('DB_USER'),
                'userPassword' => C('DB_PWD'),
                'dbprefix' => C('DB_PREFIX'),
                'charset' => 'UTF8',
                'path' => $DataDir,
                'isCompress' => 0, //是否开启gzip压缩
                'isDownload' => 0  
            );

            $mr = new MySQLReback($config);
            $mr->setDBName(C('DB_NAME'));
            if ($_GET['Action'] == 'backup') {
                $mr->backup();
                //添加日志操作
                $desc = '备份数据库';
                write_log(session('username'),'admin',$desc);

                redirect(U(GROUP_NAME.'/system/backUp'));                 
            } elseif ($_GET['Action'] == 'RL') {
                $mr->recover($_GET['File']);
                //添加日志操作
                $desc = '还原数据库';
                write_log(session('username'),'admin',$desc);
                redirect(U(GROUP_NAME.'/system/backUp'));
                
            } elseif ($_GET['Action'] == 'Del') {
                if (@unlink($DataDir . $_GET['File'])) {
                    
                    //添加日志操作
                    $desc = '删除备份文件';
                    write_log(session('username'),'admin',$desc);
                    redirect(U(GROUP_NAME.'/system/backUp'));
                } else {                    
                    $this->error('删除失败！');
                }
            }
            if ($_GET['Action'] == 'dow') {
                function DownloadFile($fileName) {
                    ob_end_clean();
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Length: ' . filesize($fileName));
                    header('Content-Disposition: attachment; filename=' . basename($fileName));
                    readfile($fileName);
                }
                DownloadFile($DataDir . $_GET['file']);

                //添加日志操作
                $desc = '下载备份文件';
                write_log(session('username'),'admin',$desc);
                exit();
            }
        }

        $filelist = dir_list($DataDir);
        foreach ((array)$filelist as $r){
            $filename = explode('-',basename($r));
            $files[] = array('path'=> $r,'file'=>basename($r),'name' => $filename[0], 'size' => filesize($r), 'time' => filemtime($r));
            }
        $this->assign('files',$files);
        $this->display();
    }

    public function clearData(){
        $model = new Model();
        $model->query('delete from ds_bonus');
        $model->query('delete from ds_business');
        $model->query('delete from ds_guarantee');
        $model->query('delete from ds_jinbidetail');
        $model->query('delete from ds_jinzhongzidetail');
        $model->query('delete from ds_member where id <>1');
        $model->query('delete from ds_message');
        $model->query('delete from ds_receivable');
        $model->query('delete from ds_transfer');
        $model->query('delete from ds_log');
        $model->query('update ds_member set parentcount = 0,jinbi = 0,jinzhongzi = 0,gamecount = 0,validgamecount = 0,tjsum = 0,bdsum = 0,fhsum = 0,ldsum = 0,glsum=0,zysum = 0,manage_left_jd="",manage_right_jd=""');
        $this->success('操作成功');
    }
		public function deleteLog(){
			if (M('log')->where('id > 0')->delete()) {
				//添加日志操作
				$desc = '管理员['.session('username').']清空日志';
				write_log(session('username'),'admin',$desc);

				$this->success('删除成功',U(GROUP_NAME.'/Log/index'));
			}else{
				$this->error('删除日志失败');
			}
		}
	}
?>