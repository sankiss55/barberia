<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("location:Errornoencontrado.html");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://js.stripe.com/v3/"></script>
    
    <link rel="stylesheet" href="estilos/terminardatosdepagotarjeta.css">
</head>
<body>
    <section>
<div class="container">
    
        <div class="row mt-4">
    <h1>Completa esta informacion para finalizar la compra </h1>
<br>
<label for="codigo_postal">Código Postal</label>
<input type="number" name="codigo_postal" id="codigo_postal" required>
<br>
<label for="estado">Estado</label>
<input type="text" name="estado" id="estado" required>
<br>
<label for="municipio">Municipio/Alcaldía</label>
<input type="text" name="municipio" id="municipio" required>
<br>
<label for="colonia">Colonia</label>
<input type="text" name="colonia" id="colonia" required>
<br>
<label for="calle">Calle</label>
<input type="text" name="calle" id="calle" required>
<br>
<label for="numero_exterior">Número Exterior</label>
<input type="text" name="numero_exterior" id="numero_exterior" required>
<br>
<label for="numero_interior">N° Interior/Depto (opcional)</label>
<input type="text" name="numero_interior" id="numero_interior" >
<br>
<label for="entre_calles">¿Entre qué calles está? </label>
<label for="calle_1">Calle 1</label>
<input type="text" name="calle_1" id="calle_1" >
<br>
<label for="calle_2">Calle 2</label>
<input type="text" name="calle_2" id="calle_2">
<br>
<label for="telefono">Teléfono de Contacto</label>
<input type="number"  name="telefono" id="telefono" required>

<br>
<label for="indicaciones">Indicaciones de esta Dirección</label>
<input type="text" name="indicaciones" id="indicaciones" required>
<br>
    <script>
    document.getElementById("telefono").addEventListener("keypress", function(evento){
if(this.value.length>9){
    evento.preventDefault();
}
    });
    document.getElementById("codigo_postal").addEventListener("keypress", function(evento){
        if(this.value.length>4){
    evento.preventDefault();
}
    });
    document.getElementById("enviarinfo").addEventListener("click", function(evento){
            if (telefono.value.length < 10 || codigo_postal.value.length < 5) {
                evento.preventDefault();
                if (telefono.value.length < 10) {
                    alert("El teléfono debe ser de 10 dígitos");
                }
                if (codigo_postal.value.length < 5) {
                    alert("El código postal debe ser de 5 dígitos");
                }
            }
        
    });
</script>
            <div class="card">
                <div class="card-body">
                    <form action="charge.php" method="post" id="payment-form">
  <div class="form-group">
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display Element errors. -->
    <div id="card-errors" role="alert"></div>
  </div>
<div class="form-group"></div>
<br>
  <button class="btn btn-black btn-success">Pagar</button>
</form>
                </div>
            </div>
        </div>

    </div>
    </section>
    <script>// Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
const stripe = Stripe('pk_test_51PGwJHRuEDur0E7W0wRfYpdbSpjpqfhpOjRzVZu6WyjPsRvXvNOq80qXWMkDHX2gMc5U5RdEPmUxSz6HqCqK1pbg0002LPfwRg');
const elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
const style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '16px',
    color: '#32325d',
  },
};

// Create an instance of the card Element.
const card = elements.create('card', {style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Create a token or display an error when the form is submitted.
const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const {token, error} = await stripe.createToken(card);

  if (error) {
    // Inform the customer that there was an error.
    const errorElement = document.getElementById('card-errors');
    errorElement.textContent = error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(token);
  }
});
const stripeTokenHandler = (token) => {
  // Insert the token ID into the form so it gets submitted to the server
  const form = document.getElementById('payment-form');
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
</body>
</html>
