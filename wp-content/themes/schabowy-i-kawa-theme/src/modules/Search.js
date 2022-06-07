import $ from 'jquery'

class Search {
  // 1. Opis naszego obiektu oraz jego inicjalizacja
  constructor() {
    this.addSearchHTML()
    this.openButton = $('.js-search-trigger')
    this.closeButton = $('.search-overlay__close')
    this.searchOverlay = $('.search-overlay')
    this.searchField = $('#search-term')
    this.searchResults = $('#search-overlay__results')
    this.events()
    this.isOverlayOpen = false
    this.typingTimer
    this.isSpinnerVisible = false
    this.previousValue
  }

  // 2. Zdarzenia - np. kliknięcie, najechanie itp.
  events() {
    this.openButton.on('click', this.openOverlay.bind(this))
    this.closeButton.on('click', this.closeOverlay.bind(this))
    $(document).on('keydown', this.keyPressSearch.bind(this))
    this.searchField.on('keyup', this.typingLogic.bind(this))
  }

  // 3. Metody
  typingLogic() {
    //warunek logiczny uruchamiajacy wyszukiwanie wtedy kiedy wartos pola wyszukiwania sie zmienia
    if (this.searchField.val() != this.previousValue) {
      //Czyszczenie wcześniej uruchomienego timera w zmiennej typingTimer
      clearTimeout(this.typingTimer)

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.searchResults.html('<div class="loader"></div>')
          this.isSpinnerVisible = true
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.searchResults.html(' ')
        this.isSpinnerVisible = false
      }
    }
    //Ustanowienie zmiennej ktora bedzie przechowywac wartosc pola wyszuykiwania
    this.previousValue = this.searchField.val()
  }

  getResults() {
    //asynchroniczne wykonanie search'a
    $.when(
      $.getJSON(
        cookingData.root_url +
          '/wp-json/wp/v2/posts?search=' +
          this.searchField.val()
      ),
      $.getJSON(
        cookingData.root_url +
          '/wp-json/wp/v2/pages?search=' +
          this.searchField.val()
      )
    ).then(
      (posts, pages) => {
        let combinedResults = posts[0].concat(pages[0])
        this.searchResults.html(`
          <h2 class="search-overlay__section-title">Przepisy</h2>
          ${
            combinedResults.length
              ? '<ul class="link-list min-list">'
              : '<p>Brak informacji</p>'
          }
          ${combinedResults
            .map(
              (item) =>
                `<li><a href="${item.link}">${item.title.rendered}</a></li>`
            )
            .join('')}
          ${combinedResults.length ? '</ul>' : ''}
        `)
        this.isSpinnerVisible = false
      },
      () => {
        //obsluga bledow, jezeli cos nie gra
        this.searchResults.html('Nieoczekiwany błąd, proszę spróbować ponownie')
      }
    )
  }

  openOverlay() {
    this.searchOverlay.addClass('search-overlay--active')
    $('body').addClass('body-no-scroll')
    this.searchField.val('')
    setTimeout(() => this.searchField.trigger('focus'), 301)
  }
  closeOverlay() {
    this.searchOverlay.removeClass('search-overlay--active')
    $('body').removeClass('body-no-scroll')
    this.searchResults.html('')
  }

  keyPressSearch(e) {
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      !$('input, textarea').is(':focus')
    ) {
      this.openOverlay()
      this.isOverlayOpen = true
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
      this.isOverlayOpen = false
    }
  }

  //dodanie wyszukiwarki na koniec kodu umieszczajac go do footera
  addSearchHTML() {
    $('body').append(`
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
    `)
  }
}

export default Search
