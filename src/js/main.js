import { debounce } from './util'

document.addEventListener('DOMContentLoaded', () => {
  document.documentElement.className = 'js'
})

window.addEventListener('resize', debounce(() => {
}, 250))

window.addEventListener('load', () => {

})


