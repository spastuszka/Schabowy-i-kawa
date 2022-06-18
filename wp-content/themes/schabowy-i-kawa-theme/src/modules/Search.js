import $ from 'jquery'
import axios from 'axios'

class Search {
  // 1. Opis naszego obiektu oraz jego inicjalizacja
  constructor() {
    this.addSearchHTML()
    this.openButton = document.querySelectorAll('.js-search-trigger')
    this.closeButton = document.querySelector('.search-overlay__close')
    this.searchOverlay = document.querySelector('.search-overlay')
    this.searchField = document.querySelector('#search-term')
    this.searchResults = document.querySelector('#search-overlay__results')
    this.isOverlayOpen = false
    this.isSpinnerVisible = false
    this.previousValue
    this.typingTimer
    this.events()
  }

  // 2. Zdarzenia - np. kliknięcie, najechanie itp.
  events() {
    this.openButton.forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault()
        this.openOverlay()
      })
    })
    this.closeButton.addEventListener('click', () => this.closeOverlay())
    document.addEventListener('keydown', (e) => this.keyPressSearch(e))
    this.searchField.addEventListener('keyup', () => this.typingLogic())
  }

  // 3. Metody
  typingLogic() {
    //warunek logiczny uruchamiajacy wyszukiwanie wtedy kiedy wartos pola wyszukiwania sie zmienia
    if (this.searchField.value != this.previousValue) {
      //Czyszczenie wcześniej uruchomienego timera w zmiennej typingTimer
      clearTimeout(this.typingTimer)

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.searchResults.innerHTML = '<div class="loader"></div>'
          this.isSpinnerVisible = true
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.searchResults.innerHTML = ''
        this.isSpinnerVisible = false
      }
    }
    //Ustanowienie zmiennej ktora bedzie przechowywac wartosc pola wyszuykiwania
    this.previousValue = this.searchField.value
  }

  async getResults() {
    try {
      const response = await axios.get(
        cookingData.root_url +
          '/wp-json/cookers/v1/search?term=' +
          this.searchField.value
      )
      const results = response.data
      this.searchResults.innerHTML = `
      <div class="row">
        <div class="one-quarter">
          <h2 class="search-overlay__section-title">Strony</h2>
          ${
            results.pageInfo.length
              ? '<ul class="link-list min-list">'
              : '<p>Brak informacji</p>'
          }
          ${results.pageInfo
            .map(
              (item) => `<li><a href="${item.permalink}">${item.title}</a></li>`
            )
            .join('')}
          ${results.pageInfo.length ? '</ul>' : ''}
        </div>
        <div class="one-quarter">
          <h2 class="search-overlay__section-title">Porady</h2>
          ${
            results.postInfo.length
              ? '<ul class="link-list min-list">'
              : '<p>Brak informacji</p>'
          }
          ${results.postInfo
            .map(
              (item) => `<li><a href="${item.permalink}">${item.title}</a></li>`
            )
            .join('')}
          ${results.postInfo.length ? '</ul>' : ''}
        </div>
        <div class="one-quarter">
          <h2 class="search-overlay__section-title">Przepisy</h2>
          ${
            results.recipeInfo.length
              ? '<ul class="link-list min-list">'
              : '<p>Brak informacji</p>'
          }
          ${results.recipeInfo
            .map(
              (item) => `<li><a href="${item.permalink}">${item.title}</a></li>`
            )
            .join('')}
          ${results.recipeInfo.length ? '</ul>' : ''}
        </div>
        <div class="one-quarter">
          <h2 class="search-overlay__section-title">Kucharze</h2>
          ${
            results.cookerInfo.length
              ? '<ul class="link-list min-list">'
              : '<p>Brak informacji</p>'
          }
          ${results.cookerInfo
            .map(
              (item) => `<li><a href="${item.permalink}">${item.title}</a></li>`
            )
            .join('')}
          ${results.cookerInfo.length ? '</ul>' : ''}
        </div>
      </div>
    `
      this.isSpinnerVisible = false
    } catch (e) {
      console.log(e)
    }
  }
  /*======= JQuery - old*/
  // getResults() {
  //   $.getJSON(
  //     cookingData.root_url +
  //       '/wp-json/cookers/v1/search?term=' +
  //       this.searchField.val(),
  //     (results) => {
  //       this.searchResults.html(`
  //         <div class="row">
  //           <div class="one-quarter">
  //             <h2 class="search-overlay__section-title">Strony</h2>
  //             ${
  //               results.pageInfo.length
  //                 ? '<ul class="link-list min-list">'
  //                 : '<p>Brak informacji</p>'
  //             }
  //             ${results.pageInfo
  //               .map(
  //                 (item) =>
  //                   `<li><a href="${item.permalink}">${item.title}</a></li>`
  //               )
  //               .join('')}
  //             ${results.pageInfo.length ? '</ul>' : ''}
  //           </div>
  //           <div class="one-quarter">
  //             <h2 class="search-overlay__section-title">Porady</h2>
  //             ${
  //               results.postInfo.length
  //                 ? '<ul class="link-list min-list">'
  //                 : '<p>Brak informacji</p>'
  //             }
  //             ${results.postInfo
  //               .map(
  //                 (item) =>
  //                   `<li><a href="${item.permalink}">${item.title}</a></li>`
  //               )
  //               .join('')}
  //             ${results.postInfo.length ? '</ul>' : ''}
  //           </div>
  //           <div class="one-quarter">
  //             <h2 class="search-overlay__section-title">Przepisy</h2>
  //             ${
  //               results.recipeInfo.length
  //                 ? '<ul class="link-list min-list">'
  //                 : '<p>Brak informacji</p>'
  //             }
  //             ${results.recipeInfo
  //               .map(
  //                 (item) =>
  //                   `<li><a href="${item.permalink}">${item.title}</a></li>`
  //               )
  //               .join('')}
  //             ${results.recipeInfo.length ? '</ul>' : ''}
  //           </div>
  //           <div class="one-quarter">
  //             <h2 class="search-overlay__section-title">Kucharze</h2>
  //             ${
  //               results.cookerInfo.length
  //                 ? '<ul class="link-list min-list">'
  //                 : '<p>Brak informacji</p>'
  //             }
  //             ${results.cookerInfo
  //               .map(
  //                 (item) =>
  //                   `<li><a href="${item.permalink}">${item.title}</a></li>`
  //               )
  //               .join('')}
  //             ${results.cookerInfo.length ? '</ul>' : ''}
  //           </div>
  //         </div>
  //       `)
  //       this.isSpinnerVisible = false
  //     },
  //     () => {
  //       //obsluga bledow, jezeli cos nie gra
  //       this.searchResults.html('Nieoczekiwany błąd, proszę spróbować ponownie')
  //     }
  //   )
  // }

  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active')
    document.body.classList.add('body-no-scroll')
    this.searchField.value = ''
    setTimeout(() => this.searchField.trigger('focus'), 301)
    this.isOverlayOpen = true
    return false
  }
  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active')
    document.body.classList.remove('body-no-scroll')
    console.log('our close method just ran!')
    this.isOverlayOpen = false
  }

  keyPressDispatcher(e) {
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      document.activeElement.tagName != 'INPUT' &&
      document.activeElement.tagName != 'TEXTAREA'
    ) {
      this.openOverlay()
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  //dodanie wyszukiwarki na koniec kodu umieszczajac go do footera
  addSearchHTML() {
    document.body.insertAdjacentHTML(
      'beforeend',
      `
    <div class="search-overlay">
      <div class="search-overlay__top">
        <div class="container">
          <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
          <input type="text" class="search-term" placeholder="Wyszukaj..." id="search-term">
          <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i> 
      </div>
    </div>
      <div class="container">
        <div id="search-overlay__results"></div>
      </div>
    </div>
    `
    )
  }
}

export default Search
