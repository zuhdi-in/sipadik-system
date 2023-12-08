


$(document).ready(function() {
    var table = $('#example').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "info": false,
        "autoWidth": true,
        "order": [
            [0, 'asc'],
            [1, 'asc']
        ],
        "dom": '<"top"i><"bottom"flp>rt<"clear">'
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex, n) {            
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            const dateColumn = data[0];
            if ((startDate === '' && endDate === '') ||
                (startDate === '' && dateColumn <= endDate) ||
                (endDate === '' && dateColumn >= startDate) ||
                (dateColumn >= startDate && dateColumn <= endDate)) {
                return true;
            }
            return false;
        }
    );
    $('#filter_button').click(function(e) {
        e.preventDefault(); // Ini mencegah bawaan dari tombol 'Filter'
        
        // Tempatkan kode yang memicu filter di sini jika diperlukan
    });
    

    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });

    $('#filter_button').on('click', function() {
        table.draw();
    });

    // Tambahkan kode berikut untuk menghapus filter saat tombol "Clear Filter" diklik.
    $('#clear_filter_button').on('click', function() {
        $('#startDate').val(''); // Menghapus tanggal awal
        $('#endDate').val(''); // Menghapus tanggal akhir
        $('#search').val(''); // Menghapus filter pencarian
        table.search('').draw(); // Menggambar ulang tabel tanpa filter
    });
});

$(document).ready(function() {
    var currentLocation = window.location.href;

    $('.nav-item').each(function() {
        var link = $(this).find('a').attr('href');

        // Menentukan apakah URL saat ini cocok dengan link secara tepat
        if (currentLocation.endsWith(link)) {
            $(this).addClass('active'); // Tambahkan kelas 'active' ke elemen

            // Jika merupakan halaman terkait dengan surat masuk atau surat keluar, tambahkan kelas 'active' ke elemen heading terdekat
            if (link.includes('surat-masuk') || link.includes('surat-keluar')) {
                $(this).closest('.sidebar-heading').addClass('active');
            }
        }
    });
});

