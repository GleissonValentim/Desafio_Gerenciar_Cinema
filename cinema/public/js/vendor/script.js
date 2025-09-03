$(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    // Cadastrar filme
    $(document).on('submit', '#cadastrar_filme', function(e){
        e.preventDefault();
        $.ajax({
            url: 'http://127.0.0.1:8000/adm/filmes',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.mensagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.mensagem,
                    icon: "success",
                    draggable: true
                }).then(() => {
                    location.reload();
                });
            }
        })
    });

    // script para deletar um filme
    $(document).on('click', '.apagar_filme', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        let token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#207ae0ff",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, apague!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/adm/filmes/' + del + '/destroy',
                    type: 'DELETE',
                    data:{
                        _token: token,
                        del: del
                    }
                }).done(function(data){
                    if(data.erro == true){
                        Swal.fire({
                            title: "Erro",
                            text: data.mensagem,
                            icon: "error"
                        });
                    } else {
                    if (result.isConfirmed) {
                            Swal.fire({
                            title: "Deletado!",
                            text: data.mensagem,
                            icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                })
            }
        });
    });

    // script para atualizar um filme
    $(document).on('click', '.atualizar_filme', function(e){
        e.preventDefault();
        var edit = $(this).attr("id");
        let token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/adm/filmes',
            type: 'POST',
            data:{
                _token: token,
                edit: edit
            }
        })
    });

    // Cadastrar Sala
    $(document).on('submit', '#cadastrar_sala', function(e){
        e.preventDefault();
        $.ajax({
            url: 'http://127.0.0.1:8000/adm/salas',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.mensagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.mensagem,
                    icon: "success",
                    draggable: true
                }).then(() => {
                    location.reload();
                });
            }
        })
    });

    // script para deletar uma sala
    $(document).on('click', '.apagar_sala', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        let token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#207ae0ff",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, apague!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/adm/salas/' + del + '/destroy',
                    type: 'DELETE',
                    data:{
                        _token: token,
                        del: del
                    }
                }).done(function(data){
                    if(data.erro == true){
                        Swal.fire({
                            title: "Erro",
                            text: data.mensagem,
                            icon: "error"
                        });
                    } else {
                    if (result.isConfirmed) {
                            Swal.fire({
                            title: "Deletado!",
                            text: data.mensagem,
                            icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                })
            }
        });
    });

    // Cadastrar sessao
    $(document).on('submit', '#cadastrar_sessao', function(e){
        e.preventDefault();
        $.ajax({
            url: 'http://127.0.0.1:8000/adm/sessoes',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.mensagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.mensagem,
                    icon: "success",
                    draggable: true
                }).then(() => {
                    location.reload();
                });
            }
        })
    });

    // script para deletar uma sessão
    $(document).on('click', '.apagar_sessao', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        let token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#207ae0ff",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, apague!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/adm/sessoes/' + del + '/destroy',
                    type: 'DELETE',
                    data:{
                        _token: token,
                        del: del
                    }
                }).done(function(data){
                    if(data.erro == true){
                        Swal.fire({
                            title: "Erro",
                            text: data.mensagem,
                            icon: "error"
                        });
                    } else {
                    if (result.isConfirmed) {
                            Swal.fire({
                            title: "Deletado!",
                            text: data.mensagem,
                            icon: "success"
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                })
            }
        });
    });
});
