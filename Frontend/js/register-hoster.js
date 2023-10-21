const idade = document.querySelector("#idade")
const sexoSelect = document.querySelector("#sexo")
const peso = document.querySelector("#peso")
const altura = document.querySelector("#altura")
const tpSanguineSelect = document.querySelector("#tp-sanguineo")
const jogoSelect = document.querySelector("#jogo")
const esportes = document.querySelectorAll("input[type='checkbox']")

const registerBtn = document.querySelector('#register-btn')

const registerHopedeiro = async (e) => {
    e.preventDefault()

    const credenciais = {}

    credenciais['idade'] = Number(idade.value)
    credenciais['sexo'] = sexoSelect.options[sexoSelect.selectedIndex].value
    credenciais['peso'] = Number(peso.value)
    credenciais['altura'] = Number(altura.value)
    credenciais['tipoSanguineo'] = tpSanguineSelect.options[tpSanguineSelect.selectedIndex].value
    credenciais['jogoPreferido'] = jogoSelect.options[jogoSelect.selectedIndex].value
    credenciais['esportesPraticados'] = []

    esportes.forEach(checkbox => {
        if(checkbox.checked){
            credenciais['esportesPraticados'].push(checkbox.value)
        }
    })

    fetch("../../backend/api/cadastrarHospedeiro.php", {
      method: "POST",
      headers: {
        'Content-Type': 'application/json',
      },
      body:credenciais,
      mode:"same-origin"
    })
    .then(response => {
      console.log(response)
    })
}

registerBtn.addEventListener('click', registerHopedeiro)