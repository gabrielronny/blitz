

$(function() {
    $('#txtFoto').change(function() {
        const file = $(this)[0].files[0]
        const fileReader = new FileReader()
        fileReader.onloadend = function() {
            $('#img').attr('src', fileReader.result)
        }

        fileReader.readAsDataURL(file);
    })
})

function desabilitar(){
    document.getElementById('nomePolicial').removeAttribute('disabled')
    document.getElementById('identificaoPolicial').removeAttribute('disabled')
    document.getElementById('rgPolicial').removeAttribute('disabled')
    document.getElementById('emailPolicial').removeAttribute('disabled')
    document.getElementById('patentePolicial').removeAttribute('disabled')
    document.getElementById('tipoSangue').removeAttribute('disabled')
    document.getElementById('btnAtualizar').removeAttribute('disabled')
    document.getElementById('txtFoto').removeAttribute('disabled')
}