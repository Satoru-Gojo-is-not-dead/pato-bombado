const getHosters = async () => {

  const req = await fetch("../../backend/api/getAllHospedeiros.php",{
    method: "GET",
    headers: {
      'Content-type': "application/json",
    },
    mode: "same-origin"
  }
  )
  .then( response => response.json())
  .then(data => console.log(data))

}

getHosters()