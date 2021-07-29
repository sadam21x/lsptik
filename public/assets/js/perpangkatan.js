$('#perpangkatan-menu').addClass('active')

/**
 * Procedure untuk menghitung hasil perpangkatan
 * Kemudian menampilkan hasilnya pada layar
 * dan memanggil Procedure save_data() untuk menyimpan histori perhitungan
 */
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

        // Cek apakah bilangan bernilai 0 atau bukan
        if(bilangan == 0){

            // Cek apakah nilai pangkat adalah 0, bilangan positif, atau bilangan negatif
            if(pangkat == 0){
                hasil = 1
            } else if(pangkat > 0) {
                hasil = 0
            } else if(pangkat < 0){
                hasil = 'Tak terhingga'
            }

        } else {

            hasil = Math.pow(bilangan, pangkat)
            
        }
    
        $('#show_bilangan').text(bilangan)
        $('#show_pangkat').text(pangkat)
        $('#show_hasil').text(hasil)

        save_data(bilangan, pangkat, hasil)
    
    }

}

/**
 * Procedure untuk menyimpan data ke file csv dengan metode ajax
 * @param {int} bilangan 
 * @param {int} pangkat 
 * @param {*} hasil 
 */
function save_data(bilangan, pangkat, hasil){

    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        url: `${BASE_URL}/perpangkatan`,
        data: {
            bilangan: bilangan,
            pangkat: pangkat,
            hasil: hasil
        },
        success: function(data){
            if(data.code == 0){
                console.log(data.msg)
                Swal.fire({
                    icon: 'error',
                    text: 'Terjadi kesalahan saat menyimpan histori perhitungan'
                })
            }
        },
        error: function(xhr){
            let error_msg = xhr.status + ': ' + xhr.statusText
            console.log(error_msg)

            Swal.fire({
                icon: 'error',
                text: 'Terjadi kesalahan saat menyimpan histori perhitungan'
            })
        }
    })
}

/**
 * Procedure untuk membaca histori perhitungan dari file csv yang dilakukan dengan metode ajax
 * kemudian menampilkannya pada modal Histori Perhitungan
 */
function histori_perhitungan(){
    $.ajax({
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        url: `${BASE_URL}/perpangkatan/read-csv`,
        success: function(data){
            if(data.code == 0){
                console.log(data.msg)
                Swal.fire({
                    icon: 'error',
                    text: 'Terjadi kesalahan saat membuka histori perhitungan'
                })
            } else if(data.code == 1){
                $('#histori-perhitungan-table > tbody').empty()
                let csv_content = data.content

                for(let i = 0; i < csv_content.length; i++){
                    if(csv_content[i] != false){
                        let tr =    `<tr>
                                        <td>${i + 1}</td>
                                        <td>${csv_content[i][0]}</td>
                                        <td>${csv_content[i][1]}</td>
                                        <td>${csv_content[i][3]}</td>
                                        <td>${csv_content[i][4]}</td>
                                    </tr>`

                        $('#histori-perhitungan-table > tbody').append(tr)
                    }
                }

                $('#histori-perhitungan-table').DataTable()
                $('#histori-perhitungan-modal').modal('show')
            }

        },
        error: function(xhr){
            let error_msg = xhr.status + ': ' + xhr.statusText
            console.log(error_msg)

            Swal.fire({
                icon: 'error',
                text: 'Terjadi kesalahan saat membuka histori perhitungan'
            })
        }
    })
}