function validarRegistro() {
    const nombre = document.getElementById("nombre").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
  
    if (nombre === '' || email === '' || password.length < 6) {
      alert("Todos los campos son obligatorios y la contraseña debe tener al menos 6 caracteres.");
      return false;
    }
    return true;
  }
  