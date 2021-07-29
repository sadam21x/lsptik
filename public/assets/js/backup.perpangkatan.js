$('#perpangkatan-menu').addClass('active')

function hitung_perpangkatan(){
    let bilangan = $('#input_bilangan').val()
    let pangkat = $('#input_pangkat').val()

    if(bilangan == '' && pangkat == ''){
        Swal.fire({
            icon: 'warning',
            text: 'Anda belum memasukkan bilangan dan pangkat'
        })
    } else if(bilangan == '' && pangkat != ''){
        Swal.fire({
            icon: 'warning',
            text: 'Anda belum memasukkan bilangan'
        })
    } else if(bilangan != '' && pangkat == ''){
        Swal.fire({
            icon: 'warning',
            text: 'Anda belum memasukkan pangkat'
        })
    } else {

        let hasil

        if(bilangan == 0){

            if(pangkat == 0){
                hasil = 1
            } else if(pangkat > 0) {
                hasil = 0
            } else if(pangkat < 0){
                hasil = 'Tak terhingga'
            }

        } else {

            if(pangkat == 0){
                hasil = 1
            } else if(pangkat > 0){

                hasil = bilangan
        
                for(let i = 1; i < pangkat; i++){
                    hasil = hasil * bilangan
                }

            } else if(pangkat < 0){
                pangkat = pangkat * (-1)
                let penyebut = bilangan

                for(let i = 1; i < pangkat; i++){
                    penyebut = penyebut * bilangan
                }

                hasil = 1 / penyebut
            }
        }
    
        $('#show_bilangan').text(bilangan)
        $('#show_pangkat').text(pangkat)
        $('#show_hasil').text(hasil)
    
    }

}