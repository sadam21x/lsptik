/**
 * Function untuk menampilkan notifikasi sukses
 * @param {*} message 
 */
function notification_success(message){
    Swal.fire({
        icon: 'success',
        text: message
    })
}

/**
 * Function untuk menampilkan notifikasi error
 * @param {*} message 
 */
function notification_error(message){
    Swal.fire({
        icon: 'error',
        text: message
    })
}