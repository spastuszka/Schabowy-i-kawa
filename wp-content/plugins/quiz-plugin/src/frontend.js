import './frontend.scss'
import React from 'react'
import ReactDOM from 'react-dom'

const divsToUpdate = document.querySelectorAll(".paying-attention-update-me")

divsToUpdate.forEach(function(divContainer){
    const data = JSON.parse(divContainer.querySelector("pre").innerHTML)
  ReactDOM.render(<Quiz question={data.question}/>, divContainer)
  divContainer.classList.remove("paying-attention-update-me")
})

function Quiz(props){
  return(
    <div className="paying-attention-frontend">
        {props.question}
    </div>
  )
}