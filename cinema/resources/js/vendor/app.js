import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    // Cadastrar filme
    $(document).on('submit', '#cadastrar_filme', function(e){
        e.preventDefault();
        console.log("eu")
        $.ajax({
            url: 'http://127.0.0.1:8000/adm',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });
});