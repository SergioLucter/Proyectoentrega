 formusu.addEventListener("submit", validarFormusu);
 function validarFormusu(event) {
     if(formusu.usuario.value=="0"){
         event.preventDefault();
         alert("Elija un usuario por favor");
         
     }
     
     
 }