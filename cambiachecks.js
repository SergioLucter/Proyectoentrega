 formbus.fechainsi.addEventListener("change",cambiain);
 
 function cambiain(event) {
     if(formbus.fechainsi.selected){
        formbus.fechain.disabled=true;
         
     }
     else{
         
         formbus.fechain.disabled=false;
         
     }
     
     
 }
  formbus.fechafinsi.addEventListener("change",cambiafin);
 
 function cambiafin(event) {
     if(formbus.fechafinsi.selected){
        formbus.fechafin.disabled=true;
         
     }
     else{
         
         formbus.fechafin.disabled=false;
         
     }
     
     
 }