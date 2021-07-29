$('#faktorial-menu').addClass('active')

/**
 * Function untuk menghitung nilai faktorial dari suatu bilangan
 * @param {int} n 
 * @returns {int} result
 */
function factorial(n){
    let result = 1

    // Cek apakah nilai n = 0 atau n = 1 atau n bilangan bulat positif lainnya
    if(n == 0 || n == 1){
        return result
    } else {

        for(let i = n; i >= 1; i--){
            result = result * i
        }

        return result

    }
}

/**
 * Procedure untuk memanggil function factorial(n)
 * Kemudian menampilkan hasilnya pada layar
 * dan memanggil Procedure save_data() untuk menyimpan histori perhitungan
 */
function hitung_faktorial(){
    let bilangan = $('#input_bilangan').val()
    let hasil

    // Cek apakah input form terisi atau kosong
    if(bilangan == ''){
        Swal.fire({
            icon: 'warning',
            text: 'Anda belum memasukkan bilangan'
        })
    } else {

        bilangan = parseInt(bilangan)
        $('#input_bilangan').val(bilangan)

        // Cek apakah bilangan yang dimasukkan merupakan bilangan bulat/integer
        if(Number.isInteger(bilangan) == false){
            Swal.fire({
                icon: 'warning',
                text: 'Mohon masukkan bilangan bulat positif atau 0'
            })
        } else {
            // Cek apakah bilangan yang dimasukkan bernilai negatif atau positif
            if(bilangan < 0){
                Swal.fire({
                    icon: 'warning',
                    text: 'Bilangan tidak boleh bernilai negatif'
                })
            } else {
                hasil = factorial(bilangan)
        
                $('#show_bilangan').text(bilangan)
                $('#show_hasil').text(hasil)
                
                save_data(bilangan, hasil)
            }
        }

    }
}

/**
 * Procedure untuk menyimpan data ke file csv dengan metode ajax
 * @param {int} bilangan 
 * @param {*} hasil 
 */
function save_data(bilangan, hasil){
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        url: `${BASE_URL}/faktorial`,
        data: {
            bilangan: bilangan,
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
        url: `${BASE_URL}/faktorial/read-csv`,
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