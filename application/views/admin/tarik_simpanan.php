<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tarik Simpanan</div>
                    </div>
                    <form class="simpanan" method="post" action="<?= base_url('admin/insert_tarikSimpanan'); ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                <input hidden type="number" class="form-control" id="id_user" name="id_user" placeholder="Masukan nik" value="<?= $penarikan['id_user'] ?>">
                                <input hidden type="number" class="form-control" id="nik" name="nik" placeholder="Masukan nik" value="<?= $penarikan['nik'] ?>">
                                <input hidden type="number" class="form-control" id="id_jenis_simpanan" name="id_jenis_simpanan" placeholder="Masukan id_jenis_simpanan" value="<?= $penarikan['id_jenis_simpanan'] ?>">
                                <div class="col-md-12 col-lg-12">
                                    <label for="jumlah">Jumlah Simpanan</label>
                                    <input type="text" class="form-control" id="total_dana" name="total_dana" placeholder="Masukan Jumlah" value="Rp. <?= number_format($penarikan['jumlah']) ?>" readonly>
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
<!-- Tambahkan CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    var rupiah = document.getElementById('jml');
    rupiah.addEventListener('keyup', function(e) {
        // Tambahkan 'Rp.' pada saat form diketik
        rupiah.value = formatRupiah(this.value, 'Rp. ');

        // Validasi jumlah tidak lebih dari total dana
        var totalDana = parseInt(document.getElementById('total_dana').value.replace(/[^0-9]/g, ''), 10);
        var jumlahPenarikan = parseInt(this.value.replace(/[^0-9]/g, ''), 10);

        if (jumlahPenarikan > totalDana) {
            Swal.fire({
                icon: 'error',
                title: 'Jumlah Melebihi Batas',
                text: 'Jumlah tidak boleh lebih dari total dana simpanan.',
            });
            this.value = formatRupiah(totalDana.toString(), 'Rp. ');
        }

        // Set nilai ke input hidden jumlah
        document.getElementById('jumlah').value = jumlahPenarikan;
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // Tambahkan titik jika yang diinput sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
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