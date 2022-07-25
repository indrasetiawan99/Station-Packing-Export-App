const mysql = require("mysql");
const bwipjs = require("bwip-js");
const fs = require("fs");

var con001 = mysql.createConnection({
  host: "localhost", //10.14.178.79
  user: "root", //boxing-pc
  password: "",
  database: "001", //boxing_qrcode
});

var conMaster = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "master_db",
});

var conResult = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "result",
});

con001.connect(function (err, result) {
  if (err) {
    console.log(err);
    console.log('');
    warning_message('Program scanner error');
  } else {
    console.log("Connected 001 DB!");
  }
});

conMaster.connect(function (err, result) {
  if (err) {
    console.log(err);
    console.log('');
    warning_message('Program scanner error');
  } else {
    console.log("Connected Master DB!");
  }
});

conResult.connect(function (err, result) {
  if (err) {
    console.log(err);
    console.log('');
    warning_message('Program scanner error');
  } else {
    console.log("Connected Result DB!");
  }
});

// Import dependencies
const SerialPort = require("serialport");
const Readline = require("@serialport/parser-readline");

var connectScanner = function () {
  // Defining the serial port
  const port = new SerialPort("COM3", {
    baudRate: 9600,
    dataBits: 8,
    parity: "none",
    stopBits: 1,
  });

  //Readline
  const parser = port.pipe(new Readline({ delimiter: "\r" }));

  parser.on("data", function (data) {
    // var data = '627910K0300052';  //for trial
    // var data = '21007316JP4MRR-GMQW65BK02';  //for trial
    console.log("Data is: ", data);
    console.log("");

    var d = new Date();
    var uniq_date = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
    var year = String(d.getFullYear()).substring(2, 4);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);

    if(data.length > 35){
      console.log('Ini QR-code label');
      console.log("");
      // Isi QR-code label
      console.log(data);

      // sql = "SELECT * FROM achievement_exp WHERE qr_code = '"+data+"'";
      // con.query(sql, function(err, result){
      //   if (err) throw err;

        // if(result.length > 0){
        //   if(result[0].hasil_scanning == null){

          sql = "SELECT * FROM station";
          con001.query(sql, function(err, result){
            if (err) {
              console.log(err);
              console.log('');
              warning_message('Program scanner error');
            } else {
              if(result.length > 0){

                var station = result[0].number;
                  sql = "SELECT * FROM temp_production WHERE npk_op IS NOT NULL AND part_name IS NOT NULL";
                  con001.query(sql, function(err, result){
                    if (err) throw err;

                    if(result.length > 0){
                      if(result[0].count_qty_oem == 0){
                        console.log('Counting quantity oem sudah habis');
                        console.log("");
                        warning_message('Counting quantity oem sudah habis');
                      }else if(result[0].count_qty_exp == 0){
                        console.log('Counting quantity export sudah habis');
                        console.log("");
                        warning_message('Counting quantity export sudah habis');
                      }else{
                        // sql = "UPDATE achievement_exp SET qc_status = 'OK', status = 'waiting' WHERE qr_code = '"+data+"'";
                        // con.query(sql, function(err){
                        //   if (err) throw err;
                        // });
                        sql = "INSERT INTO achievement_exp (station_num, part_name, pn_cust, name, date_time, status) VALUES ('"+station+"', '"+result[0].part_name+"', '"+result[0].pn_cust+"', '"+result[0].npk_op+"', now(), 'waiting')";
                        conMaster.query(sql, function(err){
                          if (err) {
                            console.log(err);
                            console.log('');
                            warning_message('Program scanner error');
                          }
                        });
                        
                        sql = "UPDATE temp_production SET count_qty_oem = count_qty_oem - 1, count_qty_exp = count_qty_exp - 1";
                        con001.query(sql, function(err){
                          if (err) {
                            console.log(err);
                            console.log('');
                            warning_message('Program scanner error');
                          }
                        });

                        if(result[0].count_qty_oem == 1 || result[0].count_qty_exp == 1){
                          if(result[0].count_qty_oem == 1){
                            sql = "UPDATE temp_data_pic SET pic = NULL";
                            con001.query(sql, function(err){
                              if (err) {
                                console.log(err);
                                console.log('');
                                warning_message('Program scanner error');
                              }
                            });
                          }

                          part_name = result[0].part_name;
                          qty_exp = result[0].qty_exp;
                          pn_cust = result[0].pn_cust;
                          pic = result[0].pic;
                          if(result[0].count_qty_exp == 1){
                            sql = "SELECT * FROM uniq_code";
                            conMaster.query(sql, function (err, result) {
                              if (err) {
                                console.log(err);
                                console.log('');
                                warning_message('Program scanner error');
                              } else {
                                var date_uniqcode = new Date(result[0].date);
                                var date_now = new Date(uniq_date);
                                var year_month_last = date_uniqcode.getFullYear() + "-" + ("0" + (date_uniqcode.getMonth() + 1)).slice(-2);
                                var year_month_now = date_now.getFullYear() + "-" + ("0" + (date_now.getMonth() + 1)).slice(-2);

                                if (year_month_last < year_month_now || result[0].cycle < 1) {
                                  console.log(
                                    "Uniqcode date lessthan date now or cycle lessthan one"
                                  );
                                  sql = "UPDATE uniq_code SET cycle = 1, date = '" + date_now + "'";
                                  conMaster.query(sql, function (err) {
                                    if (err) {
                                      console.log(err);
                                      console.log('');
                                      warning_message('Program scanner error');
                                    }
                                  });
                                }

                                sql = "SELECT * FROM uniq_code";
                                conMaster.query(sql, function (err, result) {
                                  if (err) {
                                    console.log(err);
                                    console.log('');
                                    warning_message('Program scanner error');
                                  } else {
                                    var cycle = result[0].cycle;

                                    sql = "UPDATE uniq_code SET cycle = cycle + 1";
                                    conMaster.query(sql, function (err) {
                                      if (err) {
                                        console.log(err);
                                        console.log('');
                                        warning_message('Program scanner error');
                                      }
                                    });

                                    var id = ("000" + cycle).slice(-4);
                                    var uniqNum = year + month + id;
                                    var code =  pic + "_" + uniqNum;

                                    bwipjs.toBuffer(
                                      {
                                        bcid: "code128", // Barcode type
                                        text: code, // Text to encode
                                        scale: 15, // 3x scaliSng factor
                                        height: 10, // Bar height, in millimeters
                                        textxalign: "center", // Always good to set this
                                      },
                                      function (err, dataImage) {
                                        if (err) {
                                          console.log(err);
                                        } else {
                                          fs.writeFile(
                                            "C:/xampp/htdocs/boxing-qrcode/public/img/barcode/" + code + ".jpg",
                                            dataImage,
                                            function (err) {}
                                          );
                                          console.log("Generate Barcode is done!");
                                          console.log("");
                                        }
                                      }
                                    );
                                  

                                    sql = "INSERT INTO temp_data_part (data, code) VALUES ('"+pic+"', '"+code+"')";
                                    con001.query(sql, function(err){
                                      if (err) {
                                        console.log(err);
                                        console.log('');
                                        warning_message('Program scanner error');
                                      }
                                    });

                                    sql = "SELECT * FROM product_boxing_exp WHERE barcode = '"+pic+"'";
                                    conMaster.query(sql, function(err, result){
                                      if (err) {
                                        console.log(err);
                                        console.log('');
                                        warning_message('Program scanner error');
                                      } else {
                                        for (i = 0; i < qty_exp; i++) {
                                          sql =
                                            "UPDATE achievement_exp SET status = 'complete', data_part = '"+code+"' WHERE status = 'waiting' AND station_num = '"+station+"' ORDER BY id ASC LIMIT 1";
                                          conResult.query(sql, function (err) {
                                            if (err) {
                                              console.log(err);
                                              console.log('');
                                              warning_message('Program scanner error');
                                            }
                                          });
                                        }
                                      }
                                    });
                                  }
                                });
                              }
                            });
                          }
                        }
                      }
                      ok_message('QR-code label berhasil di scan');
                    } else {
                      console.log('Data produk tidak ditemukan');
                      console.log("");
                      warning_message('Data produk tidak ditemukan');
                    }
                    
                    // ok_message('QR-code label berhasil di scan');
                  });
                }
              }
            })
        //   }else{
        //     console.log('Produk sudah di scan');
        //     console.log("");
        //     warning_message('Produk sudah di scan');
        //   }
        // }else{
        //   console.log('Produk tidak ditemukan di database');
        //   console.log("");
        //   warning_message('Produk tidak ditemukan di database');
        // }
      // });
    }else if(data.length > 20){
      console.log('Ini Data Part Local');
      console.log("");
      var data_ori = data;
      var data = data.substring(8);
      // Hasilnya part number API
      console.log(data);
      
      // sql = "SELECT * FROM trash_data_part WHERE code = '" + data_ori + "'";
      // con.query(sql, function (err, result) {
      //   if (err) {
      //     console.log(err);
      //     console.log('');
      //     warning_message('Program scanner error');
      //   } else {
          // if(result.length == 0){
            sql = "SELECT * FROM product_boxing_exp WHERE pn_api_oem = '" + data + "'";
            conMaster.query(sql, function (err, result) {
              if (err) {
                console.log(err);
                console.log('');
                warning_message('Program scanner error');
              } else {
                if(result.length == 2){
                  console.log('Data Part Lokal berhasil di scan');
                  console.log('');
                  ok_message('Data Part Lokal berhasil di scan');
                  
                  // var compare1L = result[0].part_name.search('(1L)');
                  // var compare1N = result[1].part_name.search('(1N)');
                  var compare1L = result[0].dock;
                  var compare1N = result[1].dock;

                  var partName1L, partName1N, barcode1L, barcode1N;
                  if(compare1L == '1L'){
                    partName1L = result[0].part_name;
                    barcode1L = result[0].barcode;
                  }else{
                    partName1L = result[1].part_name;
                    barcode1L = result[1].barcode;
                  }

                  if(compare1N == '1N'){
                    partName1N = result[1].part_name;
                    barcode1N = result[1].barcode;
                  }else{
                    partName1N = result[0].part_name;
                    barcode1N = result[0].barcode;
                  }

                  sql = "UPDATE qty_type SET data_part = 'local', part_name_1L = '"+partName1L+"', part_name_1N = '"+partName1N+"', barcode_1L = '"+barcode1L+"', barcode_1N = '"+barcode1N+"'";
                  con001.query(sql, function (err) {
                    if (err) {
                      console.log(err);
                      console.log('');
                      warning_message('Program scanner error');
                    }
                  });
                } else if (result.length > 0) {
                  sql = "UPDATE pokayoke_data_part SET local = '"+result[0].barcode+"'";
                  con001.query(sql, function (err) {
                    if (err) {
                      console.log(err);
                      console.log('');
                      warning_message('Program scanner error');
                    }
                  });

                  // sql = "INSERT INTO trash_data_part (code) VALUES ('"+data_ori+"')";
                  // con.query(sql, function (err) {
                  //   if (err) throw err;
                  // });
                  
                  console.log('Data Part Lokal berhasil di scan');
                  console.log('');
                  ok_message('Data Part Lokal berhasil di scan');
                } else {
                    console.log('Produk tidak ditemukan di database');
                    console.log("");
                    warning_message('Produk tidak ditemukan di database');
                }
              }
            });
          // }else{
          //   console.log('Data part sudah di-scan');
          //   console.log("");
          //   warning_message('Data part sudah di-scan');
          // }
        // }
      // });
    } else {
      console.log("");
      console.log('Ini Data Part Shopping');
      var data = data.substring(0, 12)
      // Hasilnya part number customer
      console.log(data);

      sql = "SELECT * FROM product_boxing_exp WHERE barcode LIKE '%" + data + "%'";
      conMaster.query(sql, function (err, result) {
        if (err) {
          console.log(err);
          console.log('');
          warning_message('Program scanner error');
        } else {
          if(result.length == 2){
            console.log('Data Part Shopping berhasil di scan');
            console.log('');
            ok_message('Data Part Shopping berhasil di scan');

            // var compare1L = result[0].part_name.search('(1L)');
            // var compare1N = result[1].part_name.search('(1N)');
            var compare1L = result[0].dock;
            var compare1N = result[1].dock;

            var partName1L, partName1N, barcode1L, barcode1N;
            if(compare1L == '1L'){
              partName1L = result[0].part_name;
              barcode1L = result[0].barcode;
            }else{
              partName1L = result[1].part_name;
              barcode1L = result[1].barcode;
            }

            if(compare1N == '1N'){
              partName1N = result[1].part_name;
              barcode1N = result[1].barcode;
            }else{
              partName1N = result[0].part_name;
              barcode1N = result[0].barcode;
            }

            sql = "UPDATE qty_type SET data_part = 'shopping', part_name_1L = '"+partName1L+"', part_name_1N = '"+partName1N+"', barcode_1L = '"+barcode1L+"', barcode_1N = '"+barcode1N+"'";
            con001.query(sql, function (err) {
              if (err) {
                console.log(err);
                console.log('');
                warning_message('Program scanner error');
              }
            });
          } else if (result.length > 0) {
            console.log('Data Part Shopping berhasil di scan');
            console.log('');
            ok_message('Data Part Shopping berhasil di scan');
            
            sql = "UPDATE pokayoke_data_part SET shopping = '"+result[0].barcode+"'";
            con001.query(sql, function (err) {
              if (err) {
                console.log(err);
                console.log('');
                warning_message('Program scanner error');
              }
            });
          } else {
              console.log('Produk tidak ditemukan di database');
              console.log("");
              warning_message('Produk tidak ditemukan di database');
          }
        }
      });
    }
  });

  port.on("close", function () {
    console.log("SCANNER PORT CLOSED");
    reconnectScanner();
  });

  port.on("error", function (err) {
    console.error("error", err);
    reconnectScanner();
  });
};

