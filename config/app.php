<?php
return [
   //����� ��������������
   'auth' => \Src\Auth\Auth::class,
   //���� ������������
   'identity' => \Model\User::class,
   //������ ��� middleware
   'routeMiddleware' => [
       'auth' => \Middlewares\AuthMiddleware::class,
   ]
];
