const menuToggle = document.querySelector('.menu-bar');
  const navMenu = document.querySelector('nav ul');

  menuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('show');
  });




const sliderItems = document.querySelectorAll('.slider-item');

let sliderActive = 1;

if(sliderItems){
    sliderItems.forEach((slider, index)=>{
        if(index === 0){
            slider.setAttribute("data-show", "show");
        }else{
            slider.setAttribute("data-show", "hidden");
        }
    })
    
    setInterval(() =>{
        sliderItems.forEach((slider, index)=> {
            if(sliderActive === index){
                 slider.setAttribute("data-show", "show");
            } else{
                 slider.setAttribute("data-show", "hidden");
            }
        });
        if(sliderActive === sliderItems.length - 1 ){
            sliderActive = 0;
        }else{
            sliderActive++;
        }

    }, 5000)

}

// star sertifikat
const dropdownInput = document.getElementById('dropdownInput');
const filterIcon = document.getElementById('filterIcon');
const dropdownList = document.getElementById('dropdownList');
const wrapper = document.querySelector('.dropdown-wrapper');

let isClickInside = false;

function showDropdown() {
  dropdownList.classList.add('show');
  isClickInside = true;
  setTimeout(() => isClickInside = false, 100); // biar event click luar tidak langsung nutup
}

dropdownInput.addEventListener('click', showDropdown);
filterIcon.addEventListener('click', showDropdown);

// Klik list item
dropdownList.querySelectorAll('li').forEach(item => {
  item.addEventListener('click', () => {
    dropdownInput.value = item.textContent;
    dropdownList.classList.remove('show');
  });
});

// Klik di luar => tutup
document.addEventListener('click', function (e) {
  if (!wrapper.contains(e.target) && !isClickInside) {
    dropdownList.classList.remove('show');
  }
});

// end sertifikat

 // Ambil semua elemen .bulat di dalam .btn-bidang
  const tombolBulat = document.querySelectorAll('.btn-bidang .bulat');
  const deskripsiBox = document.querySelector('.deskripsi-sub-bidang');

  tombolBulat.forEach(function (bulat) {
    bulat.addEventListener('click', function (e) {
      e.preventDefault(); // cegah link reload
      deskripsiBox.classList.add('show');
    });
  });