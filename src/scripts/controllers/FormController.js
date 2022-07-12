import { Controller } from 'stimulus'

export default class FormController extends Controller {
  static targets = ['feedback']

  connect() {
    // ascolto generico submit
    this.element.addEventListener('submit', (e) => {
      e.preventDefault()
      this.onSubmit()
    })
  }

  onSubmit = () => {
    const formData = new FormData(this.element)

    fetch(this.element.getAttribute('action'), { method: this.element.method || 'POST', body: formData })
      .then((response) => response.json())
      .then((responseJson) => {
        console.log(responseJson)

        if (this.hasFeedbackTarget) {
          if (responseJson.result) {
            this.feedbackTarget.innerHTML = 'Invio avvenuto con successo!'
          } else {
            this.feedbackTarget.innerHTML = responseJson.error
          }
        }
      })
      .catch((err) => {
        console.log(err)

        if (this.hasFeedbackTarget) {
          this.feedbackTarget.innerHTML = 'Qualcosa è andato storto.. riprova più tardi.'
        }
      })
  }
}