const botao = document.querySelector("#botao")

/* botao.addEventListener("click", function() {
    let json = {
        "idade": 22,
        "sexo": "Masculino",
        "peso": 69.50,
        "altura": 1.75,
        "tipoSanguineo": "O-",
        "esportesPraticados": [
            "Futebol",
            "Vôlei",
        ],
        "jogoPreferido": null,
    }

    $.ajax({
        url: "backend/api/cadastrarHospedeiro.php",
        data: json,
        method: "POST",
        success: function( result ) {
          console.log(result)
        }
      }).fail(function(error) {
        console.log(error.responseText)
      })
}) */

/* botao.addEventListener("click", function() {
  let json = {
      "idade": 22,
      "sexo": "Masculino",
      "peso": 69.50,
      "altura": 1.75,
      "tipoSanguineo": "O-",
      "esportesPraticados": [
          "Futebol",
          "Vôlei",
      ],
      "jogoPreferido": null,
  }

  $.ajax({
      url: "backend/api/getAllHospedeiros.php",
      data: json,
      method: "GET",
      success: function( result ) {
        console.log(result)
      }
    }).fail(function(error) {
      console.log(error.responseText)
    })
}) */

botao.addEventListener("click", function() {
  $.ajax({
      url: "backend/api/getZumbi.php",
      method: "GET",
      success: function( result ) {
        console.log(result)
      }
    }).fail(function(error) {
      console.log(error.responseText)
    })
})