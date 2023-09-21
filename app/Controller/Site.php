<?php

namespace Controller;
use Src\Request;
use Src\View;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;
use Model\Employee;
use Model\Discipline;
use Model\Position;
use Model\Subdivision;
use Model\Type_subdivision;

class Site
{
//    public function index(Request $request): string
//    {
//        $posts = Post::where('id', $request->id)->get();
//        return (new View())->render('site.post', ['posts' => $posts]);
//    }

   public function hello(): string
   {
       return new View('site.hello', ['message' => 'hello working']);
   }

   public function signup(Request $request): string
   {
      if ($request->method === 'POST') {
   
          $validator = new Validator($request->all(), [
              'name' => ['required'],
              'login' => ['required', 'unique:users,login'],
              'password' => ['required']
          ], [
              'required' => 'Поле :field пусто',
              'unique' => 'Поле :field должно быть уникально'
          ]);
   
          if($validator->fails()){
              return new View('site.signup',
                  ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
          }
   
          if (User::create($request->all())) {
              app()->route->redirect('/login');
          }
      }
      return new View('site.signup');
   }
   
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
    //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/glav');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function glav(): string
    {
        return new View('site.glav');
    }

    public function dis(): string
    {
        $disciplines = Discipline::all();
        return (new View())->render('site.dis', ['disciplines' => $disciplines]);
    }

    public function pod(): string
    {
        $subdivisions = Subdivision::all();
        return (new View())->render('site.pod', ['subdivisions' => $subdivisions]);
    }

    public function sot(Request $request): string
    {
        $subdivisions = Subdivision::all();
        $positions = Position::all();
        $employees = Employee::all();
        if(!empty($_GET["radio"]))
        {
            if($_GET['radio'] != 'Все')
            {
                $id = $_GET["radio"];
                $employees = Employee::where('id_subdivision', $id)->get();
            }
            //var_dump($_GET['radio']);
        }
        return (new View())->render('site.sot', ['employees' => $employees, 'subdivisions' => $subdivisions, 'positions' => $positions]);
    }

    public function check(): string
    {
        $employees = Employee::all();
        $disciplines = Discipline::all();
        return (new View())->render('site.check', ['employees' => $employees, 'disciplines' => $disciplines]);
    }

    public function add_sot(Request $request): string
    {
        $subdivisions = Subdivision::all();
        $positions = Position::all();
        if ($request->method === 'POST') {
            //var_dump($request);
  //          $employee = Employee::create($request->all());
//            $employee->photo($_FILES['photo']);
       //     $employee->save();
       //     app()->route->redirect('/sot');
            $data = [
                'first_name' => 'test',
                'name' => 'test',
                'second_name' => 'test',
                'sex' => 'test',
                'address' => 'test',
                'id_subdivision' => '2',
                'id_position' => 2];
            $employee = Employee::create($data);
            $employee->save();
        }
        return new View('site.add_sot', ['subdivisions' => $subdivisions, 'positions' => $positions]);
    }


}
