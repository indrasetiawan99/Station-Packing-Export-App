function swalNG(message){
    Swal.fire({
        title: "Error!",
        text: message,
        icon: "error",
        confirmButtonText: "OK",
    })
}

function swalOK(message){
    Swal.fire({
        title: "Success!",
        text: message,
        icon: "success",
        showConfirmButton: false,
        timer: 1000
    })
}

function getValues(form) {
    var listvalues = new Array();
    var datastring = $("#" + form).serializeArray();
    var data = "{";
    for (var x = 0; x < datastring.length; x++) {
        if (data == "{") {
            data += "\"" + datastring[x].name + "\": \"" + datastring[x].value + "\"";
        }
        else {
            data += ",\"" + datastring[x].name + "\": \"" + datastring[x].value + "\"";
        }
    }
    data += "}";
    data = JSON.parse(data);
    // listvalues.push(data);
    // return listvalues;
    // return data['nim-murid'];
    return data;
};

var BASEURL = 'http://10.14.178.79/001/public';