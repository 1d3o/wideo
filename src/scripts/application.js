import "@stimulus/polyfills"
import { Application } from 'stimulus'
// import ExampleController from './controllers/ExampleController'

// Initialize stimulus.
const application = Application.start()
// application.register('example', ExampleController)

// Manage load completed event.
window.addEventListener('DOMContentLoaded', () => {
  document.body.classList.add('js')
})