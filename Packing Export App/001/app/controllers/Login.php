<?php

class Login extends Controller
{
    public function index()
    {
        unset($_SESSION['login']);
        $this->model('TempDataPic_model')->setVar();
        $this->model('TempProduction_model')->resetVar();
        $this->view('login/index');
    }

    public function loginValidation()
    {
        $data = $this->model('User_model')->checkUserPass($_POST);
        $errLogin = 'yes';
        if ($data != false) {
            $errLogin = 'no';
            $_SESSION['login'] = [
                'name' => $data['name'],
                'npk' => $data['npk'],
                'usergroup' => $data['usergroup']
            ];

            $this->model('TempProduction_model')->setNpk($data['npk']);
        }
        $cek = [
            'errLogin' => $errLogin
        ];

        echo json_encode($cek);
    }

    public function indexShop()
    {
        unset($_SESSION['login-shop']);
        $this->model('TempShop_model')->resetVar();
        $this->view('login/index-shop');
    }

    public function loginValShop()
    {
        $data = $this->model('User_model')->checkUserPass($_POST);
        $errLogin = 'yes';
        if ($data != false) {
            $errLogin = 'no';
            $_SESSION['login-shop'] = [
                'name' => $data['name'],
                'npk' => $data['npk'],
                'usergroup' => $data['usergroup']
            ];

            $this->model('TempShop_model')->setVar($_SESSION['login-shop']);
        }
        $cek = [
            'errLogin' => $errLogin
        ];

        echo json_encode($cek);
    }
}
