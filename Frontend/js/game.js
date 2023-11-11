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

const duckImg = document.querySelector("#duck-img");

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

const renderDuckImage = () => {
  duckImg.src = `../assets/duck${patoId}.png`;
};

const renderZombieAttributes = async () => {
  zombieIntelligence.textContent = inteligencia;
  zombieSpeed.textContent = velocidade;
  zombieStrength.textContent = forca;
};

const goRound = async ({ target }) => {
  const data = {
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
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      localStorage.setItem("playerInfo", JSON.stringify(data["player"]));

      handleRoundResult(data);
    });
};

const duckWins = async () => {
  const data = localStorage.getItem("playerInfo");

  await fetch("../../backend/api/levelUp.php", {
    method: "POST",
    mode: "same-origin",
    headers: {
      "Content-Type": "application/json",
    },
    body: data,
  }).then((response) => response.json());
};

const zombieWins = async () => {
  const data = localStorage.getItem("playerInfo");

  await fetch("../../backend/api/resetarNivelPlayer.php", {
    method: "POST",
    mode: "same-origin",
    headers: {
      "Content-Type": "application/json",
    },
    body: data,
  }).then((response) => response.json());
};

const handleRoundResult = (data) => {
  if (!data) {
    return
  }

  zombieHp.textContent = +zombieHp.textContent - data["danoAplicadoAoZumbi"];
  duckHp.textContent = +duckHp.textContent - data["danoAplicadoAoPato"];

  if (+zombieHp.textContent <= 0) {
    zombieHp.textContent = 0;
    duckWins();
    return;
  }

  if (+duckHp.textContent <= 0) {
    duckHp.textContent = 0;
    zombieWins()
    return;
  }
};

buttons.forEach((button) => {
  button.addEventListener("click", goRound);
});

renderDuckImage();
renderZombieAttributes();
renderDuckHabilities();
