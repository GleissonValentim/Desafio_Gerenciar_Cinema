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
                $('#identificador').val(item.id);
                $('#edit_titulo').val(item.titulo);
                $('#edit_descricao').val(item.descricao);
                $('#edit_data').val(item.data);
                $('#edit_genero').val(item.genero);
                $('#edit_classificacao').val(item.classificacao);
                $('#edit_duracao').val(item.duracao);
            });
        })
    });

    // script para editar um filme
    $(document).on('submit', '#editar_filme', function(e){
        e.preventDefault();

        $.ajax({
            url: '/adm/filmes/update',
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
                $('#identificador_sala').val(item.id);
                $('#edit_nome').val(item.nome);
                $('#edit_capacidade').val(item.capacidade);
            });
        })
    });


    // script para editar uma sala
    $(document).on('submit', '#editar_sala', function(e){
        e.preventDefault();

        $.ajax({
            url: '/adm/salas/update',
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
                $('#identificador_sessao').val(item.id);
                $('#edit_horario').val(item.horario);
                $('#edit_movie').val(item.movies_id);
                $('#edit_sala_id').val(item.rooms_id);
                $('#edit_preco').val(item.preco);
                $('#edit_sessao_data').val(item.data);
            });
        })
    });

    // script para editar uma sessao
    $(document).on('submit', '#editar_sessao', function(e){
        e.preventDefault();

        $.ajax({
            url: '/adm/sessoes/update',
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

    // script para atualizar as salas
    var sala = null
    $(document).on('click', '.reservar_lugar', function(e){
        e.preventDefault();
        sala = $(this).attr("id");
        sessao = $(this).attr("name");
        $('.lugar').remove()
        $('.coluna').remove()

        $.ajax({
            url: '/ingressos/reservar_lugar/' + sessao,
            type: 'GET',
            data:{
                sessao: sessao
            }
        }).done(function(data){

            $('#total').val(data.capacidade)

            var cont = 0
            for(i = 0; i < data.capacidade; i++){

                var novaDiv = $('<div class="lugar" id="' + cont  + '" name="' +  sessao + '"></div>');
                cont++

                $('.lugares').append(novaDiv);
            }

            for(j = 0; j < data.itens.length; j++){
                const numeroExtraido = data.itens[j].assentos.match(/\d+/)[0];

                var assento = parseInt(numeroExtraido) - 1

                $('#' + assento +'').addClass("ocupado")
            }

            $('.reservar_lugar').css("background-color", "rgb(43, 43, 136)")

            $(".reservar_lugar").hover(
                function(){
                    $(this).css("background-color", "rgb(64, 64, 201)");
                },
                function(){ 
                    $(this).css("background-color", "rgb(43, 43, 136)"); 
                }
            );
                
            var colunas = Array.from({ length: 26 }, (_, i) => String.fromCharCode(65 + i));
            var coluna = data.capacidade / 18

            for(i = 0; i < Math.ceil(coluna); i++){
                
                var novaDiv = $('<input class="coluna" type="text" value="' + colunas[i] + '" disabled>');

                $('.colunas').append(novaDiv);
            }
        })
    });

    // script para deletar uma reserva
    $(document).on('click', '.apagar_reserva', function(e){
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
                    url: '/adm/reservas/' + del + '/destroy',
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

    // script para deletar uma reserva do cliente
    $(document).on('click', '.apagar_reserva_cliente', function(e){
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
                    url: '/clientes/reservas/' + del + '/destroy',
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

    var assentos = []
    var sessao = 0
    $(document).on('click', '.lugar', function(e){
        e.preventDefault();
        var assento = $(this).attr("id");
        sessao = $(this).attr("name");
        assentoIgual = false

        var colunas = Array.from({ length: 26 }, (_, i) => String.fromCharCode(65 + i));

        var coluna = assento / 18

        var assento2 = parseInt(assento) + 1

        var lugar =  colunas[Math.floor(coluna)] + '-' + assento2;

        console.log(lugar)

        $(this).css("background-color", "green");

        $.ajax({
            url: '/ingressos/' + lugar + '/reservar/' + sessao + '/',
            type: 'GET',
            data:{
                lugar: lugar,
                sessao: sessao
            }
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.mensagem,
                    icon: "error"
                });
                assento = null
            }

            // for(var i = 0; i < assentos.length; i++){
            //     if(assentos[i] == assento){
            //         assentoIgual = true
            //     }
            // }

            // if(assentoIgual == true){
            //     Swal.fire({
            //         title: "Erro",
            //         text: "Você já selecionou essa assento",
            //         icon: "error"
            //     });
            //     assento = null
            // }
            assentos.push(assento);
        });
    });

    var cadeiras = []
    $(document).on('click', '#concluir_registro_reserva', function(e){
        e.preventDefault();
        let token = $('meta[name="csrf-token"]').attr('content');

        var colunas = Array.from({ length: 26 }, (_, i) => String.fromCharCode(65 + i));

        for(var i = 0; i < assentos.length; i++){
            if(assentos[i] != null){
                var coluna = Math.floor(assentos[i] / 18)
                var assento = parseInt(assentos[i]) + 1
                var lugar = colunas[coluna] + '-' + assento;
                cadeiras.push(lugar)
            }
        }

        $.ajax({
            url: '/ingressos/reservar',
            method: 'POST',
            data:{
                assento: cadeiras,
                sala: sessao,
                _token: token,
            }
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.mensagem,
                    icon: "error"
                }).then(() => {
                    cadeiras = null;
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: data.mensagem,
                    icon: "success",
                    draggable: true
                }).then(() => {
                    cadeiras = null;
                    location.reload();
                });
            }
        });
    });

    // // script para pesquisa
    // $(document).on('click', '#search', function(e){
    //     e.preventDefault();
    //     var pesquisa = $('#pesquisa').val();
    //     let token = $('meta[name="csrf-token"]').attr('content');

    //     $.ajax({
    //         url: '/search/' + pesquisa,
    //         type: 'GET',
    //         data:{
    //             _token: token,
    //             pesquisa: pesquisa
    //         }
    //     }).done(function(data){

    //         console.log(data)
    //         data.forEach(function(item) {

    //             var novaDiv = "<p>"+ item.id +"</p>" 

    //             $('#e').append(novaDiv)
    //         });
    //     })
    // });

    // Queimar ingresso
    $(document).on('submit', '#queimar_ingresso', function(e){
        e.preventDefault();
        $.ajax({
            url: '/ingressos/confirmar',
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
                    window.location.href = "/";
                });
            }
        })
    });
});

