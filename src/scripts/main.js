// Base
import collector from "./base/Collector"
import layout from "./base/Layout"

// Components
import LazyLoad from "./components/LazyLoad"

// Other
import { debounce, loadScript } from "./util"

class Application {
  constructor () {
    this.init()
  }

  checkFeaturesSupport () {
    return !!window.IntersectionObserver
  }

  init () {
    window.addEventListener('load', () => {
      if (this.checkFeaturesSupport()) {
        this.start()
      } else {
        loadScript(`${templateUrl}/assets/polyfills.js`, () => {
          this.start()
        })
      }
    })

    window.addEventListener('resize', debounce(() => {
      layout.update()

      collector.map('resize')
    }, 200))
  }

  start () {
    layout.update()

    collector.add('lazyLoad', new LazyLoad())
  }
}

new Application()
