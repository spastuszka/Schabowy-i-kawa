import './frontend.scss'

const divsToUpdate = document.querySelectorAll(".paying-attention-update-me")

divsToUpdate.forEach(function(div){
  div.innerHTML = "hello"
})