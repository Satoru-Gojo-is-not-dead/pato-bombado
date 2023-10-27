const patoId = localStorage.getItem('pato_id')
const zumbiId = localStorage.getItem('zumbi_id')
const userId = localStorage.getItem('user_id')

const startBattle = async () => {
  await fetch("./backend/api/batalhar.php", {
    method: "POST",
    mode:"same-origin",
    headers: {
      "Content-Type": "application/json"
    },
    body:JSON.stringify({
      
    }),
  })
  .then(response => response.json())
  
}