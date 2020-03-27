function clonaArtigo(){
    var clone = document.getElementById('divArtigo').cloneNode(true);
    var destino = document.getElementById('destino');
    
    var button = document.createElement('button');
    button.setAttribute("type", "button");
    button.setAttribute("onclick", "removeArtigo(this)");
    button.className = 'btn btn-danger';
    button.innerHTML = "-";

    destino.appendChild (clone);
    // destino.appendChild (button);

    //var last = destino.lastElementChild;
    destino.lastElementChild.appendChild(button);

    //console.log(destino.childNodes);

}

function removeArtigo(id){
    var node1 = document.getElementById('destino');
    node1.removeChild(node1.childNodes[0]);
}

//cep

$(document).ready(function(){
    $('#txCep').focusout(function(){
        var cep = $('#txCep').val();
        cep = cep.replace("-", "");

        var str = "https://viacep.com.br/ws/" + cep + "/json/";

        $.ajax({
            url: str,
            type: "get",
            dataType: "json",
            success: function(data){

                $('#txLogradouro').val(data.logradouro);
                $('#txBairro').val(data.bairro);
                $('#txCidade').val(data.localidade);
            }
        })
    });
})

//mask

$(document).ready(function () { 
    $("#txCep").mask("99999-999")
    $("#txCpf").mask("999.999.999-99") 
    $('#cpfCidadao').mask("999.999.999-99") 
    $("#data").mask("99/99/9999")
});

$(function(){
    $('#txtFoto').change(function(){
        const file = $(this)[0].files[0]
        const fileReader = new FileReader()
        fileReader.onloadend = function(){
            $('#img').attr('src', fileReader.result)
        }

        fileReader.readAsDataURL(file);
    })
})
