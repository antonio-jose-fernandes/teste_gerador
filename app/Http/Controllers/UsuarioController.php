<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Campanha;
use App\Models\Language;
use App\Models\Tokens;
use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class UsuarioController extends Controller
{

    function new (){
        $user = new User();
        $lang = Language::all();
        $types = TypeUser::all();
        return view ('usuario/form', ['usuario'=>$user,'lang'=>$lang,'types'=>$types],);
    }

    function newwa (){
        $user = new User();
        $lang = Language::all();
        return view ('usuario/formwa', ['usuario'=>$user,'lang'=>$lang]);
    }

    function edit ($id){
        $user = User::find($id);
        $lang = Language::all();
        $types = TypeUser::all();
        return view ('usuario/form', ['usuario'=>$user,'lang'=>$lang,'types'=>$types]);
    }

    function  create(Request $request){
        $usuario  = new User();

        $input =  $this->valida($request,true);

        try{
            $usuario  = User::create([
                'name'=>$request->firstname,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
                'created_at'=>date('d/m/Y'),
                'updated_at'=>date('d/m/Y'),
                'lastname'=>$request->lastname,
                'street'=>$request->street,
                'city'=>$request->city,
                'country'=>$request->country,
                'postzip'=>$request->zipcode,
                'username'=>$request->username,
                'phone'=>$request->phone,
            ]);

            $msgemail = "Seja Bem Vindo a plataforma do Sistema de Coleta Seletiva - Sobral, ".$usuario->name;
            Helper::sendEmail(trans("messport.welcome_plataform"),$msgemail,$request->email);

        }catch (QueryException $exp){
            $msg = ['valor'=>$exp->getMessage(),'tipo'=>'primary'];
            return view('usuario/formwa',['msg'=>$msg,'usuario'=>$usuario]);
        }
        $msg = ['valor'=>trans('messport.sucesso'),'tipo'=>'success'];
       // return view('login',['msg'=>$msg]);
      return $this->list($msg=null);
    }

    function valida(Request  $request, $tipo){


        $input = $request->validate([
            'username' => 'required|between :5,15|unique:users,username|regex:"^[a-z_A-Z0-9]*$"',
            'email' => 'required|unique:users,email',
        ]);

        if ($tipo) {
            $input = $request->validate([
                'username' => 'required|between :5,15|unique:users,username|regex:"^[a-z_A-Z0-9]*$"',
                //'password' => 'required|between :5,15|regex:"((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{6,20})"',
                'password' => 'required|between :5,15|regex:"^[a-z_A-Z0-9]*$"',
                'email' => 'required|unique:users,email',
            ]);
        }

        return $input;

    }
    function save(Request $request){
        $logo = null;
        $usuario  = new User();
        try{

            if ($request->hasFile('foto') && $request->file('foto')) {
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->foto->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
                // Faz o upload:
                $upload = $request->foto->storeAs('categories', $nameFile);
                $logo = $nameFile;
            }

            if ($request->id){

            $input = $request->validate([
                'username' => 'required|between :5,30|unique:users,username,'.$request->id.'|regex:"^[a-z_A-Z0-9]*$"',
                'email' => 'required|unique:users,email,'.$request->id,
            ]);

            $usuario = User::find($request->id);
            $usuario->name =$request->firstname;
            $usuario->updated_at =date('m/d/Y');
            $usuario->lastname =$request->lastname;
            $usuario->street =$request->street;
            $usuario->country =$request->country;
            $usuario->postzip =$request->zipcode;
            $usuario->username =$request->username;
            $usuario->phone =$request->phone;
            $usuario->city =$request->city;
            $usuario->email =$request->email;
            $usuario->lang= $request->lang;
            $usuario->type= $request->typeuser;
            if ($logo){
                $usuario->avatar='/storage/categories/'.$logo;
            }
            $usuario->save();
        } else{

            $this->valida($request, false);

            $usuario  = User::create([
                'name'=>$request->firstname,
                'password'=>bcrypt('123456'),
                'email'=>$request->email,
                'created_at'=>date('d/m/Y'),
                'updated_at'=>date('d/m/Y'),
                'lastname'=>$request->lastname,
                'street'=>$request->street,
                'city'=>$request->city,
                'country'=>$request->country,
                'postzip'=>$request->zipcode,
                'username'=>$request->username,
                'phone'=>$request->phone,
                'type'=>$request->typeuser,
            ]);
                if ($logo){

                    $usuario->avatar='/storage/categories/'.$logo;
                    $usuario->save();
                }
                $msgemail = "Seja Bem Vindo a plataforma do Sistema de Coleta Seletiva - Sobral, ".$usuario->name;
            Helper::sendEmail(trans("messport.welcome_plataform"),$msgemail,$request->email);
        }
        }catch (QueryException $exp){
            $msg = ['valor'=>$exp->getMessage(),'tipo'=>'primary'];
        }

        $msg = ['valor'=>trans('messport.sucesso'),'tipo'=>'success'];
        $lang = Language::all();
        $types = TypeUser::all();
        return view ('usuario/form',['msg'=>$msg,'lang'=>$lang,'usuario'=>$usuario,'types'=>$types]);
    }
    function list($msg=null){
        $usuarios = User::paginate(10);
        return view('usuario/list',['lista'=>$usuarios,'msg'=>$msg,'filtro'=>""]);
    }

    function search(Request $request){
        $filter = $request->query('filtro');
        $usuarios = User::where('name','like',"%".$request->filtro."%")->paginate(10);
        return view('usuario/list',['lista'=>$usuarios,'msg'=>null,'filtro'=>$request->filtro])->with('filter', $filter);
    }

    function  delete($id){
        try {


            $usuario = User::find($id);
            if ($usuario){
                if ($usuario->type != 1) {
                    $usuario->delete();
                    $msg = ['valor' => trans('messport.sucesso'), 'tipo' => 'success'];
                }else{
                    $msg = ['valor' => trans('messport.root_user'), 'tipo' => 'primary'];
                }
            }else{
                $msg = null;

            }
            }catch (QueryException $exp ){
            $msg = ['valor'=>$exp->getMessage(),'tipo'=>'primary'];
        }

        $usuarios = User::paginate(10);

        return view('usuario/list',['lista'=>$usuarios,'msg'=>$msg,'filtro'=>'']);
    }

    function preLogin(){
        return view('login');
    }

    function logar(Request  $request){

        $dados =['name' => $request->username,'password' => $request->password];
        if (Auth::attempt($dados, false)) {
            $request->session()->regenerate();
            return view('layout');
        } else{
            $msg = ['valor'=>trans('Erro ao logar'),'tipo'=>'primary'];
            return view('login',['msg'=>$msg] );
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



    function  preChangePassword($uid=null){
        $token = Tokens::where('uid','=',$uid)->first();
        $msg = ['valor'=>trans('messport.token_expi'),'tipo'=>'primary'];
        if ($token){
            $usuario = User::find($token->user);
            return view("mudarsenha",['token'=>$token->user,'username'=>$usuario->email]);
        }
        return view("login",['msg'=>$msg]);
    }
    function  changePassword(Request $request){
        if ($request->senha!=$request->confirm){
            $msg = ['valor'=>trans('messport.pass_conf'),'tipo'=>'primary'];
            return view("mudarsenha",['token'=>$request->user,'username'=>$request->username,'msg'=>$msg]);
        }

        $input = $request->validate([
            'senha' => 'required|between :5,15|regex:"((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{6,20})"',
        ]);


        $msg = ['valor'=>trans('messport.user_not_found'),'tipo'=>'primary'];
        $user = User::find($request->user);
        if ($user){
            $user->password = bcrypt($request->senha);
            $user->save();
            $tokens=Tokens::where('user','=',$user->id)->delete();
            $msg = ['valor' => trans('messport.sucesso'), 'tipo' => 'success'];
        }
        auth()->login($user, true);
        return view("dashbord",['msg'=>$msg]);
    }

    function recoverPasswordDo(Request $request){

        $usuario = User::where('email','=',$request->username)->first();

        $msg = ['valor'=>trans('messport.user_not_found'),'tipo'=>'primary'];
        if ($usuario){
            $token = new Tokens();
            $token->user =$usuario->id;
            $token->uid = Str::uuid();
            $token->save();
            Helper::sendEmail("Recuperação de Conta","Acesse o link: ".env('APP_URL')."/newpassword/".$token->uid, $usuario->email);
            $msg = ['valor'=>trans('messport.senha_enviada').$usuario->email,'tipo'=>'success'];
        }
        return view("recuperar",['msg'=>$msg,'username'=>$request->username]);
    }

}
