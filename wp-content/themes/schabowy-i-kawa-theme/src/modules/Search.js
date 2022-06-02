import $ from 'jquery'

class Search {
  // 1. Opis naszego obiektu oraz jego inicjalizacja
  constructor() {
    this.openButton = $('.js-search-trigger')
    this.closeButton = $('.search-overlay__close')
    this.searchOverlay = $('.search-overlay')
    this.searchField = $('#search-term')
    this.searchResults = $('#search-overlay__results')
    this.events()
    this.isOverlayOpen = false
    this.typingTimer
  }

  // 2. Zdarzenia - np. kliknięcie, najechanie itp.
  events() {
    this.openButton.on('click', this.openOverlay.bind(this))
    this.closeButton.on('click', this.closeOverlay.bind(this))
    $(document).on('keydown', this.keyPressSearch.bind(this))
    this.searchField.on('keydown', this.typingLogic.bind(this))
  }

  // 3. Metody
  typingLogic() {
    //Czyszczenie wcześniej uruchomienego timera w zmiennej typingTimer
    clearTimeout(this.typingTimer)
    this.typingTimer = setTimeout(this.getResults.bind(this), 2000)
  }

  getResults() {
    this.searchResults.html('Test result')
  }

  openOverlay() {
    this.searchOverlay.addClass('search-overlay--active')
    $('body').addClass('body-no-scroll')
  }
  closeOverlay() {
    this.searchOverlay.removeClass('search-overlay--active')
    $('body').removeClass('body-no-scroll')
  }

  keyPressSearch(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen) {
      this.openOverlay()
      this.isOverlayOpen = true
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
      this.isOverlayOpen = false
    }
  }
}

export default Search
