<?php

class Home extends Controller
{
    public function index()
    {
        if (isset($_SESSION['login'])) {
            $this->view('home/index');
        } else {
            $this->view('login/index');
        }
    }

    public function getMarginQrcode()
    {
        $data = $this->model('SettingQrcode_model')->getMarginValue();

        echo json_encode($data);
    }

    public function setMarginQrcode()
    {
        $data = $this->model('SettingQrcode_model')->setMarginValue($_POST);

        echo json_encode($data);
    }

    public function testPrintQrcode()
    {
        $data = $this->model('SettingQrcode_model')->getMarginValue();

        $valQrcode = '210900001_S5530-EW030_API_6_0462_240921_08.18.59';
        // $valQrcode = '210900099_55967-KK020_API_60_0462_060921_14.40.00';
        $print_data = "
        <0x10>CT~~CD,~CC^~CT~
        ^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR5,5~SD" . $data['darkness'] . "^JUS^LRN^CI0^XZ
        ^XA
        ^MMT
        ^PW400
        ^LL0080
        ^LS0
        ^FT" . $data['left_qrcode'] . "," . $data['up_qrcode'] . "^BQN,2,3
        ^FH\^FDLA," . $valQrcode . "^FS
        ^FT" . $data['left_label'] . "," . $data['up_label'] . "^A0N,15,15^FH\^FD" . "RH" . " / " . "TEST" . "^FS
        ^PQ1,0,1,Y^XZ        
        ";

        // $print_data = "
        // <0x10>CT~~CD,~CC^~CT~
        // ^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR5,5~SD" . $data['darkness'] . "^JUS^LRN^CI0^XZ
        // ^XA
        // ^MMT
        // ^PW400
        // ^LL0080
        // ^LS0
        // ^FT" . $data['left_qrcode'] . "," . $data['up_qrcode'] . "^BQN,2,3
        // ^FH\^FDLA," . $valQrcode . "^FS
        // ^PQ1,0,1,Y^XZ        
        // ";

        // $print_data = "
        // <0x10>CT~~CD,~CC^~CT~
        // ^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR5,5~SD" . $data['darkness'] . "^JUS^LRN^CI0^XZ
        // ^XA
        // ^MMT
        // ^PW400
        // ^LL0080
        // ^LS0
        // ^FT" . $data['left_qrcode'] . "," . $data['up_qrcode'] . "^BQN,2,3
        // ^FH\^FDLA," . $valQrcode . "^FS
        // ^PQ1,0,1,Y^XZ        
        // ";

        // $print_data = "
        // <0x10>CT~~CD,~CC^~CT~
        // ^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR5,5~SD20^JUS^LRN^CI0^XZ
        // ^XA
        // ^MMT
        // ^PW398
        // ^LL0158
        // ^LS0
        // ^FT20,158^BQN,2,5
        // ^FH\^FDLA,C01-D26/08/2021/0005^FS
        // ^FT139,99^A0N,17,16^FH\^FDCASE_COOLING_UPR/LWR_D26^FS
        // ^FT139,75^A0N,17,16^FH\^FDC01-D26/08/2021/0005^FS
        // ^FT140,40^A0N,20,19^FH\^FDPT.AUTOPLASTIK.INDONESIA^FS
        // ^PQ1,0,1,Y^XZ
        // ";
        // $fp = pfsockopen("192.168.1.203", 9100);
        $fp = pfsockopen("192.168.1.204", 9100);
        fputs($fp, $print_data);
        fclose($fp);

        echo json_encode(1);
    }

    public function getWarningMessage()
    {
        $data = $this->model('WarningMessage_model')->getMessage();

        echo json_encode($data);
    }

    public function delWarningMessage()
    {
        $data = $this->model('WarningMessage_model')->delMessage($_POST);

        echo json_encode($data);
    }

    public function getOkMessage()
    {
        $data = $this->model('OkMessage_model')->getMessage();

        echo json_encode($data);
    }

    public function delOkMessage()
    {
        $data = $this->model('OkMessage_model')->delMessage($_POST);

        echo json_encode($data);
    }

    public function getDataPokayoke()
    {
        $data['pokayoke'] = $this->model('PokayokeDataPart_model')->getVar();
        $data['data-part-local'] = $this->model('ProductBoxingExp_model')->getDataWithBarcode($data['pokayoke']['local']);
        $data['data-part-shopping'] = $this->model('ProductBoxingExp_model')->getDataWithBarcode($data['pokayoke']['shopping']);
        // $data += [
        //     'part_num_local' => $this->model('ProductBoxingExp_model')->getPartNumberWithPic($data['local'])
        // ];
        // $data += [
        //     'part_num_shop' => $this->model('ProductBoxingExp_model')->getPartNumberWithPic($data['shopping'])
        // ];
        echo json_encode($data);
    }

