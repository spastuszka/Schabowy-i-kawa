let recipeItem = document.querySelector('.recipe-summary__item')
const html = document.querySelector('html')
let descriptionStyle = document.querySelector(
  '.recipe-summary__item--description'
)
recipeItem.addEventListener('mouseover', () => {
  descriptionStyle.classList.add('recipe-hover')
})

html.addEventListener('mouseover', function (e) {
  if (e.target !== recipeItem) descriptionStyle.classList.remove('recipe-hover')
})

//TODO
