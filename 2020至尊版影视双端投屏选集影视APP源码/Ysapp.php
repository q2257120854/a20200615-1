<?php


namespace app\index\controller;

error_reporting(E_ALL ^ E_NOTICE);
use think\Controller;
class Ysapp extends Base
{
	public function fenl()
	{
		$_var_0 = db('type')->where('type_pid', '0')->where('type_status', '1')->where('type_mid', '1')->select();
		return json_encode($_var_0);
	}
	public function ffenl()
	{
		$_var_1 = input();
		$_var_2 = $_var_1['id'] + 1;
		$_var_3 = db('type')->where('type_pid', $_var_2)->where('type_status', '1')->where('type_mid', '1')->select();
		return json_encode($_var_3);
	}
	public function wzpid()
	{
		$_var_4 = $_GET['id'];
		$_var_5 = db('art')->where('art_id', $_var_4)->find();
		return json_encode($_var_5);
	}
	public function shouye()
	{
		$_var_6 = db('vod')->limit(0, 4)->order('vod_time desc')->whereor('type_id', '3')->select();
		$_var_7 = db('vod')->limit(0, 6)->order('vod_time desc')->whereor('type_id', '4')->select();
		$_var_8 = db('vod')->limit(0, 6)->order('vod_time desc')->where('type_id_1', '2')->select();
		$_var_9 = db('vod')->limit(0, 6)->order('vod_time desc')->where('type_id_1', '1')->select();
		$_var_10['zy']['data'] = $_var_6;
		$_var_10['dm']['data'] = $_var_7;
		$_var_10['dy']['data'] = $_var_9;
		$_var_10['dsj']['data'] = $_var_8;
		return json_encode($_var_10);
	}
	public function sosuo()
	{
		$_var_11 = $_GET['name'];
		$_var_12 = db('vod')->limit(0, 21)->order('vod_time desc')->where('vod_name', 'like', '%' . $_var_11 . '%')->select();
		$_var_13['dsj']['data'] = $_var_12;
		return json_encode($_var_13);
	}
	public function sosuoid()
	{
		$_var_14 = $_GET['id'];
		$_var_15 = db('vod')->order('vod_time desc')->where('vod_id', $_var_14)->select();
		return json_encode($_var_15);
	}
	public function gxsosuo()
	{
		$_var_16 = $_GET['name'];
		$_var_17 = $_GET['yema'];
		if ($_var_17 == 1) {
			$_var_18 = 0;
			$_var_19 = 21;
		} else {
			$_var_18 = $_var_17 * 21 - 20;
			$_var_19 = $_var_17 * 21;
		}
		$_var_20 = db('vod')->order('vod_time desc')->where('vod_name', 'like', '%' . $_var_16 . '%')->count();
		if ($_var_18 > $_var_20) {
			return json(['code' => '0', 'msg' => '已经加载完了，没有了呦！']);
		} else {
			$_var_21 = db('vod')->limit($_var_18, $_var_19)->order('vod_time desc')->where('vod_name', 'like', '%' . $_var_16 . '%')->select();
			$_var_22['dsj']['data'] = $_var_21;
			return json_encode($_var_22);
		}
	}
	public function dsjsy1()
	{
		$_var_23 = $_GET['shaix'];
		$_var_24 = db('vod')->limit(0, 21)->order('vod_time desc')->where('type_id', $_var_23)->select();
		$_var_25['dsj']['data'] = $_var_24;
		return json_encode($_var_25);
	}
	public function dsjsy()
	{
		$_var_26 = $_GET['leix'];
		$_var_27 = $_GET['shaix'];
		if ($_var_26 == 0) {
			if ($_var_27 == 1) {
				$_var_28 = '国产';
			} else {
				if ($_var_27 == 2) {
					$_var_28 = '香港';
				} else {
					if ($_var_27 == 3) {
						$_var_28 = '韩国';
					} else {
						if ($_var_27 == 4) {
							$_var_28 = '欧美';
						} else {
							if ($_var_27 == 5) {
								$_var_28 = '日本';
							} else {
								if ($_var_27 == 6) {
									$_var_28 = '台湾';
								} else {
									if ($_var_27 == 7) {
										$_var_28 = '海外';
									}
								}
							}
						}
					}
				}
			}
			if ($_var_27 == 0) {
				$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->where('vod_class', '国产剧')->whereor('vod_class', '香港剧')->whereor('vod_class', '韩国')->whereor('vod_class', '欧美')->whereor('vod_class', '台湾')->whereor('vod_class', '日本')->whereor('vod_class', '海外')->select();
				$_var_30['dsj']['data'] = $_var_29;
				return json_encode($_var_30);
			} else {
				if ($_var_27 == 8) {
					$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->where('type_id', '22')->select();
					$_var_30['dsj']['data'] = $_var_29;
					return json_encode($_var_30);
				} else {
					if ($_var_27 != 0) {
						$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->where('vod_class', $_var_28)->select();
						$_var_30['dsj']['data'] = $_var_29;
						return json_encode($_var_30);
					}
				}
			}
		} else {
			if ($_var_26 == 1) {
				if ($_var_27 == 1) {
					$_var_28 = '动作';
				} else {
					if ($_var_27 == 2) {
						$_var_28 = '喜剧';
					} else {
						if ($_var_27 == 3) {
							$_var_28 = '爱情';
						} else {
							if ($_var_27 == 4) {
								$_var_28 = '科幻';
							} else {
								if ($_var_27 == 5) {
									$_var_28 = '恐怖';
								} else {
									if ($_var_27 == 6) {
										$_var_28 = '剧情';
									} else {
										if ($_var_27 == 7) {
											$_var_28 = '战争';
										}
									}
								}
							}
						}
					}
				}
				if ($_var_27 == 0) {
					$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->where('vod_class', '动作')->whereor('vod_class', '喜剧')->whereor('vod_class', '爱情')->whereor('vod_class', '科幻')->whereor('vod_class', '恐怖')->whereor('vod_class', '剧情')->whereor('vod_class', '战争')->select();
					$_var_30['dsj']['data'] = $_var_29;
					return json_encode($_var_30);
				} else {
					if ($_var_27 == 8) {
						$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->where('type_id', '23')->select();
						$_var_30['dsj']['data'] = $_var_29;
						return json_encode($_var_30);
					} else {
						if ($_var_27 != 0) {
							$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->where('vod_class', $_var_28)->select();
							$_var_30['dsj']['data'] = $_var_29;
							return json_encode($_var_30);
						}
					}
				}
			} else {
				if ($_var_26 == 2) {
					$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->whereor('vod_class', '动漫')->select();
					$_var_30['dsj']['data'] = $_var_29;
					return json_encode($_var_30);
				} else {
					if ($_var_26 == 3) {
						$_var_29 = db('vod')->limit(0, 21)->order('vod_time desc')->whereor('vod_class', '综艺')->select();
						$_var_30['dsj']['data'] = $_var_29;
						return json_encode($_var_30);
					}
				}
			}
		}
	}
	public function dsjjzgd()
	{
		$_var_31 = $_GET['leix'];
		$_var_32 = $_GET['yema'];
		$_var_33 = $_GET['shaix'];
		if ($_var_32 == 1) {
			$_var_34 = 0;
			$_var_35 = 21;
		} else {
			$_var_34 = $_var_32 * 21 - 20;
			$_var_35 = $_var_32 * 21;
		}
		if ($_var_31 == 0) {
			if ($_var_33 == 1) {
				$_var_36 = '国产';
			} else {
				if ($_var_33 == 2) {
					$_var_36 = '香港';
				} else {
					if ($_var_33 == 3) {
						$_var_36 = '韩国';
					} else {
						if ($_var_33 == 4) {
							$_var_36 = '欧美';
						} else {
							if ($_var_33 == 5) {
								$_var_36 = '日本';
							} else {
								if ($_var_33 == 6) {
									$_var_36 = '台湾';
								} else {
									if ($_var_33 == 7) {
										$_var_36 = '海外';
									}
								}
							}
						}
					}
				}
			}
			if ($_var_33 == 0) {
				$_var_37 = db('vod')->order('vod_time desc')->where('vod_class', '国产')->whereor('vod_class', '香港')->whereor('vod_class', '韩国')->whereor('vod_class', '欧美')->whereor('vod_class', '台湾')->whereor('vod_class', '日本')->whereor('vod_class', '海外')->count();
			} else {
				if ($_var_33 == 8) {
					$_var_37 = db('vod')->order('vod_time desc')->where('type_id', '22')->count();
				} else {
					if ($_var_33 != 0) {
						$_var_37 = db('vod')->order('vod_time desc')->where('vod_class', $_var_36)->count();
					}
				}
			}
		} else {
			if ($_var_31 == 1) {
				if ($_var_33 == 1) {
					$_var_36 = '动作';
				} else {
					if ($_var_33 == 2) {
						$_var_36 = '喜剧';
					} else {
						if ($_var_33 == 3) {
							$_var_36 = '爱情';
						} else {
							if ($_var_33 == 4) {
								$_var_36 = '科幻';
							} else {
								if ($_var_33 == 5) {
									$_var_36 = '恐怖';
								} else {
									if ($_var_33 == 6) {
										$_var_36 = '剧情';
									} else {
										if ($_var_33 == 7) {
											$_var_36 = '战争';
										}
									}
								}
							}
						}
					}
				}
				if ($_var_33 == 0) {
					$_var_37 = db('vod')->order('vod_time desc')->where('vod_class', '动作')->whereor('vod_class', '喜剧')->whereor('vod_class', '爱情')->whereor('vod_class', '科幻')->whereor('vod_class', '恐怖')->whereor('vod_class', '剧情')->whereor('vod_class', '战争')->count();
				} else {
					if ($_var_33 == 8) {
						$_var_37 = db('vod')->order('vod_time desc')->where('type_id', '23')->count();
					} else {
						if ($_var_33 != 0) {
							$_var_37 = db('vod')->order('vod_time desc')->where('vod_class', $_var_36)->count();
						}
					}
				}
			} else {
				if ($_var_31 == 2) {
					$_var_37 = db('vod')->order('vod_time desc')->where('vod_class', '动漫')->count();
				} else {
					if ($_var_31 == 3) {
						$_var_37 = db('vod')->order('vod_time desc')->where('vod_class', '综艺')->count();
					}
				}
			}
		}
		if ($_var_34 > $_var_37) {
			return json(['code' => '0', 'msg' => '已经加载完了，没有了呦！']);
		} else {
			if ($_var_31 == 0) {
				if ($_var_33 == 0) {
					$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('vod_class', '国产')->whereor('vod_class', '香港')->whereor('vod_class', '韩国')->whereor('vod_class', '欧美')->whereor('vod_class', '台湾')->whereor('vod_class', '日本')->whereor('vod_class', '海外')->select();
					$_var_39['dsj']['data'] = $_var_38;
					return json_encode($_var_39);
				} else {
					if ($_var_33 == 8) {
						$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('type_id', '22')->select();
						$_var_39['dsj']['data'] = $_var_38;
						return json_encode($_var_39);
					} else {
						if ($_var_33 != 0) {
							$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('vod_class', $_var_36)->select();
							$_var_39['dsj']['data'] = $_var_38;
							return json_encode($_var_39);
						}
					}
				}
			} else {
				if ($_var_31 == 1) {
					if ($_var_33 == 0) {
						$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('vod_class', '动作')->whereor('vod_class', '喜剧')->whereor('vod_class', '爱情')->whereor('vod_class', '科幻')->whereor('vod_class', '恐怖')->whereor('vod_class', '剧情')->whereor('vod_class', '战争')->select();
						$_var_39['dsj']['data'] = $_var_38;
						return json_encode($_var_39);
					} else {
						if ($_var_33 == 8) {
							$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('type_id', '23')->select();
							$_var_39['dsj']['data'] = $_var_38;
							return json_encode($_var_39);
						} else {
							if ($_var_33 != 0) {
								$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('vod_class', $_var_36)->select();
								$_var_39['dsj']['data'] = $_var_38;
								return json_encode($_var_39);
							}
						}
					}
				} else {
					if ($_var_31 == 2) {
						$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('vod_class', '动漫')->select();
						$_var_39['dsj']['data'] = $_var_38;
						return json_encode($_var_39);
					} else {
						if ($_var_31 == 3) {
							$_var_38 = db('vod')->limit($_var_34, $_var_35)->order('vod_time desc')->where('vod_class', '综艺')->select();
							$_var_39['dsj']['data'] = $_var_38;
							return json_encode($_var_39);
						}
					}
				}
			}
		}//更多资源请关注：三岁半资源网:sansuib.com
	}
	public function dsjjzgd1()
	{
		$_var_40 = $_GET['yema'];
		$_var_41 = $_GET['shaix'];
		if ($_var_40 == 1) {
			$_var_42 = 0;
			$_var_43 = 21;
		} else {
			$_var_42 = $_var_40 * 21 - 20;
			$_var_43 = $_var_40 * 21;
		}
		$_var_44 = db('vod')->order('vod_time desc')->where('type_id', $_var_41)->count();
		if ($_var_42 > $_var_44) {
			return json(['code' => '0', 'msg' => '已经加载完了，没有了呦！']);
		} else {
			$_var_45 = db('vod')->limit($_var_42, $_var_43)->order('vod_time desc')->where('type_id', $_var_41)->select();
			$_var_46['dsj']['data'] = $_var_45;
			return json_encode($_var_46);
		}
	}
}