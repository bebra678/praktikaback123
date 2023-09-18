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
              'required' => '���� :field �����',
              'unique' => '���� :field ������ ���� ���������'
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
        //���� ������ ��������� � ��������, �� ���������� �����
        if ($request->method === 'GET') {
            return new View('site.login');
        }
    //���� ������� ����������������� ������������, �� ��������
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/glav');
        }
        //���� �������������� �� �������, �� ��������� �� ������
        return new View('site.login', ['message' => '������������ ����� ��� ������']);
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
        $employees = Employee::all();
        $subdivisions = Subdivision::all();
        $positions = Position::all();
        return (new View())->render('site.sot', ['employees' => $employees, 'subdivisions' => $subdivisions, 'positions' => $positions]);
    }

    public function check(): string
    {
        $employees = Employee::all();
        $disciplines = Discipline::all();
        return (new View())->render('site.check', ['employees' => $employees, 'disciplines' => $disciplines]);
    }

    public function add_sot(): string
    {
        return new View('site.add_sot');
    }
}