connectScanner();

// check for connection errors or drops and reconnect
var reconnectScanner = function () {
  console.log("INITIATING RECONNECT");
  setTimeout(function () {
    console.log("RECONNECTING TO SCANNER");
    warning_message("RECONNECTING TO SCANNER");
    connectScanner();
  }, 2000);
};

var connectButton = function () {
  // Defining the serial port
  const port = new SerialPort("COM4", {
    baudRate: 9600,
    dataBits: 8,
    parity: "none",
    stopBits: 1,
  });

  //Readline
  const parser = port.pipe(new Readline({ delimiter: "\r\n" }));

  parser.on("data", function (data) {
    console.log("Data is: ", data);
    console.log("");

    var d = new Date();
    var uniq_date = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
    var year = String(d.getFullYear()).substring(2, 4);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    
    if(data == 'Button print qr-code ditekan'){
    // if(data == 'Button print ditekan'){
      // sql = "INSERT INTO button (action) VALUES ('print')";
      // con.query(sql, function (err) {
      //     if (err) throw err;
      // });

      sql = "SELECT * FROM station";
      con001.query(sql, function(err, result){
        if (err) {
          console.log(err);
          console.log('');
          warning_message('Program scanner error');
        } else {
          if(result.length > 0){

            var station = result[0].number;

            sql = "SELECT * FROM temp_production WHERE npk_op IS NOT NULL AND part_name IS NOT NULL";
            con001.query(sql, function(err, result){
              if (err) {
                console.log(err);
                console.log('');
                warning_message('Program scanner error');
              } else {
                if(result.length > 0){
                  if(result[0].count_qty_oem == 0){
                    console.log('Counting quantity oem sudah habis');
                    console.log("");
                    warning_message('Counting quantity oem sudah habis');
                  }else if(result[0].count_qty_exp == 0){
                    console.log('Counting quantity export sudah habis');
                    console.log("");
                    warning_message('Counting quantity export sudah habis');
                  }else{
                    // sql = "UPDATE achievement_exp SET qc_status = 'OK', status = 'waiting' WHERE qr_code = '"+data+"'";
                    // con.query(sql, function(err){
                    //   if (err) throw err;
                    // });
                    
                    sql = "INSERT INTO achievement_exp (station_num, part_name, pn_cust, name, date_time, status) VALUES ('"+station+"', '"+result[0].part_name+"', '"+result[0].pn_cust+"', '"+result[0].npk_op+"', now(), 'waiting')";
                    conResult.query(sql, function(err){
                      if (err) {
                        console.log(err);
                        console.log('');
                        warning_message('Program scanner error');
                      }
                    });
                    
                    sql = "UPDATE temp_production SET count_qty_oem = count_qty_oem - 1, count_qty_exp = count_qty_exp - 1";
                    con001.query(sql, function(err){
                      if (err) {
                        console.log(err);
                        console.log('');
                        warning_message('Program scanner error');
                      }
                    });

                    if(result[0].count_qty_oem == 1 || result[0].count_qty_exp == 1){
                      if(result[0].count_qty_oem == 1){
                        sql = "UPDATE temp_data_pic SET pic = NULL";
                        con001.query(sql, function(err){
                          if (err) {
                            console.log(err);
                            console.log('');
                            warning_message('Program scanner error');
                          }
                        });
                      }

                      part_name = result[0].part_name;
                      qty_exp = result[0].qty_exp;
                      pn_cust = result[0].pn_cust;
                      pic = result[0].pic;
                      if(result[0].count_qty_exp == 1){
                        sql = "SELECT * FROM uniq_code";
                        conMaster.query(sql, function (err, result) {
                          if (err) {
                            console.log(err);
                            console.log('');
                            warning_message('Program scanner error');
                          }

                          var date_uniqcode = new Date(result[0].date);
                          var date_now = new Date(uniq_date);
                          var year_month_last = date_uniqcode.getFullYear() + "-" + ("0" + (date_uniqcode.getMonth() + 1)).slice(-2);
                          var year_month_now = date_now.getFullYear() + "-" + ("0" + (date_now.getMonth() + 1)).slice(-2);

                          if (year_month_last < year_month_now || result[0].cycle < 1) {
                            console.log(
                              "Uniqcode date lessthan date now or cycle lessthan one"
                            );
                            sql = "UPDATE uniq_code SET cycle = 1, date = '" + date_now + "'";
                            conMaster.query(sql, function (err) {
                              if (err) {
                                console.log(err);
                                console.log('');
                                warning_message('Program scanner error');
                              }
                            });
                          }

                          sql = "SELECT * FROM uniq_code";
                          conMaster.query(sql, function (err, result) {
                            if (err) {
                              console.log(err);
                              console.log('');
                              warning_message('Program scanner error');
                            } else {
                              var cycle = result[0].cycle;

                              sql = "UPDATE uniq_code SET cycle = cycle + 1";
                              conMaster.query(sql, function (err) {
                                if (err) {
                                  console.log(err);
                                  console.log('');
                                  warning_message('Program scanner error');
                                }
                              });

                              var id = ("000" + cycle).slice(-4);
                              var uniqNum = year + month + id;
                              var code =  pic + "_" + uniqNum;

                              bwipjs.toBuffer(
                                {
                                  bcid: "code128", // Barcode type
                                  text: code, // Text to encode
                                  scale: 15, // 3x scaliSng factor
                                  height: 10, // Bar height, in millimeters
                                  textxalign: "center", // Always good to set this
                                },
                                function (err, dataImage) {
                                  if (err) {
                                    console.log(err);
                                  } else {
                                    fs.writeFile(
                                      "C:/xampp/htdocs/001/public/img/barcode/" + code + ".jpg",
                                      dataImage,
                                      function (err) {}
                                    );
                                    console.log("Generate Barcode is done!");
                                    console.log("");
                                  }
                                }
                              );
                            

                              sql = "INSERT INTO temp_data_part (data, code) VALUES ('"+pic+"', '"+code+"')";
                              con001.query(sql, function(err){
                                if (err) {
                                  console.log(err);
                                  console.log('');
                                  warning_message('Program scanner error');
                                }
                              });

                              sql = "SELECT * FROM product_boxing_exp WHERE barcode = '"+pic+"'";
                              conMaster.query(sql, function(err, result){
                                if (err) {
                                  console.log(err);
                                  console.log('');
                                  warning_message('Program scanner error');
                                } else {
                                  for (i = 0; i < qty_exp; i++) {
                                    sql =
                                      "UPDATE achievement_exp SET status = 'complete', data_part = '"+code+"' WHERE status = 'waiting' AND station_num = '"+station+"' ORDER BY id ASC LIMIT 1";
                                    conResult.query(sql, function (err) {
                                      if (err) {
                                        console.log(err);
                                        console.log('');
                                        warning_message('Program scanner error');
                                      }
                                    });
                                  }
                                }
                              });
                            }
                          });
                        });
                      }
                    }
                  }
                  // ok_message('Push button berhasil ditekan');
                } else {
                  console.log('Data produk tidak ditemukan');
                  console.log("");
                  warning_message('Data produk tidak ditemukan');
                }
              }
              // ok_message('QR-code label berhasil di scan');
            });
          }
        }
      });
    }
  });

  port.on("close", function () {
    console.log("BUTTON PORT CLOSED");
    reconnectButton();
  });

  port.on("error", function (err) {
    console.error("error", err);
    reconnectButton();
  });
};

connectButton();

// check for connection errors or drops and reconnect
var reconnectButton = function () {
  console.log("INITIATING RECONNECT");
  setTimeout(function () {
    console.log("RECONNECTING TO BUTTON");
    warning_message("RECONNECTING TO BUTTON");
    connectButton();
  }, 2000);
};

function warning_message(message){
  sql = "INSERT INTO warning_message (text) VALUES ('" + message + "')";
  con001.query(sql, function (err) {
    if (err) {
      console.log(err);
      console.log('');
      warning_message('Program scanner error');
    }
  });
}

function ok_message(message){
  sql = "INSERT INTO ok_message (text) VALUES ('" + message + "')";
  con001.query(sql, function (err) {
    if (err) {
      console.log(err);
      console.log('');
      warning_message('Program scanner error');
    }
  });
}
