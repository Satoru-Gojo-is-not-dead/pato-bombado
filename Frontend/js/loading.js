const message = document.querySelector("#message-loading")

const messageAnimation = () => {

    setTimeout(() => {
        message.textContent = "Gerando oponente ..."
    }, 1500)

    setTimeout(() => {
        message.textContent = "Preparando batalha ..."
    }, 3000)

    setTimeout(() => {
        location.assign("./game.html")
    }, 5000)
}

const requestZombie = async () => {

    await fetch("../../backend/api/getZumbi.php", {
        method: "GET",
        mode: 'same-origin',
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            localStorage.setItem('zumbi_id', data['id'])
        })

}
requestZombie()
messageAnimation()