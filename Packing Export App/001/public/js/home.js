$.getScript("http://10.14.178.79/001/public/js/template.js", function () {
  $("#btn-setting-qrcode").on("click", function () {
    var url = BASEURL + "/home/getMarginQrcode";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);
        $("#left-qrcode").val(data.left_qrcode);
        $("#up-qrcode").val(data.up_qrcode);
        $("#left-label").val(data.left_label);
        $("#up-label").val(data.up_label);
        $("#darkness").val(data.darkness);
      },
    });
  });

  $("#btn-input").on("click", function () {
    var url = BASEURL + "/home/getTempQty";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);
        $("#val-qty-oem").val(data.count_qty_oem);
        $("#val-qty-exp").val(data.count_qty_exp);
        $("#set-qty-oem").val(0);
        $("#set-qty-exp").val(0);
      },
    });
  });

  $("#form-setting").on("submit", function (e) {
    var data = {
      "left-qrcode": $("#left-qrcode").val(),
      "up-qrcode": $("#up-qrcode").val(),
      "left-label": $("#left-label").val(),
      "up-label": $("#up-label").val(),
      darkness: $("#darkness").val(),
    };
    var url = BASEURL + "/home/setMarginQrcode";

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, update it!",
      cancelButtonText: "No, cancel it!",
    }).then(function (isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          type: "post",
          url: url,
          data: data,
          dataType: "json",
          success: function (data) {
            if (data > 0) {
              swalOK("Setting QR-code label berhasil");
              $("#setting-margin").modal("hide");
            }
          },
        });
      }
    });

    e.preventDefault();
  });

  $("#form-input").on("submit", function (e) {
    var formData = {
      "val-qty-oem": $("#val-qty-oem").val(),
      "val-qty-exp": $("#val-qty-exp").val(),
    };
    var url = BASEURL + "/home/setTempQty";

    Swal.fire({
      title: "Are you sure?",
      text: "Qty export dan OEM akan diubah",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, update it!",
      cancelButtonText: "No, cancel it!",
    }).then(function (isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          type: "post",
          url: url,
          data: formData,
          dataType: "json",
          success: function (data) {
            // console.log(data);
            if (data > 0) {
              swalOK("Input qty OEM berhasil");
              $("#input-oem-exp").modal("hide");
            }
          },
        });
        // console.log(formData);
      }
    });

    e.preventDefault();
  });

  $("#test-print-qrcode").on("click", function () {
    var formData = {
      action: "Test-print",
    };
    var url = BASEURL + "/home/testPrintQrcode";

    $.ajax({
      type: "POST",
      url: url,
      data: formData,
      success: function (data) {
        if (data > 0) {
          swalOK("QR-code berhasil dicetak");
        }
      },
    });
  });

  // Read warning message
  setInterval(function () {
    var url = BASEURL + "/home/getWarningMessage";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        if (data != false) {
          swalNG(data.text);

          var url = BASEURL + "/home/delWarningMessage";
          var formData = {
            id: data.id,
          };

          $.ajax({
            type: "post",
            url: url,
            data: formData,
            dataType: "json",
            success: function (data) {},
          });
        }
      },
    });
  }, 1000);

  // Read ok message
  setInterval(function () {
    var url = BASEURL + "/home/getOkMessage";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        if (data != false) {
          swalOK(data.text);

          var url = BASEURL + "/home/delOkMessage";
          var formData = {
            id: data.id,
          };

          $.ajax({
            type: "post",
            url: url,
            data: formData,
            dataType: "json",
            success: function (data) {},
          });
        }
      },
    });
  }, 1000);

  // Read data pokayoke
  setInterval(function () {
    var url = BASEURL + "/home/getDataPokayoke";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);
        // if (data.part_num_local == false) {
        // $('#pn-local').val('');
        // } else {
        //   $("#pn-local").val(data.part_num_local);
        // }
        // if (data.part_num_shop == false) {
        // $('#pn-shop').val('');
        // } else {
        //   $("#pn-shop").val(data.part_num_shop);
        // }
        $("#part-name-local").val(data['pokayoke']["local"]);
        $("#part-name-shop").val(data['pokayoke']["shopping"]);

        if (
          $("#part-name-local").val() != "" &&
          $("#part-name-shop").val() != ""
        ) {
          if (data['data-part-local']['pn_cust'] == data['data-part-shopping']['pn_cust']) {
            if (data['data-part-local']['qty_exp'] == data['data-part-shopping']['qty_exp']) {
              swalOK("Data Part Sama");

              // Set data pic with part_name
              var url = BASEURL + "/home/setDataPic";
              $.ajax({
                type: "post",
                url: url,
                data: { pic: data['pokayoke']["local"] },
                dataType: "json",
                success: function (data) {},
              });

              // Set Data Temp Production
              var url = BASEURL + "/home/setDataTempProd";
              var formData = {
                barcode: data['pokayoke']["local"],
              };

              $.ajax({
                type: "post",
                url: url,
                data: formData,
                dataType: "json",
                success: function (data) {},
              });

              // Set data pokayoke with NULL value
              var url = BASEURL + "/home/setDataPokayoke";
              $.ajax({
                type: "post",
                url: url,
                success: function (data) {},
              });
            }else{
              swalNG("Data Part Tidak Sama");

              // Set data pokayoke with NULL value
              var url = BASEURL + "/home/setDataPokayoke";
              $.ajax({
                type: "post",
                url: url,
                success: function (data) {},
              });
            }
          } else {
            swalNG("Data Part Tidak Sama");

            // Set data pokayoke with NULL value
            var url = BASEURL + "/home/setDataPokayoke";
            $.ajax({
              type: "post",
              url: url,
              success: function (data) {},
            });
          }
        }
      },
    });
  }, 1000);

  // Read data user, qty export, qty oem
  setInterval(function () {
    var url = BASEURL + "/home/getDataProd";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);
        var qty_exp = data.qty_exp;

        $("#op-name").html(String(data.name));
        $("#count-qty").html(String(data.count_qty_exp));
        $("#count-qty-dom").html(String(data.count_qty_oem));
        $("#dock-code").html(String(data["dock"]));

        $("#set-qty-oem").on("input", function () {
          $("#val-qty-oem").val(
            Number(data.count_qty_oem) + Number($("#set-qty-oem").val())
          );
        });
        $("#set-qty-exp").on("input", function () {
          $("#val-qty-exp").val(
            Number(data.count_qty_exp) + Number($("#set-qty-exp").val())
          );
        });

        if (data.count_qty_exp == 0 && data.count_qty_oem > 0) {
          if (data.count_qty_oem % data.qty_exp == 0) {
            var url = BASEURL + "/home/setTempQty";
            var formData = {
              "val-qty-oem": data.count_qty_oem,
              "val-qty-exp": data.count_qty_oem,
            };

            $.ajax({
              type: "post",
              url: url,
              data: formData,
              dataType: "json",
              success: function (data) {
                // console.log(data);

                swalOK("Counting export sudah ditambahkan");
              },
            });
          }
        }
      },
    });
  }, 1000);

  // Read data pic
  setInterval(function () {
    var url = BASEURL + "/home/getDataPic";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);

        if (data.pic !== null) {
          $("#img-pic").attr("src", BASEURL + "/img/pic/" + data.pic + ".jpg");
        } else {
          $("#img-pic").attr("src", "");
        }
      },
    });
  }, 1000);

  // Print Qr-code
  $("#btn-print").on("click", function () {
    printQrcode();
  });

  // Print Data Part
  setInterval(function () {
    var url = BASEURL + "/home/cekPrintDataPart";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);

        // datetime variable
        var d = new Date();
        var datetime =
          ("0" + d.getDate()).slice(-2) +
          "/" +
          ("0" + (d.getMonth() + 1)).slice(-2) +
          "/" +
          d.getFullYear();
        var code = data.code;

        if (data != false) {
          var url = BASEURL + "/home/printDataPart";
          var id_data_part = data.id;

          $.ajax({
            type: "post",
            url: url,
            data: { id: id_data_part },
            dataType: "json",
            success: function (data) {
              // console.log(data);

              function delay(delayInms) {
                return new Promise((resolve) => {
                  setTimeout(() => {
                    resolve(2);
                  }, delayInms);
                });
              }

              async function print() {
                await delay(200);
                var printWindow = window.open("", "", "width=1, height=1");

                printWindow.document.open();

                content =
                  `
                                  <!DOCTYPE html>
                                  <html lang="en">
                                  
                                  <head>
                                      <meta charset="UTF-8">
                                      <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                      <title>Template Data Part</title>
                                  </head>
                                  
                                  <body>
                                  
                                      <h5 style="font-weight: lighter; margin-left: 30px;">PT AUTOPLASTIK INDONESIA</h5>
                                      <table style="border: 1px solid black; width: 65mm; margin-top: -12px; border-collapse: collapse;">
                                          <tr>
                                              <td style="height: 10mm; width: 25mm; font-weight: bold; border: 1px solid black;">
                                                  Addressing
                                              </td>
                                              <td style="width: 1mm; border: 1px solid black; border-right: none;"></td>
                                              <td style="font-weight: bold; font-size: 25px; border: 1px solid black; border-left: none;">
                                                ` +
                  data.address +
                  `
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style="height: 10mm; font-weight: bold; border: 1px solid black;">
                                                  Unique Code
                                              </td>
                                              <td style="width: 1mm; border: 1px solid black; border-right: none;"></td>
                                              <td style="font-weight: bold; font-size: 25px; border: 1px solid black; border-left: none;">
                                                ` +
                  data.job_num +
                  `
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style="height: 10mm; font-weight: bold; border: 1px solid black;">
                                                  Part Number
                                              </td>
                                              <td style="width: 1mm; border: 1px solid black; border-right: none;"></td>
                                              <td style="font-weight: lighter; font-size: 13px; border: 1px solid black; border-left: none;">
                                                ` +
                  data.pn_api_exp +
                  `
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style="height: 10mm; font-weight: bold; border: 1px solid black;">
                                                  Part Name
                                              </td>
                                              <td style="width: 1mm; border: 1px solid black; border-right: none;"></td>
                                              <td style="font-weight: lighter; font-size: 13px; border: 1px solid black; border-left: none;">
                                                ` +
                  data.part_name +
                  `
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style="height: 10mm; font-weight: bold; border: 1px solid black;">
                                                  Qty/box
                                              </td>
                                              <td style="width: 1mm; border: 1px solid black; border-right: none;"></td>
                                              <td style="font-weight: lighter; font-size: 13px; border: 1px solid black; border-left: none;">
                                                ` +
                  data.qty_exp +
                  ` - (` +
                  data["dock"] +
                  `)` +
                  `
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style="height: 10mm; font-weight: bold; border: 1px solid black;">
                                                  NPK Operator
                                              </td>
                                              <td style="width: 1mm; border: 1px solid black; border-right: none;"></td>
                                              <td style="font-weight: lighter; font-size: 13px; border: 1px solid black; border-left: none;">
                                                ` +
                  data.npk_op +
                  `
                                              </td>
                                          </tr>
                                          <tr>
                                              <td colspan="3" style="height: 10mm; font-weight: bold; border: 1px solid black; text-align: center;">
                                                  <img src="http://10.14.178.79/001/public/img/barcode/` +
                  code +
                  `.jpg" width="200px" alt="">
                                              </td>
                                          </tr>
                                  
                                      </table>
                                      <table style="width: 65mm;">
                                          <tr>
                                              <td style="width: 25mm; height: 5mm; border-bottom: none; border-left: none;">
                                  
                                              </td>
                                              <td style="font-weight: bold; font-size: 14px; text-align: center; border-bottom: none; border-right: none;">
                                                ` +
                  datetime +
                  `
                                              </td>
                                          </tr>
                                      </table>
                                  </body>
                                  
                                  </html>
                                `;

                printWindow.document.write(content);

                printWindow.document.close();

                await delay(300);
                printWindow.print();
                await delay(300);

                var url = BASEURL + "/home/delPrintDataPart";
                var formData = {
                  id: id_data_part,
                  code: code,
                };

                $.ajax({
                  type: "post",
                  url: url,
                  data: formData,
                  dataType: "json",
                  success: function (data) {
                    // console.log(data);
                  },
                });

                setTimeout(function () {
                  printWindow.close();
                }, 1000);
              }
              print();
            },
          });
        }
      },
    });
  }, 2000);

  // Delete Data
  $("#btn-delete").on("click", function () {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, update it!",
      cancelButtonText: "No, cancel it!",
    }).then(function (isConfirm) {
      if (isConfirm.value) {
        var url = BASEURL + "/home/setDataTempProdExcNpk";

        $.ajax({
          type: "post",
          url: url,
          dataType: "json",
          success: function (data) {
            console.log(data);

            if (data > 0) {
              swalOK("Data produk berhasil dihapus");
            }
          },
        });
      }
    });
  });

  // Read button print
  setInterval(function () {
    var url = BASEURL + "/home/readBtnPrintQrcode";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);
        if (data != false) {
          printQrcode();

          var url = BASEURL + "/home/delPrintQrcode";

          $.ajax({
            type: "post",
            url: url,
            data: { id: data.id },
            dataType: "json",
            success: function (data) {
              // console.log(data);
              // if(data > 0){
              //     swalOK('QR-code label berhasil di cetak');
              // }
            },
          });
        }
      },
    });
  }, 1000);

  // Choose qty type
  setInterval(function () {
    var url = BASEURL + "/home/readQtyType";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);

        if (data["data_part"] != null) {
          var url = BASEURL + "/home/getQtyOfType";
          var formData = {
            "barcode-1L": data["barcode_1L"],
            "barcode-1N": data["barcode_1N"],
          };

          $.ajax({
            type: "post",
            url: url,
            data: formData,
            dataType: "json",
            success: function (data) {
              // console.log(data.qty_1L);

              $("#qty-1L").html("1L (" + data.qty_1L + ")");
              $("#qty-1N").html("1N (" + data.qty_1N + ")");
              $("#qty-type").modal("show");
            },
          });
        } else {
          $("#qty-type").modal("hide");
        }
      },
    });
  }, 1000);

  // Button choose qty type
  $("#qty-1L").on("click", function () {
    var url = BASEURL + "/home/btnQtyType";

    $.ajax({
      type: "post",
      url: url,
      data: { type: "1L" },
      dataType: "json",
      success: function (data) {
        // console.log(data);
      },
    });
  });
  $("#qty-1N").on("click", function () {
    var url = BASEURL + "/home/btnQtyType";

    $.ajax({
      type: "post",
      url: url,
      data: { type: "1N" },
      dataType: "json",
      success: function (data) {
        // console.log(data);
      },
    });
  });

  $("#body-content").keypress(function (e) {
    var key = e.which;
    // if (key == 13) // the enter key code
    if (key == 32) {
      // the enter key code
      $("#form-input").submit();
      // $('#btn-print').click();
      // console.log('98');
      return false;
    }

    // if (key == 37) {
    //   console.log('37');
    //   return false;
    // }

    // if (key == 8) {
    //   console.log('8');
    //   return false;
    // }

  });

  function printQrcode() {
    var url = BASEURL + "/home/validationPrintQrcode";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);

        if (data.pn_cust === null) {
          swalNG("Data produk tidak ditemukan");
        } else if (data.count_qty_oem == 0) {
          swalNG("Counting quantity oem sudah habis");
        } else if (data.count_qty_exp == 0) {
          swalNG("Counting quantity export sudah habis");
        } else {
          var url = BASEURL + "/home/printQrcode";

          $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
              console.log(data);

              swalOK("QR-code berhasil dicetak");
            },
          });
        }
      },
    });
  }
});
