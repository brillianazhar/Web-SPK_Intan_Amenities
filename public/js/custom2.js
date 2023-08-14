const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');
const brand = document.querySelector('.brand');
const brandText = document.getElementById('brand-text');

if(localStorage.getItem("hide") && localStorage.getItem("hide") == "true"){
    sidebar.classList.add("hide");
  }

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
    localStorage.setItem("hide", sidebar.classList.contains("hide"));
})

const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
        localStorage.setItem("mode", "dark");
	} else {
		document.body.classList.remove('dark');
        localStorage.removeItem("mode", "dark");
	}
})

if(localStorage.getItem("mode") === "dark"){
    document.body.classList.add('dark');
    switchMode.checked = true;
}

// FORM VALIDATION
$("#tambah_kriteria").validate({
    rules:{
        namakr:{
            required: true,
            remote: {
                url: '/cekNamaKriteria',
                type: 'post',
                data: {
                    namakr: function() {
                      return $( "#namakr" ).val();
                    }
                }
            },
        },
    },
    messages: {
		namakr:{
			required: "Input nama kriteria",
			remote: "Kriteria is already registered"
		},
    },

    highlight: function(element) {
        $(element).addClass('error')
    },

    unhighlight: function(element) {
        $(element).removeClass('error')
    },
    
    submitHandler: function(form) {
      form.submit();
    }
});

$("#edit_kriteria").validate({
    rules:{
        namakr:{
            required: true,
            remote: {
                url: '/cekNamaEditKriteria/'+ ($("#idkr").val()),
                type: 'post',
                data: {
                    namakr: function() {
                      return $( "#namakr" ).val();
                    }
                }
            },
        },
    },
    messages: {
		namakr:{
			required: "Input nama kriteria",
			remote: "Kriteria is already registered"
		},
    },

    highlight: function(element) {
        $(element).addClass('error')
    },

    unhighlight: function(element) {
        $(element).removeClass('error')
    },
    
    submitHandler: function(form) {
      form.submit();
    }
});

$("#tambah_sub_kriteria").validate({
    rules:{
        namaskr:{
            required: true,
        },
        nilaiskr:{
            required: true,
            number: true,
        }
    },
    messages: {
		namaskr:{
			required: "Input nama sub kriteria",
		},
        nilaiskr:{
            required: "Input nilai sub kriteria",
            number: "input angka"
        }
    },

    highlight: function(element) {
        $(element).addClass('error')
    },

    unhighlight: function(element) {
        $(element).removeClass('error')
    },
    
    submitHandler: function(form) {
      form.submit();
    }
});

$("#edit_sub_kriteria").validate({
    rules:{
        namaskr:{
            required: true,
        },
        nilaiskr:{
            required: true,
            number: true,
        }
    },
    messages: {
		namaskr:{
			required: "Input nama sub kriteria",
		},
        nilaiskr:{
            required: "Input nilai sub kriteria",
            number: "input angka"
        }
    },

    highlight: function(element) {
        $(element).addClass('error')
    },

    unhighlight: function(element) {
        $(element).removeClass('error')
    },
    
    submitHandler: function(form) {
      form.submit();
    }
});

$("#tambah_alternatif").validate({
    rules:{
        namaalt:{
            required: true,
            remote: {
                url: '/cekNamaAlternatif',
                type: 'post',
                data: {
                    namakr: function() {
                      return $( "#namaalt" ).val();
                    }
                }
            },
        },
        kodealt:{
            required: true,
            remote: {
                url: '/cekKodeAlternatif',
                type: 'post',
                data: {
                    namakr: function() {
                      return $( "#kodealt" ).val();
                    }
                }
            },
        },
    },
    messages: {
		namaalt:{
			required: "Input nama alternatif",
			remote: "Alternatif is already registered"
		},
        kodealt:{
			required: "Input kode alternatif",
			remote: "Kode Alternatif is already registered"
		},
    },

    highlight: function(element) {
        $(element).addClass('error')
    },

    unhighlight: function(element) {
        $(element).removeClass('error')
    },
    
    submitHandler: function(form) {
      form.submit();
    }
});

$("#edit_alternatif").validate({
    rules:{
        namaalt:{
            required: true,
            remote: {
                url: '/cekNamaEditAlternatif/'+ ($("#idalt").val()),
                type: 'post',
                data: {
                    namakr: function() {
                      return $( "#namaalt" ).val();
                    }
                }
            },
        },
        kodealt:{
            required: true,
            remote: {
                url: '/cekKodeEditAlternatif/'+ ($("#idalt").val()),
                type: 'post',
                data: {
                    namakr: function() {
                      return $( "#kodealt" ).val();
                    }
                }
            },
        },
    },
    messages: {
		namaalt:{
			required: "Input nama alternatif",
			remote: "Alternatif is already registered"
		},
		kodealt:{
			required: "Input kode alternatif",
			remote: "Kode alternatif is already registered"
		},
    },

    highlight: function(element) {
        $(element).addClass('error')
    },

    unhighlight: function(element) {
        $(element).removeClass('error')
    },
    
    submitHandler: function(form) {
      form.submit();
    }
});