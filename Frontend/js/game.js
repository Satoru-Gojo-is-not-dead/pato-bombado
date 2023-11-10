const patoId = localStorage.getItem("pato_id");
const { idZumbi, velocidade, forca, inteligencia } = JSON.parse(
  localStorage.getItem("zumbi")
);
const userId = localStorage.getItem("user_id");
const buttons = document.querySelectorAll("button");
const zombieStrength = document.querySelector("#zombie-strength");
const zombieIntelligence = document.querySelector("#zombie-intelligence");
const zombieSpeed = document.querySelector("#zombie-speed");

const duckHp = document.querySelector("#duck-hp");
const zombieHp = document.querySelector("#zombie-hp");

const getDuckHabilities = async () => {
  const data = await fetch(`../../backend/api/getPato.php?idPato=${patoId}`, {
    mode: "same-origin",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  }).then((response) => response.json());

  return data;
};

const renderDuckHabilities = async () => {
  const { habilidadesPato } = await getDuckHabilities();

  for (let i = 0; i < habilidadesPato.length; i++) {
    buttons[i].textContent = habilidadesPato[i]["nomeHabilidade"];
    buttons[i].id = habilidadesPato[i]["codigoHabilidade"];
  }
};
const renderZombieAttributes = async () => {
  zombieIntelligence.textContent = inteligencia;
  zombieSpeed.textContent = velocidade;
  zombieStrength.textContent = forca;
};

const goRound = async ({ target }) => {
  const credencials = {
    idPato: Number(patoId),
    idZumbi: Number(idZumbi),
    idPlayer: Number(userId),
    codigoAtaque: Number(target.id),
  };

  await fetch("../../backend/api/batalhar.php", {
    method: "POST",
    mode: "same-origin",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(credencials),
  })
    .then((response) => response.json())
    .then((data) => handleRoundResult(data));
};

const handleRoundResult = (data) => {
  console.log(data);

  if(!data['zumbi']['hp']){
    console.log('sexo')
  }

  zombieHp.textContent = data['zumbi']['hp']
  duckHp.textContent = data['pato']['hp']
};

renderZombieAttributes();
renderDuckHabilities();
buttons.forEach((button) => {
  button.addEventListener("click", goRound);
});
