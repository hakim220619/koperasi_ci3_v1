<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Simpanan</div>
                    </div>
                    <form class="simpanan" method="post" action="<?= base_url('admin/insert_simpanan'); ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                <input hidden type="number" class="form-control" id="id_user" name="id_user" placeholder="Masukan nik" value="<?= $simpanan['id_user'] ?>">
                                <input hidden type="number" class="form-control" id="nik" name="nik" placeholder="Masukan nik" value="<?= $simpanan['nik'] ?>">
                                <div class="col-md-12 col-lg-12">
                                    <label for="id_jenis_simpanan">Jenis Simpanan</label>
                                    <!-- Menggunakan select untuk opsi jenis simpanan -->
                                    <select class="form-control" id="id_jenis_simpanan" name="id_jenis_simpanan">
                                        <option value="">Pilih Jenis Simpanan</option>
                                        <?php
                                        // Array jenis simpanan
                                        

                                        // Loop melalui array untuk menambahkan opsi ke dropdown
                                        foreach ($jenis_simpanan as $jenis) {
                                            echo "<option value='{$jenis->id}'>{$jenis->name}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-12 col-lg-12">
                                    <input hidden type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" value="">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" id="jml" name="jml" placeholder="Masukan Jumlah" value="" onkeyup="nilairupiah(this.value)">
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var rupiah = document.getElementById('jml');
    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
    }
</script>
<script>
    function nilairupiah(nilai) {
        // var explode = nilai.split(" ");

        var hasil = parseInt(nilai.replace(/,.*|[^0-9]/g, ''), 10);
        // console.log(hasil);
        $('#jumlah').val(hasil);
    }
</script>