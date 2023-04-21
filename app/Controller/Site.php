<?php

namespace Controller;
use Src\Request;
use Src\View;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;
use Model\Employee;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

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
            app()->route->redirect('/hello');
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
        return new View('site.dis');
    }

    public function pod(): string
    {
        return new View('site.pod');
    }

    public function sot(Request $request): string
    {
        return new View('site.sot');

        // foreach ($employees as $employee) 
        // {
        //     $employee->
        // }
        // $post->title
        // $employees = Employee::all();
        // $posts = Post::where('id', $request->id)->get();
        // return (new View())->render('site.post', ['posts' => $posts]);
        // return new View('site.sot');
        // $employees = Employee::all();
        // return (new View())->render('site.sot', ['employees' => $employees]);
        // $employees = Employee::where('id', $request->id)->get();
        // return (new View())->render('site.sot', ['employees' => $employees]);
    }

    public function check(): string
    {
        return new View('site.check');
    }
}
