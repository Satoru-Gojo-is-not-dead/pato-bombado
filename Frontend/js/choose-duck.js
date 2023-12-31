const ducksEl = document.querySelectorAll(".duck-container");
const radioInputs = document.getElementsByName("duck");
const playBtn = document.querySelector("#play")

const updateSelectedLabel = () => {
  radioInputs.forEach((input) => {
    const label = document.querySelector('label[for="' + input.id + '"]');
    if (input.checked) {
      label.classList.add("selected");
    } else {
      label.classList.remove("selected");
    }
  });
};

ducksEl.forEach(element => {
  element.addEventListener('click', () => {
    const input = document.querySelector('input[id="' + element.getAttribute('for') + '"]');

    if (input) {
      input.checked = true;
      updateSelectedLabel();
    }
  });
});

radioInputs.forEach(input => {
  input.addEventListener('change', updateSelectedLabel);
});

const requestDucks = async () => {
  const req = await fetch("../../backend/api/getAllPatos.php", {
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

const renderDucks = async () => {
  const ducks = await requestDucks()

  for (let i = 0; i < ducks.length; i++) {
    const duckImg = ducksEl[i].querySelector('.banner-image')
    const duckName = ducksEl[i].querySelector('.duck-name')
    const habilitySpans = ducksEl[i].querySelectorAll('.hability')

    duckImg.style.backgroundImage = `url('../assets/duck${i + 1}.png')`
    duckName.textContent = ducks[i]['nome']

    for (let j = 0; j < ducks.length; j++) {
      habilitySpans[j].textContent = ducks[i]['habilidadesPato'][j]['nomeHabilidade']
    }
  }
}

playBtn.addEventListener("click", async () => {
  const ducks = await requestDucks()

  radioInputs.forEach((input, index) => {
    if (input.checked) {
      localStorage.setItem("pato_id", ducks[index]["id"])
    }
  })

  location.assign("./loading.phtml")
})

renderDucks()