    public function setDataPokayoke()
    {
        $data = $this->model('PokayokeDataPart_model')->setVar();

        echo json_encode($data);
    }

    public function getDataProd()
    {
        $data = $this->model('TempProduction_model')->getVar();
        $data += $this->model('User_model')->getOpName($data['npk_op']);

        echo json_encode($data);
    }

    public function getDataPic()
    {
        $data = $this->model('TempDataPic_model')->getVar();

        echo json_encode($data);
    }

    public function setDataPic()
    {
        $data = $this->model('TempDataPic_model')->setPic($_POST['pic']);

        echo json_encode($data);
    }

    public function resetDataPic()
    {
        $data = $this->model('TempDataPic_model')->setVar();

        echo json_encode($data);
    }

    public function setDataTempProd()
    {
        $readDataTempProd = $this->model('TempProduction_model')->getVar();
        $data = $this->model('ProductBoxingExp_model')->getDataWithBarcode($_POST['barcode']);
        if ($readDataTempProd['count_qty_oem'] == 0 && $readDataTempProd['count_qty_exp'] == 0) {
            $data += [
                'count_qty_exp' => $data['qty_exp']
            ];
            $data = $this->model('TempProduction_model')->setVar($data);
        } else if ($readDataTempProd['count_qty_oem'] == 0 && $readDataTempProd['count_qty_exp'] > 0) {
            // $data['qty_exp'] = $readDataTempProd['count_qty_exp'];
            $data += [
                'count_qty_exp' => $readDataTempProd['count_qty_exp']
            ];
            $data = $this->model('TempProduction_model')->setVar($data);
        } else if ($readDataTempProd['count_qty_oem'] > 0 && $readDataTempProd['count_qty_exp'] == 0) {
            // Masih belum menemukan algoritmanya
            $data += [
                'count_qty_exp' => $data['qty_exp']
            ];
            $data['qty_oem'] += $readDataTempProd['count_qty_oem'];
            $data = $this->model('TempProduction_model')->setVar($data);
        }

        echo json_encode($data);
    }

    public function validationPrintQrcode()
    {
        $data = $this->model('TempProduction_model')->getVar();

        echo json_encode($data);
    }

    public function printQrcode()
    {
        $dataProduct = $_POST;
        $data['station'] = $this->model('Station_model')->getVar();
        // $dataUniqCode = $this->model('UniqCodeQr_model')->getVar();
        // $dataMarginQrcode = $this->model('SettingQrcode_model')->getMarginValue();
        // $masterProduct = $this->model('ProductBoxingExp_model')->getDataProduct($dataProduct['part_name']);

        date_default_timezone_set("Asia/Jakarta");
        $datetime = date("Y-m-d H:i:s");
        // $datetimeQR = date("dmy_H.i.s");
        $valQRcode = '';
        // $namaPT = 'API';
        // $yearMonthLast = date(substr($dataUniqCode['date'], 0, 7));
        // $yearMonthNow = date("Y-m");
        // $dateNow = date("Y-m-d");

        // if ($yearMonthNow > $yearMonthLast || $dataUniqCode['cycle'] < 1) {
        //     $this->model('UniqCodeQr_model')->setVar(1, $dateNow);

        //     $dataUniqCode = $this->model('UniqCodeQr_model')->getVar();
        // }

        // $id = sprintf("%05d", $dataUniqCode['cycle']);
        // $uniqNumber = substr(date('Y'), 2) . date('m') . $id;

        // $this->model('UniqCodeQr_model')->incVar();

        // $valQRcode = $uniqNumber . '_' . $dataProduct['pn_cust'] . '_' . $namaPT . '_' . $dataProduct['qty_exp'] . '_' . $dataProduct['npk_op'] . '_' . $datetimeQR;

        // if ($valQRcode != '') {
        $data = [
            'station_num' => $data['station'][0]['number'],
            'part_name' => $dataProduct['part_name'],
            'pn_cust' => $dataProduct['pn_cust'],
            'date_time' => $datetime,
            'qr_code' => $valQRcode
        ];

        $data += $this->model('User_model')->getOpName($dataProduct['npk_op']);

        // if ($dataProduct['pos'] != '') {
        //     $label = $dataProduct['pos'] . '/' . $masterProduct['type'];
        // } else {
        //     $label = $masterProduct['type'];
        // }

        // $print_data = "
        // <0x10>CT~~CD,~CC^~CT~
        // ^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR5,5~SD" . $dataMarginQrcode['darkness'] . "^JUS^LRN^CI0^XZ
        // ^XA
        // ^MMT
        // ^PW400
        // ^LL0080
        // ^LS0
        // ^FT" . $dataMarginQrcode['left_qrcode'] . "," . $dataMarginQrcode['up_qrcode'] . "^BQN,2,3
        // ^FH\^FDLA," . $valQRcode . "^FS
        // ^FT" . $dataMarginQrcode['left_label'] . "," . $dataMarginQrcode['up_label'] . "^A0N,15,15^FH\^FD" . $label . "^FS
        // ^PQ1,0,1,Y^XZ        
        // ";
        // $fp = pfsockopen("192.168.1.204", 9100);
        // fputs($fp, $print_data);
        // fclose($fp);

        $this->model('AchievementExp_model')->insertVar($data);

        // }

        // echo json_encode($dataUniqCode);
    }

