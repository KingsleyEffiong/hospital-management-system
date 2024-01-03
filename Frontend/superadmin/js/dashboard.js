
//create a var for the open and the close toggle
const openToggleSidebar = document.getElementById("open-toggle");
const closeToggleSidebar = document.getElementById("close-toggle");



//making the sidebar to be invisible
// sidebar.style.left = "fit-content"


//this helps the toggle the sidebar open
const sidebar_icons =()=>{
    const sidebarIcon = document.querySelectorAll("#sidebar_icons")
    for(let i =0; i < sidebarIcon.length; i++) {
      sidebarIcon[i].style.fontSize = "20px"
    }
}
sidebar_icons()

openToggleSidebar.addEventListener("click", function(){
    const sidebar = document.querySelector(".sidebar");
  sidebar.classList.toggle("active");
    if(sidebar.classList.contains("active")){
        const spanText = document.querySelectorAll(".lists")
        for(let n =0; n<spanText.length; n++)
        spanText[n].classList.remove("hide")

    const sidebarIcon = document.querySelectorAll("#sidebar_icons")
    for(let i =0; i < sidebarIcon.length; i++) {
      sidebarIcon[i].style.fontSize = "20px"
    }
    const list = document.querySelectorAll(".items");
    for(let l=0; l < list.length; l++){
     list[l].addEventListener("mouseover",()=>{
       list[l].style.color = "rgb(0, 82, 101)";
      })
      list[l].addEventListener("mouseout",()=>{
        list[l].style.color = "#fff";
      })
    }
    }
    
    else{
        const spanText = document.querySelectorAll(".lists")
        for(let n =0; n<spanText.length; n++)
    spanText[n].classList.add("hide")

    const sidebarIcon = document.querySelectorAll("#sidebar_icons")
    for(let i =0; i < sidebarIcon.length; i++) {
        sidebarIcon[i].style.fontSize = "20px"
    }
    const list = document.querySelectorAll(".items");
    for(let l=0; l < list.length; l++){
     list[l].addEventListener("mouseover",()=>{
       list[l].style.color = "rgb(0, 158, 251)";
      })
      list[l].addEventListener("mouseout",()=>{
        list[l].style.color = "#fff";
      })
    }
    }
    const profile_container = document.querySelector(".display_profile_container");
    profile_container.classList.toggle("change_color");

})


const show_profile_upload = ()=>{
    const profile_container = document.querySelector(".display_profile_container");
    profile_container.classList.toggle("hide")
}


//patient page redirect

function openPatientsList(){
    let urlPatient = '../superadmin/pages/patients.php';
    window.parent(location=(urlPatient));
};
function openDoctorPage(){
    let urlDoctor = '/';
    window.parent(location=(urlDoctor));
};
function openNursePage(){
    let urlNurse = '/';
    window.parent(location=(urlNurse));
};
function openPharmacyPage(){
    let urlPharmacy = '/';
    window.parent(location=(urlPharmacy));
};
function openLabPage(){
    let urlLab = '/';
    window.parent(location=(urlLab));
};
function openPrecedurePage(){
    let urlPrecedure = '/';
    window.parent(location=(urlPrecedure));
};
function openFinancePage(){
    let urlFinance = '/';
    window.parent(location=(urlFinance));
}
function openRecepPage(){
    let urlRecep = '/';
    window.parent(location=(urlRecep));
};
function openPhysiotherapyPage(){
    let urlPhysiotherapy = '/';
    window.parent(location=(urlPhysiotherapy));
};
function openStaffPage(){
    let urlStaff = '/';
    window.parent(location=(urlStaff));
};
function openWardBed(){
    let urlWardBed = '/';
    window.parent(location=(urlWardBed));
};







