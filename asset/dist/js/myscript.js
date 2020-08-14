const flashData = $('.flash-data').data('flashdata');
if (flashData) {
	Swal.fire({
	  title:'',
	  text:'Data Berhasil '+flashData,
	  type:'success'
	})
}
const flashDataconfirm = $('.flash-confirm').data('flashconfirm');

if (flashDataconfirm) {
	Swal.fire({
		type: 'error',
		  title: 'Oops...',
		  text: flashDataconfirm,
		  footer: ''
	})
}

const flashBerhasil = $('.flash-berhasil').data('flashberhasil');
if (flashBerhasil) {
	Swal.fire({
	  title:'',
	  text:'Selamat Datang '+flashBerhasil,
	  type:'success'
	})
}

$('.tombol-hapus').on('click',function (e) {
	// body...
	e.preventDefault();
	const href = $(this).attr('href')
	Swal.fire({
	  title: 'Apakah anda yakin',
	  text: "data akan dihapus?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#d33',
	  cancelButtonColor: '#3085d6',
	  confirmButtonText: 'Ya Yakin!'
	}).then((result) => {
	  if (result.value) {
	    document.location.href=href;
	  }
	})
})
$('.tombol-confirm').on('click',function (e) {
	// body...
	e.preventDefault();
	const href = $(this).attr('href')
	Swal.fire({
	  title: 'Apakah anda yakin',
	  text: "Keluar dari Sistem?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#d33',
	  cancelButtonColor: '#3085d6',
	  confirmButtonText: 'Ya Yakin!'
	}).then((result) => {
	  if (result.value) {
	    document.location.href=href;
	  }
	})
})