    public function templateDataPart()
    {
        $this->view('template/data-part-tmmin');
    }

    public function cekPrintDataPart()
    {
        echo json_encode($this->model('TempDataPart_model')->getVar());
    }

    public function printDataPart()
    {
        $dataPartCode = $this->model('TempDataPart_model')->getVarWithId($_POST['id']);
        $dataTempProd = $this->model('TempProduction_model')->getVar();
        $dataTempProd2 = [
            'npk_op' => $dataTempProd['npk_op']
        ];
        $dataProduct = $this->model('ProductBoxingExp_model')->getDataWithBarcode($dataPartCode['data']);
        $dataProduct['qty_exp'] = $dataTempProd['qty_exp'];

        echo json_encode($dataProduct + $dataTempProd2);
    }

    public function delPrintDataPart()
    {
        unlink('C:/xampp/htdocs/001/public/img/barcode/' . $_POST['code'] . '.jpg');
        echo json_encode($this->model('TempDataPart_model')->delVar($_POST['id']));
    }

    public function setDataTempProdExcNpk()
    {
        $this->model('AchievementExp_model')->delTrash();
        $this->model('TempDataPic_model')->setVar();

        echo json_encode($this->model('TempProduction_model')->resetVarExcNpk());
    }

    public function btnPrintQrcode()
    {
        $data = $this->model('TempProduction_model')->getVar();
        // if ($data['npk_op'] == NULL && $data['pn_cust'] != NULL && $data['count_qty_dom'] > 0 && $data['count_qty_exp'] > 0)
        if ($data['npk_op'] == NULL) {
            $this->model('WarningMessage_model')->insertVar('Data operator belum di input');
        } else if ($data['pn_cust'] == NULL) {
            $this->model('WarningMessage_model')->insertVar('Data produk tidak ditemukan');
        } else if ($data['count_qty_oem'] == 0) {
            $this->model('WarningMessage_model')->insertVar('Counting quantity oem sudah habis');
        } else if ($data['count_qty_exp'] == 0) {
            $this->model('WarningMessage_model')->insertVar('Counting quantity export sudah habis');
        } else {
            $this->model('Button_model')->insertVal();
        }
    }

    public function readBtnPrintQrcode()
    {
        echo json_encode($this->model('Button_model')->getVar());
    }

    public function delPrintQrcode()
    {
        echo json_encode($this->model('Button_model')->delVar($_POST['id']));
    }

    public function readQtyType()
    {
        echo json_encode($this->model('QtyType_model')->getVar());
    }

    public function getQtyOfType()
    {
        $data = $this->model('ProductBoxingExp_model')->getDataWithBarcode($_POST['barcode-1L']);
        $qty1L = $data['qty_exp'];
        $data = $this->model('ProductBoxingExp_model')->getDataWithBarcode($_POST['barcode-1N']);
        $qty1N = $data['qty_exp'];
        $data = [
            'qty_1L' => $qty1L,
            'qty_1N' => $qty1N
        ];

        echo json_encode($data);
    }

    public function btnQtyType()
    {
        if ($_POST['type'] == '1L') {
            $data = $this->model('QtyType_model')->getVar();
            if ($data['data_part'] == 'local') {
                $this->model('PokayokeDataPart_model')->setLocal($data['barcode_1L']);
            } else if ($data['data_part'] == 'shopping') {
                $this->model('PokayokeDataPart_model')->setShopping($data['barcode_1L']);
            }
            $this->model('QtyType_model')->resetVar();
        } else if ($_POST['type'] == '1N') {
            $data = $this->model('QtyType_model')->getVar();
            if ($data['data_part'] == 'local') {
                $this->model('PokayokeDataPart_model')->setLocal($data['barcode_1N']);
            } else if ($data['data_part'] == 'shopping') {
                $this->model('PokayokeDataPart_model')->setShopping($data['barcode_1N']);
            }
            $this->model('QtyType_model')->resetVar();
        }
    }

    public function getTempQty()
    {
        echo json_encode($this->model('TempProduction_model')->getVar());
    }

    public function setTempQty()
    {
        echo json_encode($this->model('TempProduction_model')->setCountQtyOemExp($_POST));
    }
}
