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
            url: '/adm/filmes/' + edit + '/edit',
            type: 'GET',
            data:{
                _token: token,
                edit: edit
            }
        }).done(function(data){

            data.forEach(function(item) {
                $('#editar_filme').val(item.id);
                $('#edit_titulo').val(item.titulo);
                $('#edit_descricao').val(item.descricao);
                $('#edit_data').val(item.data);
                $('#edit_genero').val(item.genero);
                $('#edit_classificacao').val(item.classificacao);
            });
        })
    });

    // script para editar um filme
    $(document).on('submit', '#editar_filme', function(e){
        e.preventDefault();

        var filme = $('#editar_filme').val();
        var titulo = $('#edit_titulo').val();
        var descricao = $('#edit_descricao').val();
        var data = $('#edit_data').val();
        var genero = $('#edit_genero').val();
        var classificacao = $('#edit_classificacao').val();
        let token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/adm/filmes/' + filme + '/update',
            method: 'POST',
            data: {
                filme: filme,
                titulo: titulo,
                descricao: descricao,
                data: data,
                genero: genero,
                classificacao: classificacao,
                _token: token
            }
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

    // script para atualizar uma sala
    $(document).on('click', '.atualizar_sala', function(e){
        e.preventDefault();
        var edit = $(this).attr("id");
        let token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/adm/salas/' + edit + '/edit',
            type: 'GET',
            data:{
                _token: token,
                edit: edit
            }
        }).done(function(data){

            data.forEach(function(item) {
                $('#editar_sala').val(item.id);
                $('#edit_nome').val(item.nome);
                $('#edit_capacidade').val(item.capacidade);
            });
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

    // script para atualizar uma sessao
    $(document).on('click', '.atualizar_sessao', function(e){
        e.preventDefault();
        var edit = $(this).attr("id");
        let token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/adm/sessoes/' + edit + '/edit',
            type: 'GET',
            data:{
                _token: token,
                edit: edit
            }
        }).done(function(data){

            console.log(data)

            data.forEach(function(item) {
                $('#editar_sessao').val(item.id);
                $('#edit_horario').val(item.horario);
                $('#edit_movie').val(item.movies_id);
                $('#edit_sala_id').val(item.rooms_id);
                $('#edit_preco').val(item.preco);
                $('#edit_sessao_data').val(item.data);
            });
        })
    });
});
