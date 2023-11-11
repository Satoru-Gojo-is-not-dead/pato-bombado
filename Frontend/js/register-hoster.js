import Toast from "./utils/toast.js";

const idade = document.querySelector("#idade");
const sexoSelect = document.querySelector("#sexo");
const peso = document.querySelector("#peso");
const altura = document.querySelector("#altura");
const tpSanguineSelect = document.querySelector("#tp-sanguineo");
const jogoSelect = document.querySelector("#jogo");
const esportes = document.querySelectorAll("input[type='checkbox']");

const registerBtn = document.querySelector("#register-btn");

const toastMessage = document.querySelector("#toast-message");
const toastImg = document.querySelector("#toast-img");
const toastContainer = document.querySelector("#toast-container");

const toast = new Toast(toastMessage, toastImg, toastContainer);

const validateForm = () => {
  if (
    idade.value === "" ||
    peso.value === "" ||
    altura.value === "" ||
    sexoSelect.options[sexoSelect.selectedIndex].value === "Selecione ..." ||
    tpSanguineSelect.options[tpSanguineSelect.selectedIndex].value ===
      "Selecione ..."
  ) {
    return false;
  }
  return true;
};

const registerHopedeiro = async (e) => {
  e.preventDefault();

  const dataOk = validateForm();

  if (!dataOk) {
    toast.fail("Preencha os campos corretamente");

    return;
  }

  const credenciais = {};

  credenciais["idade"] = Number(idade.value);
  credenciais["sexo"] = sexoSelect.options[sexoSelect.selectedIndex].value;
  credenciais["peso"] = Number(peso.value);
  credenciais["altura"] = Number(altura.value);
  credenciais["tipoSanguineo"] =
    tpSanguineSelect.options[tpSanguineSelect.selectedIndex].value;
  credenciais["jogoPreferido"] =
    jogoSelect.options[jogoSelect.selectedIndex].value;
  credenciais["esportesPraticados"] = [];

  esportes.forEach((checkbox) => {
    if (checkbox.checked) {
      credenciais["esportesPraticados"].push(checkbox.value);
    }
  });

  fetch("../../backend/api/cadastrarHospedeiro.php", {
    method: "POST",
    body: JSON.stringify(credenciais),
  }).then((response) => {
    if (response.ok) {
      toast.success("Cadastrado com sucesso!");
      setTimeout(() => {
        location.reload();
      }, 2500);
      return;
    }
    toast.fail("Falha ao cadastrar!");
    setTimeout(() => {
      location.reload();
    }, 2500);
    return;
  });
};

registerBtn.addEventListener("click", registerHopedeiro);
