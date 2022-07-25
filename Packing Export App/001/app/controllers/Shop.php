<?php

class Shop extends Controller
{
    public function index()
    {
        if (isset($_SESSION['login-shop'])) {
            $this->view('shop/index');
        } else {
            $this->view('login/indexShop');
        }
    }

    public function getWarningMessage()
    {
        $data = $this->model('WarningMessage2_model')->getMessage();

        echo json_encode($data);
    }

    public function delWarningMessage()
    {
        $data = $this->model('WarningMessage2_model')->delMessage($_POST);

        echo json_encode($data);
    }

    public function getOkMessage()
    {
        $data = $this->model('OkMessage2_model')->getMessage();

        echo json_encode($data);
    }

    public function delOkMessage()
    {
        $data = $this->model('OkMessage2_model')->delMessage($_POST);

        echo json_encode($data);
    }

    public function getDataPokayoke()
    {
        $data['pokayoke'] = $this->model('PokayokeKanban_model')->getVar();
        $data['prod-api'] = $this->model('ProductBoxingExp_model')->getDataWithBarcode($data['pokayoke']['api']);
        $data['prod-cust'] = $this->model('ProductBoxingExp_model')->getDataWithBarcode($data['pokayoke']['cust']);
        // $data['prod-api'] = $this->model('ProductBoxingExp_model')->getVarWithPic($data['pokayoke']['api']);
        // $data['prod-cust'] = $this->model('ProductBoxingExp_model')->getVarWithPic($data['pokayoke']['cust']);
        echo json_encode($data);
    }

    public function resetPokayoke()
    {
        $data = $this->model('PokayokeKanban_model')->resetVar();
        echo json_encode($data);
    }

    public function updateProduct()
    {
        $data = $this->model('AchievementExp_model')->setScanKanban($_POST['uniq']);
        echo json_encode($data);
    }

    public function updateCountQty()
    {
        $data = $this->model('TempQtyCount_model')->countdownVar();
        echo json_encode($data);
    }

    public function setCountQty()
    {
        $data = $this->model('TempQtyCount_model')->setVar($_POST['val-qty-box']);
        echo json_encode($data);
    }

    public function getCountQty()
    {
        $data = $this->model('TempQtyCount_model')->getVar();
        echo json_encode($data);
    }

    public function delPokayoke()
    {
        $data = $this->model('PokayokeKanban_model')->resetAllVar();
        $data = $this->model('TempQtyCount_model')->resetVar();
        echo json_encode($data);
    }

    public function setHistPokayoke()
    {
        echo json_encode($this->model('ShoppingExp_model')->insertVar($_POST));
    }

    public function manageApp()
    {
        echo json_encode($this->model('AppStatus_model')->setVar($_POST['status']));
    }
}
