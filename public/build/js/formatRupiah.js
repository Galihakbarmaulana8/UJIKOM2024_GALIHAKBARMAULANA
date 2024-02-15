// File: formatRupiah.js
function formatRupiah(angka) {
    var number_string = angka.toString(),
    split = number_string.split(','),
    sisa  = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return rupiah;
}
