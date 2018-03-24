<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 17:37
 */
namespace App\Http\Controllers;
use Validator;
use Hash;
use DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('Login/login')->with('name','^启正^');
    }

    public function login(Request $request){
        $messages = [
            'required' => 'The :attribute field is required.',
        ];

        $param = [      //表单提交的信息
            'userName'    => $request->input('userName'),
            'passWord'    => $request->input('passWord')
        ];

        $validator = Validator::make($param, [  //验证
            'userName' => 'required|between:6,32',
            'passWord' => 'required|between:6,32'
        ]);

        if ($validator->fails()) {  //报错
            return array('msg'=>$validator->errors()->all(),'code'=>500);
        }
        if (isset($param['userName']) && isset($param['passWord'])) {
            return array('msg'=>'登录成功！','code'=>200);
        }
    }

    public function registerShow(){
        return view('Login/register')->with('name','^启正^');
    }

    public function toRegister(Request $request){
        $param = [      //表单提交的信息
            'userName'    => $request->input('userName'),
            'passWord1'   => $request->input('passWord1'),
            'passWord2'   => $request->input('passWord2'),
            'nickName'    => $request->input('nickName')
        ];

        $validator = Validator::make($param, [  //验证
            'userName'  => 'required|between:6,32',
            'passWord1' => 'required|between:6,32',
            'passWord2' => 'required|between:6,32',
            'nickName'  => 'required|between:2,255',
        ]);

        if ($validator->fails()) {  //报错
            return array('msg'=>$validator->errors()->all(),'code'=>500);
        }

        $passWord = Hash::make($param['passWord1']);  //给密码加密 （生成一串加盐后的字符串）
        session(['password'=>$passWord]);
        $passWord = session('password');
        if (!Hash::check($param['passWord2'], $passWord)) {  //判断两次密码是否一致
            return array('msg'=>'密码两次输入错误','code'=>510);
        }
        $map['userName'] = $param['userName'];
        $getUserName = $this->getFindByUserName($map);

        if ($getUserName) {
            return array('msg'=>'用户名已经被注册!','code'=>520);
        }

        $add['userName'] = $param['userName'];
        $add['passWord'] = $passWord;
        $add['nickName'] = $param['nickName'];
        $add['crTiom'] = date('Y-m-d H:i:s',time());
        $res = $this->userAdd($add);
        if ($res) {
            return array('msg'=>'注册成功!','code'=>200);
        }
    }

    public function editPswShow(){
        return view('Login/editPsw')->with('name','^启正^');
    }

    //根据会员ID获取用户详情
    public function getInfo(Request $request){
        $map['ID'] = $request->input('ID');
        $res = $this->getFindByUserName($map);
        return array('msg' => 'OK','code' => 200,'info' => $res);
    }

    //编辑用户资料
    public function EditPsw(Request $request){
        if (!$request->input('ID')) {
            return array('msg'=>'缺少会员ID!','code'=>3386);
        }
        $map['ID'] = $request->input('ID');
        $info = $this->getFindByUserName($map);
        if (!$info) {
            return array('msg'=>'无此会员信息!','code'=>3387);
        }

        if ($request->input('passWord2') == $request->input('passWord1')) {
            $passWord = $request->input('passWord1');
        } else {
            return array('msg'=>'两次密码不一致!','code'=>3388);
        }
        $InfoPassWord = $info->passWord;
        if (!hash::check($passWord,$InfoPassWord)){
            $data['passWord'] = $passWord;
        }
        $data['userName'] = $request->input('userName');
        $data['nickName'] = $request->input('nickName');
        $this->update($map,$data);
        return array('msg'=>'OK!','code'=>200);
    }

    //编辑
    public function update($condition ,$data){
        return DB::table('user')->where($condition)->update($data);
    }

    //根据userName查询数据
    public function getFindByUserName($condition){
        return DB::table('user')->where($condition)->first();
    }

    //添加数据（插入）
    public function userAdd($user_data){
        return DB::table('user')->insertGetId($user_data);
    }

    public function goDel() {
        /*if (!$request->input('ID')) {
            return array('msg'=>'缺少会员ID!','code'=>3386);
        }*/
        $map['ID'] = 3;
        $res = $this->del($map);
        return array('msg'=> 'OK','code'=>200,'info'=>$res);
    }

    //删除
    public function del($condition){
        return DB::table('user')->where($condition)->delete();
    }
}
