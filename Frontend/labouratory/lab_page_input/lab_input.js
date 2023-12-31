const envelope = document.querySelector(".fa-envelope");
const user = document.querySelector(".fa-user-circle-o");
const toggleOpen = document.querySelector(".fa-bars");
const toggleClose = document.querySelector(".fa-times");
const sidebar = document.querySelector(".sidebar");


//Manipulate sidebar 
toggleOpen.addEventListener("click", function() {
    envelope.innerHTML = '  Chat';
    user.innerHTML =   '  Account';
    sidebar.classList.toggle("active")
    toggleOpen.style.display = "none";
    toggleClose.style.display = "block";
})

toggleClose.addEventListener("click", function() {
    envelope.innerHTML = ' '
    user.innerHTML =   '  ';
    sidebar.classList.toggle("active")
    toggleOpen.style.display = "block";
    toggleClose.style.display = "none";
    
})


//Lab 


//For immunoassay_section Dropdown
const immunoassay_section = document.querySelector(".immunoassay")
const immunoassay_open_icon1 = document.querySelector("#open_id_1")
const immunoassay_close_icon1 = document.querySelector("#close_id_1")
const form1 = document.querySelector(".form1");

immunoassay_section.addEventListener("click",()=>{
    form1.classList.toggle("hidden");
    immunoassay_open_icon1.style.display = "none";
    immunoassay_close_icon1.style.display = "block";
    if(form1.classList.contains("hidden")){
        immunoassay_close_icon1.style.display = "none";
        immunoassay_open_icon1.style.display = "block";
    }
})

//For immunoassay_section Dropdown
const clinical_chemistry_section = document.querySelector(".clinical_chemistry")
const clinical_chemistry_open_icon1 = document.querySelector("#open_id_2")
const clinical_chemistry_close_icon1 = document.querySelector("#close_id_2")
const form2 = document.querySelector(".form2");

clinical_chemistry_section.addEventListener("click",()=>{
    form2.classList.toggle("hidden");
    clinical_chemistry_open_icon1.style.display = "none";
    clinical_chemistry_close_icon1.style.display = "block";
    if(form2.classList.contains("hidden")){
        clinical_chemistry_close_icon1.style.display = "none";
        clinical_chemistry_open_icon1.style.display = "block";
    }
})
//For thyroid_section Dropdown
const thyroid_section = document.querySelector(".thyroid")
const thyroid_open_icon1 = document.querySelector("#open_id_3")
const thyroid_close_icon1 = document.querySelector("#close_id_3")
const form3 = document.querySelector(".form3");

thyroid_section.addEventListener("click",()=>{
    form3.classList.toggle("hidden");
    thyroid_open_icon1.style.display = "none";
    thyroid_close_icon1.style.display = "block";
    if(form3.classList.contains("hidden")){
        thyroid_close_icon1.style.display = "none";
        thyroid_open_icon1.style.display = "block";
    }
})

//For tumor_section Dropdown
const tumor_section = document.querySelector(".tumor")
const tumor_open_icon1 = document.querySelector("#open_id_4")
const tumor_close_icon1 = document.querySelector("#close_id_4")
const form4 = document.querySelector(".form4");

tumor_section.addEventListener("click",()=>{
    form4.classList.toggle("hidden");
    tumor_open_icon1.style.display = "none";
    tumor_close_icon1.style.display = "block";
    if(form4.classList.contains("hidden")){
        tumor_close_icon1.style.display = "none";
        tumor_open_icon1.style.display = "block";
    }
})

//For blood_section Dropdown
const blood_section = document.querySelector(".blood")
const blood_open_icon1 = document.querySelector("#open_id_5")
const blood_close_icon1 = document.querySelector("#close_id_5")
const form5 = document.querySelector(".form5");

blood_section.addEventListener("click",()=>{
    form5.classList.toggle("hidden");
    blood_open_icon1.style.display = "none";
    blood_close_icon1.style.display = "block";
    if(form5.classList.contains("hidden")){
        blood_close_icon1.style.display = "none";
        blood_open_icon1.style.display = "block";
    }
})
//For food_section Dropdown
const food_section = document.querySelector(".food")
const food_open_icon1 = document.querySelector("#open_id_6")
const food_close_icon1 = document.querySelector("#close_id_6")
const form6 = document.querySelector(".form6");

food_section.addEventListener("click",()=>{
    form6.classList.toggle("hidden");
    food_open_icon1.style.display = "none";
    food_close_icon1.style.display = "block";
    if(form6.classList.contains("hidden")){
        food_close_icon1.style.display = "none";
        food_open_icon1.style.display = "block";
    }
})

//For microbiology_section Dropdown
const microbiology_section = document.querySelector(".microbiology")
const microbiology_open_icon1 = document.querySelector("#open_id_7")
const microbiology_close_icon1 = document.querySelector("#close_id_7")
const form7= document.querySelector(".form7");

microbiology_section.addEventListener("click",()=>{
    form7.classList.toggle("hidden");
    microbiology_open_icon1.style.display = "none";
    microbiology_close_icon1.style.display = "block";
    if(form7.classList.contains("hidden")){
        microbiology_close_icon1.style.display = "none";
        microbiology_open_icon1.style.display = "block";
    }
})

//For histopathology Dropdown
const histopathology_section = document.querySelector(".histopathology")
const histopathology_open_icon1 = document.querySelector("#open_id_8")
const histopathology_close_icon1 = document.querySelector("#close_id_8")
const form8= document.querySelector(".form8");

histopathology_section.addEventListener("click",()=>{
    form8.classList.toggle("hidden");
    histopathology_open_icon1.style.display = "none";
    histopathology_close_icon1.style.display = "block";
    if(form8.classList.contains("hidden")){
        histopathology_close_icon1.style.display = "none";
        histopathology_open_icon1.style.display = "block";
    }
})
//For haematology Dropdown
const haematology_section = document.querySelector(".haematology")
const haematology_open_icon1 = document.querySelector("#open_id_9")
const haematology_close_icon1 = document.querySelector("#close_id_9")
const form9= document.querySelector(".form9");

haematology_section.addEventListener("click",()=>{
    form9.classList.toggle("hidden");
    haematology_open_icon1.style.display = "none";
    haematology_close_icon1.style.display = "block";
    if(form9.classList.contains("hidden")){
        haematology_close_icon1.style.display = "none";
        haematology_open_icon1.style.display = "block";
    }
})


//Back to patient list
const back_arrow = ()=>{
    let url = "../patients_list.php";
    window.parent(location = (url))
}