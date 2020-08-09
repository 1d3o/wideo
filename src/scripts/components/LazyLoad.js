export default class LazyLoad {
  constructor () {
    this.elements = []
    this.init()
  }

  load (_) {
    _.img.addEventListener('load', () => {
      _.el.classList.add('loaded')
    })
    img.addEventListener('error', () => {
      console.warn(`Lazyload error`, _)
      _.sources.forEach(source => {
        source.remove()
      })
      _.img.src = `${templateUrl}/assets/images/placeholder.jpg`
      _.el.classList.add('loaded')
    })

    for (let i = 0; i < srcsets.length; i++) {
      sources[i].srcset = srcsets[i].getAttribute('data-srcset')
    }
    img.src = img.getAttribute('data-src')
  }

  createObserver () {
    this.observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting || entry.intersectionRatio > 0) {
          this.observer.unobserve(entry.target)
          const element = this.elements.find(_ => _.el.isSameNode(entry.target))
          if (element) {
            this.load(element)
          }
        }
      })
    })

    this.elements.forEach(_ => {
      this.observer.observe(_.el)
    })
  }

  init () {
    const els = document.querySelectorAll('[data-lazy]')

    els.forEach(el => {
      const picture = el.querySelector('picture')

      if (picture) {
        this.elements.push({
          el,
          picture,
          sources: picture.querySelectorAll('[data-srcset]'),
          img: picture.querySelector('[data-src]')
        })
      }
    })

    this.createObserver()
  }
}