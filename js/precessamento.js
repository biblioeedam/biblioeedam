var CarregarConteudo = {
    base_url: 'http://localhost/biblioeedam/',
    carregarPagina: function(pg, parametro, r) {


        $(r).html('<h2> Carregando... </h2>');

        $.ajax({
            type: "post",
            url: pg,
            data: parametro,
            success: function(retorno) {
                $(r).html(retorno);
            }
        });
    }

};


var Emprestimo = {
    verItemEmprestimo: function(id_acao) {

        $('#myModal').modal('show');

        var url = CarregarConteudo.base_url + 'emprestimo/obterItemEmprestimo';
        var parametro = 'id_acao=' + id_acao;
        var destino = '#conteudoModelEmprestimo';

        CarregarConteudo.carregarPagina(url, parametro, destino);

    },
    buscarLeitorEmprestimo: function() {
        var url = CarregarConteudo.base_url + 'emprestimo/obterItemEmprestimo';
        var parametro = 'id_acao=' + id_acao;
        var destino = '#conteudoModelEmprestimo';

        CarregarConteudo.carregarPagina(url, parametro, destino);
    }
};

