$.getScript("http://10.14.178.79/001/public/js/template.js", function () {
  // Read warning message
  setInterval(function () {
    var url = BASEURL + "/Shop/getWarningMessage";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        if (data != false) {
          document.getElementById("ng-sound").play();
          swalNG(data.text);

          var url = BASEURL + "/Shop/delWarningMessage";
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
    var url = BASEURL + "/Shop/getOkMessage";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        if (data != false) {
          // document.getElementById("ok-sound").play();
          swalOK(data.text);

          var url = BASEURL + "/Shop/delOkMessage";
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
    var url = BASEURL + "/Shop/getDataPokayoke";
    var formData = {};

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);
        $("#api-part-name").html(data["prod-api"]["part_name"]);
        $("#api-pn-cust").html(data["prod-api"]["pn_cust"]);
        $("#api-pn-api").html(data["prod-api"]["pn_api_exp"]);
        $("#cust-part-name").html(data["prod-cust"]["part_name"]);
        $("#cust-pn-cust").html(data["prod-cust"]["pn_cust"]);
        $("#cust-pn-api").html(data["prod-cust"]["pn_api_exp"]);

        if (
          data["pokayoke"]["api"] != null &&
          data["pokayoke"]["cust"] != null
        ) {
          if (data["prod-api"]["pn_cust"] == data["prod-cust"]["pn_cust"]) {
            if (data["prod-api"]["qty_exp"] == data["prod-cust"]["qty_exp"]) {
              document.getElementById("ok-sound").play();
              swalOK("Data part sama");
              $("#api-part-name").html("-");
              $("#api-pn-cust").html("-");
              $("#api-pn-api").html("-");
              $("#cust-part-name").html("-");
              $("#cust-pn-cust").html("-");
              $("#cust-pn-api").html("-");
              formData = {
                hasil: "OK",
                kanban_api: data["pokayoke"]["api"],
                kanban_cust: data["pokayoke"]["cust"],
              };
              setHistPokayoke(formData);

              var url = BASEURL + "/Shop/updateProduct";
              $.ajax({
                type: "post",
                url: url,
                data: { uniq: data["pokayoke"]["uniq"] },
                dataType: "json",
                success: function (data) {},
              });

              // Set data pokayoke with NULL value
              var url = BASEURL + "/Shop/resetPokayoke";
              $.ajax({
                type: "post",
                url: url,
                dataType: "json",
                success: function (data) {
                  console.log(data);
                },
              });
            } else {
              document.getElementById("ng-sound").play();
              swalNG("Data part tidak sama");
              $("#api-part-name").html("-");
              $("#api-pn-cust").html("-");
              $("#api-pn-api").html("-");
              $("#cust-part-name").html("-");
              $("#cust-pn-cust").html("-");
              $("#cust-pn-api").html("-");
              formData = {
                hasil: "NG",
                kanban_api: data["pokayoke"]["api"],
                kanban_cust: data["pokayoke"]["cust"],
              };
              setHistPokayoke(formData);

              // Locked App
              var url = BASEURL + "/Shop/manageApp";
              $.ajax({
                type: "post",
                url: url,
                data: { status: "locked" },
                dataType: "json",
                success: function (data) {},
              });

              // Set data pokayoke with NULL value
              var url = BASEURL + "/Shop/resetPokayoke";
              $.ajax({
                type: "post",
                url: url,
                success: function (data) {},
              });
            }
          } else {
            document.getElementById("ng-sound").play();
              swalNG("Data part tidak sama");
              $("#api-part-name").html("-");
              $("#api-pn-cust").html("-");
              $("#api-pn-api").html("-");
              $("#cust-part-name").html("-");
              $("#cust-pn-cust").html("-");
              $("#cust-pn-api").html("-");
              formData = {
                hasil: "NG",
                kanban_api: data["pokayoke"]["api"],
                kanban_cust: data["pokayoke"]["cust"],
              };
              setHistPokayoke(formData);

              // Locked App
              var url = BASEURL + "/Shop/manageApp";
              $.ajax({
                type: "post",
                url: url,
                data: { status: "locked" },
                dataType: "json",
                success: function (data) {},
              });

              // Set data pokayoke with NULL value
              var url = BASEURL + "/Shop/resetPokayoke";
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

  // Read qty
  setInterval(function () {
    var url = BASEURL + "/Shop/getCountQty";

    $.ajax({
      type: "post",
      url: url,
      dataType: "json",
      success: function (data) {
        // console.log(data);

        $("#lbl-qty").html(String(data.qty));
      },
    });
  }, 1000);

  $("#form-input").on("submit", function (e) {
    var url = BASEURL + "/Shop/setCountQty";
    var formData = getValues("form-input");
    // console.log(formData);

    $.ajax({
      type: "post",
      url: url,
      data: formData,
      dataType: "json",
      success: function (data) {
        if (data > 0) {
          $("#val-qty-box").val(0);
          $("#input-qty").modal("toggle");
        }
      },
    });

    e.preventDefault();
  });

  $("#btn-delete").on("click", function () {
    var url = BASEURL + "/Shop/delPokayoke";

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
          dataType: "json",
          success: function (data) {
            swalOK("Data berhasil dihapus");
            location.replace(BASEURL + "/Shop/index");
          },
        });
      }
    });
  });

  $("#btn-unlock").on("click", function () {
    // Unlocked App
    var url = BASEURL + "/Shop/manageApp";
    $.ajax({
      type: "post",
      url: url,
      data: { status: "normal" },
      dataType: "json",
      success: function (data) {
        swalOK("Pengunci aplikasi berhasil dibuka");
      },
    });
  });

  function setHistPokayoke(formData) {
    var url = BASEURL + "/Shop/setHistPokayoke";
    $.ajax({
      type: "post",
      url: url,
      data: formData,
      dataType: "json",
      success: function (data) {},
    });
  }
});
