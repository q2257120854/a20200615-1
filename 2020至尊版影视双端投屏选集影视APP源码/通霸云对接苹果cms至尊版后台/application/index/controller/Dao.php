<?php

namespace app\index\controller;

use think\Controller;
class Dao extends Controller
{
    public function txt()
    {
        $xzv_7 = input('content');
        Header('Content-type:   application/octet-stream ');
        Header('Accept-Ranges:   bytes ');
        header('Content-Disposition:   attachment;   filename=' . date('Y-m-d H:i:s') . '.txt ');
        header('Expires:   0 ');
        header('Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ');
        header('Pragma:   public ');
        echo str_replace('<br><hr>', '
', $xzv_7);
    }
    public function copy()
    {
        $xzv_1 = input('content');
        return view('copy');
    }
    public function excel()
    {
        $xzv_4 = input('content');
        header("Content-Type: application/vnd.ms-excel; name='excel'");
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . date('Y-m-d H:i:s') . '.xls');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo str_replace('<br><hr>', '
', $xzv_4);
    }
    public function cexcel()
    {
        if (session('power') == '0') {
            $xzv_8['y'] = '0';
        } else {
            $xzv_8['uid'] = session('usershshefsdf');
            $xzv_8['y'] = '0';
        }
        if (input('user')) {
            $xzv_9 = input('user');
            $xzv_8['dianka'] = ['like', "%{$xzv_9}%"];
        }
        if (input('start') && input('end')) {
            $xzv_8['ctime'] = ['between', strtotime(input('start') . ' 00:00:00') . ',' . strtotime(input('end') . ' 00:00:00')];
        } else {
            if (input('start')) {
                $xzv_8['ctime'] = ['>', strtotime(input('start') . ' 00:00:00')];
            }
            if (input('end')) {
                $xzv_8['ctime'] = ['<', strtotime(input('end') . ' 00:00:00')];
            }
        }
        if (input('day')) {
            $xzv_8['name'] = input('day');
        }
        header("Content-Type: application/vnd.ms-excel; name='excel'");
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . date('Y-m-d H:i:s') . '.xls');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Expires: 0');
        $xzv_2 = db('dianka')->where($xzv_8)->paginate(20);
        echo '<table>';
        foreach ($xzv_2 as $xzv_5) {
            echo '<tr>';
            echo '<td>';
            echo $xzv_5['dianka'];
            echo '</td>';
            echo '<td>';
            echo $xzv_5['name'];
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    public function ctxt()
    {
        if (session('power') == '0') {
            $xzv_10['y'] = '0';
        } else {
            $xzv_10['uid'] = session('usershshefsdf');
            $xzv_10['y'] = '0';
        }
        if (input('user')) {
            $xzv_6 = input('user');
            $xzv_10['dianka'] = ['like', "%{$xzv_6}%"];
        }
        if (input('start') && input('end')) {
            $xzv_10['ctime'] = ['between', strtotime(input('start') . ' 00:00:00') . ',' . strtotime(input('end') . ' 00:00:00')];
        } else {
            if (input('start')) {
                $xzv_10['ctime'] = ['>', strtotime(input('start') . ' 00:00:00')];
            }
            if (input('end')) {
                $xzv_10['ctime'] = ['<', strtotime(input('end') . ' 00:00:00')];
            }
        }
        if (input('day')) {
            $xzv_10['name'] = input('day');
        }
        $xzv_3 = db('dianka')->where($xzv_10)->paginate(20);
        Header('Content-type:   application/octet-stream ');
        Header('Accept-Ranges:   bytes ');
        header('Content-Disposition:   attachment;   filename=' . date('Y-m-d H:i:s') . '.txt ');
        header('Expires:   0 ');
        header('Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 ');
        header('Pragma:   public ');
        $xzv_3 = db('dianka')->where($xzv_10)->paginate(20);
        foreach ($xzv_3 as $xzv_0) {
            echo $xzv_0['name'];
            echo '------';
            echo $xzv_0['dianka'];
            echo '
';
        }
    }
}