const nicknameInput = document.querySelector("#nickname")
const btn = document.querySelector("#login-btn")
const username = localStorage.getItem('username')

if(username != undefined){
nicknameInput.value = username
}
const login = async (e) => {
  e.preventDefault()

  const credenciais = {
    "nickName": nicknameInput.value
  }

  await fetch("./backend/api/startGame.php", {
    method: "POST",
    mode:"same-origin",
    headers: {
      "Content-Type": "application/json"
    },
    body:JSON.stringify(credenciais),
  })
  .then(response => response.json())
  .then(data => {
    localStorage.setItem('user_id', data['id'])
    localStorage.setItem('username', data['nickName'])
    location.assign('./Frontend/pages/menu.html')
  })
}

btn.addEventListener("click", login)