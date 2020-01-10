function retornaCep() {
    if($('#cep').val().length == 9){
        var cep = $('#cep').val().toString().replace(/-/, '');
        $.ajax({
            type: "GET",
            url: "https://viacep.com.br/ws/" + cep + "/json/",
            contentType: "application/json; charset=utf-8",
            data: "{}",
            dataType: "json",
            success: function(data) { SucessCallback(data); },
            error: function(data) { FailureCallBack(data); }
        });
    } else {
        $('#oculto').attr("hidden",true);
    }
}

function SucessCallback(result) {
    if(result.logradouro){
        $('#endereco').val(result.logradouro);
        $('#bairro').val(result.bairro);
        $('#cidade').val(result.localidade);
        $('#estado').val(result.uf);
        $('#ibge').val(result.ibge);
        $('#oculto').removeAttr('hidden');
    } else {
        alert('Não encontramos o CEP desejado. Por favor, verifique os dados informados e tente novamente.');
    }
}

function FailureCallBack(result) {
    alert('Não encontramos o CEP desejado. Por favor, verifique os dados informados e tente novamente.');
}