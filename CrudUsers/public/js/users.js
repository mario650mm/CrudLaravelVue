// Código de vue
Vue.component('edit-user', {
    template: '#edit-user-template',
    props: ['d_type_users', 'd_user'],
    data: function () {
        return {
            user_types: [],
            user: {}
        };
    },
    methods: {
        enviar: function (event) {
            event.preventDefault();
            var url = window.urlGeneral;
            var data = new FormData(document.getElementById('userForm'));
            console.log(url);
            $.ajax({
                method: "post",
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data["result"] == "ok") {
                        if(url == window.urlValidation){
                            window.location = window.urlIndex+"/create"+"/"+data["user"];
                        }else{
                            window.location = window.urlIndex+"/update"+"/"+data["user"];
                        }
                    }
                },
                error: function (error) {
                    var json = JSON.parse(error.responseText);
                    $.each(json,function (key,value) {
                        $("#errorMessage").append("<p>"+value+"</p>");
                        setTimeout(function () {
                            $("#errorMessage").show('fast');
                        },200);
                        setTimeout(function () {
                            $("#errorMessage").hide('fast');
                        },5000);
                    });
                    console.clear();
                }
            });
        }
    },
    created: function () {
        this.user_types = JSON.parse(this.d_type_users);
        if (this.d_user.length > 0) {
            this.user = JSON.parse(this.d_user);
        }
    }

});

var vm = new Vue({
    el: '#user'
});

//Código de Jquery
$(document).on("change", "#image", function () {
    var lblImage = $("#lblImage");
    lblImage.html("");
    if (typeof (FileReader) != "undefined") {
        lblImage.html("Imagen cargada");
        var loadImage = $("#loadImage");
        loadImage.empty();
        var reader = new FileReader();
        reader.onload = function (e) {
            $("<img />", {"src": e.target.result, "class": "thumb-image","width":"150px","height":"200px"}).appendTo(loadImage);
        }
        loadImage.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else {
        $("#imgValidation").html("Formato de imagen no soportado");
        setTimeout(function () {
            $("#imgValidation").show('fast');
        }, 200);
        setTimeout(function () {
            $("#imgValidation").hide('fast');
        },4000);
    }
});