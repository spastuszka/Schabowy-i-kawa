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
      if (!this.isSpinnerVisible) {
        this.searchResults.html('<div class="loader"></div>')
        this.isSpinnerVisible = true
      }
      this.typingTimer = setTimeout(this.getResults.bind(this), 2000)
    }
    //Ustanowienie zmiennej ktora bedzie przechowywac wartosc pola wyszuykiwania
    this.previousValue = this.searchField.val()
  }

  getResults() {
    this.searchResults.html('Test result')
    this.isSpinnerVisible = false
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
