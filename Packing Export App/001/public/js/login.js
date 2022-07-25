$.getScript("http://10.14.178.79/001/public/js/template.js", function(){

    $('.signin-form').on('submit', function(e){
        if($('#username').val() == ''){
            swalNG('Username belum di isi');
        } else if($('#password').val() == ''){
            swalNG('Password belum di isi');
        } else {
            var data = {
                'username':  $('#username').val(),
                'password': $('#password').val()
            };
            var url = BASEURL + '/login/loginValidation';

            $.ajax({
                type: 'post',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    if(data['errLogin'] == 'no'){
                        location.replace(
                            BASEURL + '/Home/index'
                        );
                    } else {
                        swalNG('Username atau password tidak terdaftar');
                    }
                },
            });
        }

        e.preventDefault();
    });

});