// Load $templateUrl variable value from the header of the page.
window.$templateUrl = document.querySelector('meta[name="wideo_template_uri"]').getAttribute('content')

window.addEventListener('load', () => {
  console.log('Hello World')
})
