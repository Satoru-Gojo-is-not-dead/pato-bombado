const cardTemplate = document.querySelector("#template .card-container")
const container = document.querySelector(".container")
const noHosters = document.querySelector("#no-hosters")

const getHosters = async () => {

  const req = await fetch("../../backend/api/getAllHospedeiros.php",{
    method: "GET",
    headers: {
      'Content-type': "application/json",
    },
    mode: "same-origin"
  }
  )
  .then(response => response.json())
  .then(data => {
    return data
  })
  return req
}

const renderHosters = async () => {
  const hosters = await getHosters()
  console.log(hosters)
  if(hosters.length === 0){
    noHosters.classList.remove('no-hosters')
    return
  }

  for(let i = 0; i< hosters.length; i++){
    const card = cardTemplate.cloneNode(true)
    container.appendChild(card)

    const hosterName = card.querySelector('.hoster-name')
    const hosterAge = card.querySelector('.hoster-info .idade')
    const hosterWeight = card.querySelector('.hoster-info .peso')
    const hosterHeight = card.querySelector('.hoster-info .altura')
    const bgImage = card.querySelector('.banner-image')

    bgImage.style.backgroundImage = (hosters[i].sexo == "Feminino" ?
     "url('../assets/card-wrapper.png')" :
     "url('../assets/man-zombie.png')")

    hosterName.textContent = (hosters[i].sexo === "Feminino" ? "Mulher" : "Homem")
    hosterAge.textContent = `Idade: ${hosters[i].idade}`
    hosterWeight.textContent = `Peso: ${Number(hosters[i].peso).toFixed(1)}`
    hosterHeight.textContent = `Altura: ${hosters[i].altura}M`
  }
}
renderHosters()